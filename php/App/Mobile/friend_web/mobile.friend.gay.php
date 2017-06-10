<?php

$pp=50;
$parm=Load::Split()->get('/friend/gay',1,['page','province','min','max']);
$page=intval($parm['page']);
$_province=strval($parm['province']);
$_min=intval(strval($parm['min'])?strval($parm['min']):0);
$_max=intval(strval($parm['max'])?strval($parm['max']):60);

Load::$core->assign('_province',$_province);
Load::$core->assign('_min',$_min);
Load::$core->assign('_max',$_max);

$arg=['dd'=>['$exists'=>false],'ty'=>'gay'];
if($_province)
{
	$arg['pr']=array('$in'=>array_map('intval',explode('_',$_province)));
}
$arg['ag']=[];
if($_min)
{
	$arg['ag']['$gte']=$_min;
}
if($_max)
{
	$arg['ag']['$lte']=$_max;
}


if(!$page || $page<1)$page=1;

$db=Load::DB();
if($count=$db->count('appfriend',$arg))
{
	list($pg,$skip)=Load::Pager()->navigation($pp,$count,[$parm['url'],'page-'],$page);
	$friend=$db->find('appfriend',$arg,[],['sort'=>['ds'=>-1],'skip'=>$skip,'limit'=>$pp]);
}


Load::$core->assign('friend',$friend);
Load::$core->assign('parent','/friend');
Load::$core->assign('page',$page);
Load::$core->assign('parm',$parm);
Load::$core->assign('maxpage',ceil($count/$pp));
Load::$core->assign('cur','?parent='.urlencode(URL));

Load::$core->data['content']=Load::$core->fetch('friend.gay');

?>
