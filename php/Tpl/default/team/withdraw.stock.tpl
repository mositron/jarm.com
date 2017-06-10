<style>
.w70{width:70px;text-align:right}
</style>
<script>
function delc(i){_.box.confirm({title:'ลบรายการเบิกเงินนี้',detail:'ต้องการลบรายการเบิกเงินนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delreport',i);}})}
</script>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/withdraw" title="">เบิกเงิน</a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/withdraw/<?php echo $this->page?>" title=""><?php echo $this->status_name[$this->page]?></a></li>
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
              <th style="width:50px">ID</th>
              <th class="tb-col-date">สร้างเมื่อ</th>
              <th style="width:70px">เบิกแบบ</th>
              <th style="width:70px">ประเภท</th>
              <th>ชื่อคิวงาน</th>
              <th class="tb-col-price">จำนวนเงิน</th>
	            <th class="w70"></th>
            </tr>
          </thead>
          <tbody>
						<?php if(count($this->withdraw)>0):?>
            <?php for($i=0;$i<count($this->withdraw);$i++):$v=$this->withdraw[$i];?>
            <tr>
							<td><a href="/withdraw/<?php echo $v['_id']?>"><?php echo $v['_id']?></a></td>
							<td class="tb-col-date"><a href="/withdraw/<?php echo $v['_id']?>"><?php echo self::Time()->from($v['da'],'date')?></a></td>
							<td><a href="/withdraw/<?php echo $v['_id']?>" class="label label-form-<?php echo $v['form']?>"><?php echo $this->form[$v['form']]['display']?></a></td>
							<td><a href="/withdraw/<?php echo $v['_id']?>" class="label label-type-<?php echo $v['type']?>"><?php echo $this->type[$v['type']]['display']?></a></td>
							<td><a href="/withdraw/<?php echo $v['_id']?>"><?php echo $this->product[$v['product']]['name']?></a></td>
							<td class="tb-col-price"><a href="/withdraw/<?php echo $v['_id']?>"><?php echo number_format(intval($v['price']['sum']),2)?></a></td>
              <td class="w70">
                <a href="/withdraw/update/<?php echo $v['_id']?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="javascript:;" onclick="delc('<?php echo $v['_id']?>');" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
              </td>
            </tr>
            <?php endfor?>
						<?php else:?>
						<tr><td colspan="7"><div style="text-align:center;padding:50px 0px;"><em>ยังไม่มีใบเบิก</em></div></td></tr>
						<?php endif?>
          </tbody>
        </table>
      </div>
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->
</div>
