<?php
define('FACEBOOK_SDK_V4_SRC_DIR', ROOT.'handlers/facebook/Facebook/');
require ROOT.'handlers/facebook/autoload.php';

use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSDKException;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
//require ROOT.'handlers/facebook/jarm_FacebookRedirectLoginHelper.php';

FacebookSession::setDefaultApplication(Load::$conf['social']['facebook']['appid'], Load::$conf['social']['facebook']['secret']);



if(Load::$path[0]=='facebook' && isset($_GET['code']))
{
	$helper = new FacebookRedirectLoginHelper('https://chat.jarm.com/room/'.$chat->room.'/?call=facebook');
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
		$uid = $session2->getSessionInfo()->asArray['user_id'];

		//$p = $facebook->api('me/accounts');



		if(!count($fbpage))
		{
			Load::move('/settings/facebook');
		}

	}
}
?>
