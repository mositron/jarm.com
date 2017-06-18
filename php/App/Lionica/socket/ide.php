<?php

if(!defined('CHATED'))
{
	define('CHATED',1);
	$this->char['lastchat']=floatval($arg['last']);
	$time=time();
	$this->char['chat']=array();
	
	$guild=($this->char['g']?$this->char['g']['_id']:0);
	for($i=0;$i<count($this->map['chat']);$i++)
	{
		$v=$this->map['chat'][$i];
		if(in_array($v['ty'],array('shout','item','shop','enhance','evolution'))||($v['ty']=='private'&&($v['rl']['p']==$this->char['_id']||$v['p']==$this->char['_id']))||($v['ty']=='guild'&&$v['rl']==$guild)||($v['ty']=='map'&&$v['rl']==$this->map['_id']))
		{
			if($this->map['chat'][$i]['_id']>$this->char['lastchat'])
			{
				$this->char['chat'][]=$v;
				$this->char['lastchat']=$v['_id'];
			}
		}
	}
	
	if($arg['online'])
	{
		$farms=array();
		if($this->map['_id']==5)
		{
			if($tmp=$this->db->find('lionica_farm',array('map'=>$this->map['_id'])))
			{
				for($i=0;$i<count($tmp);$i++)
				{
					if(!$tmp[$i]['du'])
					{
						$tmp[$i]['du']=new MongoDate();
						$tmp[$i]['td']=rand(60,60*6);	
						$this->db->update('lionica_farm',array('_id'=>$tmp[$i]['_id']),array('$set'=>array('du'=>$tmp[$i]['du'],'td'=>$tmp[$i]['td'])));
					}
					if(!isset($tmp[$i]['gd']))
					{
						$tmp[$i]['gd']=0;
					}
					if(!isset($tmp[$i]['pl']))
					{
						$tmp[$i]['pl']=0;
					}
					$delete=false;
					if($tmp[$i]['du']->sec+$tmp[$i]['td']<$time)
					{
						if(in_array($tmp[$i]['st'],array(3,4,6)))
						{
							$tmp[$i]['du']=new MongoDate();
							if(in_array($tmp[$i]['st'],array(3,4)))
							{
								$tmp[$i]['td']=rand(300,600);
							}
							else
							{
								$tmp[$i]['td']=1800;
							}
							$tmp[$i]['st']++;
							$this->db->update('lionica_farm',array('_id'=>$tmp[$i]['_id']),array('$set'=>array('du'=>$tmp[$i]['du'],'td'=>$tmp[$i]['td'],'st'=>$tmp[$i]['st'])));
						}
						else
						{
							$this->db->remove('lionica_farm',array('_id'=>$tmp[$i]['_id']));
							$delete=true;
						}
					}
					if(!$delete)
					{
						$farms[$tmp[$i]['x'].'_'.$tmp[$i]['y']]=$tmp[$i];
					}
				}
			}
		}
		
		if($this->char['g'])
		{
			$this->db->update('lionica_guild',array('_id'=>$this->char['g']['_id'],'us.p'.$this->char['_id']=>array('$exists'=>true)),array('$set'=>array('us.p'.$this->char['_id'].'.ol'=>new MongoDate())));	
		}
		
		if(!$this->map['online']=_::cache()->get('ca2','lionica_maps_online_'.$this->map['_id']))
		{
			$this->map['online']=array('pet'=>array(),'update'=>time());
		}
		$this->map['online']['pet'][$this->char['_id']]=array(
																									'_id'=>$this->char['_id'],
																									'n'=>$this->char['n'],
																									'job'=>$this->char['job'],
																									'gender'=>$this->char['gender'],
																									'hair'=>$this->char['hair'],
																									'color'=>$this->char['color'],
																									'x'=>$this->char['map']['x'],
																									'y'=>$this->char['map']['y'],
																									'face'=>$this->char['map']['z'],
																									'du'=>$time,
																									'g'=>($this->char['g']?$this->char['g']['n']:''),
																									'gi'=>($this->char['g']?$this->char['g']['_id']:''),
																									'v'=>($arg['vender']?_::$my['_id']:0),
																									'nh'=>intval($this->char['nh']),
																									'head'=>$this->char['eq']['i11']?intval($this->char['eq']['i11']['item']):0,
																									'back'=>$this->char['eq']['i12']?intval($this->char['eq']['i12']['item']):0,
																									'pet'=>($this->char['pet']?array('no'=>$this->char['pet']['no']):false)
																								);
	
		$online=array();
		foreach($this->map['online']['pet'] as $k=>$v)
		{
			if($v['du'] >= $time-60)
			{
				$online[$k]=$v;
			}
		}
		$this->map['online']['pet']=$online;
		$this->map['online']['update']=$time;
		$this->map['online']['farm']=$farms;
		_::cache()->set('ca2','lionica_maps_online_'.$this->map['_id'],$this->map['online'],false,3600*24);
	
		
		$this->char['online']=$this->map['online']['pet'];
		$this->char['farms']=$farms;
	}
}
$this->ajax->script('_.lionica.char('.json_encode($this->char).')');

?>