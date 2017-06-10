<?php


$ms=trim(mb_substr(htmlspecialchars($chat->cmd, ENT_QUOTES, 'utf-8'),0,200,'utf-8'));

$bt=0;
if(preg_match('/'.$chat->badword.'/i',$ms,$c)||preg_match('/0([8|9]{1})([0-9]{5,10})/',$ms,$c))
{
	if($chat->myadmin||in_array($chat->myid,$chat->super))
	{
		Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถพิมข้อความดังกล่าวได้ กรุณาใช้คำสุภาพนะคะ'];
	}
	else
	{
		if($chat->data['room']['ki'])
		{
			if(Load::$my['logged'])
			{
				$bt=300;
			}
			else
			{
				$bt=3600*3;
			}
		}
		else
		{
			if(Load::$my['logged'])
			{
				Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถพิมข้อความดังกล่าวได้ กรุณาใช้คำสุภาพนะคะ'];
			}
			else
			{
				$bt=1800;
			}
		}
		if($bt)
		{
			$chat->data['ban']['_id'][$chat->myid]=time()+$bt;
			$chat->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]=time()+$bt;

			$chat->inserttext(array(
			'u'=>-1,
			'mb'=>1,
			'n'=>'ระบบ',
			'l'=>'',
			'i'=>'https://s2.jarm.com/profile/00/00/00/s.jpg',
			'am'=>3,
			'rk'=>rand(1,5),
			'vid'=>'',
			'ty'=>'kick','m'=>'เตะ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.'] [IP: '.$_SERVER['REMOTE_ADDR'].'] ออกจากห้องแชทนี้ และแบน '.floor($bt/60).' นาที ด้วยข้อหา คำหยาบ/คำต้องห้าม','par'=>['uid'=>$chat->myid],'c'=>21
			));
		}
	}
	$ms='';
}
elseif(stripos($ms,'chat.jarm.com/')>-1)
{
	Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถโฆษณาภายในห้องแชทด้วยกันได้'];
	$ms='';
}


if($ms)
{
	$ms=trim(preg_replace('/([^"|^\'|^>])http:\/\/([a-z0-9\.]+)?jarm\.com([^\s,]*)/i','$1<a href="http://$2jarm.com$3" target="_blank" rel="nofollow">http://$2jarm.com$3</a>',' '.$ms.' '));
	if(Load::$my['logged'])
	{
		#if($chat->mybux >= 10)
		#{
		#	$chat->mybux-=10;
		#	$user->bux(Load::$my['_id'],-10,'secret');
			$chat->inserttext(['ty'=>'sc','m'=>$ms]);
		#	Load::$core->data['content'][] = array('method'=>'chatbox','type'=>'notice','data'=>'คุณมีบั๊กเหลือ '.number_format($chat->mybux));
		#}
		#else
		#{
		#	Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คุณมีบั๊กไม่เพียงพอ'];
		#}
	}
	else
	{
		Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คำสั่งนี้เฉพาะสมาชิกเท่านั้น'];
	}
}
else
{
	Load::$core->data['content'][] = array('method'=>'chatbox','type'=>'notice','data'=>'วิธีใช้งานข้อความลับ ( /secret [ข้อความ] ) - ฟรี');
}
?>
