<?php


$par=explode(' ',$chat->cmd,3);
$uid=strtolower(trim($par[0]));
$bt=intval($par[1]);


if(Load::$my['logged'] && in_array(Load::$my['_id'],$chat->super) && $uid && is_numeric($uid))
{
	if($bt)
	{
		if($chat->myadmin>=9)
		{
			if($u=$user->get($uid,true))
			{
				$user->bux($uid,$bt,'rank-'.trim($par[2]));
				$ms='<strong>'.($bt>0?'เพิ่ม':'ลด').'</strong>คะแนนของ <span>'.($u['name']).'</span> [ID: '.$uid.']'.' จำนวน '.number_format(abs($bt)).' บั๊ก'.($par[2]?' เนื่องจาก "'.trim($par[2]).'"':'');
				$chat->inserttext(['ty'=>'rank','m'=>$ms,'c'=>21]);
			}
			else
			{
				Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ไม่มีบุคคลดังกล่าว'];
			}
		}
		else
		{
			Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'คุณไม่มีสิทธิ์ใช้งานส่วนนี้'];
		}
	}
	else
	{
		if($u=$user->get($uid,true))
		{
			$chat->mysystem=-1;
			$mybux = intval($u['bu']);
			$ms='คะแนนของ '.$chat->nick($u['name']).' [ID: '.$uid.']'.' มี '.number_format($mybux).' คะแนน';
			$chat->inserttext(['ty'=>'rank','m'=>$ms,'c'=>21]);
		}
		else
		{
			Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'notice','data'=>'ไม่มีบุคคลดังกล่าว'];
		}
	}
}
else
{
	$data=[];
	Load::$core->data['content'][] = array('method'=>'chatbox','type'=>'rank','data'=>array('val'=>number_format($chat->mybux),'data'=>$data));
}

?>
