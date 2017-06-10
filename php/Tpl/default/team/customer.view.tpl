<style>
.form-horizontal {padding: 5px;}
.mailbox-attachments li>div{border: 1px solid #eee;margin-bottom: 10px;}
.mailbox-attachment-icon {text-align: center;font-size: 65px;color: #666;padding: 20px 10px;display:block;}
.mailbox-attachment-info {padding: 10px;background: #f4f4f4;margin-top: 5px;}
.mailbox-attachment-size{display:block;margin:5px 0px 0px;font-size:12px;}
.mailbox-attachment-size a{margin:-3px 0px 0px 0px;}
.wrap-attachment-name{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
label:after{content:":";font-weight:normal;font-size:12px;}
.form-group{margin: 5px;border-bottom: 1px dashed #ddd;padding: 0px 10px;}
</style>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/customer" title="">ข้อมูลลูกค้า</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/customer/<?php echo $this->customer['_id']?>" title=""><?php echo $this->customer['name']?></a></li>
	<?php if (team::$my['grade']==99||$this->customer['u']==team::$my['_id']):?>
		<span></span>
		<li class="pull-right" style="margin:-3px -2px 1px;"><a href="/customer/update/<?php echo $this->customer['_id']?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></li>
	<?php endif?>
</ul>

<div class="box-white">
	<div class="mailbox-read-info">
		<div class="form-group">
			<label for="client_code">Client Code</label>
			<?php echo str_pad($this->customer['client_code'], 5, 0, STR_PAD_LEFT);?>
		</div>

		<div class="form-group">
			<label for="customers_company_under">ของบริษัท</label>
			<?php echo $this->by[$this->customer['by']]['display'];?>
		</div>

    <div class="form-group">
      <label for="name">ชื่อบริษัท</label>
      <?php echo $this->customer['name']?>
    </div>

    <div class="dynamic-group" <?php echo $this->customer['by']==0?' hidden="hidden"':''?>>
      <div class="form-group">
        <label for="type">เป็น</label>
        <?php echo $this->company_type[$this->customer['type']]['display']?>
      </div>
      <div class="form-group form-tax" id="inputTax" <?php echo $this->customer['type']==2?' hidden="hidden"':''?>>
        <label for="tax">เลขประจำตัวผู้เสียภาษี</label>
        <?php echo $this->customer['tax']?>
      </div>
      <div class="form-group" id="selectCustomersID" <?php echo $this->customer['type']!=2?' hidden="hidden"':''?>>
        <label for="parent">สาขาของบริษัท</label>

      </div>
      <div class="form-group form-sub-tax" id="inputSubTax" <?php echo $this->customer['type']!=2?' hidden="hidden"':''?>>
        <label for="sub_tax">เลขสาขา</label>
        <?php echo $this->customer['sub_tax']?>
      </div>
    </div>

    <div class="form-group">
      <label>ที่อยู่</label>
      <?php echo $this->customer['address']?>
    </div>

    <div class="form-group">
      <label for="service">ประเภทลูกค้า</label>
      <?php echo $this->company_service[$this->customer['service']]['display']?>
    </div>

    <div class="form-group">
      <label for="brand">ยี่ห้อ</label>
      <?php foreach((array)$this->customer['brand'] as $v):?>
        <?php echo $this->brand[$v]['display']?>
      <?php endforeach?>
    </div>

    <div class="form-group">
      <label for="sale">เซลที่ดูแลลูกค้า</label>
      <?php foreach((array)$this->customer['sale'] as $v):?>
        <span class="label label-default"><?php echo $this->sale[$v]['th']['first']?> <?php echo $this->sale[$v]['th']['last']?> (<?php echo $this->sale[$v]['nickname']?></span>
      <?php endforeach?>
    </div>

    <div class="form-group">
      <label>ผู้ติดต่อ</label>
      <?php if(is_array($this->customer['contact'])&&count($this->customer['contact'])>0):?>
      <div class=" table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>ชื่อผู้ติดต่อ</th>
              <th>ตำแหน่ง</th>
              <th>อีเมล</th>
              <th>เบอร์โทร</th>
              <th>fax</th>
            </tr>
          </thead>
          <tbody>
          <?php for($i=0;$i<count($this->customer['contact']);$i++):$v=$this->customer['contact'][$i];?>
            <tr class="row-contact-<?php echo $i?>">
              <td><span class="numData"><?php echo $i+1?></span>.</td>
              <td><?php echo $v['name']?></td>
              <td><?php echo $v['position']?></td>
              <td><?php echo $v['email']?></td>
              <td><?php echo $v['phone']?></td>
              <td><?php echo $v['fax']?></td>
            </tr>
          <?php endfor?>
          </tbody>
        </table>
      </div>
      <?php endif?>
    </div>

    <div class="form-group">
      <label for="bill_billing">วางบิล</label>
      <?php echo $this->customer['bill']['billing']?>
    </div>

    <div class="form-group">
      <label for="bill_cheque">due รับเช็ค</label>
      <?php echo $this->customer['bill']['cheque']?>
    </div>

    <div class="form-group">
      <label for="bill_cash">due โอนเงิน</label>
      <?php echo $this->customer['bill']['cash']?>
    </div>

    <div class="form-group">
      <label for="bill_term">Credit Term</label>
      <?php echo $this->customer['bill']['term']?>
    </div>

    <div class="form-group">
      <label for="bill_billing_location">สถานที่วางบิล</label>
      <?php echo $this->customer['bill']['billing_location']?>
    </div>

    <div class="form-group">
      <label for="bill_pay">วิธีการชำระเงิน</label>
      <?php echo $this->pay[$this->customer['bill']['pay']]['display']?>
    </div>

    <div class="form-group" id="locationPayCheque" <?php echo ($this->customer['pay']!=2)?'hidden="hidden"':''?>>
      <label for="bill_cheque_location">สถานที่รับเช็ค</label>
      <?php echo $this->customer['bill']['cheque_location']?>
    </div>

    <div class="form-group">
      <label for="bill_how_bill">วิธีการวางบิล</label>
      <?php echo $this->bill[$this->customer['bill']['how_bill']]['display']?>
    </div>

    <div class="form-group">
      <label for="bill_email">Email ในการวางบิล</label>
      <?php echo $this->customer['bill']['email']?>
    </div>

    <div class="form-group">
      <label for="bill_doc">เอกสารในการวางบิล</label>
      <?php echo $this->customer['bill']['doc'];?>
    </div>

    <div class="form-group">
      <ul class="mailbox-attachments row"><?php echo getfiles()?></ul>
    </div>

	</div><!-- /.mailbox-read-info -->
</div>
