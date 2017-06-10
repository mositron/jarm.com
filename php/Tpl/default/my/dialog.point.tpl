


<div id="add_point" class="gbox" style="width:400px;">
<form onSubmit="_.ajax.gourl('/user/<?php echo $this->user['link']?>','addpoint',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มลดบ๊อกให้ <?php echo $this->user['name']?></div>
<div class="gbox_content" style="text-align:center;">
<input type="hidden" name="profile" value="<?php echo $this->user['_id']?>">
<div style="line-height:1.8em; padding:5px 10px 10px 20px; text-align:left">
<div>ปัจจุบันมีอยู่ <?php echo $this->user['cd']['p']?></div>
<div>เพิ่ม/ลดจำนวน: <input type="number" name="credit" class="tbox" size="10"></div>
</div>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" บันทึก "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>