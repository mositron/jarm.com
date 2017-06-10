<?php
if(!isset($_league[Load::$path[1]]))
{
	Load::$path[1]=1;
//	Load::move('/football');
}
$l=$_league[Load::$path[1]];

$db=Load::DB();


$arg=array('lg'=>intval(Load::$path[1]));
if($l['s'])
{
	$arg['sea']=$l['s'];
}

$score=$db->find('football_score',$arg,[],['sort'=>['r'=>1]]);


Load::$core->assign('league',[1=>$_league[1],5=>$_league[5],4=>$_league[4],3=>$_league[3],6=>$_league[6],7=>$_league[7]]);
Load::$core->assign('score',$score);
if($l['ty']=='l')
{
	Load::$core->data['content']=Load::$core->fetch('football.score.view.league');
}
else
{
	Load::$core->data['content']=Load::$core->fetch('football.score.view.cup');
}
?>