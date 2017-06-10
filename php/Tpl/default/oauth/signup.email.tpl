<div class="box-border box-border2">
    <h2 class="bar-heading" style="margin-bottom:10px;">สมัครสมาชิก</h2>
    <form method="post" enctype="multipart/form-data" action="<?php echo URL?><?php echo $this->q?>" onSubmit="$('.err').hide();" class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-3 control-label">ชื่อ</label>
            <div class="col-sm-9">
                <input type="text" name="firstname" class="form-control inp" minlength="3" maxlength="30" value="<?php echo $this->value['firstname']?>" required>
                <div id="err_firstname" class="err"><?php echo $this->error['firstname']?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">นามสกุล</label>
            <div class="col-sm-9">
                <input type="text" name="lastname" class="form-control inp" minlength="3" maxlength="30" value="<?php echo $this->value['lastname']?>" required>
                <div id="err_lastname" class="err"><?php echo $this->error['lastname']?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">อีเมล์</label>
            <div class="col-sm-9">
                <input type="email" name="email" class="form-control inp" value="<?php echo $this->value['email']?>" required>
                <div id="err_email" class="err"><?php echo $this->error['email']?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">รหัสผ่าน</label>
            <div class="col-sm-9">
                <input type="password" name="password" class="form-control inp" value="<?php echo $this->value['password']?>" required>
                <div id="err_password" class="err"><?php echo $this->error['password']?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">เพศ</label>
            <div class="col-sm-9">
                <select name="gender" class="form-control" required>
                    <option value="">เลือกเพศ</option>
                    <?php foreach(self::$conf['gender'] as $k=>$v):?>
                    <option  value="<?php echo $k?>"<?php echo $this->value['gender']==$k?' selected':''?>> <?php echo $v?></option>
                    <?php endforeach?>
                </select>
                <div id="err_gender" class="err"><?php echo $this->error['gender']?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">วัน/เดือน/ปีเกิด</label>
            <div class="col-sm-9">
                <select name="bday" class="form-control" style="width:45px;display:inline-block" required><option value="">วัน</option><?php for($i=1;$i<=31;$i++):?><option value="<?php echo ($j=substr('00'.$i,-2))?>"<?php echo $this->value['bday']==$j?' selected':''?>><?php echo $j?></option><?php endfor?></select>
                /
                <select name="bmonth" class="form-control" style="width:90px;display:inline-block" required>
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
                <select name="byear" class="form-control" style="width:55px;display:inline-block" required><option value="">ปี พ.ศ.</option><?php for($i=date('Y')-10;$i>=date('Y')-110;$i--):?><option value="<?php echo $i?>"<?php echo $this->value['byear']==$i?' selected':''?>><?php echo $i+543?></option><?php endfor?></select>
                 <div id="err_birthday" class="err"><?php echo $this->error['birthday']?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">จังหวัด</label>
            <div class="col-sm-9">
                <select name="province" class="form-control" required>
                    <option value="">เลือกจังหวัด</option>
                    <?php foreach($this->province as $k=>$v):?>
                    <option value="<?php echo $k?>"<?php echo $this->value['province']==$k?' selected':''?>><?php echo $v['name_th']?></option>
                    <?php endforeach?>
                </select>
                <div id="err_province" class="err"><?php echo $this->error['province']?></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">รูปภาพโปรไฟล์</label>
            <div class="col-sm-9">
                <input type="file" name="photo" style="width:160px" required><div id="err_photo" class="err"><?php echo $this->error['photo']?></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <label><input type="checkbox" name="terms" value="yes"<?php echo $this->value['terms']?' checked':''?> required> ยอมรับ<a href="http://jarm.com/about/privacy" target="_blank">เงื่อนไขการใช้งาน</a></label><div id="err_terms" class="err"><?php echo $this->error['terms']?></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <input type="submit" value=" สมัครสมาชิก " class="btn btn-info"> | <a href="/login">เข้าระบบ</a>
            </div>
        </div>
  </form>
</div>
<style>
.err{display:none; padding:5px; background:#ff0000; color:#fff; font-size:14px}
.err a{color:#fff; text-decoration:underline;}
</style>

<script>
$('.err').each(function(){if($(this).html()!='')$(this).show();});
</script>
