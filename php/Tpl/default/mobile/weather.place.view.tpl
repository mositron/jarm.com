<h3 class="weather-bar">พยากรณ์อากาศ <?php echo $this->weather['name']?></h3>

<h3 style="height: 34px;line-height: 34px;padding: 0px 10px;background: #f0f0f0;margin: 0px 0px 5px;">สภาพอากาศ<?php echo $this->weather['name']?> <?php echo $this->weather['en']?'('.$this->weather['en'].')':''?></h3>

<div style="padding:5px 10px">อุณหภูมิ: <strong><?php echo $this->weather['today']['t1']?></strong> (ข้อมูลจากกรมอุตุนิยมวิทยา)</div>
<table class="weather-table">
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
<h4 style="height: 30px;line-height: 30px;padding: 0px 10px;background: #f0f0f0;margin: 0px;">พยากรณ์อากาศภายใน 10 วัน</h4>

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
