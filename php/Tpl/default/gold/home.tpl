<style>
.gold-list{border:none; padding:0px; margin:0px 0px 10px;border-collapse: separate;width: 100%;border-spacing: 1px; background:#ddd;}
.gold-list th{height:20px; line-height:20px; margin:0px; padding:0px; text-align:center; background:#f0f0f0}
.gold-list td{margin:0px; padding:0px;height: 38px;line-height: 38px;background: #f5f5f5;font-size: 18px;}
.gold-list tr:nth-child(odd) td{background:#fff;}
.gold-list .l1{width:40%; font-weight:bold; text-indent:10px;}
.gold-list .l2{width:30%; text-align:center;}
.gold-list .l3{width:30%; text-align:center}
</style>
<?php /*
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
*/ ?>

<h1 class="bar-heading">ราคาทองคำแท่ง ทองคำรูปพรรณ ล่าสุดวันนี้</h1>

<div style="text-align:center;margin:0px 0px 10px"><a href="https://play.google.com/store/apps/details?id=com.doodroid.gold" target="_blank" title="ราคาทองวันนี้"><img src="https://cdn.jarm.com/img/banner/gold-banner.gif" alt="ราคาทองวันนี้" class="img-responsive" style="margin:auto"></a></div>
<h3 class="bar-heading">ราคาทองคำในประเทศไทย</h3>
<table class="gold-list">
<thead>
<tr>
<th class="l1">ชนิดทอง</th>
<th class="l2">รับซื้อบาทละ</th>
<th class="l3">ขายบาทละ</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->msg['thai']);$i++): $v=$this->msg['thai'][$i]?>
<tr>
<td class="l1"><?php echo $v[0]?></td>
<td class="l2"><?php echo $v[2]?></td>
<td class="l3"><?php echo $v[3]?></td>
</tr>
<?php endfor?>
</tbody>
</table>

<?php require(__CONF.'ads/ads.dfp-12.php');?>

<?php /*
<?php if($this->_banner['d']):?>
<!-- BEGIN - BANNER : D -->
<div class="_banner _banner-d"><?php echo $this->_banner['d']?></div>
<!-- END - BANNER : D -->
<?php endif?>
<?php if($this->_banner['e']):?>
<!-- BEGIN - BANNER : E -->
<div class="_banner _banner-e"><?php echo $this->_banner['e']?></div>
<!-- END - BANNER : E -->
<?php endif?>
*/ ?>

<h3 class="bar-heading">ราคาทองคำในต่างประเทศ</h3>
<table class="gold-list">
<thead>
<tr>
<th class="l1">ทองคำ 99.99 และ 99.50%</th>
<th class="l2">ราคาเปิด</th>
<th class="l3">ราคาปิด</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->msg['other']);$i++): $v=$this->msg['other'][$i]?>
<tr>
<td class="l1"><?php echo $v[0]?></td>
<td class="l2"><?php echo $v[1]?></td>
<td class="l3"><?php echo $v[2]?></td>
</tr>
<?php endfor?>
</tbody>
</table>


<h3 class="bar-heading">กราฟราคาทองคำในต่างประเทศ</h3>
<p align="center"><img alt="" src="http://www.kitco.com/LFgif/au0030lns.gif"> <img alt="" src="http://www.kitco.com/LFgif/au0060lns.gif"></p>
<p align="center"><img alt="" src="http://www.kitco.com/LFgif/au0182nys.gif"> <img alt="" src="http://www.kitco.com/LFgif/au0365nys.gif"></p>
<p align="center"><img alt="" src="http://www.kitco.com/LFgif/au1825nys.gif"><img alt="" src="http://www.kitco.com/LFgif/au3650nys.gif"></p>

<?php require(__CONF.'ads/ads.dfp-34.php');?>

<div class="fb-comments" data-href="<?php echo self::uri(['gold','/'])?>" data-num-posts="50" data-width="720"></div>
