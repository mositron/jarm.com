<style>
.div-text{padding:7px 0px 7px;border-bottom:1px dashed #ccc;}
</style>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/queue" title="">คิวงาน</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/queue/update/<?php echo $this->queue['_id']?>" title="">แก้ไข</a></li>
</ul>

<div class="box-white">
	<h3 class="bar-heading" style="margin-bottom:10px;">รายชื่องาน - <?php echo $this->queue['name']?>
		<?php if(team::$my['grade']==99||$this->queue['u']==team::$my['_id']):?>
		<small class="pull-right">
			<a href="/queue/update/<?php echo $this->queue['_id']?>" class="btn btn-default btn-xs" data-tooltip="tooltip" title="แก้ไข"><i class="fa fa-pencil"></i></a>
			<?php if(in_array(team::$my['_id'], (array)$this->perm['permAppointment'])):?>
			<a href="/queue/calendar/<?php echo $this->queue['_id']?>" class="btn btn-default btn-xs"><i class="fa fa-calendar"></i></a>
			<?php endif?>
			<button type="button" class="btn btn-default btn-xs" data-tooltip="tooltip" title="ลบ" data-id="<?php echo $this->queue['_id']?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash-o"></i></button>
		</small>
		<?php endif?>
	</h3>

  <?php if($_SERVER['QUERY_STRING']=='completed'):?>
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
   ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว
  </div>
  <?php endif?>

  <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','updatequeue',this);return false;">
		<div class="form-group">
      <label class="col-sm-2 control-label">หัวข้อ</label>
      <div class="col-sm-10">
				<input type="text" name="name" class="form-control" value="<?php echo $this->queue['name']?>" required>
			</div>
		</div>

		<div class="form-group">
      <label class="col-sm-2 control-label">เบอร์ติดต่อ</label>
      <div class="col-sm-10">
				<input type="text" name="phone" class="form-control" value="<?php echo $this->queue['phone']?>" required>
			</div>
		</div>

		<div class="form-group">
      <label for="type" class="col-sm-2 control-label">ประเภทงาน</label>
      <div class="col-sm-10">
  			<select name="type" id="type" class="form-control" required>
  				<option value="0">เลือกประเภท</option>
  				<?php foreach ((array)$this->type as $k=>$v):?>
  					<option value="<?php echo $k?>"<?php echo $this->queue['type']==$k?' selected':''?>><?php echo $v['display']?></option>
  				<?php endforeach?>
  			</select>
      </div>
		</div>

		<div class="form-group">
      <label class="col-sm-2 control-label">รูปภาพ</label>
      <div class="col-sm-10">
				<div><img src="https://f1.jarm.com/team/queue/<?php echo $this->queue['_id']?>.jpg" id="img-photo"></div>
				<input type="file" id="photo" name="photo" class="form-control">
			</div>
		</div>

		<div class="form-group">
      <label for="detail" class="col-sm-2 control-label">รายละเอียดงาน</label>
      <div class="col-sm-10">
			  <textarea name="detail" id="detail" rows="3" cols="80" class="form-control" placeholder="รายละเอียดงาน"><?php echo $this->queue['detail']?></textarea>
		  </div>
    </div>

		<div class="form-group">
      <label for="note" class="col-sm-2 control-label">หมายเหตุ</label>
      <div class="col-sm-10">
			  <textarea name="note" id="note" rows="3" cols="80" class="form-control" placeholder="หมายเหตุ"><?php echo $this->queue['note']?></textarea>
		  </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
  </form>

	<div style="padding:10px 0px;border-top:1px solid #ddd;">
    <dl class="dl-horizontal">
      <dt>สร้างรายชื่องานโดย:</dt>
			<?php $u=team::user()->get($this->queue['u'],true);?>
			<dd><a href="/user/<?php echo $u['_id']?>"><img src="https://f1.jarm.com/team/user/<?php echo $u['_id']?>-s.jpg" class="user-image" style="width: 25px; height: 25px; border-radius: 50%;" /> <?php echo $u['nickname']?> - <?php echo $u['name']?></a></dd>
      <dt>สร้างรายชื่องานเมื่อ:</dt>
      <dd><?php echo self::Time()->from($this->queue['da'],'datetime')?></dd>
    </dl>
  </div>
</div>
<script>
$(function(){
	_.upload.create('#photo',function(d,e){$('#img-photo').attr('src',d.file);});
});
</script>
