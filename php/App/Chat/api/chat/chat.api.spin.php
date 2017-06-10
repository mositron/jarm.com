<?php
if(in_array($chat->room,$chat->superroom)&&in_array($chat->myid,$chat->super))
{
	$nick=getnicks($chat->cache,$chat->room);
	foreach($chat->data['bot'] as $a=>$b)
	{
		$cbot=$chat->data['bot'][$a];
		$clbot=1;
		$ambot=0;
		if(isset($chat->data['admin'][$a]))
		{
			$ambot=$chat->data['admin'][$a]['lv'];
		}
		$clbot=rand(1,17);
		array_push($chat->data['wait'],array('ty'=>'ms','u'=>$a,'m'=>$chat->cmd,'c'=>$clbot,'n'=>$nick[$a]['n'],'l'=>$nick[$a]['l'],'i'=>$nick[$a]['i'],'mb'=>1,'rk'=>1,'vid'=>'','am'=>$ambot,'wt'=>$chat->time2+rand(2,10)));	
	}
	$chat->save=true;
}

?>