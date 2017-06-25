<?php
namespace Jarm\App\Oauth;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'ระบบควบคุม | Jarm.com',
      'description'=>'ระบบควบคุม | Jarm.com',
      'keywords'=>'oauth, jarm',
    ]);
  }

  public function _home()
  {
    return ['move'=>'/login'];
  }

  public function _login()
  {
    Load::$core->data['title']='ล็อคอิน';
    Load::$core->data['description']='ล็อคอิน - สังคมออนไลน์ของคนไทย';
    Load::$core->data['keywords']='ล็อคอิน, login, signin, สังคมออนไลน์';

    #Load::sesscookie();

    $this->logined();

    $path=(Load::$path[1]??'');
    if($path=='facebook')
    {
      $fb = new \Facebook\Facebook([
        'app_id' => Load::$conf['social']['facebook']['appid'],
        'app_secret' => Load::$conf['social']['facebook']['secret'],
        'default_graph_version' => 'v2.9',
        'persistent_data_handler'=>new \Jarm\App\Facebook_Helper()
      ]);

      if(isset($_GET['code']))
      {
        $helper = $fb->getRedirectLoginHelper();
        try {
          $accessToken = $helper->getAccessToken();
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
          die('Graph returned an error: ' . $e->getMessage());
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
          die('Facebook SDK returned an error: ' . $e->getMessage());
        }

        if($accessToken)
        {
          $redirect_uri='';
          $me = $fb->get('/me?fields=id,name,email,verified', $accessToken)->getDecodedBody();
          $me['email']=trim(strtolower($me['email']));
          $me['id']=strval(trim($me['id']));
          $me['name']=trim($me['name']);
          $value=[];
          $user=Load::User();
          if(!$me['verified'])
          {
            Load::move('/login?'.($redirect_uri?'redirect_uri='.urlencode($redirect_uri).'&':'').'error=facebook-verified&email='.$me['email']);
          }
          elseif(strpos($me['email'],'facebook')>-1)
          {
            Load::move('/login?'.($redirect_uri?'redirect_uri='.urlencode($redirect_uri).'&':'').'error=facebook-email&email='.$me['email']);
          }
          elseif($me['email'])
          {
            $db=Load::DB();
            $user=Load::User();
            if($u=$db->findOne('user',['em'=>$me['email']],Load::User()->fields))
            {
              unset($u['pw']);
              Load::Session()->set($u,false);
              Load::move('/login?'.($redirect_uri?'redirect_uri='.urlencode($redirect_uri):''));
            }
            else
            {
              Load::move('/login?error=invalid-email&email='.$me['email']);
            }
          }
          else
          {
            Load::move('/login?'.($redirect_uri?'redirect_uri='.urlencode($redirect_uri).'&':'').'error=empty');
          }
        }
      }
      Load::move($fb->getRedirectLoginHelper()->getLoginUrl(Load::uri(['oauth','/login/facebook']), ['email']));
    }
    elseif($path=='google')
    {
      require_once(_PHP.'Vendor/autoload.php');
      $client = new \Google_Client();
      $client->setApplicationName("Login with Google Account");
      $client->setClientId(Load::$conf['social']['google']['appid']);
      $client->setClientSecret(Load::$conf['social']['google']['secret']);
      //$client->setAccessType('online');
      $client->setAccessType('offline');
      $client->setScopes(['https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile']);
      $client->setRedirectUri(Load::uri(['oauth','/login/google']));
      if (isset($_GET['code']))
      {
        $client->authenticate($_GET['code']);
        if ($client->getAccessToken())
        {
          $oauth2 = new \Google_Service_Oauth2($client);
          $me = $oauth2->userinfo->get();
          if($me->email)
          {
            $me['email']=strtolower(trim($me->email));
            $db=Load::DB();
            $user=Load::User();
            if($u=$db->findOne('user',['em'=>$me['email']],Load::User()->fields))
            {
              $gg=['id'=>$me->id,'name'=>$me->name,'img'=>strval($me->picture)];
              Load::User()->update($u['_id'],['$set'=>['sc.gg'=>$gg]]);
              Load::Session()->set($u,false);
              Load::move('/login?'.($redirect_uri?'redirect_uri='.urlencode($redirect_uri):''));
            }
            else
            {
              Load::move('/login?error=invalid-email&email='.$me['email']);
            }
          }
          else
          {
            Load::move('/login?'.($redirect_uri?'redirect_uri='.urlencode($redirect_uri).'&':'').'error=empty');
          }
        }
      }
      else
      {
        $client->setState(mt_rand());
        Load::move($client->createAuthUrl());
      }
    }

    if(isset($_POST['type'])&&$_POST['type']=='login')
    {
      if(trim($_POST['email'])&&trim($_POST['password']))
      {
        $db=Load::DB();
        $fields=Load::User()->fields;
        $fields['pw']=1;
        if($u=$db->findOne('user',['em'=>strtolower(trim($_POST['email']))],$fields))
        {
          if($u['pw']==md5(md5($_POST['password'])))
          {
            $u['aways']=intval($_POST['aways']);
            unset($u['pw']);
            Load::Session()->set($u,false);
            Load::move(URI.($_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:''));
          }
          else
          {
            Load::$core->assign('error','รหัสผ่านไม่ถูกต้อง');
          }
        }
        else
        {
          Load::$core->assign('error','อีเมล์ไม่ถูกต้อง');
        }
      }
    }

    Load::Ajax()->register(['forget'],$this);
    return Load::$core
      ->assign('q',$_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:'')
      ->fetch('oauth/login');
  }

  public function logined()
  {
    if(Load::$my)
    {
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
        Load::move(['my']);
      }
    }
  }

  public function forget($arg)
  {
    $ajax=Load::Ajax();
    $email = strtolower(trim($arg['email']));
    $db=Load::DB();
    if($e=$db->findOne('user',['em'=>$email]))
    {
      $status=intval($e['st']);
      if($status==0||$status==1)
      {
        if($u = Load::User()->get($e['_id'],$e))
        {
          $forget=strtolower(substr(md5(rand(1,999999)),5,10));
          Load::User()->update($e['_id'],['$set'=>['fg'=>$forget]]);
          $mail = Load::Mail();
          $mail->to=$e['em'];
          $mail->subject = 'คุณทำการแจ้งขอเปลี่ยนรหัสผ่านสำหรับใช้งาน Jarm - โซเชียลเน็ทเวิร์คสัญชาติไทย';
          Load::$core->assign('forget',$forget);
          Load::$core->assign('u',$u);
          $mail->message = Load::$core->fetch('oauth/login.forget');
          $mail->send();
          $ajax->alert('ระบบทำการส่งข้อมูลการขอเปลี่ยนรหัสผ่านไปยังอีเมล์ของคุณแล้ว');
        }
      }
      else
      {
        $ajax->alert('อีเมล์นี้ไม่สามารถใช้งานได้');
      }
    }
    else
    {
      $ajax->alert('ไม่มีอีเมล์นี้อยู่ในระบบ');
    }
  }

  public function get_error($er)
  {
    switch ($er) {
      case 'invalid-email':
        return 'ไม่มีอีเมล์ '.$_GET['email'].' ในระบบ';
      case 'empty':
        return 'ระบบไม่สามารถค้นหาอีเมล์ของคุณได้';
      case 'facebook-email':
        return 'ไม่สามารถใช้งานอีเมล์ @facebook.com ได้';
      case 'facebook-verified':
        return 'อีเมล์ '.$_GET['email'].' ยังไม่ได้ยืนยันการใช้งาน facebook';
      default:
        return $er;
    }
  }
/*

  'home-banner'=>'home-banner',
  'user'=>'user',
  'banner'=>'banner',
  'job'=>'job',
  'live'=>'live',
*/
}
?>
