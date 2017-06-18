<?php
if($arg['type']=='change')
{
}
elseif($arg['type']=='free')
{
	$day=date('Y-m-d');
	if($this->char['op']&&$this->char['op']['pet'])
	{
		$this->ajax->alert('เจ้าเคยรับสัตว์เลี้ยงจากข้าไปแล้ว');
	}
	elseif($this->char['lv']<10)
	{
		$this->ajax->alert('เลเวลไม่เพียงพอ');
	}
	else
	{
		$item=rand(314,318);
		$this->item_insert(_::$my['_id'],$item,1,true);
		$this->update_inventory();
		$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$set'=>array('op.pet'=>1)));
		$items=$this->config('item');
		$item=$items[$item];
		
		$this->ajax->alert('ได้รับ '.$item['name']);
		$this->chat_message('[Lionica] ได้รับ '.$item['name'].' จากผู้ดูแลสัตว์เลี้ยง');
		$time=microtime(true);
		$this->map['chat'][]=array('_id'=>$time,'ty'=>'item','rl'=>$i,'t'=>'ได้รับ '.$item['name'].' จากผู้ดูแลสัตว์เลี้ยง','n'=>$this->char['n'],'l'=>_::$my['link'],'tm'=>date('H:i'),'_sn'=>str_replace('.','_','tm_'.$time));
		$this->cache->set('ca2','lionica_chat',$this->map['chat'],false,3600*24);
	}
}
elseif($arg['type']=='upgrade')
{
	if($this->char['pet'])
	{
		$req=array(
								1=>array('silver'=>10000,'lv'=>10,'evo'=>0),
								2=>array('silver'=>100000,'lv'=>20,'evo'=>1),
						);
		$evo=intval($arg['evo']);
		
		if(!isset($this->char['pet']['status']['evo']))
		{
			$this->char['pet']['status']['evo']=0;
		}
		if(isset($req[$evo]))
		{
			if($this->char['pet']['status']['lv']<$req[$evo]['lv'])
			{
				$this->ajax->alert('เลเวลของสัตว์เลี้ยงไม่เพียงพอ');
			}
			elseif($this->char['pet']['status']['evo']>$req[$evo]['evo'])
			{
				$this->ajax->alert('สัตว์เลี้ยงได้วิวัฒนาการร่างนี้ไปแล้ว');
			}
			elseif($this->char['pet']['status']['evo']!=$req[$evo]['evo'])
			{
				$this->ajax->alert('สัตว์เลี้ยงยังไม่ได้วิวัฒนาการร่างที่ '.($req[$evo]['evo']+1));
			}
			elseif($this->char['silver']<$req[$evo]['silver'])
			{
				$this->ajax->alert('คุณมี Silver ไม่เพียงพอ');
			}
			else
			{
				$this->char['pet']['status']['evo'] = $evo;
				$this->char['silver']-=$req[$evo]['silver'];
				$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$inc'=>array('silver'=>($req[$evo]['silver'] * -1)),'$set'=>array('pet.status.pet'=>$this->char['pet']['status']['evo'])));
				$this->chat_message('[Lionica] '.$this->char['pet']['n'].' วิวัฒนาการใหม่เป็นร่าง '.($evo+1));
				$this->update_stats();
				$this->ajax->alert('วิวัฒนาการเรียบร้อยแล้ว');
				$this->ajax->script('_.lionica.box("npc","none");');
				$time=microtime(true);
				$this->map['chat'][]=array('_id'=>$time,'ty'=>'evolution','pet'=>$this->char['_id'],'t'=>$this->char['n'].' วิวัฒนาการใหม่เป็นร่าง '.($evo+1),'n'=>$this->char['n'],'l'=>_::$my['link'],'tm'=>date('H:i'),'_sn'=>str_replace('.','_','tm_'.$time));
				_::cache()->set('ca2','lionica_chat',$this->map['chat'],false,3600*24);
			}
		}
	}
	else
	{
		$this->ajax->alert('เจ้ายังไม่มีสัตว์เลี้ยง.');
	}
}
?>