<?php

_::$meta['title'] = 'อันดับสัตว์เลี้ยง เกมสัตว์เลี้ยง เกม Lionica สัตว์เลี้ยง เลี้ยงสัตว์บนเว็บ';
_::$meta['description'] = 'อันดับสัตว์เลี้ยง เกมสัตว์เลี้ยง เลี้ยงสัตว์บนเว็บบ๊อกซ่า เกม Lionica';
_::$meta['keywords'] = 'อันดับสัตว์เลี้ยง เกมสัตว์เลี้ยง, เกมส์เล่นบนเว็บ, สัตว์เลี้ยง, เกมส์, เกม';


$cache=_::cache();
if(!_::$content=$cache->get('ca1','lionica_rank'))
{
	$db=_::db();
	$toplevel=array();
	for($i=1;$i<=4;$i++)
	{
		$toplevel[$i]=$db->find('lionica_char',array('dd'=>array('$exists'=>false),'job'=>$i),array('_id'=>1,'stats'=>1,'n'=>1,'hp'=>1,'mhp'=>1,'mp'=>1,'mmp'=>1,'xp'=>1,'mxp'=>1,'lv'=>1,'u'=>1,'job'=>1,'gender'=>1,'hair'=>1,'color'=>1,'atk'=>1,'def'=>1,'hit'=>1,'free'=>1,'g'=>1),array('sort'=>array('lv'=>-1,'xp'=>-1,'dl'=>1),'limit'=>15));		
	}
	$template=_::template();
	$template->assign('toplevel',$toplevel);
	_::$content=$template->fetch('lionica.rank');
	$cache->set('ca1','lionica_rank',_::$content,false,3600);
}

	



?>