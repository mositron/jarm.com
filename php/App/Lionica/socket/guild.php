<?php

if($arg['type']=='open')
{
	$css='';
	$btn='';
	$myguild='';
	$have=0;
	if($this->char['g'])
	{
		if($guild=$this->db->findone('lionica_guild',array('_id'=>$this->char['g']['_id'])))
		{
			//_::time();
			$have=1;
			if($guild['p']==$this->char['_id'])
			{
				$have=2;	
			}
			$mg=$guild['us']['p'.$this->char['_id']];
			$glevel=array('สมาชิก','รองหัวหน้า','หัวหน้า');
			$myguild='<div id="guild_my">
			<div style="padding:5px">กิลด์: '.$guild['n'].' <span style="display:inline-block; color:#ccc; padding:0px 5px;">|</span> ประสบการณ์: '.number_format(intval($guild['xp'])).'/'.number_format(intval($guild['mxp'])).'<span class="btn btn-mini btn-inverse pull-right" onClick="$(\'#guild_my\').hide(\'fast\');$(\'#guild_all\').show(\'fast\')">กิลด์ทั้งหมด</span></div>
			<div>สมาชิก: '.count($guild['us']).'/'.$guild['mx'].' <span style="display:inline-block; color:#ccc; padding:0px 5px;">|</span> เลเวล: '.$guild['lv'].' <span style="display:inline-block; color:#ccc; padding:0px 5px;">|</span> สถานะ: ';
			$status=($guild['ac']?'เปิดรับสมาชิกใหม่':'ปิดรับสมาชิก');
			if($mg['l']>0)
			{
				$myguild.='<span class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$status.' <b class="caret"></b></a><ul class="dropdown-menu" style="background:#000;"><li><a href="javascript:;" onclick="_.lionica.api(\'guild\',{\'type\':\'accept\',\'accept\':1});">เปิดรับสมาชิกใหม่</a></li><li><a href="javascript:;" onclick="_.lionica.api(\'guild\',{\'type\':\'accept\',\'accept\':0});">ปิดรับสมาชิก</a></li></ul></span>';
			}
			else
			{
				$myguild.=$status;
			}
			$myguild.='</div>';
			$myguild.='<table width="100%"  border="0" cellspacing="0" cellpadding="1"><tr><td align="center">สมาชิก</td><td width="50" align="center">ออนไลน์</td><td width="50" align="center">อาชีพ</td><td width="40" align="center">เลเวล</td><td width="70" align="center">ประสบการณ์</td><td width="60" align="center">ประเภท</td><td width="50"></td></tr>';
			
			$job=$this->config('job');
			$tlv=array();
			$lv=array();
			$xp=array();
			foreach ($guild['us']  as $k => $v)
			{
				$tlv[$k]  = $v['l'];
				$lv[$k]  = $v['lv'];
				$xp[$k] = $v['xp'];
			}
			array_multisort($tlv, SORT_DESC, $xp, SORT_DESC, $lv, SORT_DESC, $guild['us'] );
			
			$time2=time()-60;

			foreach($guild['us'] as $k=>$v)
			{
				$myguild.='<tr><td>'.$v['n'].'</td><td align="center">'.($v['ol']?($v['ol']->sec>$time2?'ตอนนี้':time::ago($v['ol'])):'-').'</td><td align="center">'.($v['j']?$job[$v['j']]['name']:'').'</td><td align="center">'.$v['lv'].'</td><td align="right">'.number_format(intval($v['xp'])).'</td><td align="center">'.$glevel[$v['l']].'</td><td align="center" width="50">';
				if($this->char['_id']==$v['_id'])
				{
					if($this->char['_id']!=$guild['p'])
					{
						$myguild.='<a href="javascript:;" onClick="if(confirm(\'ต้องการออกจากกิลด์นี้หรือไม่\'))_.lionica.api(\'guild\',{\'type\':\'leave\',\'pet\':'.mb_substr($k,1,NULL,'utf-8').'})" class="btn btn-mini btn-inverse">ออก</a>';
					}
				}
				elseif($mg['l']>0)
				{
					$myguild.=($mg['l']>$v['l']?'<a href="javascript:;" onClick="if(confirm(\'ต้องการไล่บุคคลนี้ออกจากกิลด์หรือไม่\'))_.lionica.api(\'guild\',{\'type\':\'kick\',\'pet\':'.mb_substr($k,1,NULL,'utf-8').'})" class="btn btn-mini btn-inverse">ไล่ออก</a>':'');
				}
				$myguild.='</td></tr>';
			}
			$myguild.='</table></div>';
			$css=' style="display:none"';
			$btn='<span class="btn btn-mini btn-inverse pull-right" onClick="$(\'#guild_my\').show(\'fast\');$(\'#guild_all\').hide(\'fast\')">กิลด์ของฉัน</span>';
		}
	}
	$guild=$this->db->find('lionica_guild',array('dd'=>array('$exists'=>false)),array('_id'=>1,'n'=>1,'p'=>1,'c'=>1,'mx'=>1,'ac'=>1,'lv'=>1,'xp'=>1,'pn'=>1,'mxp'=>1),array('sort'=>array('lv'=>-1,'xp'=>-1,'c'=>-1)));
	$myguild.='<div id="guild_all"'.$css.'><div style="padding:5px">กิลด์ทั้งหมด '.$btn.'</div>';
	$myguild.='<table width="100%"  border="0" cellspacing="0" cellpadding="1"><tr><td align="center">กิลด์</td><td width="100" align="center">หัวหน้ากิลด์</td><td width="50" align="center">เลเวล</td><td width="60" align="center">ประสบการณ์</td><td width="50" align="center">สมาชิก</td><td width="80"></td></tr>';
	
	foreach($guild as $k=>$v)
	{
		$myguild.='<tr><td>'.$v['n'].'</td><td align="center"><p style="width:100px; overflow:hidden">'.$v['pn'].'</p></td><td align="center">'.$v['lv'].'</td><td align="center">'.number_format(intval($v['xp'])).'/'.number_format(intval($v['mxp'])).'</td><td align="center">'.$v['c'].'/'.$v['mx'].'</td><td align="center">';
		if($v['ac']&&$v['c']<$v['mx'])
		{
			if($have==1)
			{
				if($v['_id']==$this->char['g']['_id'])
				{
					$myguild.='<span class="btn btn-mini btn-inverse" onClick="if(confirm(\'คุณต้องการออกจากกิลด์นี้หรือไม่\'))_.lionica.api(\'guild\',{\'type\':\'leave\',\'guild\':'.$v['_id'].'})">ออก</span>';
				}
			}
			elseif($have==0)
			{
				$myguild.='<span class="btn btn-mini btn-inverse" onClick="if(confirm(\'คุณต้องการเข้ากิลด์นี้หรือไม่\'))_.lionica.api(\'guild\',{\'type\':\'join\',\'guild\':'.$v['_id'].'})">เข้ากิลด์นี้</span>';
			}
		}
		$myguild.='</td></tr>';
	}
	$myguild.='</table></div>';
	
	$this->ajax->jquery('#guild_text','html',$myguild);
}
elseif($arg['type']=='accept')
{
	if($this->char['g'])
	{
		if($guild=$this->db->findone('lionica_guild',array('_id'=>intval($this->char['g']['_id']),'dd'=>array('$exists'=>false))))
		{
			$mg=$guild['us']['p'.$this->char['_id']];
			if($mg['l']>0)
			{
				$this->db->update('lionica_guild',array('_id'=>$this->char['g']['_id']),array('$set'=>array('ac'=>($arg['accept']?1:0))));
				$this->ajax->script('_.lionica.box("guild","block")');
			}
		}
	}
}
elseif($arg['type']=='coin')
{
	if($this->char['g'])
	{
		if($guild=$this->db->findone('lionica_guild',array('_id'=>intval($this->char['g']['_id']),'dd'=>array('$exists'=>false))))
		{
			$coin=intval($arg['coin']);
			if($coin<1)
			{
				$this->ajax->alert('กรอกจำนวนที่เจ้าต้องการบริจาคมาสิ');
			}
			elseif(!$inv=$this->db->findone('lionica_item',array('item'=>306,'u'=>_::$my['_id'])))
			{
				$this->ajax->alert('เจ้ายังไม่มี Guild Coin มาให้ข้า');
			}
			elseif($inv['c']<$coin)
			{
				$this->ajax->alert('เจ้ามี Guild Coin  ไม่เพียงพอ');	
			}
			else
			{
				if($inv['c']>$coin)
				{
					$this->db->update('lionica_item',array('_id'=>$inv['_id']),array('$inc'=>array('c'=>($coin*-1))));
				}
				else
				{
					$this->db->remove('lionica_item',array('_id'=>$inv['_id']));
				}
				$this->ajax->alert('บริจาค Guild Coin  จำนวน '.$coin.' เหรียญเรียบร้อยแล้ว');	
				
				
				$guild['xp']+=$coin;
				$set=array('xp'=>$guild['xp'],'us.p'.$this->char['_id'].'.lv'=>$this->char['lv'],'us.p'.$this->char['_id'].'.j'=>$this->char['job'],'us.p'.$this->char['_id'].'.ty'=>$this->char['ty']);
				if($guild['xp']>=$guild['mxp'])
				{
					while($guild['xp']>=$guild['mxp'])
					{
						$guild['lv']++;
						$guild['mx']+=2;
						$guild['xp']-=$guild['mxp'];
						$guild['mxp']=((150*pow($guild['lv']-1,3))+($guild['lv']*100));
						
						
						$set['lv']=$guild['lv'];
						$set['mx']=$guild['mx'];
						$set['xp']=$guild['xp'];
						$set['mxp']=$guild['mxp'];
					}
				}
				
				if($member=$this->db->find('lionica_char',array('dd'=>array('$exists'=>false),'g._id'=>$guild['_id'])))
				{
					for($i=0;$i<count($member);$i++)
					{
						$this->db->update('lionica_char',array('_id'=>$member[$i]['_id']),array('$set'=>array('g.lv'=>$guild['lv'])));	
					}
				}
				
				$this->db->update('lionica_guild',array('_id'=>$this->char['g']['_id']),array('$set'=>$set,'$inc'=>array('us.p'.$this->char['_id'].'.xp'=>$coin)));	
				
				
				$this->update_inventory();
				$this->chat_message('[Lionica] '.$this->char['n'].' บริจาค Guild Coin จำนวน '.$coin.' เหรียญให้กับกิลด์ '.$guild['n'].'.');
				$this->ajax->script('_.lionica.box("npc","none")');
			}
		}
	}
	else
	{
		$this->ajax->alert($this->char['n'].' ยังไม่ได้เข้ากิลด์');	
	}
}
elseif($arg['type']=='leave')
{
	$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$unset'=>array('g'=>1)));
	if($guild=$this->db->find('lionica_guild',array('us.p'.$this->char['_id']=>array('$exists'=>true))))
	{
		for($i=0;$i<count($guild);$i++)
		{
			if($guild[$i]['p']!=$this->char['_id'])
			{
				$this->db->update('lionica_guild',array('_id'=>$guild[$i]['_id']),array('$set'=>array('c'=>count($guild[$i]['us'])-1),'$unset'=>array('us.p'.$this->char['_id']=>1)));
			}
		}
		$this->chat_message('[Lionica] '.$this->char['n'].' ออกจากกิลด์ '.$guild[$i]['n'].'.');
	}
	$this->ajax->alert('ออกกิลด์เรียบร้อยแล้ว');
	$this->ajax->script('_.lionica.box("guild","block")');
	$this->ajax->jquery('#char_guild','html','-');
	$this->ajax->jquery('#player_guild','html','');
}
elseif($arg['type']=='kick')
{
	if($this->char['g']&&($pid=intval($arg['pet'])))
	{
		if($pid!=$this->char['_id'])
		{
			if($guild=$this->db->findone('lionica_guild',array('_id'=>$this->char['g']['_id'])))
			{
				if(isset($guild['us']['p'.$pid]))
				{
					$myg=intval($guild['us']['p'.$this->char['_id']]['l']);
					$peg=intval($guild['us']['p'.$pid]['l']);
					if($myg>$peg)
					{
						$this->db->update('lionica_char',array('_id'=>$pid,'g._id'=>$guild['_id']),array('$unset'=>array('g'=>1)));
						$this->db->update('lionica_guild',array('_id'=>$guild['_id']),array('$set'=>array('c'=>count($guild['us'])-1),'$unset'=>array('us.p'.$pid=>1)));
						
						$this->chat_message('[Lionica] '.$this->char['n'].' ขับไล่ '.$guild['us']['p'.$pid]['n'].' ออกจากกิลด์ '.$guild['n'].'.');
						$this->ajax->alert('ขับไล่ออกกิลด์เรียบร้อยแล้ว');
						$this->ajax->script('_.lionica.box("guild","block")');
					}
					else
					{
						$this->ajax->aerty('คุณไม่มีสิทธิ์ไล่สัตว์เลี้ยงนี้');
					}
				}
				else
				{
					$this->ajax->aerty('ไม่มีสัตว์เลี้ยงนี้');
				}
			}
		}
		else
		{
			$this->ajax->aerty('คุณไม่มีสิทธิ์ไล่ตัวเอง');
		}
	}
}
elseif($arg['type']=='join')
{
	if($this->char['g'])
	{
		$this->ajax->alert('คุณมีกิลด์อยู่แล้ว');	
	}
	elseif($guild=$this->db->findone('lionica_guild',array('_id'=>intval($arg['guild']),'dd'=>array('$exists'=>false))))
	{
		if($guild['ac'])
		{
			if(count($guild['us'])<$guild['mx'])
			{
				$this->db->update('lionica_guild',array('_id'=>$guild['_id']),array('$set'=>array('c'=>count($guild['us'])+1,'us.p'.$this->char['_id']=>array('_id'=>$this->char['_id'],'n'=>$this->char['n'],'l'=>0,'lv'=>$this->char['lv'],'j'=>$this->char['job'],'ty'=>$this->char['ty']))));
				$this->char['g']=array('_id'=>$guild['_id'],'n'=>$guild['n'],'l'=>0,'lv'=>$guild['lv']);
				$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$set'=>array('g'=>$this->char['g'])));
				$this->ajax->alert('เข้ากิลด์เรียบร้อยแล้ว');
				$this->ajax->script('_.lionica.box("guild","block")');
				$this->ajax->jquery('#char_guild','html',$guild['n']);
				$this->ajax->jquery('#player_guild','html',$guild['n']);
				$this->chat_message('[Lionica] '.$this->char['n'].' เข้ากิลด์ '.$guild['n'].'.');
			}
			else
			{
				$this->ajax->alert('กิลด์นี้เต็มแล้ว');	
			}
		}
		else
		{
			$this->ajax->alert('กิลด์นี้ปิดการรับสมัครสมาชิกเพิ่ม');
		}
	}
	else
	{
		$this->ajax->alert('ไม่มีกิลด์นี้');	
	}
}
elseif($arg['type']=='new')
{
	$name=trim($arg['name']);
	$name2=strtolower($name);
	if(!$inv=$this->db->findone('lionica_item',array('item'=>305,'u'=>_::$my['_id'])))
	{
		$this->ajax->alert('เจ้ายังไม่มี Emperium มาให้ข้า');
	}
	elseif($this->char['g'])
	{
		$this->ajax->alert('เจ้ามีกิลด์อยู่แล้ว');	
	}
	elseif(!preg_match('/^[a-z0-9]{3,15}$/i',$name))
	{
		$this->ajax->alert('ชื่อกิลด์ไม่ถูกต้อง');
	}
	elseif($this->db->findone('lionica_guild',array('n2'=>$name2)))
	{
		$this->ajax->alert('มีชื่อกิลนี้อยู่แล้ว');	
	}
	else
	{
		if($g=$this->db->insert('lionica_guild',array('u'=>_::$my['_id'],'p'=>$this->char['_id'],'pn'=>$this->char['n'],'n'=>$name,'n2'=>$name2,'mx'=>25,'lv'=>1,'xp'=>0,'mxp'=>100,'c'=>1,'ac'=>1)))
		{
			$guild=array('_id'=>$g,'n'=>$name,'l'=>2,'lv'=>1);
			$this->char['g']=$guild;
			$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$set'=>array('g'=>$this->char['g'])));
			$this->db->update('lionica_guild',array('_id'=>$g),array('$set'=>array('us.p'.$this->char['_id']=>array('_id'=>$this->char['_id'],'n'=>$this->char['n'],'l'=>2))));
			$this->ajax->alert('ตั้งกิลด์เรียบร้อยแล้ว');
			$this->ajax->script('_.lionica.box("guild","block");_.lionica.box("npc","none");');
			$this->ajax->jquery('#char_guild','html',$name);
			$this->ajax->jquery('#player_guild','html',$name);
			$this->chat_message('[Lionica] '.$this->char['n'].' สร้างกิลด์ '.$guild['n'].'.');
			if($inv['c']>1)
			{
				$this->db->update('lionica_item',array('_id'=>$inv['_id']),array('$inc'=>array('c'=>-1)));
			}
			else
			{
				$this->db->remove('lionica_item',array('_id'=>$inv['_id']));
			}
			$this->update_inventory();
		}
	}
}
?>