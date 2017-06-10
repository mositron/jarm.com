<style>
.w100{width:100px;}
.w50{width:70px; text-align:right;}
.note{margin:3px 0px 0px 0px;padding:3px 0px 0px 0px;border-top:1px dashed #ccc;}
</style>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/report" title="">รายงาน</a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/report/update/<?php echo self::$path[1]?>" title="">แก้ไข</a></li>
</ul>
<div class="box-white">
	<?php if($_SERVER['QUERY_STRING']=='completed'):?>
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
   ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว
  </div>
  <?php endif?>

	<form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','updatereport',this);return false;">
		<div class="form-group">
			<label for="title" class="col-sm-3 control-label">รายละเอียดงาน</label>
			<div class="col-sm-9">
				<textarea name="title" class="form-control" id="title" placeholder=""><?php echo $this->detail['title']?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="time" class="col-sm-3 control-label">เวลา</label>
			<div class="col-sm-9">
				<input type="text" name="time" class="form-control" id="time" placeholder="" value="<?php echo $this->detail['time']?>">
			</div>
		</div>
		<div class="form-group">
			<label for="link" class="col-sm-3 control-label">ลูกค้า (ถ้ามี)</label>
			<div class="col-sm-9">
				<select name="customer" data-placeholder="เลือกลูกค้าที่เกี่ยวข้อง - ถ้ามี" class="chzn-select-deselect form-control">
					<option value=""></option>
					<?php foreach((array)$this->customer as $k=>$v):?>
					<option value="<?php echo $k?>"<?php echo $this->detail['customer']==$k?' selected':''?>><?php echo $v['name']?></option>
					<?php endforeach?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="link" class="col-sm-3 control-label">ลิ้งค์ (ถ้ามี)</label>
			<div class="col-sm-9">
				<input type="text" name="link" class="form-control" id="link" placeholder="ขึ้นต้นด้วย http" value="<?php echo $this->detail['link']?>">
			</div>
		</div>
		<div class="form-group">
			<label for="note" class="col-sm-3 control-label">หมายเหตุ (ถ้ามี)</label>
			<div class="col-sm-9">
				<input type="text" name="note" class="form-control" id="note" placeholder="" value="<?php echo $this->detail['note']?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-4 control-label"></label>
			<div class="col-sm-8">
	    	<button type="submit" class="btn btn-primary">บันทึก</button>
				<a href="/report" class="btn btn-default">ยกเลิก</a>
			</div>
		</div>
	</form>
</div>
