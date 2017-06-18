<?php

$update['map.x']=$this->char['map']['x']=intval($arg['pos']['x']);
$update['map.y']=$this->char['map']['y']=intval($arg['pos']['y']);
$update['last']=array('x'=>$update['map.x'],'y'=>$update['map.y'],'xy'=>$arg['x'].':'.$arg['y'],'atk'=>0,'time'=>microtime(true));
$valid=true;
if($this->char['last'])
{
	$delay=($this->char['last']['atk'] * 0.1);
	if($this->char['last']['xy'] == $update['last']['xy'])
	{
		$delay+=8;
	}
	else
	{
		//((4*50)+50)*$far;
		$dist=sqrt(pow($update['last']['x']-$this->char['last']['x'],2)+pow($update['last']['y']-$this->char['last']['y'],2));
		$delay+=((0.450*$dist)+0.3);
		
		// test
		//$delay-=1;
	}
	if(($this->char['last']['time'] > $update['last']['time']-$delay))
	{
		$valid=false;
	}
}
if(_::$my['_id']==1)
{
	$info=array();
	$this->ajax->script('_.lionica.logs('.json_encode($info).')');
}
if(!$valid)
{
	$update['last']['time']+=3;
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
	$useskill=0;
	$dead='';
	$info=array(array('type'=>'attack','monster'=>$arg['x'].'_'.$arg['y'],'hp'=>$this->char['hp']));
	while ($this->char['hp']>0 and $m_hp>0)
	{
		$atk=return_damage(
												array('lv'=>$this->char['lv'],'val'=>intval($this->char['atk']),'ele'=>$this->char['ele']['atk']),
												array('lv'=>$mon['lv'],'val'=>$mon['def'],'ele'=>$mon['ele']),
												1,
												true
											);
		$info[]=array('type'=>'damage','def'=>'monster','atk'=>$atk,'text'=>'โจมตี '.$mon['name'].' '.(!$atk?' พลาด!':$atk));
		$m_hp -= $atk;
		$update['last']['atk']++;
		if ($m_hp<=0)
		{
			$dead = 'monster';
			break; 
		}
		
		if($update['last']['atk']>2)
		{
			$atk=return_damage(
													array('lv'=>$mon['lv'],'val'=>$mon['atk'],'ele'=>$mon['ele']),
													array('lv'=>$this->char['lv'],'val'=>intval($this->char['def']),'ele'=>$this->char['ele']['def']),
													($this->char['job']==4?8.5:6),
													false
												);
			$info[]=array('type'=>'damage','def'=>'pet','atk'=>$atk,'text'=>$mon['name'].' โจมตี สัตว์เลี้ยง '.(!$atk?' พลาด!':$atk));
			$this->char['hp'] -= $atk;		
			$update['last']['atk']++;
			if ($this->char['hp']<=0)
			{	
				$dead = 'pet';
				break; 
			}
		}
		$rand=rand(0,9);
		if($rand>=8)
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
				$atk=ceil(return_damage(
																array('lv'=>$this->char['lv'],'val'=>intval($this->char['atk']),'ele'=>$this->char['ele']['atk']),
																array('lv'=>$mon['lv'],'val'=>$mon['def'],'ele'=>$mon['ele']),
																2,
																true
															)*$sk['atk']);
				$info[]=array('type'=>'damage','def'=>'monster','atk'=>$atk,'text'=>'โจมตี '.$mon['name'].' ด้วยสกิล ['.$sk['name'].'] '.(!$atk?' พลาด!':$atk));
				$this->char['mp']-=$sk['mp'];
				$useskill++;
			}
			else
			{
				$atk=return_damage(
														array('lv'=>$this->char['lv'],'val'=>intval($this->char['atk']),'ele'=>$this->char['ele']['atk']),
														array('lv'=>$mon['lv'],'val'=>$mon['def'],'ele'=>$mon['ele']),
														2,
														true
													);
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
		if($drop=return_dropitem($mon['item'],($diflv>5?2:1)))
		{
			$items=$this->config('item');
			if(isset($items[$drop]))
			{
				$item=$items[$drop];
				$slot=0;
				if($item['can_ele'])
				{
					$slot=1;
					$item['name'].=' []';
				}
				$did=$this->db->insert('lionica_drop',array('u'=>_::$my['_id'],'p'=>$this->char['_id'],'item'=>$drop,'slot'=>$slot));
				$drop=array('n'=>$item['name'],'i'=>$drop,'c'=>$item['css'],'p'=>$this->char['_id'],'t'=>time(),'d'=>$did); 
				$this->ajax->script('_.lionica.drop('.json_encode($drop).')');
			}
		}
		else
		{
			$rand=rand($mon['lv']-1,$mon['lv']+1);
			if($rand==$mon['lv'])
			{
				$earn_bux=rand(max($mon['lv']-5,2),$mon['lv']+2);
				if($earn_bux>0)
				{
					$did=$this->db->insert('lionica_drop',array('u'=>_::$my['_id'],'p'=>$this->char['_id'],'item'=>-1,'silver'=>$earn_bux));
					$drop=array('n'=>$earn_bux.' Silver','i'=>$drop,'c'=>'-456px -360px','p'=>$this->char['_id'],'t'=>time(),'d'=>$did); 
					$this->ajax->script('_.lionica.drop('.json_encode($drop).')');
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
		if($this->char['xp']>=$this->char['mxp'])
		{
			$this->char['xp']-=$this->char['mxp'];
			$this->char['lv']+=1;
			
			if($this->char['g'])
			{
				$this->db->update('lionica_guild',array('_id'=>$this->char['g']['_id'],'us.p'.$this->char['_id']=>array('$exists'=>true)),array('$set'=>array('us.p'.$this->char['_id'].'.lv'=>$this->char['lv'])));	
			}
				
			if($this->char['lv']>=$this->config['max_level'])
			{
				$this->char['xp']=0;
				$update['dl']=new MongoDate();
			}
			$this->update_stats();
			//$this->char['mxp']=((70*pow($this->char['lv']-1,3))+($this->char['lv']*100));
			$this->char['hp']=$this->char['mhp'];
			$this->char['mp']=$this->char['mmp'];
			$this->chat_message('[Lionica] '.$this->char['n'].' อัพเลเวล '.$this->char['lv'].'!.');
			
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
			$msg.=', เงินตก: '.number_format($earn_bux).' Silver';
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
		if($this->char['lv']>10)
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
		
		$msg.='สัตว์เลี้ยง ตาย!';
		
		$this->chat_message('[Lionica] '.$this->char['n'].' ถูก '.$mon['name'].' ฆ่าตาย!. '.($this->char['lv']>10?'เสีย EXP '.$exp:'(เลเวลไม่เกิน 10 ไม่เสีย EXP)'));
	}
	$update['xp']=$this->char['xp'];
	$info[]=array('type'=>'finished','dead'=>$dead,'text'=>$msg,'hp'=>$this->char['hp'],'skill'=>$useskill,'monster'=>array('name'=>$mon['name'],'lv'=>$mon['lv'],'hp'=>$mon['hp']));
	$this->ajax->script('_.lionica.logs('.json_encode($info).')');
}



?>