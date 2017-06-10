<?php
$par=explode(' ',$chat->cmd,2);
$color=intval($par[0]);
$ms=trim(mb_substr(htmlspecialchars($par[1], ENT_QUOTES, 'utf-8'),0,500,'utf-8'));

if($chat->data['room']['li'])
{
	if(!Load::$my['logged'])
	{
		Load::$core->data['content'][] = array('method'=>'chatbox','type'=>'notice','data'=>'กรุณาล็อคอิน หรือ "<a href="https://chat.jarm.com/facebook/login/?redirect_uri='.urlencode('/room/'.$chat->room).'" target="_top">คลิกที่นี่</a>" เพื่อทำการพิมหน้าห้องนี้');
		$ms='';
	}
}

$bt=0;
$ms2=' '.str_replace([' ','&nbsp;','-','	'],'',$ms).' ';

if($chat->mybux<-1000)
{
	Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คุณมีคะแนนน้อยเกินไป ไม่สามารถคุยหน้าห้องได้'];
	$ms='';
}
elseif(preg_match('/'.$chat->badword.'/i',$ms2,$c)||preg_match('/0([8|9]{1})([0-9]{5,10})/',$ms2,$c))
{
	if($chat->myadmin||in_array($chat->myid,$chat->super))
	{
		Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถพิมข้อความดังกล่าวได้ กรุณาใช้คำสุภาพนะคะ'];
	}
	else
	{
		$dispoint=false;
		if($chat->data['room']['ki'])
		{
			if(Load::$my['logged'])
			{
				$bt=900;
				$dispoint=-500;
				$chat->mybux+=$dispoint;
				$user->bux(Load::$my['_id'],$dispoint,'msg-badword');
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
			'ty'=>'kick','m'=>'เตะ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.'] [IP: '.$_SERVER['REMOTE_ADDR'].'] - แบน '.floor($bt/60).' นาที'.($dispoint?', ปรับ '.number_format($dispoint).' บั๊ก':'').' ด้วยข้อหา คำหยาบ/คำต้องห้าม (หน้าห้อง)','par'=>['uid'=>$chat->myid],'c'=>21
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
elseif(preg_match('/(.)\1{7,}/iu',$ms2) && !in_array($chat->myid,$chat->super))
{
	Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'กรุณาอย่า.. ฟลัดตัวอักษร'];
	$ms='';
}
elseif(preg_match('/\[([a-z]{1})([0-9]{1,3})\]/i',$ms))
{
//	chatroom_emo
	$db=Load::DB();
	if($emo=$db->find('chatroom_emo',array('u'=>$chat->myid,'r'=>$chat->room,'da'=>['$gte'=>Load::Time()->now(-20)])))
	{
		if((!$this->myadmin)&&(count($emo)>2))
		{
			$chat->data['ban']['_id'][$chat->myid]=time()+600;
			$chat->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]=time()+600;
			$chat->save=true;
		}
		$ms='';
	}
	$db->insert('chatroom_emo',['u'=>$chat->myid,'r'=>$chat->room]);
}

if($ms && isset($chat->data['shutup'][$chat->myid]) && $chat->myid!=1)
{
	if($chat->data['shutup'][$chat->myid]['t']<time())
	{
		unset($chat->data['shutup'][$chat->myid]);
		$chat->save=true;
	}
	else
	{
		Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คุณถูกปิดการใช้งานการสนทนา'];
		$ms='';
	}
}


if($ms)
{
	$ms=trim(preg_replace('/([^"|^\'|^>])http:\/\/([a-z0-9\.]+)?jarm([a-z0-9\.]+)?\.com([^\s,]*)/i','$1<a href="http://$2jarm$3.com$4" target="_blank" rel="nofollow">http://$2jarm$3.com$4</a>',' '.$ms.' '));

	$chat->inserttext(['ty'=>'ms','m'=>$ms,'c'=>$color]);


	if(in_array($chat->myid,$chat->superkick)&&$is_myroom)
	{
		$ms2=' '.str_replace([' ','&nbsp;','-','	','.'],'',$ms).' ';
		if(preg_match('/(.+)(ลุง|รุง|ชรา|แก่|เฒ่า|สูงวัย|สูงอายุ)(.+)/i',$ms2))
		{
			$chat->inserttext(array(
				'u'=>1,
				'mb'=>1,
				'n'=>'^C18,18ກ ^C7,7າ ^C9,9ຮ ^C18,18ໂ ^C7,7ຮ ^C9,9ງ',
				'l'=>'',
				'i'=>'https://s1.jarm.com/profile/00/00/01/s.jpg',
				'am'=>9,
				'rk'=>101,
				'vid'=>'',
				'ty'=>'kick','m'=>'เตะ <span>'.$chat->myname.'</span> [ID: '.$chat->myid.']  - แบน 3 นาที - เนื่องจาก "ได้รับ ของขวัญ 1 ea"','par'=>['uid'=>$chat->myid],'c'=>21
				));

				$chat->data['ban']['_id'][$chat->myid]=time()+180;
				$chat->data['ban']['ip'][$_SERVER['REMOTE_ADDR']]=time()+180;
		}
	}

	$bchat = array(
										array(
													'(ดี|onion\=4\])',
													[
																'ดีจ้า',
																'ดี',
																'ดีๆ',
																'ทักคนมาใหม่',
																'หวัดดี',
																'[o4]',
													],
										),
										array(
													'ทัก',
													[
																'ทักๆ',
																'ทักด้วย',
																'ทักจ้า',
																'ดีๆ',
																'[o4]',
													],
										),
										array(
													'แกล้ง(.*)บอท',
													[
																'<span>'.$chat->myname.'</span>  &lt;-- จะมาแกล้งทำไม หาาาาาาา.',
																'แกล้ง?',
																'เหอๆ',
																'แกล้งไร',
													],
									),
									array(
													'มัค(.*)ไง',
													[
																'<span>'.$chat->myname.'</span> ไม่ต้องสมัครสมาชิก แค่ล็อคอินด้วยเฟสบุ๊ค ก็ใช้งานได้เลย'
													],
									),
									array(
													'เปลี่ยน(.*)รูป',
													[
																'<span>'.$chat->myname.'</span> ถ้าจะเปลี่ยนรูป ต้องเปลี่ยนที่เฟสบุ๊ค เพราะแชทนี้ใช้รูปจากโปรไฟล์เฟสบุ๊คของคุณ'
													],
									),
									array(
													'เปลี่ยน(.*)ชื่อ',
													[
																'คลิกที่ชื่อตัวเอง เพื่อเปลี่ยนได้เลย',
																'คลิกที่ชื่อตังเอง',
																'คลิกที่ชื่อ <span>'.$chat->myname.'</span>',
													],
									),
									array(
												'(ไป(.*)(ก่อน|แล้ว|แระ)|o116)',
													[
																'บะบายจ้า',
																'บาย',
																'บายๆ',
																'ให้ไวเลยๆ',
																'แล้วอย่ามาอีกนะ....[o15]',
																'[o116]',
													],
									),
	);

	$valid=false;
	for($i=0;$i<count($bchat);$i++)
	{
		if($bchat[$i][0] && preg_match('/'.$bchat[$i][0].'/i',$ms,$c))
		{
			$b=$bchat[$i][1];
			shuffle($b);
			$valid=$b[0];
			//Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'1----'.$valid];
			break;
		}
	}
	if($valid)
	{
		$nick=getnicks($chat->cache,$chat->room);
		$rnd=rand(300,600);
		foreach($chat->data['bot'] as $a=>$b)
		{
			if($chat->data['bot'][$a]['ty']=='chat' && $nick[$a] && ((!$nick[$a]['ls'])||($nick[$a]['ls']+$rnd<$chat->time2)))
			{
				$cbot=$chat->data['bot'][$a];
				$clbot=1;
				$ambot=0;
				if(isset($chat->data['admin'][$a]))
				{
					$ambot=$chat->data['admin'][$a]['lv'];
				}
				if($cbot['color'])
				{
					$clbot=$cbot['color'];
					if(is_array($cbot['color']))
					{
						$clbot=$cbot['color'];
						shuffle($clbot);
						$clbot=$clbot[0];
					}
				}
				array_push($chat->data['wait'],array('ty'=>'ms','u'=>$a,'m'=>$valid,'c'=>$clbot,'n'=>$nick[$a]['n'],'l'=>$nick[$a]['l'],'i'=>$nick[$a]['i'],'mb'=>1,'rk'=>1,'vid'=>'','am'=>$ambot,'wt'=>$chat->time2+rand(5,10)));
				$chat->save=true;
				$nick[$a]['ls']=$chat->time2;
				$chat->cache->set('ca2','chatbox_user_'.$chat->room,$nick,false,3600*24);

				//Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'2----'.$nick[$a]['n']];
				break;
			}
		}
	}
}
?>
