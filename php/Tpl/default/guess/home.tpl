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

<style>
.nav-cate{margin:5px 8px;}
.nav-cate li{margin: 0px;width: 24.95%;float: left;border-bottom: 1px dashed #ddd;}
.nav-cate li a{padding:2px 0px 2px 5px;}
.nav-cate p{clear:both; margin:0px;}
</style>
<h3 class="bar-heading"><i></i> <a href="/hit">หมวดเกมทายใจ</a></h3>
<ul class="nav nav-cate">
<?php foreach($this->cate as $k=>$v):?>
<li><a href="/cate-<?php echo $k?>"><?php echo $v['t']?></a></li>
<?php endforeach?>
<p></p>
</ul>
<!--div style="padding:10px; border:1px solid #ccc; background:#f8f8f8; border-radius:5px; margin-bottom:5px;">
กิจกรรมสร้าง<a href="https://guess.jarm.com" target="_blank"><strong>เกมทายใจ</strong></a> แจกบ๊อกฟรี<br>
เพียงแค่.. สร้างเกมทายใจโดนๆของคุณเอง เกมไหนมีผู้เล่นเกิน 1,000 ครั้ง/เกม รับฟรีทันที <strong style="font-size:16px; color:#f00">1,000 บ๊อก</strong>..  ที่ <a href="https://guess.jarm.com" target="_blank">เกมทายใจ</a>
</div-->
<div style="text-align:center;padding:5px 0px"><a href="https://play.google.com/store/apps/details?id=com.doodroid.guess" title="เกมทายใจ ผ่านแอพ Android ฟรี" target="_blank"><img src="https://cdn.jarm.com/img/banner/guess-banner.gif" class="img-responsive"></a></div>

<?php require(__CONF.'ads/ads.adsense.body2.php');?>

<h3 class="bar-heading"><a href="/hit">เกมส์ทายใจยอดฮิต</a></h3>
<div class="row news-left2">
    <?php for($i=0;$i<count($this->app);$i++):$u=$this->user->get($this->app[$i]['u']);?>
    <div class="col-sm-6">
        <a href="/game/<?php echo $this->app[$i]['_id']?>" target="_blank">
            <img src="https://s3.jarm.com/guess/<?php echo $this->app[$i]['fd']?>/s.jpg" class="img-responsive">
            <p><?php echo $this->app[$i]['t']?><br>เล่น: <?php echo number_format(intval($this->app[$i]['do']))?>, โดย <?php echo $u['name']?><br><?php echo $this->app[$i]['d']?></p>
        </a>
    </div>
    <?php endfor?>
</ul>
<h3 class="bar-heading"><a href="/recent">เกมส์ทายใจมาใหม่</a> <small>(<a href="/recent">ทั้งหมด</a>)</small></h3>
<div class="row news-left2">
    <?php for($i=0;$i<count($this->appn);$i++):$u=$this->user->get($this->appn[$i]['u'])?>
    <div class="col-sm-6">
        <a href="/game/<?php echo $this->appn[$i]['_id']?>" target="_blank">
            <img src="https://s3.jarm.com/guess/<?php echo $this->appn[$i]['fd']?>/s.jpg" class="img-responsive">
            <p><?php echo $this->appn[$i]['t']?><br>เล่น: <?php echo number_format(intval($this->appn[$i]['do']))?>, โดย <?php echo $u['name']?><br><?php echo $this->appn[$i]['d']?></p>
        </a>
    </div>
    <?php endfor?>
</div>
