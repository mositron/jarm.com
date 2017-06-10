<h3 class="oil-bar">ราคา LPG <small>- ปั๊ม/ยี่ห้อ</small></h3>
<ul class="gas-type-list gas-brand-list">
<?php for($j=0;$j<count($this->brand_lpg);$j++):?>
<li>
<h1><i class="icon icon-g-<?php echo $j?>"></i><?php echo $this->brand_lpg[$j]?></h1>
<table>
<thead>
<tr>
<th class="l1">ความจุ</th>
<th class="l2">ราคาบาท/ถัง</th>
<th class="l3">อัพเดทล่าสุด</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->type_lpg);$i++): $v=trim($this->msg['lpg'][$i][$j+1]); if(!$v || $v=='-')continue;?>
<tr>
<td class="l1"><?php echo $this->type_lpg[$i]?></td>
<td class="l2"><?php echo $v?></td>
<td class="l3"><?php echo self::Time()->from($this->msg['lpg'][6][$j+1],'date')?></td>
</tr>
<?php endfor?>
</tbody>
</table>
</li>
<?php endfor?>

</ul>

