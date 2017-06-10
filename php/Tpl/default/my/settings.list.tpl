

<h4 class="cap text-center">การตั้งค่าการใช้งานทั่วไป</h4>
<ul class="_st">
<li>
<?php if($this->type=='avatar'):?>
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
  <tr><th colspan="2" align="center">แก้ไขรูปภาพโปรไฟล์</th></tr>
    <tr>
        <td class="colum">รูปภาพโปรไฟล์</td>
        <td>
            <img src="<?php echo $this->my['nimg']?>" class="img-uid-my">
            <div class="chg-img" style="margin-top:5px;">
              <input type="file" name="avatar" class="tbox" style="width:200px">
              <div class="_jupload" style="display:none"></div>
            </div>
        </td>
    </tr>
</table>
<?php else:?>
<a href="/settings/avatar" class="row">
<span class="col-xs-4">รูปภาพโปรไฟล์</span>
<span class="col-xs-6"><img src="<?php echo $this->my['nimg']?>" class="img-uid-my"></span>
<span class="col-xs-2">แก้ไข</span>
</a>
<?php endif?>
</li>
<li>
<?php if($this->type=='email'):?>
<div>
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="2" align="center">อีเมล์</th></tr>
<tr><td class="colum">อีเมล์สำหรับล็อคอิน</td><td><?php echo $this->my['em']?> (<a href="javascript:;" onClick="_.box.load('/dialog/email #change_email')">เปลี่ยนอีเมล์</a>)</td></tr>
<tr><td class="colum">สถานะ</td><td><?php echo $this->my['st']?'<strong>ยืนยันแล้ว</strong>':'<strong>รอการยืนยัน</strong>'?>
<?php if(!$this->my['st']):?>
<br><br>
<strong>วิธีการยืนยัน</strong> (เลือกอย่างใดอย่างหนึ่ง)<br>
1. <input class="button" type="button" value=" ยืนยันการสมัครสมาชิกด้วย Facebook " onClick="_.ajax.gourl('/settings/','setsc','fb','verify')"><br>
หรือ<br>
2. <input class="button" type="button" value=" ส่งอีเมล์ยืนยันการสมัครสมาชิกอีกครั้ง " onClick="_.ajax.gourl('/settings','sendconfirm')"><br>
<div style="border:1px solid #f5f5f5; padding:5px; margin:5px 0px;">ระบบทำการส่งข้อมูลการยืนยันไปยังอีเมล์ของท่านแล้ว หากยังไม่ได้รับอีเมล์ดังกล่าว กรุณาคลิกที่ปุ่มด้านล่างนี้ เพื่อทำการส่งข้อมูลการยืนยันอีกครั้ง</div>
หรือ <a href="/settings">ยกเลิก</a>
<?php endif?>
</td></tr>
</table>
<?php if(isset($_GET['verified'])):?>
<?php if($_GET['verified']=='1'):?>
<div style="padding:5px; margin:5px 0px; text-align:center; border:1px solid #eee; color:#390">ยืนยันการสมัครสมาชิกเรียบร้อยแล้ว</div>
<?php elseif($_GET['verified']=='2'):?>
<div style="padding:5px; margin:5px 0px; text-align:center; border:1px solid #c00; color:#f00">ไม่สามารถยืนยันผ่านบัญชี facebook ได้ กรุณาใช้ facebook account: <?php echo $this->my['em']?></div>
<?php else:?>
<div style="padding:5px; margin:5px 0px; text-align:center; border:1px solid #c00; color:#f00">facebook account: <?php echo $this->my['em']?> นี้ ไม่สามารถยืนยันการสมัครสมาชิกได้</div>
<?php endif?>
<?php endif?>
</div>
<?php elseif($this->my['st']):?>
<a href="/settings/email" class="row">
<span class="col-xs-4">อีเมล์</span>
<span class="col-xs-6"><?php echo $this->my['em']?> (ยืนยันแล้ว)</span>
<span class="col-xs-2"></span>
</a>
<?php else:?>
<a href="/settings/email" class="row">
<span class="col-xs-4">อีเมล์</span>
<span class="col-xs-6"><?php echo $this->my['em']?> (รอการยืนยัน)</span>
<span class="col-xs-2">แก้ไข</span>
</a>
<?php endif?>
</li>
<li>
<?php if($this->type=='name'):?>
<div>
<form onSubmit="_.ajax.gourl('/settings/','settings',this);return false">
<input type="hidden" name="setting" value="name">
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="2" align="center">แก้ไขชื่อ-นามสกุล</th></tr>
<tr><td class="colum">ชื่อ</td><td><input type="text" class="tbox" name="first" value="<?php echo $this->my['if']['fn']?>" style="width:300px;" required></td></tr>
<tr><td class="colum">นามสกุล</td><td><input type="text" class="tbox" name="last" value="<?php echo $this->my['if']['ln']?>" style="width:300px;" required></td></tr>
<tr><td></td><td><input type="submit" value=" บันทึก " class="button blue"> </td></tr>
</table>
<h4 style="margin:5px; background:#f5f5f5; padding:5px; text-align:center">ข้อกำหนด</h4>
<div style="line-height:1.6em; padding:5px 0px 5px 30px; text-align:left">
- ไม่สามารถใช้อักขระพิเศษเหล่านี้ได้  ​ !@#$%^&*()_+-={}[]:";\'?/.,<>`~
</div>
</form>
</div>
<?php else:?>
<a href="/settings/name" class="row">
<span class="col-xs-4">ชื่อ-นามสกุล</span>
<span class="col-xs-6"><?php echo $this->my['name']?></span>
<span class="col-xs-2">แก้ไข</span>
</a>
<?php endif?>
</li>

<li>
<?php
  $prov=(array)$this->prov;
  $prov['0']=['name_th'=>'ต่างประเทศ'];
  $_b=explode('-',date('d-m-Y',($this->my['if']['bd']?self::Time()->sec($this->my['if']['bd']):time())));
?>
<?php if($this->type=='profile'):?>
<div>
<form onSubmit="_.ajax.gourl('/settings','settings',this);return false">
<input type="hidden" name="setting" value="profile">
<table cellpadding="5" cellspacing="1" border="0" class="tbservice" width="100%">
<tr><th colspan="2" align="center">ข้อมูลส่วนตัว</th></tr>
<tr><td class="colum">เพศ</td><td>
<select name="gender"class="tbox">
<?php foreach(self::$conf['gender'] as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==$this->my['if']['gd']?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td>
</tr>
<tr><td class="colum">วันเดือนปีเกิด</td><td style="vertical-align:top">
<select name="bday" class="tbox" required><option value="">วัน</option><?php for($i=1;$i<=31;$i++):?><option value="<?php echo ($j=substr('00'.$i,-2))?>"<?php echo $_b[0]==$j?' selected':''?>><?php echo $j?></option><?php endfor?></select>
/
<select name="bmonth" class="tbox" required>
<option value="">เดือน</option>
<option value="01"<?php echo $_b[1]=='01'?' selected':''?>>มกราคม</option>
<option value="02"<?php echo $_b[1]=='02'?' selected':''?>>กุมภาพันธ์</option>
<option value="03"<?php echo $_b[1]=='03'?' selected':''?>>มีนาคม</option>
<option value="04"<?php echo $_b[1]=='04'?' selected':''?>>เมษายน</option>
<option value="05"<?php echo $_b[1]=='05'?' selected':''?>>พฤษภาคม</option>
<option value="06"<?php echo $_b[1]=='06'?' selected':''?>>มิถุนายน</option>
<option value="07"<?php echo $_b[1]=='07'?' selected':''?>>กรกฏาคม</option>
<option value="08"<?php echo $_b[1]=='08'?' selected':''?>>สิงหาคม</option>
<option value="09"<?php echo $_b[1]=='09'?' selected':''?>>กันยายน</option>
<option value="10"<?php echo $_b[1]=='10'?' selected':''?>>ตุลาคม</option>
<option value="11"<?php echo $_b[1]=='11'?' selected':''?>>พฤศจิกายน</option>
<option value="12"<?php echo $_b[1]=='12'?' selected':''?>>ธันวาคม</option>
</select>
/
<select name="byear" class="tbox" required><option value="">ปี พ.ศ.</option><?php for($i=date('Y')-10;$i>=date('Y')-110;$i--):?><option value="<?php echo $i?>"<?php echo $_b[2]==$i?' selected':''?>><?php echo $i+543?></option><?php endfor?></select>
</td>
</tr>

<?php /*
<tr><td class="colum">สถานะความสัมพันธ์</td><td>
<select name="relate"class="tbox">
<?php foreach(self::$conf['relate'] as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==$this->my['if']['rl']?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</td>
</tr>
*/?>

<tr><td class="colum">จังหวัด</td><td>
<select name="prov"class="tbox">
<?php foreach($prov as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==$this->my['if']['pr']?' selected':''?>><?php echo $v['name_th']?></option>
<?php endforeach?>
</select>
</td>
</tr>
<tr><td></td><td colspan="2"><input type="submit" value=" บันทึก " class="button blue"> หรือ <a href="/settings">ยกเลิก</a></td></tr>
</table>
</form>
</div>
<?php else:?>
<a href="/settings/profile" class="row">
<span class="col-xs-4">ข้อมูลส่วนตัว</span>
<span class="col-xs-6"><?php echo self::$conf['gender'][$this->my['if']['gd']]?>, <?php echo $prov[$this->my['if']['pr']]['name_th']?></span>
<span class="col-xs-2">แก้ไข</span>
</a>
<?php endif?>
</li>

<li>
<?php if($this->type=='facebook'):?>
<div>
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><th colspan="2" align="center">แก้ไขบัญชี Facebook</th></tr>
<?php if($this->my['sc']['fb']['id']):?>
<tr><td class="colum">Facebook Account</td><td><?php echo $this->my['sc']['fb']['id']?></td></tr>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','fb','new')">ผูกบัญชีใหม่</a> | <a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','fb','del')">ยกเลิกการผูกบัญชี</a></td></tr>
<?php else:?>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','fb','new')">ผูกบัญชีกับ Facebook</a></td></tr>
<?php endif?>
<tr><td class="text-center" colspan="2">หรือ <a href="/settings">ยกเลิก</a></td></tr>
</table>
</div>
<?php else:?>
<a href="/settings/facebook" class="row">
<span class="col-xs-4">บัญชี Facebook</span>
<span class="col-xs-6"><?php echo $this->my['sc']['fb']['id']?></span>
<span class="col-xs-2">แก้ไข</span>
</a>
<?php endif?>
</li>

<li>

<?php if($this->type=='google'):?>
<div>
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><th colspan="2" align="center">แก้ไขบัญชี Google+</th></tr>

<?php if(isset($this->my['sc']['gg']['id'])):?>
<tr><td class="colum">Google Account</td><td><?php echo $this->my['sc']['gg']['name']?><br>https://plus.google.com/<?php echo $this->my['sc']['gg']['id']?></td></tr>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','gg','new')">ผูกบัญชีใหม่</a> | <a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','gg','del')">ยกเลิกการผูกบัญชี</a></td></tr>
<?php else:?>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','gg','new')">ผูกบัญชีกับ Google+</a></td></tr>
<?php endif?>
<tr><td class="text-center" colspan="2">หรือ <a href="/settings">ยกเลิก</a></td></tr>
</table>
</div>
<?php else:?>
<a href="/settings/google" class="row">
<span class="col-xs-4">บัญชี Google</span>
<span class="col-xs-6"><?php echo isset($this->my['sc']['gg']['name'])?$this->my['sc']['gg']['name'].' - '.$this->my['sc']['gg']['id']:''?></span>
<span class="col-xs-2">แก้ไข</span>
</a>
<?php endif?>
</li>

<li>

<?php if($this->type=='twitter'):?>
<div>
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><th colspan="2" align="center">แก้ไขบัญชี Twitter</th></tr>

<?php if(isset($this->my['sc']['tw']['id'])):?>
<tr><td class="colum">Twitter Account</td><td><?php echo $this->my['sc']['tw']['name']?></td></tr>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','tw','new')">ผูกบัญชีใหม่</a> | <a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','tw','del')">ยกเลิกการผูกบัญชี</a></td></tr>
<?php else:?>
<tr><td class="text-center" colspan="2"><a href="javascript:;" onClick="_.ajax.gourl('/settings/','setsc','tw','new')">ผูกบัญชีกับ Twitter</a></td></tr>
<?php endif?>
<tr><td class="text-center" colspan="2">หรือ <a href="/settings">ยกเลิก</a></td></tr>
</table>
</div>
<?php else:?>
<a href="/settings/twitter" class="row">
<span class="col-xs-4">บัญชี Twitter</span>
<span class="col-xs-6"><?php echo isset($this->my['sc']['tw']['name'])?$this->my['sc']['tw']['name']:''?></span>
<span class="col-xs-2">แก้ไข</span>
</a>
<?php endif?>
</li>


<li>
<?php if($this->type=='password'):?>
<div>
<form onSubmit="_.ajax.gourl('/settings/','settings',this);return false">
<input type="hidden" name="setting" value="password">
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><th colspan="2" align="center">แก้ไขรหัสผ่าน</th></tr>
<tr><td class="colum">รหัสผ่านเดิม</td><td align="left"><input type="password" name="password_old" class="tbox password"></td></tr>
<tr><td class="colum">รหัสผ่านใหม่</td><td align="left"><input type="password" name="password_new" class="tbox password"></td></tr>
<tr><td class="colum">ยืนยันอีกครั้ง</td><td align="left"><input type="password" name="password_confirm" class="tbox password"></td></tr>
<tr><td class="colum"></td><td align="left"><input type="submit" value=" บันทึก " class="button blue"> หรือ <a href="/settings">ยกเลิก</a></td></tr>
</table>
</form>
</div>
<?php else:?>
<a href="/settings/password" class="row">
<span class="col-xs-4">รหัสผ่าน</span>
<span class="col-xs-6">*****</span>
<span class="col-xs-2">แก้ไข</span>
</a>
<?php endif?>
</li>

<li>
<?php if($this->type=='delete'):?>
<div>
<form onSubmit="if(confirm('คุณต้องการยกเลิกการใช้งาน jarm.com หรือไม่ (ไม่สามารถกลับมาใช้งานได้ใหม่)')){_.ajax.gourl('/settings/','settings',this);};return false">
<input type="hidden" name="setting" value="delete">
<table cellpadding="5" cellspacing="1" border="0" width="100%" class="tbservice">
<tr><th colspan="2" align="center">ยืนยันการปิดบัญชีภายใน jarm.com</th></tr>
<tr><td class="colum">รหัสผ่าน</td><td align="left"><input type="password" name="password_old" class="tbox password"><br><br><strong>ข้อควรระวัง</strong><br>
- หากทำการปิดบัญชีแล้ว จะไม่สามารถกลับมาใช้งานบัญชีนี้ใหม่ได้อีก<br>
- ข้อมูลทั้งหมดของคุณ จะถูกลบออกจากระบบโดยอัตโนมัติ<br>
</td></tr>
<tr><td class="colum"></td><td align="left"><input type="submit" value=" ปิดการใช้งานเดี๋ยวนี้ " class="button blue"> หรือ <a href="/settings">ยกเลิก</a></td></tr>
</table>
</form>
</div>
<?php else:?>
<a href="/settings/delete" class="row">
<span class="col-xs-4">ปิดบัญชี / ยกเลิกการใช้งาน</span>
<span class="col-xs-6"></span>
<span class="col-xs-2">ยืนยัน</span>
</a>
<?php endif?>
</li>

</ul>
