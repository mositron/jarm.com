<h3 class="saying-bar">มาใหม่</h3>

<ul class="saying-list">
    <?php for($i=0;$i<count($this->app);$i++):?>
    <li>
    <a href="/saying/view/<?php echo $this->app[$i]['_id'].$this->cur?>">
    <img src="https://s3.jarm.com/saying/cover/<?php echo $this->app[$i]['fd']?>/s.png">
    <div><?php echo $this->app[$i]['t']?></div>
    </a>
    </li>
    <?php endfor?>
</ul>

<div class="page-nav">
<?php if($this->page>1):?>
<a href="/saying/recent<?php echo $this->page>2?'/page-'.($this->page-1):''?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="/saying/recent/page-<?php echo $this->page+1?>">ถัดไป</a>
<?php endif?>
</div>