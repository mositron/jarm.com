<?php

define('APP_VERSION','2.1');



$serv=array(
						'' => 'home',
						'home' => 'home',
						'song'=>'song',
						'news'=>'news',
						'apps'=>'apps',
);

if(isset($serv[Load::$path[0]]))
{
	require_once(__DIR__.'/mobile.music.'.$serv[Load::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.music.home.php');
}


echo Load::$core->fetch('music');
exit;
?>