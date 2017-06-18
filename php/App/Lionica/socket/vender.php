<?php

if($arg['type']=='open')
{
	$left='<h4>ร้านค้าของคุณ</h4>';
	$right='<h4>ไอเท็มในกระเป๋า</h4>';
	$status=0;
	$job=$this->config('job');
	$items=$this->config('item');	
	if($vender=$this->db->findone('lionica_vender',array('u'=>_::$my['_id'])))
	{
		if(is_array($vender['item']))
		{
			$status=1;
			$left.='<table width="100%"><tr><th class="n">ไอเท็ม</th><th class="c">จำนวน</th><th class="p">ราคาต่อชิ้น</th></tr>';
			foreach($vender['item'] as $vd)
			{
				if(isset($items[$vd['item']]))
				{		
					$left.='<tr><td class="n"><p class="lionica-popup" data-popup="'.$vd['popup'].'"><i class="item" style="background-position:'.$items[$vd['item']]['css'].'"></i> '.$vd['name'].'</p></td><td class="c">'.$vd['count'].'</td><td class="p">'.$vd['price'].'</td></tr>';
				}
			}
			$left.='</table>';	
		}
		else
		{
			$status=0;
			$left.='<p style="padding:5px; text-align:center">- ยังไม่มีสินค้า -</p>';
			$this->db->remove('lionica_vender',array('_id'=>$vender['_id']));
			$this->db->update('lionica_item',array('u'=>_::$my['_id']),array('$unset'=>array('mk'=>1)),array('multiple'=>true));
		}
	}
	else
	{
		$left.='<p style="padding:5px; text-align:center">- ยังไม่มีสินค้า -</p>';
	}
	
	$left.='</table><div style="padding:10px; text-align:center"><input type="button" class="btn btn-mini btn-inverse" value="ปิดร้านค้า / ยกเลิกร้านค้า" onclick="_.lionica.shop.cancel()"></div>';	
			
	$right.='<table width="100%"  border="0" cellspacing="0" cellpadding="1"><tr><th class="n">ไอเท็ม</th><th class="c">จำนวน</th><th class="p">ราคาขายร้าน</th></tr>';
	$inv=$this->db->find('lionica_item',array('u'=>_::$my['_id'],'dd'=>array('$exists'=>false),'mk'=>array('$exists'=>false),'eq'=>array('$exists'=>false)),array(),array('sort'=>array('da'=>1)));
	for($i=0;$i<count($inv);$i++)
	{
		if($inv[$i]['ps'])
		{
			continue;	
		}
		list($item,$popup)=$this->item($inv[$i]);
		$right.='<tr>';
		$right.='<td class="l'.($i%2).' n"><a href="javascript:;" onclick="_.lionica.shop.insert(this,'.$inv[$i]['_id'].','.$inv[$i]['c'].','.$item['sell'].')" class="lionica-popup" data-popup="'.$popup.'"><i class="item" style="background-position:'.$item['css'].'"></i> <span>'.$item['name'].'</span></a></td>';
		$right.='<td class="l'.($i%2).' c">'.$inv[$i]['c'].'</td>';
		$right.='<td class="l'.($i%2).' p">'.number_format($item['sell']).'</td></tr>';
	}
	$right.='</table>';
	
	$this->ajax->jquery('.vender .left','html',$left);
	$this->ajax->jquery('.vender .right','html',$right);
	$this->ajax->script('_.lionica.shop.vender='.$status);
	
	
	$this->char['map']['x']=intval($arg['pos']['x']);
	$this->char['map']['y']=intval($arg['pos']['y']);
	$this->char['map']['z']=(in_array($arg['pos']['z'],array('d','l','r','u'))?$arg['pos']['z']:'d');
	$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$set'=>array('map'=>$this->char['map'])));
}
elseif($arg['type']=='insert')
{
	if(($inv=intval($arg['item']))&&($count=intval($arg['count']))&&($price=intval($arg['price'])))
	{
		if($inv=$this->db->findone('lionica_item',array('u'=>_::$my['_id'],'_id'=>$inv,'eq'=>array('$exists'=>false))))
		{
			$items=$this->config('item');	
			if(isset($items[$inv['item']]))
			{
				list($item,$popup)=$this->item($inv);
				if($price>0)
				{
					if($count>=1&&$count<=$inv['c'])
					{
						$inv_vd=array('item'=>$inv['item'],'inv'=>$inv['_id'],'name'=>$item['name'],'count'=>$count,'price'=>$price,'popup'=>$popup);
						if($vender=$this->db->findone('lionica_vender',array('u'=>_::$my['_id'])))
						{
							$this->db->update('lionica_vender',array('u'=>_::$my['_id'],'p'=>$this->char['_id']),array('$set'=>array('item.i'.$inv['_id']=>$inv_vd,'du'=>new MongoDate())));
						}
						else
						{
							$this->db->insert('lionica_vender',array('u'=>_::$my['_id'],'p'=>$this->char['_id'],'n'=>$this->char['n'],'item'=>array('i'.$inv['_id']=>$inv_vd),'du'=>new MongoDate()));
						}
						$this->db->update('lionica_item',array('u'=>_::$my['_id'],'_id'=>$inv['_id']),array('$set'=>array('mk'=>$count)));
						$this->ajax->jquery('.vender .left','html','<p>รออัพเดทซักครู่...</p>');
						$this->ajax->jquery('.vender .right','html','<p>รออัพเดทซักครู่...</p>');
						$this->ajax->script('_.lionica.box("vender","block");');
						
						
						$time=time();
						if(!$this->map['online']=_::cache()->get('ca2','lionica_maps_online_'.$this->map['_id']))
						{
							$this->map['online']=array('pet'=>array(),'update'=>time());
						}
						$this->map['online']['pet'][$this->char['_id']]=array('n'=>$this->char['n'],'x'=>$this->char['map']['x'],'y'=>$this->char['map']['y'],'z'=>$this->char['map']['z'],'ty'=>$this->char['ty'],'du'=>$time,'hd'=>intval($this->char['eq']['i2']['item']),'g'=>($this->char['g']?$this->char['g']['n']:''),'gi'=>($this->char['g']?$this->char['g']['_id']:''),'v'=>_::$my['_id']);
						$this->map['online']['update']=$time;
						_::cache()->set('ca2','lionica_maps_online_'.$this->map['_id'],$this->map['online'],false,3600*24);
						
						$this->update_inventory();
					}
				}
			}
		}
		else
		{
			$this->ajax->alert('ไม่สามารถขายไอเท็มชิ้นนี้ได้');		
		}
	}
}
elseif($arg['type']=='cancel')
{
	$this->db->remove('lionica_vender',array('u'=>_::$my['_id']));
	$this->db->update('lionica_item',array('u'=>_::$my['_id']),array('$unset'=>array('mk'=>1)),array('multiple'=>true));
	$this->ajax->script('_.lionica.box("vender","none");');
	$this->ajax->script('_.lionica.shop.vender=0;');
	
	$time=time();
	if(!$this->map['online']=_::cache()->get('ca2','lionica_maps_online_'.$this->map['_id']))
	{
		$this->map['online']=array('pet'=>array(),'update'=>time());
	}
	$this->map['online']['pet'][$this->char['_id']]=array('n'=>$this->char['n'],'x'=>$this->char['map']['x'],'y'=>$this->char['map']['y'],'z'=>$this->char['map']['z'],'ty'=>$this->char['ty'],'du'=>$time,'hd'=>intval($this->char['eq']['i2']['item']),'g'=>($this->char['g']?$this->char['g']['n']:''),'gi'=>($this->char['g']?$this->char['g']['_id']:''),'v'=>0);
	$this->map['online']['update']=$time;
	_::cache()->set('ca2','lionica_maps_online_'.$this->map['_id'],$this->map['online'],false,3600*24);
		
	$this->update_inventory();
}
elseif($arg['type']=='shop')
{
	$job=$this->config('job');
	$items=$this->config('item');
	if($vender=$this->db->findone('lionica_vender',array('u'=>intval($arg['shop']))))
	{
		if(is_array($vender['item']))
		{
			$status=1;
			$left.='<table width="100%"><tr><th class="n">ไอเท็ม</th><th class="c">จำนวน</th><th class="p">ราคาต่อชิ้น</th></tr>';
			foreach($vender['item'] as $vd)
			{
				if(isset($items[$vd['item']]))
				{
					$item=$items[$vd['item']];
					$left.='<tr>
						<td class="l'.($i%2).' n">
						<a href="javascript:;" onclick="_.lionica.shop.buy(this,'.$vd['inv'].','.$vd['count'].','.$vd['price'].','.$vender['_id'].')" class="lionica-popup" data-popup="'.$vd['popup'].'">
						'.($item['css']?'<i class="item" style="background-position:'.$items[$vd['item']]['css'].'"></i> ':'').'<span>'.($vd['name']?$vd['name']:$items[$vd['item']]['name']).'</span>
						</a>
						</td>
						<td class="c">'.$vd['count'].'</td>
						<td class="p">'.$vd['price'].'</td>
						</tr>
						';
				}
			}
			$left.='</table>';
		}
		else
		{
			$left.='<p style="padding:5px; text-align:center">- ยังไม่มีสินค้า -</p>';
		}
		$this->ajax->jquery('.shop .name .text','html','ร้านค้าของ '.$vender['n']);
		$this->ajax->jquery('#shop_text','html',$left);
	}
	else
	{
		$this->ajax->alert('ร้านค้านี้ปิดไปแล้ว');
		$this->ajax->script('_.lionica.box("shop","none");');
	}
}
elseif($arg['type']=='buy')
{
	if($vender=$this->db->findone('lionica_vender',array('_id'=>intval($arg['shop']))))
	{
		if(isset($vender['item']['i'.$arg['item']]))
		{
			$shop_item=$vender['item']['i'.$arg['item']];
			///$this->db->update('lionica_vender',array('u'=>_::$my['_id']),array('$set'=>array('item.i'.$inv['_id']=>array('item'=>$inv['item'],'inv'=>$inv['_id'],'count'=>$count,'price'=>$price),'du'=>new MongoDate())));
			$count=intval($arg['count']);
			$money=$count*$shop_item['price'];
			if($shop_item['count']<$count)		
			{
				$this->ajax->alert('ไอเท็มนี้เหลือจำนวนไม่เพียงพอ');
			}
			elseif($count<1)
			{
				
			}
			elseif($this->char['silver']<$money)
			{
				$this->ajax->alert('มีเงินไม่เพียงพอ');
			}
			elseif($seller_inv=$this->db->findone('lionica_item',array('_id'=>$shop_item['inv'],'u'=>$vender['u'])))
			{
				if($count>$seller_inv['c'])
				{
					if($seller_inv['c']==1)
					{
						$this->ajax->alert('ไอเท็มชิ้นนี้ถูกขายไปแล้ว');	
					}
					else
					{
						$this->ajax->alert('ไอเท็มนี้เหลือจำนวนไม่เพียงพอ');
					}
				}
				else
				{
					$items=$this->config('item');
					$im=$items[$shop_item['item']];
					if($im['type']<=1||$im['type']==10)
					{
						// buyer
						$this->item_insert(_::$my['_id'],$shop_item['item'],$count,false);
						//seller
						$inv_count=$seller_inv['c']-$count;
						if($inv_count>0)
						{
							$this->db->update('lionica_item',array('_id'=>$seller_inv['_id']),array('$inc'=>array('c'=>$count*-1)));
						}
						else
						{
							$this->db->remove('lionica_item',array('_id'=>$seller_inv['_id']));
						}
						//shop
						$shop_count=$shop_item['count']-$count;
						if($shop_count>0)
						{
							$this->db->update('lionica_vender',array('_id'=>$vender['_id']),array('$set'=>array('item.i'.$shop_item['inv'].'.count'=>$shop_count)));
						}
						else
						{
							$this->db->update('lionica_vender',array('_id'=>$vender['_id']),array('$unset'=>array('item.i'.$shop_item['inv']=>1)));
						}
					}
					else
					{
						// buyer => seller
						$this->db->update('lionica_item',array('_id'=>$seller_inv['_id']),array('$set'=>array('u'=>_::$my['_id']),'$unset'=>array('mk'=>1),'$push'=>array('seller'=>array('u'=>$vender['u'],'t'=>new MongoDate(),'p'=>$shop_item['price']))));
						$this->db->update('lionica_vender',array('_id'=>$vender['_id']),array('$unset'=>array('item.i'.$shop_item['inv']=>1)));
					}
					
					$name=($shop_item['name']?$shop_item['name']:$im['name']);
					
					$txt=$this->char['n'].' ซื้อ '.$name.' '.$count.' ชิ้น ในราคา '.$money.' Silver จากร้านของ '.$vender['n'];
					$this->chat_message('[Lionica] '.$txt);
					
					$this->char['silver']-=$money;
					$this->db->update('lionica_char',array('_id'=>$this->char['_id']),array('$inc'=>array('silver'=>($money * -1))));
					$this->db->update('lionica_char',array('_id'=>$vender['p']),array('$inc'=>array('silver'=>($money))));
					
					$time=microtime(true);
					$this->map['chat'][]=array('_id'=>$time,'ty'=>'shop','seller'=>$vender['u'],'rl'=>$vender['u'],'t'=>$txt,'n'=>$this->char['n'],'l'=>_::$my['link'],'tm'=>date('H:i'),'_sn'=>str_replace('.','_','tm_'.$time));
					_::cache()->set('ca2','lionica_chat',$this->map['chat'],false,3600*24);
					
					$this->update_inventory();
					$this->ajax->alert('ซื้อไอเท็มเรียบร้อยแล้ว');	
					
				}
			}
			else
			{
				$this->ajax->alert('ไอเท็มชิ้นนี้ถูกขายไปแล้ว');	
			}
		}
		else
		{
			$this->ajax->alert('ไอเท็มนี้ถูกขายไปแล้ว');
		}
	}
	else
	{
		$this->ajax->alert('ร้านค้านี้ปิดไปแล้ว');
	}
	$this->ajax->script('_.lionica.box("shop","none")');
}
?>