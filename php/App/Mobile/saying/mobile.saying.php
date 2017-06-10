<?php

define('APP_VERSION','1.0');



$serv=[
						''=>'home',
						'apps'=>'apps',
						'recent'=>'recent',
						'search'=>'search',
						'category'=>'category',
						'view'=>'view',
];


$cate=array(
'ก'=>['t'=>'ก','i'=>'1'],
'ข'=>['t'=>'ข','i'=>'2'],
'ฃ'=>['t'=>'ฃ','i'=>'3'],
'ค'=>['t'=>'ค','i'=>'4'],
'ฅ'=>['t'=>'ฅ','i'=>'5'],
'ฆ'=>['t'=>'ฆ','i'=>'6'],
'ง'=>['t'=>'ง','i'=>'7'],
'จ'=>['t'=>'จ','i'=>'8'],
'ฉ'=>['t'=>'ฉ','i'=>'9'],
'ช'=>['t'=>'ช','i'=>'10'],
'ซ'=>['t'=>'ซ','i'=>'11'],
'ฌ'=>['t'=>'ฌ','i'=>'12'],
'ญ'=>['t'=>'ญ','i'=>'13'],
'ฎ'=>['t'=>'ฎ','i'=>'14'],
'ฏ'=>['t'=>'ฏ','i'=>'15'],
'ฐ'=>['t'=>'ฐ','i'=>'16'],
'ฑ'=>['t'=>'ฑ','i'=>'17'],
'ฒ'=>['t'=>'ฒ','i'=>'18'],
'ณ'=>['t'=>'ณ','i'=>'19'],
'ด'=>['t'=>'ด','i'=>'20'],
'ต'=>['t'=>'ต','i'=>'21'],
'ถ'=>['t'=>'ถ','i'=>'22'],
'ท'=>['t'=>'ท','i'=>'23'],
'ธ'=>['t'=>'ธ','i'=>'24'],
'น'=>['t'=>'น','i'=>'25'],
'บ'=>['t'=>'บ','i'=>'26'],
'ป'=>['t'=>'ป','i'=>'27'],
'ผ'=>['t'=>'ผ','i'=>'28'],
'ฝ'=>['t'=>'ฝ','i'=>'29'],
'พ'=>['t'=>'พ','i'=>'30'],
'ฟ'=>['t'=>'ฟ','i'=>'31'],
'ภ'=>['t'=>'ภ','i'=>'32'],
'ม'=>['t'=>'ม','i'=>'33'],
'ย'=>['t'=>'ย','i'=>'34'],
'ร'=>['t'=>'ร','i'=>'35'],
'ฤ'=>['t'=>'ฤ','i'=>'36'],
'ล'=>['t'=>'ล','i'=>'37'],
'ฦ'=>['t'=>'ฦ','i'=>'38'],
'ว'=>['t'=>'ว','i'=>'39'],
'ศ'=>['t'=>'ศ','i'=>'40'],
'ษ'=>['t'=>'ษ','i'=>'41'],
'ส'=>['t'=>'ส','i'=>'42'],
'ห'=>['t'=>'ห','i'=>'43'],
'ฬ'=>['t'=>'ฬ','i'=>'44'],
'อ'=>['t'=>'อ','i'=>'45'],
'ฮ'=>['t'=>'ฮ','i'=>'46'],
);


Load::$core->assign('cate',$cate);
if(isset($serv[Load::$path[0]]))
{
	require_once(__DIR__.'/mobile.saying.'.$serv[Load::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.saying.home.php');
}


echo Load::$core->fetch('saying');
exit;

?>