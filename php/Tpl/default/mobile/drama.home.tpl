<ul class="tv-list">
<?php foreach($this->tv as $v):?>
<li>
<a href="/drama/view/<?php echo $v['_id']?>">
<img src="<?php echo $v['img']?>">
<h1><?php echo $v['name']?></h1>
<h2><?php if($v['count']):?><?php echo $v['count']?> ตอน, ล่าสุด <?php echo self::Time()->from($v['last'],'date',1)?><?php else:?>เร็วๆนี้<?php endif?></h2>
</a>
</li>
<?php endforeach?>
</ul>

