<?php
if (!session_id())
{
    session_start();
}

# check session/login


if(team::$my)
{
  Load::move(['team','/oauth?'.$_SERVER['QUERY_STRING']]);
}

define('FACEBOOK_SDK_V4_SRC_DIR', ROOT.'handlers/facebook/Facebook-v4-5/');
require ROOT.'handlers/facebook/Facebook-v4-5/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => Load::$conf['social']['facebook']['appid'],
  'app_secret' => Load::$conf['social']['facebook']['secret'],
  'default_graph_version' => 'v2.5',
  'persistent_data_handler'=>'session'
]);

if($_GET['code'])
{
  $helper = $fb->getRedirectLoginHelper();
  try {
    $accessToken = $helper->getAccessToken();
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }

  if($accessToken)
  {
    $redirect_uri='';
    if($_SESSION['ruri'])
    {
      $redirect_uri=$_SESSION['ruri'];
      $_SESSION['ruri']='';
    }
    $me = $fb->get('/me?fields=id,name,email,verified', $accessToken)->getDecodedBody();
    $me['email']=trim(strtolower($me['email']));
    $me['id']=strval(trim($me['id']));
    $me['name']=trim($me['name']);
    $value=[];
    $user=Load::User();
    if(!$me['verified'])
    {
      Load::move('/oauth?'.($redirect_uri?'redirect_uri='.urlencode($redirect_uri).'&':'').'error=verified');
    }
    elseif(strpos($me['email'],'facebook')>-1)
    {
      Load::move('/oauth?'.($redirect_uri?'redirect_uri='.urlencode($redirect_uri).'&':'').'error=email-facebook');
    }
    elseif($me['email'])
    {
      $db=Load::DB();
      $user=Load::User();
      if($u=$db->findOne('team_user',['email'=>$me['email']]))
      {
        if(!$u['fb'])
        {
          $db->update('team_user',['_id'=>$u['_id']],['$set'=>['fb'=>$me['id']]]);
        }
        team::session()->set($u,false);
        Load::move('/oauth?'.($redirect_uri?'redirect_uri='.urlencode($redirect_uri):''));
      }
      else
      {
        Load::move('/oauth?error=invalid-user&email='.$me['email']);
      }
    }
    else
    {
      Load::move('/oauth?'.($redirect_uri?'redirect_uri='.urlencode($redirect_uri).'&':'').'error=empty');
    }
  }
}

if($_GET['redirect_uri'])
{
  $_SESSION['ruri']=$_GET['redirect_uri'];
}
Load::move($fb->getRedirectLoginHelper()->getLoginUrl(Load::uri(['team','/oauth/facebook']), ['email']));
?>
