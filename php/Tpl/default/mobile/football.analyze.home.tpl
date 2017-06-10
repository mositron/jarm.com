<h3 class="football-bar">วิเคราะห์บอล</h3>

<div class="football-analyze">
<ul>
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li>
<a href="/football/analyze/<?php echo $v['_id']?>"><?php echo $v['t']?></a>
</li>
<?php endfor?>
</ul>
</div>

<div class="page-nav">
<?php if($this->page>1):?>
<a href="/football/analyze<?php echo $this->page>2?'/page-'.($this->page-1):''?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="/football/analyze/page-<?php echo $this->page+1?>">ถัดไป</a>
<?php endif?>
</div>
