<div class="olg-sig">
<h2>สมัครสมาชิก</h2>
<?php if($this->value['error']):?>
<div style="padding:10px; margin-bottom:5px; border:1px solid #FEE; color:#f00">
<?php echo $this->value['error']?><br>
หรือ สมัครสมาชิกด้วย <a href="/signup/<?php echo $this->q?>">Email</a>
</div>
<?php else:?>
<form method="post" enctype="multipart/form-data" action="<?php echo URL?><?php echo $this->q?>" onSubmit="$('.err').hide();">
<table cellpadding="5" cellspacing="1" border="0" align="center">
<tr>
<td width="30%" class="text-right">ข้อมูล Facebook</td>
<td>
<div style="padding:5px; border:1px solid #BDC7D8; background-color:#EDEFF4; color:#3B59A2;">
<img src="http://graph.facebook.com/<?php echo $this->value['fbid']?>/picture/" align="left" style="margin:0px 5px 0px 0px; height:50px;">
<div><?php echo $this->value['firstname']?> <?php echo $this->value['lastname']?></div>
<div><?php echo $this->value['email']?></div>
<div>[ <a href="javascript:;" onClick="$('.np').css('display','table-row');$(this).parent().remove();">แก้ไข</a> ]</div>
<p class="clear"></p>
</div></td>
</tr>
<tr class="np" style="display:none">
<td width="30%" class="text-right">ชื่อ:</td>
<td>
<input type="hidden" name="fbid" value="<?php echo $this->value['fbid']?>">
<input type="text" name="firstname" class="tbox inp" minlength="3" maxlength="30" value="<?php echo $this->value['firstname']?>" required>
<div id="err_firstname" class="err"><?php echo $this->error['firstname']?></div>
 </td>
</tr>
<tr class="np" style="display:none">
<td width="30%" class="text-right">นามสกุล:</td>
<td>
<input type="text" name="lastname" class="tbox inp" minlength="3" maxlength="30" value="<?php echo $this->value['lastname']?>" required>
<div id="err_lastname" class="err"><?php echo $this->error['lastname']?></div>
</td>
</tr>
<tr class="np2" style="display:none">
<td width="30%" class="text-right">อีเมล์:</td>
<td>
<input type="email" name="email" class="tbox inp" value="<?php echo $this->value['email']?>" required disabled>
<div id="err_email" class="err"><?php echo $this->error['email']?></div>
</td>
</tr>

<tr>
<td width="30%" class="text-right">รหัสผ่าน:</td>
<td>
<input type="password" name="password" class="tbox inp" value="<?php echo $this->value['password']?>" required>
<div id="err_password" class="err"><?php echo $this->error['password']?></div>
</td>
</tr>
<tr>
<td width="30%" class="text-right">เพศ:</td>
<td>
<select name="gender" class="tbox" required>
<option value="">เลือกเพศ</option>
<?php foreach(self::$conf['gender'] as $k=>$v):?>
<option  value="<?php echo $k?>"<?php echo $this->value['gender']==$k?' selected':''?>> <?php echo $v?></option>
<?php endforeach?>
</select>
<div id="err_gender" class="err"><?php echo $this->error['gender']?></div></td>
</tr>
<tr>
<td width="30%" class="text-right">วัน/เดือน/ปีเกิด:</td>
<td>
<select name="bday" class="tbox" style="width:45px" required><option value="">วัน</option><?php for($i=1;$i<=31;$i++):?><option value="<?php echo ($j=substr('00'.$i,-2))?>"<?php echo $this->value['bday']==$j?' selected':''?>><?php echo $j?></option><?php endfor?></select>
/
<select name="bmonth" class="tbox" style="width:90px" required>
<option value="">เดือน</option>
<option value="01"<?php echo $this->value['bmonth']=='01'?' selected':''?>>มกราคม</option>
<option value="02"<?php echo $this->value['bmonth']=='02'?' selected':''?>>กุมภาพันธ์</option>
<option value="03"<?php echo $this->value['bmonth']=='03'?' selected':''?>>มีนาคม</option>
<option value="04"<?php echo $this->value['bmonth']=='04'?' selected':''?>>เมษายน</option>
<option value="05"<?php echo $this->value['bmonth']=='05'?' selected':''?>>พฤษภาคม</option>
<option value="06"<?php echo $this->value['bmonth']=='06'?' selected':''?>>มิถุนายน</option>
<option value="07"<?php echo $this->value['bmonth']=='07'?' selected':''?>>กรกฏาคม</option>
<option value="08"<?php echo $this->value['bmonth']=='08'?' selected':''?>>สิงหาคม</option>
<option value="09"<?php echo $this->value['bmonth']=='09'?' selected':''?>>กันยายน</option>
<option value="10"<?php echo $this->value['bmonth']=='10'?' selected':''?>>ตุลาคม</option>
<option value="11"<?php echo $this->value['bmonth']=='11'?' selected':''?>>พฤศจิกายน</option>
<option value="12"<?php echo $this->value['bmonth']=='12'?' selected':''?>>ธันวาคม</option>
</select>
/
<select name="byear" class="tbox" style="width:55px" required><option value="">ปี พ.ศ.</option><?php for($i=date('Y')-10;$i>=date('Y')-110;$i--):?><option value="<?php echo $i?>"<?php echo $this->value['byear']==$i?' selected':''?>><?php echo $i+543?></option><?php endfor?></select>
 <div id="err_birthday" class="err"><?php echo $this->error['birthday']?></div></td>
</tr>
<tr>
<td width="30%" class="text-right">จังหวัด:</td>
<td>
<select name="province" class="tbox" required>
<option value="">เลือกจังหวัด</option>
<?php foreach($this->province as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $this->value['province']==$k?' selected':''?>><?php echo $v['name_th']?></option>
<?php endforeach?>
</select>
<div id="err_province" class="err"><?php echo $this->error['province']?></div></td>
</tr>
<tr class="np2" style="display:none">
<td width="30%" class="text-right">รูปภาพโปรไฟล์:</td>
<td><img src="http://graph.facebook.com/<?php echo $this->value['fbid']?>/picture/"></td>
</tr>
<tr>
<td width="30%" class="text-right"></td>
<td><label><input type="checkbox" name="terms" class="tbox" value="yes"<?php echo $this->value['terms']?' checked':''?> required> ยอมรับ<a href="//jarm.com/about/privacy" target="_blank">เงื่อนไขการใช้งาน</a></label><div id="err_terms" class="err"><?php echo $this->error['terms']?></div></td>
</tr>

<!--tr>
<td width="30%" class="text-right">Invite Code:</td>
<td>
<input type="text" name="invite" class="tbox inp" value="<?php echo $this->value['invite']?>" required>
<div id="err_lastname" class="err"><?php echo $this->error['invite']?></div>
</td>
</tr-->

<tr><td></td><td>

<input type="submit" class="olg-btn olg-btn-reg" value=" สมัครสมาชิก "><br> หรือสมัครสมาชิกด้วย <a href="/signup/<?php echo $this->q?>">Email</a></td></tr>
</table>
</form>

<?php endif?>
</div>
<style>
.err{display:none; padding:5px; background:#ff0000; color:#fff; font-size:14px}
.err a{color:#fff; text-decoration:underline;}
</style>

<script>
$('.err').each(function(){if($(this).html()!='')$(this).show();});
//$(function(){ _.box.confirm({title:'ปิดรับสมัครชั่วคราว',detail:'ขอขอบคุณทุกท่านที่ให้ความสนใจนะครับ ทางเราขอปิดการรับสมัครสมาชิก(เพิ่ม)ชั่วคราว เพื่อปรับปรุงระบบให้ดีขึ้น.',yes:'กลับไปหน้าแรก',no:'ปิดหน้าต่างนี้',click:function(){window.location.href='//jarm.com/'}}); })
</script>