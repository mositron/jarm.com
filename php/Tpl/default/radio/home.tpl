<style>
.rd div{background:#fff;text-align: center;padding: 10px 0px; border-radius:5px;}
.rd div > p{background: #EBF7F6;height: 24px;line-height: 24px;margin: 0px 10px;}
</style>


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


<div style="padding:10px"><strong>ฟังเพลง</strong> ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์ จากหลากหลายคลื่นทั่วไทย ฟังเพลงrock ฟังเพลงลูกทุ่ง ฟังเพลงสากล ฟังเพลงสบายๆ ครบทุกแนว ทุกค่ายเพลง ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไบน์กับ jarm radio</div>
<?php require(__CONF.'ads/ads.dfp-12.php');?>
<div class="row rd">
<?php $i=0;foreach($this->radio as $k=>$v):?>
<div class="col-xs-6 col-sm-4">
<a href="/<?php echo $v['l']?>" title="<?php echo $v['t']?> ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์ <?php echo $v['t']?>"><img src="<?php echo FILES_CDN?>img/radio/<?php echo $v['im']?>" alt="<?php echo $v['t']?>"></a>
<p><a href="/<?php echo $v['l']?>" title="<?php echo $v['t']?> ฟังเพลง ฟังวิทยุออนไลน์ ฟังเพลงออนไลน์ <?php echo $v['t']?>"><?php echo $v['t']?></a></p>
</div>
<?php if($i==5):?>
<div class="col-xs-12" style="text-align:center;padding:5px 0px"><a href="https://play.google.com/store/apps/details?id=com.doodroid.radio" title="ฟังวิทยุออนไลน์ ผ่านแอพ Android ฟรี" target="_blank"><img src="https://cdn.jarm.com/img/banner/radio-banner.gif" class="img-responsive"></a></div>
<?php endif?>
<?php $i++;endforeach?>
</div>

<?php require(__CONF.'ads/ads.dfp-34.php');?>

<div style="padding:10px">รวมคลื่นวิทยุสำหรับ<strong>ฟังเพลง</strong> ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์ จากหลายคลื่นวิทยุฮิตทั่วไทยไว้ให้คุณแล้วที่นี่ ทุกแนวเพลง ฟังเพลงอกหัก ฟังเพลงแอบรัก ฟังเพลงคิดถึง ได้ที่นี่กับ jarm radio</div>

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

<h3 class="bar-heading"><a href="<?php echo self::uri(['music','/list'])?>" title="ข่าวเพลง แวดวงเพลง" target="_blank">ข่าวเพลง</a> <small><a href="<?php echo self::uri(['music','/'])?>" title="เพลง เพลงใหม่ เนื้อเพลง" target="_blank">เพลง</a> ข่าวเพลง ข่าวเพลงใหม่ ข่าวเนื้อเพลงใหม่</small></h3>

<div class="row news-bottom">
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<div class="col-xs-6 col-sm-3">
<a href="<?php echo $v['link']?>" target="_blank">
<img src="<?php echo $v['img_s']?>" alt="<?php echo $v['title']?>" class="img-responsive">
<p><?php echo $v['title']?><?php echo $v['icon']?></p>
</a>
</div>
<?php endfor?>
</div>
