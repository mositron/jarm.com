<?php

define('APP_VERSION','1.0');



$serv=array(
						''=>'home',
						'apps'=>'apps',
);


if(isset($serv[Load::$path[0]]))
{
	require_once(__DIR__.'/mobile.gold.'.$serv[Load::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.gold.home.php');
}


echo Load::$core->fetch('gold');
exit;
?>