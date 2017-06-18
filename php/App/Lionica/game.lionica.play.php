<?php
_::session()->logged();

/*
$j=date('j');
$g=date('G');
$n=date('n');
if($n==8&&(($g>=12&&$j==26)||($j>26&&$j<31)||($g<12&&$j==31)))
{
	_::move('http://game.boxza.com/forum/topic/10766');	
}
*/
/*
if(!in_array(_::$my['_id'],array(1,6,1162,19617,57290,19255,33127)))
{
	_::move('http://game.boxza.com/forum/topic/10766');
}
*/

_::ajax()->register(array('newchar','play','delete','socket','select'));


define('HIDE_SIDEBAR',1);



if(!_::$my['st'] || _::$my['st']<1)
{
	_::move('http://boxza.com/verify');	
}


$template->assign('lionica',getchar());
$template->assign('job',require(CONFIG_PATH.'job.php'));
$template->assign('npc',require(CONFIG_PATH.'life.php'));
_::$content=$template->fetch(LIONICA.'.play');



function getchar()
{
	$db=_::db();
	$template=_::template();
	$template->assign('char',$db->find('lionica_char',array('u'=>_::$my['_id'],'dd'=>array('$exists'=>false)),array(),array('sort'=>array('_id'=>1))));
	$template->assign('job',require(CONFIG_PATH.'job.php'));
	return $template->fetch('lionica.play.character');
}

function select()
{
	$ajax=_::ajax();
	$ajax->jquery('#lionica_game','html',getchar());
	$ajax->script('$("#lionica_character").css({"left":100,"display":"block"});$("#lionica_create").css({"opacity":1,"display":"block"});_.lionica.player.created()');
}


function newchar($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	$job=intval($arg['job']);
	$gender=intval($arg['gender']);
	$hair=intval($arg['hair']);
	$color=intval($arg['color']);
	
	if(!_::$my)
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
	elseif(!_::$my['st'] || _::$my['st']<1)
	{
		$ajax->alert('คุณยังไม่ได้ยืนยันการสมัครสมาชิก');
	}
	elseif(!in_array($job,array(1,2,3,4)))
	{
		$ajax->alert('กรุณาเลือกอาชีพ');	
	}
	elseif(!in_array($gender,array(1,2)))
	{
		$ajax->alert('กรุณาเลือกเพศ');	
	}
	elseif(!in_array($hair,array(1,2,3,4,5)))
	{
		$ajax->alert('กรุณาเลือกทรงผม');	
	}
	elseif(!in_array($color,array(1,2,3,4,5,6,7)))
	{
		$ajax->alert('กรุณาเลือกสีผม');	
	}
	else
	{
		$count=$db->count('lionica_char',array('u'=>_::$my['_id'],'dd'=>array('$exists'=>false)));
		if($count<5)
		{
			$badword = '('.implode('|',require(HANDLERS.'boxza/badword.php')).')';
			$invalid = require(HANDLERS.'boxza/invalid-sub.php');
			$n = mb_substr(str_replace('  ',' ',trim($arg['name'])),0,20,'utf-8');
			$nl=mb_strtolower(str_replace(' ','',$n),'utf-8');
			if(!$n)
			{
				$ajax->alert('กรุณาตั้งชื่อที่ต้องการ');
			}
			elseif(mb_strlen($n,'utf-8')<3)
			{
				$ajax->alert('ชื่อสั้นเกินไป');	
			}
			elseif(strpos($nl,'admin')>-1 || strpos($nl,'boxza')>-1 || strpos($nl,'boxza')>-1 || strpos($nl,'google')>-1 || strpos($nl,'facebook')>-1 || strpos($nl,'twitter')>-1 || strpos($nl,'sanook')>-1 || strpos($nl,'kapook')>-1 || strpos($nl,'mthai')>-1)
			{
				$ajax->alert('ไม่สามารถใช้ชื่อนี้ได้');
			}
			elseif(strpos($nl,'เหี้ย')>-1 || strpos($nl,'ควย')>-1 || strpos($nl,'เย็ด')>-1 || strpos($nl,'แม่ง')>-1 || strpos($nl,'[gm]')>-1 || strpos($nl,'"')>-1 || strpos($nl,'\'')>-1)
			{
				$ajax->alert('ไม่สามารถใช้ชื่อนี้ได้');
			}
			elseif(in_array($nl,$invalid))
			{
				$ajax->alert('ไม่สามารถใช้ชื่อนี้ได้');
			}		
			elseif(preg_match('/'.$badword.'/i',$nl,$bw))
			{
				$ajax->alert('ไม่สามารถใช้ชื่อนี้ได้');
			}
			elseif($db->findone('lionica_char',array('n'=>$name)))
			{
				$ajax->alert('มีชื่อนี้อยู่แล้ว');
			}
			elseif($db->findone('lionica_char',array('nl'=>$nl)))
			{
				$ajax->alert('มีชื่อนี้อยู่แล้ว');
			}
			else
			{
				$p=array('u'=>_::$my['_id'],
																		'n'=>$n,
																		'lv'=>1,
																		'mlv'=>1,
																		'stats'=>array(
																									'str'=>1,
																									'agi'=>1,
																									'vit'=>1,
																									'dex'=>1,
																									'int'=>1,
																									'ptr'=>0
																									),
																		'hp'=>100,
																		'mhp'=>100,
																		'mp'=>50,
																		'mmp'=>50,
																		'atk'=>0,
																		'def'=>0,
																		'hit'=>0,
																		'free'=>0,
																		'xp'=>0,
																		'mxp'=>100,
																		'nl'=>$nl,
																		'job'=>$job,
																		'gender'=>$gender,
																		'hair'=>$hair,
																		'color'=>$color,
																		'silver'=>200,
																		'map'=>array('_id'=>1,'x'=>11,'y'=>18),
																		'ele'=>array('atk'=>0,'def'=>0)
																		);
				if($pi=$db->insert('lionica_char',$p))
				{
					require_once(__DIR__.'/game.lionica.play.game.php');
					$lionica = new lionica($pi);
					$lionica->update_stats();
					
					$ajax->jquery('#lionica_game','html',getchar());
					$ajax->script('$("#lionica_character").css({"left":100,"display":"block"});$("#lionica_create").css({"opacity":1,"display":"block"});_.lionica.player.created()');
				}
				else
				{
					$ajax->alert('เกิดข้อผิดพลาด');
				}
			}
		}
		else
		{
			$ajax->alert('คุณมตัวละครครบ 5 ตัวแล้ว');
			$ajax->script('_.box.close()');
		}
	}
}

function play($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	$id=intval($arg['_id']);
	if(!_::$my)
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
	elseif(!$id)
	{
		_::user()->update(_::$my['_id'],array('$unset'=>array('pet'=>1)));
		$ajax->jquery('#lionica_game','html',getchar());
		$ajax->script('$("#lionica_character").css({"left":100,"display":"block"});$("#lionica_create").css({"opacity":1,"display":"block"});_.lionica.player.created()');
	}
	elseif($char=$db->findone('lionica_char',array('u'=>_::$my['_id'],'_id'=>$id,'dd'=>array('$exists'=>false))))
	{
		
		require_once(__DIR__.'/game.lionica.play.game.php');
		$lionica = new lionica($char['_id']);
		$lionica->loadMap();
		
		$eq=array();
		if(is_array($lionica->char['eq']))
		{
			$items=$lionica->config('item');
			foreach($lionica->char['eq'] as $k=>$v)
			{
				$items[$v['item']]['inv']=$v['inv'];
				$eq[substr($k,1)]=$items[$v['item']];
			}
		}
		
		$khash=md5('lionica:'.rand(10000,99999));
		_::user()->update(_::$my['_id'],array('$set'=>array('lionica'=>array('_id'=>$lionica->char['_id'],'n'=>$lionica->char['n'],'job'=>$lionica->char['job'],'gender'=>$lionica->char['gender'],'hair'=>$lionica->char['hair'],'color'=>$lionica->char['color'],'hash'=>$khash))));
		
		$template=_::template();
		$template->assign('eq',$eq);
		$template->assign('char',$lionica->char);
		$ajax->jquery('#lionica_game','html',$template->fetch(LIONICA.'.play.game'));
		$ajax->script('_.lionica.khash="'.$khash.'";');
		$ajax->script('_.lionica.map='.json_encode($lionica->map).';');
		$ajax->script('_.lionica.player.char='.json_encode($lionica->char).';');
		$ajax->script('_.lionica.player.cur='.json_encode(array($lionica->char['map']['x'],$lionica->char['map']['y'])).';');
		
		$lionica->update_inventory();
		$lionica->update_skill();
		$ajax->script('$("#lionica_game").css({"display":"block"});$("#lionica_loading").css({"display":"none"});');
		$ajax->script('_.lionica.create('.$lionica->map['_id'].');');
	}
}
function delete($arg)
{
	$ajax=_::ajax();
	$db=_::db();
	$id=intval($arg['_id']);
	if(!_::$my)
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
	elseif($pet=$db->findone('lionica_char',array('u'=>_::$my['_id'],'_id'=>$id,'dd'=>array('$exists'=>false))))
	{
		$db->update('lionica_item',array('u'=>_::$my['_id'],'eq'=>$pet['_id']),array('$unset'=>array('eq'=>1)),array('multiple'=>1));
		$db->update('lionica_char',array('u'=>_::$my['_id'],'_id'=>$id),array('$set'=>array('dd'=>new MongoDate())));
		
		$ajax->jquery('#lionica_game','html',getchar());
		$ajax->script('$("#lionica_character").css({"display":"block"});_.lionica.player.created()');
	}
}

function socket($arg)
{
	require_once(__DIR__.'/game.lionica.play.game.php');
	$lionica = new lionica(_::$my['lionica']['_id']);
	$lionica->socket($arg);
}
?>