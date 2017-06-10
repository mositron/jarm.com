<?php

Load::$conf['social']['facebook']['appid']='520600121372730';

define('APP_VERSION','1.0');




$serv=array(
						''=>'home',
						'apps'=>'apps',
						'new'=>'new',
						'recent'=>'recent',
						'share'=>'share',
						'item'=>'item',
						'view'=>'view',
);

$cate=[];

Load::$core->assign('cate',$cate);
if(isset($serv[Load::$path[0]]))
{
	require_once(__DIR__.'/mobile.cooked.'.$serv[Load::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.cooked.home.php');
}


echo Load::$core->fetch('cooked');
exit;
?>