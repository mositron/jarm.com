<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/user" title="">สมาชิก</a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/user/team" title="">จัดการทีม</a></li>
	<span></span>
  <li class="pull-right" style="margin:-3px -2px 1px 10px;"><a href="javascript:;" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> เพิ่มทีมใหม่</a></li>
	<span></span>
	<li class="pull-right" style="margin:0px 10px"><a href="/user/position"><span class="glyphicon glyphicon-th"></span> จัดการตำแหน่ง</a></li>
	<!--span></span>
  <li class="pull-right" style="margin:0px 10px"><a href="/user/team"><span class="glyphicon glyphicon-th-large"></span> จัดการทีม</a></li-->
</ul>
<div class="box-white">
  <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">เพิ่มทีมใหม่</h4>
        </div>
        <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','newteam',this);$('.modal').modal('hide');return false;">
          <div class="modal-body">
						<div class="form-group">
              <label for="name" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="name" placeholder="">
              </div>
            </div>
						<div class="form-group">
              <label for="display" class="col-sm-2 control-label">Display</label>
              <div class="col-sm-10">
                <input type="text" name="display" class="form-control" id="display" placeholder="">
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

  <!-- <button type="button" class="btn btn-primary code_type" data-toggle="modal" data-target="#myModal" style="margin-bottom: 10px;">
    <i class="fa fa-plus"></i> เพิ่มทีมใหม่
  </button>

  <button type="button" class="btn btn-primary code_type" data-toggle="modal" data-target="#myModal" style="margin-bottom: 10px;">
    <i class="fa fa-plus"></i> เพิ่มตำแหน่งใหม่
  </button> -->

	<?php if(isset($_GET['added'])):?>
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
   เพิ่มทีมใหม่เรียบร้อยแล้ว.
  </div>
  <?php endif?>

  <div class="nav-tabs-custom">
    <div class="tab-content">
      <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Display</th>
            <th>Status</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ((array)$this->user as $v): ?>
          <tr>
						<td><?php echo $v['name']?></td>
						<td><?php echo $v['display']?></td>
            <td><span class="label label-<?php echo $v['status']!=1?'danger':'success'?>"><?php echo $v['status']!=1?'ยกเลิก':'กำลังใช้งาน'?></span></td>
            <td style="width:50px;">
              <div class="btn-group" style="width:30px;text-align:right">
								<button class="btn btn-xs btn-danger" onclick="_.box.confirm({'title':'ลบทีม','detail':'ต้องการลบทีมนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delteam',<?php echo $v['_id']?>)}})"><span class="glyphicon glyphicon-trash"></span></button>
              </div>
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div><!-- nav-tabs-custom -->
</div>
