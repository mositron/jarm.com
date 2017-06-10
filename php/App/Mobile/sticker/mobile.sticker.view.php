<?php
define('HIDE_SIDEBAR',1);

if(!is_numeric(Load::$path[1]))
{
	Load::move('/sticker',true);	
}


$db=Load::DB();
if(!$app=$db->findOne('sticker',array('_id'=>intval(Load::$path[1]),'pl'=>1,'dd'=>['$exists'=>false])))
{
	Load::move('/sticker',true);
}


Load::$core->assign('parent',$_GET['parent']?$_GET['parent']:'/sticker/recent');
Load::$core->assign('app',$app);
Load::$core->assign('icon',$db->find('sticker_icon',['p'=>$app['_id'],'dd'=>['$exists'=>false]]));
Load::$core->data['content']=Load::$core->fetch('sticker.view');


?>