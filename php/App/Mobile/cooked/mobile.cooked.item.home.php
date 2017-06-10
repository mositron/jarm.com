<?php


$db=Load::DB();

if(!Load::$path[1] || !$user=$db->findone('cooked_user',array('_id'=>intval(Load::$path[1]))))
{
	Load::move('/cooked');	
}

Load::Ajax()->register(['delitem']);


$pp=50;
extract(Load::Split()->get('/cooked/item',1,['page']));

if(!$page || $page<1)$page=1;

$db=Load::DB();
if($count=$db->count('cooked',['dd'=>['$exists'=>false]]))
{
	list($pg,$skip)=Load::Pager()->navigation($pp,$count,[$url,'page-'],$page);
	$cooked=$db->find('cooked',['dd'=>['$exists'=>false]],[],['sort'=>['_id'=>-1],'skip'=>$skip,'limit'=>$pp]);
}


Load::$core->assign('parent','/cooked');
Load::$core->assign('page',$page);
Load::$core->assign('maxpage',ceil($count/$pp));
Load::$core->assign('cooked',$cooked);
Load::$core->assign('cur','?parent='.urlencode(URL));

Load::$core->data['content']=Load::$core->fetch('cooked.item.home');



function delitem($id)
{
	global $user;
	$db=Load::DB();
	$ajax=Load::Ajax();
	if($cooked=$db->findone('cooked',array('_id'=>intval($id))))
	{
		$db->update('cooked',['_id'=>$cooked['_id']],array('$set'=>array('dd'=>Load::Time()->now())));
	}
	$ajax->redirect(URL);
}

?>