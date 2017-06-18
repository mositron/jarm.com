<?php

$tmp='';
$skills=require(CONFIG_PATH.'skill.php');
if($skills[intval($arg['skill'])])
{
	$skill=$skills[intval($arg['skill'])];
	if(in_array($this->char['job'],$skill['job']))
	{
		if(in_array($skill['type'],array('hp','warp')))
		{
			if($this->char['mp']<$skill['mp'])
			{
				$this->ajax->alert('MP ไม่เพียงพอ');
			}
			else
			{
				$this->char['mp']-=$skill['mp'];
				if($skill['type']=='hp')
				{
					$this->char['hp']+=$skill['hp'];
					if($this->char['hp']>$this->char['mhp'])
					{
						$this->char['hp']=$this->char['mhp'];
					}
					$this->ajax->script('_.lionica.logs('.json_encode(array(array('type'=>'skill','name'=>$skill['name'],'text'=>'เพิ่ม '+$skill['hp']+' HP','hp'=>$skill['hp'],'effect'=>'heal'))).')');
				}
				elseif($skill['type']=='warp')
				{
					$this->char['map']['x']=$this->map['start'][0];
					$this->char['map']['y']=$this->map['start'][1];
					
					$this->ajax->script('if(_.lionica.eai)_.lionica.ai();_.lionica.logs('.json_encode(array(array('type'=>'skill','name'=>$skill['name'],'text'=>'ไปยัง ['.($this->char['map']['x']+1).','.($this->char['map']['y']+1).']'))).')');
					$this->ajax->script('_.lionica.player.warp(['.$this->char['map']['x'].','.$this->char['map']['y'].']);');
					$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$set'=>array('map.x'=>$this->char['map']['x'],'map.y'=>$this->char['map']['y'])));	
				}
				$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$set'=>array('hp'=>$this->char['hp'],'mp'=>$this->char['mp'],'du'=>new MongoDate())));
			}
		}
	}
	else
	{
		$this->ajax->alert('ไม่สามารถใช้สกิล '.$skill['name'].' ได้');	
	}
}

?>