<h3 class="sticker-bar"><?php echo $this->ref[$this->app['ref']]['t']?> &raquo; <?php echo $this->app['t']?></h3>


<div class="sticker-list">
<?php if($this->icon):$i=0;?>
<?php foreach($this->icon as $icon):?>
<li>
<a href="https://s3.jarm.com/sticker/icon/<?php echo $icon['fd']?>/<?php echo $icon['gif']?$icon['gif']:$icon['png']?>" target="_blank"><img src="https://s3.jarm.com/sticker/icon/<?php echo $icon['fd']?>/<?php echo $icon['gif']?$icon['gif']:$icon['png']?>" class="prv-img"></a>
</li>
<?php endforeach?>
<?php endif?>
</div>






