
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/withdraw" title="">เบิกเงิน</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/withdraw/insert" title="">เพิ่ม</a></li>
</ul>

<div class="box-white">
  <?php if($_SERVER['QUERY_STRING']=='completed'):?>
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
   ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว
  </div>
  <?php endif?>

  <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','newwithdraw',this);return false;">
		<div class="form-group">
      <label class="col-sm-2 control-label">เบิกแบบ</label>
      <div class="col-sm-10">
        <select name="form" id="form" class="form-control" required>
          <option value="0">เลือกเบิกแบบ</option>
          <?php foreach ((array)$this->form as $k=>$v):?>
            <option value="<?php echo $k?>"<?php echo $this->withdraw['form']==$k?' selected':''?>><?php echo $v['display']?></option>
          <?php endforeach?>
        </select>
			</div>
		</div>

		<div class="form-group">
      <label for="type" class="col-sm-2 control-label">ประเภท</label>
      <div class="col-sm-10">
  			<select name="type" id="type" class="form-control" required>
  				<option value="0">เลือกประเภท</option>
  				<?php foreach ((array)$this->type as $k=>$v):?>
  					<option value="<?php echo $k?>"<?php echo $this->withdraw['type']==$k?' selected':''?>><?php echo $v['display']?></option>
  				<?php endforeach?>
  			</select>
      </div>
		</div>

		<div class="form-group" id="production_data" <?php echo $this->withdraw['type']!=1?' hidden="hidden"':''?>>
      <label for="product" class="col-sm-2 control-label">คิวงาน</label>
      <div class="col-sm-10">
  			<select name="product" id="product" class="form-control chzn-select">
  				<option value="0">เลือกคิวงาน</option>
          <?php foreach ((array)$this->product as $k=>$v):?>
  					<option value="<?php echo $k?>"<?php echo $this->withdraw['product']==$k?' selected':''?>><?php echo $v['name']?></option>
  				<?php endforeach?>
  			</select>
      </div>
		</div>

		<div class="form-group">
      <label for="team" class="col-sm-2 control-label">ทีมที่ทำการเบิก</label>
      <div class="col-sm-10">
  			<select name="team" id="team" class="form-control" required>
  				<option value="0">เลือกทีมที่ทำการเบิก</option>
          <?php foreach ((array)$this->team as $k=>$v):?>
  					<option value="<?php echo $k?>"<?php echo $this->withdraw['team']==$k?' selected':''?>><?php echo $v['display']?></option>
  				<?php endforeach?>
  			</select>
      </div>
		</div>

		<div class="form-group">
      <label for="remark" class="col-sm-2 control-label">หมายเหตุ</label>
      <div class="col-sm-10">
			     <textarea name="remark" id="remark" rows="3" cols="80" class="form-control" placeholder="หมายเหตุ"><?php echo $this->withdraw['remark']?></textarea>
		  </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
  </form>
</div>
<script>

$(function () {
	$('#time').daterangepicker({
		singleDatePicker:true,
		showDropdowns:true,
		timePicker: true,
		timePickerIncrement: 30,
		opens: 'right',
    locale: {
        format: 'YYYY-MM-DD HH:mm:ss'
    }
	});

	var config = {
		 '.chzn-select'           : {},
		 '.chzn-select-deselect'  : {allow_single_deselect:true},
		 '.chzn-select-no-single' : {disable_search_threshold:10},
		 '.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
		 '.chzn-select-width'     : {width:"95%"}
	 }
	 for (var selector in config) {
		 $(selector).chosen(config[selector]);
	 }

   $('#type').change(function () {
     var s = $(this).val();
     if (s === '1')
     {
       $('#production_data').show();
			 $("#product").chosen('destroy');
			 $('#product').chosen({});;
     }
     else
     {
       $('#production_data').hide();
     }
   });
});
</script>
