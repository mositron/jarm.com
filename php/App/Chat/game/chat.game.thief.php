<?php

//Load::Session()->logged();



Load::Ajax()->register('doit');



echo Load::$core->fetch('game.thief');
exit;

function doit($_r,$_u)
{
	global $user;
	$db=Load::DB();
	$ajax=Load::Ajax();
	if(Load::$my['logged'])
	{
		$cache=Load::Mcache();
		if(!$u=$user->get($_u))
		{
			$ajax->alert('ไม่มีบุคคลดังกล่าว');
		}
		elseif(Load::$my['_id']!='10206486363972963' && $u['u']!='10206486363972963' && $last=$db->findone('chatroom_thief',array('u'=>Load::$my['_id'],'da'=>array('$gte'=>Load::Time()->now(-500)))))
		{
			$ajax->alert('คุณพึ่งขโมยเมื่อไม่นานมานี้ กรุณารอซํกครู่เพื่อเริ่มขโมยใหม่อีกครั้ง');
		}
		elseif(Load::$my['_id']!='10206486363972963' && $u['u']!='10206486363972963' && $last=$db->findone('chatroom_thief',array('p'=>$u['u'],'da'=>array('$gte'=>Load::Time()->now(-1200)))))
		{
			$ajax->alert(_get_nick($u['n']).' พึ่งถูกขโมยเงินไปเมื่อเร็วๆนี้ คุณไม่สามารถขโมยเงินเขาได้ในขณะนี้');
		}
		elseif($db->findone('chatroom',array('_id'=>intval($_r))))
		{
			$defname='';
			$atkname='';
			$rand=rand(1,100);
			$defend=60;
			$atkexp=1;

			$item=require_once(__DIR__.'/chat.game.item.config.php');
			if($u['ci'])
			{
				if($item[$u['ci']])
				{
					if($item[$u['ci']]['d'])
					{
						$defend-=$item[$u['ci']]['d'];
						$defname=' (<img src="https://chat.jarm.com/v/rank/'.$u['ci'].'.gif">  ช่วยลดโอกาสสำเร็จ '.number_format($item[$u['ci']]['d']).'%) ';
					}
				}
			}
			if(Load::$my['ci'])
			{
				if($item[Load::$my['ci']])
				{
					if($item[Load::$my['ci']]['a'])
					{
						$defend+=$item[Load::$my['ci']]['a'];
						$atkexp += ($item[Load::$my['ci']]['ax']/100);
						$atkname.=' (<img src="http://staic.chat.jarm.com/rank/'.Load::$my['ci'].'.gif">  ช่วยเพิ่มโอกาสสำเร็จ '.number_format($item[Load::$my['ci']]['a']).'%,  ช่วยเพิ่มคะแนน '.number_format($item[Load::$my['ci']]['ax']).'%) ';
					}
				}
			}
			if($u['u']=='10206486363972963')
			{
				$defend=-1;
				$atkexp=rand(10,100);
			}

			if($rand<=$defend)
			{
				$money=abs(ceil(rand(5,15)*$atkexp));
				$money=min($money,100);

				$pass=true;
				$user->bux($u['u'],$money*-1,'game-thief-1');
				$user->bux(Load::$my['_id'],$money,'game-thief-2');

				$ajax->alert('<b style="color:#FFFFFF;background:#009900"> สำเร็จ </b> ได้รับ '.number_format($money).' บั๊ก');
			}
			else
			{
				$money=abs(ceil(rand(1,5)*$atkexp));
				$money=min($money,100);

				$pass=false;
				$user->bux($u['u'],$money,'game-thief-1');
				$user->bux(Load::$my['_id'],$money*-1,'game-thief-2');

				$ajax->alert('<b style="color:#FFFFFF;background:#FF0000"> ไม่สำเร็จ </b> เสียค่าปรับ '.number_format($money).' บั๊ก');
			}
			$db->insert('chatroom_thief',array('u'=>Load::$my['_id'],'p'=>$u['u'],'s'=>($pass?1:0),'sp'=>$rand,'m'=>$money,'un'=>Load::$my['name'],'pn'=>$u['n']));
		}
		else
		{
			$ajax->alert('ไม่มีห้องดังกล่าว');
		}
	}
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}

function lastplay()
{
	if(Load::$my['logged'])
	{
		
		$db=Load::DB();
		$tmpdata="<table width='100%' border='0' cellpadding='5' cellspacing='1' bgcolor='#EFEFEF' class='fl_table'>";
		$tmpdata.="<tr>";
		$tmpdata.="<th>เวลา</th>";
		$tmpdata.="<th>ผู้ขโมย</th>";
		$tmpdata.="<th>ถูกขโมย</th>";
		$tmpdata.="<th>ผลลัพธ์</th>";
		$tmpdata.="<th>บั๊ก</th>";
		$tmpdata.="</tr>";
		$i=0;
		if($last=$db->find('chatroom_thief',['$or'=>[['u'=>Load::$my['_id']],['p'=>Load::$my['_id']]]],[],['sort'=>['_id'=>-1],'limit'=>20]))
		{
			foreach($last as $rs)
			{
				$tmpdata.='<tr>';
				$tmpdata.='<td>'.Load::Time()->from($rs['da'],'datetime').'</td>';
				$tmpdata.='<td><a href="/user/'.$rs['u'].'" target="_blank">'._get_nick($rs['un']).'</a></td>';
				$tmpdata.='<td><a href="/user/'.$rs['p'].'" target="_blank">'._get_nick($rs['pn']).'</a></td>';
				$tmpdata.='<td>'.($rs['s']?'<b style="color:#FFFFFF;background:#009900"> สำเร็จ </b>':'<b style="color:#FFFFFF;background:#FF0000"> ไม่สำเร็จ </b>').'</td>';
				$tmpdata.='<td>'.$rs['m'].'</td>';
				$tmpdata.='</tr>';
				$i++;
			}
		}
		if(!$i)$tmpdata.="<tr><td colspan='5'><br><br>ยังไม่มีประวัติการเล่น<br><br></td></tr>";
		return $tmpdata."</table>";
	}
	else
	{
		return '';
	}
}
?>
