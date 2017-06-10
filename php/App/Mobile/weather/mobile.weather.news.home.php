<?php

extract(Load::Split()->get('/weather/news/',1,['page']));

if(!$page || $page<1)
{
  $page=1;
}

$db=Load::DB();

$_=['dd'=>['$exists'=>false],'pl'=>1,'c'=>21,'exl'=>0];

$pp=30;
if($count=$db->count('news',$_))
{
  list($pg,$skip)=Load::Pager()->navigation($pp,$count,[$url,'page-'],$page);
  $news=(new \Jarm\App\News\Service(['ignore'=>1]))->find($_,[],['skip'=>$skip,'limit'=>$pp]);
}


Load::$core->assign('news',$news);

Load::$core->assign('parent','/weather');
Load::$core->assign('page',$page);
Load::$core->assign('maxpage',ceil($count/$pp));
Load::$core->assign('cur','?parent='.urlencode(URL));

Load::$core->data['content']=Load::$core->fetch('weather.news.home');

?>
