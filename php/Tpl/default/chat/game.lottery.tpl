<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<link href="<?php echo FILES_CDN?>css/jarm.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="game_lottery" class="gbox" style="width:850px;">
<div class="gbox_header">ลอตเตอรี่</div>
<div class="gbox_content" style="text-align:center">
<div style="height:500px; overflow:auto">


<?php if($this->lastlot):?>
<h4 style="padding:10px 5px 5px; text-align:center; line-height:1.6em">ประกาศผลล็อตเตอรี่ งวดที่ <?php echo $this->lastlot['_id']?> เวลา <?php echo self::Time()->from($this->lastlot['ex'],'time')?> ประจำวันที่ <?php echo self::Time()->from($this->lastlot['ex'],'date')?></h4>
<div style="font-size:36px; color:#FFFFFF; font-weight:bold; font:tahoma; background:#FF0000; padding:1px; border:3px double; margin:5px 10px; padding:5px; letter-spacing: 5px; line-height:1.6em"><b><?php echo $this->lastlot['n3']?></b></div>
<?php endif?>

<?php if(self::$my):?>
<div id="mymoney" style="text-align:center; padding:5px; margin:10px 0px 0px">ขณะนี้คุณมี <span id="money" style="color:#390; font-weight:bold"><?php echo number_format(intval(self::$my['cd']['p']));?></span> บ๊อก</div><br>
<?php endif?>

<div style="border:1px solid #DDDDDD; padding:5px; text-align:left">
<?php if(self::$my):?>
<div id="frmbuy"><?php echo lottery_buy()?></div>
<div id="newgroup">

</div>
<?php else:?>
<div style="padding:10px; margin:5px 0px; background:#f0f0f0; text-align:center; font-size:16px">กรุณาล็อคอินก่อนเล่นเกมนี้</div>
<?php endif?>

</div>
<br>
<div style="padding:5px 0px; text-align:center">
<b>ประวัติผู้โชคดี ถูกเลข 3 ตัวล่าสุด</b><br>
<?php echo lottery_win(3)?>
</div><br>
<div style="padding:5px 0px; text-align:center">
<b>ประวัติผู้โชคดี ถูกเลขท้าย 2 ตัวล่าสุด</b><br>
<?php echo lottery_win(2)?>
</div><br>
<div style="padding:5px 0px; text-align:center">
<b>ประวัติผู้โชคดี ถูกเลขท้าย 1 ตัวล่าสุด</b><br>
<?php echo lottery_win(1)?>
</div>

</div>
</div>
<div class="gbox_footer"><input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</div>
</body>
</html>
