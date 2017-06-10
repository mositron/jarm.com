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
    <li><a href="/hit" title="เกมทายใจยอดฮิต">ยอดฮิต</a></li>
</ul>


<h4 class="ht"><i></i> เกมส์ทายใจยอดฮิต</h4>
<ul class="thumbnails row-count-2 fbapp">
    <?php for($i=0;$i<count($this->app);$i++):$u=$this->user->get($this->app[$i]['u']);?>
    <li class="col-sm-6">
    <a href="/game/<?php echo $this->app[$i]['_id']?>" target="_blank">
    <img src="https://s4.jarm.com/guess/<?php echo $this->app[$i]['fd']?>/s.jpg">
    <div><?php echo $this->app[$i]['t']?></div>
    <p class="do">เล่น: <?php echo number_format(intval($this->app[$i]['do']))?>, โดย <?php echo $u['name']?></p>
    <p class="de"><?php echo $this->app[$i]['d']?></p>
    </a>
    </li>
    <?php endfor?>
</ul>
<div align="center"><?php echo $this->pager?></div>

