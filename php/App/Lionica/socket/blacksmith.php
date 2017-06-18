<?php

if($arg['type']=='enhance')
{
	if($this->char['silver']<100)
	{
		$this->ajax->alert('มีเงินไม่เพียงพอ');	
	}
	elseif($inv=$this->db->findone('lionica_item',array('_id'=>intval($arg['item']),'u'=>_::$my['_id'])))
	{
		$items=$this->config('item');
		if(!isset($items[$inv['item']]))
		{
			$this->ajax->alert('ไอเท็มไม่ถูกต้อง');	
		}
		else
		{
			$item=$items[$inv['item']];
			$nh=intval($inv['nh']);
			$crystal=($item['type']==2?308:309);
			if($item['type']<=1)
			{
				$this->ajax->alert('ไอเท็มนี้ไม่สามารถเพิ่มประสิทธิ์ภาพได้');	
			}
			elseif($item['type']>=7)
			{
				$this->ajax->alert('ไอเท็มนี้ไม่สามารถเพิ่มประสิทธิ์ภาพได้');	
			}
			elseif($nh>=10)
			{
				$this->ajax->alert('ไอเท็มนีไม่สามารถเพิ่มประสิทธิภาพได้อีก');	
			}
			elseif($inv['eq'])
			{
				$this->ajax->alert('กรุณาถอดไอเท็มออกจากตัวก่อน');	
			}
			elseif($inv['dd'])
			{
				
			}
			elseif($inv['mk'])
			{
				$this->ajax->alert('กรุณาปิดร้านค้าอีกครั้ง');	
			}
			elseif(!$inv_crystal=$this->db->findone('lionica_item',array('u'=>_::$my['_id'],'item'=>$crystal,'dd'=>array('$exists'=>false),'mk'=>array('$exists'=>false),'eq'=>array('$exists'=>false))))
			{
				$this->ajax->alert('คุณไม่มี Crystal');
			}
			elseif($inv_crystal['c']<1)
			{
				$this->ajax->alert('คุณมี Crystal ไม่เพียงพอ');
			}
			else
			{
				$name=($nh>0?'+'.$nh.' ':'').$item['name'];
	
				if($inv['slot'])
				{
					$name.=' ['.($inv['ele']?$this->config['element'][$inv['ele']]:'').']';
				}
				$per=array(
					0=>array('pass'=>80,'destroy'=>0),
					1=>array('pass'=>75,'destroy'=>0),
					2=>array('pass'=>70,'destroy'=>0),
					3=>array('pass'=>65,'destroy'=>0),
					4=>array('pass'=>60,'destroy'=>1),
					5=>array('pass'=>50,'destroy'=>1),
					6=>array('pass'=>40,'destroy'=>1),
					7=>array('pass'=>50,'destroy'=>1),
					8=>array('pass'=>20,'destroy'=>1),
					9=>array('pass'=>15,'destroy'=>1)
				);
				$limit=$per[$nh];
				$rand=rand(-500,0);
				$rand=rand(0,99);
				$frank=99-$limit['pass'];
				if($this->char['init'])
				{
					$rand+=intval($this->char['init']['enh']);
				}
				if($rand>$frank)
				{
					// success
					$success=true;
					$this->db->update('lionica_item',array('_id'=>$inv['_id']),array('$inc'=>array('nh'=>1)));
				}
				else
				{
					// fail	
					$success=false;
					if($limit['destroy'])
					{
						$this->db->remove('lionica_item',array('_id'=>$inv['_id']));	
					}
					else
					{
						$this->db->update('lionica_item',array('_id'=>$inv['_id']),array('$unset'=>array('nh'=>1)));
					}
				}
				
				$txt=$this->char['n'].' เพิ่มประสิทธิภาพ '.$name.' กับช่างตีเหล็ก(ใช้เงิน 100 Silver): '.($success?'สำเร็จ':'พลาด').'!.';
				$this->chat_message('[Lionica] '.$txt);
				
				$this->char['silver']-=100;
				$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$inc'=>array('silver'=>-100)));
		
				if($inv_crystal['c']>1)
				{
					$this->db->update('lionica_item',array('_id'=>$inv_crystal['_id']),array('$inc'=>array('c'=>-1)));
				}
				else
				{
					$this->db->remove('lionica_item',array('_id'=>$inv_crystal['_id']));
				}
				
				$time=microtime(true);
				$this->map['chat'][]=array('_id'=>$time,'ty'=>'enhance','pet'=>$this->char['_id'],'t'=>$txt,'effect'=>($success?'success':'fail'),'n'=>$this->char['n'],'l'=>_::$my['link'],'tm'=>date('H:i'),'_sn'=>str_replace('.','_','tm_'.$time));
				_::cache()->set('ca2','lionica_chat',$this->map['chat'],false,3600*24);
				$this->ajax->script('_.lionica.box("npc","none")');
				$this->update_inventory();
			}
		}
	}
	else
	{
		$this->ajax->alert('ไอเท็มนี้หายไปแล้ว');	
	}
}
elseif($arg['type']=='element')
{
	if($this->char['silver']<500)
	{
		$this->ajax->alert('มีเงินไม่เพียงพอ');	
	}
	elseif($inv=$this->db->findone('lionica_item',array('_id'=>intval($arg['item']),'slot'=>1,'u'=>_::$my['_id'])))
	{
		$items=$this->config('item');
		if(!isset($items[$inv['item']]))
		{
			$this->ajax->alert('ไอเท็มไม่ถูกต้อง');	
		}
		else
		{
			
				$per=array(
					321=>array('n'=>'Earth','t'=>'ดิน'),
					322=>array('n'=>'Water','t'=>'น้ำ'),
					323=>array('n'=>'Fire','t'=>'ไฟ'),
					324=>array('n'=>'Wind','t'=>'ลม'),
					325=>array('n'=>'Ligntning','t'=>'สายฟ้า')
				);
			$item=$items[$inv['item']];
			$nh=intval($inv['nh']);
			$stone=intval($arg['stone']);
			if(!$item['can_ele'])
			{
				$this->ajax->alert('ไอเท็มนี้ไม่สามารถหลอมรวมกับธาตุได้');	
			}
			elseif(!isset($per[$stone]))
			{
				$this->ajax->alert('กรุณาเลือกหินที่ต้องการเสริม');	
			}
			elseif($inv['ele'])
			{
				
			}
			elseif($inv['dd'])
			{
				
			}
			elseif($inv['mk'])
			{
				$this->ajax->alert('กรุณาปิดร้านค้าอีกครั้ง');	
			}
			elseif(!$inv_stone=$this->db->findone('lionica_item',array('u'=>_::$my['_id'],'item'=>$stone,'dd'=>array('$exists'=>false),'mk'=>array('$exists'=>false),'eq'=>array('$exists'=>false))))
			{
				$this->ajax->alert('คุณไม่มี stone');
			}
			elseif($inv_stone['c']<1)
			{
				$this->ajax->alert('คุณมี stone ไม่เพียงพอ');
			}
			else
			{
				$name=($nh>0?'+'.$nh.' ':'').$item['name'];
	
				if($inv['slot'])
				{
					$name.=' ['.($inv['ele']?$this->config['element'][$inv['ele']]:'').']';
				}
				$rand=rand(-500,0);
				$rand=rand(0,99);
				if($rand>=50)
				{
					// success
					$success=true;
					$this->db->update('lionica_item',array('_id'=>$inv['_id']),array('$set'=>array('ele'=>$stone-320)));
				}
				else
				{
					// fail	
					$success=false;
					$this->db->update('lionica_item',array('_id'=>$inv['_id']),array('$unset'=>array('ele'=>1)));
				}
				
				$txt=$this->char['n'].' หลอม '.$per[$stone]['n'].' Stone กับ '.$name.' - ธาตุ'.$per[$stone]['t'].'  (ใช้เงิน 500 Silver): '.($success?'สำเร็จ':'พลาด').'!.';
				$this->chat_message('[Lionica] '.$txt);
				
				$this->char['silver']-=500;
				$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$inc'=>array('silver'=>-500)));
		
				if($inv_stone['c']>1)
				{
					$this->db->update('lionica_item',array('_id'=>$inv_stone['_id']),array('$inc'=>array('c'=>-1)));
				}
				else
				{
					$this->db->remove('lionica_item',array('_id'=>$inv_stone['_id']));
				}
				
				$time=microtime(true);
				$this->map['chat'][]=array('_id'=>$time,'ty'=>'enhance','pet'=>$this->char['_id'],'t'=>$txt,'effect'=>($success?'success':'fail'),'n'=>$this->char['n'],'l'=>_::$my['link'],'tm'=>date('H:i'),'_sn'=>str_replace('.','_','tm_'.$time));
				_::cache()->set('ca2','lionica_chat',$this->map['chat'],false,3600*24);
				$this->ajax->script('_.lionica.box("npc","none")');
				$this->update_inventory();
			}
		}
	}
	else
	{
		$this->ajax->alert('ไอเท็มนี้หายไปแล้ว');	
	}
}
?>