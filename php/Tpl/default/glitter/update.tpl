<script>
var cate=<?php echo json_encode($this->cate)?>;
function ccate(e){var v=$(e).val(),d='<option value="">เลือกรายการ</option>';if(v){if(cate[v]){for(var i=0;i<cate[v].l.length;i++)d+='<option value="'+cate[v].l[i]['_id']+'">'+cate[v].l[i]['t']+'</option>'}};$('select[name=catesub]').html(d);}
</script>


<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="กลิตเตอร์ Glitter"><i class="icon-home"></i> กลิตเตอร์</a></li>
 <li><span class="divider">&raquo;</span> <a href="/manage" title="จัดการประกาศของคุณ">จัดการกลิตเตอร์ของคุณ</a></li>
 <li><span class="divider">&raquo;</span> แก้ไขกลิตเตอร์</li>
 </ul>
 <div style="padding:5px; background:#fff;">
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขกลิตเตอร์</h2>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" onSubmit="_.ajax.gourl('<?php echo URL?>','updateglitter',this);return false;" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group<?php if($this->error['cate']):?> error<?php endif?>">
<label class="control-label" for="input02">ประเภทกิลเตอร์:</label>
<div class="controls">
<?php
$c = 0;
foreach($this->cate as $k=>$v):
	if($v['l']):
		if($c) echo '</div>';
		$c=$k;
?>
<h4 style="margin:5px 0px 5px 0px"><?php echo $v['t']?></h4>
<div style="border-bottom:1px dashed #ccc; padding:0px 5px 5px">
<?php continue;endif?>
<label style="display:inline-block; width:120px; height:20px; line-height:20px;"><input type="checkbox" name="cate" value="<?php echo $k?>"<?php echo in_array($k,(array)$this->glitter['c'])?' checked':''?>> <?php echo $v['t']?></label>
<?php endforeach?>
</div>
<p class="help-inline">* บังคับเลือก อย่องน้อย 1 ประเภท</p>
</div>
</div>
 <div class="control-group">
<label class="control-label" for="input09">ข้อความในรูปภาพ:</label>
<div class="controls">
<textarea id="input09" style="height:60px;" class="form-control" name="detail" maxlength="1000" minlength="10" required><?php echo $this->glitter['t']?></textarea>
<p class="help-block">* บังคับกรอก,  ข้อความในรูปภาพ หรืออธิบายเกี่ยวกับรูปภาพ (อย่างน้อย 10 ตัวอักษร)</p>
</div>
</div>
 <div class="control-group">
<label class="control-label">รูปภาพ:</label>
<div class="controls">
<img src="http://<?php echo $this->glitter['sv']?>.jarm.com/glitter/<?php echo $this->glitter['fd']?>/l.<?php echo $this->glitter['ty']?><?php echo $_SERVER['QUERY_STRING']=='updated'?'?'.rand(1,999):''?>">

<?php if(self::$my['am']):?>
<div><a href="javascript:;" class="btn btn-default" onClick="_.box.open('#newpic')">เปลี่ยนรูปภาพ</a></div>
<?php endif?>
</div>
</div>
<div class="form-actions" style="margin-top:10px;margin-bottom:10px">
<button type="submit" class="btn btn-primary">บันทึก</button>
<button class="btn btn-default" type="reset">ยกเลิก</button>
</div>
</fieldset>
</form>
</div>



<?php if(self::$my['am']):?>
<div id="newpic" class="gbox">
<form method="post" action="<?php echo URL?>" enctype="multipart/form-data">
<div class="gbox_header">เพิ่มข่าวใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right">รูปภาพใหม่:</td><td align="left"><input type="file" name="o" size="50" class="tbox" required></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" อัพโหลด "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>
<?php endif?>
