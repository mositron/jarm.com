<?php

Load::Ajax()->register(['newfriend','delms']);


$pp=50;
$parm=Load::Split()->get('/friend',0,['type','province','min','max']);


$_province=strval($parm['province']);
$_type=strval($parm['type']);
$_min=intval(strval($parm['min'])?strval($parm['min']):0);
$_max=intval(strval($parm['max'])?strval($parm['max']):60);

Load::$core->assign('_province',$_province);
Load::$core->assign('_type',$_type);
Load::$core->assign('_min',$_min);
Load::$core->assign('_max',$_max);

$arg=['dd'=>['$exists'=>false]];
if($_province)
{
	$arg['pr']=array('$in'=>array_map('intval',explode('_',$_province)));
}
if($_type)
{
	$arg['ty']=$_type;
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

Load::$core->assign('friend',Load::DB()->find('appfriend',$arg,[],['sort'=>['_id'=>-1],'limit'=>$pp]));
Load::$core->data['content']=Load::$core->fetch('friend.home');

function delms($id)
{
	$db=Load::DB();
	$ajax=Load::Ajax();	
	if($m=$db->findone('appfriend',array('_id'=>intval($id),'dd'=>['$exists'=>false])))
	{
		$db->update('appfriend',['_id'=>$m['_id']],array('$set'=>array('dd'=>Load::Time()->now(),'dd_fb'=>$fb_id)));
		$ajax->script('alert("ลบข้อความเรียบร้อยแล้ว")');
		$ajax->script('$(".ms-'.$m['_id'].'").remove();');
	}
	else
	{
		$ajax->script('alert("ข้อความนี้ถูกลบไปแล้ว")');
	}
}
function newfriend($arg)
{
	$db=Load::DB();
	$ajax=Load::Ajax();	
	$fb_id=trim($arg['fb_id']);
	$fb_name=trim($arg['fb_name']);
	$province=intval(trim($arg['province']));
	$type=trim($arg['type']);
	$age=intval(trim($arg['age']));
	$line=trim($arg['line']);
	$msg=trim($arg['msg']);
	if($fb_id&&$fb_name&&$province&&$type&&$age&&$msg)
	{
		$db->insert('appfriend',array(
															'pr'=>$province,
															'ty'=>$type,
															'ms'=>$msg,
															'ag'=>$age,
															'fb_id'=>$fb_id,
															'fb_name'=>$fb_name,
															'line'=>$line,
															'ds'=>Load::Time()->now(),
															'ip'=>$_SERVER['REMOTE_ADDR'],
															));
			
		$ajax->redirect('/friend?action=completed');	
	}
	else
	{
		$ajax->script('aelrt("ข้อมูลไม่ครบ กรุณาลองใหม่อีกครั้ง")');	
	}
}
?>
