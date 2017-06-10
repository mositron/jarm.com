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

<ul class="breadcrumb">
    <li><a href="/" title="เกมทายใจ"><span class="glyphicon glyphicon-home"></span> เกมทายใจ</a></li>
    <span class="divider">&raquo;</span>
    <li><a href="/recent" title="เกมทายใจมาใหม่">มาใหม่</a></li>
</ul>

<h3 class="bar-heading"><a href="/recent">เกมส์ทายใจมาใหม่</a></h3>

<div style="text-align:center;padding:5px 0px"><a href="https://play.google.com/store/apps/details?id=com.doodroid.guess" title="เกมทายใจ ผ่านแอพ Android ฟรี" target="_blank"><img src="https://cdn.jarm.com/img/banner/guess-banner.gif" class="img-responsive"></a></div>

<div class="row news-left">
    <?php for($i=0;$i<count($this->app);$i++):$u=$this->user->get($this->app[$i]['u']);?>
    <div class="col-sm-6">
        <a href="/game/<?php echo $this->app[$i]['_id']?>" target="_blank">
            <img src="https://s3.jarm.com/guess/<?php echo $this->app[$i]['fd']?>/s.jpg" class="img-responsive">
            <p><?php echo $this->app[$i]['t']?><br>เล่น: <?php echo number_format(intval($this->app[$i]['do']))?>, โดย <?php echo $u['name']?><br><?php echo $this->app[$i]['d']?></p>
        </a>
    </div>
    <?php endfor?>
</div>

<div align="center"><?php echo $this->pager?></div>
