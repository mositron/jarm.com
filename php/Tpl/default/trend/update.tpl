<style>
.form-horizontal .control-group {margin-bottom:8px;padding-bottom: 10px;border-bottom: 1px dashed #F0F0F0;}
</style>


<ul class="breadcrumb">
  <li><a href="/" title="กระแสวันนี้"><span class="glyphicon glyphicon-home"></span> กระแสวันนี้</a></li>
	<span class="divider">&raquo;</span>
   <li><a href="/<?php echo urlencode($this->trend['key'])?>"><?php echo $this->trend['key']?></a></li>
   <span class="divider">&raquo;</span>
	 <li>แก้ไข</li>
</ul>


<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไข "<?php echo $this->trend['key']?>"</h2>

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
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/<?php echo urlencode($this->trend['key'])?>">หน้าแสดงผล </a>)
</div>
<?php endif?>

 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
	 <fieldset>
		 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
			 <label class="control-label" for="input01">เกริ่นนำ:</label>
			<div class="controls">
				<input type="text" id="input01" class="form-control" name="title" value="<?php echo htmlspecialchars($this->news['title'],ENT_QUOTES,'utf-8')?>" required>
				<p class="help-block">* บังคับกรอก</p>
			</div>
		</div>
		<div class="control-group<?php if($this->error['detail']):?> error<?php endif?>">
			<label class="control-label" for="input02">รายละเอียด:</label>
			<div class="controls">
				<textarea id="input02" class="form-control" name="detail"><?php echo htmlspecialchars($this->news['detail'],ENT_QUOTES,'utf-8')?></textarea>
			</div>
		</div>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary">บันทึก</button>
			<a class="btn" href="/">ยกเลิก</a>
		</div>
	</fieldset>
</form>
<br><br>
