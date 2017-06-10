<h3 class="cooked-bar">แอพแนะนำ</h3>
<ul class="apps-list">
<?php foreach($this->apps as $k=>$v):?>
<li data-market="com.doodroid.<?php echo $k?>">
<a href="https://play.google.com/store/apps/details?id=com.doodroid.<?php echo $k?>" target="_blank">
<img src="<?php echo $v['i']?>">
<h1><?php echo $v['t']?></h1>
<h2><?php echo $v['d']?></h2>
</a>
</li>
<?php endforeach?>
</ul>