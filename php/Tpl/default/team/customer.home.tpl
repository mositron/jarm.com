<style>
.w100{width:100px;}
.w120{width:120px;}
.w165{width:165px;}
.w50{width:70px; text-align:right;}
.note{margin:3px 0px 0px 0px;padding:3px 0px 0px 0px;border-top:1px dashed #ccc;}
</style>
<script>
function delc(i){_.box.confirm({title:'ลบการรายการลูกค้านี้',detail:'ต้องการลบรายการลูกค้านี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delcustomer',i);}})}
</script>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/customer" title="">ข้อมูลลูกค้า</a></li>
  <span></span>
  <li class="pull-right" style="margin:-3px -2px 1px;"><a href="javascript:;" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> เพิ่มข้อมูลลูกค้า</a></li>
</ul>
<div class="box-white">
  <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">เพิ่มบริษัทใหม่</h4>
        </div>
        <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','newcustomer',this);$('.modal').modal('hide');return false;">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-2 control-label">ชื่อบริษัท</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="name" placeholder="ชื่อบริษัท" value="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="submit" class="btn btn-primary">เพิ่ม</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="nav-tabs-custom">
    <div class="tab-content">
      <div class="text-left">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ชื่อบริษัท</th>
              <th class="w120">เป็น</th>
              <th>ยี่ห้อ</th>
              <th class="w100">ประเภท</th>
              <th class="w165">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach((array)$this->customer as $k=>$v):?>
            <tr>
              <td><a href="/customer/<?php echo $v['_id']?>"><?php echo $v['name']?></a></td>
              <td><a href="/customer/<?php echo $v['_id']?>"><?php echo $this->company_type[$v['type']]['display']?></a></td>
              <td><?php foreach((array)$v['brand'] as $k2=>$v2):$p=$this->brand[$v2];?><?php echo $k2>0?', ':''?><a href="/customer/<?php echo $v['_id']?>"><?php echo $p['display']?></a><?php endforeach?></td>
							<td><?php echo $this->company_service[$v['service']]['display']?></td>
							<td class="w165 text-right">
								<?php if($v['lock']['status']): ?><button type="button" class="btn btn-warning btn-xs" data-tooltip="tooltip" title="Locked"><i class="fa fa-lock"></i></button><?php endif?>
								<?php if($v['approve']['status']): ?><button type="button" class="btn btn-success btn-xs" data-tooltip="tooltip" title="Approved"><i class="fa fa-check"></i></button><?php endif?>
								<?php if($v['file_ID']): ?><button type="button" class="btn btn-default btn-xs" data-tooltip="tooltip" title="มี <?php echo $v['file_ID']?> ไฟล์แนบ"><i class="fa fa-paperclip"></button></i><?php endif?>
								<a href="/user/<?php echo $v['u']?>" class="show-tooltip-s" title="สร้างโดย<br /><?php echo $this->people[$v['u']]['th']['first'].' '.$this->people[$v['u']]['th']['last']?> <br /> <?php echo self::Time()->from($v['da'],'datetime')?>"><img src="https://f1.jarm.com/team/user/<?php echo $v['u']?>-s.jpg" class="user-image" style="width: 25px; height: 25px; border-radius: 50%;"/></a>
								<a href="/customer/update/<?php echo $v['_id']?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="javascript:;" onclick="delc('<?php echo $v['_id']?>');" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
              </td>
            </tr>
						<?php if($v['sub']):foreach($v['sub'] as $k2=>$v2):?>
            <tr>
              <td><span class="glyphicon glyphicon-chevron-right"></span> <a href="/customer/<?php echo $v2['_id']?>"><?php echo $v2['name']?></a></td>
              <td><a href="/customer/<?php echo $v2['_id']?>"><?php echo $this->company_type[$v2['type']]['display']?></a></td>
              <td><?php foreach((array)$v2['brand'] as $k3=>$v3):$p=$this->brand[$v3];?><?php echo $k3>0?', ':''?><a href="/customer/<?php echo $v2['_id']?>"><?php echo $p['display']?></a><?php endforeach?></td>
							<td><?php echo $this->company_service[$v2['service']]['display']?></td>
							<td class="w165 text-right">
								<?php if($v2['lock']['status']): ?><button type="button" class="btn btn-warning btn-xs" data-tooltip="tooltip" title="Locked"><i class="fa fa-lock"></i></button><?php endif?>
								<?php if($v2['approve']['status']): ?><button type="button" class="btn btn-success btn-xs" data-tooltip="tooltip" title="Approved"><i class="fa fa-check"></i></button><?php endif?>
								<?php if($v2['file_ID']): ?><button type="button" class="btn btn-default btn-xs" data-tooltip="tooltip" title="มี <?php echo $v2['file_ID']?> ไฟล์แนบ"><i class="fa fa-paperclip"></button></i><?php endif?>
								<a href="/user/<?php echo $v2['u']?>" class="show-tooltip-s" title="สร้างโดย<br /><?php echo $this->people[$v2['u']]['th']['first'].' '.$this->people[$v2['u']]['th']['last']?> <br /> <?php echo self::Time()->from($v2['da'],'datetime')?>"><img src="https://f1.jarm.com/team/user/<?php echo $v2['u']?>-s.jpg" class="user-image" style="width: 25px; height: 25px; border-radius: 50%;"/></a>
							<?php /*
								<a href="<?php echo site_url()?>admin/<?php echo $this->uri->segment(2)?>/<?php echo $this->uri->segment(3)?>/edit/<?php echo $v->ID?>" data-tooltip="tooltip" title="แก้ไข" class="btn btn-default btn-xs"><i class="fa fa-pencil"></i></a>
								<button type="button" class="btn btn-default btn-xs" data-tooltip="tooltip" title="ลบ" data-id="<?php echo $v->ID?>" data-name="<?php echo $v->name?>" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o"></i></button>
              */?>
							  <a href="/customer/update/<?php echo $v2['_id']?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="javascript:;" onclick="delc('<?php echo $v2['_id']?>');" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
              </td>
            </tr>
						<?php endforeach;endif;?>
					<?php endforeach?>
          </tbody>
          <tfoot>
						<tr>
              <th>ชื่อบริษัท</th>
              <th class="w120">เป็น</th>
              <th>ยี่ห้อ</th>
              <th class="w100">ประเภท</th>
              <th class="w165">&nbsp;</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->
</div>
