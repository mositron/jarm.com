<?php
if($arg['type']=='stats')
{
	if(in_array($arg['up'],array('str','agi','vit','dex','int')))
	{
		if($this->char['stats'][$arg['up']]>=99)
		{
			//$this->ajax->alert('1');
		}
		else
		{
			$req=floor(($this->char['stats'][$arg['up']] - 2)/10)+2;
			if($this->char['stats']['ptr']>=$req)
			{
				$this->char['stats']['ptr']-=$req;
				$this->char['stats'][$arg['up']]++;
				$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$set'=>array('stats.'.$arg['up']=>$this->char['stats'][$arg['up']],'stats.ptr'=>$this->char['stats']['ptr'])));
				$this->update_stats();
			}
			else
			{
				// ไม่พออัพ	
			}
		}
	}
}

?>