<?php

Load::Ajax()->register(['getmenu']);


Load::$core->data['content']=Load::$core->fetch('hidden.home');




function getmenu($arg)
{
	$db=Load::DB();
	$ajax=Load::Ajax();
	if($user=$db->findone('hidden_user',['fb'=>$arg['id']]))
	{
		
	}
	else
	{
		$user=['fb'=>$arg['id'],'name'=>$arg['name'],'email'=>$arg['email'],'lv'=>1,'score'=>0,'bonus'=>['open'=>5,'answer'=>5]];
		$id=$db->insert('hidden_user',$user);
		$user['_id']=$id;
	}
	
	$ajax->script('showmenu('.json_encode($user).')');
}
?>
