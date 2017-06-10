<?php
namespace Jarm\App\Music;
use Jarm\Core\Load;

class Lyric extends Service
{
  public function _lyric()
  {
    Load::cache();
    $db=Load::DB();
    if(!$music=$db->findone('music',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]]))
    {
      Load::move('/');
    }
    Load::Ajax()->register('setvdo');

    $db->update('music',['_id'=>$music['_id']],['$inc'=>['do'=>1]]);

    Load::$core->data['title']='เพลง'.$music['sn'].' เนื้อเพลง'.$music['sn'].' อัลบั้ม '.$music['al'].' ศิลปิน '.$music['ar'].' - ฟังเพลง '.$music['sn'].' ดาวน์โหลดเพลง '.$music['sn'].' ฟังเพลงออนไลน์ คอร์ดเพลง';
    Load::$core->data['description']=Load::$core->data['title'].' - '.Load::$core->data['description'];
    Load::$core->data['type']='music.song';

    if($music['fd']&&$music['s'])
    {
      Load::$core->data['image']='https://s3.jarm.com/music/'.$music['fd'].'/'.$music['s'];
    }
    $music['sn2']=$music['sn'];
    $z=mb_strpos($music['sn'],'(',0,'utf-8');
    if($z>3)
    {
      $music['sn2']=trim(mb_substr($music['sn'],0,$z,'utf-8'));
    }
    if(!$music['dv'] || !is_array($music['vd']) || !$music['dv'] || (Load::Time()->sec($music['dv']) < time()-604800))
    {
      $html=Load::Http()->get('https://www.googleapis.com/youtube/v3/search?part=id%2Csnippet&q='.urlencode($music['sn'].' '.$music['ar']).'&maxResults=20&order=relevance&key=AIzaSyBpPQ3r-g-LQj8cmFZtSeL05hfr5ztxcTM');
      $video=json_decode($html,true);
      $set=['dv'=>Load::Time()->now(),'vd'=>[]];
      if(is_array($video['items']))
      {
        foreach($video['items'] as $k => $v)
        {
          $y=[];
          $y['id']=$v['id']['videoId'];
          if(mb_strlen($y['id'],'utf-8')==11)
          {
            $y['t']=$v['snippet']['title'];
            $set['vd'][]=$y;
          }
        }
      }
      $music['vd']=$set['vd'];
      $db->update('music',['_id'=>$music['_id']],['$set'=>$set]);
    }

    if(!$music['df'] || !is_array($music['fs']) || !$music['df'] || (Load::Time()->sec($music['df']) < time()-604800))
    {
      $html=Load::Http()->get('https://api.4shared.com/v0/files.json?oauth_consumer_key=8b6aef4cc1976ca03eec1eb49be9adda&query='.urlencode($music['sn'].' '.$music['ar']).'&limit=10');
      $fs=json_decode($html,true);
      $set=['df'=>Load::Time()->now(),'fs'=>[]];
      $fapi=false;
      if(is_array($fs['files']))
      {
        $fapi=$fs['files'];
      }
      if($fapi)
      {
        foreach($fapi as $k => $v)
        {
          $y=[];
          $y['n']=$v['name'];
          $y['da']=Load::Time()->from($v['modified']);
          $y['l']=trim($v['downloadPage']);
          $y['s']=trim($v['size']);
          $set['fs'][]=$y;
        }
      }
      $music['fs']=$set['fs'];
      $db->update('music',['_id'=>$music['_id']],['$set'=>$set]);
    }
    //http://search.4shared.com/network/searchXml.jsp?q=&searchExtention=music

    $tmp = trim(str_replace("\r\n\r\n\r\n","\r\n\r\n",trim($music['ly'])));
    if($tmp!=$music['ly'])
    {
      $music['ly']=$tmp;
      $db->update('music',['_id'=>$music['_id']],['$set'=>['ly'=>$music['ly']]]);
    }
    $music['ly']=nl2br($music['ly']);

    $relate=$db->find('music',['_id'=>['$ne'=>$music['_id']],'ar'=>$music['ar'],'al'=>$music['al'],'dd'=>['$exists'=>false]],['_id'=>1,'sn'=>1],['sort'=>['_id'=>-1],'limit'=>20]);

    Load::$core->data['content']=Load::$core
      ->assign('type',['rs'=>'RS','gm'=>'GMM','yp'=>''])
      ->assign('c',$music['c'])
      ->assign('music',$music)
      ->assign('relate',$relate)
      ->fetch('music/lyric');
  }

  public function setvdo($v)
  {
    if(Load::$my['am'])
    {
      Load::DB()->update('music',['_id'=>intval(Load::$path[1])],['$set'=>['yt'=>$v]]);
      $ajax=Load::Ajax();
      $ajax->alert('บันทึกข้อมูลเรียบร้อยแล้ว');
      $ajax->script('setTimeout(function(){window.location.href="'.URL.'"},2000);');
    }
  }

  public function comment($arg)
  {
    $ajax=Load::Ajax();
    $name=strip_tags(trim(strval($arg['name'])));
    $msg=strip_tags(trim($arg['msg']));
    $msg=preg_replace('/http(s?)\:\/\/(\S+)/i','',$msg);
    $msg=mb_substr($msg,0,2000,'utf-8');
    $db=Load::DB();
    if($tmp=$db->findone('music',['_id'=>intval(Load::$path[q]),'dd'=>['$exists'=>false],'pl'=>1],['_id'=>1,'cm.c'=>1,'cm.i'=>1,'cm.d'=>1]))
    {
      if($_COOKIE['cp-'.Load::$path[1]]!=md5(strtoupper('@cp:'.Load::$path[q].':'.$arg['code'])))
      {
        $ajax->alert('โค๊ดไม่ถูกต้อง - '.$_COOKIE['cp'].' - '.Load::$path[q].' - '.$_COOKIE['cp-'.Load::$path[1]].' - '.$arg['code'].' - '.md5(strtoupper('@cp:'.Load::$path[1].':'.$arg['code'])));
        $ajax->script('$("#music-'.Load::$path[1].'-captcha").attr("src","https://bin.jarm.com/captcha/get.php?'.Load::$path[1].'.'.rand(1,99999).'");$("#music-code").val("");');
      }
      elseif(mb_strlen($name,'utf-8')<3 && !Load::$my)
      {
        $ajax->alert('ชื่อของคุณสั้นเกินไป');
      }
      elseif(mb_strlen($msg,'utf-8')<3)
      {
        $ajax->alert('ข้อความของคุณสั้นเกินไป');
      }
      else
      {
        $msg = htmlspecialchars($msg, ENT_QUOTES,'utf-8');
        $push=true;
        if(!is_array($tmp['cm']))
        {
          $tmp['cm']=['c'=>0,'i'=>0,'d'=>[]];
          $push = false;
        }
        $cm_i = intval($tmp['cm']['i'])+1;
        $cm_c = count($tmp['cm']['d'])+1;
        if($push)
        {
          $arg2 = ['$set'=>['cm.c'=>$cm_c,'cm.i'=>$cm_i],'$push'=>['cm.d'=>['i'=>$cm_i,'m'=>$msg,'u'=>intval(Load::$my['_id']),'n'=>$name,'t'=>Load::Time()->now(),'p'=>$_SERVER['REMOTE_ADDR']]]];
        }
        else
        {
          $arg2 = ['$set'=>['cm'=>['c'=>$cm_c,'i'=>$cm_i,'d'=>[['i'=>$cm_i,'m'=>$msg,'u'=>intval(Load::$my['_id']),'m'=>$name,'t'=>Load::Time()->now(),'p'=>$_SERVER['REMOTE_ADDR']]]]]];
        }
        $db->update('music',['_id'=>$tmp['_id']],$arg2);
        $ajax->alert('เพิ่มข้อความของคุณเรียบร้อยแล้ว กรุณารอซักครู่');
        $ajax->script('setTimeout(function(){window.location.href="/view/'.$tmp['_id'].'"},2000);');
        $ajax->script('$("#music-'.Load::$path[1].'-captcha").attr("src","https://bin.jarm.com/captcha/get.php?'.Load::$path[1].'.'.rand(1,99999).'");$("#music-form").get(0).reset();');
      }
    }
  }


  public function delcomment($cid)
  {
    Load::Session()->logged();
    $db=Load::DB();
    $ajax=Load::Ajax();
    if(!$cid)
    {
      $ajax->alert('ไอดีข้อความไม่ถูกต้อง');
    }
    elseif($topic=$db->findone('music',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]],['_id'=>1,'t'=>1,'u'=>1,'cm.d'=>1,'cm.c'=>1]))
    {
      $cm = false;
      for($i=0;$i<count($topic['cm']['d']);$i++)
      {
        if($topic['cm']['d'][$i]['i'] == $cid)
        {
          $cm = $topic['cm']['d'][$i];
          break;
        }
      }
      if($cm)
      {
        if(Load::$my['am'])
        {
          $c = max(0,count($topic['cm']['d'])-1);
          $db->update('music',['_id'=>$topic['_id']],['$set'=>['cm.c'=>$c],'$pull'=>['cm.d'=>['i'=>intval($cid)]],'$push'=>['cm.e'=>$cm]]);
          Load::move(URL);
        }
        else
        {
          $ajax->alert('คุณไม่มีสิทธิ์ลบข้อความนี้');
        }
      }
      else
      {
        $ajax->alert('ไม่มีข้อความดังกล่าว');
      }
    }
    else
    {
      $ajax->alert('กระทู้นี้ไม่มีอยู่ หรืออาจจะถุกลบไปแล้ว');
    }
  }
}
?>
