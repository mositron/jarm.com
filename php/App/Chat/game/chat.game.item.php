<?php

//Load::Session()->logged();

define('BANK_RATE',50);



Load::$core->assign('item',require_once(__DIR__.'/chat.game.item.config.php'));

Load::Ajax()->register(['buyit','useit','sellit']);


echo Load::$core->fetch('game.item');
exit;

function buyit($_i)
{
	global $user;
	$db=Load::DB();
	$ajax=Load::Ajax();

	
	$_i=intval($_i);
	if(!is_array(Load::$my['inv']))
	{
		Load::$my['inv']=[];
	}
	if(Load::$my['logged'])
	{
		$item=Load::$core->item[$_i];
		$money=intval(Load::$my['bu']);
		if(!is_array($item))
		{
			$ajax->alert('ไม่มีไอเท็มที่คุณต้องการ');
		}
		elseif($item['p']<100)
		{
			$ajax->alert('ไอเท็มนี้ไม่สามารถซื้อได้');
		}
		elseif($item['p']>$money)
		{
			$ajax->alert('คุณมีบั๊กไม่เพียงพอ');
		}
		elseif(in_array($_i,Load::$my['inv']))
		{
			$ajax->alert('คุณมีไอเท็มชิ้นนี้อยู่แล้ว');
		}
		else
		{
			$user->bux(Load::$my['_id'],($item['p']*-1),'game-buy-item-'.$_i);
			$user->update(Load::$my['_id'],['$push'=>['inv'=>$_i]]);
			Load::$my['inv'][]=$_i;
			$ajax->jquery('#frmbuy','html',item_buy());
		}
	}
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}

function sellit($_i)
{
	global $user;
	$db=Load::DB();
	$ajax=Load::Ajax();
	
	$_i=intval($_i);
	if(!is_array(Load::$my['inv']))
	{
		Load::$my['inv']=[];
	}
	if(Load::$my['logged'])
	{
		$item=Load::$core->item[$_i];
		$money=intval(Load::$my['bu']);
		if(!is_array($item))
		{
			$ajax->alert('ไม่มีไอเท็มที่คุณต้องการ');
		}
		elseif(!in_array($_i,Load::$my['inv']))
		{
			$ajax->alert('คุณไม่มีไอเท็มชิ้นนี้');
		}
		else
		{
			$curitem=Load::$my['ci'];
			$user->bux(Load::$my['_id'],floor($item['p']/2),'game-sell-'.$_i);

			if($_i==Load::$my['ci'])
			{
				$user->update(Load::$my['_id'],['$set'=>['ci'=>0]]);
				Load::$my['ci']=0;
			}
			$cur=[];
			for($i=0;$i<count(Load::$my['inv']);$i++)
			{
				if(Load::$my['inv'][$i]!=$_i)
				{
					$cur[]=Load::$my['inv'][$i];
				}
			}
			Load::$my['inv']=$cur;
			$user->update(Load::$my['_id'],['$set'=>['inv'=>$cur]]);

			$ajax->jquery('#frmbuy','html',item_buy());
		}
	}
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}

function useit($_i,$use)
{
	global $user;
	$db=Load::DB();
	$ajax=Load::Ajax();
	
	$_i=intval($_i);
	if(!is_array(Load::$my['inv']))
	{
		Load::$my['inv']=[];
	}
	if(Load::$my['logged'])
	{
		$item=Load::$core->item[$_i];
		$money=intval(Load::$my['bu']);
		if(!is_array($item))
		{
			$ajax->alert('ไม่มีไอเท็มที่คุณต้องการ');
		}
		elseif(!in_array($_i,Load::$my['inv']))
		{
			$ajax->alert('คุณยังไม่มีไอเท็มชิ้นนี้');
		}
		else
		{
			$curitem=Load::$my['ci'];
			if($use)
			{
				$user->update(Load::$my['_id'],['$set'=>['ci'=>$_i]]);
				Load::$my['ci']=$_i;
			}
			else
			{
				$user->update(Load::$my['_id'],['$set'=>['ci'=>0]]);
				Load::$my['ci']=0;
			}
			$ajax->jquery('#frmbuy','html',item_buy());
		}
	}
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}

function item_buy()
{
	if(Load::$my['logged'])
	{
		if(!is_array(Load::$my['inv']))
		{
			Load::$my['inv']=[];
		}
		
		$tmp='<table width="100%" class="table tbservice tbitem"><tr><th align="center">ไอเท็ม</th><th align="center">ราคาซื้อ</th><th align="center">ราคาขาย</th><th align="center">หมดอายุ</th><th align="center" style="width:50px">บั๊ก</th><th align="center">ป้องกัน</th><th align="center">โจมตี</th><th align="center">ขโมย</th><th align="center"></th><th align="center"></th></tr>';
		$i=0;
		foreach(Load::$core->item as $k=>$v)
		{
			$tmp.='<tr><td class="i"><img src="https://chat.jarm.com/v/rank/'.$k.'.gif"></td>
			<td class="f">'.number_format($v['p']).'</td>
			<td class="f">'.number_format(floor($v['p']/2)).'</td>
			<td class="c">'.($v['e']?$v['e']:'- ถาวร -').'</td>
			<td class="f">'.($v['s']?''.$v['s'].'%':'-').'</td>
			<td class="f">'.($v['d']?''.$v['d'].'%':'-').'</td>
			<td class="f">'.($v['a']?''.$v['a'].'%':'-').'</td>
			<td class="f">'.($v['ax']?''.$v['ax'].'%':'-').'</td>
			';
			if(in_array($k,Load::$my['inv']))
			{
				if($k==Load::$my['ci'])
				{
					$tmp.='<td class="b"><a href="javascript:;" class="btn btn-xs btn-info" onclick="_.game.bet._useit(\''.$k.'\',0)">ถอด</a></td>';
				}
				else
				{
					$tmp.='<td class="b"><a href="javascript:;" class="btn btn-xs btn-default" onclick="_.game.bet._useit(\''.$k.'\',1)">ใส่</a></td>';
				}
				$tmp.='<td class="b"><a href="javascript:;" class="btn btn-xs btn-warning" onclick="_.game.bet._sellit(\''.$k.'\',\''.number_format(floor($v['p']/2)).'\')"><span class="glyphicon glyphicon-minus"></span> ขาย</a></td>';
			}
			else
			{
				$tmp.='<td class="b"></td>';
				if($v['p']<100)
				{
					$tmp.='<td class="b">ไม่มีขาย</td>';
				}
				else
				{
					$tmp.='<td class="b"><a href="javascript:;" class="btn btn-xs btn-default" onclick="_.game.bet._buyit(\''.$k.'\',\''.number_format($v['p']).'\')"><span class="glyphicon glyphicon-plus"></span> ซื้อ</a></td>';
				}
			}
			$tmp.='</tr>';
			$i++;
		}
		return $tmp.'</table><div style="padding:10px; margin:5px 0px 0px 0p;border:1px solid #f0f0f0f">บั๊ก คือ บั๊กที่จะได้รับเพิ่มจากการออนไลน์<br>ป้องกัน คือ ค่าป้องกันการขโมย ทำการโอกาสโดนขโมยไม่สำเร็จมากขึ้น<br> โจมตี คือ ค่าโจมตี ที่ทำให้โอกาสในการสำเร็จมากขึ้น<br> ขโมย คือ บั๊กที่จะได้รับเพิ่มเมื่อขโมยสำเร็จ</div>';
	}
}
?>
