<?php

if($inv=$this->db->findone('lionica_item',array('_id'=>intval($arg['item']),'u'=>_::$my['_id'],'dd'=>array('$exists'=>false),'mk'=>array('$exists'=>false))))
{
	//$info=array();
	$num=max(intval($arg['count']),1);
	if($inv['eq'])
	{
		$this->ajax->alert('กรุณาถอดไอเท็ม ก่อนทำการขาย');
	}
	elseif($num>$inv['c'])
	{
		$this->ajax->alert('จำนวนไอเท็มไม่เพียงพอต่อการขาย');
	}
	else
	{
		$items=$this->config('item');
		if(isset($items[$inv['item']]))
		{
			$item=$items[$inv['item']];	
			
			if($inv['c']>$num)
			{
				$this->db->update('lionica_item',array('_id'=>$inv['_id']),array('$inc'=>array('c'=>($num*-1))));
			}
			else
			{
				$this->db->remove('lionica_item',array('_id'=>$inv['_id']));
			}
			$money=($item['sell']*$num);
		
			$this->char['silver']+=$money;
			$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$inc'=>array('silver'=>$money)));
			
			$name=($inv['nh']?'+'.$inv['nh'].' ':'').$item['name'];
			if($inv['slot'])
			{
				$name.=' ['.($inv['ele']?$this->config['element'][$inv['ele']]:'').']';
			}
			
			$this->chat_message('[Lionica] ขาย '.$name.' '.$num.' ชิ้น - ราคา '.$money.' Silver ');
			
			$time=microtime(true);
			$this->map['chat'][]=array('_id'=>$time,'ty'=>'item','rl'=>$inv['item'],'t'=>'ขาย '.$name.' '.$num.' ชิ้น - ราคา '.$money.' Silver ','n'=>$this->char['n'],'l'=>_::$my['link'],'tm'=>date('H:i'),'_sn'=>str_replace('.','_','tm_'.$time));
			_::cache()->set('ca2','lionica_chat',$this->map['chat'],false,3600*24);
			
			
			$mons=$this->config('life');
			$life=$mons[5];
			require(SOCKET_PATH.'position_npc.php');
		}
	}
	$this->update_inventory();
	//$this->ajax->script('_.lionica.logs('.json_encode($info).')');
}

?>