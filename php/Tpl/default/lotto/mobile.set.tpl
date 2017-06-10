<h3 class="lotto-bar">หวยหุ้น</h3>

<table class="lotto-set" width="100%" cellpadding="5" cellspacing="0" border="0">
<thead>
<tr>
<th rowspan="2" class="s">วันที่</th>
<th colspan="2" class="s">เปิดเช้า</th>
<th colspan="2" class="s">ปิดเที่ยง</th>
<th colspan="2" class="s">เปิดบ่าย</th>
<th colspan="2" class="s">ปิดเย็น</th>
</tr>
<tr>
<th class="p">บน</th>
<th class="p">ล่าง</th>
<th class="p">บน</th>
<th class="p">ล่าง</th>
<th class="p">บน</th>
<th class="p">ล่าง</th>
<th class="p">บน</th>
<th class="p">ล่าง</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->set);$i++):?>
<tr>
<td><?php echo self::Time()->from($this->set[$i]['tm'],'date')?></td>
<td><?php echo $this->set[$i]['t11']?></td>
<td><?php echo $this->set[$i]['t12']?></td>
<td><?php echo $this->set[$i]['t21']?></td>
<td><?php echo $this->set[$i]['t22']?></td>
<td><?php echo $this->set[$i]['t31']?></td>
<td><?php echo $this->set[$i]['t32']?></td>
<td><?php echo $this->set[$i]['t41']?></td>
<td><?php echo $this->set[$i]['t42']?></td>
</tr>
<?php endfor?>
</tbody>
</table>
