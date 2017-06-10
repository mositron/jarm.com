<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<link href="<?php echo FILES_CDN?>css/jarm.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="game_item" class="gbox" style="width:750px;">
<div class="gbox_header">ร้านค้า</div>
<div class="gbox_content" style="text-align:center">
<div style="height:400px;overflow:auto">

<?php if(self::$my['logged']):?>
<div id="mymoney" style="text-align:center; padding:5px; margin:10px 0px 0px">ขณะนี้คุณมี <span id="money" style="color:#390; font-weight:bold"><?php echo number_format(intval(self::$my['bu']));?></span> บั๊ก</div><br>
<?php endif?>

<div style="border:1px solid #DDDDDD; padding:5px; text-align:left">
<?php if(self::$my['logged']):?>
<div id="frmbuy"><?php echo item_buy()?></div>
<?php else:?>
<div style="padding:10px; margin:5px 0px; background:#f0f0f0; text-align:center; font-size:16px">กรุณาล็อคอินก่อนเล่นเกมนี้</div>
<?php endif?>
</div>
</div>
</div>
<div class="gbox_footer"><input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</div>
</body>
</html>
