<h3 class="weather-bar">พยากรณ์อากาศ<?php echo $this->zone[$this->z]?></h3>
<div class="place-list">
<ul><?php foreach($this->weather as $v):?><li><a href="/weather/place/<?php echo $v['_id']?>"><strong><?php echo $v['name']?></strong><div><i class="icn-wt icn-wt<?php echo $v['today']['icon']?>"></i></div><p><?php echo $v['today']['t1']?$v['today']['t1'].' &deg;C':'-'?></p><?php echo $v['today']['t5']?$v['today']['t5']:'<em>ไม่มีข้อมูล</em>'?></a></li><?php endforeach?></ul>
</div>

