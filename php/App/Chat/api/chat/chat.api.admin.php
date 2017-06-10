
<?php

$par=explode(' ',$chat->cmd,3);
$uid=strtolower(trim($par[0]));
$bt=intval($par[1]);
if($uid=='list')
{
	$t='';
	if(is_array($chat->data['admin']))
	{
		foreach($chat->data['admin'] as $k=>$v)
		{
			$tm=' <span class="f14">(-ไม่มีข้อมูล-)</span>';
			if($v['ds'])
			{
				$tm='<span class="f14">'.Load::Time()->from($v['ds'],'datetime',true).'</span>';
			}
			if($u=$chat->data['bot'][$k])
			{
				$t.=' &nbsp;  &nbsp; - <a href="'.Load::uri(['chat','/']).'" target="_blank" class="bz_chat_level_'.$v['lv'].'">'.$chat->nick($u['name']).'</a> - <span>ID: '.$k.'</span> - <span class="f14">ตำแหน่ง</span> <span class="bz_chat_level_'.$v['lv'].'">'._getadmintype($v['lv']).'</span> - <span class="f14">ออนไลน์ล่าสุด</span> '.$tm.'<br>';
			}
			else
			{
				$t.=' &nbsp;  &nbsp; - <a href="'.Load::uri(['chat','/']).'" target="_blank" class="bz_chat_level_'.$v['lv'].'"><span>ID: '.$k.'</span></a> - <span class="f14">ตำแหน่ง</span> <span class="bz_chat_level_'.$v['lv'].'">'._getadmintype($v['lv']).'</span> - <span class="f14">ออนไลน์ล่าสุด</span> '.$tm.'<br>';
			}
		}
	}
	Load::$core->data['content'][] = array('method'=>'chatbox','type'=>'notice','data'=>'<strong class="f4">รายชื่อแอดมิน ('.count($chat->data['admin'] ).' คน)</strong><br>'.$t);
}
elseif($uid && is_numeric($uid) && $bt)
{
	if($chat->myadmin>1 || in_array($chat->myid,$chat->super))
	{
		if(!is_array($chat->data['admin']))
		{
			$chat->data['admin']=[];
		}
		if($chat->myadmin>3&&$chat->myadmin<9)
		{
			exit;
		}

		$uam=$chat->data['admin'][$uid];
		if((!empty($uam)) && isset($uam['lv']) && $uam['lv'] >= $chat->myadmin && !in_array($chat->myid,$chat->super))
		{
			Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คุณไม่มีสิธิ์แก้ไขสิทธิ์ของแอนมินระดับเดียวกันหรือสูงกว่าคุณได้'];
		}
		elseif($bt==-1 && ($chat->myadmin>=2 || in_array($chat->myid,$chat->super)))
		{
			if((!empty($uam)) && isset($uam['lv']) && $uam['lv']>0)
			{
				unset($chat->data['admin'][$uid]);
				$chat->saveadmin();
				$nick=getnicks($chat->cache,$chat->room);
				$chat->inserttext(array('ty'=>'admin','par'=>['uid'=>$uid,'admin'=>$bt],'m'=>'ปลด <span>'.($nick[$uid]['n']?$nick[$uid]['n']:'').'</span> [ID: '.$uid.'] จากตำแหน่งผู้ดูแลห้องแชทนี้','c'=>21));
				if($nick[$uid])
				{
					$nick[$uid]['am']=0;
					$chat->cache->set('ca2','chatbox_user_'.$chat->room,$nick,false,3600*24);
				}
			}
		}
		elseif($chat->room==1&&count($chat->data['admin'])>=5&&$chat->myadmin<9)
		{
			Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ห้องแชทนี้มีผู้ดูแลเต็มแล้ว'];
		}
		elseif(count($chat->data['admin'])>=20&&$chat->myadmin<9)
		{
			Load::$core->data['content'][] = array('method'=>'chatbox','type'=>'notice','data'=>'ห้องแชทนี้มีผู้ดูแลเต็มแล้ว ( สูงสุด 20 คน )');
		}
		elseif($bt==1 && ($chat->myadmin>=2||in_array($chat->myid,$chat->super)))
		{
			if(!is_array($chat->data['admin'][$uid]))
			{
				$chat->data['admin'][$uid]=[];
			}
			$chat->data['admin'][$uid]['lv']=$bt;
			$chat->saveadmin();
			$nick=getnicks($chat->cache,$chat->room);
			$chat->inserttext(array('ty'=>'admin','par'=>['uid'=>$uid,'admin'=>$bt],'m'=>'แต่งตั้ง <span>'.($nick[$uid]['n']?$nick[$uid]['n']:'').'</span> [ID: '.$uid.'] เป็นผู้ดูแลห้องแชทนี้','c'=>21));
			if($nick[$uid])
			{
				$nick[$uid]['am']=1;
				$chat->cache->set('ca2','chatbox_user_'.$chat->room,$nick,false,3600*24);
			}
		}
		elseif($bt==2 && ($chat->myadmin>=3||in_array($chat->myid,$chat->super)))
		{
			if(!is_array($chat->data['admin'][$uid]))
			{
				$chat->data['admin'][$uid]=[];
			}
			$chat->data['admin'][$uid]['lv']=$bt;
			$chat->saveadmin();
			$nick=getnicks($chat->cache,$chat->room);
			$chat->inserttext(array('ty'=>'admin','par'=>['uid'=>$uid,'admin'=>$bt],'m'=>'แต่งตั้ง <span>'.($nick[$uid]['n']?$nick[$uid]['n']:'').'</span> [ID: '.$uid.'] เป็นผู้ดูแลสูงสุดห้องแชทนี้','c'=>21));
			if($nick[$uid])
			{
				$nick[$uid]['am']=2;
				$chat->cache->set('ca2','chatbox_user_'.$chat->room,$nick,false,3600*24);
			}
		}
		elseif($bt==3 && ($chat->myadmin>=4||in_array($chat->myid,$chat->super)))
		{
			if(!is_array($chat->data['admin'][$uid]))
			{
				$chat->data['admin'][$uid]=[];
			}
			$chat->data['admin'][$uid]['lv']=$bt;
			$chat->saveadmin();
			$nick=getnicks($chat->cache,$chat->room);
			$chat->inserttext(array('ty'=>'admin','par'=>['uid'=>$uid,'admin'=>$bt],'m'=>'แต่งตั้ง <span>'.($nick[$uid]['n']?$nick[$uid]['n']:'').'</span> [ID: '.$uid.'] เป็นเจ้าของห้องแชทนี้','c'=>21));
			if($nick[$uid])
			{
				$nick[$uid]['am']=3;
				$chat->cache->set('ca2','chatbox_user_'.$chat->room,$nick,false,3600*24);
			}
		}
		else
		{
			Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คุณไม่มีสิทธิ์ใช้งานการแต่งตั้งผู้ดูแล'];
		}
	}
	else
	{
		Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คุณไม่มีสิทธิ์ใช้งานส่วนนี้'];
	}
}
function _getadmintype($v)
{
	switch($v)
	{
		case 1:
			return 'ผู้ดูแล';
		case 2:
			return 'ผู้ดูแลสูงสุด';
		case 3:
			return 'เจ้าของห้อง';
		default:
			return '-';
	}
}
?>
