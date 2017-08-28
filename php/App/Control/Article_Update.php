<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Article_Update
{
  public function __construct()
  {
  }
  public function get($parent,$id)
  {
    $db=Load::DB();
    if(!$parent->article=$db->findone('article',['_id'=>intval($id),'dd'=>['$exists'=>false]]))
    {
      Load::move('/article');
    }
    $parent->article=$parent->fetch($parent->article);
    Load::$core->data['title']='บทความ - แก้ไข: '.$parent->article['t'];

    $error=[];
    if($_POST)
    {
      $db=Load::DB();
      $error=[];
      $arg=[];
      $arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
      $arg['d']=stripslashes(trim($_POST['detail']));
      $arg['d']=preg_replace('/\<br([^\>]*)\>/i',' ',$arg['d']);
      $arg['d']=preg_replace_callback('/\<p([^\>]*)\>(.*)\<img(.+)src="([^"]+)"([^\>]*)\>(.*)\<\/p\>/i',
      function($arg)
      {
        $tmp='';
        if($img = strip_tags($arg[2],'<img><em>'))
        {
          $tmp.='<p'.$arg[1].'>'.$img.'</p>';
        }
        $tmp.='<p'.$arg[1].'><img src="'.$arg[4].'" />'.'</p>';
        if($img = strip_tags($arg[6],'<img><em>'))
        {
          $tmp.='<p'.$arg[1].'>'.$img.'</p>';
        }
        return $tmp;
      },
      $arg['d']);

      $arg['d']=preg_replace_callback('/\<a href\="([^"]+)"([^\>]+)?"\>/i',[$this,'checkout_nofollow'],$arg['d']);
      # add title to image(alt)
      $arg['d']=preg_replace('/\<img([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?jarm.com\/([^"]*)"([^\>]*)alt="([^"]*)"([^\>]*)\>/i','<img\1src="http://\2jarm.com/\3"\4alt="'.htmlspecialchars($arg['t'],ENT_QUOTES,'utf-8').'"\6>',$arg['d']);
      # remove title from image
      $arg['d']=preg_replace('/\<img([^\>]*)title="([^"]*)"([^\>]*)src\="http\:\/\/([a-z0-9\.]+)?jarm.com\/([^"]*)"([^\>]*)\>/i','<img\1 src="http://\4jarm.com/\5"\6>',$arg['d']);

      $split='<p';
      $blank=false;
      $detail=[];
      $serror=false;
      $last_txt='';
      $tmp=explode($split,$arg['d']);
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
      $arg['d']=implode("\r\n",$detail);
      $arg['c']=array_values(array_unique(array_map('intval',array_filter((array)$_POST['cate']))));
      $arg['pl']=(in_array(intval($_POST['publish']),[0,1,2])?intval($_POST['publish']):0);
      $arg['rc']=($_POST['recommend']?1:0);
      $arg['tags']=array_values(array_filter(array_unique(array_map('trim',explode(',',$_POST['tags'])))));



      if(!$arg['t'])
      {
        $error['title']='กรุณากรอกชื่อบทความ';
      }

      if(!$arg['d'])
      {
        $error['detail']='กรุณากรอกรายละเอียดบทความ';
      }
      elseif(mb_stripos($arg['d'],'kapook.com',0,'utf-8')>-1)
      {
        $error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก kapook.com';
        $db->update('article',['_id'=>$parent->article['_id']],['$set'=>['pl'=>0]]);
      }
      elseif(mb_stripos($arg['d'],'sanook.com',0,'utf-8')>-1)
      {
        $error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก sanook.com';
        $db->update('article',['_id'=>$parent->article['_id']],['$set'=>['pl'=>0]]);
      }
      elseif(mb_stripos($arg['d'],'akamaihd.net',0,'utf-8')>-1)
      {
        $error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก akamaihd.net';
        $db->update('article',['_id'=>$parent->article['_id']],['$set'=>['pl'=>0]]);
      }
      elseif(mb_stripos($arg['d'],'fbcdn.net',0,'utf-8')>-1)
      {
        $error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก fbcdn.net';
        $db->update('article',['_id'=>$parent->article['_id']],['$set'=>['pl'=>0]]);
      }
      elseif(mb_stripos($arg['d'],'f1.jarm.com',0,'utf-8')>-1)
      {
        $error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก jarm.com';
        $db->update('article',['_id'=>$parent->article['_id']],['$set'=>['pl'=>0]]);
      }
      elseif(mb_stripos($arg['d'],'f2.jarm.com',0,'utf-8')>-1)
      {
        $error['detail']='ห้ามมีรายละเอียดหรือรูปภาพจาก jarm.com';
        $db->update('article',['_id'=>$parent->article['_id']],['$set'=>['pl'=>0]]);
      }
      if(count($arg['c'])<1)
      {
        $error['category']='กรุณาเลือกชนิดของบทความ';
      }

      if(!count($error))
      {
        $redirect='?completed';
        if($arg['pl'])
        {
          if(!$parent->article['ds'])
          {
            $arg['ds']=Load::Time()->now();
          }
          #if(!$parent->article['di'])
          #{
            $arg['di']=Load::Time()->now();
          #}
        }
        $arg['de']=Load::Time()->now();
        if($f=$_FILES['o']['tmp_name'])
        {
          $size=@getimagesize($f);
          switch (strtolower($size['mime']))
          {
            case 'image/gif':
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/bmp':
            case 'image/wbmp':
            case 'image/png':
            case 'image/x-png':
              if($size[0]>=100 && $size[1]>=100)
              {
                $arg['img']=1;
                $parent->article['img']=1;
              }
          }
        }
        if(!$parent->article['img'])
        {
          if($arg['pl'])
          {
            $arg['pl']=0;
            $redirect='?no-imag';
          }
        }
        $db->update('article',['_id'=>$parent->article['_id']],['$set'=>$arg]);
        $q=$parent->api($parent->article['sv'],'post',($arg['img']?'@'.$f:''),$db->findone('article',['_id'=>$parent->article['_id']]));
        if($q['status']!='OK')
        {
          $redirect='?server-error';
        }
        Load::move('/article/'.$parent->article['_id'].$redirect);
      }
      else
      {
        $parent->article=array_merge($parent->article,$arg);
      }
    }
    return Load::$core
      ->assign('article',$parent->article)
      ->assign('error',$error)
      ->assign('user',Load::User()->get($parent->article['u']))
      ->fetch('control/article.update');
  }

  public function checkout_nofollow($arg)
  {
    return 	'<a href="'.$arg[1].'" target="_blank" rel="nofollow">';
  }
}
?>
