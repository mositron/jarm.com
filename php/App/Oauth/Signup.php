<?php
namespace Jarm\App\Oauth;
use Jarm\Core\Load;

class Signup extends Service
{
  public function _signup()
  {
    $this->logined();

    Load::$core->data['title'] = 'สมัครสมาชิก';
    Load::$core->data['description'] = Load::$core->data['title'].' - สังคมออนไลน์ของคนไทย';
    Load::$core->data['keywords'] = 'สมัครสมาชิก, signup, สังคมออนไลน์';


    $ip=$_SERVER['REMOTE_ADDR'];

    $province = require(__CONF.'province.php');

    Load::$core
      ->assign('q',$_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:'')
      ->assign('province',$province);

    $db=Load::DB();
/*
    if(in_array('facebook',(array)Load::$path))
    {
      require_once(HANDLERS.'facebook/facebook.php');
      $facebook=new facebook(['appId'=>Load::$conf['social']['facebook']['appid'],'secret'=>Load::$conf['social']['facebook']['secret']]);

      if(!($uid=$facebook->getUser()) || !isset($_GET['code']))
      {
        Load::move($facebook->getLoginUrl(['scope'=>'offline_access,email,publish_stream,user_birthday,user_location,manage_pages,photo_upload']));
      }
      if ($uid)
      {
        $accessToken = $facebook->getAccessToken();
        $me = $facebook->api('/me');
        $me['email']=strtolower($me['email']);
        $value=[];
        $user=Load::User();
        if(!$me['verified'] || strpos($me['email'],'facebook')>-1)
        {
          $value['error'] = 'ไม่สามารถสมัครสมาชิกด้วย Email หรือ FB Account นี้ได้';
        }
        elseif($u=$db->findOne('user',['em'=>$me['email']],$user->fields))
        {
          Load::Session()->set($u,false);
          //Load::move(URI.($_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:''));
          if($_GET['appid'] && isset(Load::$conf['apps'][$_GET['appid']]))
          {
            $r=Load::$conf['apps'][$_GET['appid']];
            $data=['_id'=>Load::$my['_id']];
            $data['algorithm'] = 'HMAC-SHA256';
            $d = strtr(base64_encode(json_encode($data)), '+/', '-_');
            $s = strtr(base64_encode(hash_hmac('sha256', $d, $r['secret'], true)), '+/', '-_');
            //echo $r['uri'].'?redirect_uri='.urlencode($_GET['redirect_uri']).'&code='.$s.'.'.$d;
            //exit;
            Load::move($r['uri'].'login/?redirect_uri='.urlencode($_GET['redirect_uri']).'&code='.$s.'.'.$d);
          }
          elseif($_GET['redirect_uri'])
          {
            Load::move($_GET['redirect_uri']);
          }
          else
          {
            Load::move(['my']);
          }
        }
        elseif($_POST['fbid']==$me['id'])
        {
          $value = $_POST;
          $value['email'] = strtolower($me['email']);
          $value['fbid'] = $me['id'];
          $value['status']=1;
          signup_facebook($value,$facebook,$accessToken);
        }
        else
        {
          $value['firstname'] = $me['first_name'];
          $value['lastname'] = $me['last_name'];
          $value['email'] = strtolower($me['email']);
          $value['fbid'] = $me['id'];
          $value['gender'] = substr($me['gender'],0,1);
          $birthday = explode('/',$me['birthday']);
          $value['bday'] = $birthday[1];
          $value['bmonth'] = $birthday[0];
          $value['byear'] = $birthday[2];

          $location=explode(',',$me['location']['name']);
          $loc = strtolower(trim($location[0]));
          foreach($province as $k=>$v)
          {
            if($loc==strtolower($v['name_en']))
            {
              $value['province']=$k;
              break;
            }
          }
        }
        $tpl->assign('value',$value);
      }
      $tpl->assign('content',$tpl->fetch('signup.facebook'));
    }
    else
    {*/
      if($_POST)
      {
        $this->signup_email($_POST);
      }
      Load::$core->assign('content',Load::$core->fetch('oauth/signup.email'));
    //}
    Load::$core->data['content'] = Load::$core->fetch('oauth/signup');
  }
  function signup_facebook($arg,$fb,$fbtoken)
  {
    Load::Folder()->mkdir('bin/fb');
    $arg['photo']  = _FILES.'bin/fb/'.$arg['fbid'].'.jpg';
    @copy('http://graph.facebook.com/'.$arg['fbid'].'/picture/?type=large', $arg['photo']);
    $this->signup($arg,$fb,$fbtoken);
    Load::Folder()->delete('bin/fb/'.$arg['fbid'].'.jpg');
  }

  function signup_email($arg)
  {
    $arg['photo']  = $_FILES['photo']['tmp_name'];
    unset($arg['fbid']);
    $this->signup($arg);
  }

  function signup($arg,$fb=false,$fbtoken=false)
  {
    $arg['email']=strtolower($arg['email']);
    $error = [];
    $fields = [
      'email'=>['func'=>'check_email'],
      'password'=>['min'=>6,'max'=>30],
      'firstname'=>['min'=>2,'max'=>30],
      'lastname'=>['min'=>2,'max'=>30],
    ];

    $arg['firstname']=trim($this->just_clean($arg['firstname']));
    $arg['lastname']=trim($this->just_clean($arg['lastname']));

    foreach($fields as $key=>$val)
    {
      $v = $this->validate(trim(strval($arg[$key])),$fields[$key]);
      if($v['status']!='OK') $error[$key]=$v['message'];
    }

    $invalid_domain=require(__CONF.'invalid-domain.php');
    $domain2=explode('@', $arg['email']);
    $domain = array_pop($domain2);
    if(in_array($domain, $invalid_domain))
    {
      $error['email'] = 'ไม่สามารถใช้งานอีเมล์นี้ได้';
    }

    if(trim($arg['password'])!=$arg['password'])
    {
      $error['password'] = 'ไม่สามารถใช้ช่องว่างเป็นรหัสผ่านได้';
    }
    if(!trim($arg['terms']))
    {
      $error['terms'] = 'ยังไม่ได้ยอมรับเงื่อนไขการใช้งาน';
    }
    $_gdk=array_keys(Load::$conf['gender']);
    if(!in_array($arg['gender'],$_gdk))
    {
      $error['gender'] = 'กรุณาเลือกเพศ';
    }
    if(strval($arg['province'])=='')
    {
      $error['province'] = 'กรุณาเลือกจังหวัด';
    }
    $bday = intval($arg['bday']);
    $bmonth = intval($arg['bmonth']);
    $byear = intval($arg['byear']);
    if(($bday<1||$bday>31)||($bmonth<1||$bmonth>12)||($byear<date('Y')-110||$byear>date('Y')-10))
    {
      $error['birthday'] = 'กรุณาเลือกวันเดือนปีเกิด';
    }
    if(!$arg['fbid'])
    {
      if(!$arg['photo'])
      {
        $error['photo'] = 'กรุณาเลือกไฟล์รูปภาพ';
      }
      else
      {
        $ftype=getimagesize($arg['photo']);
        if(!in_array($ftype['mime'],['image/gif','image/jpeg','image/png']))
        {
          $error['photo'] = 'ไฟล์รูปภาพไม่ถูกต้อง';
        }
      }
    }
    if(!count($error))
    {
      $insert=[
        'if'=>[
          'fn'=>trim($arg['firstname']),
          'ln'=>trim($arg['lastname']),
          'gd'=>$arg['gender'],
          'pr'=>intval($arg['province']),
          'bd'=>Load::Time()->from($byear.'-'.substr('0'.$bmonth,-2).'-'.substr('0'.$bday,-2).' 00:00:00'),
          'bdk'=>strval(intval($bmonth).'-'.intval($bday)),
          'fd'=>'',
          'fs'=>'',
          'ac'=>1,
          'fl'=>0
        ],
        'em'=>$arg['email'],
        'pw'=>md5(md5($arg['password'])),
        'ip'=>$_SERVER['REMOTE_ADDR'],
      ];
      //$insert['em']=strtolower($insert['em']);
      $insert['st'] = ($arg['status']?1:0);
      if($arg['fbid'])
      {
        $insert['sc'] = ['fb'=>['id'=>$arg['fbid'],'token'=>$fbtoken]];
      }

      $db=Load::DB();
      if($uid=$db->insert('user',$insert))
      {
        $fd=date('Y/md').'/'.$uid;
        $fs=date('Ymd').$uid;
        $ksv=[];
        foreach(Load::$conf['server']['files'] as $k=>$v)
        {
          if($v['upload'])
          {
            $ksv[]=$k;
          }
        }
        if(count($ksv)==0)
        {
          die('ไม่มี server รองรับการ upload รูปภาพ');
        }
        $sv=$ksv[$uid%count($ksv)];
        $db->update('user',['_id'=>$uid],['$set'=>['if.fd'=>$fd,'if.fs'=>$fs,'if.lk'=>'','sv'=>$sv]]);
        Load::Session()->set(['_id'=>$uid,'pw'=>$insert['pw']],false);
        try{
          Load::Upload()->post($sv,'upload','@'.$arg['photo'],['name'=>'s','folder'=>'profile/'.$fd,'width'=>50,'height'=>50,'fix'=>'bothtop','type'=>'jpg']);
          Load::Upload()->post($sv,'upload','@'.$arg['photo'],['name'=>'n','folder'=>'profile/'.$fd,'width'=>200,'height'=>200,'fix'=>'bothtop','type'=>'jpg']);
          @unlink($arg['photo']);
        } catch (Exception $e) {}

        if(!$insert['st'])
        {
          $user = Load::User();
          $mail = Load::Mail();
          $mail->to=$insert['em'];
          $mail->subject = 'ยืนยันการสมัครสมาชิก Jarm - โซเชียลเน็ทเวิร์คสัญชาติไทย';
          $p=strtolower(substr(md5(rand(1,999999)),10,10));
          $user->update($uid,['$set'=>['ec'=>['c'=>0,'p'=>$p,'t'=>Load::Time()->now()]]]);
          $mail->message=Load::$core
            ->assign('u',$insert)
            ->assign('uid',$uid)
            ->assign('img',Load::uri([$sv,'/profile/'.$fd.'/s.jpg']))
            ->assign('code',$p)
            ->fetch('oauth/signup.confirm.mail');
          $mail->send();
        }

        if($_GET['appid'] && isset(Load::$conf['apps'][$_GET['appid']]))
        {
          $r=Load::$conf['apps'][$_GET['appid']];
          $data=['_id'=>Load::$my['_id']];
          $data['algorithm'] = 'HMAC-SHA256';
          $d = strtr(base64_encode(json_encode($data)), '+/', '-_');
          $s = strtr(base64_encode(hash_hmac('sha256', $d, $r['secret'], true)), '+/', '-_');
          Load::move($r['uri'].'login/?redirect_uri='.urlencode($_GET['redirect_uri']).'&code='.$s.'.'.$d);
        }
        elseif($_GET['redirect_uri'])
        {
          Load::move($_GET['redirect_uri']);
        }
        else
        {
          Load::move(['my','/'.($inser['ref']?'?ref='.$inser['ref']:'')]);
        }
      }
      else
      {
        #Load::Ajax()->alert('ไม่สามารถสมัครได้ในขณะนี้ กรุณาลองใหม่ภายหลัง.');
      }
    }
    else
    {
      Load::$core
        ->assign('error',$error)
        ->assign('value',$_POST);
    }
  }

  public function validate($val,$prop)
  {
    $len = mb_strlen($val,'utf-8');
    if(is_numeric($prop['min']) && $len<$prop['min'])
    {
      return ['status'=>'FAIL','message'=>'ขั้นต่ำ '.$prop['min'].' ตัวอักษร'];
    }
    if(is_numeric($prop['max']) && $len>$prop['max'])
    {
      return ['status'=>'FAIL','message'=>'ไม่เกิน '.$prop['max'].' ตัวอักษร'];
    }
    if($prop['func'])
    {
      $v = call_user_func([$this,$prop['func']],$val);
      if($v['status']!='OK')return $v;
    }
    return ['status'=>'OK'];
  }
  public function check_email($email)
  {
    #if(preg_match('/^[\w.-]+@([\w.-]+\.)+[a-z]{2,6}$/is', $email))
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      return Load::DB()->count('user',['em'=>strtolower($email)])?['status'=>'FAIL','message'=>'อีเมล์นี้มีผู้ใช้งานแล้ว - <a href="'.Load::uri(['oauth','/login']).'">ล็อคอินด้วยอีเมลล์นี้ คลิกที่นี่</a>']:['status'=>'OK'];
    }
    else
    {
      return ['status'=>'FAIL','message'=>'กรุณากรอกอีเมล์ให้ถูกต้อง'];
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
