<?php

$ua = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(.+)com\.doodroid\.(.+)\/([android|ios]+)\/(.+)/i',$ua,$d))
{
	define('APP_NAME',$d[2]);
	define('APP_OS',$d[3]);
	define('APP_VER',$d[4]);	
	echo Load::$core->fetch('link');
}
exit;
?>