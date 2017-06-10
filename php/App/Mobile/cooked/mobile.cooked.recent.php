<?php


if(!Load::$path[1])
{
	Load::move('/cooked');	
}
$db=Load::DB();
$cooked=$db->find('cooked_line',array('u'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]),[],['sort'=>['_id'=>-1],'limit'=>50]);

Load::$core->assign('parent','/cooked');
Load::$core->assign('cooked',$cooked);
Load::$core->data['content']=Load::$core->fetch('cooked.recent');


?>