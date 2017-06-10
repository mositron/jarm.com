<div id="upload_header" class="gbox" style="width:400px" onopen="_upload()">
<form onSubmit="return false;">
<div class="gbox_header">เปลี่ยนรูปภาพ</div>
<div class="gbox_content" style="text-align:left">
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><td class="colum">รูปภาพหน้าปก</td><td align="left"><input type="file" name="header" class="tbox" style="width:200px"><br>
ขนาดที่แนะนำคือ 840 x 400 pixel</td></tr>
</table>
</div>
<div class="gbox_footer"><input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</form>
</div>

<div id="upload_avatar" class="gbox" style="width:400px" onopen="_upload()">
<form onSubmit="return false;">
<div class="gbox_header">เปลี่ยนรูปภาพ</div>
<div class="gbox_content" style="text-align:left">
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><td class="colum">รูปภาพโปรไฟล์</td><td align="left"><input type="file" name="avatar" class="tbox" style="width:200px"></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</form>
</div>



<div id="upload_background" class="gbox" style="width:500px">
<form action="/user/<?php echo $this->my['link']?>" method="post" enctype="multipart/form-data" onSubmit="_.box.close()">
<input type="hidden" name="upload_bg" value="1">
<div class="gbox_header">อัพโหลดรูปภาพพื้นหลัง</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="1" border="0" width="500" class="tbservice">
<tr><td class="colum">ไฟล์ภาพ</td><td><input type="file" name="background" accept="image/*" class="tbox" size="20" style="width:180px">
 <?php if($this->profile['pf']['bg']&&$this->profile['pf']['bg']['url']):?><br><label><input type="checkbox" name="delete" value="1"> กลับไปใช้รูปภาพเริ่มต้น</label><?php endif?>
</td></tr>
<tr><td class="colum">ตำแหน่ง</td><td>
<select name="position" class="tbox">
<?php $pos=['left top'=>'ซ้าย บน','left center'=>'ซ้าย กลาง','left bottom'=>'ซ้าย ล่าง','center top'=>'กลาง บน','center center'=>'กลาง กลาง','center bottom'=>'กลาง ล่าง','right top'=>'ขวา บน','right center'=>'ขวา กลาง','right bottom'=>'ขวาล่าง']?>
<?php foreach($pos as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==$this->profile['pf']['bg']['pos']?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select></td></tr>
<tr><td class="colum">การทำซ้ำ</td><td>
<select name="repeat" class="tbox">
<?php $repeat=['no-repeat'=>'ไม่ทำซ้ำ','repeat-x'=>'ซ้ำเฉพาะแนวนอน','repeat-y'=>'ซ้ำเฉพาะแนวตั้ง','repeat'=>'ซ้ำทั้งหมด']?>
<?php foreach($repeat as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==$this->profile['pf']['bg']['rep']?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td></tr>
<tr><td></td><td><label><input type="checkbox" class="tbox" value="1" name="fixed"<?php echo $this->profile['pf']['bg']['fix']?' checked':''?>> ตรึงตำแหน่งไม่เลื่อนขึ้นลงตามการสกรอลเมาส์</label></td></tr>
<tr><td class="colum">รหัสสีพื้นหลัง</td><td>#<input type="text" name="color" class="tbox" size="10" maxlength="6" value="<?php echo $this->profile['pf']['bg']['col']?>"> (ปล่อยว่างได้) <a href="http://th.wikipedia.org/wiki/%E0%B8%AA%E0%B8%B5%E0%B8%97%E0%B8%B5%E0%B9%88%E0%B9%83%E0%B8%8A%E0%B9%89%E0%B9%83%E0%B8%99%E0%B9%80%E0%B8%A7%E0%B9%87%E0%B8%9A" target="_blank">ตัวอย่างรหัสสี</a></td></tr>
<tr><td class="colum">ความเข้มกล่องข้อความ</td><td>
<select name="alpha" class="tbox">
<?php for($i=100;$i>=50;$i-=5):?>
<option value="<?php echo $i?>"<?php echo $i==$this->profile['pf']['bg']['alp']?' selected':''?>><?php echo $i?> %</option>
<?php endfor?>
</select><br>รองรับเฉพาะบราวเซอร์ที่สามารถใช้งาน CSS3 ได้
</td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" value=" บันทึก " class="button"> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>
