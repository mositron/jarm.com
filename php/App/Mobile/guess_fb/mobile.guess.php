<?php

//475719729205676

Load::$conf['social']['facebook']['appid']='475719729205676';

define('APP_VERSION','1.0');



$serv=[
						''=>'home',
						'apps'=>'apps',
						'recent'=>'recent',
						'hit'=>'hit',
						'category'=>'category',
						'game'=>'game',
];

$cate=array(
	1=>['t'=>'การ์ตูน'],
	2=>['t'=>'เกมส์'],
	3=>['t'=>'กีฬา'],
	4=>['t'=>'เพลง ละคร ภาพยนต์'],
	5=>['t'=>'บันเทิง ดารา นักร้อง'],
	6=>['t'=>'รถ ยานพาหนะ'],
	7=>['t'=>'กิจกรรม'],
	8=>['t'=>'ไลฟ์สไตล์'],
	9=>['t'=>'ความรัก'],
	10=>['t'=>'ตลก ขำขัน กวนๆ'],
	11=>['t'=>'ดวง ทำนาย พยากรณ์'],
	99=>['t'=>'อื่นๆ']
);
Load::$core->assign('cate',$cate);
if(isset($serv[Load::$path[0]]))
{
	require_once(__DIR__.'/mobile.guess.'.$serv[Load::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.guess.home.php');
}


echo Load::$core->fetch('guess');
exit;
?>