<h3 class="saying-bar"><?php echo $this->ref[$this->app['ref']]['t']?> &raquo; <?php echo $this->app['t']?></h3>


<div class="saying-list">
<?php if($this->icon):$i=0;?>
<?php foreach($this->icon as $icon):?>
<li>
<a href="https://s3.jarm.com/saying/icon/<?php echo $icon['fd']?>/<?php echo $icon['gif']?$icon['gif']:$icon['png']?>" target="_blank"><img src="https://s3.jarm.com/saying/icon/<?php echo $icon['fd']?>/<?php echo $icon['gif']?$icon['gif']:$icon['png']?>" class="prv-img"></a>
</li>
<?php endforeach?>
<?php endif?>
</div>






