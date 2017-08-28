<?php
namespace Jarm\App\Www;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'Jarm.com | ข่าว ข่าววันนี้ ข่าวบันเทิง ตรวจหวย ดูดวง เพลง รูปภาพ ผลบอล เนื้อเพลง ดูดวง หาเพื่อน ผู้หญิง เลสเบี้ยน เกย์',
      'description'=>'Jarm.com |  สังคมออนไลน์ของคนไทยเต็มรูปแบบ พร้อมบริการ ข่าว เกมส์ อัลบั้ม รูปภาพ วิดีโอ หาเพื่อน ดูหนังออนไลน์ ลงประกาศฟรี และอื่นๆอีกมากมาย',
      'keywords'=>'jarm, ข่าว, ข่าววันนี้, ข่าวบันเทิง, ตรวจหวย, ดูดวง, เกมส์, เพลง, หนัง, รูปภาพ, เนื้อเพลง, ดูดวง, เกมส์, กลิตเตอร์, หาเพื่อน, ผู้หญิง, เลสเบี้ยน, เกย์, ฝากรูป, ผลบอล, ข่าวฟุตบอล, ผลบอลสด, วิเคราะห์บอล',
    ]);
  }

  public function _about()
  {
    Load::cache();
    if(Load::$path[1]=='privacy')
    {
      Load::$core->data['title']='เงื่อนไข ข้อตกลง การใช้งาน Jarm';
      Load::$core->data['description']='เงื่อนไขข้อตกลงการใช้งาน สังคมออนไลน์ของคนไทย';
      return Load::$core->fetch('www/about');
    }
    elseif(Load::$path[1]=='team')
    {
      Load::$core->data['title']='Team | jarm.com';
      Load::$core->data['description']='Jarm Team | jarm.com';
      return Load::$core->fetch('www/about');
    }
    elseif(Load::$path[1]=='ads')
    {
      Load::$core->data['title']='ติดต่อลงโฆษณา | jarm.com';
      Load::$core->data['description']='ติดต่อลงโฆษณา | jarm.com';
      return Load::$core->fetch('www/about.ads');
    }
    elseif(!Load::$path[1])
    {
      Load::$core->data['title']='เกี่ยวกับเรา | jarm.com';
      Load::$core->data['description']='เกี่ยวกับเรา เกี่ยวกับ jarm.com';
      return Load::$core->fetch('www/about.home');
    }
    else
    {
      return ['move'=>'/about'];
    }
  }

  public function _ads(): void
  {
    $err='id';
    if(Load::$path[1]=='click'&&$b=$_GET['__b'])
    {
      $err='public';
      $data=json_decode(base64_decode(strtr($b,'-_','+/')),true);
      if($data['i'])
      {
        if(!preg_match('/(bot|crawl|slurp|spider|seek|dmoz|spyder|wget|\.\.\.\.)/i',$_SERVER['HTTP_USER_AGENT'],$m))
        {
          $db=Load::DB();
          if($banner=$db->findone('banner',['_id'=>intval($data['i']),'pl'=>1,'dd'=>['$exists'=>false]]))
          {
            $db->update('banner',['_id'=>$banner['_id']],['$inc'=>['do'=>1]]);
            $db->insert('banner_click',['b'=>$banner['_id'],'kd'=>date('Y-m-d'),'km'=>date('Y-m'),'p'=>strval($data['p']),'s'=>strval($data['s']),'ip'=>$_SERVER['REMOTE_ADDR'],'ua'=>$_SERVER['HTTP_USER_AGENT']]);
          }
        }
        if(!empty($data['l']))
        {
          Load::move($banner['l'],false);
        }
        $err='link';
      }
    }
    Load::move(URH.'/?__error=invalid-ads-'.$err,true);
  }

  public function _job()
  {
    #ปิดใช้งานชั่วคราว
    Load::move('/');
    #return Load::$core->assign('job',Load::DB()->findone('msg',['_id'=>'job']))->fetch('www/job');
  }

  public function _unsubscribe()
  {
    return Load::$core->fetch('www/unsubscribe');
  }

  public function _user()
  {
    return ['move'=>['my','/user/'.Load::$path[1]]];
  }

  public function _verify()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'กรุณายืนยันการสมัครสมาชิก | Jarm.com',
      'description'=>'กรุณายืนยันการสมัครสมาชิก | Jarm.com',
      'keywords'=>'กรุณายืนยันการสมัครสมาชิก',
    ]);
    return Load::$core->fetch('www/verify');
  }

  public function sendconfirm()
  {
    $db=Load::DB();
    $ajax=Load::Ajax();
    $user=Load::User();
    $last = $db->findOne('user',['_id'=>Load::$my['_id']],['ec'=>1,'st'=>1]);
    if($last)
    {
      $c=0;
      $mail = Load::Mail();
      $mail->to=Load::$my['em'];
      $mail->subject='ยืนยันการสมัครสมาชิก - Jarm Socail Network ของคนไทย';
      Load::$core->assign('u',Load::$my);
      if($last['st'])
      {
        $ajax->alert('คุณทำการยืนยันการสมัครสมาชิกเรียบร้อยแล้ว');
      }
      elseif($last['ec'])
      {
        $c=intval($last['ec']['c']);
        if($last['ec']['t'] && ($c>3) && (Load::Time()->sec($last['ec']['t']) > (time()-3600)))
        {
          $ajax->alert('คุณมีการร้องขอส่งอีเมล์มากเกินไป กรุณารอ 1ชมเพื่อดำเนินการใหม่อีกครั้ง');
        }
        else
        {
          Load::$core->assign('code',$last['ec']['p']);
          $mail->message = Load::$core->fetch('www/settings.confirm.mail');
          $mail->send();
          $user->update(Load::$my['_id'],['$set'=>['ec.c'=>($c+1),'ec.t'=>Load::Time()->now()]]);
          $ajax->alert('ระบบทำการส่งข้อมูลการยืนยันไปยัง '.Load::$my['em'].' แล้ว');
        }
      }
      else
      {
        $p=strtolower(substr(md5(rand(1,999999)),10,10));
        $user->update(Load::$my['_id'],['$set'=>['ec'=>['c'=>0,'p'=>$p,'t'=>Load::Time()->now()]]]);
        Load::$core->assign('code',$p);
        $mail->message = Load::$core->fetch('www/settings.confirm.mail');
        $mail->send();
        $ajax->alert('ระบบทำการส่งข้อมูลการยืนยันไปยัง '.Load::$my['em'].' แล้ว');
      }
    }
  }

  public function just_clean($string)
  {
    // Replace other special chars
    $s = '!@#$%^&*()_+-={}[]:";\'?/.,<>`~';
    for($i=0;$i<mb_strlen($s,'utf-8');$i++)
    {
      $string = str_replace(mb_substr($s,$i,1,'utf-8'),'', $string);
      $string = str_replace('  ',' ', $string);
    }
    return trim($string);
  }
}
?>
