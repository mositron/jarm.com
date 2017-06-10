<?php
$db=Load::DB();
$sarg=['_id'=>1,'t'=>1,'c'=>1,'d'=>1,'da'=>1,'fd'=>1,'f'=>1,'o'=>1,'ip'=>1,'s'=>1,'dd'=>1,'e'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>['$slice'=>[-20,20]]];
if(!$news = $db->findone('forum',array('_id'=>intval(Load::$path[1])),$sarg))
{
	echo 'not found';
	exit;	
}

Load::$core->assign('parent','/football/news');
Load::$core->assign('news',$news);

Load::$core->data['content']=Load::$core->fetch('football.news.view');
?>