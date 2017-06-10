<h3 class="weather-bar">ข่าวเพลง ข่าวในวงการเพลง</h3>
<div class="weather-news" style="padding-top:5px;">
<ul>
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li class="col-sm-3">
<a href="/weather/news/<?php echo $v['_id']?>">
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
<a href="/<?php echo $url.($this->page>2?'/page-'.($this->page-1):'')?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="<?php echo $url.'/page-'.($this->page+1)?>">ถัดไป</a>
<?php endif?>
</div>
