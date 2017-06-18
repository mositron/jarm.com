<?php

$refresh=false;
$update=array();
if(isset($this->map['life'][$arg['y'].'_'.$arg['x']]))
{
	$l2=trim($this->map['life'][$arg['y'].'_'.$arg['x']]);
	$mons=$this->config('life');
	if(isset($mons[$l2]))
	{
		$life=$mons[$l2];
		require(SOCKET_PATH.'position_'.($life['type']=='boss'?'monster':$life['type']).'.php');
		
		$update['du']=new MongoDate();
		$update['hp']=$this->char['hp'];
		$update['mp']=$this->char['mp'];
		
		$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$set'=>$update));
		if($refresh)
		{
			play(array('_id'=>$this->char['_id']));
			//$this->ajax->redirect(URL);	
		}
	}
}

function return_damage($atk,$def,$is_pet=true)
{
	
	#											array('lv'=>$this->char['lv'],'atk'=>$this->char['atk'],'hit'=>$this->char['hit'],'free'=>$this->char['free'],'ele'=>$this->char['ele']['atk']),
	#											array('lv'=>$mon['lv'],'def'=>$mon['def'],'hit'=>$mon['hit'],'free'=>$mon['free'],'ele'=>$mon['ele']),
												
	/*
	if(rand(1,100) <= ($miss*10))
	{
		return 0;
	}
	*/
	if($atk['hit']<=$def['free'])
	{
		$miss=20;
	}
	elseif($atk['hit']-20<=$def['free'])
	{
		$miss=40+(min($atk['hit']-$def['free'],20)*2);
	}
	elseif($atk['hit']-40<=$def['free'])
	{
		$miss=80+(min($atk['hit']-$def['free'],40)/4);
	}
	else
	{
		$miss=90;
	}
	
	//return $miss;

	if(rand(1,100) > $miss)
	{
		return 0;
	}
	
	
	if($is_pet)
	{
		$dmg = ($atk['atk']-$def['def'])+ ceil($atk['atk']/2)+min(0,($atk['lv']-$def['lv'])*3);
		$atk['ele']=$atk['ele']['atk'];
	}
	else
	{
		$dmg = ($atk['atk']-$def['def'])+ ceil($atk['atk']/2)+max(0,($atk['lv']-$def['lv'])*3);
		$def['ele']=$def['ele']['def'];
	}
	$min=($dmg*0.5)*(1+($atk['hit']/200));
	$dmg = floor(rand($min,$dmg));
	if($atk['ele']&&$def['ele'])
	{
		/*
		ไฟ ชนะ ลม
ลม ชนะ ดิน
ดิน ชนะ สายฟ้า
สายฟ้า ชนะ น้ำ
น้ำ ชนะ ไฟ
*/
		$fold=array(
								'1-5'=>2,
								'1-4'=>0.5,
								'1-1'=>0.5,
								'2-3'=>2,
								'2-5'=>0.5,
								'2-2'=>0.5,
								'3-4'=>2,
								'3-2'=>0.5,
								'3-3'=>0.5,
								'4-1'=>2,
								'4-3'=>0.5,
								'4-4'=>0.5,
								'5-2'=>2,
								'5-1'=>0.5,
								'5-5'=>0.5,
								
		);
		$ele=$atk['ele'].'-'.$def['ele'];
		if(isset($fold[$ele]))
		{
			$dmg=ceil($dmg*$fold[$ele]);
		}
	}
	if ($dmg<1)
	{
		$dmg=1;
		//$a=min(abs($dmg)+1,7);
		//$b=$a+3;
		//$dmg=((rand(0,$b)>=$a)?1:0);	
	}
	return  $dmg;
}

// '306-99,308-999,309-999,321-1999,322-1999,323-1999,324-1999,325-1999,'

function return_dropitem($item,$fold=1)
{
	if(!$i=return_drop('306-299,308-1499,309-1499,310-19,314-3999,315-3999,316-3999,317-3999,318-3999,321-1999,322-1999,323-1999,324-1999,325-1999',$fold))
	{
		$i=return_drop($item,$fold);
	}
	return $i;
}

function return_drop($item,$fold=1)
{
	# DROP x100;
	//$fold/=100;
	//$item=.$item;
	$m_2=0;
	$m = explode(',',trim($item));
	$i = rand(0,count($m)-1);
	$m_1 = explode('-',trim($m[$i]));
	if($max=intval($m_1[1]))
	{
		if (rand(0,$max*$fold) <= 1)
		{
			$m_2 = intval($m_1[0]);
		}
	}
	return $m_2;
}
?>