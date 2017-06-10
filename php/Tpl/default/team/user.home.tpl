<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/user" title="">สมาชิก</a></li>
<?php if(in_array(self::$path[0],['jarm','racing'])):?>
	<span class="divider">&raquo;</span>
	<li><a href="/user/<?php echo self::$path[0]?>" title=""><?php echo ucfirst(self::$path[0])?></a></li>
<?php endif?>
<?php if (team::$my['grade']==99):?>
	<span></span>
  <li class="pull-right" style="margin:-3px -2px 1px 10px;"><a href="javascript:;" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> เพิ่มพนักงานใหม่</a></li>
	<span></span>
	<li class="pull-right" style="margin:0px 10px"><a href="/user/position"><span class="glyphicon glyphicon-th"></span> จัดการตำแหน่ง</a></li>
	<span></span>
  <li class="pull-right" style="margin:0px 10px"><a href="/user/team"><span class="glyphicon glyphicon-th-large"></span> จัดการทีม</a></li>
<?php endif?>
</ul>
<div class="box-white">
  <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">เพิ่มพนักงานใหม่</h4>
        </div>
        <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','newuser',this);$('.modal').modal('hide');return false;">
          <div class="modal-body">
            <div class="form-group">
              <label for="code_type" class="col-sm-2 control-label">สังกัด</label>
              <div class="col-sm-10">
                <div class="radio">
                  <label>
                    <input type="radio" name="code_type" class="minimal code_type set_defalse" value="1" checked>
                    Boxza (พนักงาน)
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="code_type" class="minimal code_type" value="2">
                    Boxzaracing (พนักงาน)
                  </label>
                </div>
                <hr>
                <div class="radio" style="padding-top: 0">
                  <label>
                    <input type="radio" name="code_type" class="minimal code_type" value="3">
                    Boxza (ฝึกงาน)
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="code_type" class="minimal code_type" value="4">
                    Boxzaracing (ฝึกงาน)
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">ทีม</label>
              <div class="col-sm-10">
                <select name="team" data-placeholder="ทีม" class="form-control select2">
                  <?php foreach ($this->team as $k=>$v): ?>
                    <option value="<?php echo $k?>"><?php echo $v['display']?></option>
                  <?php endforeach?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">ตำแหน่ง</label>
              <div class="col-sm-10">
                <select name="position" data-placeholder="ตำแหน่ง" class="form-control select2">
                  <?php foreach ($this->position as $k=>$v): ?>
                    <option value="<?php echo $k?>"><?php echo $v['display']?></option>
                  <?php endforeach?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="nickname" class="col-sm-2 control-label">ชื่อเล่น</label>
              <div class="col-sm-10">
                <input type="text" name="nickname" class="form-control" id="nickname" placeholder="e.g. พี่นัท">
              </div>
            </div>
            <div class="form-group">
              <label for="work_start" class="col-sm-2 control-label">เริ่มงาน</label>
              <div class="col-sm-10">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <select name="work_start_day" class="form-control" style="display:inline-block;width:70px;">
                    <?php $c=date('j');for($i=1;$i<=31;$i++):?>
                    <option value="<?php echo $i?>"<?php echo $c==$i?' selected':''?>><?php echo $i?></option>
                    <?php endfor?>
                  </select>
                  <select name="work_start_month" class="form-control" style="display:inline-block;width:120px;">
                    <?php $c=date('n');for($i=1;$i<=12;$i++):?>
                    <option value="<?php echo $i?>"<?php echo $c==$i?' selected':''?>><?php echo self::Time()->month[$i-1]?></option>
                    <?php endfor?>
                  </select>
                  <select name="work_start_year" class="form-control" style="display:inline-block;width:90px;">
                    <?php $c=date('Y');for($i=date('Y')-1;$i<=date('Y')+1;$i++):?>
                    <option value="<?php echo $i?>"<?php echo $c==$i?' selected':''?>><?php echo $i?></option>
                    <?php endfor?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="phone" class="col-sm-2 control-label">เบอร์โทร</label>
              <div class="col-sm-10">
                <input type="text" name="phone" maxlength="12" class="form-control" id="phone" data-inputmask='"mask":"099-999-9999"' data-mask placeholder="e.g. 099-999-9999">
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

  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs" style="height:42px;overflow:hidden;">
      <li<?php echo !in_array(self::$path[0],['jarm','racing'])?' class="active"':''?>><a href="/user">All</a></li>
      <li<?php echo (self::$path[0]=='jarm'?' class="active"':'')?>><a href="/user/jarm">Jarm</a></li>
      <li<?php echo (self::$path[0]=='racing'?' class="active"':'')?>><a href="/user/racing">Racing</a></li>
    </ul>
    <div class="tab-content">
      <div class="text-left">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>รูป</th>
              <th>ชื่อ - สกุล</th>
              <th>ชื่อเล่น</th>
              <!--th>เบอร์โทร</th-->
              <th>ทีม</th>
              <th>ตำแหน่ง</th>
              <?php if (team::$my['grade']==99):?>
              <th>Status</th>
              <th>&nbsp;</th>
              <?php endif?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ((array)$this->user as $v): ?>
            <?php if ($v['status']>0 || team::$my['grade']==99): ?>
            <tr>
              <td>
                <?php
                if($v['code']<100)
                {
                  $c = $v['code'];
                }
                elseif($v['type']==1)
                {
                  $c = 'N'.$v['code'];
                }
                elseif($v['type']==2)
                {
                  $c = 'R'.$v['code'];
                }
                elseif($v['type']==3)
                {
                  $c = 'N'.$v['code'];
                }
                elseif($v['type']==4)
                {
                  $c = 'R'.$v['code'];
                }
                else
                {
                  $c = $v['code'];
                }
                echo $c;
                ?>
              </td>
              <td>
                <a href="/user/<?php echo $v['_id']?>"><img src="https://f1.jarm.com/team/user/<?php echo $v['_id']?>-s.jpg" class="user-image" style="width: 25px; height: 25px; border-radius: 50%;" alt="User Image"/></a>
              </td>
              <td><a href="/user/<?php echo $v['_id']?>"><?php echo $v['th']['first']?> <?php echo $v['th']['last']?></a></td>
              <td><a href="/user/<?php echo $v['_id']?>"><?php echo $v['nickname']?></a></td>
              <!--td><?php echo $v['phone']?></td-->
              <td><?php echo $this->team[$v['team']]['display']?></td>
              <td><?php echo $this->position[$v['pos']]['display']?></td>
              <?php if (team::$my['grade']==99):?>
              <td><span class="label label-<?php echo $this->status[$v['status']]['l']?>"><?php echo $this->status[$v['status']]['n']?></span></td>
              <td>
                <div class="btn-group" style="width:30px;text-align:right">
                  <a href="/user/update/<?php echo $v['_id']?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                </div>
              </td>
              <?php endif?>
            </tr>
            <?php endif ?>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>รูป</th>
              <th>ชื่อ - สกุล</th>
              <th>ชื่อเล่น</th>
              <!--th>เบอร์โทร</th-->
              <th>ทีม</th>
              <th>ตำแหน่ง</th>
              <?php if (team::$my['grade']==99):?>
              <th>Status</th>
              <th>&nbsp;</th>
              <?php endif?>
            </tr>
          </tfoot>
        </table>
      </div>
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->
</div>
<script>
$('.modal').on('shown.bs.modal', function() {
  $('[data-mask]').inputmask();
});
</script>
