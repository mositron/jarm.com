<ul class="home-list">
<?php foreach($this->tv['home'] as $v):?>
<li>
<a href="/tv/play?t=<?php echo urlencode($v['t'])?>&im=<?php echo urlencode($v['i'])?>&file=<?php echo urlencode($v['f'])?>&swf=<?php echo urlencode($v['s'])?>">
<img src="<?php echo FILES_CDN?>img/tv/<?php echo $v['i']?>.jpg">
<h1><?php echo $v['t']?></h1>
<h2><?php echo $v['d']?></h2>
</a>
</li>
<?php endforeach?>
</ul>

