<?php
//Load::Session()->logged();



Load::Ajax()->register(['doit','createslave','refreshslave']);



echo Load::$core->fetch('game.slave');
exit;

function refreshslave()
{
  Load::Ajax()->jquery('#slave','html',slavelist());
}
function createslave($_m,$_a)
{
  global $user;
  $db=Load::DB();
  $ajax=Load::Ajax();
  $point=_::point();
  if(Load::$my)
  {
    $_m=intval($_m);
    $money=intval(Load::$my['cd']['p']);
    $fmoney=number_format($money);
    if(!is_numeric($_m)||$_m<1)
    {
      $ajax->alert('กรุณากรอกจำนวนบ๊อกให้ถูกต้อง');
    }
    elseif($_m<1)
    {
      $ajax->alert('คุณสามารถเล่นได้ครังละอย่างน้อย 1 บ๊อก');
    }
    elseif($_m>1000)
    {
      $ajax->alert('คุณสามารถเล่นได้ไม่เกินครังละ 1,000 บ๊อก');
    }
    elseif(!is_numeric($_a)||$_a<1)
    {
      $ajax->alert('กรุณากรอกจำนวนวงไพ่ให้ถูกต้อง');
    }
    elseif(($_m*$_a)>$money)
    {
      $ajax->alert('คุณมีบ๊อกไม่เพียงพอต่อการตั้งวงไพ่');
    }
    else
    {
      for($i=1;$i<=$_a;$i++)
      {
        $card=randcard();
        if($_m<100)
        {
          $tax=1;
        }
        else
        {
          $tax=rand(1,5);
        }
        $db->insert('game_slave',array('u1'=>Load::$my['_id'],'n1'=>Load::$my['name'],'m'=>$_m,'tx'=>$tax,'np'=>3,'ds'=>Load::Time()->now(),'c1'=>$card[0],'c2'=>$card[1],'c3'=>$card[2]));
        $point->action(Load::$my['_id'],($_m * -1),'game','เล่นไพ่สลาฟ สร้างวงไพ่ เสีย '.$_m.' บ๊อก');
        $money-=$_m;
      }
      $ajax->jquery('#money','html',number_format($money));
      $ajax->jquery('#slave','html',slavelist());
      $ajax->jquery('#slavelast','html',slavelast());
    }
  }
  else
  {
    $ajax->alert('กรุณาล็อคอิน');
  }
}
function doit($id,$player)
{
  global $user;
  $db=Load::DB();
  $ajax=Load::Ajax();
  $point=_::point();
  if(Load::$my)
  {
    $money=intval(Load::$my['cd']['p']);
    if($rs=$db->findone('game_slave',array('_id'=>intval($id))))
    {
      if($money<$rs['m'])
      {
        $ajax->alert('คุณมีบ๊อกไม่เพียงพอต่อการเล่นวงนี้่');
      }
      elseif(Load::$my['_id']==$rs['u1']||Load::$my['_id']==$rs['u2']||Load::$my['_id']==$rs['u3'])
      {
        $ajax->alert('คุณไม่สามารถเล่นมากกว่า 1ขาได้ (ต่อวง)');
      }
      elseif(!$rs['u'.$player]&&in_array($player,[1,2,3,4,5])&&$player<=$rs['np'])
      {
        $db->update('game_slave',['_id'=>$rs['_id']],['$set'=>['u'.$player=>Load::$my['_id'],'n'.$player=>Load::$my['name']]]);
        $point->action(Load::$my['_id'],($rs['m'] * -1),'game','เล่นไพ่สลาฟ วงที่ '.$rs['_id'].' ลงค่าต๋ง '.$rs['m'].' บ๊อก');
        $ajax->jquery('#money','html',number_format($money-$rs['m']));
        if($final=$db->findone('game_slave',array('_id'=>intval($id),'u1'=>['$exists'=>true],'u2'=>['$exists'=>true],'u3'=>['$exists'=>true],'fn'=>['$exists'=>false])))
        {
          $found=false;
          if($final['c1']>$final['c2']&&$final['c2']>$final['c3'])
          {
            $win = 1;
            $normal = 2;
            $lost = 3;
          }
          elseif($final['c1']>$final['c3']&&$final['c3']>$final['c2'])
          {
            $win = 1;
            $normal = 3;
            $lost = 2;
          }
          elseif($final['c2']>$final['c3']&&$final['c3']>$final['c1'])
          {
            $win = 2;
            $normal = 3;
            $lost = 1;
          }
          elseif($final['c2']>$final['c1']&&$final['c1']>$final['c3'])
          {
            $win = 2;
            $normal = 1;
            $lost = 3;
          }
          elseif($final['c3']>$final['c1']&&$final['c1']>$final['c2'])
          {
            $win = 3;
            $normal = 1;
            $lost = 2;
          }
          elseif($final['c3']>$final['c2']&&$final['c2']>$final['c1'])
          {
            $win = 3;
            $normal = 2;
            $lost = 1;
          }
          else
          {
            $found=true;
          }
          if($found)
          {
            $ajax->alert('ระบบเกิดการผิดพลาด ระบบจะทำการคืนเงินให้ท่านเดี๋ยวนี้');
            for($i=1;$i<=$final['np'];$i++)
            {
              if($final['u'.$i])
              {
                $point->action($final['u'.$i],$final['m'],'game','ระบบเกิดการผิดพลาด ระบบทำการคืนบ๊อกให้  '.$final['m'].' บ๊อก');
              }
            }
            $ajax->jquery('#money','html',number_format($money));
            $db->update('game_slave',['_id'=>$final['_id']],array('$set'=>array('lg'=>'ระบบผิดพลาด ระบบจะทำการคืนเงินให้อัตโนมัติ','ds'=>Load::Time()->now(),'fn'=>1)));
          }
          else
          {
            if($final['m']>=100&&($final['tx']&&$final['tx']<=10))
            {
              $tax=ceil(($final['m']*$final['tx'])/100);
            }
            else
            {
              $tax=1;
            }
            $mon = ($final['m']*2)-$tax;

            $point->action($final['u'.$win],$mon,'game','ชนะอันดับ 1 ในไพ่สลาฟวงที่ '.$final['_id'].' ได้รับ '.$mon.' บ๊อก');
            $point->action($final['u'.$normal],$final['m'],'game','ชนะอันดับ 2 ในไพ่สลาฟวงที่ '.$final['_id'].' ได้รับ '.$final['m'].' บ๊อก');


            $final['n1']=_get_nick($final['n1']);
            $final['n2']=_get_nick($final['n2']);
            $final['n3']=_get_nick($final['n3']);
            $msg='เจ้ามือ - '.$final['n1'].' - '.cardnumber($final['c1']).' '.cardtype($final['c1']).' <br> ขาที่ 2  - '.$final['n2'].' - '.cardnumber($final['c2']).' '.cardtype($final['c2']).' <br> ขาที่ 3  - '.$final['n3'].' - '.cardnumber($final['c3']).' '.cardtype($final['c3']);
            $logs='ผู้ชนะคือ '.$final['n'.$win].' ได้รับเงินคืน '.$mon.'<br>ผู้ชนะอันดับ2คือ '.$final['n'.$normal].' ได้รับเงินคืน '.$final['m'].'<br>ผู้แพ้คือ '.$final['n'.$lost] .' - ภาษี '.$tax.' บ๊อก';

            if(Load::$my['_id']==$win)
            {
              $ajax->jquery('#money','html',number_format($money+$final['m']-$tax));
            }
            elseif(Load::$my['_id']==$normal)
            {
              $ajax->jquery('#money','html',number_format($money));
            }
            $ajax->alert('<strong>ผลการเล่น</strong>: '.$msg.'<br><br>'.$logs);
            $db->update('game_slave',['_id'=>$final['_id']],array('$set'=>array('lg'=>$logs,'ds'=>Load::Time()->now(),'fn'=>1)));
          }
         } //else $ajax->js("alert('ไพ่ของคุณคือ ".cardnumber($final['card'.$_POST['user']])." ".cardtype($final['card'.$_POST['user']])." ')");
      }
      else
      {
        $ajax->alert('คุณแทงช้าไป มีคนตัดหน้าเล่นขานี้ไปแล้ว');
      }
    }
    else
    {
      $ajax->alert('คุณแทงช้าไป มีคนตัดหน้าเล่นขานี้ไปแล้ว');
    }
    $ajax->jquery('#slave','html',slavelist());
    $ajax->jquery('#slavelast','html',slavelast());
  }
  else
  {
    $ajax->alert('กรุณาล็อคอิน');
  }
}

function randcard()
{
  $cards = [];
  $super=in_array(Load::$my['_id'],[1]);
  //srand((float) microtime() * 10000000);
  $cur=rand(-9999,10);
  while(count($cards)<4)
  {
    $F=FALSE;
    if(count($cards)==0)
    {
      $cset=[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
    }
    else
    {
      $cset=[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51];
    }
    shuffle($cset);
    shuffle($cset);
    shuffle($cset);
    $cur=$cset[0];
    for($i=0;$i<count($cards);$i++)
    {
      if(!$F&&$cards[$i]==$cur)
      {
        $F=TRUE;
        break;
      }
    }
    if(!$F) $cards[]=$cur;
  }
  return $cards;
}

function cardimg($i)
{
  $a=[3,4,5,6,7,8,9,10,11,12,13,1,2];
  $b=['k','b','c','p'];
  return $a[intval($i / 4)].$b[intval($i % 4)];
}

function cardtype($i){
  $type=["ดอกจิก","หลามตัด","โพธิ์แดง","โพธิ์ดำ"];
  return $type[(int)($i % 4)];
}
function cardnumber($i){
  return cardname((int)($i / 4));
}
function cardscore($i){
  return $i;
}
function cardname($i){
  $a=["สาม","สี","ห้า","หก","เจ็ด","แปด","เก้า","สิบ","แจ๊ค","แหม่ม", "คิง","เอด","สอง"];
  return $a[$i];
}
function slavelist()
{
  $db=Load::DB();
  $tmp='<table width="100%" class="table tbservice"><tr><th align="center">วงที่</th><th align="center">เจ้ามือ</th><th align="center">ขาที่ 2</th><th align="center">ขาที่ 3</th><th align="center">ค่าต๋ง</th><th align="center">ภาษี</th><th align="center">ตั้งวงเมื่อ</th></tr>';
  $i=0;
  if($list=$db->find('game_slave',['fn'=>['$exists'=>false]],[],['sort'=>['_id'=>1]],false))
  {
    $super=in_array(Load::$my['_id'],[1,33127]);
    foreach($list as $rs)
    {
      $tmp.='<tr><td class="i">'.$rs['_id'].'</td>
      <td class="c"><div>'.($super?'<p>'.$rs['c1'].'</p>':'')._get_nick($rs['n1']).(Load::$my['_id']==$rs['u1']?'<br><img src="'.FILES_CDN.'img/chat/card/'.cardimg($rs['c1']).'.gif">':'<br><img src="'.FILES_CDN.'img/chat/card/card.gif">').'</div></td>
      <td class="c"><div>'.($super?'<p>'.$rs['c2'].'</p>':'').($rs['u2']?_get_nick($rs['n2']).(Load::$my['_id']==$rs['u2']?'<br><img src="'.FILES_CDN.'img/chat/card/'.cardimg($rs['c2']).'.gif">':'<br><img src="'.FILES_CDN.'img/chat/card/card.gif">'):'ยังไม่มี<br>[<a href="javascript:;" onclick="_.game.bet.sendp(\''.$rs['_id'].'\',\'2\'); return false;">แทงขานี้</a>]').'</div></td>
      <td class="c"><div>'.($super?'<p>'.$rs['c3'].'</p>':'').($rs['u3']?_get_nick($rs['n3']).(Load::$my['_id']==$rs['u3']?'<br><img src="'.FILES_CDN.'img/chat/card/'.cardimg($rs['c3']).'.gif">':'<br><img src="'.FILES_CDN.'img/chat/card/card.gif">'):'ยังไม่มี<br>[<a href="javascript:;" onclick="_.game.bet.sendp(\''.$rs['_id'].'\',\'3\'); return false;">แทงขานี้</a>]').'</div></td>
      <td>'.$rs['m'].'</td>
      <td class="i">'.($rs['m']>=100&&$rs['tx']?$rs['tx'].'%':'1').'</td>
      <td>'.Load::Time()->from($rs['da'],'datetime').'</td>
      </tr>';
      $i++;
     }
  }
  define('CUR_SLAVE',$i);
  if(!$i)
  {
    $tmp.="<tr><td height='100' colspan='7' align='center' valign='middle'>ยังไม่มีวงไพ่</td></tr>";
   }
   return $tmp.'</table>'.(defined('CUR_SLAVE')?'<div style="padding:5px; text-align:right; background:#f7f7f7">'.CUR_SLAVE.' วงไพ่</div>':'');
 }
function slavelast()
{
  if(Load::$my)
  {
    $db=Load::DB();
    $tmp='<table width="100%" class="table tbservice"><tr><th align="center">วงที่</th><th align="center">เจ้ามือ</th><th align="center">ขาที่ 2</th><th align="center">ขาที่ 3</th><th align="center">ค่าต๋ง</th><th align="center">ตั้งวงเมื่อ</th><th align="center">รายละเอียด</th></tr>';
    $i=0;
    if($list=$db->find('game_slave',['fn'=>1,'$or'=>[['u1'=>Load::$my['_id']],['u2'=>Load::$my['_id']],['u3'=>Load::$my['_id']]]],[],['sort'=>['ds'=>-1],'limit'=>10],false))
    {
      foreach($list as $rs)
      {
        $tmp.='<tr><td class="i">'.$rs['_id'].'</td>
        <td class="c"><img src="'.FILES_CDN.'img/chat/card/'.cardimg($rs['c1']).'.gif"><br>'._get_nick($rs['n1']).'</td>
        <td class="c"><img src="'.FILES_CDN.'img/chat/card/'.cardimg($rs['c2']).'.gif"><br>'._get_nick($rs['n2']).'</td>
        <td class="c"><img src="'.FILES_CDN.'img/chat/card/'.cardimg($rs['c3']).'.gif"><br>'._get_nick($rs['n3']).'</td>
        <td>'.$rs['m'].'</td>
        <td>'.Load::Time()->from($rs['ds'],'datetime').'</td>
        <td>'.$rs['lg'].'</td>
        </tr>';
        $i++;
       }
    }
    if(!$i)
    {
      $tmp.="<tr><td height='100' colspan='7' align='center' valign='middle'>ยังไม่มีประวัติการเล่น</td></tr>";
     }
     return $tmp."</table>";
  }
  else
  {
    return '';
  }
 }
?>
