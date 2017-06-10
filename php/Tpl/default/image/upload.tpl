<style>
body{background:#fff;}
.form-horizontal .control-group{margin:0px; padding:10px;}
.form-actions{margin-top:0px;}
.rel{position:relative}
.ld{position:absolute; width:100%; height:170px; vertical-align:middle; text-align:center; font-size:24px; display:none; z-index:888; line-height:2em; background:#000; color:#fff;opacity:0.7; filter:alpha(opacity=70)}
</style>
<script>
function showloading()
{
	$('.ld').css('display','block');
}
</script>
<div style="padding:5px; margin:0px; background:#fff;">
<div style="padding:5px; border:1px solid #f0f0f0; text-align:center;"><a href="<?php echo self::uri(['image','/'])?>" target="_blank">image.jarm.com</a> - เว็บฝากรูปภาพฟรี ให้คุณฝากรูปฟรีสูงสุด <strong>10MB</strong> ต่อรูปฟรี!! ไม่มีวันหมดอายุ</div>
<?php if($this->error):?>
<div style="padding:5px; border:1px solid #f00; margin:5px 0px; color:#fff; background:#f00; font-size:14px; font-weight:bold"><?php echo $this->error?></div>
<?php else:?>
<div style="border:1px solid #f0f0f0;margin:5px 0px;" class="rel">
<div class="ld"><div style="padding:20px 10px;">กำลังอัพโหลดรูปภาพ<br>กรุณารอซักครู่...</div></div>
<div style="padding:20px 10px;">
<form action="/upload?redirect_uri=<?php echo urlencode($_GET['redirect_uri'])?>&format=<?php echo strval($_GET['format'])?>" method="post" enctype="multipart/form-data" class="form-horizontal" onSubmit="showloading();">
<fieldset>
 <div class="control-group">
<label class="control-label" for="input01">เลือกไฟล์รูปภาพ:</label>
<div class="controls">
<input type="file" name="upload[]" min="1" max="50" required multiple>
<p class="help-inline">*</p>
</div>
</div>
<input type="hidden" name="uphash" value="1">
<input type="hidden" name="redirect_uri" value="<?php echo $_GET['redirect_uri']?>">
<input type="hidden" name="format" value="<?php echo strval($_GET['format'])?>">
<input type="hidden" name="sesimage" value="<?php echo SESIMAGE?>">

<div class="form-actions">
<button type="submit" class="btn btn-primary">อัพโหลด</button> <button type="button" class="btn" onClick="window.close()">ยกเลิก</button>
</div>
</fieldset>
</form>
</div>
</div>
<?php endif?>

<div style="padding:5px; background:#FFFAF5; border:1px solid #F90; line-height:1.8em">
<h4>กฏกติกาในการฝากรูป</h4>
- อัพโหลดไฟล์รูปภาพได้สูงสุด <strong>10 MB</strong><br>
- ฝากรูปประเภท .jpg .jpeg .gif .png<br>
- ย่อรูปภาพโดยอัตโนมัติ ด้วยขนาด 200x200 และ 600x10240(กว้าง600) pixel<br>
- รูปภาพที่ย่ออัตโนมัติ จะเป็นภาพเคลื่อนไหว(เฉพาะ .gif)<br>
- สามารถย้อนกลับมาดูรูปที่เคยมาฝากไว้ได้<br>
- ห้ามโพสรูปโป๊ลามกอนาจารเด็ดขาด
</div>
<p class="clear"></p>
