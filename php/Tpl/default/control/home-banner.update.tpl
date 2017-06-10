<style>
.form-horizontal .control-group {
margin-bottom:8px;
padding-bottom: 10px;
border-bottom: 1px dashed #F0F0F0;
}
</style>

<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
   <li><a href="/home-banner"><span class="glyphicon glyphicon-eye-close"></span> แบนเนอร์หน้าแรก</a></li>

<?php if($this->access):?>
    <li class="pull-right"><a href="/home-banner"><span class="glyphicon glyphicon-eye-close"></span> กลับไปหน้ารวม</a></li>
<?php else:?>
 <li class="pull-right"><span class="glyphicon glyphicon-question-sign"></span> ไม่มีสิทธิ์แก้ไขข้อมูลภายในส่วนนี้</li>
<?php endif?>
</ul>

<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขแบนเนอร์</h2>

<?php if($this->error):?>
<div class="alert alert-error">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">ผิดพลาด!</h4>
 <?php echo implode('<br>',$this->error);?>
</div>
<?php endif?>

<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/home-banner">แบนเนอร์หน้าแรก </a>)
</div>
<?php endif?>
<?php if($this->banner['pl']):?>
<div class="alert alert-info">  <h4 class="alert-heading">เผยแพร่แล้ว!</h4> แบนเนอร์นี้ทำการเผยแพร่แล้ว</div>
<?php endif?>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">ชื่อแบนเนอร์:</label>
<div class="controls">
<input type="text" id="input01" class="form-control" name="title" value="<?php echo htmlspecialchars($this->banner['t'],ENT_QUOTES,'utf-8')?>" required>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>

 <div class="control-group">
<label class="control-label" for="input01">ตำแหน่ง:</label>
<div class="controls">
<?php echo $this->position[$this->banner['p']]?>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input10">รูปภาพ / Flash:</label>
<div class="controls">
<?php if($this->banner['s']):?>
<?php if($this->banner['ex']=='swf'):?>
<object width="<?php echo $this->banner['w']?>" height="<?php echo $this->banner['h']?>"><param name="movie" value="https://s2.jarm.com/banner/<?php echo $this->banner['fd']?>/<?php echo $this->banner['s']?>"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="transparent"><embed src="https://s2.jarm.com/banner/<?php echo $this->banner['fd']?>/<?php echo $this->banner['s']?>" type="application/x-shockwave-flash" width="<?php echo $this->banner['w']?>" height="<?php echo $this->banner['h']?>" allowscriptaccess="always" allowfullscreen="true" wmode="transparent"></embed></object>
<?php else:?>
<img src="<?php echo self::uri(['f2','/banner/'.$this->banner['fd'].'/'.$this->banner['s'].'?'.rand(1,999)])?>"><br>
<?php endif?>
<div style="padding:5px; border:1px solid #ddd; background:#f5f5f5;">ประเภทไฟล์: <?php echo $this->banner['ex']?>, กว้าง: <?php echo $this->banner['w']?>, สูง: <?php echo $this->banner['h']?> </div>
<?php endif?>
<input type="file" id="input10" size="20" name="o">
<p class="help-block">* ขนาดที่แนะนำคือ
<?php if($this->banner['p']=='img'):?>
645x430 pixel
<?php elseif($this->banner['p']=='bottom'):?>
330x220 pixel
<?php endif?>
</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input12">ลิ้งค์ปลายทาง:</label>
<div class="controls">
<input type="text" id="input12" class="form-control" name="link" value="<?php echo htmlspecialchars($this->banner['l'],ENT_QUOTES,'utf-8')?>">
</div>
</div>

<div class="control-group">
<label class="control-label" for="input03">ข้อความของแบนเนอร์:</label>
<div class="controls">
<input type="text" id="input03" class="form-control" name="detail" value="<?php echo htmlspecialchars($this->banner['d'],ENT_QUOTES,'utf-8')?>">
</div>
</div>

<div class="control-group">
<label class="control-label" for="input09">ลำดับในการแสดง:</label>
<div class="controls">
<input type="number" id="input09" class="form-control" name="sort" value="<?php echo $this->banner['so']?>">
</div>
</div>

 <div class="control-group">
<label class="control-label" for="input02">การเผยแพร่:</label>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="publish" value="1"<?php echo $this->banner['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="publish" value="0"<?php echo !$this->banner['pl']?' checked':''?>> ไม่แสดง</label>
</select>
</div>
</div>


<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/home-banner">ยกเลิก</a>
</div>
</fieldset>
</form>

<br><br>
