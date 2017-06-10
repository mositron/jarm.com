<ul class="fbapp">
    <?php for($i=0;$i<count($this->app);$i++):?>
    <li>
    <a href="/guess/game/<?php echo $this->app[$i]['_id'].$this->cur?>">
    <?php if($this->app[$i]['img']):?><img src="https://s3.jarm.com/guess/<?php echo $this->app[$i]['fd']?>/s.jpg"><?php endif?>
    <div><small><?php echo $this->app[$i]['_id']?>.</small> <?php echo $this->app[$i]['t']?></div>
    <p><?php echo $this->cate[$this->app[$i]['c']]['t']?>, เล่น: <?php echo number_format(intval($this->app[$i]['do']))?> ครั้ง</p>
    </a>
    </li>
    <?php endfor?>
</ul>

<div class="page-nav">
<?php if($this->page>1):?>
<a href="/guess/hit<?php echo $this->page>2?'/page-'.($this->page-1):''?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="/guess/hit/page-<?php echo $this->page+1?>">ถัดไป</a>
<?php endif?>
</div>
