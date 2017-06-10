<h3 class="hidden-bar">คะแนนสะสม</h3>
<ul class="score-list">
<?php for($i=$this->user['lv']-1;$i>0;$i--):?>
<li>
Lv. <?php echo $i?> : <?php echo number_format($this->user['pass']['lv'.$i]['s'])?>
<a href="/hidden/game/<?php echo $this->user['_id']?>/<?php echo $i?>">เล่นใหม่</a>
</li>
<?php endfor?>
</ul>