<?php

define('APP_VERSION','1.0');



$serv=[
						''=>'home',
						'gas-type'=>'gas-type',
						'gas-brand'=>'gas-brand',
						'lpg-type'=>'lpg-type',
						'lpg-brand'=>'lpg-brand',
						'ngv'=>'ngv',
						'apps'=>'apps',
];


if(isset($serv[Load::$path[0]]))
{
	$db=Load::DB();


	$brand_gas=[
								'ปตท PTT',
								'บางจาก BCP',
								'เชลล์ Shell',
								'เอสโซ่ Esso',
								'เชฟรอน Chevron',
								'ไออาร์พีซี IRPC',
								'พีที PT',
								'ซัสโก้ Susco',
								'เพียว Pure',
								'ปิโตรนาส Petronas'
	];
	$type_gas=[
							'แก๊สโซฮอล 95',
							'แก๊สโซฮอล E20',
							'แก๊สโซฮอล E85',
							'แก๊สโซฮอล 91',
							'เบนซิน 95',
							'ดีเซลหมุนเร็ว',
							'ดีเซลหมุนเร็ว พรีเมียม'
	];
	/*

		$brand_gas=[
									'ptt'=>['t'=>'ปตท PTT','l'=>['s1'=>0,'s2'=>1,'s3'=>2,'s4'=>3,'b1'=>4,'b2'=>5,'d1'=>6,'d2'=>8,'g'=>7]],
									'bcp'=>['t'=>'บางจาก BCP','l'=>['s1'=>0,'s2'=>1,'s3'=>2,'s4'=>3,'b1'=>4,'b2'=>5,'d1'=>6,'d2'=>8,'g'=>7]],
									'shell'=>['t'=>'เชลล์ Shell','l'=>['s1'=>0,'s2'=>1,'s3'=>2,'s4'=>3,'b1'=>4,'b2'=>5,'d1'=>6,'d2'=>7]],
									'esso'=>['t'=>'เอสโซ่ Esso','l'=>['s1'=>0,'s2'=>1,'s3'=>2,'s4'=>3,'b1'=>4,'b2'=>5,'d1'=>6,'d2'=>7]],
									'chevron'=>['t'=>'เชฟรอน Chevron','l'=>['s1'=>0,'s2'=>1,'s3'=>2,'s4'=>3,'b1'=>4,'b2'=>5,'d1'=>6,'d2'=>7]],
									'irpc'=>['t'=>'ไออาร์พีซี IRPC','l'=>['s1'=>0,'s2'=>1,'s3'=>2,'s4'=>3,'b1'=>4,'b2'=>5,'d1'=>6,'d2'=>7]],
									'pt'=>['t'=>'พีที PT','l'=>['s1'=>0,'s2'=>1,'s3'=>2,'s4'=>3,'b1'=>4,'b2'=>5,'d1'=>6,'d2'=>7]],
									'susco'=>['t'=>'ซัสโก้ Susco','l'=>['s1'=>0,'s2'=>1,'s3'=>2,'s4'=>3,'b1'=>4,'b2'=>5,'d1'=>6,'d2'=>7]],
									'pure'=>['t'=>'เพียว Pure','l'=>['s1'=>0,'s2'=>1,'s3'=>2,'s4'=>3,'b1'=>4,'b2'=>5,'d1'=>6,'d2'=>7]],
									//'ปิโตรนาส Petronas'
		];
		$type_gas=[
								's1'=>'แก๊สโซฮอล 95',
								's2'=>'แก๊สโซฮอล E20',
								's3'=>'แก๊สโซฮอล E85',
								's4'=>'แก๊สโซฮอล 91',
								'b1'=>'เบนซิน 95',
								'b2'=>'เบนซิน 91',
								'd1'=>'ดีเซล',
								'd2'=>'ดีเซลหมุนเร็ว พรีเมียม',
								'g'=>'แก๊ส NGV',
		];
		*/
	$type_lpg=[
							'ถังขนาด 4 กิโลกรัม',
							'ถังขนาด 7 กิโลกรัม',
							'ถังขนาด 11.5 กิโลกรัม',
							'ถังขนาด 13.5 กิโลกรัม',
							'ถังขนาด 15 กิโลกรัม',
							'ถังขนาด 48 กิโลกรัม'
	];
	$brand_lpg=[
								'PTT ปตท',
								'UNIQUE GAS แก๊ส',
								'SIAM GAS แก๊ส',
								'PICNIC ปิคนิคแก๊ส',
								'WORLD GAS เวิลด์แก๊ส',
								'V 2 GAS แก๊ส'
	];


	Load::$core->assign('brand_gas',$brand_gas);
	Load::$core->assign('type_gas',$type_gas);
	Load::$core->assign('brand_lpg',$brand_lpg);
	Load::$core->assign('type_lpg',$type_lpg);


	Load::$core->assign('msg',$db->findone('msg',['_id'=>'oil']));

	require_once(__DIR__.'/mobile.oil.'.$serv[Load::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.oil.home.php');
}


echo Load::$core->fetch('oil');
exit;
?>
