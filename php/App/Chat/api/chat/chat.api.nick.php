<?php

$nick=getnicks($chat->cache,$chat->room);
$cnick=$chat->cmd;
$clnick=strip_tags(preg_replace('/\^C([0-9]+)\,([0-9]+)\,([0-9]+)/i','',$cnick));
$clnick=strip_tags(preg_replace('/\^C([0-9]+)\,([0-9]+)/i','',$cnick));
$clnick=strip_tags(preg_replace('/\^C([0-9]+)/i','',$clnick));
$clnick=str_replace([''],[' '],$clnick);
$cnick=str_replace([''],[' '],$cnick);
$l=mb_strlen($clnick,'utf-8');
if(($l>=3 && $l<=20)||in_array($chat->myid,$chat->super))
{
	if(!in_array($chat->myid,$chat->super))
	{
		$cnick=strip_tags(preg_replace('/\^C([0-9]+)\,([0-9]+)\,([0-9]+)/i','^C$1,$2',$cnick));
		//$cnick=strip_tags(preg_replace('/\^C([0-9]+)\,([0-9]+)/i','^C$1',$cnick));
		//$cnick=preg_replace('/\^C([0]+)/i','^C1',$cnick);
	}
	if($l>=100)
	{
		$cnick=mb_substr($cnick,0,100,'utf-8');
	}
	$onick=$chat->myname;
	$chat->myname=$cnick;

	$data = [
							'logged'=>$chat->mylogged,
							'_id'=>$chat->myid,
							'name'=>$chat->myname,
							'img'=>Load::$my['img'],
	];
	_setsession($data);

	$nick[$chat->myid]=['_id'=>$chat->myid,'n'=>$chat->myname,'d'=>'','l'=>'','i'=>$chat->myimg,'t'=>$chat->time2,'mb'=>0,'am'=>0];
	if(Load::$my['logged'])
	{
		$user->update(Load::$my['_id'],['$set'=>['n'=>$chat->myname]]);
		$nick[$chat->myid]=array_merge($nick[$chat->myid],['d'=>Load::$my['name'],'l'=>Load::$my['link'],'mb'=>1,'am'=>$chat->myadmin]);
	}
	$chat->cache->set('ca2','chatbox_user_'.$chat->room,$nick,false,3600*24);
	Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'my','data'=>$nick[$chat->myid]];
	if($onick!=$cnick)
	{
		$chat->inserttext(array('ty'=>'nick','m'=>'เปลี่ยนชื่อใหม่เป็น <a href="javascript:;" class="bz_chat_user" onclick="_.chat.popup(\''.$chat->myid.'\')"><span>'.$cnick.'</span></a>','c'=>21));
	}
}
else
{
	Load::$core->data['content'][] = array('method'=>'chatbox','type'=>'notice','data'=>'ไม่สามารถใช้ชื่อนี้ได้ [ชื่อจำเป็นต้องมีความยาว 3-20 ตัวอักษร (ไม่รวมสิ)]');
}
?>
