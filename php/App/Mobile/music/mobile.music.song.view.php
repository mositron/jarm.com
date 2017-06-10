<?php

$db=Load::DB();



if(!$music=$db->findone('music',array('_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false])))
{
	Load::move('/music/song');
}
Load::Ajax()->register('setvdo');

$db->update('music',['_id'=>$music['_id']],['$inc'=>['do'=>1]]);

$music['sn2']=$music['sn'];
$z=mb_strpos($music['sn'],'(',0,'utf-8');
if($z>3)
{
	$music['sn2']=trim(mb_substr($music['sn'],0,$z,'utf-8'));
}

$music['ly']=nl2br($music['ly']);

$relate=$db->find('music',['_id'=>['$ne'=>$music['_id']],'ar'=>$music['ar'],'al'=>$music['al'],'dd'=>['$exists'=>false]],['_id'=>1,'sn'=>1],['sort'=>['_id'=>-1],'limit'=>20]);


Load::$core->assign('type',['rs'=>'RS','gm'=>'GMM','yp'=>'']);
Load::$core->assign('c',$music['c']);
Load::$core->assign('music',$music);
Load::$core->assign('relate',$relate);


Load::$core->assign('parent','/music/song');
Load::$core->assign('cur','?parent='.urlencode(URL));

Load::$core->data['content']=Load::$core->fetch('music.song.view');

?>