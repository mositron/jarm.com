<?php

//Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>$type.' - '.$uid];

if($chat->myadmin||in_array($chat->myid,$chat->super))
{
	$par=explode(' ',$chat->cmd,3);
	$type=trim($par[0]);
	$uid=trim($par[1]);
	if(in_array($chat->room,$chat->superroom)&&!in_array($chat->myid,$chat->super))
	{
		Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'<strong class="f21">ห้องนี้ถูกล็อคการปลดแบนทั้งหมดไว้</strong>'];
	}
	elseif($type=='all')
	{
		if($chat->room==1)
		{
			$chat->mysystem=1;
		}
		$chat->data['ban']['_id']=[];
		$chat->data['ban']['ip']=[];
		$chat->inserttext(['ty'=>'unban','m'=>'เคลียร์รายการแบนทั้งหมดออกจากห้องแชท','c'=>21]);
	}
	elseif($type=='id')
	{
		if(is_array($chat->data['ban']['_id']) && isset($chat->data['ban']['_id'][$uid]))
		{
			unset($chat->data['ban']['_id'][$uid]);
			if($chat->room==1)
			{
				$chat->mysystem=1;
			}
			$chat->inserttext(['ty'=>'unban','m'=>'ปลดแบน ID: <a href="https://www.facebook.com/app_scoped_user_id/'.$uid.'" target="_blank">'.$uid.'</a>','c'=>21]);
		}
	}
	elseif($type=='ip')
	{
		if(is_array($chat->data['ban']['ip']) && isset($chat->data['ban']['ip'][$uid]))
		{
			unset($chat->data['ban']['ip'][$uid]);
			if($chat->room==1)
			{
				$chat->mysystem=1;
			}
			$chat->inserttext(['ty'=>'unban','m'=>'ปลดแบน IP: '.$uid,'c'=>21]);
		}
	}
}
else
{
	//$chat->data['ban']['_id']
}
?>
