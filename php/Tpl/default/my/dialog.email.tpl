


<div id="change_email" class="gbox" style="width:400px;">
<form onSubmit="_.ajax.gourl('/settings','changeemail',this);_.box.close();return false;">
<div class="gbox_header">เปลี่ยนอีเมล์</div>
<div class="gbox_content" style="text-align:center;">
<div style="line-height:1.8em; padding:5px 10px 10px 20px; text-align:left">
<div>อีเมล์ใหม่: <input type="email" name="email" class="tbox" size="40"></div>
<div style="margin:5px 0px; padding:5px;">* อีเมล์ใหม่จะสามารถใช้งานได้เมื่อคุณทำการ<strong>ยืนยันผ่านอีเมล์</strong>เรียบร้อยแล้วเท่านั้น</div>
</div>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" บันทึก "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>