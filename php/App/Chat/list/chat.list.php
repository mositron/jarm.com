<?php

//Load::move('/',true);

Load::$core->assign('getchat',getchat());
Load::$core->data['content']=Load::$core->fetch('list');


function getchat($page=1)
{
	
	$rows = 30;
	$all=['order','by','search','page'];

	extract(Load::Split()->get('/list/',0,$all));

	$arg = ['pl'=>1,'dd'=>['$exists'=>false]];

	$db=Load::DB();
	if($count=$db->count('chatroom',$arg))
	{
		list($pg,$skip)=Load::Pager()->navigation($rows,$count,[$url,'page-'],$page);
		$chat=$db->find('chatroom',$arg,['_id'=>1,'n'=>1,'w'=>1,'u'=>1,'da'=>1,'cu'=>1,'cv'=>1,'du'=>1,'l'=>1],['skip'=>$skip,'limit'=>$rows,'sort'=>['du'=>-1]]);
	}

	
	Load::$core->assign(array('chat'=>$chat,'pager'=>$pg,'count'=>number_format($count)));
	return Load::$core->fetch('list.list');
}

?>
