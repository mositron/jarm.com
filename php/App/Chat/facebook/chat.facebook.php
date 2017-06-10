<?php
if(Load::$path[0]=='logout')
{
	setcookie('bzc_session','',time()+2592000,'/','chat.jarm.com',false,true);
	Load::move('/');
}

session_start();

define('FACEBOOK_SDK_V4_SRC_DIR', ROOT.'handlers/facebook/Facebook/');
require ROOT.'handlers/facebook/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSDKException;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
//use jarm_FacebookRedirectLoginHelper;

FacebookSession::setDefaultApplication(Load::$conf['social']['facebook']['appid'], Load::$conf['social']['facebook']['secret']);

$helper = new FacebookRedirectLoginHelper('https://chat.jarm.com/facebook/?redirect_uri='.urlencode(isset($_GET['redirect_uri'])?$_GET['redirect_uri']:'https://chat.jarm.com/lobby'));

if(isset($_GET['code']))
{
	try {
	  $session = $helper->getSessionFromRedirect();
	} catch(FacebookRequestException $ex) {
		echo 'e1: '.$ex->getMessage();
	  // When Facebook returns an error
	} catch(\Exception $ex) {
		echo 'e2: '.$ex->getMessage();
	  // When validation fails or other local issues
	}

	if($session)
	{
		//echo '2';
		$token = $session->getToken();
		$session2 = new FacebookSession($token);
		$me = (new FacebookRequest($session, 'GET', '/me'))->execute()->getGraphObject();

		$data = array(
								'logged'=>1,
								'_id'=>strval($me->getProperty('id')),
								'name'=>$me->getProperty('name'),
						);
	//	echo '<pre>';
		$db=Load::DB();
		if($u=$db->findone('chatroom_user',['u'=>$data['_id']]))
		{
			if((!$u['nd']) || ($u['nd']!=$data['name']))
			{
				$db->update('chatroom_user',['u'=>$data['_id']],['$set'=>['nd'=>$data['name']]]);
			}
			if($u['n'])
			{
				$data['name']=$u['n'];
			}
		}
		else
		{
			$db->insert('chatroom_user',array('u'=>$data['_id'],'n'=>$data['name'],'nd'=>$data['name'],'bu'=>1000,'du'=>Load::Time()->now()));
		}
		_setsession($data);
		//print_r($me);
		//print_r($data);

		if(isset($_GET['redirect_uri'])&&!empty($_GET['redirect_uri']))
		{
			Load::move($_GET['redirect_uri']);
		}
		else {
			Load::move('/lobby');
		}
	}
}
else {
	Load::move($helper->getLoginUrl());
}

exit;
?>
