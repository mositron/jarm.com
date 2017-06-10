<style>
.w70{width:70px;text-align:right}
.w150{width:150px;text-align:right}
.crop-img{width:80px;height:45px;overflow:hidden;}
.crop-img img{width:80px;}
</style>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/queue" title="">คิวงาน</a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/queue/stock" title="รายชื่องาน">รายชื่องาน</a></li>
  <span></span>
  <li class="pull-right" style="margin:-3px -2px 1px;"><a href="javascript:;" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> เพิ่มรายการเบิกเงิน</a></li>
</ul>
<div class="box-white">
  <div class="nav-tabs-custom">
    <div class="tab-content">
      <div class="text-left">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>รูปภาพ</th>
              <th>หัวข้อ</th>
              <th>ประเภท</th>
              <th>เบอร์ติดต่อ</th>
              <th style="width:150px;">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
						<?php if(count($this->queue)>0):?>
            <?php for($i=0;$i<count($this->queue);$i++):$v=$this->queue[$i];?>
            <tr>
              <td><a href="/queue/<?php echo $v['_id']?>"><?php echo $v['_id']?></a></td>
              <td><?php if($v['thumbnail']!='default'):?><div class="crop-img"><a href="/queue/<?php echo $v['_id']?>"><img src="https://f1.jarm.com/team/queue/<?php echo $v['_id']?>.jpg"></a></div><?php endif?></td>
              <td><a href="/queue/<?php echo $v['_id']?>"><?php echo $v['name']?></a></td>
              <td><a href="/queue/<?php echo $v['_id']?>"><?php echo $this->type[$v['type']]['display']?></a></td>
              <td><a href="/queue/<?php echo $v['_id']?>"><?php echo $v['phone']?></a></td>
              <td class="w150">
								<?php $u=team::user()->get($v['u'],true);?>
								<a href="/user/<?php echo $v['u']?>" class="show-tooltip-s" title="สร้างโดย<br /><?php echo $u['name'].' ('.$u['nickname'].')';?>"><img src="https://f1.jarm.com/team/user/<?php echo $v['u']?>-s.jpg" class="user-image" style="width: 25px; height: 25px; border-radius: 50%;" /></a>
								<div class="btn-group">
									<a href="/queue/update/<?php echo $v['_id']?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
									<?php if(in_array(team::$my['_id'], (array)$this->perm['permAppointment'])&&$v['process']=='list_stock'):?>
									<a href="/queue/calendar/<?php echo $v['_id']?>" class="btn btn-default btn-xs"><i class="fa fa-calendar"></i></a>
									<?php endif?>
						  		<a href="javascript:;" onclick="delc('<?php echo $v['_id']?>');" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
								</div>
              </td>
            </tr>
            <?php endfor?>
						<?php endif?>
          </tbody>
        </table>
      </div>
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->

	<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">เพิ่มคิวงานใหม่</h4>
        </div>
        <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','newqueue',this);$('.modal').modal('hide');return false;">
          <div class="modal-body">
            <div class="form-group">
              <label for="title" class="col-sm-2 control-label">หัวข้อ</label>
              <div class="col-sm-10">
                <input type="text" name="title" class="form-control" id="title" placeholder="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="submit" class="btn btn-primary">ถัดไป</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
