<h3 class="oil-bar">ราคา NGV</h3>
<ul class="gas-type-list gas-brand-list">
<li>
<h1><i class="icon icon-n-0"></i> ราคาล่าสุด</h1>
<table>
<thead>
<tr>
<th class="l1">อัพเดทเมื่อ</th>
<th class="l2">ราคาบาท/กิโลกรัม</th>
<th class="l3">การเปลี่ยนแปลง</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->msg['ngv']);$i++):?>
<tr>
<td class="l1"><?php echo self::Time()->from($this->msg['ngv'][$i][0],'date')?></td>
<td class="l2"><?php echo $this->msg['ngv'][$i][1]?></td>
<td class="l3"><?php echo $this->msg['ngv'][$i][2]?></td>
</tr>
<?php endfor?>
</tbody>
</table>
</li>
</ul>

