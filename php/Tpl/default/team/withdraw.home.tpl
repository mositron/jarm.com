<style>
.w100{width:100px;}
.w50{width:70px; text-align:right;}
.note{margin:3px 0px 0px 0px;padding:3px 0px 0px 0px;border-top:1px dashed #ccc;}
</style>
<script>
function delc(i){_.box.confirm({title:'ลบรายการเบิกเงินนี้',detail:'ต้องการลบรายการเบิกเงินนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delreport',i);}})}
</script>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/withdraw" title="">เบิกเงิน</a></li>
  <span></span>
  <li class="pull-right" style="margin:-3px -2px 1px;"><a href="/withdraw/insert" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> เพิ่มรายการเบิกเงิน</a></li>
</ul>
<div class="box-white">
  <div class="nav-tabs-custom">
    <div class="tab-content">
      <div class="text-left">
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="w100">เวลา</th>
              <th>หัวข้อ</th>
              <th>ผู้เกี่ยวข้อง</th>
              <th class="w50">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <?php for($i=0;$i<count($this->withdraw);$i++):$v=$this->withdraw[$i];?>
            <tr>
              <td><a href="/withdraw/<?php echo $v['_id']?>"><span class="label label-primary"><?php echo self::Time()->from($v['dp'],'datetime')?></span></a></td>
              <td><a href="/withdraw/<?php echo $v['_id']?>"><?php echo $v['title']?></a><p>สร้างโดย <a href="/user/<?php echo $v['u']?>" title=""><?php echo $this->people[$v['u']]['th']['first'].' '.$this->people[$v['u']]['th']['last']?></a></p></td>
              <td>
                <?php foreach((array)$v['ref'] as $k2=>$v2):$p=$this->people[$v2];?>
                <a href="/user/<?php echo $p['_id']?>" title="<?php echo $p['th']['first'].' '.$p['th']['last']?>"><img class="img-circle" src="https://f1.jarm.com/team/user/<?php echo $p['_id']?>-s.jpg" style="width:32px;"></a>
                <?php endforeach?>
              </td>
              <td class="w50">
                <a href="/withdraw/update/<?php echo $v['_id']?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="javascript:;" onclick="delc('<?php echo $v['_id']?>');" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
              </td>
            </tr>
            <?php endfor?>
          </tbody>
          <tfoot>
						<tr>
              <th class="w100">เวลา</th>
              <th>หัวข้อ</th>
              <th>ผู้เกี่ยวข้อง</th>
              <th class="w50">&nbsp;</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->
</div>
