<?php

define('APP_VERSION','1.0');



$serv=[
						''=>'home',
						'apps'=>'apps',
						'recent'=>'recent',
						'hit'=>'hit',
						'category'=>'category',
						'ref'=>'ref',
						'view'=>'view',
];


$cate=array(
'1'=>['t'=>'สัตว์'],
'2'=>['t'=>'สัตว์ประหลาด'],
'3'=>['t'=>'คน'],
'4'=>['t'=>'พืช'],
'99'=>['t'=>'อื่นๆ']
);

$ref=array(
'fb'=>['t'=>'Facebook'],
'line'=>['t'=>'Line by naver'],
'web'=>['t'=>'Web']
);

Load::$core->assign('cate',$cate);
Load::$core->assign('ref',$ref);
if(isset($serv[Load::$path[0]]))
{
	require_once(__DIR__.'/mobile.sticker.'.$serv[Load::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.sticker.home.php');
}


echo Load::$core->fetch('sticker');
exit;



function getimgname($i)
{
	$a='123456789abcdefghijklmnopqrstuvwxyz';	
	return $a[$i];
}
function getimgkey($a)
{
	return mb_substr(md5($a.':-:sticker'),0,2);
}
?>