<?php



$m=intval(_::$path[2]);
if(!in_array($m,array(1,2,3,4,6)))
{
	_::move('/lionica');	
}

$cache=_::cache();
if(!$data=$cache->get('ca1','lionica_info_map_'.$m))
{
	$db=_::db();
	if(!$map=$db->findone('lionica_maps',array('_id'=>$m),array('_id'=>1,'name'=>1,'start'=>1,'life'=>1)))
	{
		_::move('/lionica');	
	}
	$life=require(__DIR__.'/config/life.php');
	$item=require(__DIR__.'/config/item.php');
	$npc=array();
	$monster=array();
	if($map['life'])
	{
		foreach($map['life'] as $k=>$v)
		{
			$id=intval($v);
			if($life[$id]['type']=='monster')
			{
				if(!isset($monster[$id]))
				{
					$l=(((($id-101)%10)*96)+32)*-1;
					$t=floor(($id-101)/10)*-192;
					$monster[$id]=$life[$id];
					$monster[$id]['css']=$l.'px '.$t.'px';
					$monster[$id]['loc']=($life[$id]['loc']['x']+1).':'.($life[$id]['loc']['y']+1);
					$monster[$id]['drop']='';
					if($monster[$id]['item'])
					{
						$it=explode(',',$monster[$id]['item']);
						for($j=0;$j<count($it);$j++)
						{
							list($im,$no)=explode('-',$it[$j],2);
							if($item[$im])
							{
								$monster[$id]['drop'].=', <i class="img-item" style="background-position:'.$item[$im]['css'].'"></i> '.	$item[$im]['name'];
							}
						}
						if($monster[$id]['drop'])
						{
							$monster[$id]['drop']=substr($monster[$id]['drop'],2);	
						}
					}
				}
			}
			elseif($life[$id]['type']=='npc')
			{
				if(!isset($npc[$id]))
				{
					$l=(((($id-1)%10)*96)+32)*-1;
					$t=floor(($id-1)/10)*-192;
					$npc[$id]=$life[$id];
					$npc[$id]['css']=$l.'px '.$t.'px';
					
					$loc=explode('_',$k);
					$npc[$id]['loc']=(intval($loc[1])+1).':'.(intval($loc[0])+1);
				}
			}
		}
	}
	unset($map['life']);
	$data=array('map'=>$map,'npc'=>$npc,'monster'=>$monster);

	
	$cache->set('ca1','lionica_info_map_'.$m,$data,false,3600);
}



_::$meta['title'] = 'แผนที่ '.$data['map']['name'].' - Lionica - เกมสัตว์เลี้ยง เกม Lionica สัตว์เลี้ยง เลี้ยงสัตว์บนเว็บ';
_::$meta['description'] = 'แผนที่ '.$data['map']['name'].' - เกมสัตว์เลี้ยง เลี้ยงสัตว์บนเว็บบ๊อกซ่า เกม Lionica';
_::$meta['keywords'] = $data['map']['name'].', เกมสัตว์เลี้ยง, เกมส์เล่นบนเว็บ, สัตว์เลี้ยง, เกมส์, เกม';

$template=_::template();
$template->assign('scale',8);
$template->assign('element',array(0=>'-',1=>'ดิน',2=>'น้ำ',3=>'ไฟ',4=>'ลม',5=>'สายฟ้า'));
$template->assign($data);
_::$content=$template->fetch('lionica.info.map');


?>