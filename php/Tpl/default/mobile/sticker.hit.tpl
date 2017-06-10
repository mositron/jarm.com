<h3 class="sticker-bar">ยอดฮิต</h3>

<ul class="fbapp">
    <?php for($i=0;$i<count($this->app);$i++):$u=$this->user->get($this->app[$i]['u']);?>
    <li>
    <a href="/sticker/view/<?php echo $this->app[$i]['_id'].$this->cur?>">
    <img src="https://s3.jarm.com/sticker/<?php echo $this->app[$i]['fd']?>/s.jpg">
    <div><?php echo $this->app[$i]['t']?></div>
    <p>เล่น: <?php echo number_format(intval($this->app[$i]['do']))?>, โดย <?php echo $u['name']?></p>
    </a>
    </li>
    <?php endfor?>
</ul>

<div class="page-nav">
<?php if($this->page>1):?>
<a href="/sticker/hit<?php echo $this->page>2?'/page-'.($this->page-1):''?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="/sticker/hit/page-<?php echo $this->page+1?>">ถัดไป</a>
<?php endif?>
</div>