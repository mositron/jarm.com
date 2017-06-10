<?php


$tmp=require(HANDLERS.'config/radio.php');

$radio=[];
foreach($tmp as $k=>$v)
{
	if($v['py']['streamer'])
	{
		$v['file']=$v['py']['streamer'].'/'.$v['py']['file'];
	}
	else
	{
		$v['file']=$v['py']['file'];
	}
	$v['swf']=($v['py']['swf']?$v['py']['swf']:'');
	unset($v['ty'],$v['py']);
	$radio[$k]=$v;
}


Load::$core->assign('radio',$radio);



Load::$core->data['content']=Load::$core->fetch('radio.home');



?>
