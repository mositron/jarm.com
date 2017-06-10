<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<link href="<?php echo FILES_CDN?>css/jarm.css" rel="stylesheet" type="text/css">
<link href="<?php echo FILES_CDN?>css/image.css" rel="stylesheet" type="text/css">
</head>
<body>





<div id="report" class="gbox" style="width:350px;">

<form onSubmit="_.ajax.gourl('/','sendreport',this);_.box.close();return false;">
<div class="gbox_header">แจ้งลบรูปภาพ</div>
<div class="gbox_content" style="text-align:center">
<?php if($this->image):?>
<input type="hidden" name="image" value="<?php echo $this->image['_id']?>">
<div style="line-height:1.8em; padding:5px 10px 10px 20px; text-align:left">
<div style="padding:5px; border:1px solid #eee; background:#f9f9f9; margin:5px 0px;">
<h4 style="text-align:center">ข้อมูลผู้โพสรูปนี้</h4>
IP: <?php echo $this->image['ip']?> - เวลาโพส: <?php echo self::Time()->from($this->image['da'],'datetime')?>
</div>

<?php if(self::$my && ((self::$my['_id']==$this->image['u'])||(self::$my['am'] &&self::$my['am']>0))):?>
<div style="padding:10px;">คุณต้องการลบรูปภาพนี้หรือไม่</div>
<input type="hidden" name="reason" value="2">
<?php $btn='ลบรูปภาพ';?>
<?php else:?>
<?php $btn='รายงาน';?>
<h3>แจ้งลบรูปภาพนี้</h3>
</div>
<?php endif?>
<?php else:?>
<div style="padding:30px 50px; text-align:center">ไม่มีรูปภาพ หรืออาจจะโดนลบไปแล้ว</div>

<?php endif?>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" <?php echo $btn?> "> 
<input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>


</body>
</html>
