<?php

#$cache=Load::$core;
#if(!Load::$core->data['content']=$cache->get('ca1','football_live_program'))
#{
	$db=Load::DB();
	$msg=$db->findone('msg',['_id'=>'live_program'],['msg'=>1]);
	Load::$core->assign('program',$msg['msg']);
	
	
	Load::$core->data['content']=Load::$core->fetch('football.live-program');
#	$cache->set('ca1','football_live_program',Load::$core->data['content'],false,3600);
#}



?>