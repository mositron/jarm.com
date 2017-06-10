<style>
.div-text{padding:7px 0px 7px;border-bottom:1px dashed #ccc;}
</style>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/withdraw" title="">เบิกเงิน</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/withdraw/update/<?php echo $this->withdraw['_id']?>" title="">แก้ไข</a></li>
</ul>

<div class="box-white">
  <?php if($_SERVER['QUERY_STRING']=='completed'):?>
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
   ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว
  </div>
  <?php endif?>

  <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','updatewithdraw',this);return false;">
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

    <div class="form-group" style="margin: 10px 0px 0px;border-top: 1px solid #ccc;padding: 10px 0px 0px;">
      <a href="javascript:;" id="addList" class="btn btn-default btn-xs" data-id="<?php echo $this->withdraw['_id']?>" data-toggle="modal" data-target="#myModalAddList"><i class="fa fa-plus"></i> เพิ่มรายการ</a>
    </div>

    <div id="getdata" class="table-responsive" style="margin: 10px 0px;border-bottom: 1px solid #ccc;padding: 0px 0px 10px;">
      <?php echo getdata()?>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">บันทึก</button>
        <?php if($this->withdraw['status']==0):?>
        <button type="button" class="btn btn-success" onclick="_.box.confirm({title:'ส่งใบเบิก',detail:'ต้องการส่งใบเบิกนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','setstatus',1);}});">ส่งใบเบิก</button>
        <?php endif?>
      </div>
    </div>
  </form>
</div>


<!-- Modal -->
<div class="modal inmodal fade" id="myModalAddList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content animated flipInY">
			<form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','newdata',this);$('.modal').modal('hide');this.reset();return false;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">เพิ่มรายการใบเบิก</h4>
				</div>
				<div class="modal-body">
					<div class="gbody row">
						<div class="form-group col-xs-12">
							<label for="advance_list_ID">รายการ</label>
							<select name="list" id="advance_list_ID" class="form-control" required>
							</select>
						</div>
						<div class="form-group col-xs-6">
							<label for="amount">จำนวน</label>
							<input type="number" name="amount" class="form-control" id="amount" placeholder="จำนวน" required>
						</div>
						<div class="form-group col-xs-6">
							<label for="price">ราคารวม</label>
							<input type="number" name="price" class="form-control" id="price" placeholder="ราคารวม" required>
						</div>
						<div class="form-group col-xs-12">
							<label for="remark">หมายเหตุ</label>
							<textarea name="remark" rows="3" cols="80" id="remark" class="form-control" placeholder="หมายเหตุ"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
					<button type="submit" id="btn-submit" class="btn btn-primary">บันทึก</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<script>
var list=<?php echo json_encode(array_values($this->list))?>;
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

$('.modal').on('shown.bs.modal', function() {
	var tmp='<option value="">เลือก</option>',i,type=$('#type').val()+'';
  $.each(list,function(i,j){
		if(j['type']+'' == type)
		{
			tmp+='<option value="'+j['_id']+'">'+j['name']+'</option>';
		}
	});
	$('#advance_list_ID').chosen('destroy').html(tmp).chosen({});
});

function delRow(i)
{
	_.box.confirm({title:'ลบรายการนี้',detail:'ต้องการลบรายการเบิกนี้หรือไม่',click:function(){
		_.ajax.gourl('<?php echo URL?>','deldata',i);
	}});
}
</script>
