<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<link href="<?php echo FILES_CDN?>css/jarm.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="game_namtoa" class="gbox" style="width:650px;">
<div class="gbox_header">น้ำเต้า</div>
<div class="gbox_content" style="text-align:center">
<div style="height:500px; overflow:auto">
<div id="namtoa"><?php echo $this->namtoa->show()?></div><br>
<div id="resnamtoa"></div>

<?php if(self::$my):?>
<div id="mymoney" style="text-align:center; padding:5px; margin:10px 0px 0px">ขณะนี้คุณมี <span id="money" style="color:#390; font-weight:bold"><?php echo number_format(intval(self::$my['cd']['p']));?></span> บ๊อก</div><br>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#F7F7F7" style="border:3px double #EFEFEF" class="fl_table">
  <tr>
    <td align="center">เร่เข้ามา. เอ้า... เร่เข้ามาค่าาาาาา </td>
    </tr>
  <tr>
    <td align="center">แทง <span id="selectnamtoa"><?php echo $this->namtoa->select()?></span> จำนวน <input type="text" class="tbox" id="gmoney" style="text-align:center; width:100px" required> บั๊ก <input type="button"  class="button" value="แทง!" onClick="_.game.bet.sendg()"></td>
    </tr>
  <tr>
    <td><b style="color:#FF0000">เงื่อนไขการในเล่น</b><br>
      &nbsp; ในการแทงแต่ละครั้ง ผู้เล่นสามารถเลือกได้เพียง 1 ตัวเท่านั้น<br>
      &nbsp; สามารถแทงได้ครั้งอย่างน้อย 1 บ๊อก แต่ไม่เกิน 1,000 บ๊อก<br>
      &nbsp; ผลที่ออก จะออก 3ตัว  หากมีผู้ทายถูก<br>
&nbsp; &nbsp; - ถูก 1 ตัว ได้รับเงิน 1เท่าของบ๊อกที่ทาย<br>
&nbsp; &nbsp; - ถูก 2 ตัว ได้รับเงิน 2เท่าของบ๊อกที่ทาย<br>
&nbsp; &nbsp; - ถูก 3 ตัว ได้รับเงิน 3เท่าของบ๊อกที่ทาย <br>
&nbsp; &nbsp; - ผิด จะเสียบ๊อกตามจำนวนที่ทาย</td>
    </tr>
</table>
<br />
<h3 align="center">ประวัติการเล่นล่าสุด</h3>
<div id="lastplay"><?php echo $this->namtoa->lastplay()?></div>

<?php else:?>
<div style="padding:10px; text-align:center; font-size:16px">กรุณาล็อคอินก่อนเล่นเกมนี้</div>
<?php endif?>
</div>
</div>
<div class="gbox_footer"><input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</div>
</body>
</html>

