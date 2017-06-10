<h3 class="cooked-bar">เมนูก่อนหน้านี้</h3>
<ul class="score-list">
<?php for($i=0;$i<count($this->cooked);$i++):?>
<li>
<span><?php echo self::Time()->from($this->cooked[$i]['da'],'datetime',1)?></span>
 : 
<strong><?php echo $this->cooked[$i]['cn']?></strong>
<!--a href="javascript:;">
<?php echo $this->cooked[$i]['t']?>
</a-->
</li>
<?php endfor?>
</ul>