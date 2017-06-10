<?php
define('HIDE_SIDEBAR',1);

if(!is_numeric(Load::$path[1]))
{
	Load::move('/saying',true);	
}


$db=Load::DB();
if(!$app=$db->findOne('saying',array('_id'=>intval(Load::$path[1]),'pl'=>1,'dd'=>['$exists'=>false])))
{
	Load::move('/saying',true);
}


Load::$core->assign('parent',$_GET['parent']?$_GET['parent']:'/saying/recent');
Load::$core->assign('app',$app);
Load::$core->assign('icon',$db->find('saying_icon',['p'=>$app['_id'],'dd'=>['$exists'=>false]]));
Load::$core->data['content']=Load::$core->fetch('saying.view');


?>