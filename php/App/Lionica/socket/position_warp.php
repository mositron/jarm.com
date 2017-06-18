<?php

$warp_config=array(
	'1_79_36'=>array('_id'=>2,'x'=>36,'y'=>1),
	'2_0_36'=>array('_id'=>1,'x'=>36,'y'=>78),
	'2_64_0'=>array('_id'=>3,'x'=>78,'y'=>64),
	'3_64_79'=>array('_id'=>2,'x'=>1,'y'=>64),
	'3_0_42'=>array('_id'=>4,'x'=>42,'y'=>78),
	'4_79_42'=>array('_id'=>3,'x'=>42,'y'=>1),
	'4_0_45'=>array('_id'=>6,'x'=>45,'y'=>78),
	'6_79_45'=>array('_id'=>4,'x'=>45,'y'=>1),

);
$k=$this->map['_id'].'_'.$arg['y'].'_'.$arg['x'];

if(isset($warp_config[$k]))
{
	$update['map']=$this->char['map']=$warp_config[$k];
	$refresh=true;

}
?>