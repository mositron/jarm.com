<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<link href="<?php echo FILES_CDN?>css/jarm.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="game_slave" class="gbox" style="width:900px;">
<div class="gbox_header">สลาฟ <small style="font-weight:normal">(<a href="javascript:;" onclick="_.ajax.gourl('<?php echo URL?>','refreshslave')">รีเฟรส</a>)</small></div>
<div class="gbox_content" style="text-align:center">
<div style="height:500px; overflow:auto">
<?php if(self::$my):?>
<div id="mymoney" style="text-align:center; padding:5px; margin:10px 0px 0px">ขณะนี้คุณมี <span id="money" style="color:#390; font-weight:bold"><?php echo number_format(intval(self::$my['cd']['p']));?></span> บ๊อก</div><br>
 <div id="slave"><?php echo slavelist()?></div>
<br>
<div align="center">
<table width="800" border="0" cellpadding="0" cellspacing="1" bgcolor="#F0F0F0" style="border:3px double #CCCCCC" class="fl_table">
  <tr>
    <td align="center"><b>ตั้งวงไพ่ใหม่</b></td>
    </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">
    <?php if(defined('CUR_SLAVE')&&CUR_SLAVE>=200):?>
    <div style="padding:10px; text-align:center; background:#f8f8f8; font-size:16px">จำนวนวงไพ่มีมากเกินไป กรุณาเล่นวงที่มีอยู่แล้ว</div>
    <?php else:?>
    <br>ตั้งวงไพ่สลาฟแต่ละขา(ต๋ง) วงละ
      <input type="text" class="tbox" style="width:50px; text-align:center" id="gmoney" required> บ๊อก , ตั้งวงไพ่ทั้งหมด <select id="amount" class="tbox" style="width:70px"><option value="1" selected="selected">1</option><option value="3">3</option><option value="5">5</option><option value="10">10</option><option value="20">20</option></select>  วง <input type="button" value="ตั้งวง" class="button" onClick="_.game.bet.sends()"><br>
      <?php endif?>
      <br />
<h3>วิธีการเล่น</h3>
<div align="left">
- สามารถแทงได้ครั้งอย่างน้อย 1 บ๊อก แต่ไม่เกิน 1,000 บ๊อก<br />
- แต่ละวง จะมีผู้เล่น 3คน, โดยมือที่ 1 คือผู้ตั้งวงไพ่นั้น<br />
- สำหรับผู้เล่นทั่วไป (มือที่2,3) สามารถเล่นได้โดยการคลิก [แทงขานี้] ในแต่ละวง<br />
- ไพ่ที่มีค่าใหญ่สุดคือ 2, 1, King, Queen, Jack, 10, 9, 8, 7, 6, 5, 4, 3 (เรียกจากใหญ๋ไปหาเล็ก)<br />
- ผู้ชนะอันดับ1 ได้รับบ๊อกคืน + ค่าต๋งของผู้แพ้ - ภาษี (คือค่าที่ในการเล่นขึ้นอยู่กับค่าต๋ง, ค่าต๋ง 1-99 = 1บ๊อก, 100-1000 = สุ่ม1-5%)<br>
- ผู้ชนะอันดับ2 จะได้บ๊อกคืนตามจำนวนที่แทงไว้<br />
- ผู้แพ้ จะเสียบ๊อกตามที่แทงไว้
</div>
</td>
    </tr>
</table>
</div>
<br />

<h3 align="center">ประวัติการเล่นล่าสุด</h3>
<div id="slavelast"><?php echo slavelast()?></div>

<?php else:?>
<div style="padding:10px; text-align:center; font-size:16px">กรุณาล็อคอินก่อนเล่นเกมนี้</div>
<?php endif?>

</div>
</div>
<div class="gbox_footer"><input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</div>
</body>
</html>

