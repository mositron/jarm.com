<?php if($this->_banner['b']):?>
<!-- BEGIN - BANNER : B -->
<div class="_banner _banner-b"><?php echo $this->_banner['b']?></div>
<!-- END - BANNER : B -->
<?php endif?>
<?php if($this->_banner['c']):?>
<!-- BEGIN - BANNER : C -->
<div class="_banner _banner-c"><?php echo $this->_banner['c']?></div>
<!-- END - BANNER : C -->
<?php endif?>

<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="ตรวจหวย"><span class="glyphicon glyphicon-home"></span> ตรวจหวย</a></li>
<span class="divider">&raquo;</span>
<li class="active"><a href="/list" title="ตรวจหวยย้อนหลัง"><span class="glyphicon glyphicon-list"></span> ตรวจหวยย้อนหลัง</a></li>
</ul>

<h3 style="border:1px solid #f0f0f0; border-radius:5px; color:#00ADEF; padding:5px; margin-bottom:5px">ตรวจหวย สลากกินแบ่งรัฐบาลย้อนหลัง</h3>
<div class="lotto-list">
<?php for($i=0;$i<count($this->lotto);$i++):?>
<h4> + <a href="/view/<?php echo $this->lotto[$i]['_id']?>">ตรวจหวย งวดวันที่ <?php echo self::Time()->from($this->lotto[$i]['tm'],'date')?></a></h4>
<table class="table lotto">
<tbody>
<tr>
<td>
<strong>รางวัลที่ 1</strong>
<div class="n1"><span><?php echo $this->lotto[$i]['a1']?></span></div>
<p>รางวัลละ 2,000,000 บาท</p>
</td>
<td>
<strong>เลขหน้า 3 ตัว</strong>
<div class="n1"><span><?php echo implode('</span><span>',(array)$this->lotto[$i]['f3'])?></span></div>
<p>รางวัลละ 2,000 บาท</p>
</td>
<td>
<strong>เลขท้าย 3 ตัว</strong>
<div class="n1"><span><?php echo implode('</span><span>',$this->lotto[$i]['l3'])?></span></div>
<p>รางวัลละ 2,000 บาท</p>
</td>
<td>
<strong>เลขท้าย 2 ตัว</strong>
<div class="n1"><span><?php echo $this->lotto[$i]['l2']?></span></div>
<p>รางวัลละ 1,000 บาท</p>
</td>
</tr>
</table>
<?php if($i==2):?>
  <div style="text-align:center;padding:5px 0px"><a href="https://play.google.com/store/apps/details?id=com.doodroid.lotto" title="ตรวจหวย ผ่านแอพ Android ฟรี" target="_blank"><img src="https://cdn.jarm.com/img/banner/lotto-banner.gif" class="img-responsive"></a></div>
<?php elseif($i==10):?>
<?php endif?>
<?php endfor?>
</div>
<div style="text-align:center"><?php echo $this->pager?></div>
