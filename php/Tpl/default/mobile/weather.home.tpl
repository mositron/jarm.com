
<h3 class="hd-a"><a href="/weather/news" title="">ข่าวพยากรณ์อากาศ</a> <small> ข่าวเตือนภัย</small></h3>

<div class="weather-news">
<ul>
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<li class="col-sm-3">
<a href="/weather/news/<?php echo $v['_id']?>">
<img src="https://<?php echo $v['sv']?>.jarm.com/news/<?php echo $v['fd']?>/s.jpg" style="width:70px">
<p><?php echo $v['t']?></p>
</a>
</li>
<?php endfor?>
</ul>
</div>

<h3 class="hd-a">สภาพอากาศแยกตามภูมิประเทศ</h3>
<ul class="home-list">
<li><a href="/weather/place/z-3"><i class="icon icon-2"></i><h1>ภาคกลาง</h1><h2></h2></a></li>
<li><a href="/weather/place/z-1"><i class="icon icon-3"></i><h1>ภาคเหนือ</h1><h2></h2></a></li>
<li><a href="/weather/place/z-2"><i class="icon icon-4"></i><h1>ภาคตะวันออกเฉียงเหนือ</h1><h2></h2></a></li>
<li><a href="/weather/place/z-4"><i class="icon icon-5"></i><h1>ภาคตะวันออก</h1><h2></h2></a></li>
<li><a href="/weather/place/z-5"><i class="icon icon-6"></i><h1>ภาคใต้ฝั่งตะวันออก</h1><h2></h2></a></li>
<li><a href="/weather/place/z-6"><i class="icon icon-7"></i><h1>ภาคใต้ฝั่งตะวันตก</h1><h2></h2></a></li>
</ul>
