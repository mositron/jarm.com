<script>
function cdel(i){_.box.confirm({title:'ลบกลิตเตอร์',detail:'คุณต้องการลบกลิตเตอร์นี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delglitter',i)}});}
</script>
<style>
.gl-rec li span{display:block; margin:5px 0px; text-align:center;}
.gl-rec li p.p2{background:#fff;text-indent: 0px;text-align: center;}
</style>
<ul class="breadcrumb">
  <li><a href="/" title="กลิตเตอร์"><i class="icon-home"></i> กลิตเตอร์</a></li>
	<span class="divider">&raquo;</span>
   <li><a href="/manage">จัดการกลิตเตอร์ของคุณ</a></li>
</ul>

<div class="gl-new row clear-line">
<?php for($i=0;$i<count($this->last);$i++):?>
<div class="col-xs-6 col-sm-3 col-md-3">
<a href="/view/<?php echo $this->last[$i]['_id']?>">
<img src="http://<?php echo $this->last[$i]['sv']?>.jarm.com/glitter/<?php echo $this->last[$i]['fd']?>/t.<?php echo $this->last[$i]['ty']?>" class="img-responsive">
</a>
<p><?php echo $this->last[$i]['t']?></p>
</div>
<?php endfor?>
</div>

<style>
.gl-new div{text-align:center; margin-bottom:5px;}
.gl-new div > a{display: block;background: white;margin: 0px auto;line-height: 0px;padding: 0px;border: 1px solid #DDD;}
.gl-new div p{margin: 0px auto 0px auto;height: 20px;line-height: 20px;overflow: hidden;background: #DDD;border: 1px solid #DDD; text-shadow:1px 1px 0px #fff;white-space:nowrap; text-overflow:ellipsis; text-indent:5px;}
.gl-new div img{}
</style>
<div class="gl-new row clear-line">
<?php for($i=0;$i<count($this->glitter);$i++):?>
  <div class="col-xs-6 col-sm-3 col-md-3">
    <a href="/view/<?php echo $this->glitter[$i]['_id']?>">
    <img src="http://<?php echo $this->glitter[$i]['sv']?>.jarm.com/glitter/<?php echo $this->glitter[$i]['fd']?>/t.<?php echo $this->glitter[$i]['ty']?>" class="img-responsive">
    </a>
    <p style="margin-bottom:3px;"><?php echo $this->glitter[$i]['t']?></p>
    <span><a href="/update/<?php echo $this->glitter[$i]['_id']?>" class="btn btn-default btn-xs">แก้ไข</a> <a href="javascript:;" onClick="cdel(<?php echo $this->glitter[$i]['_id']?>)" class="btn btn-danger btn-xs">ลบ</a></span>
  </div>
<?php endfor?>
</div>



<div style="text-align:center"><?php echo $this->pager?></div>
