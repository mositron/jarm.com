<?php


$db=Load::DB();

if(!Load::$path[1] || !$user=$db->findone('cooked_user',array('_id'=>intval(Load::$path[1]))))
{
	Load::move('/cooked');	
}

if(!is_array($user['ft']))
{
	$user['ft']=[];
}

Load::Ajax()->register(['newfilter','editfilter','delfilter','get','select']);

Load::$core->assign('parent','/cooked');
Load::$core->assign('user',$user);
Load::$core->data['content']=Load::$core->fetch('cooked.new');



function get()
{
	global $user;
	$db=Load::DB();
	$ajax=Load::Ajax();
	$arg=['dd'=>['$exists'=>false]];
	if(count($user['ft'])>0)
	{
		$ft=[];
		foreach($user['ft'] as $v)
		{
			$ft[]=['m'=>['$ne'=>$v['n']]];
		}
		$arg['$and']=$ft;
	}
	if($count=$db->count('cooked',$arg))
	{
		$rand=rand(-99999,99999);
		$rand=rand(0,$count-1);
		$item=$db->find('cooked',$arg,[],['sort'=>['_id'=>1],'skip'=>$rand,'limit'=>1]);
		$ajax->jquery('#result','html','<h3>'.$item[0]['n'].'</h3><p>วัตถุดิบ: '.implode(', ',$item[0]['m']).'</p><div><div><input type="button" class="btn left" value=" เลือกเมนูนี้ " onclick="m.select('.$item[0]['_id'].')"><input type="button" class="btn right" value=" สุ่มเมนูใหม่ " onclick="m.get()"></div></div>');	
	}
	else
	{
		$ajax->jquery('#result','html','<div>ไม่มีเมนูอาหารที่คุณต้องการ</div>');	
	}
}


function select($id)
{
	global $user;
	$db=Load::DB();
	$ajax=Load::Ajax();
	if($item=$db->findone('cooked',array('_id'=>intval($id))))
	{
		$db->insert('cooked_line',['u'=>$user['_id'],'un'=>$user['name'],'ufb'=>$user['fb'],'c'=>$item['_id'],'cn'=>$item['n'],'cm'=>$item['m']]);
		$ajax->script('m.complete('.json_encode($item).');');
	}
}

function newfilter($n,$ac=0)
{
	global $user;
	$db=Load::DB();
	if(($n=trim($n))&&count($user['ft'])<30)
	{
		$found=-1;
		foreach($user['ft'] as $k=>$v)
		{
			if($v['n']==$n)
			{
				$found=$k;	
			}
		}
		if($found!=-1)
		{
			$user['ft'][$found]=['n'=>$n,'ty'=>$ac];	
		}
		else
		{
			$user['ft'][]=['n'=>$n,'ty'=>$ac];	
		}
		$db->update('cooked_user',['_id'=>$user['_id']],['$set'=>['ft'=>$user['ft']]]);
	}
	getfilter();
}

function editfilter($n,$n2)
{
	global $user;
	if(($n=trim($n))&&($n2=trim($n2)))
	{
		$found=-1;
		foreach($user['ft'] as $k=>$v)
		{
			if($v['n']==$n)
			{
				$found=$k;	
			}
		}
		$found2=-1;
		foreach($user['ft'] as $k=>$v)
		{
			if($v['n']==$n2)
			{
				$found2=$k;	
			}
		}
		if($found!=-1&&$found2==-1)
		{
			$user['ft'][$found]=array('n'=>$n2,'ty'=>intval($user['ft'][$found]['ty']));	
			Load::DB()->update('cooked_user',['_id'=>$user['_id']],['$set'=>['ft'=>$user['ft']]]);
		}
	}
	_:ajax()->jquery('#filter','append',$n.' - '.$n2.'<br>');
	getfilter();
}

function delfilter($n)
{
	global $user;
	if($n=trim($n))
	{
		$found=-1;
		foreach($user['ft'] as $k=>$v)
		{
			if($v['n']==$n)
			{
				$found=$k;	
			}
		}
		if($found!=-1)
		{
			unset($user['ft'][$found]);
			Load::DB()->update('cooked_user',['_id'=>$user['_id']],array('$set'=>array('ft'=>array_values($user['ft']))));
		}
	}
	getfilter();
}

function getfilter()
{
	global $user;
	$tmp='';
	for($i=count($user['ft'])-1;$i>=0;$i--)
	{
		$v=$user['ft'][$i];
		$tmp.='<li><a href="/cooked/filter/'.urlencode($v['n']).'/'.$v['ty'].'"><strong>'.$v['n'].'</strong><i></i></a></li>';
	}
	Load::Ajax()->jquery('#filter_in','html','<ul>'.$tmp.'</ul>');
}
?>