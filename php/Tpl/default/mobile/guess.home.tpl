


<ul class="home-list">
<li>
<a href="/guess/recent">
<i class="icon icon-1"></i>
<h1>ล่าสุด</h1>
<h2>เกมส์ทายใจทั้งหมด <small>เรียงจากใหม่ล่าสุด</small></h2>
</a>
</li>
<li>
<a href="/guess/hit">
<i class="icon icon-2"></i>
<h1>ยอดฮิต</h1>
<h2>เกมส์ทายใจทั้งหมด <small>เรียงจากผู้เล่นมากสุด</small></h2>
</a>
</li>
<?php foreach($this->cate as $k=>$v):?>
<li>
<a href="/guess/category/<?php echo $k?>">
<i class="icon icon-3"></i>
<h1>หมวด<?php echo $v['t']?></h1>
<h2>เกมส์ทายใจเฉพาะหมวด <?php echo $v['t']?> <small></small></h2>
</a>
</li>
<?php endforeach?>
<li>
<a href="/guess/apps">
<i class="icon icon-7"></i>
<h1>แอพแนะนำ</h1>
<h2>แอพแนะนำอื่นๆที่น่าสนใจ</h2>
</a>
</li>
</ul>

