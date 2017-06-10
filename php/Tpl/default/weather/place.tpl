<?php if($this->_banner['b']):?>
<!-- BEGIN - BANNER : B -->
<div class="_banner _banner-b"><?php echo $this->_banner['b']?></div>
<!-- END - BANNER : B -->
<?php endif?>
<?php if($this->_banner['c']):?>
<!-- BEGIN - BANNER : C -->
<div class="_banner _banner-c"><?php echo $this->_banner['c']?></div>
<!-- END - BANNER : C -->
<?php endif?>


<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/">พยากรณ์อากาศ</a></li>
  <li class="active"><?php echo $this->weather['name']?></li>
</ul>

<h3 style="height: 34px;line-height: 34px;padding: 0px 10px;background: #f0f0f0;margin: 0px 0px 5px;">สภาพอากาศ<?php echo $this->weather['name']?> <?php echo $this->weather['en']?'('.$this->weather['en'].')':''?></h3>
<?php if($this->weather['loc']):?>
<div id="maps" style="height:200px; margin-bottom:10px;"></div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=weather&key=AIzaSyDQZHGHwvvv3k3-NfgzOla9qBBOp6i72JI"></script>
<script type="text/javascript">
$(window).load(
function(){
  var mapOptions = {
    zoom: 10,
    center: new google.maps.LatLng(<?php echo $this->weather['loc'][0]?>,<?php echo $this->weather['loc'][1]?>),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var map = new google.maps.Map(document.getElementById('maps'),mapOptions);

  var weatherLayer = new google.maps.weather.WeatherLayer({
    temperatureUnits: google.maps.weather.TemperatureUnit.CELSIUS
  });
  weatherLayer.setMap(map);

  var cloudLayer = new google.maps.weather.CloudLayer();
  cloudLayer.setMap(map);
});
</script>
<?php endif?>


<?php require(__CONF.'ads/ads.adsense.body2.php');?>


<div style="padding:5px 10px">อุณหภูมิ: <strong><?php echo $this->weather['today']['t1']?></strong> (ข้อมูลจากกรมอุตุนิยมวิทยา)</div>
<table class="table" width="100%">
<tbody>
<tr><td>จุดน้ำค้าง</td><td><?php echo $this->weather['today']['t2']?$this->weather['today']['t2'].' &deg;C':'-'?></td></tr>
<tr><td>ความชื้นสัมพัทธ์</td><td><?php echo $this->weather['today']['t3']?$this->weather['today']['t3']:'<em>ไม่มีข้อมูล</em>'?></td></tr>
<tr><td>ลม</td><td><?php echo $this->weather['today']['t4']?$this->weather['today']['t4']:'<em>ไม่มีข้อมูล</em>'?></td></tr>
<tr><td>เมฆ</td><td><?php echo $this->weather['today']['t5']?$this->weather['today']['t5']:'<em>ไม่มีข้อมูล</em>'?></td></tr>
<tr><td>ทัศนวิสัย</td><td><?php echo $this->weather['today']['t6']?$this->weather['today']['t6']:'<em>ไม่มีข้อมูล</em>'?></td></tr>
<tr><td>ความกดอากาศ</td><td><?php echo $this->weather['today']['t7']?$this->weather['today']['t7']:'<em>ไม่มีข้อมูล</em>'?></td></tr>
<tr><td>ฝน 3 ชม.</td><td><?php echo $this->weather['today']['t8']?$this->weather['today']['t8']:'<em>ไม่มีข้อมูล</em>'?></td></tr>
<tr><td>พระอาทิตย์ขึ้นเช้าพรุ่งนี้</td><td><?php echo $this->weather['today']['t9']?$this->weather['today']['t9']:'<em>ไม่มีข้อมูล</em>'?></td></tr>
<tr><td>พระอาทิตย์ตกเย็นวันนี้</td><td><?php echo $this->weather['today']['t10']?$this->weather['today']['t10']:'<em>ไม่มีข้อมูล</em>'?></td></tr>
<tr><td>อุณหภูมิสูงสุดวานนี้</td><td><?php echo $this->weather['today']['t11']?$this->weather['today']['t11'].' &deg;C':'-'?></td></tr>
<tr><td>อุณหภูมิต่ำสุดเช้าวันนี้</td><td><?php echo $this->weather['today']['t12']?$this->weather['today']['t12'].' &deg;C':'-'?></td></tr>
<tr><td>ฝนสะสมวันนี้</td><td><?php echo $this->weather['today']['t13']?$this->weather['today']['t13']:'<em>ไม่มีข้อมูล</em>'?></td></tr>
</tbody></table>

<?php if($this->weather['list']):?>
<h4 style="height: 30px;line-height: 30px;padding: 0px 10px;background: #f0f0f0;margin: 0px;">พยากรณ์อากาศ<?php echo $this->weather['name']?> <?php echo $this->weather['en']?'('.$this->weather['en'].')':''?> วันนี้, พรุ่งนี้ และภายใน 10 วันของหน้า</h4>

<table class="table tbweather" width="100%">
<thead>
<tr>
<th>วัน</th>
<th>เช้า</th>
<th>กลางวัน</th>
<th>เย็น</th>
<th>กลางคืน</th>
<th>อุณหภูมิเฉลี่ย</th>
<th>สภาพอากาศ</th>
</tr>
</thead>
<tbody>
<?php foreach($this->weather['list'] as $v):?>
<tr>
<td><?php echo self::Time()->from($v['dt'],'date')?></td>
<td><?php echo $v['temp']['morn']?> &deg;C</td>
<td><?php echo $v['temp']['day']?> &deg;C</td>
<td><?php echo $v['temp']['eve']?> &deg;C</td>
<td><?php echo $v['temp']['night']?> &deg;C</td>
<td><?php echo $v['temp']['min']?> - <?php echo $v['temp']['max']?> &deg;C</td>
<td><i class="icn-wt icn-wt<?php echo $v['icon']?>" title="<?php echo $v['weather']['main']?> - <?php echo $v['weather']['description']?>"></i></td>
</tr>
<?php endforeach?>
</tbody>
</table>
<?php endif?>


<h3 style="border:1px solid #f0f0f0; border-radius:5px; color:#00ADEF; padding:5px; background:#f9f9f9">ความคิดเห็น</h3>
<div class="fb-comments" data-href="https://weather.jarm.com/place/<?php echo $this->weather['_id']?>" data-num-posts="50" data-width="629"></div>
