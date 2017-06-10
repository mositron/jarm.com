<style>
.form-horizontal{padding:5px;}
</style>

<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/customer" title="">ข้อมูลลูกค้า</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/customer/insert" title="">เพิ่ม</a></li>
</ul>

<div class="box-white">
  <h3 class="bar-heading">เพิ่มบริษัท</h3>
  <?php if($_SERVER['QUERY_STRING']=='completed'):?>
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
   ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว
  </div>
  <?php endif?>
  <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','newcustomer',this);return false;">
    <div class="box-body no-padding">
      <div class="mailbox-read-info">
        <div class="form-group">
          <label for="by">ของบริษัท</label>
          <select name="by" id="by" class="form-control">
            <option value="0">เลือกประเภท</option>
            <?php foreach ($this->by as $k=>$v):?>
              <option value="<?php echo $k?>"<?php echo $k==$this->customer['by']?' selected':''?>><?php echo $v['display']?></option>
            <?php endforeach?>
          </select>
        </div>

        <div class="form-group">
          <label for="name">ชื่อบริษัท</label>
          <input type="text" name="name" class="form-control" id="name" placeholder="ชื่อบริษัท" value="<?php echo $this->customer['name']?>">
        </div>

        <div class="dynamic-group" <?php echo $this->customer['by']==0?' hidden="hidden"':''?>>
	        <div class="form-group">
	          <label for="type">เป็น</label>
	          <select name="type" id="type" class="form-control">
	            <?php foreach ($this->company_type as $k=>$v):?>
	              <option value="<?php echo $k?>" <?php echo $k==$this->customer['type']?>><?php echo $v['display']?></option>
	            <?php endforeach?>
	          </select>
	        </div>
	        <div class="form-group form-tax" id="inputTax" <?php echo $this->customer['type']==2?' hidden="hidden"':''?>>
	          <label for="tax">เลขประจำตัวผู้เสียภาษี</label>
	          <input type="text" name="tax" class="form-control" id="tax" data-inputmask='"mask": "9-9999-99999-99-9"' data-mask placeholder="เลขประจำตัวผู้เสียภาษี" value="<?php echo $this->customer['tax']?>"/>
	        </div>
	        <div class="form-group" id="selectCustomersID" <?php echo $this->customer['type']!=2?' hidden="hidden"':''?>>
	          <label for="parent">สาขาของบริษัท</label>
	          <select name="parent" id="parent" class="form-control" style="width: 100%;">
	            <option value="0">เลือกประเภท</option>
	          </select>
	        </div>
	        <div class="form-group form-sub-tax" id="inputSubTax" <?php echo $this->customer['type']!=2?' hidden="hidden"':''?>>
	          <label for="sub_tax">เลขสาขา</label>
	          <input type="text" name="sub_tax" class="form-control" id="sub_tax" data-inputmask='"mask": "99999"' data-mask placeholder="เลขสาขา" value="<?php echo $this->customer['sub_tax']?>"/>
	        </div>
        </div>

        <div class="form-group">
          <label>ที่อยู่</label>
          <textarea name="address" rows="3" cols="80" class="form-control" placeholder="ที่อยู่"><?php echo $this->customer['address']?></textarea>
        </div>

        <div class="form-group">
          <label for="service">ประเภทลูกค้า</label>
          <select name="service" id="service" class="form-control">
            <option value="0">เลือกประเภท</option>
            <?php foreach ($this->company_service as $k=>$v):?>
              <option value="<?php echo $k?>" <?php echo $k==$this->customer['service']?' selected':''?>><?php echo $v['display']?></option>
            <?php endforeach?>
          </select>
        </div>

        <div class="form-group">
          <label for="brand">ยี่ห้อ</label>
          <select name="brand" data-placeholder="ยี่ห้อ" class="form-control chzn-select" id="brand" style="width: 100%;" multiple>
          <?php foreach ($this->brand as $k=>$v): ?>
            <option value="<?php echo $k?>" <?php echo in_array($k,(array)$this->customer['brand'])?' selected':''?>><?php echo $v['display']?></option>
          <?php endforeach?>
        </select>
        </div>

        <div class="form-group">
          <label for="sale">เซลที่ดูแลลูกค้า</label>
          <select name="sale" data-placeholder="เซลที่ดูแลลูกค้า" class="form-control chzn-select" id="sale" style="width: 100%;" multiple>
          <?php foreach ($this->sale as $k=>$v): ?>
            <option value="<?php echo $k?>"<?php echo in_array($k,(array)$this->customer['sale'])?' selected':''?>><?php echo $v['th']['first']?> <?php echo $v['th']['last']?> (<?php echo $v['nickname']?>)</option>
          <?php endforeach?>
        </select>
        </div>
      </div><!-- /.mailbox-read-info -->
    </div>

    <div class='box-body-add' style="padding-bottom:15px;border-bottom:1px solid #ccc;margin-bottom:10px">
      <label>ผู้ติดต่อ</label>
      <small>จำเป็นต้องใส่ในช่องที่มี *</small>
      <div class="g"></div>
      <a href="javascript:;" class="btn btn-xs btn-default" onClick="newrowitem();"><i class="fa fa-plus"></i> เพิ่มชื่อผู้ติดต่อ</a>
    </div>

    <div class="box-body-add">
        <div class="form-group">
          <label for="bill_billing">วางบิล</label>
        <textarea name="bill_billing" rows="3" cols="80" class="form-control" id="bill_billing" placeholder="วางบิลทุกๆ... ของเดือน"><?php echo $this->customer['bill']['billing']?></textarea>
        </div>

        <div class="form-group">
          <label for="bill_cheque">due รับเช็ค</label>
        <textarea name="bill_cheque" rows="3" cols="80" class="form-control" id="bill_cheque" placeholder="due รับเช็ค"><?php echo $this->customer['bill']['cheque']?></textarea>
        </div>

        <div class="form-group">
          <label for="bill_cash">due โอนเงิน</label>
        <textarea name="bill_cash" rows="3" cols="80" class="form-control" id="bill_cash" placeholder="due โอนเงิน"><?php echo $this->customer['bill']['cash']?></textarea>
        </div>

        <div class="form-group">
          <label for="bill_term">Credit Term</label>
          <input type="number" name="bill_term" class="form-control" id="bill_term" placeholder="credit term" value="<?php echo $this->customer['bill']['term']?>">
        </div>

        <div class="form-group">
          <label for="bill_billing_location">สถานที่วางบิล</label>
        <textarea name="bill_billing_location" rows="3" cols="80" class="form-control" id="bill_billing_location" placeholder="สถานที่วางบิล"><?php echo $this->customer['bill']['billing_location']?></textarea>
        </div>

        <div class="form-group">
          <label for="bill_pay">วิธีการชำระเงิน</label>
          <select name="bill_pay" id="bill_pay" class="form-control">
            <option value="0">เลือกประเภท</option>
            <?php foreach ($this->pay as $k=>$v):?>
              <option value="<?php echo $k?>" <?php echo $k==$this->customer['bill']['pay']?' selected':''?>><?php echo $v['display']?></option>
            <?php endforeach?>
          </select>
        </div>

        <div class="form-group" id="locationPayCheque" <?php echo ($this->customer['pay']!=2)?'hidden="hidden"':''?>>
          <label for="bill_cheque_location">สถานที่รับเช็ค</label>
        <textarea name="bill_cheque_location" rows="3" cols="80" class="form-control" id="bill_cheque_location" placeholder="สถานที่รับเช็ค"><?php echo $this->customer['bill']['cheque_location']?></textarea>
        </div>

        <div class="form-group">
          <label for="bill_how_bill">วิธีการวางบิล</label>
          <select name="bill_how_bill" id="bill_how_bill" class="form-control">
            <option value="0">เลือกประเภท</option>
            <?php foreach ($this->bill as $k=>$v):?>
              <option value="<?php echo $k?>" <?php echo k==$this->customer['bill']['how_bill']?' selected':''?>><?php echo $v['display']?></option>
            <?php endforeach?>
          </select>
        </div>

        <div class="form-group">
          <label for="bill_email">Email ในการวางบิล</label>
          <input type="text" name="bill_email" class="form-control" id="bill_email" placeholder="Email ในการวางบิล" value="<?php echo $this->customer['bill']['email']?>">
        </div>

        <div class="form-group">
          <label for="bill_doc">เอกสารในการวางบิล</label>
        <textarea name="bill_doc" rows="3" cols="80" class="form-control" id="bill_doc" placeholder="เอกสารในการวางบิล"><?php echo $this->customer['bill']['doc']; ?></textarea>
        </div>

    </div>

    <!-- <div class='box-body'>

    <div class="form-group">
        <label for="attachment">แนบไฟล์ที่เกี่ยวข้อง สามารถเพิ่มได้ครั้งละหลายไฟล์</label>
        <input type="file" name="attachment" id="attachment" value="เลือกไฟล์" multiple>
      <p class="help-block">ขนาดไม่เกิน 1MB</p>
    </div>

    </div> -->

    <div class="box-footer">
      <button type="submit" class="btn btn-primary">บันทึก</button>
    </div>

  </div><!-- /.box -->

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


//	$('.select2').select2();
	$('.select2-selection__rendered').attr('title','');
	$('#brand, #sale, #parent').change(function(){
		$('.select2-selection__rendered').attr('title','');
		$('.select2-selection__choice').attr('title','');
	});

	$('#by').change(function () {
		var selectedOption = $('#by').val();
		$('#inputTax, #inputSubTax').removeClass('has-success has-error');
		if (selectedOption !== '0')
		{
			selectCompanyUnder(selectedOption,0);
			$('.dynamic-group').show();
			$('#select2-parent-container').text('เลือกบริษัท');
			$('#sub_tax').val('');
		}
		else
		{
			$('.dynamic-group').hide();
		}
	});

	$('#type').change(function () {
		var selectedOption = $('#type').val();
		$('#inputTax, #inputSubTax').removeClass('has-success has-error');
		$('#tax').val('');
		if (selectedOption === '1') {
			$('#inputTax').show();
		}else{
			$('#selectCustomersID').show();
			$('#inputSubTax').show();
		}

		if (selectedOption != '1') {
			$('#inputTax').hide();
		}else{
			$('#selectCustomersID').hide();
			$('#inputSubTax').hide();
			$('#sub_tax').val('');
		}
	});

	$('#parent').change(function (){
		$('#sub_tax').val('');
		$('#inputSubTax').removeClass('has-success has-error');
		$('label[for=sub_tax]').text('เลขสาขา');
	});

	$('#bill_pay').change(function(){
		var selectedOption = $('#bill_pay').val();
		if (selectedOption === '2') {
			$('#locationPayCheque').show();
		}
		if (selectedOption != '2') {
			$('#locationPayCheque').hide();
		}
	});

	$("[data-mask]").inputmask();

	$("#tax").blur(function(){

		if ($("#tax").val()!='')
		{
			var data = callbackTax($("#tax").val());
			if(data)
			{
				$('.form-tax').addClass('has-error');
				$('label[for=tax]').text('เลขประจำตัวผู้เสียภาษีซ้ำกับ '+data['name']);
			}
			else
			{
				$('.form-tax').removeClass('has-error');
				$('.form-tax').addClass('has-success');
				$('label[for=tax]').text('เลขประจำตัวผู้เสียภาษี');
			}
		}
	});

	$("#sub_tax").blur(function(){
		if ($("#sub_tax").val()!='')
		{
			var data = callbackSubTax($("#parent").val(),$("#sub_tax").val());
			if(data)
			{
				$('.form-sub-tax').addClass('has-error');
				$('label[for=sub_tax]').text('เลขสาขาซ้ำกับ '+data['name']);
			}
			else
			{
				$('.form-sub-tax').removeClass('has-error');
				$('.form-sub-tax').addClass('has-success');
				$('label[for=sub_tax]').text('เลขสาขา');
			}
		}
	});
	newrowitem();
	if (by) selectCompanyUnder(by,parent);
});

function callbackTax(e)
{
	var r;
	$.ajax({
		type: "POST",
		url: "/adminAccountingCustomers/data_check_tax",
		data: {tax:e},
		dataType: 'json',
		async: false,
		success: function(data){r=data}
	});
	return r;
}

function callbackSubTax(parent,sub_tax)
{
	var r;
	$.ajax({
		type: "POST",
		url: "/adminAccountingCustomers/data_check_sub_tax",
		data: {parent:parent,sub_tax:sub_tax},
		dataType: 'json',
		async: false,
		success: function(data){r=data}
	});
	return r;
}

function selectCompanyUnder(e,v)
{

	var options = '<option value="0">เลือกบริษัท</option>';
	var varSubTax = '';

	$.ajax({
		type: "POST",
		url: "/adminAccountingCustomers/data_by",
		data: { by_ID : e },
		dataType: 'json',
		success: function(data){
			if (data)
			{
				$.each(data, function(i, d) {
					varSubTax = (d['ID']==v)?'selected="selected"':'';
					options = options + '<option value="'+d['ID']+'" '+varSubTax+'>'+d['name']+'</option>';
				});
			}

			$('#parent').html(options);

		}

	});

}

function newrowitem()
{
	// var position = '';

	// $(customers_reference_position).each(function(k,v) {
	//   $(v).each(function(i,d){
	//     position = position + '<option value="' + d['ID'] + '">' + d['display'] +'</option>';
	//   });

	// });

	var contact ='<div class="g">'

							+'  <div class="form-group">'
							+'    <input type="text" name="contact_name" class="form-control" placeholder="ชื่อผู้ติดต่อ *" value="">'
							+'  </div>'
							// +'  <div class="form-group">'
							// +'    <select name="customers_reference_position" id="customers_reference_position" class="form-control">'
							// +'      <option value="0">เลือกตำแหน่ง</option>'
							// +       position
							// +'    </select>'
							// +'  </div>'
							+'  <div class="form-group">'
							+'    <input type="text" name="contact_position" class="form-control" placeholder="ตำแหน่ง" value="">'
							+'  </div>'
							+'  <div class="form-group">'
							+'    <input type="text" name="contact_email" class="form-control" placeholder="Email" value="">'
							+'  </div>'
							+'  <div class="form-group">'
							+'    <input type="text" name="contact_phone" class="form-control" placeholder="เบอร์โทร *" value="">'
							+'  </div>'
							+'  <div class="form-group">'
							+'    <input type="text" name="contact_fax" class="form-control" placeholder="Fax" value="">'
							+'  </div>'
							+'  <a href="javascript:;" class="btn btn-xs btn-danger btn-javascript-del" onClick="del(this);"><i class="fa fa-times"></i> ลบผู้ติดต่อ</a>'
							+'  <hr style="clear:both;">'
							+'</div>';
	$('.box-body-add > .g:last').after(contact);
}

function del(e)
{
	$(e).parent().remove();
}
</script>
