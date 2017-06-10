
<?php

$par=explode(' ',$chat->cmd,3);
$uid=strtolower(trim($par[0]));
/*
if(preg_match('/^([0-9]{2})\.([0-9]{1})$/',$uid,$c))
{

}
else
*/
if($uid && is_numeric($uid))
{
	if($chat->myadmin>1 || in_array($chat->myid,$chat->super))
	{
		$nick=getnicks($chat->cache,$chat->room);
		//if($nick[$uid]['vid']=='publish')
		//{
			$chat->data['room']['vj']=$uid;
			Load::DB()->update('chatroom',['_id'=>$chat->room],['$set'=>['vj'=>$uid]]);
			$chat->inserttext(array('ty'=>'vj','par'=>['uid'=>$uid],'m'=>'ตั้ง <span>'.($nick[$uid]['n']?$nick[$uid]['n']:'').'</span> [ID: '.$uid.'] เป็น VJ ประจำห้องนี้','c'=>21));
		//}
		//else {
		//	Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'บุคคลดังกล่าวยังไม่ได้เปิดกล้อง...'];
		//}
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
