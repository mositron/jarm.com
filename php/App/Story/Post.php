<?php
namespace Jarm\App\Story;
use Jarm\Core\Load;

class Post extends Service
{
  public $blog;
  public $post;
  public function _post()
  {
    Load::Session()->logged();
    $db=Load::DB();
    if(!Load::$path[1])
    {
      if(!$this->blog=$db->find('story_blog',['dd'=>['$exists'=>false],'$or'=>[['u'=>Load::$my['_id']],['am'=>Load::$my['_id']]]]))
      {
        return ['move'=>'/blog?new'];
      }
      if(count($this->blog)>1)
      {
        return ['move'=>'/blog?select'];
      }
      $this->blog=$this->blog[0];
    }
    else
    {
      if(!$this->blog=$db->findone('story_blog',['dd'=>['$exists'=>false],'l'=>Load::$path[1]]))
      {
        return ['move'=>'/blog?no-blog'];
      }
      if($this->blog['u']!=Load::$my['_id'] && !in_array(Load::$my['_id'],(array)$this->blog['am']))
      {
        return ['move'=>'/blog?no-perm'];
      }
    }
    if(!Load::$path[2])
    {
      if($this->post=$db->findone('story_post',['dd'=>['$exists'=>false],'u'=>Load::$my['_id'],'b'=>$this->blog['_id'],'pl'=>0]))
      {
        return ['move'=>'/post/'.$this->blog['l'].'/'.$this->post['_id']];
      }
      if($id=$db->insert('story_post',['u'=>Load::$my['_id'],'b'=>$this->blog['_id'],'bl'=>$this->blog['l'],'pl'=>0]))
      {
        $ksv=[];
        foreach(Load::$conf['server']['files'] as $k=>$v)
        {
          if($v['upload'])
          {
            $ksv[]=$k;
          }
        }
        if(count($ksv)>0)
        {
          $sv=$ksv[$id%count($ksv)];
          $db->update('story_post',['_id'=>$id],['$set'=>['sv'=>$sv,'fd'=>date('Y/m/').$id]]);
          return ['move'=>'/post/'.$this->blog['l'].'/'.$id];
        }
        else
        {
          $db->remove('story_post',['_id'=>$id]);
        }
      }
    }
    else
    {
      if(!$this->post=$db->findone('story_post',['_id'=>intval(Load::$path[2]),'dd'=>['$exists'=>false],'u'=>Load::$my['_id'],'b'=>$this->blog['_id']]))
      {
        return ['move'=>'/blog?no-perm-edit'];
      }
    }

    Load::$core->data['title']=($this->post['pl']?'แก้ไข':'เพิ่มเรื่องใหม่').' - '.$this->blog['t'];
    Load::Ajax()->register(['savepost','delpost'],$this);
    return Load::$core
      ->assign('post',$this->post)
      ->assign('blog',$this->blog)
      ->assign('error',$error)
      ->fetch('story/post');
  }

  public function delpost()
  {
    $db=Load::DB();
    $ajax=Load::Ajax();
    $db->update('story_post',['_id'=>$this->post['_id']],['$set'=>['du'=>Load::$my['_id'],'dd'=>Load::Time()->now()]]);
    Load::Upload()->post($this->post['sv'],'story-delete',$this->post['fd']);
    $this->setcount($this->blog['_id']);
    $ajax->redirect('/blog/'.$this->blog['l']);
  }

  public function savepost($arg)
  {
    $t=mb_substr(trim(strip_tags($arg['title'])),0,100,'utf-8');
    $d=trim($arg['detail']);
    $db=Load::DB();
    $ajax=Load::Ajax();
    $dc=$this->clean($d);
    $img=(array)($this->getimg($dc));
    $set=['t'=>$t,'d'=>$dc,'l'=>Load::Format()->link(mb_substr($t,0,50,'utf-8')),'img'=>$img];
    $set['bl']=$this->blog['l'];
    if($arg['cate']&&isset($this->cate[$arg['cate']]))
    {
      $set['c']=intval($arg['cate']);
    }
    $set['tags']=$this->gettags($arg['tags'],5);
    if($arg['published']&&$t)
    {
      $set['pl']=1;
      if(!$this->post['ds'])
      {
        $set['ds']=Load::Time()->now();
      }
      $q=Load::Upload()->post($this->post['sv'],'story-list',$this->post['fd']);
      if($q['status']=='OK')
      {
        $file=$q['data'];
        //$this->getimg($dc)
        //$ajax->script('console.log("full: '.implode(',',$this->getimg($dc[1])).'")');
        //$ajax->script('console.log("img: '.implode(',',$img).'")');
        //$ajax->script('console.log("list: '.implode(',',$file).'")');
        for ($i=0;$i<count($file);$i++)
        {
          if(!in_array($file[$i], $img))
          {
            Load::Upload()->post($this->post['sv'],'delete','story/'.$this->post['fd'].'/'.$file[$i]);
            $ajax->script('console.log("del: '.$file[$i].'")');
          }
          else
          {
            $ajax->script('console.log("keep: '.$file[$i].'")');
          }
        }
      }
    }
    $db->update('story_post',['_id'=>$this->post['_id']],['$set'=>$set]);
    $ajax->script('$("#save").data("status","saved").html("บันทึกข้อมูลเรียบร้อยแล้ว...");');
    $this->setcount($this->blog['_id']);
    if($set['pl']||$this->post['pl'])
    {
      $ajax->script('$("#status").html("<a href=\'/'.$this->blog['l'].'/'.$this->post['_id'].'/'.$set['l'].'\'>เผยแพร่แล้ว</a>");');
      $ajax->script('$("#btn-publish").remove();');
    }
  }

  public function setcount($bid)
  {
    $db=Load::DB();
    $i=$db->count('story_post',['b'=>$bid,'pl'=>1,'dd'=>['$exists'=>false]]);
    $db->update('story_blog',['_id'=>$bid],['$set'=>['i'=>$i]]);
  }

  function clean($d)
  {
    $d=preg_replace('/\<br([^\>]*)\>/i',' ',stripslashes(trim($d)));
    $d=preg_replace_callback('/\<p([^\>]*)\>(.*)\<img(.+)src="([^"]+)"([^\>]*)\>(.*)\<\/p\>/i',
    function($arg)
    {
      $tmp='';
      if($img = strip_tags($arg[2],'<img><em>'))
      {
        $tmp.='<p'.$arg[1].'>'.$img.'</p>';
      }
      $tmp.='<p'.$arg[1].'><img src="'.$arg[4].'" /></p>';
      if($img = strip_tags($arg[6],'<img><em>'))
      {
        $tmp.='<p'.$arg[1].'>'.$img.'</p>';
      }
      return $tmp;
    },
    $d);
    $d=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i',[$this,'checkout_nofollow'],$d);
    $d=preg_replace_callback('/\<img src\="([^"]+)"([^\>]+)?"\>/i',[$this,'checkout_img'],$d);

    $split='<p';
    $blank=false;
    $detail=[];
    $serror=false;
    $last_txt='';
    $tmp=explode($split,$d);
    for($i=0;$i<count($tmp);$i++)
    {
      if(trim($tmp[$i]))
      {
        $d=trim($split.$tmp[$i]);
        $is_img=((stripos($d,'<img')!== false)?true:false);
        if(!$is_img)
        {
          $is_img=((stripos($d,'[embed-')!== false)?true:false);
          if(!$is_img)
          {
            $is_img=((stripos($d,'<iframe')!== false)?true:false);
          }
        }
        $pure_txt = trim(str_replace([' ','&nbsp;'],'',strip_tags($d,'<img><iframe>')));
        if(!$is_img)
        {
          if(!$pure_txt)
          {
            $blank=true;
            continue;
          }
        }
        if($blank)
        {
          $blank=false;
          if(count($detail)>0 && !$is_img)
          {
            $detail[]='<p> &nbsp; </p>';
          }
        }
        $detail[]=$d;
        $last_txt=$pure_txt;
      }
    }
    return implode("\r\n",$detail);
  }

  function gettags($tags,$limit=0)
  {
    if(!$tags)
    {
      return [];
    }
    if(is_array($tags))
    {
      $tags=implode(',',$tags);
    }
    $tag=array_values(array_filter(array_map([$this,'split'],array_filter(array_unique(array_map('trim',explode(',',mb_strtolower($tags,'utf-8'))))))));
    return empty($tag)?[]:($limit>0?array_slice($tag,0,$limit):$tag);
  }

  function split($tmp)
  {
    return preg_match("/^[a-zA-Z0-9\'ก-๙เแ\. ]+$/i",$tmp)?$tmp:false;
  }

  function getimg($d)
  {
    $dom = new \DOMDocument;
    @$dom->loadHTML($d);
    $links = $dom->getElementsByTagName('img');
    $a = [];
    $split = $this->post['sv'].'.jarm.com/story/'.$this->post['fd'].'/';
    foreach ($links as $link)
    {
      $re = $link->getAttribute('src');
      $b[] = $re.','.$split;
      $f = explode($split, $re);
      if(count($f) > 1)
      {
        $a[] = $f[1];
      }
    }
    return $a;
  }

  public function checkout_nofollow($arg)
  {
    if(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(jarm|boxzaracing|illusland)\.(.*)$/',$arg[1]))
    {
      return 	'<a href="'.$arg[1].'" target="_blank">';
    }
    else
    {
      return 	'<a href="'.$arg[1].'" target="_blank" rel="nofollow">';
    }
  }

  public function checkout_img($arg)
  {
    if(preg_match('/^https?\:\/\/([a-z0-9\.]+)?(jarm)\.(.*)$/',$arg[1]))
    {
      return 	'<img src="'.$arg[1].'"'.$arg[2].'>';
    }
    else
    {
      return 	'';
    }
  }
}
?>
