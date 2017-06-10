<style>
dd,dt{line-height:2em;}
dd{border-bottom:1px dashed #ccc;}
dt.status-wrong,dd.status-wrong,dd.status-wrong a{color:#c00 !important;}
dd.status-wrong{border-color:#c00 !important;}
dt.status-pass,dd.status-pass,dd.status-pass a{color:#428110 !important;}
dd.status-pass{border-color:#428110 !important;}
</style>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/withdraw" title="">เบิกเงิน</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/withdraw/<?php echo $this->withdraw['_id']?>" title="">ใบเบิก <?php echo $this->withdraw['_id']?></a></li>
</ul>
<div class="box-white">
	<h3 class="bar-heading" style="margin-bottom:10px;">ใบเบิก
		<?php if (in_array($this->withdraw['status'],[0,2])&&(team::$my['grade']==99||$this->withdraw['u']==team::$my['_id'])):?>
    <small class="pull-right">
      <a href="/withdraw/update/<?php echo $this->withdraw['_id']?>" class="btn btn-default btn-xs" data-tooltip="tooltip" title="แก้ไข"><i class="fa fa-pencil"></i></a>
  		<button type="button" class="btn btn-default btn-xs" data-tooltip="tooltip" title="ลบ" data-id="<?php echo $this->withdraw['_id']?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash-o"></i></button>
    </small>
		<?php endif?>
  </h3>
  <div class="row">
    <div class="col-md-12">
      <dl class="dl-horizontal">
        <dt>ID:</dt>
        <dd><?php echo $this->withdraw['_id']?></dd>
				<dt>เบิกแบบ:</dt>
				<dd><span class="label label-form-<?php echo $this->withdraw['form']?>"><?php echo $this->form[$this->withdraw['form']]['display']?></span></dd>
				<dt>สถานะ:</dt>
				<dd style="font-size:22px;"><span class="label label-status-<?php echo $this->withdraw['status']?>" style="font-size:100%"><?php echo $this->status[$this->withdraw['status']]['display']?></span></dd>
			</dl>
		</div>
	</div>
  <?php if($this->withdraw['type']==1):?>
  <h4 class="bar-heading" style="margin-bottom:10px;">รายละเอียดคิวงาน</h4>
  <div class="row">
    <div class="col-md-12">
      <dl class="dl-horizontal" style="margin-bottom:0px;">
        <dt>ชื่อคิวงาน:</dt>
        <dd><a href="/queue-product/<?php echo $this->withdraw['product']?>"><?php echo $this->product[$this->withdraw['product']]['name']?></a></dd>
      </dl>
    </div>
    <div class="col-md-5">
      <dl class="dl-horizontal">
        <dt><i class="fa fa-map-marker"></i> สถานที่ที่ทำงาน:</dt> <dd><?php echo $this->prod['location']?$this->prod['location']:'-'?></dd>
        <?php if($this->prod['province']):?>
        <dt>จังหวัด:</dt><dd><?php echo $this->province[$this->prod['province']]['name_th']?></dd>
        <?php endif?>
        <dt>เบอร์ติดต่อ:</dt>
        <dd><?php echo $this->prod['phone']?$this->prod['phone']:'-'?></dd>
        <dt>ประเภท:</dt>
        <dd><?php echo $this->queue_type[$this->prod['type']]['display']?></dd>
        <dt>คิวงาน:</dt>
        <dd><span class="label label-<?php echo in_array($this->prod['process'], ['list_stock','list_queue'])?'danger':'success'?>"><?php echo in_array($this->prod['process'], ['list_stock','list_queue'])?'ยังไม่ได้ดำเนินการ':'ดำเนินการแล้ว'?></span></dd>
      </dl>
    </div>
    <div class="col-md-7">
      <dl class="dl-horizontal">
        <dt><i class="fa fa-clock-o"></i> เริ่ม:</dt> <dd><?php echo self::Time()->from($this->prod['ds1'],'datetime')?></dd>
        <?php if($this->prod['ds2']):?>
        <dt>ถึง:</dt>
        <dd><?php echo self::Time()->from($this->prod['ds2'],'datetime')?></dd>
        <?php endif?>
        <dt>เจ้าหน้าที่ที่เกี่ยวข้อง:</dt>
        <dd>
        <?php foreach ((array)$this->prod['ref'] as $u):$v=team::user()->get($u,true);?>
          <a href="/user/<?php echo $v['_id']?>"><img alt="image" data-toggle="tooltip" data-html="true" title="<?php echo $v['pos']?><br /><?php echo $v['name']?> (<?php echo $v['nickname']?>)" class="img-circle" src="<?php echo $v['img']?>" style="width:32px;height:32px;"></a>
        <?php endforeach?>
        </dd>
      </dl>
    </div>
  </div>
  <?php endif?>
  <h4 class="bar-heading" style="margin-bottom:10px;">รายละเอียดใบเบิก</h4>
	<div class="row">
		<div class="col-md-5">
			<dl class="dl-horizontal" style="margin-bottom:0px;">
				<dt>สร้างใบเบิกโดย:</dt>
				<dd><a href="/users/<?php echo $this->withdraw['u']?>" data-toggle="tooltip" data-html="true" title="<?php echo $this->user['th']['first']?> <?php echo $this->user['th']['last']?>"><?php echo $this->user['nickname']?></a></dd>
        <?php if($this->withdraw['status']==2):?>
        <dt class="status-wrong">ไม่ผ่านตรวจสอบโดย:</dt><?php $u=team::user()->get($this->withdraw['status2']['u'],true)?>
        <dd class="status-wrong"><a href="/users/<?php echo $u['_id']?>" data-toggle="tooltip" data-html="true" title="<?php echo $u['th']['first']?> <?php echo $u['th']['last']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <?php if($this->withdraw['status']>=3):?>
        <dt class="status-pass">ผ่านตรวจสอบโดย:</dt><?php $u=team::user()->get($this->withdraw['status3']['u'],true)?>
        <dd class="status-pass"><a href="/users/<?php echo $u['_id']?>" data-toggle="tooltip" data-html="true" title="<?php echo $u['th']['first']?> <?php echo $u['th']['last']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <?php if($this->withdraw['status']==4):?>
        <dt class="status-wrong">ไม่อนุมัติโดย:</dt><?php $u=team::user()->get($this->withdraw['status4']['u'],true)?>
        <dd class="status-wrong"><a href="/users/<?php echo $u['_id']?>" data-toggle="tooltip" data-html="true" title="<?php echo $u['th']['first']?> <?php echo $u['th']['last']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <?php if($this->withdraw['status']>=5):?>
        <dt class="status-pass">อนุมัติโดย:</dt><?php $u=team::user()->get($this->withdraw['status5']['u'],true)?>
        <dd class="status-pass"><a href="/users/<?php echo $u['_id']?>" data-toggle="tooltip" data-html="true" title="<?php echo $u['th']['first']?> <?php echo $u['th']['last']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <?php if($this->withdraw['status']>=6):?>
        <dt class="status-pass">จ่ายโดย:</dt><?php $u=team::user()->get($this->withdraw['status6']['u'],true)?>
        <dd class="status-pass"><a href="/users/<?php echo $u['_id']?>" data-toggle="tooltip" data-html="true" title="<?php echo $u['th']['first']?> <?php echo $u['th']['last']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <?php if($this->withdraw['status']>=7):?>
        <dt class="status-pass">เคลียร์เงินโดย:</dt><?php $u=team::user()->get($this->withdraw['status7']['u'],true)?>
        <dd class="status-pass"><a href="/users/<?php echo $u['_id']?>" data-toggle="tooltip" data-html="true" title="<?php echo $u['th']['first']?> <?php echo $u['th']['last']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <?php if($this->withdraw['status']>=8):?>
        <dt class="status-pass">เคลียร์บิลโดย:</dt><?php $u=team::user()->get($this->withdraw['status8']['u'],true)?>
        <dd class="status-pass"><a href="/users/<?php echo $u['_id']?>" data-toggle="tooltip" data-html="true" title="<?php echo $u['th']['first']?> <?php echo $u['th']['last']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <dt>ทีมที่ทำการเบิก:</dt>
				<dd><?php echo $this->team[$this->withdraw['team']]['display']?></dd>
				<dt>ประเภท:</dt>
				<dd><span class="label label-type-<?php echo $this->withdraw['type']?>"><?php echo $this->type[$this->withdraw['type']]['display']?></span></dd>
			</dl>
		</div>
		<div class="col-md-7">
			<dl class="dl-horizontal">
				<dt>สร้างใบเบิกเมื่อ:</dt>
				<dd><?php echo self::Time()->from($this->withdraw['da'],'datetime')?></dd>
        <?php if($this->withdraw['status']==2):?>
        <dt class="status-wrong">ไม่ผ่านตรวจสอบเมื่อ:</dt>
        <dd class="status-wrong"><?php echo self::Time()->from($this->withdraw['status2']['d'],'datetime')?></dd>
        <?php endif?>
        <?php if($this->withdraw['status']>=3):?>
        <dt class="status-pass">ผ่านตรวจสอบเมื่อ:</dt>
        <dd class="status-pass"><?php echo self::Time()->from($this->withdraw['status3']['d'],'datetime')?></dd>
        <?php endif?>
        <?php if($this->withdraw['status']==4):?>
        <dt class="status-wrong">ไม่อนุมัติเมื่อ:</dt>
        <dd class="status-wrong"><?php echo self::Time()->from($this->withdraw['status4']['d'],'datetime')?></dd>
        <?php endif?>
        <?php if($this->withdraw['status']>=5):?>
        <dt class="status-pass">อนุมัติเมื่อ:</dt>
        <dd class="status-pass"><?php echo self::Time()->from($this->withdraw['status5']['d'],'datetime')?></dd>
        <?php endif?>
        <?php if($this->withdraw['status']>=6):?>
        <dt class="status-pass">จ่ายเมื่อ:</dt>
        <dd class="status-pass"><?php echo self::Time()->from($this->withdraw['status6']['d'],'datetime')?></dd>
        <?php endif?>
        <?php if($this->withdraw['status']>=7):?>
        <dt class="status-pass">เคลียร์เงินเมื่อ:</dt>
        <dd class="status-pass"><?php echo self::Time()->from($this->withdraw['status7']['d'],'datetime')?></dd>
        <?php endif?>
        <?php if($this->withdraw['status']>=8):?>
        <dt class="status-pass">เคลียร์บิลเมื่อ:</dt>
        <dd class="status-pass"><?php echo self::Time()->from($this->withdraw['status8']['d'],'datetime')?></dd>
        <?php endif?>
			</dl>
		</div>
    <?php if($this->withdraw['remark']):?>
    <div class="col-md-12">
      <dl class="dl-horizontal">
        <dt>หมายเหตุ:</dt>
        <dd><?php echo nl2br($this->withdraw['remark'])?></dd>
      </dl>
    </div>
    <?php endif?>
    <?php if($this->withdraw['status']==2):?>
    <div class="col-md-12">
      <dl class="dl-horizontal">
        <dt class="status-wrong">ไม่ผ่านตรวจสอบเพราะ:</dt>
        <dd class="status-wrong"><?php echo nl2br($this->withdraw['note']['c'])?></dd>
      </dl>
    </div>
    <?php endif?>
    <?php if($this->withdraw['status']==4):?>
    <div class="col-md-12">
      <dl class="dl-horizontal">
        <dt class="status-wrong">ไม่อนุมัติเพราะ:</dt>
        <dd class="status-wrong"><?php echo nl2br($this->withdraw['note']['uh'])?></dd>
      </dl>
    </div>
    <?php endif?>
	</div>
	<?php if($this->data):?>
	<div class='box-body-add'>
		<div class="table-responsive" style="margin-top:10px;">
			<table class="table table-striped">
				<thead>
					<tr>
						<th style="width: 10px">#</th>
						<th>รายการ</th>
						<th class="text-right">จำนวน</th>
						<th class="text-right">ราคา<?php $sum_price=0?></th>
						<th class="text-left">หมายเหตุ</th>
					</tr>
				</thead>
				<tbody>
				<?php for($i=0;$i<count($this->data);$i++):$v=$this->data[$i];?>
					<tr class="row-data-<?php echo $v['_id']?>">
						<td><span class="numData"><?php echo $i+1?></span>.</td>
						<td><?php echo $this->list[$v['list']]['name']?></td>
						<td class="text-right"><?php if($v['amount']):echo number_format($v['amount']);endif;?></td>
						<td class="text-right">
							<?php if($v['price']):
								$sum_price+=$v['price'];
								echo number_format($v['price'],2);
							endif;?>
						</td>
						<td class="text-left"><?php echo ($v['remark'])?nl2br($v['remark']):'-';?></td>
					</tr>
				<?php endfor?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3" class="text-right">รวมเป็นเงินทั้งสิ้น</td>
						<td class="text-right"><?php echo number_format($sum_price,2)?></td>
						<td colspan="2">&nbsp;</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<?php endif?>
  <?php if($this->withdraw['status']==1):?>
    <?php if(in_array(team::$my['grade'],[99,98,97]) || in_array(team::$my['_id'], $this->adv->permCheck) || in_array(team::$my['pos'], $this->adv->permPositionCheck) ):?>
    <div class="box-footer">
      <button type="button" class="btn btn-success" data-id="<?php echo $this->withdraw['_id']?>" data-to="3" data-toggle="modal" data-target="#myModal">ส่งอนุมัติ</button>
      <button type="button" class="btn btn-danger" data-id="<?php echo $this->withdraw['_id']?>" data-to="2" data-toggle="modal" data-target="#myModal">ไม่ผ่านตรวจสอบ</button>
    </div>
    <script>
    var note_check=null;
    $(function(){
      $('#myModal').on('show.bs.modal', function (e){
         var to = $(e.relatedTarget).data('to')
         if (to==3)
         {
           $('#myModal').removeClass('modal-danger').addClass('modal-warning')
         }
         else
         {
           $('#myModal').removeClass('modal-warning').addClass('modal-danger')
         }
         $(this).find('.modal-body').html(
          (
            (to==3)
            ?
            '<p>คุณยืนยันอนุมัติใบเบิกนี้</p><input type="hidden" name="note" value="" />'
            :
            '<p>คุณยืนยันใบเบิกนี้ ไม่ผ่านตรวจสอบ</p><div class="form-group"><label>เพราะ</label><textarea name="note" rows="3" cols="80" class="form-control" placeholder="เหตุผล">'+((note_check)?note_check:'')+'</textarea></div>'
          )+
          '<input type="hidden" name="to" value="'+to+'" />'
          )
       });
    });
    </script>
    <div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content animated flipInY">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="icon fa fa-ban"></i> แจ้งเตือน</h4>
          </div>
          <form method="post" action="<?php echo URL?>" onsubmit="_.ajax.gourl('<?php echo URL?>','setstatus',this.to.value,this.note.value);$('.modal').modal('hide');return false;">
            <div class="modal-body"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">ไม่ใช่</button>
              <button type="submit" class="btn btn-outline">ใช่</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>
    <?php endif?>
  <?php elseif($this->withdraw['status']==3):?>
    <?php if(in_array(team::$my['grade'],[99,98,97]) || in_array(team::$my['_id'], $this->adv->permLook)):?>
    <div class="box-footer">
      <button type="button" class="btn btn-success" data-id="<?php echo $this->withdraw['_id']?>" data-to="5" data-toggle="modal" data-target="#myModal">อนุมัติ</button>
      <button type="button" class="btn btn-danger" data-id="<?php echo $this->withdraw['_id']?>" data-to="4" data-toggle="modal" data-target="#myModal">ไม่อนุมัติ</button>
    </div>
    <script>
    var note_check=null;
    $(function(){
      $('#myModal').on('show.bs.modal', function (e){
         var to = $(e.relatedTarget).data('to')
         if (to==5)
         {
           $('#myModal').removeClass('modal-danger').addClass('modal-warning')
         }
         else
         {
           $('#myModal').removeClass('modal-warning').addClass('modal-danger')
         }
         $(this).find('.modal-body').html(
          (
            (to==5)
            ?
            '<p>คุณยืนยันอนุมัติใบเบิกนี้</p><input type="hidden" name="note" value="" />'
            :
            '<p>คุณยืนยันไม่อนุมัติใบเบิกนี้</p><div class="form-group"><label>เพราะ</label><textarea name="note" rows="3" cols="80" class="form-control" placeholder="เหตุผล">'+((note_check)?note_check:'')+'</textarea></div>'
          )+
          '<input type="hidden" name="to" value="'+to+'" />'
          )
       });
    });
    </script>
    <div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content animated flipInY">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="icon fa fa-ban"></i> แจ้งเตือน</h4>
          </div>
          <form method="post" action="<?php echo URL?>" onsubmit="_.ajax.gourl('<?php echo URL?>','setstatus',this.to.value,this.note.value);$('.modal').modal('hide');return false;">
            <div class="modal-body"></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">ไม่ใช่</button>
              <button type="submit" class="btn btn-outline">ใช่</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>
    <?php endif?>
  <?php elseif($this->withdraw['status']==5):?>
    <?php if(in_array(team::$my['grade'],[99,97]) || in_array(team::$my['_id'], $this->adv->permPaidLook) || in_array(team::$my['_id'], $this->adv->permLook)):?>
    <div class="box-footer">
      <button type="button" class="btn btn-success" data-id="<?php echo $this->withdraw['_id']?>" data-to="5" data-toggle="modal" data-target="#myModal">จ่ายแล้ว</button>
    </div>
    <div class="modal inmodal fade modal-warning" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content animated flipInY">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="icon fa fa-ban"></i> แจ้งเตือน</h4>
          </div>
          <form method="post" action="<?php echo URL?>" onsubmit="_.ajax.gourl('<?php echo URL?>','setstatus',this.to.value,this.note.value);$('.modal').modal('hide');return false;">
            <div class="modal-body"><p>คุณยืนยันการจ่ายใบเบิกนี้</p><input type="hidden" name="note" value="" /><input type="hidden" name="to" value="<?php echo $this->withdraw['form']==2?6:8?>" /></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">ไม่ใช่</button>
              <button type="submit" class="btn btn-outline">ใช่</button>
            </div>
          </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>
    <?php endif?>
	<?php elseif($this->withdraw['status']==6):?>
		<?php if (team::$my['grade']==99||$this->withdraw['u']==team::$my['_id']):?>
    <div class="box-footer">
			<a href="/withdraw/update/<?php echo $this->withdraw['_id']?>" class="btn btn-default">แก้ไข</a>
			<button type="button" class="btn btn-success" data-id="<?php echo $this->withdraw['_id']?>" data-to="7" data-toggle="modal" data-target="#myModal">ส่งเคลียร์บิล</button>
    </div>
		<div class="modal inmodal fade modal-warning" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content animated flipInY">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title"><i class="icon fa fa-ban"></i> แจ้งเตือน</h4>
					</div>
					<form method="post" action="<?php echo URL?>" onsubmit="_.ajax.gourl('<?php echo URL?>','setstatus',this.to.value,this.note.value);$('.modal').modal('hide');return false;">
						<div class="modal-body"><p>คุณยืนยันเคลียเงินใบเบิกนี้</p><input type="hidden" name="note" value="" /><input type="hidden" name="to" value="7" /></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">ไม่ใช่</button>
							<button type="submit" class="btn btn-outline">ใช่</button>
						</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div>
		<?php endif?>
	<?php elseif($this->withdraw['status']==7):?>
		<?php if(in_array(team::$my['grade'],[99,97]) || in_array(team::$my['_id'], $this->adv->permLook) || in_array(team::$my['_id'], $this->adv->permClearLook) || in_array(team::$my['pos'], $this->adv->permPositionClearLook)):?>
		<div class="box-footer">
      <button type="button" class="btn btn-success" data-id="<?php echo $this->withdraw['_id']?>" data-to="8" data-toggle="modal" data-target="#myModal">ยืนยันข้อมูลถูกต้อง</button>
      <button type="button" class="btn btn-danger" data-id="<?php echo $this->withdraw['_id']?>" data-to="6" data-toggle="modal" data-target="#myModal">ส่งกลับไปแก้ไข</button>
		</div>
		<!-- Modal -->
		<div class="modal inmodal modal-warning fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		 <div class="modal-dialog">
			 <div class="modal-content animated flipInY">
				 <form method="post" action="<?php echo URL?>" onsubmit="_.ajax.gourl('<?php echo URL?>','setstatus',this.to.value);$('.modal').modal('hide');return false;">
				 <div class="modal-header">
					 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					 <h4 class="modal-title"><i class="icon fa fa-ban"></i> แจ้งเตือน</h4>
				 </div>
				 <div class="modal-body">text</div>
				 <div class="modal-footer">
					 <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">ไม่ใช่</button>
					 <button type="submit" class="btn btn-outline">ใช่</button>
				 </div>
			 	 </form>
			 </div><!-- /.modal-content -->
		 </div><!-- /.modal-dialog -->
		</div>
		<script>
		$(function () {
		 $('#myModal').on('show.bs.modal',function(event){
			 var to = $(event.relatedTarget).data('to')
			 if (to==8)
			 {
				 $('#myModal').removeClass('modal-danger').addClass('modal-warning')
			 }
			 else
			 {
				 $('#myModal').removeClass('modal-warning').addClass('modal-danger')
			 }
			 $(this).find('.modal-body').html(
				 ((to==8)?'คุณยืนยันข้อมูลถูกต้องแล้ว':'คุณยืนยันว่าข้อมูลเหล่านี้ไม่ถูกต้อง และทำการส่งกลับไปแก้ไข')+
				 '<input type="hidden" name="to" value="'+to+'" />'
			 );
		});
	 });
	 </script>
		<?php endif?>
  <?php endif?>
</div>
