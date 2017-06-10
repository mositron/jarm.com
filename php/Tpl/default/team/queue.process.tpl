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
              <th>ทำงานเมื่อ</th>
							<th>รูปภาพ</th>
              <th>หัวข้อ</th>
              <th>ประเภท</th>
              <th style="width:150px;">ยังไม่เสร็จเพราะ</th>
            </tr>
          </thead>
          <tbody>
						<?php if(count($this->queue)>0):$time=strtotime(date('Y-m-d').' 00:00:00');?>
            <?php for($i=0;$i<count($this->queue);$i++):$v=$this->queue[$i];?>
            <tr>
              <td><span class="label label-primary"><?php echo self::Time()->from($v['ds1'],'datetime')?></span></td>
							<td><?php if($v['thumbnail']!='default'):?><div class="crop-img"><a href="/queue/<?php echo $v['_id']?>"><img src="https://f1.jarm.com/team/queue/<?php echo $v['_id']?>.jpg"></a></div><?php endif?></td>
							<td><a href="/queue/<?php echo $v['_id']?>"><?php echo $v['name']?></a></td>
              <td><a href="/queue/<?php echo $v['_id']?>"><?php echo $this->type[$v['type']]['display']?></a></td>
              <td>
								<?php if($v['team']):?>
									<i class="fa <?php echo $v['pt']['u']?'fa-check':'fa-refresh fa-spin'?>"></i> Team Photo<?php echo !$v['pt']['u']?'<span style="display:none"> wait</span>':''?> <br />
									<?php if($v['team']==4):?>
									<i class="fa <?php echo $v['pd']['u']?'fa-check':'fa-refresh fa-spin'?>"></i> Team VDO Editor<?php echo !$v['pd']['u']?'<span style="display:none"> wait</span>':''?> <br />
									<?php endif?>
									<i class="fa <?php echo $v['gp']['u']?'fa-check':'fa-refresh fa-spin'?>"></i> Team Graphic<?php echo !$v['gp']['u']?'<span style="display:none"> wait</span>':''?> <br />
									<i class="fa <?php echo $v['ct']['u']?'fa-check':'fa-refresh fa-spin'?>"></i> Team Content<?php echo !$v['ct']['u']?'<span style="display:none"> wait</span>':''?> <br />
								<?php else:?>
									<?php if($v['pt']['p']==1):?>
									<i class="fa <?php echo $v['pt']['u']?'fa-check':'fa-refresh fa-spin'?>"></i> Team Photo<?php echo !$v['pt']['u']?'<span style="display:none"> wait</span>':''?> <br />
									<?php endif?>
									<?php if($v['pd']['p']==1):?>
									<i class="fa <?php echo $v['pd']['u']?'fa-check':'fa-refresh fa-spin'?>"></i> Team VDO Editor<?php echo !$v['pd']['u']?'<span style="display:none"> wait</span>':''?> <br />
									<?php endif?>
									<?php if($v['gp']['p']==1):?>
									<i class="fa <?php echo $v['gp']['u']?'fa-check':'fa-refresh fa-spin'?>"></i> Team Graphic<?php echo !$v['gp']['u']?'<span style="display:none"> wait</span>':''?> <br />
									<?php endif?>
									<?php if($v['ct']['p']==1):?>
									<i class="fa <?php echo $v['ct']['u']?'fa-check':'fa-refresh fa-spin'?>"></i> Team Content<?php echo !$v['ct']['u']?'<span style="display:none"> wait</span>':''?> <br />
									<?php endif?>
								<?php endif?>
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
