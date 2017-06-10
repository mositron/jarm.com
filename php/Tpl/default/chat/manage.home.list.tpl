
<div class="_bs"><div style="margin:4px">ผลลัพธ์ <?php echo $this->count?> รายการ</div><p class="clear"></p></div>
<div id="tbresult">
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="table tbservice">
<thead>
<tr class="text-center">
<th>#</th>
<th>ชื่อห้อง</th>
<th>เผยแพร่</th>
<th>สร้างเมื่อ</th>
<th width="100"></th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->chat);$i++):?>
<tr align="center" class="l<?php echo $i%2?>">
<td class="tab_id"><?php echo $this->chat[$i]['_id']?></td>
<td class="tab_name"><a href="/room/<?php echo $this->chat[$i]['_id']?>" target="_blank"><?php echo $this->chat[$i]['n']?></a></td>
<td class="tab_published"><?php echo $this->chat[$i]['pl']?'สาธารณะ':'ส่วนตัว'?></td>
<td class="tab_time"><?php echo self::Time()->from($this->chat[$i]['da'],'datetime')?></td>
 <td class="text-center">
 <a href="<?php echo $this->chat[$i]['l']?$this->chat[$i]['l']:'/room/'.$this->chat[$i]['_id']?>" target="_blank"><img src="<?php echo FILES_CDN?>img/global/view.gif" alt="ไปยังห้องแชท"></a>
    	<a href="/manage/<?php echo $this->chat[$i]['_id']?>" class="h"><img src="<?php echo FILES_CDN?>img/global/edit.gif" alt="แก้ไขข้อมูลเบื้องต้น"></a>
      <a href="javascript:;" onClick="adel(<?php echo $this->chat[$i]['_id']?>)"><img src="<?php echo FILES_CDN?>img/global/del.gif" alt="ลบ"></a>
     </td>
   </tr>
<?php endfor?>
<?php if(!count($this->chat)):?>
<tr><td colspan="<?php echo count($this->allorder)+1?>" valign="middle" height="200" class="text-center"><div style="text-align:center"><span style="color:#ddd; font-size:30px; letter-spacing:5px">- ไม่มีข้อมูล -</span></div></td></tr>
<?php endif?>
</tbody>
</table>
<div align="center"><?php echo $this->pager?></div>
</div>
