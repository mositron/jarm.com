<?php
define('HIDE_ADS',1);
//Load::move('https://friend.jarm.com/',true);
//exit;
if(MODULE_LINK=='room')
{
	$arg=array('_id'=>intval(Load::$path[0]));
}
else
{
	$arg=['l'=>Load::$path[0]];
}
$arg['dd']=['$exists'=>false];
$db=Load::DB();
if(!$room=$db->findone('chatroom',$arg))
{
	Load::move('/');
}

if(MODULE_LINK=='room'&&$room['l'])
{
	Load::move('/'.$room['l'],true);
}

if($room['_id']<8)
{
	/*
	if(Load::$my)
	{
		if(in_array(Load::$my['_id'],[21654,31284,10989,40556,45586,53537,27960]))
		{
			Load::move('/banned');
			$room=$db->findone('chatroom',['_id'=>8]);
		}
	}
	*/
	if($room['_id']==7)
	{
		Load::move('/lobby');
	}
}

if($room['_id']<=3)
{
	define('EXP_RATE',5);
}
else
{
	define('EXP_RATE',1);
}
define('HIDE_SIDEBAR',1);

Load::$core->data['title'] = 'ห้อง'.$room['n'].' - chat แชท พูดคุย สนทนา หาเพื่อน หาแฟน หากิ๊ก หาคู่ คุย พบปะพูดคุยกับเพื่อนใหม่ๆได้ทีนี่';
Load::$core->data['description'] = 'ห้อง'.$room['n'].' '.$room['w'].' - chat แชท พูดคุย สนทนา หาเพื่อน หาแฟน หากิ๊ก หาคู่ คุย พบปะพูดคุยกับเพื่อนใหม่ๆใน jarm.com';
Load::$core->data['keywords'] = $room['n'].', chat, แชท, พูดคุย, สนทนา';

if($room['mt'])
{
	if($room['mt']['tt'])
	{
		Load::$core->data['title']=$room['mt']['tt'];
	}
	if($room['mt']['dc'])
	{
		Load::$core->data['description']=$room['mt']['dc'];
	}
	if($room['mt']['kw'])
	{
		Load::$core->data['keywords']=$room['mt']['kw'];
	}

}
Load::$core->assign('room',$room);
Load::$core->data['content']=Load::$core->fetch('view');


#	$cache->set('ca1','fb_home',Load::$core->data['content'],false,300);
#}

?>
