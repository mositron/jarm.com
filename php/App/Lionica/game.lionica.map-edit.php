<?php

define('HIDE_SIDEBAR',1);

if(!in_array(_::$my['_id'],array(1,1162)))
{
	_::move(LIONICA_PATH.'/play');
}
//_::$path[1]
$db=_::db();
if(!$map=$db->findone('lionica_maps',array('_id'=>intval(_::$path[1]))))
{
	_::move(LIONICA_PATH);	
}


define('WIDTH',$map['width']);
define('HEIGHT',$map['height']);

_::ajax()->register('setmap');

$block=array('bg'=>array(),'tile'=>array(),'object'=>array());
$sprite=require(__DIR__.'/config/sprite.php');

foreach($sprite['map']['bg'] as $v)
{
	for($i=$v['x'];$i<$v['x']+$v['w'];$i++)
	{
		$block['bg'][$i.'_'.$v['y']]=array('x'=>$i,'y'=>$v['y']);
	}
}

foreach($sprite['map']['tile'] as $v)
{
	for($i=$v['x'];$i<$v['x']+$v['w'];$i++)
	{
		$block['tile'][$i.'_'.$v['y']]=array('x'=>$i*2,'y'=>$v['y']);
	}
}
foreach($sprite['map']['object'] as $v)
{
	$block['object'][$i.'_'.$v['y']]=$v;
}

foreach(array('block','tile','object') as $v)
{
	if(!is_array($map[$v]))
	{
		$map[$v]=array();
	}
}

$monster=array('npc'=>array(),'monster'=>array(),'animal'=>array());
$tmp=require(__DIR__.'/config/life.php');
foreach($tmp as $k=>$v)
{
	if(in_array($v['type'],array('farm','warp')))
	{
		$monster['animal'][$k]=$v;	
	}
	else
	{
		$monster[$v['type']][$k]=$v;
	}
}

$template=_::template();
$template->assign('map',$map);
$template->assign('block',$block);
$template->assign('sprite',$sprite);
$template->assign('monster',$monster);
_::$content=$template->fetch('lionica.map-edit');


function setmap($arg)
{	
	$db=_::db();
	$ajax=_::ajax();
	
	$arg=array(
								'name'=>trim($arg['name']),
								'start'=>array_map('intval',array_map('trim',explode(',',$arg['start']))),
								'bg'=>$arg['bg'],
								'tile'=>$arg['tile'],
								'object'=>$arg['object'],
								'life'=>$arg['life'],
								'block'=>$arg['block']
						);
	
	
	
	$db->update('lionica_maps',array('_id'=>intval(_::$path[1])),array('$set'=>$arg));
	
	
	_::cache()->delete('ca2','lionica_maps_'.intval(_::$path[1]),0);
	
	$ajax->alert('บันทึกข้อมูลเรียบร้อยแล้ว');
	//$ajax->script('setTimeout(function(){window.location.href="'.URL.'"},2000)');
}
?>