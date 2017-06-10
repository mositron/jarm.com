<?php


$db=Load::DB();

if(!Load::$path[2] || !$user=$db->findone('cooked_user',array('_id'=>intval(Load::$path[2]))))
{
	Load::move('/cooked');	
}

Load::Ajax()->register(['newitem']);

Load::$core->assign('parent','/cooked');
Load::$core->assign('user',$user);
Load::$core->data['content']=Load::$core->fetch('cooked.item.add');



function newitem($arg)
{
	global $user;
	$db=Load::DB();
	$ajax=Load::Ajax();
	$n=trim($arg['name']);
	$m=array_values(array_filter(array_unique(array_map('trim',(array)$arg['mat']))));
	if($n&&count($m)>1)
	{
		if($db->findone('cooked',['n'=>$n]))
		{
			$ajax->alert('มีเมนูอาหารนี้อยู่ในระบบแล้ว');	
		}
		else
		{
			$db->insert('cooked',['n'=>$n,'m'=>$m,'ac'=>0]);
			$ajax->alert('เพิ่มเมนูเรียบร้อย');
		}
	}
}

?>