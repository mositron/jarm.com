<?php


$db=Load::DB();

$allby=['desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง'];
extract(Load::Split()->get('/music/song/',1,['sn','ar','q','page']));

$sort=['_id'=>-1];
$_=['dd'=>['$exists'=>false]];

if(isset($q))
{
	if($q=trim($q))
	{
		$qr=new MongoDB\BSON\Regex(trim($q),'i');
		$_['$or']=[['sn'=>$qr],['al'=>$qr],['ar'=>$qr]];
	}
	else
	{
		unset($q);
	}
}
elseif(isset($sn))
{
	$sort=['sn'=>1];
	$_['fc.sn']=$sn;
}
elseif(isset($ar))
{
	$sort=['ar'=>1];
	$_['fc.ar']=$ar;
}

$pp=50;
if(!$page || $page<1)
{
	$page=1;
}
if($count=$db->count('music',$_))
{
	list($pg,$skip)=Load::Pager()->navigation($pp,$count,[$url,'page-'],$page);
	$music=$db->find('music',$_,['_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'sn'=>1,'ar'=>1,'al'=>1,'yt'=>1,'da'=>1],['sort'=>$sort,'skip'=>$skip,'limit'=>$pp]);
}

Load::$core->assign('c',$c);
Load::$core->assign('music',$music);
Load::$core->assign('pager',$pg);
Load::$core->assign('sn',$sn);
Load::$core->assign('ar',$ar);
Load::$core->assign('q',$q);

Load::$core->assign('parent','/music');
Load::$core->assign('page',$page);
Load::$core->assign('maxpage',ceil($count/$pp));
Load::$core->assign('cur','?parent='.urlencode(URL));


Load::$core->data['content']=Load::$core->fetch('music.song.home');

?>
