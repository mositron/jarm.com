<?php

$arg = $_POST;
if($name=trim($arg['name']))
{
	$db=Load::DB();
	$bot=[];
	for($i=0;$i<MAX_BOT;$i++)
	{
		if($bn=trim($arg['bot_'.$i.'_n']))
		{
			$ty=$arg['bot_'.$i.'_ty'];
			$img=trim($arg['bot_'.$i.'_i']);
			if(substr($img,0,4)!='http' || strlen($img)<10)
			{
				$img='';
			}
			$bot[]=array('n'=>mb_substr($bn,0,60,'utf-8'),'i'=>$img,'ty'=>(in_array($ty,['','chat','poem1','poem2','poem3'])?$ty:''));
		}
	}
	$bg=array(
								'al'=>array(
															'cl'=>mb_substr($arg['al_cl'],0,7,'utf-8'),
															'bg'=>mb_substr($arg['al_bg'],0,150,'utf-8'),
								),
								'pc'=>max(min(intval($arg['bg_pc']),100),0),
								'pn'=>max(min(intval($arg['bg_pn']),100),0),
								'lc'=>mb_substr($arg['lc'],0,7,'utf-8'),
								'tc'=>mb_substr($arg['tc'],0,7,'utf-8'),
								'one'=>$arg['one']?1:0,
								'snd'=>$arg['snd']?1:0,
								'col'=>$arg['col']?1:0,
	);
	$db->update('chatroom',array('_id'=>intval(Load::$path[0])),array('$set'=>array(
																				'n'=>mb_substr($name,0,20,'utf-8'),
																				'w'=>mb_substr(trim($arg['welcome']),0,100,'utf-8'),
																				'r'=>mb_substr(trim($arg['radio']),0,150,'utf-8'),
																				'pl'=>($arg['published']?1:0),
																				'li'=>($arg['login']?1:0),
																				'ki'=>($arg['kick']?1:0),
																				'li2'=>($arg['login2']?1:0),
																				'ki2'=>($arg['kick2']?1:0),
																				'bt'=>$bot,
																				'bg'=>$bg,
																				'mt'=>array(
																												'tt'=>mb_substr(trim(strval($arg['mtt'])),0,200,'utf-8'),
																												'dc'=>mb_substr(trim(strval($arg['mdc'])),0,200,'utf-8'),
																												'kw'=>mb_substr(trim(strval($arg['mkw'])),0,200,'utf-8')
																				),
																				'ds'=>Load::Time()->now(),

	)));
	Load::Mcache()->delete('ca2','chatroom_data_'.intval(Load::$path[0]),0);

	if(!$chat['l'])
	{
		if($link=strtolower(trim($arg['link'])))
		{
			$invalid = require(HANDLERS.'config/invalid-sub.php');
			$invalid[]='room';
			$invalid[]='chan';
			$invalid[]='channel';
			$invalid[]='rooms';
			$invalid[]='api';
			$invalid[]='facebook';
			$invalid[]='game';
			$invalid[]='user';

			if(preg_match('/^([a-z0-9]{1})([a-z0-9\.\-]{1,28})([a-z0-9]{1})$/',$link,$c))
			{
				if(strpos($link,'..')>-1 || strpos($link,'--')>-1 || strpos($link,'.-')>-1 || strpos($link,'-.')>-1)
				{
					$error[]='ไม่สามารถใช้ . หรือ - ติดกัน สำหรับลิ้งค์ได้';
				}
				elseif(preg_match('/^([0-9]+)$/',$link))
				{
					$error[]='ไม่สามารถใช้เฉพาะตัวเลข  สำหรับลิ้งค์ได้';
				}
				elseif(is_numeric($link))
				{
					$error[]='ไม่สามารถใช้เฉพาะตัวเลข  สำหรับลิ้งค์ได้';
				}
				elseif(preg_match('/(.+)\.(php|js|css|htm|html|jpg|jpeg|png|gif)$/',$link))
				{
					$error[]='ไม่สามารถใช้งานลิ้งค์นี้ได้';
				}
				elseif(strpos($link,'jarm')>-1 || strpos($link,'google')>-1 || strpos($link,'facebook')>-1 || strpos($link,'twitter')>-1 || strpos($link,'sanook')>-1 || strpos($link,'kapook')>-1 || strpos($link,'mthai')>-1)
				{
					$error[]='ไม่สามารถใช้งานลิ้งค์นี้ได้';
				}
				elseif(in_array($link,$invalid))
				{
					$error[]='ไม่สามารถใช้งานลิ้งค์นี้ได้';
				}
				elseif($db->findOne('chatroom',['l'=>$link],['_id'=>1]))
				{
					$error[]='ลิ้งค์นี้มีผู้ใช้งานแล้ว กรุณาใช้ลิ้งค์อื่น';
				}
				else
				{
					$db->update('chatroom',array('_id'=>intval(Load::$path[0])),['$set'=>['l'=>$link]]);
				}
			}
			else
			{
				$error[]='ไม่สามารถใช้งานลิ้งค์นี้ได้';
			}
		}
	}


	if($f=$_FILES['o']['tmp_name'])
	{
		$size=@getimagesize($f);
		switch (strtolower($size['mime']))
		{
			case 'image/gif':
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/bmp':
			case 'image/wbmp':
			case 'image/png':
			case 'image/x-png':
				if(!$chat['fd'])
				{
					$fd = Load::Folder()->fd($chat['_id']);
					$chat['fd'] = substr($fd,2,2).'/'.substr($fd,4,2);
					$db->update('chatroom',['_id'=>$chat['_id']],['$set'=>['fd'=>$chat['fd']]]);
				}
				$photo=Load::Photo();
				$folder='cdn/chat/room/'.$chat['fd'];
				if($n = $photo->thumb('m',$f,$folder,600,450,'width','jpg'))
				{
					$photo->thumb('s',$f,$folder,160,120,'bothtop','jpg');
					$photo->thumb('t',$f,$folder,320,240,'bothtop','jpg');

					$chat['img']=$n;
					$db->update('chatroom',['_id'=>$chat['_id']],['$set'=>['img'=>$chat['img']]]);
				}
		}
	}

	if(!count($error))
	{
		if($arg['published'])
		{
			if(!$chat['img'])
			{
				$db->update('chatroom',['_id'=>$chat['_id']],['$set'=>['pl'=>0]]);
				Load::move('?no-image');
			}
		}
		Load::move(URL.'?completed');
	}
}

?>
