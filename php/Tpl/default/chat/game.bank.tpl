<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<link href="<?php echo FILES_CDN?>css/jarm.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="game_bank" class="gbox" style="width:550px;">
<div class="gbox_header">ธนาคาร</div>
<div class="gbox_content" style="text-align:center">
<?php if(self::$my):?>
<div id="mymoney" style="text-align:center; margin:10px 0px 5px">ขณะนี้คุณมี <span style="display:inline-block; padding:5px; background:#f5f5f5"><?php echo number_format(intval(self::$my['cd']['p']));?> บ๊อก</span>, <?php echo number_format(intval(self::$my['if']['ch']['sc']));?> บั๊ก</div><br>
<?php endif?>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#F7F7F7" style="border:3px double #EFEFEF" class="fl_table">
  <tr>
    <td align="center" style="background:#f5f5f5;">แลก <strong>บ๊อก =&gt; บั๊ก</strong> - อัตราในการแลกอยู่ที่ 1 บ๊อก = <?php echo BANK_RATE?> บั๊ก</td>
    </tr>
  <tr>
    <td align="center">
    <?php if(self::$my):?>
    แลก <input type="text" class="tbox" id="gmoney" style="text-align:center; width:100px" required> บ๊อก <input type="button"  class="button" value="ตกลง!" onClick="_.game.bet.sendc()">
    <?php else:?>
    <strong>กรุณาล็อคอินก่อนเล่นเกมนี้</strong>
    <?php endif?>
    </td>
    </tr>  <tr>
    <td align="center" style="background:#f5f5f5;">แลก <strong>บั๊ก =&gt; บ๊อก</strong> - อัตราในการแลกอยู่ที่ 1 บ๊อก = <?php echo BANK_RATE2?> บั๊ก</td>
    </tr>
  <tr>
    <td align="center">
    <?php if(self::$my):?>
    แลก <input type="text" class="tbox" id="gmoney2" style="text-align:center; width:100px" required> บั๊ก <input type="button"  class="button" value="ตกลง!" onClick="_.game.bet.sendc2()">
    <?php else:?>
    <strong>กรุณาล็อคอินก่อนเล่นเกมนี้</strong>
    <?php endif?>
    </td>
    </tr>
  <tr>
    <td><b style="color:#FF0000">เงื่อนไขการในแลก</b><br>
    - สามารถขอรับบ๊อกฟรีได้จาก กิจกรรมทุกวันศุกร์ใน<a href="<?php echo self::uri(['social','/'])?>" target="_blank">หน้าไลน์</a></td>
    </tr>
</table>
</div>
<div class="gbox_footer"><input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</div>
</body>
</html>

