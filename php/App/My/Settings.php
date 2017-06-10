<?php
namespace Jarm\App\My;
use Jarm\Core\Load;

class Settings extends Service
{
  public function get_settings()
  {
    Load::Session()->logged();
    $path=(Load::$path[1]?:'');
    if($path=='facebook' && isset($_GET['code']))
    {
      $fb = new \Facebook\Facebook([
        'app_id'=>Load::$conf['social']['facebook']['appid'],
        'app_secret'=>Load::$conf['social']['facebook']['secret'],
        'default_graph_version'=>'v2.5',
        'persistent_data_handler'=>new \Jarm\App\Facebook_Helper()
      ]);

      $helper=$fb->getRedirectLoginHelper();
      try
      {
        $accessToken=$helper->getAccessToken();
      }
      catch(Facebook\Exceptions\FacebookResponseException $e)
      {
        die('Graph returned an error: '.$e->getMessage());
      }
      catch(Facebook\Exceptions\FacebookSDKException $e)
      {
        die('Facebook SDK returned an error: '.$e->getMessage());
      }

      if($accessToken)
      {
        $me=$fb->get('/me?fields=id,name,email,verified', $accessToken)->getDecodedBody();
        $me['email']=trim(strtolower($me['email']));
        $me['id']=strval(trim($me['id']));
        $me['name']=trim($me['name']);
        $value=[];
        if(!$me['verified'] || strpos($me['email'],'facebook')>-1)
        {

        }
        elseif($me['email']==Load::$my['em'])
        {
          if(!is_array(Load::$my['sc']))Load::$my['sc']=[];
          Load::$my['sc']['fb']=['id'=>$uid,'name'=>$me['name']];
          Load::User()->update(Load::$my['_id'],['$set'=>['sc.fb'=>Load::$my['sc']['fb']]]);
        }
      }
    }

    if($path=='twitter' && isset($_GET['oauth_verifier']) && Load::$my['sc']['tw']['tmp'])
    {
      $t=Load::$my['sc']['tw']['tmp'];
      require(_PHP.'vendor/twitter/twitteroauth/twitteroauth.php');
      $connection = new TwitterOAuth(Load::$conf['social']['twitter']['appid'], Load::$conf['social']['twitter']['secret'], $t['oauth_token'], $t['oauth_token_secret']);
      if($c = $connection->getAccessToken($_GET['oauth_verifier']))
      {
        if(!is_array(Load::$my['sc']))Load::$my['sc']=[];
        Load::$my['sc']['tw']=['id'=>$c['user_id'],'name'=>$c['screen_name'],'token'=>$c['oauth_token'],'secret'=>$c['oauth_token_secret']];
        Load::User()->update(Load::$my['_id'],['$set'=>['sc.tw'=>Load::$my['sc']['tw']]]);
      }
    }

    if($path=='google'&&$_GET['call']=='google')
    {
      require_once _PHP.'vendor/google/Google_Client.php';
      require_once _PHP.'vendor/google/contrib/Google_PlusService.php';
      $client=new Google_Client();
      $client->setApplicationName('Login to '.Load::$conf['domain'].' with Google API');
      $client->setClientId(Load::$conf['social']['google']['appid']);
      $client->setClientSecret(Load::$conf['social']['google']['secret']);
      $client->setRedirectUri(URH.'/settings/google/?call=google');
      //$client->setDeveloperKey(Load::$conf['social']['google']['key']);
      $plus=new Google_PlusService($client);
      if (isset($_GET['code']))
      {
        $client->authenticate();
        Load::User()->update(Load::$my['_id'],['$set'=>['sc.gg.token'=>$client->getAccessToken()]]);
        Load::move(URH.'/settings/google/?call=google');
      }

      if (isset(Load::$my['sc']['gg']['token']))
      {
        $client->setAccessToken(Load::$my['sc']['gg']['token']);
      }
      if ($client->getAccessToken())
      {
        $me = $plus->people->get('me');
        if(!is_array(Load::$my['sc']))Load::$my['sc']=[];
        Load::$my['sc']['gg']=['id'=>$me['id'],'name'=>$me['displayName'],'token'=>Load::$my['sc']['gg']['token'],'img'=>$me['image']['url']];
        Load::User()->update(Load::$my['_id'],['$set'=>['sc.gg'=>Load::$my['sc']['gg']]]);
      }
    }

    $getsettings=function($type)
    {
      $db=Load::DB();
      $u=$db->findOne('user',['_id'=>Load::$my['_id']],['addr'=>1,'idc'=>1]);
      $prov=require(__CONF.'province.php');
      $prov['0']='';
      Load::$core->assign('addr',(array)$u['addr'])
          ->assign('idc',(array)$u['idc'])
          ->assign('prov',$prov);
      if(in_array($type,['avatar','email','name','url','profile','access','password','address','idcard','google','facebook','twitter','notifications','ignore','block','connect','delete']))
      {
        Load::$core->assign('type',$type);
      }
      return Load::$core->fetch('my/settings.list');
    };
    Load::$core->data['title']='ตั้งค่า - Jarm สังคมออนไลน์';
    Load::$core->data['description']='ตั้งค่า - สังคมออนไลน์ของคนไทย';
    Load::$core->data['keywords']='ตั้งค่า, สังคมออนไลน์';
    Load::$core->data['content']=Load::$core
      ->assign('my',Load::$my)
      ->assign('settings',$getsettings($path))
      ->fetch('my/settings');
  }

  public function post_settings()
  {
    Load::Ajax()->register(['settings','setsc','setline','sendconfirm','unblock','changeemail','savecrop']);
    $this->user_upload(Load::$my);
  }

  public function setsc($social,$type)
  {
    if($social=='fb')
    {
      require_once(__DIR__.'/www.facebook.php');
      $fb = new Facebook\Facebook([
        'app_id'=>Load::$conf['social']['facebook']['appid'],
        'app_secret'=>Load::$conf['social']['facebook']['secret'],
        'default_graph_version'=>'v2.5',
        'persistent_data_handler'=>new myPerData()
      ]);
      if($type=='new')
      {
        $helper=$fb->getRedirectLoginHelper();
        Load::move($helper->getLoginUrl(['scope'=>'email','redirect_uri'=>www::$host_uri.'/settings/facebook']));
      }
      elseif($type=='verify')
      {
        $helper=$fb->getRedirectLoginHelper();
        Load::move($helper->getLoginUrl(['scope'=>'email','redirect_uri'=>www::$host_uri.'/settings/facebook']));
      }
      elseif($type=='del')
      {
        Load::User()->update(Load::$my['_id'],['$unset'=>['sc.fb'=>1]]);
        Load::move('/settings/facebook');
      }
    }
    else if($social=='tw')
    {
      if($type=='new')
      {
        require(_PHP.'vendor/twitter/twitteroauth/twitteroauth.php');
        $connection=new TwitterOAuth(Load::$conf['social']['twitter']['appid'], Load::$conf['social']['twitter']['secret']);
        $tmp=$connection->getRequestToken(www::$host_uri.'/settings/twitter/?call=twitter');
        Load::User()->update(Load::$my['_id'],['$set'=>['sc.tw.tmp'=>$tmp]]);
        if($connection->http_code == 200)
        {
           Load::move($connection->getAuthorizeURL($tmp['oauth_token']));
        }
      }
      elseif($type=='del')
      {
        Load::User()->update(Load::$my['_id'],['$unset'=>['sc.tw'=>1]]);
        Load::move('/settings/twitter');
      }
    }
    elseif($social=='gg')
    {
      if($type=='new')
      {
        require_once _PHP.'vendor/google/Google_Client.php';
        require_once _PHP.'vendor/google/contrib/Google_PlusService.php';
        $client = new Google_Client();
        $client->setApplicationName("Login to jarm.com with Google API");
        $client->setClientId(Load::$conf['social']['google']['appid']);
        $client->setClientSecret(Load::$conf['social']['google']['secret']);
        $client->setRedirectUri('http://jarm.com/settings/google/?call=google');
        $client->setDeveloperKey(Load::$conf['social']['google']['key']);
        $plus = new Google_PlusService($client);

        $client->setState(mt_rand());
        Load::move($client->createAuthUrl());
      }
      elseif($type=='del')
      {
        Load::User()->update(Load::$my['_id'],['$unset'=>['sc.gg'=>1]]);
        Load::move('/settings/google');
      }
    }
  }

  private function just_clean($a)
  {
    return $a;
  }

  public function settings($arg)
  {
    $ajax=Load::Ajax();
    $db=Load::DB();
    $user=Load::User();
    if($arg['setting']=='name')
    {
      $arg['first']=trim($this->just_clean($arg['first']));
      $arg['last']=trim($this->just_clean($arg['last']));
      if(mb_strlen($arg['first'],'utf-8')<2)
      {
        $ajax->alert('กรุณากรอกชื่ออย่างน้อย 2 ตัวอักษร');
      }
      elseif(mb_strlen($arg['last'],'utf-8')<2)
      {
        $ajax->alert('กรุณากรอกนามสกุลอย่างน้อย 2 ตัวอักษร');
      }
      else
      {
        $user->update(Load::$my['_id'],['$set'=>['if.fn'=>mb_substr($arg['first'],0,30,'utf-8'),'if.ln'=>mb_substr($arg['last'],0,30,'utf-8')]]);
        $ajax->script('setTimeout(function(){window.location.href="/settings";},2000)');
        $ajax->alert('แก้ไขชื่อ-นามสกุลเรียบร้อยแล้ว');
      }
    }
    elseif($arg['setting']=='profile')
    {
      $bday = intval($arg['bday']);
      $bmonth = intval($arg['bmonth']);
      $byear = intval($arg['byear']);
      $ws=[];
      $_gdk=array_keys(Load::$conf['gender']);
      $arg['relate']=intval($arg['relate']);
      if(!in_array($arg['gender'],$_gdk))
      {
        $ajax->alert('กรุณาเลือกเพศ');
      }
      elseif(!isset(Load::$conf['relate'][$arg['relate']]))
      {
        $ajax->alert('กรุณาเลือกสถานะความสัมพันธ์');
      }
      elseif(($bday<1||$bday>31)||($bmonth<1||$bmonth>12)||($byear<date('Y')-110||$byear>date('Y')-10))
      {
        $ajax->alert('กรุณาเลือกวันเดือนปีเกิด');
      }
      elseif(strval($arg['prov'])=='')
      {
        $ajax->alert('กรุณาเลือกจังหวัด');
      }
      else
      {
        $user->update(Load::$my['_id'],['$set'=>[
                                              'if.gd'=>$arg['gender'],
                                              'if.bd'=>Load::Time()->from($byear.'-'.substr('0'.$bmonth,-2).'-'.substr('0'.$bday,-2)),
                                              'if.bdk'=>strval(intval($bmonth).'-'.intval($bday)),
                                              'if.pr'=>intval($arg['prov']),
                                              'if.rl'=>$arg['relate'],
                                              ]]);
        $ajax->script('setTimeout(function(){window.location.href="/settings";},2000)');
        $ajax->alert('แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว');
      }
    }
    elseif($arg['setting']=='password')
    {
      $len=mb_strlen(trim($arg['password_new']),'utf-8');
      $u=$db->findOne('user',['_id'=>Load::$my['_id']],['pw'=>1]);
      if(trim($arg['password_new'])!=$arg['password_new'])
      {
        $ajax->alert('ไม่สามารถใช้งานรหัสผ่านนี้ได้');
      }
      if($len<6||$len>30)
      {
        $ajax->alert('รหัสผ่านต้องมีความยาว 6-30 ตัวอักษร');
      }
      elseif($arg['password_new']!=$arg['password_confirm'])
      {
        $ajax->alert('กรุณายืนยันรหัสผ่านให้ถูกต้อง');
      }
      elseif(md5(md5($arg['password_old']))!=$u['pw'])
      {
        $ajax->alert('รหัสผ่านเดิมไม่ถูกต้อง');
      }
      else
      {
        $user->update(Load::$my['_id'],['$set'=>['pw'=>md5(md5($arg['password_new']))]]);
        $ajax->alert('แก้ไขรหัสผ่านเรียบร้อยแล้ว');
        $mail=Load::Mail();
        Load::$core->assign('pass',$arg['password_new']);
        $mail->message=Load::$core->fetch('my/settings.password.mail');
        $mail->subject='ข้อมูลรหัสผ่านใหม่';
        $mail->to=Load::$my['em'];
        $mail->send();
        $ajax->script('setTimeout(function(){window.location.href="/settings";},2000)');
      }
    }
    elseif($arg['setting']=='delete')
    {
      $u=$db->findOne('user',['_id'=>Load::$my['_id']],['pw'=>1]);
      if(md5(md5($arg['password_old']))!=$u['pw'])
      {
        $ajax->alert('รหัสผ่านไม่ถูกต้อง');
      }
      elseif(Load::$my['am'])
      {
        $ajax->alert('ไอดีนี้ไม่สามารถยกเลิกได้ กรุณาติดต่อ support@jarm.com');
      }
      else
      {
        $db=Load::DB();
        Load::User()->update(Load::$my['_id'],['$set'=>['st'=>2]]);

        $db->update('video',['u'=>Load::$my['_id']],['$set'=>['dd'=>Load::Time()->now()]],['multiple'=>true]);
        $db->update('forum',['u'=>Load::$my['_id']],['$set'=>['dd'=>Load::Time()->now()]],['multiple'=>true]);

        $db->update('user',[],['$pull'=>['ct.ig'=>Load::$my['_id'],'ct.bl'=>Load::$my['_id'],'ct.bl2'=>Load::$my['_id'],'ct.fr'=>Load::$my['_id'],'ct.fq'=>Load::$my['_id']]],['multiple'=>true]);

        $ajax->redirect(['oauth','/logout']);
      }
    }
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
          $mail->message = Load::$core->fetch('my/settings.confirm.mail');
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
        $mail->message = Load::$core->fetch('my/settings.confirm.mail');
        $mail->send();
        $ajax->alert('ระบบทำการส่งข้อมูลการยืนยันไปยัง '.Load::$my['em'].' แล้ว');
      }
    }
  }

  public function changeemail($arg)
  {
    $db=Load::DB();
    $ajax=Load::Ajax();
    $email=strtolower($arg['email']);

    $invalid_domain=require(__CONF.'invalid-domain.php');

    $domain2=explode('@', $email);
    $domain = array_pop($domain2);

    if($email==Load::$my['em'])
    {
      $ajax->alert('คุณใช้อีเมล์นี้เรียบร้อยแล้ว');
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $ajax->alert('กรุณากรอกอีเมล์ให้ถูกต้อง');
    }
    elseif(strpos($email,'facebook')>-1)
    {
      $ajax->alert('ไม่สามารถใช้อีเมล์ '.$email.' นี้ได้');
    }
    elseif(in_array($domain, $invalid_domain))
      {
        $error['email'] = 'ไม่สามารถใช้งานอีเมล์นี้ได้';
     }
    elseif($db->count('user',['em'=>$email]))
    {
      $ajax->alert('อีเมล์นี้มีผู้ใช้งานแล้ว');
    }
    else
    {
      if($last = $db->findOne('user',['_id'=>Load::$my['_id']],['ec'=>1,'st'=>1]))
      {
        $c=0;
        $mail = Load::Mail();
        $mail->to=$email;
        $mail->subject = 'ยืนยันการแก้ไขอีเมล์ - Jarm Socail Network ของคนไทย';
        Load::$core->assign('u',Load::$my);

        $p=strtolower(substr(md5(Load::$my['_id'].'-'.$email),5,15));
        Load::$core->assign('code',$p);
        Load::$core->assign('email',$email);
        if($last['ec'])
        {
          $c = intval($last['ec']['c']);
          if($last['ec']['t'] && ($c>3) && (Load::Time()->sec($last['ec']['t']) > (time()-3600)))
          {
            $ajax->alert('คุณมีการร้องขอส่งอีเมล์มากเกินไป กรุณารอ 1ชมเพื่อดำเนินการใหม่อีกครั้ง');
          }
          else
          {
            $mail->message = Load::$core->fetch('my/settings.change.mail');
            $mail->send();
            Load::User()->update(Load::$my['_id'],['$set'=>['ec.c'=>($c+1),'ec.p'=>$p,'ec.em'=>$email,'ec.t'=>Load::Time()->now()]]);
            $ajax->alert('ระบบทำการส่งข้อมูลการยืนยันไปยัง '.$email.' แล้ว');
          }
        }
        else
        {
          Load::User()->update(Load::$my['_id'],['$set'=>['ec'=>['c'=>0,'p'=>$p,'em'=>$email,'t'=>Load::Time()->now()]]]);
          $mail->message = Load::$core->fetch('my/settings.change.mail');
          $mail->send();
          $ajax->alert('ระบบทำการส่งข้อมูลการยืนยันไปยัง '.$email.' แล้ว');
        }
      }
    }
  }
}
?>
