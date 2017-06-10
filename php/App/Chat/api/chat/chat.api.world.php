<?php
$ms=trim($chat->cmd);

if($ms&&in_array($chat->myid,$chat->super))
{
	$cache=Load::Mcache();

	$time=$chat->time;
	$al=array(
								'ty'=>'ms',
								'u'=>-1,
								'_id'=>$chat->time,
								'_sn'=>str_replace('.','_',strval($chat->time)),
								't'=>date('H:i',$chat->time),
								'p'=>'',
								'm'=>$ms,
								'mb'=>1,
								'c'=>21,
								'n'=>'^C21,21-^C0,21ประกาศถึงทุกห้อง^C21,21-',
								'l'=>'',
								'i'=>'https://s2.jarm.com/profile/00/00/00/s.jpg',
								'am'=>9,
								'ip'=>$_SERVER['REMOTE_ADDR'],
								'rk'=>rand(1,5),
								'vid'=>'',
							);
	$c = Load::DB()->find('chatroom',array('dd'=>['$exists'=>false],'du'=>array('$gte'=>Load::Time()->now(-600))),['_id'=>1],['sort'=>['cu'=>-1],'limit'=>50],false);
	foreach($c as $v)
	{
		$key='chatroom_data_'.$v['_id'];
		if($data=$cache->get('ca2',$key))
		{
			if(is_array($data['text']))
			{
				array_push($data['text'],$al);
				$cache->set('ca2',$key,$data,false,3600*24*7);
			}
		}
	}
}
?>
