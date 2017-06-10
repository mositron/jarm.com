
<ul class="home-list">
<?php $i=0;foreach($this->cate as $k=>$v):?>
<li>
<a href="/saying/category/<?php echo $k?>">
<i class="icon icon-<?php echo 5+$i?>"></i>
<h1><?php echo $v['t']?></h1>
<h2>สติกเกอร์เฉพาะหมวด <?php echo $v['t']?></h2>
</a>
</li>
<?php $i++;endforeach?>
</ul>

