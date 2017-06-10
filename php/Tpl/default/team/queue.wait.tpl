<style>
.w70{width:70px;text-align:right}
.crop-img{width:80px;height:45px;overflow:hidden;}
.crop-img img{width:80px;}
</style>
<script>
function delc(i){_.box.confirm({title:'ลบรายการเบิกเงินนี้',detail:'ต้องการลบรายการเบิกเงินนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delreport',i);}})}
</script>
<ul class="breadcrumb">
  <li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/queue" title="">เบิกเงิน</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/queue/<?php echo $this->page?>" title=""><?php echo $this->status_name[$this->page]?></a></li>
  <span></span>
  <li class="pull-right" style="margin:-3px -2px 1px;"><a href="/queue/insert" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> เพิ่มรายการเบิกเงิน</a></li>
</ul>
<div class="box-white">
  <div class="nav-tabs-custom">
    <div class="tab-content">
      <div class="text-left">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>เวลานัด</th>
              <th>หัวข้อ</th>
              <th>ประเภท</th>
              <th>เบอร์ติดต่อ</th>
              <th style="width:100px;">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($this->queue)>0):$time=strtotime(date('Y-m-d').' 00:00:00');?>
            <?php for($i=0;$i<count($this->queue);$i++):$v=$this->queue[$i];?>
            <tr>
              <td><a href="/queue/<?php echo $v['_id']?>"><?php echo $v['_id']?></a></td>
              <td><span class="label label-<?php echo ($v['ds1']&&self::Time()->sec($v['ds1'])>$time)?'primary':'danger'?>"><?php echo self::Time()->from($v['ds1'],'datetime')?></span></td>
              <td><a href="/queue/<?php echo $v['_id']?>"><?php echo $v['name']?></a></td>
              <td><a href="/queue/<?php echo $v['_id']?>"><?php echo $this->type[$v['type']]['display']?></a></td>
              <td><a href="/queue/<?php echo $v['_id']?>"><?php echo $v['phone']?></a></td>
              <td class="w70">
                <?php $u=team::user()->get($v['upq'],true);?>
                <a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="สร้างโดย<br /><?php echo $u['name'].' ('.$u['nickname'].')';?>"><img src="https://f1.jarm.com/team/user/<?php echo $u['_id']?>-s.jpg" class="user-image" style="width: 25px; height: 25px; border-radius: 50%;" /></a>
                <a href="/queue/update/<?php echo $v['_id']?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="javascript:;" onclick="delc('<?php echo $v['_id']?>');" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
              </td>
            </tr>
            <?php endfor?>
            <?php endif?>
          </tbody>
        </table>
      </div>
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->
</div>
