<?php

class lionica
{
	public $db;
	public $char;
	public $map;
	public $config=array(
											'max_level'=>99,
											'inventory_max'=>50,
											'plot_price'=>50,
											'item_type'=>array(0=>'ทั่วไป',1=>'ยา',2=>'อาวุธ',3=>'เสื้อ',4=>'หมวก',5=>'ถุงมือ',6=>'รองเท้า',7=>'สร้อยคอ',8=>'แหวน',9=>'สัตว์เลี้ยง',10=>'อาหารสัตว์',11=>'ศรีษะ',12=>'หลัง'),
											'element'=>array(0=>'',1=>'Earth',2=>'Water',3=>'Fire',4=>'Wind',5=>'Ligthning'),
	
	);
	
	public function lionica($id)
	{
		if(!$id)
		{
			_::move(LIONICA_PATH.'?pet');		
		}
		$this->db=_::db();
		$this->cache=_::cache();
		$this->ajax=_::ajax();
		
		if(!$this->char=$this->db->findone('lionica_char',array('_id'=>$id,'dd'=>array('$exists'=>false))))
		{
			_::move(LIONICA_PATH.'?delete-'.$id);
		}
	}
	
	public function socket($arg)
	{
		if(!$this->char)
		{
			_::move(LIONICA_PATH.'?pet');		
		}
		
		$socket=array(
									'blacksmith'=>'blacksmith',
									'chat'=>'chat',
									'guild'=>'guild',
									'vender'=>'vender',
									'keep'=>'keep',
									'position'=>'position',
									'pet'=>'pet',
									'bank'=>'bank',
									'job'=>'job',
									'buyitem'=>'buyitem',
									'useitem'=>'useitem',
									'sellitem'=>'sellitem',
									'skill'=>'skill',
									'enhance'=>'enhance',
									'farm'=>'farm',
									'profile'=>'profile',
									'warpnpc'=>'warpnpc',
									'item'=>'item',
									'ide'=>'ide',
		
		);
		
		if(isset($socket[$arg['func']]))
		{
			if(_::$my['lionica']['hash']!=$arg['khash'])
			{
				$this->ajax->script('_.lionica.logs('.json_encode(array(array('type'=>'login','text'=>'<p class="logs-info">[ระบบ] มีการล็อคอินซ้อน. '._::$my['lionica']['hash'].'!='.$arg['khash'].'</p>'))).');');
				$this->ajax->script('_.lionica.khash="";clearTimeout(_.lionica.tmrai);_.lionica.eai=false;_.lionica.loaded=false;');
			}
			else
			{
				$this->loadMap();
				
				$time=time();
				
				if(!$this->map['chat']=_::cache()->get('ca2','lionica_chat'))
				{
					$this->map['chat']=array();
				}
				
				if($arg['pos']['x']&&$arg['pos']['y'])
				{
					$this->char['map']['x']=intval($arg['pos']['x']);
					$this->char['map']['y']=intval($arg['pos']['y']);
					$this->char['map']['z']=intval(in_array($arg['pos']['z'],array(0,1,2,3))?$arg['pos']['z']:'0');
				}

				$update=false;
				if(!$this->char['du'])
				{
					$this->char['du']=new MongoDate();
					$update=true;
				}
				$this->char['hp'] += floor(($this->char['mhp']/3) * ((time() - $this->char['du']->sec) / 60));
				$this->char['mp'] += floor(($this->char['mmp']/3) * ((time() - $this->char['du']->sec) / 60));	
				
				if($this->char['hp'] > $this->char['mhp'])
				{
					$this->char['hp'] = $this->char['mhp'];
				}
				if($this->char['mp'] > $this->char['mmp'])
				{
					$this->char['mp'] = $this->char['mmp'];
				}
				if($this->char['pet'])
				{
					if($time>$this->char['pet']['status']['du']->sec+60)
					{
						$update=true;
					}
				}
				if($update || ($this->char['du']->sec+60<$time))
				{
					$set=array('hp'=>$this->char['hp'],'mp'=>$this->char['mp'],'map'=>$this->char['map'],'du'=>new MongoDate());
					if($this->char['pet'])
					{
						if($time>$this->char['pet']['status']['du']->sec+60)
						{
							$this->char['pet']['status']['du']=new MongoDate();
							
							$this->char['pet']['status']['hp']-=1;
							if($this->char['pet']['status']['hp']<=5)
							{
								if(in_array(_::$my['_id'],array(19617,57290,19255,1162)))
								{
									$this->char['pet']['status']['hp']=$this->char['pet']['status']['mhp'];
									$set['pet.status.hp']=$this->char['pet']['status']['hp'];
									$set['pet.status.du']=$this->char['pet']['status']['du'];
								}
								else
								{
									$this->db->update('lionica_item',array('_id'=>$this->char['pet']['inv']),array('$set'=>array('status'=>$this->char['pet']['status']),'$unset'=>array('eq'=>1)));
									$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$unset'=>array('pet'=>1,'eq.i9'=>1)));
									unset($this->char['eq']['i9']);
									$this->char['pet']=false;
								}
							}
							else
							{
								$set['pet.status.hp']=$this->char['pet']['status']['hp'];
								$set['pet.status.du']=$this->char['pet']['status']['du'];
							}
						}
					}
					$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$set'=>$set));
				}
				if($arg['func']!='ide')
				{
					require(SOCKET_PATH.$socket[$arg['func']].'.php');
				}
				$this->char['silver']=number_format($this->char['silver']);
				require(SOCKET_PATH.$socket['ide'].'.php');
			}
		}
	}
	
	public function loadMap()
	{
		if(!$this->map)
		{
			if(!$this->map=$this->cache->get('ca2','lionica_maps_'.$this->char['map']['_id']))
			{
				if(!$this->map=$this->db->findone('lionica_maps',array('_id'=>$this->char['map']['_id'])))
				{
					_::move(LIONICA_PATH.'?map');	
				}
				$this->map['online']=array('pet'=>array(),'update'=>time());
				$this->cache->set('ca2','lionica_maps_'.$this->char['map']['_id'],$this->map,false,3600*24);
			}
		}
	}
	public function config($type)
	{
		if(!isset($this->config[$type]))	
		{
			$this->config[$type]=require(CONFIG_PATH.$type.'.php');
		}
		return $this->config[$type];
	}
	
	public function inventory()
	{
		$tmp='<ul>';
		$inv=$this->db->find('lionica_item',array('u'=>_::$my['_id'],'dd'=>array('$exists'=>false),'$or'=>array(array('eq'=>array('$exists'=>false)),array('eq'=>$this->char['_id']))),array(),array('sort'=>array('_id'=>1)));
		for($i=0;$i<count($inv);$i++)
		{
			if($inv[$i]['mk'])
			{
				if(!defined('VENDER'))
				{
					define('VENDER',1);	
				}
			}
			elseif($inv[$i]['eq'])
			{
				continue;
			}
			else
			{
				list($item,$popup)=$this->item($inv[$i]);
				$tmp.='<li data-inv="'.$inv[$i]['_id'].'" data-type="'.$item['type'].'" class="lionica-popup'.($inv[$i]['eq']?' inv-eq':'').($item['type']>=0?' inv-use':'').'" data-popup="'.$popup.'"><i class="item" style="background-position:'.$item['css'].'"></i><span>'.$inv[$i]['c'].'</span></li>';
			}
		}
		$tmp.='<p class="clear"></p></ul>';
		return array('count'=>count($inv),'max'=>$this->config['inventory_max'],'text'=>$tmp);
	}
	
	public function item($inv)
	{
		$job=$this->config('job');
		$items=$this->config('item');
		$item=$items[$inv['item']];
		
		if($inv['nh'])
		{
			$item['name']='+'.$inv['nh'].' '.$item['name'];
			if($item['type']==2)
			{
				$item['atk']+=($inv['nh']*2);
			}
			elseif($item['type']>2)
			{
				$item['def']+=($inv['nh']);
			}
		}
		
		
		if($inv['slot'])
		{
			$item['name'].=' ['.($inv['ele']?$this->config['element'][$inv['ele']]:'').']';
		}
		
		$popup='<strong>'.$item['name'].'</strong><br>'.($item['detail']?$item['detail'].'<br>':'').($inv['ps']?'(ไม่สามารถแลกเปลี่ยนได้) ':'').'ประเภท: '.$this->config['item_type'][$item['type']];
		
		if($inv['status']&&$inv['status']['type'])
		{
			$popup.=', เพิ่ม: +'.$inv['status']['inc'].' '.strtoupper($inv['status']['type']);
		}
		
		if($item['atk'])
		{
			$popup.=', โจมตี: '.$item['atk'];	
		}
		if($item['def'])
		{
			$popup.=', ป้องกัน: '.$item['def'];	
		}
		if($item['lv'])
		{
			$popup.=', เลเวลขั้นต่ำ: '.$item['lv'];	
		}
		if($item['job'])
		{
			$j=array();
			if(is_array($item['job']))
			{
				foreach($item['job'] as $jo)
				{
					$j[]=$job[$jo]['name'];
				}
			}
			else
			{
				$j[]=$job[$item['job']]['name'];
			}
			$popup.=', อาชีพ: '.implode(' / ',$j);	
		}
		if($item['price'])
		{
			$popup.=', ซื้อ: '.number_format($item['price']);	
		}
		if($item['sell'])
		{
			$popup.=', ขาย: '.number_format($item['sell']);	
		}
		return array($item,$popup);
	}
	
	public function chat_message($ms)
	{
		$key='chatroom_data_1';
		if($data=$this->cache->get('ca2',$key))
		{
			if(is_array($data['text']))
			{
				$time=microtime(true);
				$al=array(
											'ty'=>'game',
											'u'=>_::$my['_id'],
											'_id'=>$time,
											'_sn'=>str_replace('.','_',strval($time)),
											't'=>date('H:i',$time),
											'p'=>'',
											'm'=>$ms,
											'mb'=>1,
											'c'=>21,
											'n'=>_::$my['cname'],
											'l'=>_::$my['link'],
											'i'=>_::$my['img'],
											'am'=>0,
											'ip'=>$_SERVER['REMOTE_ADDR'],
											'rk'=>(_::$my['lionica']?intval(_::$my['lionica']['ty']):0),
											'vid'=>'',
										);
				
				array_push($data['text'],$al);
				$this->cache->set('ca2',$key,$data,false,3600*24*7);
			}
		}
	}
	
	public function update_inventory()
	{
		$inv=$this->inventory();
		$this->ajax->jquery('.inventory .name .text','html','กระเป๋า ('.$inv['count'].'/'.$inv['max'].')');
		$this->ajax->jquery('.inventory_text','html',$inv['text']);
		$this->ajax->script('_.lionica.inventory.icount='.$inv['count'].';_.lionica.inventory.imax='.$inv['max'].';');
	}
	
	public function update_skill()
	{
		$tmp='';
		$skill=array();
		$skills=$this->config('skill');	
		foreach($skills as $k=>$v)
		{
			if(in_array($this->char['job'],$v['job'])&&$this->char['lv']>=$v['lv'])
			{
				$skill[$k]=$v;
			}
		}
		if(count($skill))
		{
			$tmp='<table width="100%"  border="0" cellspacing="0" cellpadding="1">';
			foreach($skill as $k=>$v)
			{
				$tmp.='<tr><td class="l'.($i%2).'">'.($v['css']?'<i class="item" style="background-position:'.$v['css'].'"></i> ':'').$v['name'].'</td>';
				if(in_array($v['type'],array('hp','warp')))
				{
					$tmp.='<td class="l'.($i%2).'" align="right"><a href="javascript:;" onclick="_.lionica.skill('.$k.',\'use\')">ใช้งาน</a></td>';
				}
				elseif(in_array($v['type'],array('atk')))
				{
					$tmp.='<td class="l'.($i%2).'" align="right"><label><input type="checkbox" name="skill" value="'.$k.'"> อัตโนมัติ</label></td>';
				}
				$tmp.='</tr>';
			}
			$tmp.='</table>';
		}
		$this->ajax->jquery('.skill_text','html',$tmp);
	}
	
	
	public function update_stats()
	{
		$jobs=$this->config('job');	
		$job=$jobs[$this->char['job']];
		
		$_stats=$this->char['stats'];
		if($this->char['pet'])
		{
			if($this->char['pet']['status']['type'])
			{
				$_stats[$this->char['pet']['status']['type']]+=$this->char['pet']['status']['inc'];
			}
		}
		
		$this->char['nh']=0;
		$this->char['atk']=5;
		$this->char['def']=2;
		
		$this->char['hit']=floor(($this->char['lv']+$_stats['dex']))+$job['hit'];
		$this->char['free']=floor(($this->char['lv']+$_stats['agi']))+$job['free'];
		
		
		$this->char['ele']=array('atk'=>0,'def'=>0);
		
		if($this->char['init'])
		{
			$this->char['atk']+=intval($this->char['init']['atk']);
			$this->char['def']+=intval($this->char['init']['def']);
		}
		
		//$this->char['atk']+=$job['atk'];
		//$this->char['def']+=$job['def'];
		
		
		$this->char['mhp']=100+(($this->char['lv']-1)*35);
		$this->char['mmp']=ceil($this->char['mhp']/2);
		
		$this->char['mhp']=floor($this->char['mhp'] * ((100+$_stats['vit'])/100) * $job['hp']);
		$this->char['mmp']=floor($this->char['mmp'] * ((100+$_stats['int'])/100) * $job['mp']);
		
		
		if(is_array($this->char['eq']))
		{
			$items=$this->config('item');
			foreach($this->char['eq'] as $k=>$v)
			{
				if($items[$v['item']]['type']==2&&$v['ele'])
				{
					$this->char['ele']['atk']=$v['ele'];
				}
				if($items[$v['item']]['type']==3&&$v['ele'])
				{
					$this->char['ele']['def']=$v['ele'];
				}
				if($v['nh'])
				{
					if($items[$v['item']]['type']==2)
					{
						$this->char['atk']+=($v['nh']*2);
						$this->char['nh']+=($v['nh']);
					}
					elseif($items[$v['item']]['type']>2)
					{
						$this->char['def']+=($v['nh']);
						$this->char['nh']+=($v['nh']);
					}
				}
				$this->char['atk']+=intval($items[$v['item']]['atk']);
				$this->char['def']+=intval($items[$v['item']]['def']);
			}
		}
		if($this->char['job']==2)
		{
			//$this->char['atk']=floor($this->char['atk']*((100+$_stats['int'])/100));
			$this->char['atk']+=floor($_stats['int']/2);
		}
		else
		{
			//$this->char['atk']=floor($this->char['atk']*((100+$_stats['str'])/100));
			$this->char['atk']+=floor($_stats['str']/2);
		}
		$this->char['mxp']=ceil((25*pow($this->char['lv']-1,2.5+($this->char['lv']/100)))+($this->char['lv']*50));
		$this->char['nh']=floor($this->char['nh']/10);
		
		$set=array('atk'=>$this->char['atk'],'def'=>$this->char['def'],'hit'=>$this->char['hit'],'free'=>$this->char['free'],'mhp'=>$this->char['mhp'],'mmp'=>$this->char['mmp'],'mxp'=>$this->char['mxp'],'nh'=>$this->char['nh'],'ele'=>$this->char['ele']);
		
		
		
		$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$set'=>$set));
		//_::user()->update(_::$my['_id'],array('$set'=>array('pet'=>$this->char)));
	}
	
	
	function item_insert($user,$id,$num,$passive=false,$op=false)
	{
		$id=intval($id);
		$update=false;
		$items=$this->config('item');
		if(isset($items[$id]))
		{
			$item=$items[$id];
			if($item['type']<=1||$item['type']==10)
			{
				if($inv=$this->db->findone('lionica_item',array('u'=>$user,'item'=>$id,'ps'=>($passive?1:0))))
				{
					$this->db->update('lionica_item',array('_id'=>$inv['_id']),array('$inc'=>array('c'=>$num)));
					$update=true;
				}
			}
			if(!$update)
			{
				$insert=array('u'=>$user,'item'=>$id,'c'=>$num,'ps'=>($passive?1:0));
				
				
				if($item['type']==9)
				{
					$sta=array('str','agi','vit','dex','int');
					shuffle($sta);
					shuffle($sta);
					$inc=array(1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,3,3,4,4,4,4,4,4,4,5,5,5,5,5,5,6,6,6,6,7,7,7,8,8,9);
					shuffle($inc);
					shuffle($inc);
					$insert['status']=array('hp'=>100,'mhp'=>100,'lv'=>1,'xp'=>0,'mxp'=>100,'ele'=>$id-313,'evo'=>0,'type'=>$sta[0],'inc'=>$inc[0]);
				}
					
				if($op)
				{
					if($op['slot'])
					{
						$insert['slot']=1;	
					}
					if($op['ele'])
					{
						$insert['ele']=intval($op['ele']);	
					}
				}
				$this->db->insert('lionica_item',$insert);
			}
		}
	}
	
	function next_lv()
	{
		if($this->char['xp']>=$this->char['mxp'])
		{
			while($this->char['xp']>=$this->char['mxp'])
			{
				$this->char['xp']-=$this->char['mxp'];
				$this->char['lv']+=1;
				if($this->char['lv']>$this->char['mlv'])
				{
					$this->char['stats']['ptr']+=(floor($this->char['lv']/5)+3);
					$this->char['mlv']=$this->char['lv'];
					$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$set'=>array('mlv'=>$this->char['mlv'],'stats.ptr'=>$this->char['stats']['ptr'])));
				}
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
			}
		}
	}
}
?>