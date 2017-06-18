<?php


_::ajax()->register(array('getpet','showpet','usepet','sellpet'));

$db=_::db();
$template=_::template();


_::$meta['title'] = 'Lionica - เกม  เกมต่อสู้ เกมสัตว์เลี้ยง เกมเก็บเลเวล เกมปลูกผัก เกมบนเว็บบราวเซอร์';
_::$meta['description'] = 'เกมต่อสู้ เก็บเลเวล ปลูกผัก เลี้ยงสัตว์ เล่นง่าย เล่นฟรี ไม่ต้องเติมเงิน ไม่ต้องโหลด เล่นบนเว็บบราวเซอร์ได้ทันที';
_::$meta['keywords'] = 'เกมสัตว์เลี้ยง, เกมส์บนเว็บ, สัตว์เลี้ยง, เกมส์, เกม, เกมผลูกผัก, เกมเก็บเลเวล';

//$flash=$db->find('game',array('dd'=>array('$exists'=>false),'pl'=>1),array('_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'t2'=>1,'tm'=>1),array('sort'=>array('_id'=>-1),'limit'=>8));

//$template->assign('toplevel',$db->find('pet',array('dd'=>array('$exists'=>false),'job'=>array('$gte'=>1),'lv'=>array('$gte'=>2)),array('_id'=>1,'ty'=>1,'n'=>1,'hp'=>1,'mhp'=>1,'mp'=>1,'mmp'=>1,'xp'=>1,'mxp'=>1,'lv'=>1,'u'=>1,'job'=>1,'atk'=>1,'def'=>1),array('sort'=>array('lv'=>-1,'xp'=>-1,'dl'=>1),'limit'=>100)));

	

$topic=$db->find('forum',array('c'=>array('$in'=>array(17)),'dd'=>array('$exists'=>false)),array('_id'=>1,'t'=>1,'ds'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>array('$slice'=>-1),'da'=>1),array('sort'=>array('ds'=>-1),'limit'=>10),false);
$template->assign('topic',$topic);
$template->assign('user',_::user());

_::$content=$template->fetch('lionica.home');

?>