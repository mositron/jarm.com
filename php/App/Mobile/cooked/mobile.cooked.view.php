<?php


$db=Load::DB();
if(!Load::$path[1] || !$user=$db->findone('cooked_user',array('_id'=>intval(Load::$path[1]))))
{
	Load::move('/cooked');	
}

define('USER_ID',$user['_id']);
define('USER_FB',$user['fb']);
define('USER_LV',$user['lv']);

Load::Ajax()->register(['setpass']);

$lv=intval(Load::$path[2]);

if(!$lv || $lv>USER_LV)
{
	$lv=USER_LV;
}

$game=['error'=>'เลเวลนี้ยังไม่เปิด.'];
$games=require(__DIR__.'/mobile.cooked.game.config.php');
if(isset($games[$lv]))
{
	$game=$games[$lv];
}

Load::$core->assign('lv',$lv);
Load::$core->assign('game',$game);
Load::$core->assign('maxlv',count($games)+1);
Load::$core->assign('user',$user);
Load::$core->data['content']=Load::$core->fetch('cooked.game');



function setpass($arg)
{
	global $user;
	$db=Load::DB();
	$ajax=Load::Ajax();
	
	$lv=['error'=>'เลเวลนี้ยังไม่เปิด.'];
	$game=require(__DIR__.'/mobile.cooked.game.config.php');
	if(isset($game[$arg['lv']]))
	{
		$g=$game[$arg['lv']];
		$cell=$g['cell'];
		$sc=intval(($cell*$cell)/2)*$g['score'];
		//$score=$g['score'];
		
		$max=intval($arg['score']);
		$fail=intval($arg['fail']);
		$score=$max-$fail;
		if($sc==$max && $fail<$max && USER_ID==$arg['id'] && USER_FB==$arg['fb'])
		{
			$nlv=($arg['lv']+1);
			
			$set=[];
			$wall=false;
			if(USER_LV==$arg['lv'])
			{
				$wall=true;
				$set['lv']=$nlv;	
			}
			$clv=$user['pass']['lv'.$arg['lv']];
			if(!$clv || $clv['s']<$score)
			{
				$set['pass.lv'.$arg['lv']]=['m'=>$max,'f'=>$fail,'s'=>$score];
				
				if(!is_array($user['pass']))
				{
					$user['pass']=[];
				}
				$user['pass']['lv'.$arg['lv']]=['m'=>$max,'f'=>$fail,'s'=>$score];
				
				$now=0;
				for($i=1;$i<=USER_LV;$i++)
				{
					$now+=intval($user['pass']['lv'.$i]['s']);
				}
				$set['score']=$now;
			}
			if($wall)
			{
				
			}
			//'lv'=>$nlv,'pass.lv'.$arg['lv']=>[])
			if(count($set)>0)
			{
				//$ajax->alert(print_r(['_id'=>USER_ID],true).' - '.print_r($set,true));
				$db->update('cooked_user',['_id'=>USER_ID],['$set'=>$set]);
			}
			$fb=array(
								'message'=>'อัพเลเวล '.$nlv.'. ใน เกมจับคู่+',
								'name'=>'เลเวล '.$nlv.'!.',
								'caption'=>'อัพเลเวล '.$nlv.'. ใน เกมจับคู่+ สำหรับ Android',
								'link'=>'https://play.google.com/store/apps/details?id=com.doodroid.cooked',
								'picture'=>'https://lh6.ggpht.com/3qgcgzMX5TmSq6kWthzd9IwhA7O62k5jfHY0swhyjwqCqSJ3FUbsoFqjmuu1APFAyQ',
								'description'=>'เกมจับคู่+ by jarm.com - เกมทดสอบควมจำ เก็บเลเวล สะสมแต้ม เล่นง่ายๆ บนมือถือ/แท็บเล็ต Android',
								'actions'=>[['name'=>'เกมจับคู่+ for Android','link'=>'https://play.google.com/store/apps/details?id=com.doodroid.cooked']]
			);
			if($wall)
			{
				$ajax->script('m.result('.json_encode($fb).')');
			}
			if(isset($game[$nlv]))
			{
				$ajax->script('m.nextlevel(true,'.json_encode(['lv'=>$nlv,'wall'=>$wall]).');');
			}
			else
			{
				$ajax->script('m.nextlevel(false,'.json_encode(['lv'=>$nlv,'wall'=>$wall]).');');
			}
		}
		else
		{
			$ajax->script('m.playagain(true);');
		}
	}
	else
	{
		$ajax->script('m.playagain(false);');
	}
}

?>