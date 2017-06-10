<?php

Load::$core->data['title'] = 'Jarm Mobile';
Load::$core->data['description'] = '';
Load::$core->data['keywords'] = '';

# check session/login


$apps=array(
						'thdict'=>array(
												't'=>'พจนานุกรม+ ฉบับราชบัณฑิตยสถาน',
												'd'=>'พจนานุกรม+ ฉบับราชบัณฑิตยสถาน แบบออฟไลน์',
												'i'=>FILES_CDN.'img/mobile/app-thdict.png'
						),
						'dream'=>array(
												't'=>'ดูดวง ทำนายฝัน+',
												'd'=>'ดูดวงจากความฝัน หาเลขเด็ดจากฝัน ทำนายความฝัน',
												'i'=>FILES_CDN.'img/mobile/app-dream.png'
						),
						'tarot'=>array(
												't'=>'ดูดวง ไพ่ยิปซี+',
												'd'=>'ดูดวงรายวัน ดูดวงรายเดือน ด้วยไพ่ยิปซี',
												'i'=>FILES_CDN.'img/mobile/app-tarot.png'
						),
						'seamsee'=>array(
												't'=>'ดูดวง เซียมซี+',
												'd'=>'ดูดวงด้วยเซียมซี จากหลากหลายวัดชื่อดัง มีให้เลือกถึง 18สถานที่',
												'i'=>FILES_CDN.'img/mobile/app-seamsee.png'
						),
						'drama'=>array(
												't'=>'ละครย้อนหลัง+',
												'd'=>'ดูละคร ดูซิทคอม ย้อนหลังทันที อัพเดทรวดเร็วทันใจ',
												'i'=>FILES_CDN.'img/mobile/app-drama.png'
						),
						'radio'=>array(
												't'=>'วิทยุออนไลน์+',
												'd'=>'ฟังเพลง ฟังวิทยุออนไลน์ ได้ทันทีโดยไม่ต้องติดตั้งอะไรเพิ่มเติม',
												'i'=>FILES_CDN.'img/mobile/app-radio.png'
						),
						'cooked'=>array(
												't'=>'กินไรดี+',
												'd'=>'หากคิดไม่ออกว่า เที่ยงนี้จะกินอะไรดี แอพนี้ช่วยคุณได้ หรือจะแชร์ต่อให้เพื่อนก็ได้',
												'i'=>FILES_CDN.'img/mobile/app-cooked.png'
						),
						'fbimage'=>array(
												't'=>'รูปภาพคำคม+',
												'd'=>'รวมรูปภาพ คำคมโดนใจ ที่ผ่านการคัดแล้วจากเพจต่างๆ ให้คุณแชร์ต่อได้ทันที',
												'i'=>FILES_CDN.'img/mobile/app-fbimage.png'
						),
						'matching'=>array(
												't'=>'เกมจับคู่+',
												'd'=>'เกมจับคู่(ภาพเหมือน) ออนไลน์ สะสมคะแนน เก็บเลเวล แชร์เฟสบุ๊ค เล่นง่ายๆ',
												'i'=>FILES_CDN.'img/mobile/app-matching.png'
						),
						'football'=>array(
												't'=>'Jarm Football+',
												'd'=>'ข่าวฟุตบอล ผลบอล วิเคราะห์บอล โปรแกรมบอลพรุ่งนี้ ตารางคะแนน',
												'i'=>FILES_CDN.'img/mobile/app-football.png'
						),
						'sticker'=>array(
												't'=>'Sticker+',
												'd'=>'รวมรูปภาพสติกเกอร์จาก Line, Facebook และอื่นๆ',
												'i'=>FILES_CDN.'img/mobile/app-sticker.png'
						),
						'guess'=>array(
												't'=>'เกมทายใจ+',
												'd'=>'เกมทายใจ โพสไปยังหน้า wall บน Facebook',
												'i'=>FILES_CDN.'img/mobile/app-guess.png'
						),
						'lotto'=>array(
												't'=>'ตรวจหวย+',
												'd'=>'ตรวจหวย สลากกินแบ่งรัฐบาล หวยหุ้น เลขเด็ด',
												'i'=>FILES_CDN.'img/mobile/app-lotto.png'
						),
						'chat'=>array(
												't'=>'Jarm Chat+',
												'd'=>'แชท ห้องแชท คุยสด แชทหาเพื่อน แชทรูม',
												'i'=>FILES_CDN.'img/mobile/app-chat.png'
						),
						'music'=>array(
												't'=>'เพลงใหม่+',
												'd'=>'เพลง เพลงใหม่ เนื้อเพลงใหม่ มิวสิควิดีโอ MV MP3 ข่าววงการเพลง',
												'i'=>FILES_CDN.'img/mobile/app-music.png'
						),
						'oil'=>array(
												't'=>'ราคาน้ำมัน+',
												'd'=>'เช็คราคาน้ำมันล่าสุด แก๊สโซฮอล, เบนซิน, ดีเซล, LPG, NGV',
												'i'=>FILES_CDN.'img/mobile/app-oil.png'
						),
						'weather'=>array(
												't'=>'พยากรณ์อากาศ+',
												'd'=>'ตรวจสภาพอาการครบทุกจังหวัดทั่วไป พร้อมพยากรณ์อากาศล่วงหน้า 10 วัน',
												'i'=>FILES_CDN.'img/mobile/app-weather.png'
						),
						'gold'=>array(
												't'=>'ราคาทอง+',
												'd'=>'เช็คราคาทองคำ ทองรูปพรรณ ทองแท่ง ทั้งในประเทศและต่างประเทศ',
												'i'=>FILES_CDN.'img/mobile/app-gold.png'
						),
);


if(Load::$path[0]&&isset($apps[Load::$path[0]]))
{
	$ua = $_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/(.+)com\.doodroid\.'.Load::$path[0].'\/([android|ios]+)\/(.+)/i',$ua))
	{
		define('APP_OS',$ua[2]);
		define('APP_VER',$ua[3]);	
	}
	/*
	if(!defined('APP_OS')||!defined('APP_VER'))
	{
		if(!Load::$my || Load::$my['_id']!=1)
		{
			Load::move('https://play.google.com/store/apps/details?id=com.doodroid.'.Load::$path[0],true);
		}
	}
	*/
}



Load::$core->assign('apps',$apps);

require_once(
									_::run(
													array(
																'' => 'home',
																'link'=>'link',
																'lotto' => 'lotto',
																'oil'=>'oil',
																'gold'=>'gold',
																'chat'=>'chat',
																'guess'=>'guess',
																//'sticker'=>'sticker',
																'football'=>'football',
																'music'=>'music',
																'weather'=>'weather',
																'matching'=>'matching',
																'fbimage'=>'fbimage',
																'cooked'=>'cooked',
																'radio'=>'radio',
																'friend'=>'friend',
																'drama'=>'drama',
																'seamsee'=>'seamsee',
																
																'tv'=>'tv',
																'hidden'=>'hidden',
																'saying'=>'saying',
													),
													true
									)
);

?>