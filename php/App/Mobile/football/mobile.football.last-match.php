<?php



//$cache=Load::$core;
//if(!Load::$core->data['content']=$cache->get('ca1','football_last_match'))
//{
	$db=Load::DB();
	$match=[];
	$d2=strtotime(date('Y-m-d 05:00:00'));
	if($d2>time())
	{
		$d2=$d2-(86400);
	}
	$d1=$d2-(86400*30);
	if($dd=$db->distinct('football_match','ky',array('tm'=>array('$gte'=>Load::Time()->from($d1),'$lt'=>Load::Time()->from($d2)))))
	{
		rsort($dd);
		$dd=array_slice($dd,0,2);
	}
	for($i=0;$i<count($dd);$i++)
	{
		$d1=strtotime($dd[$i].' 05:00:00');
		$d2=$d1+(86400);
		$match[]=array(
												'tm'=>Load::Time()->from($d1),
											 	'list'=>$db->find('football_match',array('ft'=>['$ne'=>''],'tm'=>array('$gte'=>Load::Time()->from($d1),'$lt'=>Load::Time()->from($d2))),['_id'=>1,'_ng'=>1,'t1'=>1,'t2'=>1,'ft'=>1,'ht'=>1,'fp'=>1,'hp'=>1,'tm'=>1,'lg'=>1],['sort'=>['lg'=>1,'tm'=>1]]),
												'next'=>false,
										);
	}

	Load::$core->assign('match',$match);

	Load::$core->data['content']=Load::$core->fetch('football.last-match');
//	$cache->set('ca1','football_last_match',Load::$core->data['content'],false,3600);
//}
?>
