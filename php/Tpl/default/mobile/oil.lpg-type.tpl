<h3 class="oil-bar">ราคา LPG <small>- จำนวน/ความจุ</small></h3>
<ul class="gas-type-list">
<?php for($i=0;$i<count($this->type_lpg);$i++):?>
<li>
<h1><?php echo $this->type_lpg[$i]?></h1>
<table>
<thead>
<tr>
<th class="l1">ยี่ห้อ</th>
<th class="l2">ราคาบาท/ถัง</th>
<th class="l3">อัพเดทล่าสุด</th>
</tr>
</thead>
<tbody>
<?php for($j=0;$j<count($this->brand_lpg);$j++): $v=trim($this->msg['lpg'][$i][$j+1]); if((!$v) || $v=='-' || $v==" ")continue;?>
<tr>
<td class="l1"><i class="icon icon-l-<?php echo $j?>"></i><?php echo $this->brand_lpg[$j]?></td>
<td class="l2"><?php echo $v?></td>
<td class="l3"><?php echo self::Time()->from($this->msg['lpg'][6][$j+1],'date')?></td>
</tr>
<?php endfor?>
</tbody>
</table>
</li>
<?php endfor?>
</ul>

