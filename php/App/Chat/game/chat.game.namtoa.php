<?php

//Load::Session()->logged();

Load::Ajax()->register('doit');



Load::$core->assign('namtoa',new namtoa);
echo Load::$core->fetch('game.namtoa');
exit;

function doit($_t,$_m)
{
	global $user;
	$db=Load::DB();
	$ajax=Load::Ajax();
	if(Load::$my['logged'])
	{
		$namtoa=new namtoa;
		$_m=intval($_m);
		$fmoney=number_format(intval(Load::$my['cd']['p']));
		$point=_::point();
		if(!is_numeric($_m)||$_m<1)
		{
			$ajax->alert('กรุณากรอกจำนวนบ๊อกให้ถูกต้อง');
		}
		elseif($_m>intval(Load::$my['cd']['p']))
		{
			$ajax->alert('คุณมีบ๊อกไม่เพียงพอต่อการแทง');
		}
		elseif($_m<1)
		{
			$ajax->alert('คุณสามารถเล่นได้ครังละอย่างน้อย 1 บ๊อก');
		}
		elseif($_m>1000)
		{
			$ajax->alert('คุณสามารถเล่นได้ไม่เกินครังละ 1,000 บ๊อก');
		}
		elseif(!in_array($_t,['1','2','3','4','5','6']))
		{
			$ajax->alert('กรุณาเลือกตัวที่ต้องการแทง');
		}
		else
		{
			$ajax->jquery('#namtoa','html',$namtoa->show());
			$ajax->jquery('#selectnamtoa','html',$namtoa->select());

			$found=0;
			$num=[1,2,3,4,5,6];
			shuffle($num);
			$i1 = $num[0];
			shuffle($num);
			$i2 = $num[0];
			shuffle($num);
			$i3 = $num[0];
			//if($_m>=100)
			//{
				$ranf=rand(1,3);
				if($ranf==1&&$i1==$_t)
				{
					$i1 = rand(1,6);
				}
				elseif($ranf==2&&$i2==$_t)
				{
					$i2 = rand(1,6);
				}
				elseif($ranf==3&&$i3==$_t)
				{
					$i3 = rand(1,6);
				}
			//}
			if($i1==$_t) {
				$found+=1;
				$res1 = "<b style=\"color:#FFFFFF;background:#009900\"> ".$namtoa->input[$i1]." </b>";
			}else{
				$res1 = "<b>".$namtoa->input[$i1]."</b>";
			}
			if($i2==$_t) {
				$found+=1;
				$res2 = "<b style=\"color:#FFFFFF;background:#009900\"> ".$namtoa->input[$i2]."</b> ";
			}else{
				$res2 = "<b>".$namtoa->input[$i2]."</b>";
			}
			if($i3==$_t) {
				$found+=1;
				$res3 = "<b style=\"color:#FFFFFF;background:#009900\"> ".$namtoa->input[$i3]."</b> ";
			}else{
				$res3 = "<b>".$namtoa->input[$i3]."</b>";
			}
			$res="รางวัลที่ออกคือ:  ".$res1." , ".$res2." , ".$res3." <br> คุณทาย...".$namtoa->input[$_t]." ... ";
			if($found>0)
			{
				$mon = $_m*$found;
				$res.=" <b style=\"color:#FFFFFF;background:#009900\"> ทายถูก ".$found." ตัว </b> -  <b>คุณได้รับ ".($mon)." บ๊อก </b>";
				$point->action(Load::$my['_id'],$mon,'game','ทายน้ำเต้าถูก ได้รับ '.$mon.' บ๊อก');
				$tmoney=intval(Load::$my['cd']['p'])+$mon;
			}else{
				$mon = $_m;
				$res.=" <b style=\"color:#FFFFFF;background:#FF0000\"> ทายผิด </b> - <b>คุณเสีย ".$mon." บ๊อก</b>";
				$point->action(Load::$my['_id'],($mon * -1),'game','ทายน้ำเต้าผิด เสีย '.$mon.' บ๊อก');
				$tmoney=intval(Load::$my['cd']['p'])-$mon;
			}
			$db->insert('game_namtoa',array('u'=>Load::$my['_id'],'v'=>$namtoa->input[$_t],'r'=>$res1.','.$res2.','.$res3,'m'=>$_m,'fm'=>$fmoney,'tm'=>number_format($tmoney)));
			$ajax->jquery('#mymoney','html',"ขณะนี้คุณมี ".$tmoney." บ๊อก (รออัพเดทซักครู่..)");
			$ajax->jquery('#resnamtoa','html',$res);
			$ajax->jquery('#lastplay','html',$namtoa->lastplay());
		}
	}
	else
	{
		$ajax->alert('กรุณาล็อคอิน');
	}
}

class namtoa
{
	public $input = [1=>"ไก่", 2=>"น้ำเต้า", 3=>"กุ้ง", 4=>"กบ", 5=>"ปลา", 6=>"ปู"];
	public $tamnay=[];
	public $rand_keys;
	public function namtoa()
	{
		$this->tamnay[1]=[];
		$this->tamnay[1][0]="ไก่เป็นโรค ไม่แนะนำ";
		$this->tamnay[1][1]="ช่วงนี้ไก่มาแรง แทงโลดดด";
		$this->tamnay[1][2]="ไม่ออกตานี้ ก็ไม่รู้จะออก ตาไหนแล้ว";
		$this->tamnay[1][3]="เรารักน้องไก่";
		$this->tamnay[1][4]="ไก่เท่านั้น";
		$this->tamnay[1][5]="ไก่ ฟันธง!";

		$this->tamnay[2]=[];
		$this->tamnay[2][0]="น้ำเต้าเน่าๆ ไม่แนะนำ";
		$this->tamnay[2][1]="ช่วงนี้น้ำเต้ามาแรง แทงโลดดด";
		$this->tamnay[2][2]="ไม่ออกตานี้ ก็ไม่รู้จะออก ตาไหนแล้ว";
		$this->tamnay[2][3]="เราชอบกินน้ำเต้า";
		$this->tamnay[2][4]="น้ำเต้าเท่านั้น";
		$this->tamnay[2][5]="น้ำเต้า ฟันธง!";

		$this->tamnay[3]=[];
		$this->tamnay[3][0]="กุ้งราคาตก ไม่แนะนำ";
		$this->tamnay[3][1]="ช่วงนี้กุ้งมาแรง แทงโลดดด";
		$this->tamnay[3][2]="ไม่ออกตานี้ ก็ไม่รู้จะออก ตาไหนแล้ว";
		$this->tamnay[3][3]="เราชอบกินกุ้ง";
		$this->tamnay[3][4]="กุ้งเท่านั้น";
		$this->tamnay[3][5]="กุ้ง ฟันธง!";

		$this->tamnay[4]=[];
		$this->tamnay[4][0]="กบติดเชื้อ ไม่แนะนำ";
		$this->tamnay[4][1]="ช่วงนี้กบมาแรง แทงโลดดด";
		$this->tamnay[4][2]="ไม่ออกตานี้ ก็ไม่รู้จะออก ตาไหนแล้ว";
		$this->tamnay[4][3]="เราชอบกินกบทอด";
		$this->tamnay[4][4]="กบเท่านั้น";
		$this->tamnay[4][5]="กบ ฟันธง!";

		$this->tamnay[5]=[];
		$this->tamnay[5][0]="ปลาเน่าๆ ไม่แนะนำ";
		$this->tamnay[5][1]="ช่วงนี้ปลามาแรง แทงโลดดด";
		$this->tamnay[5][2]="ไม่ออกตานี้ ก็ไม่รู้จะออก ตาไหนแล้ว";
		$this->tamnay[5][3]="เราชอบกินปลาทอด";
		$this->tamnay[5][4]="ปลาเท่านั้น";
		$this->tamnay[5][5]="ปลา ฟันธง!";

		$this->tamnay[6]=[];
		$this->tamnay[6][0]="ปูเน่าๆ ไม่แนะนำ";
		$this->tamnay[6][1]="ช่วงนี้ปูมาแรง แทงโลดดด";
		$this->tamnay[6][2]="ไม่ออกตานี้ ก็ไม่รู้จะออก ตาไหนแล้ว";
		$this->tamnay[6][3]="เราชอบกินปูนิ่ม";
		$this->tamnay[6][4]="ปูเท่านั้น";
		$this->tamnay[6][5]="ปู ฟันธง!";
		$this->rand_keys = array_rand($this->input,6);
	}

	public function show()
	{
		if(Load::$my)
		{
			$db=Load::DB();
			$us=$db->find('user',['_id'=>['$ne'=>Load::$my['_id']]],['if'=>1],['sort'=>['ds'=>-1],'limit'=>20]);
			shuffle($us);
			$us=array_slice($us,0,6);
			$tmpdata="<table width='100%' border='0' cellpadding='5' cellspacing='1' bgcolor='#EFEFEF' class='fl_table'>";
			$i=0;
			foreach($us as $rs)
			{
				if($i%2==0) $tmpdata.="<tr>";
				$tmpdata.="<td bgcolor='#FFFFFF'><table width='100%' border='0' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC'><tr>
				<td width='120' height='120' align='center' valign='middle'><img src='".FILES_CDN."img/chat/namtoa/".$this->rand_keys[$i].".jpg'></td>
				<td valign='top' bgcolor='#FFFFFF'> <center><b>".$this->input[$this->rand_keys[$i]]."</b></center><b style='color:#999999'>ทำนายโดย</b>: ".$rs['if']['fn']."<br>  &nbsp; ".$this->tamnay[$this->rand_keys[$i]][rand(0,5)]."</td>
			  </tr></table></td>";
				if($i%2==1) $tmpdata.="</tr>";
				$i++;
			}
			return $tmpdata."</table>";
		}
		else
		{
			return '';
		}
	}

	public function lastplay()
	{
		if(Load::$my)
		{
			
			$db=Load::DB();
			$tmpdata="<table width='100%' border='0' cellpadding='5' cellspacing='1' bgcolor='#EFEFEF' class='fl_table'>";
			$tmpdata.="<tr>";
			$tmpdata.="<th>เวลา</th>";
			$tmpdata.="<th>ทาย</th>";
			$tmpdata.="<th>จำนวนบ๊อก</th>";
			$tmpdata.="<th>ผลลัพธ์</th>";
			$tmpdata.="<th>จำนวนบ๊อกก่อนทาย</th>";
			$tmpdata.="<th>จำนวนบ๊อกหลังทาย</th>";
			$tmpdata.="</tr>";
			$i=0;
			if($last=$db->find('game_namtoa',['u'=>Load::$my['_id']],[],['sort'=>['_id'=>-1],'limit'=>10]))
			{
				foreach($last as $rs)
				{
					$tmpdata.="<tr>";
					$tmpdata.="<td>".Load::Time()->from($rs['da'],'datetime')."</td>";
					$tmpdata.="<td>".$rs['v']."</td>";
					$tmpdata.="<td>".$rs['m']."</td>";
					$tmpdata.="<td>".$rs['r']."</td>";
					$tmpdata.="<td>".$rs['fm']."</td>";
					$tmpdata.="<td>".$rs['tm']."</td>";
					$tmpdata.="</tr>";
					$i++;
				}
			}
			if(!$i)$tmpdata.="<tr><td colspan='6'><br><br>ยังไม่มีประวัติการเล่น<br><br></td></tr>";
			return $tmpdata."</table>";
		}
		else
		{
			return '';
		}
	}

	public function select()
	{
		$data = '<select id="number" class="tbox" style="width:100px" required><option value="">กรุณาเลือก</option>';
		for($i=0;$i<6;$i++)
		{
			$data.='<option value="'.$this->rand_keys[$i].'">'.$this->input[$this->rand_keys[$i]].'</option>';
		}
		return $data.'</select>';
	}
}
?>
