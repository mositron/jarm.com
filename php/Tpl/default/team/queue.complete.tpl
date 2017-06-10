<style>
.w70{width:70px;text-align:right}
.crop-img{width:80px;height:45px;overflow:hidden;}
.crop-img img{width:80px;}
</style>
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
              <th>เสร็จเมื่อ</th>
              <th>หัวข้อ</th>
              <th>ประเภท</th>
            </tr>
          </thead>
          <tbody>
						<?php if(count($this->queue)>0):?>
            <?php for($i=0;$i<count($this->queue);$i++):$v=$this->queue[$i];?>
            <tr>
              <td><span class="label label-primary"><?php echo self::Time()->from($v['dpc'],'datetime')?></span></td>
							<td><a href="/queue/<?php echo $v['_id']?>"><?php echo $v['name']?></a></td>
              <td><a href="/queue/<?php echo $v['_id']?>"><?php echo $this->type[$v['type']]['display']?></a></td>
            </tr>
            <?php endfor?>
						<?php endif?>
          </tbody>
        </table>
      </div>
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->
</div>
