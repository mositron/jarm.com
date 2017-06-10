<?php
//Load::Session()->logged();

define('MATCH3_RATE',700);
define('MATCH2_RATE',70);
define('MATCH1_RATE',7);



Load::Ajax()->register('doit');



$db=Load::DB();

if ($lot=$db->findone('game_lottery',['fn'=>['$exists'=>false]]))
{
  if(Load::Time()->sec($lot['ex'])<time())
  {
    $db->update('game_lottery',['_id'=>$lot['_id']],['$set'=>['fn'=>1]]);
    $id=$lot['_id'];
    $number=$lot['nb'];
    $time=Load::Time()->sec($lot['ex']);
    $point=_::point();
    ###############################  3 ตัว #############################
    if($found=$db->find('game_lottery_answer',['l'=>$lot['_id'],'n3'=>$lot['n3'],'w'=>['$exists'=>false]]))
    {
      foreach($found as $v)
      {
        $mon = $v['m']*MATCH3_RATE;
        $point->action($v['u'],$mon,'game','ถูกรางวัลเลข 3 ตัว งวดที่ '.$v['_id'].' ได้รับ '.$mon.' บ๊อก');
        $db->update('game_lottery_answer',['_id'=>$v['_id']],['$set'=>['lg'=>'ถูกรางวัลเลข 3 ตัว ได้รับ '.$mon.' บ๊อก','w'=>3]]);
      }
    }
    ###############################  2 ตัว #############################
    if($found=$db->find('game_lottery_answer',['l'=>$lot['_id'],'n2'=>$lot['n2'],'w'=>['$exists'=>false]]))
    {
      foreach($found as $v)
      {
        $mon = $v['m']*MATCH2_RATE;
        $point->action($v['u'],$mon,'game','ถูกรางวัลเลข 2 ตัว งวดที่ '.$v['_id'].' ได้รับ '.$mon.' บ๊อก');
        $db->update('game_lottery_answer',['_id'=>$v['_id']],['$set'=>['lg'=>'ถูกรางวัลเลขท้าย 2 ตัว ได้รับ '.$mon.' บ๊อก','w'=>2]]);
      }
    }
    ###############################  1 ตัว #############################
    if($found=$db->find('game_lottery_answer',['l'=>$lot['_id'],'n1'=>$lot['n1'],'w'=>['$exists'=>false]]))
    {
      foreach($found as $v)
      {
        $mon = $v['m']*MATCH1_RATE;
        $point->action($v['u'],$mon,'game','ถูกรางวัลเลขท้าย 1 ตัว งวดที่ '.$v['_id'].' ได้รับ '.$mon.' บ๊อก');
        $db->update('game_lottery_answer',['_id'=>$v['_id']],['$set'=>['lg'=>'ถูกรางวัลเลขท้าย 1 ตัว ได้รับ '.$mon.' บ๊อก','w'=>1]]);
      }
    }
    lottery_creat();
  }
}
else
{
  lottery_creat();
}

if($lastlot=$db->find('game_lottery',['fn'=>1],[],['sort'=>['_id'=>-1],'limit'=>1]))
{
  $lastlot=$lastlot[0];
  define('LOT_ID',$lastlot['_id']);
}

Load::$core->assign('lastlot',$lastlot);

echo Load::$core->fetch('game.lottery');
exit;


function doit($_n,$_m)
{
  $db=Load::DB();
  $ajax=Load::Ajax();
  $point=_::point();
  $_m=intval($_m);
  $_n=trim(strval($_n));
  $len=mb_strlen($_n,'utf-8');
  if(Load::$my)
  {
    $fmoney=intval(Load::$my['cd']['p']);
    if(!is_numeric($_m)||$_m<1)
    {
      $ajax->alert('กรุณากรอกจำนวนบ๊อกให้ถูกต้อง');
    }
    elseif($_m>$fmoney)
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
    elseif(!is_numeric($_n))
    {
      $ajax->alert('คุณกรอกตัวเลขในการเล่นไม่ถูกต้อง');
    }
    elseif(!in_array($len,[1,2,3]))
    {
      $ajax->alert('กรุณากรอกตัวเองที่ต้องการเล่น 1 - 3 ตัว');
    }
    else
    {
      if($lot=$db->findone('game_lottery',['fn'=>['$exists'=>false]]))
      {
        $point->action(Load::$my['_id'],($_m*-1),'game','ซื้อล็อตเตอรี่ งวดที่ '.$lot['_id'].' - เลข  '.$_n.' จำนวน '.$_m.' บ๊อก');
        $db->insert('game_lottery_answer',['u'=>Load::$my['_id'],'n'=>Load::$my['name'],'l'=>$lot['_id'],'m'=>$_m,'n'.$len=>$_n]);
        $ajax->jquery('#money','html',number_format($fmoney-$_m));
        $ajax->jquery('#frmbuy','html',lottery_buy());
      }
    }
  }
  else
  {
    $ajax->alert('กรุณาล็อคอิน');
  }
}


function lottery_buy()
{
  if(Load::$my)
  {
    $db=Load::DB();
    if($lot=$db->findone('game_lottery',['fn'=>['$exists'=>false]]))
    {
      $tmp = '<div style="text-align:center"><b>ซื้อ Lottery งวดที่ '.$lot['_id'].' - วันที่ '.Load::Time()->from($lot['ex'],'date').' - เวลา '.Load::Time()->from($lot['ex'],'time').'</b><br>
    <br>
    ประเภทรางวัล <select class="tbox" style="width:100px" id="ltype"><option value="3">เลข 3 ตัว</option><option value="2">เลขท้าย 2 ตัว</option><option value="1">เลขท้าย 1 ตัว</option></select>
  เลข <input id="lnumber" class="tbox" size="10" style="text-align:center; width:70px" maxlength="3">
  จำนวน <input id="lmoney" class="tbox" size="10" style="text-align:center; width:70px"> บ๊อก
  &nbsp; &nbsp; <input type="button" value=" ซื้อ " class="button" onClick="_.game.bet.buylot()"></div><br>';
      $tmp.='<div style="text-align:center"><b>ล็อตเตอรี่ที่เคยชื่อ ประจำงวดนี้</b><br><table width="100%" class="table tbservice"><tr><th>เลข</th><th>จำนวนเงิน</th><th>เวลา</th></tr>';
      $i=0;
      if($lots=$db->find('game_lottery_answer',['l'=>$lot['_id'],'u'=>Load::$my['_id']],[],['sort'=>['_id'=>-1]]))
      {
        foreach($lots as $rs)
        {
          $tmp.="<tr><td width='100'>".($rs['n3']!=''?$rs['n3']:($rs['n2']!=''?$rs['n2']:$rs['n1']))."</td><td width='100'>".$rs['m']."</td><td>".Load::Time()->from($rs['da'],'datetime')."</td></tr>";
          $i++;
        }
      }
      if(!$i)$tmp.="<tr><td colspan='3' height='50'>ยังไม่มีการซื้อ lottery</td></tr>";
      $tmp.="</table></div>";
      return $tmp;
    }
  }
  else
  {
    return '';
  }
}

function lottery_creat()
{
  $db=Load::DB();
  if(!$lot=$db->findone('game_lottery',['fn'=>['$exists'=>false]]))
  {
    $rand=mb_substr('000'.rand(0,999),-3,3,'utf-8');
    if(date('G')>=0&&date('G')<9)
    {
      $db->insert('game_lottery',array('n3'=>$rand,'n2'=>mb_substr($rand,1,2,'utf-8'),'n1'=>mb_substr($rand,2,1,'utf-8'),'ex'=>Load::Time()->from(date('Y').'-'.date('m').'-'.date('d').' 09:00:00')));
    }
    elseif(date('G')>8&&date('G')<21)
    {
      $db->insert('game_lottery',array('n3'=>$rand,'n2'=>mb_substr($rand,1,2,'utf-8'),'n1'=>mb_substr($rand,2,1,'utf-8'),'ex'=>Load::Time()->from(date('Y').'-'.date('m').'-'.date('d').' 21:00:00')));
    }
    else
    {
      $db->insert('game_lottery',array('n3'=>$rand,'n2'=>mb_substr($rand,1,2,'utf-8'),'n1'=>mb_substr($rand,2,1,'utf-8'),'ex'=>Load::Time()->from(date("Y-m-d", (time()+(3600*12))).' 09:00:00')));
    }
  }
}

function lottery_win($number)
{
  $tmp="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='1' class='fl_table'><tr><th>งวดที่</th><th>ผู้ซื้อ</th><th>เลขที่ซื้อ</th><th>จำนวนเงิน</th><th>เวลาซื้อ</th></tr>";
  if(defined('LOT_ID')&&$win=Load::DB()->find('game_lottery_answer',['l'=>LOT_ID,'w'=>$number]))
  {
    for($i=0;$i<count($win);$i++)
    {
      $tmp.="<tr><td>".$win[$i]['l']."</td><td>"._get_nick($win[$i]['n'])."</td><td>".($win[$i]['n3']!=''?$win[$i]['n3']:($win[$i]['n2']!=''?$win[$i]['n2']:$win[$i]['n1']))."</td><td>".$win[$i]['m']."</td><td>".Load::Time()->from($win[$i]['da'],'datetime')."</td></tr>";
    }
  }
  else
  {
    $tmp.="<tr><td colspan='5' height='50'>ยังไม่มีผู้ทายถูก</td></tr>";
  }
  $tmp.="</table>";
  return $tmp;
}



?>
