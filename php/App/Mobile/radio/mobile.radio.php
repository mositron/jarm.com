<?php

define('APP_VERSION','2.2');



$serv=array(
						''=>'home',
						'apps'=>'apps',
);


if(isset($serv[Load::$path[0]]))
{
	require_once(__DIR__.'/mobile.radio.'.$serv[Load::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.radio.home.php');
}


echo Load::$core->fetch('radio');
exit;
?>