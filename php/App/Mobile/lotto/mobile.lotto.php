<?php

define('APP_VERSION','1.0');



$serv=array(
						''=>'home',
						'lottery'=>'lottery',
						'lottery-last'=>'lottery-last',
						'set'=>'set',
						'news'=>'news',
						'apps'=>'apps',
);

if(isset($serv[Load::$path[0]]))
{
	require_once(__DIR__.'/mobile.lotto.'.$serv[Load::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.lotto.home.php');
}


echo Load::$core->fetch('lotto');
exit;
?>