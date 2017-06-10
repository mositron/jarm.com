
<ul class="home-list">
<li>
<a href="/sticker/recent">
<i class="icon icon-2"></i>
<h1>ล่าสุด</h1>
<h2>สติกเกอร์ทั้งหมดทุกประเภท <small>เรียงจากใหม่ล่าสุด</small></h2>
</a>
</li>
<li>
<a href="/sticker/ref/fb">
<i class="icon icon-3"></i>
<h1>Facebook</h1>
<h2>สติกเกอร์ฟรีจากเฟสบุ๊ค <small>Facebook</small></h2>
</a>
</li>
<li>
<a href="/sticker/ref/line">
<i class="icon icon-4"></i>
<h1>Line</h1>
<h2>สติกเกอร์ฟรีจากไลน์ <small>Line</small></h2>
</a>
</li>
<?php $i=0;foreach($this->cate as $k=>$v):?>
<li>
<a href="/sticker/category/<?php echo $k?>">
<i class="icon icon-<?php echo 5+$i?>"></i>
<h1>สติกเกอร์ <?php echo $v['t']?></h1>
<h2>สติกเกอร์เฉพาะหมวด <?php echo $v['t']?></h2>
</a>
</li>
<?php $i++;endforeach?>
<li>
<a href="/sticker/apps">
<i class="icon icon-1"></i>
<h1>แอพแนะนำ</h1>
<h2>แอพแนะนำอื่นๆที่น่าสนใจ</h2>
</a>
</li>
</ul>

