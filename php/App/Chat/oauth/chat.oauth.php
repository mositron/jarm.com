<?php




list($s,$p) = explode('.', $_POST['key'], 2);
$sig = base64_decode(strtr($s, '-_', '+/'));
$data = json_decode(base64_decode(strtr($p, '-_', '+/')), true);


if(substr($_POST['pageurl'],0,21)=='https://chat.jarm.com' && substr($_POST['swfurl'],0,50) == 'https://chat.jarm.com/_cdn/chat/chat-stream.swf' && is_numeric($_POST['name']))
{
	Load::DB()->insert('chatroom_key',['k'=>$_GET['key'],'url'=>URL,'g'=>$_GET,'p'=>$_POST,'status'=>200]);
	header($_SERVER["SERVER_PROTOCOL"]." 200 OK");
	header("Status: 200 OK");
	$_SERVER['REDIRECT_STATUS'] = 200;
	echo 200;
	exit;
}

if($sig == hash_hmac('sha256', $p, Load::$conf['chat_key'].$data['_id'], true))
{
	Load::DB()->insert('chatroom_key',['k'=>$_GET['key'],'url'=>URL,'g'=>$_GET,'p'=>$_POST,'status'=>201]);
	header($_SERVER["SERVER_PROTOCOL"]." 200 OK");
	header("Status: 200 OK");
	$_SERVER['REDIRECT_STATUS'] = 200;
	echo 200;
	exit;
}

Load::DB()->insert('chatroom_key',['k'=>$_GET['key'],'url'=>URL,'g'=>$_GET,'p'=>$_POST,'status'=>501]);

header($_SERVER["SERVER_PROTOCOL"]." 200 OK");
header("Status: 200 OK");
$_SERVER['REDIRECT_STATUS'] = 200;
echo 200;
exit;

header($_SERVER["SERVER_PROTOCOL"]." 501 Not Implemented");
header("Status: 501 Not Implemented");
$_SERVER['REDIRECT_STATUS'] = 501;
echo 501;
exit;

?>
