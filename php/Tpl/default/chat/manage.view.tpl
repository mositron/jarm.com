<style type="text/css">
.tmp_colum{background:#F5F5F5;}
.tmp_colum td{background:#FFFFFF;text-align:center; }
.tmp_colum .h{background:#4BA1D8; color:#FFF}
#getphoto label{display:block; width:100px; margin:3px; float:left }


.prv-appfb h4{padding:5px; background:#f5f5f5; margin:5px 0px 5px}
.prv-appfb img{float:left; margin:2px 5px 3px 0px; width:100px; height:70px;}
.prv-appfb hr{margin:5px 0px; color:#fff; background:#fff; height:1px;border:none; border-bottom:1px solid #ccc}
.prv-appfb p{clear:both}
.ans-img > div{width:120px; text-align:center; min-height:100px; float:left}
.ans-img img.o,.ans-ch table img.o{width:100px}

.ans-ch table{margin-bottom:5px}

.colum { width:130px}
.tbservice .ans-ch .colum { width:60px !important}
.req{color:#fff; background:#f00; display:inline-block; font-size:12px; padding:3px 5px;}

.tbservice{ background:none !important}
.tbservice td{background:none !important;}

.lf{display:block;margin:0px;vertical-align:top;font-weight: normal;}
.lf strong{font-weight: normal; text-decoration: underline;vertical-align:inherit;}
</style>


<ul class="breadcrumb">
  <li><a href="/" title="แชท คุยสด"><span class="glyphicon glyphicon-home"></span> แชท</a></li>
	<span class="divider">&raquo;</span>
   <li><a href="/manage">ห้องแชทของฉัน</a></li>
 	<span class="divider">&raquo;</span>
    <li>แก้ไข</li>
   <span></span>
   <li class="pull-right"><a href="javascript:;" onClick="_.box.confirm({'title':'รีเซ็ทผู้ดูแลภายในห้องแชทนี้','detail':'ระบบจะทำการลบผู้ดูแลทั้งหมดภายในห้องแชทนี้ จะเหลือเพียงเจ้าของห้องเท่านั้น<br><br>คุณต้องการดำเนินการต่อหรือไม่','click':function(){_.ajax.gourl('<?php echo URL?>','resetadmin');}})">รีเซ็ทผู้ดูแลภายในห้องแชทนี้</a></li>
</ul>

<?php if($this->error):?>
<div class="alert alert-error">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">ผิดพลาด!</h4>
 <?php echo implode('<br>',$this->error);?>
</div>
<?php endif?>

<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/manage">ระบบจัดการข้อมูล </a>, <a href="https://chat.jarm.com/room/<?php echo $this->chat['_id']?>">หน้าแสดงผล</a>)
</div>
<?php elseif($_SERVER['QUERY_STRING']=='no-image'):?>
<div class="alert alert-danger">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">ไม่สามารถเผยแพร่ได้!</h4>
 ไม่สามารถเผยแพร่ห้องแชทนี้ได้ เนื่องจากยังไม่มีรูปภาพ
</div>
<?php endif?>


<?php if($this->chat['pl']):?>
<div class="alert alert-info">
  <h4 class="alert-heading">เผยแพร่แล้ว!</h4>
 ห้องแชทนี้ทำงานเผยแพร่เป็นสาธารณะแล้ว. กลับไปยัง <a href="/manage">ระบบจัดการห้องแชท</a> หรือ <a href="https://chat.jarm.com/room/<?php echo $this->chat['_id']?>">หน้าแสดงผล</a>,
</div>
<?php endif?>

<form action="<?php echo URL?>" method="post" enctype="multipart/form-data" id="frmapp">
<table cellpadding="5" cellspacing="1" border="0" class="table">
<tr><th colspan="2" style="text-align:center">รายละเอียดห้องแชท</th></tr>
<tr><td class="colum">ชื่อห้อง <small>:</small></td><td valign='top'><input type="text" class="tbox" name="name" style="width:99%" value="<?php echo $this->chat['n']?>" maxlength="40"><br><span class="req">*</span> สูงสุดไม่เกิน 30 ตัวอักษร</td></tr>

<tr><td class="colum">รูปภาพ <small>:</small></td><td valign='top'>
<?php if($this->chat['img']):?>
<img src="https://chat.jarm.com/v/room/<?php echo $this->chat['fd']?>/s.jpg"><br>
<?php endif?>
<input type="file" size="20" name="o" accept="image/*">
<p class="help-block">* บังคับเลือก (ใช้สำหรับแสดงผลในหน้าเว็บ)</p>
</div>
</div>

<tr><td class="colum">ข้อความต้อนรับ <small>:</small></td><td valign='top'><textarea class="tbox" name="welcome" style="width:99%; height:40px;"><?php echo $this->chat['w']?></textarea><br><span class="req">*</span> สูงสุดไม่เกิน 100 ตัวอักษร</td></tr>
<tr><td class="colum">ลิ้งค์ของห้องแชท <small>:</small></td><td valign='top'>https://chat.jarm.com/<?php if(CHAT_LINK): echo CHAT_LINK; else:?><input type="text" class="tbox" name="link" style="width:130px" value="" maxlength="30"><br> 3-30 ตัวอักษร, a-z 0-9 เท่านั้น และไม่สามารถแก้ไขได้ภายหลัง <?php endif?></td></tr>
<?php if($this->chat['u']==1):?>
<tr><td class="colum">Meta Title <small>:</small></td><td valign='top'><input type="text" class="tbox" name="mtt" style="width:99%" value="<?php echo $this->chat['mt']['tt']?>" maxlength="150"></td></tr>
<tr><td class="colum">Meta Description <small>:</small></td><td valign='top'><input type="text" class="tbox" name="mdc" style="width:99%" value="<?php echo $this->chat['mt']['dc']?>" maxlength="150"></td></tr>
<tr><td class="colum">Meta Keyword <small>:</small></td><td valign='top'><input type="text" class="tbox" name="mkw" style="width:99%" value="<?php echo $this->chat['mt']['kw']?>" maxlength="150"></td></tr>
<?php endif?>
<tr><td class="colum">ค่าเริ่มต้นการใช้งาน <small>:</small></td><td valign='top'>
<label class="lf"><input type="checkbox" name="snd" value="1"<?php echo $this->chat['bg']['snd']?' checked':''?>> เปิดใช้งานเสียงเตือนต่างๆภายในห้องแชท</label>
<label class="lf"><input type="checkbox" name="one" value="1"<?php echo $this->chat['bg']['one']?' checked':''?>> เปิดใช้งานการแสดงข้อความแบบบรรทัดเดียว</label>
<label class="lf"><input type="checkbox" name="col" value="1"<?php echo $this->chat['bg']['col']?' checked':''?>> เปิดใช้งานการสุ่มสีข้อความให้กับสมาชิก</label>
</td></tr>
<tr><td class="colum">กำหนดค่าการใช้งานแชท <small>:</small></td><td valign='top'>
  <label class="lf"><input type="checkbox" name="login" value="1"<?php echo $this->chat['li']?' checked':''?>> ล็อคอินเท่านั้นถึงคุย<strong>หน้าห้อง</strong>ได้</label>
  <label class="lf"><input type="checkbox" name="kick" value="1"<?php echo $this->chat['ki']?' checked':''?>> เตะ/แบน คำหยาบ<strong>หน้าห้อง</strong>อัตโนมัติ</label>
  <label class="lf"><input type="checkbox" name="login2" value="1"<?php echo $this->chat['li2']?' checked':''?>> ล็อคอินเท่านั้นถึง<strong>กระซิบ</strong>ได้</label>
  <label class="lf"><input type="checkbox" name="kick2" value="1"<?php echo $this->chat['ki2']?' checked':''?>> เตะ/แบน คำหยาบ<strong>กระซิบ</strong>อัตโนมัติ</label>
</td></tr>
<tr><td class="colum">สีของกล่องแชท <small>:</small></td><td valign='top'>
<table class="table">
<tbody>
<tr>
<td class="cl-label">สีข้อความทั่วไป</td>
<td class="cl-preview"><input type="color" name="tc" value="<?php echo $this->chat['bg']['tc']?$this->chat['bg']['tc']:'#555555'?>"></td>
</tr>
<tr>
<td class="cl-label">สีลิ้งค์ข้อความ</td>
<td class="cl-preview"><input type="color" name="lc" value="<?php echo $this->chat['bg']['lc']?$this->chat['bg']['lc']:'#0099D2'?>"></td>
</tr>
<tr>
<td class="cl-label">สีพื้นหลังทั้งหมด</td>
<td class="cl-preview"><input type="color" name="al_cl" value="<?php echo $this->chat['bg']['al']['cl']?$this->chat['bg']['al']['cl']:'#ffffff'?>"></td>
</tr>
<tr>
<td class="cl-label">ภาพพื้นหลัง (ถ้ามี)</td>
<td class="cl-preview"><input type="url" name="al_bg" value="<?php echo $this->chat['bg']['al']['bg']?>" style="width:300px" class="tbox"> <br>(ปล่อยว่างได้ - หรือใส่เป็น url ของรูปภาพที่เก็บไว้บนเว็บ)</td>
</tr>
<tr>
<td class="cl-label">ความสว่างของพื้นกล่องข้อความ</td>
<td class="cl-preview">
<select name="bg_pc">
<?php for($i=0;$i<=100;$i+=5):?><option value="<?php echo $i?>"<?php echo $i==$this->chat['bg']['pc']?' selected':''?>><?php echo $i?> %</option><?php endfor?>
</select>
<br>สามารถใช้งานได้กับบราวเซอร์ใหม่ๆ หรือบราวเซอร์ที่รองรับ CSS3 เท่านั้น
</td>
</tr>
<tr>
<td class="cl-label">ความสว่างของพื้นกล่องรายชื่อ</td>
<td class="cl-preview">
<select name="bg_pn">
<?php for($i=0;$i<=100;$i+=5):?><option value="<?php echo $i?>"<?php echo $i==$this->chat['bg']['pn']?' selected':''?>><?php echo $i?> %</option><?php endfor?>
</select>
<br>สามารถใช้งานได้กับบราวเซอร์ใหม่ๆ หรือบราวเซอร์ที่รองรับ CSS3 เท่านั้น
</td>
</tr>
<tr><td class="colum">ลิ้งค์พอร์ทวิทยุ <small>:</small></td><td valign='top'>
<input type="text" placeholder="http://" class="form-control" name="radio" value="<?php echo $this->chat['r']?>">
<p> เช่น คลื่น 93.0 Cool FM - http://203.150.224.142:8000/;stream.mp3</p>
</td></tr>
</tbody>
</table>

</td></tr>
<tr><td class="colum">บอท <small>:</small></td><td valign='top'>
<table cellpadding="5" cellspacing="0">
<thead>
<th>ชื่อบอท</th>
<th>ลิ้งค์รูปภาพ (ถ้ามี)</th>
<th>ประเภท</th>
</thead>
<tbody>
<?php for($i=0;$i<MAX_BOT;$i++):?>
<tr>
<td><input type="text" name="bot_<?php echo $i?>_n" value="<?php echo $this->chat['bt'][$i]['n']?>" class="form-control"></td>
<td><input type="text" name="bot_<?php echo $i?>_i" value="<?php echo $this->chat['bt'][$i]['i']?>" placeholder="http://" class="form-control"></td>
<td><select name="bot_<?php echo $i?>_ty" class="form-control">
<option value="">เฝ้าห้อง</option>
<option value="chat"<?php echo $this->chat['bt'][$i]['ty']=='chat'?' selected':''?>>โต้ตอบ</option>
<option value="poem1"<?php echo $this->chat['bt'][$i]['ty']=='poem1'?' selected':''?>>กลอน (แบบที่ 1)</option>
<option value="poem2"<?php echo $this->chat['bt'][$i]['ty']=='poem2'?' selected':''?>>กลอน (แบบที่ 2)</option>
<option value="poem3"<?php echo $this->chat['bt'][$i]['ty']=='poem3'?' selected':''?>>ประกาศจากทีมงาน Jarm</option>
</select>
</td>
</tr>
<?php endfor?>
</tbody>
</table>
ปล่อยว่างได้
</td></tr>



<tr><td class="colum">ตั้งเป็นสาธารณะ <small>:</small></td><td valign='top'><label><input type="radio" name="published" value="1"<?php echo $this->chat['pl']?' checked':''?>> ใช่</label> <label><input type="radio" name="published" value="0"<?php echo !$this->chat['pl']?' checked':''?>> ไม่ใช่</label><br>
คือการให้ห้องแชทนี้แสดงอยู่ในหน้ารวมห้องแชททั้งหมด</td></tr>

<tr><td class="colum"></td><td><input type="submit" class="btn btn-info" value="          บันทึก          ">  หรือกลับไปยัง <a href="/manage" class="btn">ห้องแชทของฉันทั้งหมด</a></td></tr>
</table>
</form>

<div style="border:1px solid #ccc;background:#fff; margin:5px 0px 0px;padding:5px;">
<h4 class="bar-heading">ลิ้งค์สำหรับห้องแชทนี้</h4>
<div style="margin:5px 0px 0px 0px">
<input type="text" class="form-control" value="https://chat.jarm.com/<?php echo $this->chat['l']?$this->chat['l']:'room/'.$this->chat['_id']?>">
</div>
</div>
<div style="border:1px solid #ccc;background:#fff; margin:5px 0px 0px;padding:5px;">
<h4 class="bar-heading">โค๊ดสำหรับใส่กล่องแชทบนเว็บของคุณ</h4>
<div style="margin:5px 0px 0px 0px">
<textarea class="form-control" style="height:70px;"><iframe frameborder="0" width="100%" height="500" src="https://chat.jarm.com/v/?r=<?php echo $this->chat['_id']?>"></iframe></textarea>
</div>
</div>
<br><br>


<script>
$('input[name=photo]').change(function(e){
	if($(this).val())
	{
		_.upload.start(this,null,function(b){if(b.status=='OK'){$('.prv-img').attr('src',b.photo);}else{_.box.alert(b.message);}});
	}
});

</script>
