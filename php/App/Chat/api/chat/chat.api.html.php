<?php
$par=explode(' ',$chat->cmd,2);
$color=intval($par[0]);
$ms=$par[1];

if($ms&&in_array($chat->myid,$chat->super))
{
	if(preg_match('/'.$chat->badword.'/i',$ms,$c))
	{
		Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถพิมข้อความดังกล่าวได้ กรุณาใช้คำสุภาพนะคะ'];
		$ms='';
	}
	
	if($ms && isset($chat->data['shutup'][$chat->myid]))
	{
		if($chat->data['shutup'][$chat->myid]<time())
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
		$chat->inserttext(['ty'=>'ms','m'=>$ms,'c'=>$color]);
	}
}
?>