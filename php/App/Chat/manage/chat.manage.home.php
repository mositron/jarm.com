<?php

Load::Ajax()->register(['newchat','delchat']);
Load::$core->assign('getchat',getchat());


Load::$core->data['content']=Load::$core->fetch('manage.home');


function getchat($page=1)
{
	
	$rows = 40;
	$allorder = ['_id'=>'#','p'=>'รูปภาพ','t'=>'คำถาม','s'=>'สถานะ'];
	$allby=['desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง'];
	$all=['order','by','search','page'];

	extract(Load::Split()->get('/manage/',0,$all,$allorder,$allby));

	$arg = ['u'=>Load::$my['_id'],'dd'=>['$exists'=>false]];
	if(Load::$my['_id']=='10206486363972963')
	{
		unset($arg['u']);
	}
	$db=Load::DB();
	if($count=$db->count('chatroom',$arg))
	{
		list($pg,$skip)=Load::Pager()->navigation($rows,$count,[$url,'page-'],$page);
		$chat=$db->find('chatroom',$arg,[],['skip'=>$skip,'limit'=>$rows,'sort'=>['_id'=>-1]]);
	}

	
	Load::$core->assign(array('chat'=>$chat,'pager'=>$pg,'count'=>number_format($count),'allby'=>$allby,'allorder'=>$allorder));
	for($i=0;$i<count($all);$i++)if(${$all[$i]}) Load::$core->assign($all[$i],${$all[$i]});
	return Load::$core->fetch('manage.home.list');
}

function newchat($arg)
{
	$db=Load::DB();
	if(trim($arg['title']))
	{
		$t=mb_substr(trim($arg['title']),0,20,'utf-8');
		if($chat=$db->insert('chatroom',array(
																								'u'=>Load::$my['_id'],
																								'n'=>$t,
																								'ip'=>$_SERVER['REMOTE_ADDR'],
																								'w'=>'ยินดีต้อนรับสู่ห้อง '.$t,
																								'am'=>array(Load::$my['_id']=>array('lv'=>3,'ds'=>time())),
																								'vj'=>Load::$my['_id'],
																								'bg'=>array(
																																'al'=>['cl'=>'#2B2728','bg'=>''],
																																'pn'=>100,
																																'pc'=>100,
																																'snd'=>1,
																																'one'=>1,
																																'col'=>0,
																								)
																								)))
		{
			Load::Ajax()->redirect('/manage/'.$chat);
		}
	}
}

function delchat($i)
{
	$db=Load::DB();
	$arg=array('u'=>Load::$my['_id'],'_id'=>intval($i));

	if(Load::$my['_id']=='10206486363972963')
	{
		unset($arg['u']);
	}
	if($var=$db->findOne('chatroom',$arg))
	{
		$db->update('chatroom',['_id'=>$var['_id']],array('$set'=>array('dd'=>Load::Time()->now())));
		Load::Mcache()->delete('ca2','chatroom_data_'.$var['_id'],0);
	}
	Load::Ajax()->jquery('#getchat','html',getchat());
}
?>
