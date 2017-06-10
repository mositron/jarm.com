
<ul class="breadcrumb">
    <li><a href="/" title="สติกเกอร์"><span class="glyphicon glyphicon-home"></span> สติกเกอร์</a></li>
    <span class="divider">&raquo;</span>
    <li><a href="/cate-<?php echo $this->c?>" title="สติกเกอร์<?php echo $this->cate[$this->c]['t']?>"><?php echo $this->cate[$this->c]['t']?></a></li>
</ul>

<h4 class="ht"><i></i>สติกเกอร์ ประเภท<?php echo $this->cate[$this->c]['t']?></h4>
<ul class="thumbnails row-count-2 fbapp">
    <?php for($i=0;$i<count($this->app);$i++):$u=$this->user->get($this->app[$i]['u']);?>
    <li class="col-sm-6">
    <a href="/view/<?php echo $this->app[$i]['_id']?>" target="_blank">
    <img src="<?php echo self::uri(['s3','/sticker/'.$this->app[$i]['fd'].'/s.jpg'])?>">
    <div><?php echo $this->app[$i]['t']?></div>
    <p class="do">เล่น: <?php echo number_format(intval($this->app[$i]['do']))?>, โดย <?php echo $u['name']?></p>
    <p class="de"><?php echo $this->app[$i]['d']?></p>
    </a>
    </li>
    <?php endfor?>
</ul>

<div align="center"><?php echo $this->pager?></div>
