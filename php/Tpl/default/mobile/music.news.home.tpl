<div class="music-bar"><a href="/music">หน้าแรก</a> &raquo; <a href="/music/news">ข่าวเพลง</a></div>
<div class="music-news" style="padding-top:5px;">
<ul>
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li class="col-sm-3">
<a href="/music/news/<?php echo $v['_id']?>">
<img src="https://<?php echo $v['sv']?>.jarm.com/news/<?php echo $v['fd']?>/s.jpg">
<p><?php echo $v['t']?></p>
<div>โพสเมื่อ: <?php echo self::Time()->from($v['ds'],'date')?></div>
</a>
</li>
<?php endfor?>
</ul>
</div>


<div class="page-nav">
<?php if($this->page>1):?>
<a href="/music/news<?php echo ($this->page>2?'/page-'.($this->page-1):'')?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="/music/news/page-<?php echo $this->page+1?>">ถัดไป</a>
<?php endif?>
</div>
