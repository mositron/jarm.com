<?php



$db=Load::DB();
if(!$weather=$db->findone('weather',array('_id'=>intval(Load::$path[1]))))
{
	Load::move('/weather',true);	
}


Load::$core->assign('z',$weather['zone']);
Load::$core->assign('weather',$weather);
Load::$core->data['content']=Load::$core->fetch('weather.place.view');



?>