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

require_once ROOT.'handlers/google/Google_Client.php';
require_once ROOT.'handlers/google/contrib/Google_PlusService.php';
$client = new Google_Client();
$client->setApplicationName("Login to housion.com with Google API");
$client->setClientId(Load::$conf['social']['google']['appid']);
$client->setClientSecret(Load::$conf['social']['google']['secret']);
$client->setAccessType('online');
$client->setScopes(['https://www.googleapis.com/auth/plus.login', 'https://www.googleapis.com/auth/plus.me', 'https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile']);
$client->setRedirectUri(Load::uri(['team','/oauth/google']));

$plus = new Google_PlusService($client);

if (isset($_GET['code']))
{
  $redirect_uri='';
  if($_SESSION['ruri'])
  {
    $redirect_uri=$_SESSION['ruri'];
    $_SESSION['ruri']='';
  }

  $client->authenticate();
  if ($client->getAccessToken())
  {
    $me = $plus->people->get('me');
    if($me['emails']&&$me['emails'][0]['value']&&$me['emails'][0]['type']=='account')
    {
      $me['email']=strtolower(trim($me['emails'][0]['value']));
      $db=Load::DB();
      $user=Load::User();
      if($u=$db->findOne('team_user',['email'=>$me['email']]))
      {
        if(!$u['gg'])
        {
          $db->update('team_user',['_id'=>$u['_id']],['$set'=>['gg'=>$me['id']]]);
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
else
{
  if($_GET['redirect_uri'])
  {
    $_SESSION['ruri']=$_GET['redirect_uri'];
  }
  $client->setState(mt_rand());
  Load::move($client->createAuthUrl());
}
?>
