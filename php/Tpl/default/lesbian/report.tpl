<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<link href="<?php echo FILES_CDN?>css/jarm.css" rel="stylesheet" type="text/css">
<link href="<?php echo FILES_CDN?>css/friend.css" rel="stylesheet" type="text/css">
</head>
<body>





<div id="report" class="gbox" style="width:350px;">

<form onSubmit="_.ajax.gourl('/friend/','sendreport',this);_.box.close();return false;">
<div class="gbox_header">แจ้งการละเมิดหรือสแปม</div>
<div class="gbox_content" style="text-align:center">
<?php if($this->friend):?>
<input type="hidden" name="friend" value="<?php echo $this->friend['_id']?>">
<div style="line-height:1.8em; padding:5px 10px 10px 20px; text-align:left">
<div style="padding:5px; border:1px solid #eee; background:#f9f9f9; margin:5px 0px;">
<h4 style="text-align:center">ข้อมูลผู้โพสข้อความนี้</h4>
IP: <?php echo $this->friend['ip']?> - เวลาโพส: <?php echo self::Time()->from($this->friend['da'],'datetime')?>
</div>


<?php if(self::$my && ((self::$my['_id']==$this->friend['u'])||(self::$my['am'] &&self::$my['am']>0))):?>
<div style="padding:10px;">คุณต้องการลบข้อความนี้หรือไม่</div>
<input type="hidden" name="reason" value="2">
<?php $btn='ลบข้อความ';?>
<?php else:?>
<?php $btn='รายงาน';?>
<h3>ข้อความนี้เป็นของคุณหรือไม่</h3>
<p style="padding:5px; margin:5px 5px 0px; border:1px solid #f0f0f0; background-color:#f9f9f9"><label><input type="radio" name="reason" value="0"> ไม่ใช่ - ระบบจะแจ้งข้อมูลการลบไปให้ผู้ดูแลระบบ ซึ่งอาจจะใช้เวลาระยะนึง</label></p>
<p style="padding:5px; margin:5px 5px 0px; border:1px solid #f0f0f0; background-color:#f9f9f9"><label><input type="radio" name="reason" value="1"> ใช่ - ระบบจะส่งลิ้งค์สำหรับการลบข้อความนี้ไปยัง <?php echo $this->friend['em']?> ของท่าน</label></p>
</div>
<?php endif?>
<?php else:?>
<div style="padding:30px 50px; text-align:center">ไม่มีข้อความ หรือข้อความนี้อาจจะโดนลบไปแล้ว</div>

<?php endif?>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" <?php echo $btn?> "> 
<?php if(self::$my['am']&&$this->friend['fd']&&$this->friend['pt']):?> <input type="button" class="button" value=" ตั้งเป็นเพื่อนแนะนำ " onClick="_.ajax.gourl('/friend','setrec',<?php echo $this->friend['_id']?>);_.box.close()"> <?php endif?>
<input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>


</body>
</html>
