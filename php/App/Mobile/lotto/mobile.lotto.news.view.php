<?php



$db=Load::DB();


if(!$news=$db->findone('news',array('_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false],'pl'=>1),['_id'=>1,'c'=>1,'cs'=>1,'cs2'=>1,'t'=>1,'sm'=>1,'d'=>1,'fd'=>1]))
{
	exit;
}


Load::$core->assign('parent','/lotto/news');
Load::$core->assign('news',$news);

Load::$core->data['content']=Load::$core->fetch('lotto.news.view');
?>