<?php

$i=intval($arg['item']);
$items=$this->config('item');
if(isset($items[$i]))
{
	$item=$items[$i];
	if($item['type']<=1||$item['type']==10)
	{
		$num=max(intval($arg['count']),1);	
	}
	else
	{
		$num=1;
	}
	$money=abs($item['price']*$num);
	$count=$this->db->count('lionica_item',array('u'=>_::$my['_id'],'dd'=>array('$exists'=>false),'mk'=>array('$exists'=>false),'$or'=>array(array('eq'=>array('$exists'=>false)),array('eq'=>$this->char['_id']))));
	if($count>=$this->config['inventory_max'])
	{
		$this->ajax->alert('กระเป๋าเต็มแล้ว ไม่สามารถเก็บเพิ่มได้');	
	}
	elseif($this->char['silver']<$money)
	{
		$this->ajax->alert('คุณมี Silver ไม่เพียงพอ');
	}
	else
	{
		$txt='ซื้อ '.$item['name'].' '.$num.' ชิ้น ในราคา '.$money.' Silver ';
		$this->chat_message('[Lionica] '.$txt);
		$time=microtime(true);
		$this->map['chat'][]=array('_id'=>$time,'ty'=>'item','rl'=>$i,'t'=>$txt,'n'=>$this->char['n'],'l'=>_::$my['link'],'tm'=>date('H:i'),'_sn'=>str_replace('.','_','tm_'.$time));
		$this->cache->set('ca2','lionica_chat',$this->map['chat'],false,3600*24);
		
		$this->char['silver']-=$money;
		$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$inc'=>array('silver'=>($money*-1))));
		$this->item_insert(_::$my['_id'],$i,$num,false);
		$this->update_inventory();
		$this->ajax->alert('ซื้อไอเท็มเรียบร้อยแล้ว');
	}
}

?>