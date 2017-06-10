
<div class="_bs"><div style="margin:4px">ผลลัพธ์ <?php echo $this->count?> ห้อง (ห้องสาธารณะ)</div><p class="clear"></p></div>
<div id="tbresult">
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="table tbservice">
<thead>
<tr class="text-center">
<th>#</th>
<th>ชื่อห้อง</th>
<th>ผู้ใช้งาน</th>
<th>ใช้งานล่าสุด</th>
</tr>
</thead>
<tbody>   
<?php for($i=0;$i<count($this->chat);$i++):?>
<tr align="center" class="l<?php echo $i%2?>">
<td class="tab_id"><?php echo $this->chat[$i]['_id']?></td>
<td class="tab_name"><a href="/<?php echo $this->chat[$i]['l']?$this->chat[$i]['l']:'room/'.$this->chat[$i]['_id']?>" target="_blank"><?php echo $this->chat[$i]['n']?></a><br><p><?php echo $this->chat[$i]['w']?></p></td>
<td class="tab_published"><?php echo intval($this->chat[$i]['cu'])?> / <?php echo intval($this->chat[$i]['cv'])?></td>
<td class="tab_time"><?php echo self::Time()->from($this->chat[$i]['du'],'datetime')?></td>
   </tr>
<?php endfor?>
</tbody>
</table>
<div align="center"><?php echo $this->pager?></div>
</div>

