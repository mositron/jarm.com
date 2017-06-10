<?php

define('APP_VERSION','1.0');



$serv=[
						''=>'home',
						'home' => 'home',
						'league'=>'league',
						'team'=>'team',
						'match'=>'match',
						'news'=>'news',
						'calendar'=>'calendar',
						'score'=>'score',
						'last-match'=>'last-match',
						'analyze'=>'analyze',
						'next-match'=>'next-match',
						'live-score'=>'live-score',
						'live-program'=>'live-program',
						'top-goal'=>'top-goal',
						'highlight'=>'video',
						'online'=>'online',
						'rate'=>'rate',
						'radio'=>'radio',
						'match-updater'=>'match-updater',
						'worldcup'=>'worldcup',
						'apps'=>'apps',
];



$cache=Load::$core;
if(!$data=$cache->get('mobile/football-global',3600))
{
	$db=Load::DB();
	$data=['_team'=>[],'_score'=>[],'_sexy'=>[],'_live'=>0,'_banner'=>[],'_league'=>[]];

	$tmp=$db->find('football_team',[],['_id'=>1,'_ng'=>1,'t'=>1,'n'=>1,'l'=>1,'fd'=>1,'png'=>1],['sort'=>['n'=>1]],false);
	foreach($tmp as $v)
	{
		$v['f']=($v['t']?$v['t']:$v['n']);
		if(!$v['t'])$v['t']=$v['n'];
		$data['_team'][$v['_id']]=$v;
	}

	$tmp=$db->find('football_league',[],[],['sort'=>['so'=>1,'_id'=>1]],false);
	foreach($tmp as $v)
	{
		$data['_league'][$v['_id']]=$v;
	}

	$cache->set('mobile/football-global',$data);
}


$_team=$data['_team'];
$_league=$data['_league'];


Load::$core->assign('cate',$cate);
Load::$core->assign('_league',$_league);
Load::$core->assign('_team',$data['_team']);


if(isset($serv[Load::$path[0]]))
{
	require_once(__DIR__.'/mobile.football.'.$serv[Load::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.football.home.php');
}


echo Load::$core->fetch('football');
exit;
?>
