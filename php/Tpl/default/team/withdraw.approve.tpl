<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/withdraw" title="">เบิกเงิน</a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/withdraw/<?php echo $this->page?>" title=""><?php echo $this->status_name[$this->page]?></a></li>
</ul>
<div class="box-white">
  <div class="nav-tabs-custom">
    <div class="tab-content">
      <div class="text-left">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th style="width:50px">ID</th>
              <th class="tb-col-date">ตรวจเมื่อ</th>
              <th style="width:70px">เบิกแบบ</th>
              <th style="width:70px">ประเภท</th>
              <th>ชื่อคิวงาน</th>
              <th class="tb-col-price">จำนวนเงิน</th>
	            <th style="width:100px">โดย</th>
            </tr>
          </thead>
          <tbody>
            <?php $sum=0;for($i=0;$i<count($this->withdraw);$i++):$v=$this->withdraw[$i];?>
            <tr>
							<td><a href="/withdraw/<?php echo $v['_id']?>"><?php echo $v['_id']?></a></td>
							<td class="tb-col-date"><a href="/withdraw/<?php echo $v['_id']?>"><?php echo self::Time()->from($v['status3']['d'],'date')?></a></td>
							<td><a href="/withdraw/<?php echo $v['_id']?>" class="label label-form-<?php echo $v['form']?>"><?php echo $this->form[$v['form']]['display']?></a></td>
							<td><a href="/withdraw/<?php echo $v['_id']?>" class="label label-type-<?php echo $v['type']?>"><?php echo $this->type[$v['type']]['display']?></a></td>
							<td><a href="/withdraw/<?php echo $v['_id']?>"><?php echo $this->product[$v['product']]['name']?></a></td>
							<td class="tb-col-price"><a href="/withdraw/<?php echo $v['_id']?>"><?php echo number_format($price=intval($v['price']['sum']),2);$sum+=$price?></a></td>
							<td>
								<?php $u=team::user()->get($v['status3']['u'],true);?><a href="/user/<?php echo $u['_id']?>"><img src="<?php echo $u['img']?>" class="img-circle" style="width:32px;height:32px;" /></a>
								<?php $u=team::user()->get($v['u'],true);?><a href="/user/<?php echo $u['_id']?>"><img src="<?php echo $u['img']?>" class="img-circle" style="width:32px;height:32px;" /></a>
							</td>
            </tr>
            <?php endfor?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6"><div class="text-right"><span style="display:inline-block;margin-right:20px;">รวมเป็นเงินทั้งหมด:</span> <span style="font-size:28px;"><?php echo number_format($sum,2)?></span></div></td>
							<td></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->
</div>
