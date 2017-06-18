<?php

if($arg['type']=='new')
{
	list($x,$y)=explode(':',$arg['farm']);
	if(isset($this->map['life'][$y.'_'.$x]))
	{
		$x=intval($x);
		$y=intval($y);
		if($farm=$this->db->findone('lionica_farm',array('map'=>$this->map['_id'],'x'=>$x,'y'=>$y)))
		{
			if($farm['p']==$this->char['_id'])
			{
				$tmp=return_status($farm);
			}
			else
			{
				$tmp='แปลงนี้มีเจ้าของแล้ว<br>ดูแลโดย '.$farm['pn'];
			}
		}
		elseif($this->char['silver']<$this->config['plot_price'])
		{
			$tmp='คุณมี Silver ไม่เพียงพอ';
		}
		else
		{
			if($id=$this->db->insert('lionica_farm',array('u'=>_::$my['_id'],'p'=>$this->char['_id'],'pn'=>$this->char['n'],'map'=>$this->map['_id'],'x'=>$x,'y'=>$y,'st'=>0,'pl'=>rand(0,3),'du'=>new MongoDate(),'td'=>300)))
			{	
				$this->char['silver']-=$this->config['plot_price'];
				$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$inc'=>array('silver'=>($this->config['plot_price'] * -1))));
				
				$txt='ซื้อ แปลงผัก ในราคา '.$this->config['plot_price'].' Silver ';
				$this->chat_message('[Lionica] '.$txt);
				$time=microtime(true);
				$this->map['chat'][]=array('_id'=>$time,'ty'=>'item','rl'=>$i,'t'=>$txt,'n'=>$this->char['n'],'l'=>_::$my['link'],'tm'=>date('H:i'),'_sn'=>str_replace('.','_','tm_'.$time));
				$this->cache->set('ca2','lionica_chat',$this->map['chat'],false,3600*24);
				
				$tmp=return_status($this->db->findone('lionica_farm',array('_id'=>$id)));
			}
		}
		$this->ajax->jquery('.npc .name .text','html','แปลงผัก');
		$this->ajax->jquery('.npc_text','html',$tmp);
		$this->ajax->script('_.lionica.box("npc","block");');
	}
}
elseif($arg['type']=='free')
{
	$day=date('Y-m-d');
	if($today=$this->db->findone('lionica_logs',array('u'=>_::$my['_id'],'day'=>$day)))
	{
		$this->ajax->alert('รับ Seeds (Grade D) สำหรับวันนี้ไปแล้ว');
	}
	elseif($this->char['lv']<6)
	{
		$this->ajax->alert('เลเวลไม่เพียงพอ');
	}
	else
	{
		$num=rand(6,15);
		$this->db->insert('lionica_logs',array('u'=>_::$my['_id'],'ty'=>'seed','day'=>$day));
		$this->item_insert(_::$my['_id'],310,$num,true);
		$this->update_inventory();
		$this->ajax->alert('ได้รับ Seeds (Grade D) '.$num.' ถุง');
		$this->chat_message('[Lionica] รับ Seeds (Grade D) '.$num.' ถุง จากผู้ดูแลฟาร์ม');
		$time=microtime(true);
		$this->map['chat'][]=array('_id'=>$time,'ty'=>'item','rl'=>$i,'t'=>'รับ Seeds (Grade D) '.$num.' ถุง จากผู้ดูแลฟาร์ม','n'=>$this->char['n'],'l'=>_::$my['link'],'tm'=>date('H:i'),'_sn'=>str_replace('.','_','tm_'.$time));
		$this->cache->set('ca2','lionica_chat',$this->map['chat'],false,3600*24);
	}
}
elseif($arg['type']=='change')
{
	if($farm=$this->db->findone('lionica_farm',array('_id'=>intval($arg['farm']))))
	{
		$tmp='';
		if($farm['p']==$this->char['_id'])
		{
			$seeds=array(310,311,312,313);
			$items=$this->config('item');
			if(in_array($farm['st'],array(0,1,2,5)))
			{
				$pass=true;
				if($farm['st']==1)
				{
					$pass=false;
					if($seeds[$arg['grade']])
					{
						$seed=intval($seeds[$arg['grade']]);
						$item=$items[$seed];
						if(!$inv=$this->db->findone('lionica_item',array('item'=>$seed,'u'=>_::$my['_id'])))
						{
							$tmp='ไม่มีถุงเมล็ดพันธุ์นี้ในกระเป๋า';
						}
						elseif($item['lv']>$this->char['lv'])
						{
							$tmp='เลเวลไม่เพียงพอสำหรับการใช้งานถุงพันธุ์พืชนี้';
						}
						else
						{
							if($inv['c']>1)
							{
								$this->db->update('lionica_item',array('_id'=>$inv['_id']),array('$inc'=>array('c'=>-1)));
							}
							else
							{
								$this->db->remove('lionica_item',array('_id'=>$inv['_id']));
							}
							$this->db->update('lionica_farm',array('_id'=>$farm['_id']),array('$set'=>array('gd'=>intval($arg['grade']))));
							$pass=true;
							$this->chat_message('[Lionica] ใช้ '.$items[$seed]['name'].' ปลูกลงในแปลงผัก');
							$time=microtime(true);
							$this->map['chat'][]=array('_id'=>$time,'ty'=>'item','rl'=>$seed,'t'=>'ใช้ '.$item['name'].' ปลูกลงในแปลงผัก','n'=>$this->char['n'],'l'=>_::$my['link'],'tm'=>date('H:i'),'_sn'=>str_replace('.','_','tm_'.$time));
							$this->cache->set('ca2','lionica_chat',$this->map['chat'],false,3600*24);
							$this->update_inventory();
						}
					}
				}
				if($pass)
				{
					$farm['du']=new MongoDate();
					if(in_array($farm['st'],array(0,1,2)))
					{
						$farm['td']=300;
					}
					else
					{
						$farm['td']=rand(60,600);
					}
					$farm['st']++;
					$this->db->update('lionica_farm',array('_id'=>$farm['_id']),array('$set'=>array('st'=>$farm['st'],'du'=>$farm['du'],'td'=>$farm['td'])));
					$tmp=return_status($farm);
				}
			}
			elseif($farm['st']==7)
			{
				$this->db->remove('lionica_farm',array('_id'=>$farm['_id']));
				
				$farm['gd']=intval($farm['gd']);
				$seed=intval($seeds[$farm['gd']]);
				$item=$items[$seed];
				
				$seeds=require(CONFIG_PATH.'seed.php');
				if($seeds[$farm['gd']])
				{
					$rand=(rand(0,9999) % 5);
					$win='';
					if($rand==0)
					{
						$drop=$seeds[$farm['gd']]['exp'];
						$exp=rand($drop['min'],$drop['max']);
						$win='EXP: '.number_format($exp);
						$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$inc'=>array('xp'=>$exp)));
					}
					elseif($rand==1)
					{
						$drop=$seeds[$farm['gd']]['silver'];
						$silver=rand($drop['min'],$drop['max']);
						$win='Money: '.number_format($silver).' Silver';
						
						$this->char['silver']+=$silver;
						$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$inc'=>array('silver'=>$silver)));
					}
					else
					{	
						$drop=explode(',',$seeds[$farm['gd']]['item']);
						if($it=intval(trim($drop[rand(0,count($drop)-1)])))
						{
							if($items[$it])
							{
								$win='ไอเท็ม: '.$items[$it]['name'];
								$this->item_insert(_::$my['_id'],$it,1,false);
								$this->update_inventory();
							}
						}
					}
					$tmp='เก็บเกี่ยวแปลงผักจากการใช้ '.$item['name'].' - '.($win?' ได้รับ '.$win:' ไม่ได้รับอะไรเลย');
					$this->chat_message('[Lionica] '.$tmp);
					$time=microtime(true);
					$this->map['chat'][]=array('_id'=>$time,'ty'=>'item','rl'=>$farm['gd'],'t'=>$tmp,'n'=>$this->char['n'],'l'=>_::$my['link'],'tm'=>date('H:i'),'_sn'=>str_replace('.','_','tm_'.$time));
					$this->cache->set('ca2','lionica_chat',$this->map['chat'],false,3600*24);
				}
			}
			$arg['online']=1;
		}
		else
		{
			$tmp='แปลงนี้มีเจ้าของแล้ว<br>ดูแลโดย '.$farm['pn'];
		}
		$this->ajax->jquery('.npc .name .text','html','แปลงผัก');
		$this->ajax->jquery('.npc_text','html',$tmp);
		$this->ajax->script('_.lionica.box("npc","block");');
	}
}
else
{
	$x=intval($arg['x']);
	$y=intval($arg['y']);
	$tmp='';
	if($farm=$this->db->findone('lionica_farm',array('map'=>$this->map['_id'],'x'=>$x,'y'=>$y)))
	{
		if($farm['p']==$this->char['_id'])
		{
			$tmp=return_status($farm);
		}
		else
		{
			$tmp='แปลงนี้มีเจ้าของแล้ว<br>ดูแลโดย '.$farm['pn'];
		}
	}
	else
	{
		$tmp='แปลงนี้ว่าง...<br><br>คุณต้องการซื้อแปลงนี้หรือไม่<br>
		- <a href="javascript:;" onclick="_.lionica.api(\'farm\',{\'type\':\'new\',\'farm\':\''.$x.':'.$y.'\'});_.lionica.box(\'npc\',\'none\')">ซื้อแปลงนี้</a> ('.$this->config['plot_price'].' Silver)<br>
		- <a href="javascript:;" onclick="_.lionica.box(\'npc\',\'none\');">ยกเลิก</a>';
	}
	$this->ajax->jquery('.npc .name .text','html','แปลงผัก');
	$this->ajax->jquery('.npc_text','html',$tmp);
	$this->ajax->script('_.lionica.box("npc","block");');
}


function return_status($farm)
{
	$tmp='';
	switch($farm['st'])
	{
		case 0:
			$tmp='นี่คือแปลงผักของเจ้า ดูเหมือนจะเราต้องมาเตรียมแปลงเพื่อจะปลูกผักกันก่อนนะ<br>
			- <a href="javascript:;" onclick="_.lionica.api(\'farm\',{\'type\':\'change\',\'status\':1,\'farm\':'.$farm['_id'].'});_.lionica.box(\'npc\',\'none\')">พรวนดิน</a><br><br>
			เจ้ามีเวลา '.return_remain($farm).' สำหรับการพรวนดิน ไม่เช่นนั้นแปลงผักนี้จะหายไป';
			break;
		case 1:
			$tmp='<strong>หว่านพันธุ์พืช</strong><br>
			- ใช้ <a href="javascript:;" onclick="_.lionica.api(\'farm\',{\'type\':\'change\',\'status\':2,\'farm\':'.$farm['_id'].',\'grade\':0});_.lionica.box(\'npc\',\'none\')">Seeds (Grade D)</a> (Lv.1+)<br>
			- ใช้ <a href="javascript:;" onclick="_.lionica.api(\'farm\',{\'type\':\'change\',\'status\':2,\'farm\':'.$farm['_id'].',\'grade\':1});_.lionica.box(\'npc\',\'none\')">Seeds (Grade C)</a> (Lv.20+)<br>
			- ใช้ <a href="javascript:;" onclick="_.lionica.api(\'farm\',{\'type\':\'change\',\'status\':2,\'farm\':'.$farm['_id'].',\'grade\':2});_.lionica.box(\'npc\',\'none\')">Seeds (Grade B)</a> (Lv.40+)<br>
			- ใช้ <a href="javascript:;" onclick="_.lionica.api(\'farm\',{\'type\':\'change\',\'status\':2,\'farm\':'.$farm['_id'].',\'grade\':3});_.lionica.box(\'npc\',\'none\')">Seeds (Grade A)</a> (Lv.60+)<br>
			<br>
			เจ้ามีเวลา '.return_remain($farm).' สำหรับการหว่านพันธุ์พืช ไม่เช่นนั้นแปลงผักนี้จะหายไป';
			break;
		case 2:
			$tmp='- <a href="javascript:;" onclick="_.lionica.api(\'farm\',{\'type\':\'change\',\'status\':3,\'farm\':'.$farm['_id'].'});_.lionica.box(\'npc\',\'none\')">รดน้ำเมล็ดพันธ์</a><br><br>
			เจ้ามีเวลา '.return_remain($farm).' สำหรับการรดน้ำให้เมล็ดพันธุ์พืช ไม่เช่นนั้นแปลงผักนี้จะหายไป';
			break;
		case 3:
			$tmp='รอผักเจริญเติบโต<br><br>
			อีก '.return_remain($farm).' ข้างหน้าผักแปลงนี้จะโตขึ้น';
			break;
		case 4:
			$tmp='รอผักเจริญเติบโต<br><br>
			เจ้าต้องกลับมารดน้ำอีกครั้ง อีก '.return_remain($farm).' ข้างหน้า';
			break;
		case 5:
			$tmp='- <a href="javascript:;" onclick="_.lionica.api(\'farm\',{\'type\':\'change\',\'status\':6,\'farm\':'.$farm['_id'].'});_.lionica.box(\'npc\',\'none\')">รดน้ำต้นผัก</a><br><br>
			เจ้ามีเวลา '.return_remain($farm).' สำหรับการรดน้ำให้ต้นผัก ไม่เช่นนั้นแปลงผักนี้จะหายไป';
			break;
		case 6:
			$tmp='- รอผักออกผล<br><br>
			อีก '.return_remain($farm).' ข้างหน้าผักแปลงนี้จะสามารถเก็บเกี่ยวได้';
			break;
		case 7:
			$tmp='- <a href="javascript:;" onclick="_.lionica.api(\'farm\',{\'type\':\'change\',\'status\':8,\'farm\':'.$farm['_id'].'});_.lionica.box(\'npc\',\'none\')">เก็บเกี่ยว</a><br><br>
			เจ้ามีเวลา '.return_remain($farm).' สำหรับการเก็บเกี่ยวผักแปลงนี้ ไม่เช่นนั้นแปลงผักนี้จะหายไป';
			break;
	}
	return $tmp;
}

function return_remain($farm)
{
	$tmp='';	
	if($farm['du']&&$farm['td'])
	{
		$t=($farm['du']->sec+$farm['td'])-time();
		if($t>0)
		{
			$sec=$t%60;
			$min=floor($t/60);	
			$tmp=$min.' นาที'.($sec>0?' '.$sec.' วินาที':'');
		}
	}
	else
	{
		$tmp='หมดเวลา';	
	}
	return $tmp;
}
?>