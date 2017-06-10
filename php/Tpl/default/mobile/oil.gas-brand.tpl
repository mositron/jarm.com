<h3 class="oil-bar">ราคาน้ำมัน <small>- ปั๊ม/ยี่ห้อ</small></h3>
<ul class="gas-type-list gas-brand-list">
<?php for($j=0;$j<count($this->brand_gas);$j++):?>
<li>
<h1><i class="icon icon-g-<?php echo $j?>"></i><?php echo $this->brand_gas[$j]?></h1>
<table>
<thead>
<tr>
<th class="l1">ประเภท</th>
<th class="l2">บาท/ลิตร</th>
<th class="l3">อัพเดทล่าสุด</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->type_gas);$i++): $v=$this->msg['oil'][$i][$j+1]; if(!$v || $v=='-')continue;?>
<tr>
<td class="l1"><?php echo $this->type_gas[$i]?></td>
<td class="l2"><?php echo $v?></td>
<td class="l3"><?php echo mb_substr(self::Time()->from($this->msg['oil'][7][$j+1],'date'),0,-5)?></td>
</tr>
<?php endfor?>
</tbody>
</table>
</li>
<?php endfor?>

</ul>
