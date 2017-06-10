<h1 class="gold-h1">ราคาทองคำในประเทศไทย</h1>
<table class="gold-list">
<thead>
<tr>
<th class="l1">ชนิดทอง</th>
<th class="l2">รับซื้อบาทละ</th>
<th class="l3">ขายบาทละ</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->msg['thai']);$i++): $v=$this->msg['thai'][$i]?>
<tr>
<td class="l1"><?php echo $v[0]?></td>
<td class="l2"><?php echo $v[2]?></td>
<td class="l3"><?php echo $v[3]?></td>
</tr>
<?php endfor?>
</tbody>
</table>

<h1 class="gold-h1">ราคาทองคำในต่างประเทศ</h1>
<table class="gold-list">
<thead>
<tr>
<th class="l1">ทองคำ 99.99 และ 99.50%</th>
<th class="l2">ราคาเปิด</th>
<th class="l3">ราคาปิด</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->msg['other']);$i++): $v=$this->msg['other'][$i]?>
<tr>
<td class="l1"><?php echo $v[0]?></td>
<td class="l2"><?php echo $v[1]?></td>
<td class="l3"><?php echo $v[2]?></td>
</tr>
<?php endfor?>
</tbody>
</table>
