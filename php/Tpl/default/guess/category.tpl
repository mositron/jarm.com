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
    <li><a href="/cate-<?php echo $this->c?>" title="เกมทายใจ<?php echo $this->cate[$this->c]['t']?>"><?php echo $this->cate[$this->c]['t']?></a></li>
</ul>

<h4 class="bar-heading"><i></i>เกมส์ทายใจ ประเภท<?php echo $this->cate[$this->c]['t']?></h4>
<div class="row news-left">
    <?php for($i=0;$i<count($this->app);$i++):$u=$this->user->get($this->app[$i]['u']);?>
    <div class="col-sm-6">
        <a href="/game/<?php echo $this->app[$i]['_id']?>" target="_blank">
            <img src="https://s4.jarm.com/guess/<?php echo $this->app[$i]['fd']?>/s.jpg">
            <p><?php echo $this->app[$i]['t']?><br>เล่น: <?php echo number_format(intval($this->app[$i]['do']))?>, โดย <?php echo $u['name']?><br><?php echo $this->app[$i]['d']?></p>
        </a>
    </div>
    <?php endfor?>
</div>

<div align="center"><?php echo $this->pager?></div>
