
<style>
.category label{width:240px; margin:0px !important}
#video > div{border:1px solid #f0f0f0; border-radius:5px; padding:5px; margin:5px 0px}
#video > div p{margin:2px}
</style>



<ul class="breadcrumb">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
   <li><a href="/lotto">ตรวจหวย</a></li>
   <span class="divider">&raquo;</span>
   <li>แก้ไขผลสลากกินแบ่ง</li>
 </ul>

<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขผลสลากกินแบ่ง</h2>
<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/lotto">ระบบจัดการข้อมูล </a>, <a href="<?php echo self::uri(['lotto','/view/'.$this->lotto['_id']])?>">หน้าแสดงผล </a>)
</div>
<?php endif?>

 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="form-group">
<label class="col-sm-2 control-label" for="input01">งวดที่:</label>
<div class="col-sm-10">
<select name="day" class="tbox" style="width:auto" required><option value="">- เลือกวัน -</option>
<?php for($i=1;$i<31;$i++):?>
<option value="<?php echo $i?>"<?php echo $i==$this->date['d']?' selected':''?>><?php echo $i?></option>
<?php endfor?>
</select>
<select name="month" class="tbox" style="width:auto" required><option value="">- เลือกเดือน -</option>
<?php for($i=0;$i<12;$i++):?>
<option value="<?php echo $i+1?>"<?php echo $i+1==$this->date['m']?' selected':''?>><?php echo self::Time()->month[$i]?></option>
<?php endfor?>
</select>
<select name="year" class="tbox" style="width:auto" required><option value="">- เลือกปี -</option>
<?php for($i=date('Y');$i>date('Y')-10;$i--):?>
<option value="<?php echo $i?>"<?php echo $i==$this->date['y']?' selected':''?>><?php echo $i+543?></option>
<?php endfor?>
</select>
</div>
</div>
 <div class="form-group">
<label class="col-sm-2 control-label">รางวัลที่ 1:</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="a1" value="<?php echo $this->lotto['a1']?>">
</div>
</div>
 <div class="form-group">
<label class="col-sm-2 control-label">รางวัลที่ 2:</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="a2" value="<?php echo implode('	',(array)$this->lotto['a2'])?>">
</div>
</div>
 <div class="form-group">
<label class="col-sm-2 control-label">รางวัลที่ 3:</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="a3" value="<?php echo implode('	',(array)$this->lotto['a3'])?>">
</div>
</div>
 <div class="form-group">
<label class="col-sm-2 control-label">รางวัลที่ 4:</label>
<div class="col-sm-10">
<textarea id="input09" class="form-control" name="a4"><?php echo implode('	',(array)$this->lotto['a4'])?></textarea>
</div>
</div>
 <div class="form-group">
<label class="col-sm-2 control-label">รางวัลที่ 5:</label>
<div class="col-sm-10">
<textarea id="input09" class="form-control" name="a5"><?php echo implode('	',(array)$this->lotto['a5'])?></textarea>
</div>
</div>
 <div class="form-group">
<label class="col-sm-2 control-label">เลขหน้า 3 ตัว:</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="f3" value="<?php echo implode('	',(array)$this->lotto['f3'])?>">
</div>
</div>
 <div class="form-group">
<label class="col-sm-2 control-label">เลขท้าย 3 ตัว:</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="l3" value="<?php echo implode('	',(array)$this->lotto['l3'])?>">
</div>
</div>
 <div class="form-group">
<label class="col-sm-2 control-label">เลขท้าย 2 ตัว:</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="l2" value="<?php echo $this->lotto['l2']?>">
</div>
</div>

 <div class="form-group">
<label class="col-sm-2 control-label" for="input02">การเผยแพร่:</label>
<div class="controls category">
<label class="checkbox-inline"><input type="radio" name="publish" value="1"<?php echo $this->lotto['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox-inline"><input type="radio" name="publish" value="0"<?php echo !$this->lotto['pl']?' checked':''?>> ไม่แสดง</label>
</select>
</div>
</div>

<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/lotto">ยกเลิก</a>
</div>
</fieldset>
</form>
