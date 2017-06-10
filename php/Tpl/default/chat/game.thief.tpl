<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<link href="<?php echo FILES_CDN?>css/jarm-all.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="game_thief" class="gbox" style="width:650px;">
<div class="gbox_header">ขโมย</div>
<div class="gbox_content" style="text-align:center">
<div style="height:500px; overflow:auto">

<?php if(self::$my['logged']):?>
<div id="mymoney" style="text-align:center; padding:5px; margin:10px 0px 0px">ขณะนี้คุณมี <span id="money" style="color:#390; font-weight:bold"><?php echo number_format(intval(self::$my['bu']));?></span> บั๊ก</div><br>
<div style="padding:10px; border:1px solid #f0f0f0;">
<strong>เงื่อนไขกติการการขโมย</strong>
<div style="padding:3px 3px 3px 50px; text-align:left">
- คนที่เป็นขโมย จะสามารถขโมยได้ 5นาที/1ครั้ง<br>
- คนที่ถูกขโมย จะสามารถโดนขโมยได้ 20นาที/1ครั้ง<br>
- ในการขโมยแต่ละครั้ง จะได้ประมาณ 5-15 บั๊กต่อครั้ง (ถ้าสำเร็จ)<br>
- หากขโมยไม่สำเร็จ จะต้องเสียค่าปรับ 1-5 บั๊กไม่แก่ผู้ถูกขโมย<br>
- ในการขโมยแต่ละครั้ง มีโอกาสขโมยสำเร็จ 60%</div><br><br>
<strong>วิธีการเล่น</strong>
<div style="padding:3px 3px 3px 50px; text-align:left">
1. คลิกที่ชื่อของผู้ที่ต้องการขโมย (ต้องเป็นสมาชิกที่ล็อคอินแล้วเท่านั้น)<br>
2. คลิกที่ปุ่ม "ขโมย"<br>
3. รอข้อความแสดงผลการขโมย</div>
<div style="padding:5px; text-align:center; border:1px solid #f0f0f0; margin:5px; color:#009900">* ถ้าคิดในทางที่แย่ที่สุด โดนขโมยสำเร็จทุกครั้ง และโดนขโมยถึงครั้งละ 15บั๊ก, ภายใน 1 ชม คุณจะได้ 60 บั๊ก(ยังไม่ คูณ <?php echo EXP_RATE?>) แต่จะเสียสูงสุดเพียง 45 บั๊ก, ดังนั้นการออนทิ้งไว้ก็ยังได้มากกว่าไม่ออนไลน์เลย</div>
</div>

<br />
<h3 align="center">ประวัติการขโมยล่าสุด</h3>
<div id="lastplay"><?php echo lastplay()?></div>

<?php else:?>
<div style="padding:10px; text-align:center; font-size:16px">กรุณาล็อคอินก่อนเล่นเกมนี้</div>
<?php endif?>
</div>
</div>
<div class="gbox_footer"><input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</div>
</body>
</html>
