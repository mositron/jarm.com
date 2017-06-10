<?php
define('HIDE_REQUEST',1);

$pp=50;

$db=Load::DB();
$count=$db->count('guess',['pl'=>1,'dd'=>['$exists'=>false]]);

extract(Load::Split()->get('/guess/hit',1,['page']));
if(!$page || $page<1)$page=1;
list($pg,$skip)=Load::Pager()->navigation($pp,$count,['/guess/recent/','page-'],$page);

$app=$db->find('guess',['pl'=>1,'dd'=>['$exists'=>false]],['_id'=>1,'t'=>1,'d'=>1,'img'=>1,'c'=>1,'l'=>1,'fd'=>1,'p'=>1,'u'=>1,'do'=>1,'f'=>1],['sort'=>['do'=>-1],'skip'=>$skip,'limit'=>$pp]);


Load::$core->assign('parent','/guess');
Load::$core->assign('page',$page);
Load::$core->assign('maxpage',ceil($count/$pp));
Load::$core->assign('app',$app);
Load::$core->assign('cur','?parent='.urlencode(URL));
Load::$core->assign('user',Load::User());
Load::$core->data['content']=Load::$core->fetch('guess.hit');

?>
