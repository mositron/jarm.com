<h3 class="football-bar">ข่าวฟุตบอล รวมทุกลีกดัง</h3>

<div class="football-news">
<ul>
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li class="col-sm-3">
<a href="/football/news/<?php echo $v['_id']?>">
<img src="https://<?php echo $v['sv']?>.jarm.com/forum/<?php echo $v['fd']?>/s.jpg">
<p><img src="<?php echo FILES_CDN?>img/football/forum/<?php echo $v['c']?>.png" style="vertical-align:middle">  <?php echo $v['t']?></p>
<div>โพสเมื่อ: <?php echo self::Time()->from($v['da'],'date')?></div>
</a>
</li>
<?php endfor?>
</ul>
</div>



<div class="page-nav">
<?php if($this->page>1):?>
<a href="/football/news<?php echo $this->page>2?'/page-'.($this->page-1):''?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="/football/news/page-<?php echo $this->page+1?>">ถัดไป</a>
<?php endif?>
</div>
