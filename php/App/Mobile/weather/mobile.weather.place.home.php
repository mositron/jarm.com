<?php

extract(Load::Split()->get('/weather/place/',1,['z']));

$z=intval($z);
if($z<1||$z>6)
{
	$z=3;
}


$db=Load::DB();

$weather=$db->find('weather',['zone'=>$z],['_id'=>1,'name'=>1,'zone'=>1,'today'=>1],['sort'=>['name'=>1]]);

Load::$core->assign('z',$z);
Load::$core->assign('weather',$weather);
Load::$core->data['content']=Load::$core->fetch('weather.place.home');



?>