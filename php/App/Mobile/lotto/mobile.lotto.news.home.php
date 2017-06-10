<?php



$db=Load::DB();
$news=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['pl'=>1,'c'=>22,'exl'=>0],[],['limit'=>30]);
Load::$core->assign('news',$news);
Load::$core->assign('parent','/lotto');
Load::$core->data['content']=Load::$core->fetch('lotto.news.home');

?>
