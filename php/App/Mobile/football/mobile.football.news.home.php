<?php

$pp=50;
extract(Load::Split()->get('/football/news/'.Load::$path[1],1,['page']));

$db=Load::DB();
$_=['c'=>['$in'=>[421,422,423,424,425,426,427,428]],'dd'=>['$exists'=>false]];
if($count=$db->count('forum',$_))
{
	list($pg,$skip)=Load::Pager()->navigation($pp,$count,[$url,'page-'],$page);
	$news=$db->find('forum',$_,['_id'=>1,'fd'=>1,'t'=>1,'c'=>1,'do'=>1,'da'=>1],['sort'=>['_id'=>-1],'skip'=>$skip,'limit'=>$pp]);
}


if(!$page || $page<1)$page=1;

Load::$core->assign('news',$news);
Load::$core->assign('parent','/football');
Load::$core->assign('page',$page);
Load::$core->assign('maxpage',ceil($count/$pp));
Load::$core->assign('cur','?parent='.urlencode(URL));
Load::$core->data['content']=Load::$core->fetch('football.news.home');

?>