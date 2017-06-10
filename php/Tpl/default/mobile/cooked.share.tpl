<h3 class="cooked-bar">มีใครกินอะไรกันบ้าง</h3>
<ul class="share-list">
<?php for($i=0;$i<count($this->cooked);$i++):?>
<li>
<h4><img src="http://graph.facebook.com/<?php echo $this->cooked[$i]['ufb']?>/picture?type=square"> <?php echo $this->cooked[$i]['un']?></h4>
<div>
<span><?php echo self::Time()->from($this->cooked[$i]['da'],'datetime',1)?></span>
 : 
<strong><?php echo $this->cooked[$i]['cn']?></strong>
</div>
</li>
<?php endfor?>
</ul>