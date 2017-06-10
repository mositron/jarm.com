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


<?php require(__CONF.'ads/ads.adsense.body2.php');?>

<div class="weather-list">
<?php foreach([3,1,2,4,5,6] as $i):?>
<h3 class="bar-heading">พยากรณ์อากาศ<?php echo $this->zone[$i]?> <small>สภาพอากาศ<?php echo $this->zone[$i]?></small></h3>
<div class="row">
<?php foreach($this->weather[$i] as $v):?>
<div class="col-sm-4 item l">
<a href="/place/<?php echo $v['_id']?>" target="_blank">
<i class="icn-wt icn-wt<?php echo $v['today']['icon']?>"></i>
<p class="i1"><?php echo $v['name']?></p>
<p class="i2"><?php echo $v['today']['t1']?$v['today']['t1'].' &deg;C':'-'?></p>
<p class="i3"><?php echo $v['today']['t5']?$v['today']['t5']:'<em>ไม่มีข้อมูล</em>'?></p>
</a>
</div>
<?php endforeach?>
</div>
<?php endforeach?>
</div>

<h3 style="border:1px solid #f0f0f0; border-radius:5px; color:#00ADEF; padding:5px; background:#f9f9f9">ความคิดเห็น</h3>
<div class="fb-comments" data-href="<?php echo self::uri(['weather','/'])?>" data-num-posts="20" data-width="629"></div>
