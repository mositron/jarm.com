<style>
.w100{width:100px;}
.w50{width:100px; text-align:right;}
.note{margin:3px 0px 0px 0px;padding:3px 0px 0px 0px;border-top:1px dashed #ccc;}
</style>
<script>
function delc(i){_.box.confirm({title:'ลบบทความนี้',detail:'ต้องการลงบทความนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delreport',i);}})}
</script>
<ul class="breadcrumb">
  <li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/report" title="">รายงาน</a></li>
  <span></span>
  <li class="pull-right" style="margin:-3px -2px 1px;"><a href="javascript:;" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> เพิ่มรายงาน</a></li>
</ul>
<div class="box-white">
  <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">เพิ่มรายงาน</h4>
        </div>
        <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','newreport',this);$('.modal').modal('hide');return false;">
          <div class="modal-body">
            <div class="form-group">
              <label for="title" class="col-sm-3 control-label">รายละเอียดงาน</label>
              <div class="col-sm-9">
                <textarea name="title" class="form-control" id="title" placeholder=""></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="time" class="col-sm-3 control-label">เวลา</label>
              <div class="col-sm-9">
                <input type="text" name="time" class="form-control" id="time" placeholder="">
              </div>
            </div>
            <div class="form-group">
              <label for="link" class="col-sm-3 control-label">ลูกค้า (ถ้ามี)</label>
              <div class="col-sm-9">
                <select name="customer" data-placeholder="เลือกลูกค้าที่เกี่ยวข้อง - ถ้ามี" class="chzn-select-deselect form-control">
                  <option value=""></option>
                  <?php foreach((array)$this->customer as $k=>$v):?>
                  <option value="<?php echo $k?>"><?php echo $v['name']?></option>
                  <?php endforeach?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="link" class="col-sm-3 control-label">ลิ้งค์ (ถ้ามี)</label>
              <div class="col-sm-9">
                <input type="text" name="link" class="form-control" id="link" placeholder="ขึ้นต้นด้วย http">
              </div>
            </div>
            <div class="form-group">
              <label for="note" class="col-sm-3 control-label">หมายเหตุ (ถ้ามี)</label>
              <div class="col-sm-9">
                <input type="text" name="note" class="form-control" id="note" placeholder="">
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
              <th class="w100">วันที่</th>
              <th>รายละเอียดงาน</th>
              <th>เวลา</th>
              <th class="w50">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php for($i=0;$i<count($this->report);$i++):$v=$this->report[$i]; $c=count($v['d']);?>
              <tr>
                <td rowspan="<?php echo $c?>"><span class="label label-primary"><?php echo self::Time()->from($v['dp'],'date')?></span></td>
                <td><?php echo nl2br($v['d'][0]['title'])?>
                  <?php if($v['d'][0]['customer']):?><p class="note"><span class="label label-info">ลูกค้า</span> <?php echo $this->customer[$v['d'][0]['customer']]['name']?></p><?php endif?>
                  <?php if($v['d'][0]['note']):?><p class="note"><span class="label label-warning">หมายเหตุ</span> <?php echo $v['d'][0]['note']?></p><?php endif?>
                </td>
                <td><?php echo $v['d'][0]['time']?></td>
                <td class="w50">
                  <?php if($v['d'][0]['link']):?>
                    <a href="<?php echo $v['d'][0]['link']?>" target="_blank" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-link"></span></a>
                  <?php endif?>
                  <?php if (self::Time()->sec($v['dp'])>=$this->expire):?>
                    <a href="/report/update/<?php echo $v['_id']?>-0" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="javascript:;" onclick="delc('<?php echo $v['_id']?>-<?php echo $v['d'][0]['id']?>');" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                  <?php endif?>
                </td>
              </tr>
              <?php if($c>1):?>
              <?php for($j=1;$j<$c;$j++):?>
                <tr>
                  <td><?php echo nl2br($v['d'][$j]['title'])?><?php if($v['d'][$j]['note']):?><p class="note"><span class="label label-warning">หมายเหตุ</span> <?php echo $v['d'][$j]['note']?></p><?php endif?></td>
                  <td><?php echo $v['d'][$j]['time']?></td>
                  <td class="w50">
                    <?php if($v['d'][$j]['link']):?>
                    <a href="<?php echo $v['d'][$j]['link']?>" target="_blank" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-link"></span></a>
                    <?php endif?>
                    <?php if (self::Time()->sec($v['dp'])>=$this->expire):?>
                    <a href="/report/update/<?php echo $v['_id']?>-<?php echo $j?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="javascript:;" onclick="delc('<?php echo $v['_id']?>-<?php echo $v['d'][$j]['id']?>');" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                    <?php endif?>
                  </td>
                </tr>
              <?php endfor?>
            <?php endif?>
          <?php endfor?>
          </tbody>
          <tfoot>
            <tr>
              <th class="w100">วันที่</th>
              <th>รายละเอียดงาน</th>
              <th>เวลา</th>
              <th class="w50">&nbsp;</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->
</div>

<script>
$('.modal').on('shown.bs.modal', function() {
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
});
</script>
