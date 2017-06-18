<?php

$update['map.x']=$this->char['map']['x']=intval($arg['pos']['x']);
$update['map.y']=$this->char['map']['y']=intval($arg['pos']['y']);
$update['last']=array('x'=>$update['map.x'],'y'=>$update['map.y'],'xy'=>$arg['x'].':'.$arg['y'],'atk'=>0,'time'=>microtime(true));
$valid=false;
if($this->char['last'])
{
	$delay=($this->char['last']['atk'] * 0.1);
	if($this->char['last']['xy'] == $update['last']['xy'])
	{
		$delay+=10;
	}
	else
	{
		//((4*50)+50)*$far;
		$dist=sqrt(pow($update['last']['x']-$this->char['last']['x'],2)+pow($update['last']['y']-$this->char['last']['y'],2));
		$far=array(1=>1,2=>3,3=>2,4=>1);
		$delay+=((0.40*max(0,$dist-$far[$this->char['job']]))+1);
		
		// test
		//$delay-=1;
	}
	if(($this->char['last']['time'] > $update['last']['time']-$delay))
	{
		$valid=array('ms'=>'ระบบทำงานเร็วเกินไป กรณารอซักครู่...');
	}
	
	
	if(!is_array($this->char['last']['mon']))
	{
		$this->char['last']['mon']=array();
	}
	if($this->char['last']['mon'][$update['last']['xy']])
	{
		$lastmon=$this->char['last']['mon'][$update['last']['xy']];
		if($lastmon+10>$update['last']['time'])
		{
			$valid=array('ms'=>'มอนสเตอร์ตัวนี้พึ่งตายไป ยังไม่ถึงเวลาเกิด...');
		}
	}
	else
	{
		$this->char['last']['mon'][$update['last']['xy']]=$update['last']['time'];
	}
	if(count($this->char['last']['mon'])>10)
	{
		$this->char['last']['mon']=array();
	}
	$update['last']['mon']=$this->char['last']['mon'];
	
}
if(_::$my['_id']==1)
{
	$info=array();
	$info[]=array('type'=>'debug','text'=>($update['last']['time']-$delay-$this->char['last']['time']).' <!--['.$this->char['last']['time'].' > '.($update['last']['time']-$delay).'] ['.$update['last']['time'].'-'.$delay.' : '.$this->char['last']['atk'].']-->');
	$this->ajax->script('_.lionica.logs('.json_encode($info).')');
}

if($this->char['job']==2)
{
	if($this->char['mp']<3)
	{
		$valid=array('ms'=>'MP ไม่เพียงพอ.');
	}
	else
	{
		$this->char['mp']-=3;
	}
}

if($valid)
{
	//$update['last']['time']+=1;
	$info=array();
	$info[]=array('type'=>'debug','text'=>'<p class="logs-info">'.$valid['ms'].'</p>');
	$this->ajax->script('_.lionica.logs('.json_encode($info).')');
}
else
{
	$mon=$life;
	$m_hp=intval($mon['hp']);
	
	if(!is_array($arg['skill']))
	{
		$arg['skill']=array();	
	}
	$skill=array();
	$skills=require(CONFIG_PATH.'skill.php');	
	foreach($skills as $k=>$v)
	{
		if(in_array($k,$arg['skill'])&&$v['type']=='atk')
		{
			if(in_array($this->char['job'],$v['job']))
			{
				$skill[]=$v;
			}
		}
	}
	$super=false;
	if(in_array(_::$my['_id'],array(1162,19617,57290,19255,33127)))
	{
		$super=true;
		$mon['atk']/=2;
		//$mon['free']/=1.2;
		//if(_::$my['_id']==33127)
		//{
			if(_::$my['_id']==1162)
			{
				$mon['exp']*=5;
			}
			elseif($this->char['lv']<55)
			{
			//	$mon['exp']*=2.2;
			}
			elseif($this->char['lv']<56)
			{
			//	$mon['exp']*=1.8;
			}
			else
			{
			//	$mon['exp']*=1.3;
			}
		//}
		//if(_::$my['_id']==19617)
		//{
			//$m_hp/=10;
			//$mon['exp']*=1;
		//}
	}
	
	# EXP X10;
	//$mon['exp']*=10;
	
	
	
	$useskill=0;
	$dead='';
	$info=array(array('type'=>'attack','monster'=>$arg['x'].'_'.$arg['y'],'hp'=>$this->char['hp']));
	while ($this->char['hp']>0 and $m_hp>0)
	{
		if($update['last']['atk']>30)
		{
			$mon['hit']+=5;
			$mon['atk']+=2;
		}
		$atk=return_damage($this->char,$mon,true);
		$info[]=array('type'=>'damage','def'=>'monster','atk'=>$atk,'text'=>'โจมตี '.$mon['name'].' '.(!$atk?' พลาด!':$atk));
		$m_hp -= $atk;
		$update['last']['atk']++;
		if ($m_hp<=0)
		{
			$dead = 'monster';
			break; 
		}
		
		$atk=return_damage($mon,$this->char,false);
		$info[]=array('type'=>'damage','def'=>'pet','atk'=>$atk,'text'=>$mon['name'].' โจมตี สัตว์เลี้ยง '.(!$atk?' พลาด!':$atk));
		$this->char['hp'] -= $atk;		
		$update['last']['atk']++;
		if ($this->char['hp']<=0)
		{	
			$dead = 'pet';
			break; 
		}
		
		$rand=rand(0,9);
		if($rand>=5)
		{
			$sk=false;
			if(count($skill))
			{
				$s=$skill[rand(0,count($skill)-1)];
				if($s['mp']<=$this->char['mp'])
				{
					$sk=$s;
				}
			}
			if($sk)
			{
				$atk=ceil(return_damage($this->char,$mon,true)*$sk['atk']);
				$info[]=array('type'=>'damage','def'=>'monster','atk'=>$atk,'text'=>'โจมตี '.$mon['name'].' ด้วยสกิล ['.$sk['name'].'] '.(!$atk?' พลาด!':$atk));
				$this->char['mp']-=$sk['mp'];
				$useskill++;
			}
			else
			{
				$atk=return_damage($this->char,$mon,true);
				$info[]=array('type'=>'damage','def'=>'monster','atk'=>$atk,'text'=>'โจมตี '.$mon['name'].' '.(!$atk?' พลาด!':$atk));
			}
			$m_hp -= $atk;	
			$update['last']['atk']++;
			if ($m_hp<=0)
			{
				$dead = 'monster';
				break; 
			}
		}
	}
	$msg='';
	if($dead=='monster')
	{
		$item=false;
		$msg.=$mon['name'].' ตาย!';
		$diflv=abs($mon['lv']-$this->char['lv']);
		$guild_xp=0;
		
		$earn_exp=intval($mon['exp']);
		if($this->char['lv']>=$this->config['max_level'])
		{
			$earn_exp=0;
			$earn_bux=0;
		}
		
		$earn_bux=0;
		if($drop=return_dropitem($mon['item'],floor($diflv/10)+1))
		{
			$items=$this->config('item');
			if(isset($items[$drop]))
			{
				$item=$items[$drop];
				$slot=0;
				if($item['can_ele'])
				{
					$rand=rand($mon['lv']-1,$mon['lv']+1);
					if($rand==$mon['lv'])
					{
						$slot=1;
						$item['name'].=' []';
					}
				}
				if($super)
				{
					$this->item_insert(_::$my['_id'],$drop,1,false,array('slot'=>$slot,'ele'=>0));
					$this->update_inventory();
				}
				else
				{
					$did=$this->db->insert('lionica_drop',array('u'=>_::$my['_id'],'p'=>$this->char['_id'],'item'=>$drop,'slot'=>$slot));
					$drop=array('n'=>$item['name'],'i'=>$drop,'c'=>$item['css'],'p'=>$this->char['_id'],'t'=>time(),'d'=>$did); 
					$this->ajax->script('_.lionica.drop('.json_encode($drop).')');
				}
			}
		}
		else
		{
			$rand=rand($mon['lv']-2,$mon['lv']+2);
			if($rand==$mon['lv'])
			{
				$earn_bux=rand(max($mon['lv']-5,2),$mon['lv']+2);
				if($earn_bux>0)
				{
					$this->char['silver']+=$earn_bux;
					$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$inc'=>array('silver'=>$earn_bux)));
					//$did=$this->db->insert('lionica_drop',array('u'=>_::$my['_id'],'p'=>$this->char['_id'],'item'=>-1,'silver'=>$earn_bux));
					//$drop=array('n'=>$earn_bux.' Silver','i'=>$drop,'c'=>'-456px -360px','p'=>$this->char['_id'],'t'=>time(),'d'=>$did); 
					//$this->ajax->script('_.lionica.drop('.json_encode($drop).')');
				}
			}
		}
		if($earn_exp)
		{
			if($this->char['g']&&$this->char['g']['lv'])
			{
				$guild_xp=$this->char['g']['lv'];
			}
			$this->char['xp'] += ($earn_exp+$guild_xp);
		}
		if($this->char['pet'])
		{
			$this->char['pet']['status']['xp']++;
			if($this->char['pet']['status']['xp']>=$this->char['pet']['status']['mxp'])
			{
				$this->char['pet']['status']['lv']++;
				$this->char['pet']['status']['xp']=0;
				$this->char['pet']['status']['mhp']=100+(($this->char['pet']['status']['lv']-1)*15);
				$this->char['pet']['status']['mxp']=((100*pow($this->char['pet']['status']['lv']-1,3))+($this->char['pet']['status']['lv']*100));
				
				$update['pet.status.lv']=$this->char['pet']['status']['lv'];
				$update['pet.status.mhp']=$this->char['pet']['status']['mhp'];
				$update['pet.status.mxp']=$this->char['pet']['status']['mxp'];
			}
			$update['pet.status.xp']=$this->char['pet']['status']['xp'];
		}
		if($this->char['xp']>=$this->char['mxp'])
		{
			$this->next_lv();
			
			//$this->char['mxp']=((70*pow($this->char['lv']-1,3))+($this->char['lv']*100));
			$this->char['hp']=$this->char['mhp'];
			$this->char['mp']=$this->char['mmp'];
			
			if(!in_array(_::$my['_id'],array(1162,19617,57290,19255,33127)))
			{
				$this->chat_message('[Lionica] '.$this->char['n'].' อัพเลเวล '.$this->char['lv'].'!.');
			}
			$update['lv']=$this->char['lv'];
			$update['mxp']=$this->char['mxp'];
		}
		$update['xp'] = $this->char['xp'];
		if($earn_exp)
		{
			$msg.= ', ได้รับ Exp: '.$earn_exp.($guild_xp!=0?' (+'.$guild_xp.')':'');
		}
		if($earn_bux>0)
		{
			$msg.=', ได้รับเงิน: '.number_format($earn_bux).' Silver';
		}
		if($item)
		{
			$msg.=', ไอเท็มตก: '.$item['name'];
		}
	}
	elseif($dead=='pet')
	{							
		$this->char['hp']=0;
		$exp=0;
		if($this->char['lv']>1)
		{
			$exp=ceil($this->char['mxp']/15);
			//$exp=0;
			$this->char['xp'] -= $exp;
			if($this->char['xp']<0)
			{
				if($this->char['lv']>1)
				{
					$this->char['lv']--;
					$this->update_stats();
					$this->char['xp']+=$this->char['mxp'];
					$update['lv']=$this->char['lv'];
					//	$this->char['mxp']=((70*pow($this->char['lv']-1,3))+($this->char['lv']*100));
						
					if($this->char['g'])
					{
						$this->db->update('lionica_guild',array('_id'=>$this->char['g']['_id'],'us.p'.$this->char['_id']=>array('$exists'=>true)),array('$set'=>array('us.p'.$this->char['_id'].'.lv'=>$this->char['lv'])));	
					}
					
					$this->chat_message('[Lionica] '.$this->char['n'].' ลดเลเวล '.$this->char['lv'].'!.');
				}
				else
				{
					$this->char['xp']=0;
				}
			}
		}
		$update['xp']=$this->char['xp'];
		$update['map.x']=$this->char['map']['x']=$this->map['start'][0];
		$update['map.y']=$this->char['map']['y']=$this->map['start'][1];
		
		$msg.='ตาย!';
		
		$this->chat_message('[Lionica] '.$this->char['n'].' ถูก '.$mon['name'].' ฆ่าตาย!. เสีย EXP '.$exp);
	}
	$update['xp']=$this->char['xp'];
	$info[]=array('type'=>'finished','dead'=>$dead,'text'=>$msg,'hp'=>$this->char['hp'],'skill'=>$useskill,'monster'=>array('name'=>$mon['name'],'lv'=>$mon['lv'],'hp'=>$mon['hp']));
	$this->ajax->script('_.lionica.logs('.json_encode($info).')');
}


?>