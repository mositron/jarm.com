<ul class="breadcrumb">
  <li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/user" title="">สมาชิก</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/user/update/<?php echo $this->user['_id']?>" title="">แก้ไข</a></li>
  <span></span>
  <li class="pull-right" style="margin:-3px -2px 1px;"><a href="/user/<?php echo $this->user['_id']?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a></li>
</ul>

<div class="box-white">
  <?php if($_SERVER['QUERY_STRING']=='completed'):?>
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
   ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว
  </div>
<?php elseif($_SERVER['QUERY_STRING']=='added'):?>
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
   เพิ่มสมาชิกใหม่เรียบร้อยแล้ว.
  </div>
  <?php endif?>
  <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','updateuser',this);return false;">
    <?php if (team::$my['grade']==99):?>
    <h3 class="bar-heading" style="margin-bottom:5px;">สำหรับผู้ดูแล</h3>
    <div class="form-group">
      <label for="email" class="col-sm-4 control-label">อีเมล์</label>
      <div class="col-sm-8">
        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $this->user['email']?>" />
        <p>ใช้สำหรับล็อคอินเข้าระบบ</p>
      </div>
    </div>
    <div class="form-group">
      <label for="birthday" class="col-sm-4 control-label">เริ่มงาน</label>
      <div class="col-sm-8">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" name="work_start" readonly="readonly" class="form-control pull-right showdate" value="<?php echo $this->user['work']['start']?date('Y-m-d',self::Time()->sec($this->user['work']['start'])):''?>" id="work_start"/>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="code_type" class="col-sm-4 control-label">สังกัด</label>
      <div class="col-sm-8">
        <div class="radio">
          <label>
            <input type="radio" name="code_type" class="minimal code_type" value="1"<?php echo $this->user['type']==1?' checked':''?>>
            Boxza (พนักงาน)
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="code_type" class="minimal code_type" value="2"<?php echo $this->user['type']==2?' checked':''?>>
            Boxzaracing (พนักงาน)
          </label>
        </div>
        <hr>
        <div class="radio" style="padding-top: 0">
          <label>
            <input type="radio" name="code_type" class="minimal code_type" value="3"<?php echo $this->user['type']==3?' checked':''?>>
            Boxza (ฝึกงาน)
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="code_type" class="minimal code_type" value="4"<?php echo $this->user['type']==4?' checked':''?>>
            Boxzaracing (ฝึกงาน)
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">ทีม</label>
      <div class="col-sm-8">
        <select name="team" data-placeholder="ทีม" class="form-control">
          <?php foreach ($this->team as $k=>$v): ?>
            <option value="<?php echo $k?>"<?php echo $this->user['team']==$k?' selected':''?>><?php echo $v['display']?></option>
          <?php endforeach?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-4 control-label">ตำแหน่ง</label>
      <div class="col-sm-8">
        <select name="position" data-placeholder="ตำแหน่ง" class="form-control">
          <?php foreach ($this->position as $k=>$v): ?>
            <option value="<?php echo $k?>"<?php echo $this->user['pos']==$k?' selected':''?>><?php echo $v['display']?></option>
          <?php endforeach?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="status" class="col-sm-4 control-label">สถานะ</label>
      <div class="col-sm-8">
        <select class="form-control" id="status" name="status">
          <option value="">กรุณาเลือกสถานะพนักงาน</option>
        <?php foreach ($this->status as $k => $v):?>
          <option value="<?php echo $k?>"<?php echo $this->user['status']==$k?' selected':''?>><?php echo $v['n'].' - '.$v['t']?></option>
        <?php endforeach?>
        </select>
      </div>
    </div>
    <h3 class="bar-heading" style="margin-bottom:5px;">สำหรับสมาชิก</h3>
    <?php endif?>
    <div class="form-group">
      <label for="email" class="col-sm-4 control-label">อีเมล์</label>
      <div class="col-sm-8">
        <input type="email" class="form-control" value="<?php echo $this->user['email']?>" readonly disabled />
        <p>ใช้สำหรับล็อคอินเข้าระบบ ไม่สามารถแก้ไขได้</p>
      </div>
    </div>
    <div class="form-group">
      <label for="avatar" class="col-sm-4 control-label">รูปภาพประจำตัว</label>
      <div class="col-sm-8">
        <img id="img-avatar" src="https://f1.jarm.com/team/user/<?php echo $this->user['_id']?>-s.jpg?<?php echo time()?>" class="img-responsive img-circle">
        <input type="file" name="avatar" id="avatar">
        <p class="help-block">รองรับไฟล์ gif|jpg|png</p>
      </div>
    </div>
    <div class="form-group">
      <label for="nickname" class="col-sm-4 control-label">ชื่อเล่น</label>
      <div class="col-sm-8">
        <input type="text" name="nickname" class="form-control" id="nickname" placeholder="nickname" value="<?php echo $this->user['nickname']?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="th_first" class="col-sm-4 control-label">ชื่อจริง</label>
      <div class="col-sm-8">
        <input type="text" name="th_first" class="form-control" id="th_first" placeholder="ชื่อจริง" value="<?php echo $this->user['th']['first']?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="th_last" class="col-sm-4 control-label">สกุลจริง</label>
      <div class="col-sm-8">
        <input type="text" name="th_last" class="form-control" id="th_last" placeholder="สกุลจริง" value="<?php echo $this->user['th']['last']?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="en_first" class="col-sm-4 control-label">Firstname</label>
      <div class="col-sm-8">
        <input type="text" name="en_first" class="form-control" id="en_first" placeholder="Firstname" value="<?php echo $this->user['en']['first']?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="en_last" class="col-sm-4 control-label">Lastname</label>
      <div class="col-sm-8">
        <input type="text" name="en_last" class="form-control" id="en_last" placeholder="Lastname" value="<?php echo $this->user['en']['last']?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="sex" class="col-sm-4 control-label">เพศ</label>
      <div class="col-sm-8">
        <select class="form-control" id="sex" name="sex">
          <option value="male"<?php echo $this->user['sex']=='male'?' selected':''?>>ผู้ชาย</option>
          <option value="female"<?php echo $this->user['sex']=='female'?' selected':''?>>ผู้หญิง</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="birthday" class="col-sm-4 control-label">วันเกิด</label>
      <div class="col-sm-8">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" name="birthday" readonly="readonly" class="form-control pull-right" value="<?php echo $this->user['birthday']?date('Y-m-d',self::Time()->sec($this->user['birthday'])):''?>" id="birthday"/>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="id_card" class="col-sm-4 control-label">เลขประจำตัวบัตรประชาชน</label>
      <div class="col-sm-8">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-barcode"></i>
          </div>
          <input type="text" name="id_card" class="form-control" id="id_card" placeholder="เลขประจำตัวบัตรประชาชน" data-inputmask='"mask": "9-9999-99999-99-9"' data-mask value="<?php echo $this->user['id_card']?>"/>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="deposit_account_name" class="col-sm-4 control-label">ชื่อบัญชีธนาคาร</label>
      <div class="col-sm-8">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-paypal"></i>
          </div>
          <input type="text" name="bank_name" class="form-control" id="bank_name" placeholder="ชื่อบัญชีธนาคาร" value="<?php echo $this->user['bank']['name']?>"/>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="bank_ID" class="col-sm-4 control-label">ธนาคาร</label>
      <div class="col-sm-8">
        <select class="form-control" id="bank_id" name="bank_id">
        <option value="">กรุณาเลือกธนาคาร</option>
        <?php foreach ($this->bank as $k => $v):?>
          <option value="<?php echo $k?>"<?php echo $this->user['bank']['id']==$k?' selected':''?>><?php echo $v?></option>
        <?php endforeach?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="deposit_account_number" class="col-sm-4 control-label">เลขบัญชีธนาคาร</label>
      <div class="col-sm-8">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-paypal"></i>
          </div>
          <input type="text" name="bank_number" class="form-control" id="bank_number" placeholder="เลขบัญชีธนาคาร" data-inputmask='"mask": "999-9-99999-9"' data-mask value="<?php echo $this->user['bank']['number']?>"/>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="line_id" class="col-sm-4 control-label">Line ID</label>
      <div class="col-sm-8">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-slack"></i>
          </div>
          <input type="text" name="line_id" class="form-control" id="line_id" placeholder="Line ID" value="<?php echo $this->user['line_id']?>">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="phone" class="col-sm-4 control-label">เบอร์โทรศัพท์ที่ติดต่อได้</label>
      <div class="col-sm-8">
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-phone-square"></i>
          </div>
          <input type="text" name="phone" class="form-control" id="phone" placeholder="เบอร์โทรศัพท์ที่ติดต่อได้" data-inputmask='"mask": "099-999-9999"' data-mask value="<?php echo $this->user['phone']?>"/>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="address_current" class="col-sm-4 control-label">ที่อยู่ปัจจุบัน</label>
      <div class="col-sm-8">
        <textarea class="form-control" name="address_current" id="address_current" rows="3" placeholder="ที่อยู่ปัจจุบัน"><?php echo $this->user['address']['current']?></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="address_card" class="col-sm-4 control-label">ที่อยู่ตามบัตรประชาชน</label>
      <div class="col-sm-8">
        <textarea class="form-control" name="address_card" id="address_card" rows="3" placeholder="ที่อยู่ตามบัตรประชาชน"/><?php echo $this->user['address']['card']?></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="ref_first" class="col-sm-4 control-label">ชื่อบุคคลอ้างอิง</label>
      <div class="col-sm-8">
        <input type="text" name="ref_first" class="form-control" id="ref_first" placeholder="ชื่อบุคคลอ้างอิง" value="<?php echo $this->user['ref']['first']?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="ref_last" class="col-sm-4 control-label">นามสกุลบุคคลอ้างอิง</label>
      <div class="col-sm-8">
        <input type="text" name="ref_last" class="form-control" id="ref_last" placeholder="นามสกุลบุคคลอ้างอิง" value="<?php echo $this->user['ref']['last']?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="ref_relationship" class="col-sm-4 control-label">เกี่ยวข้องเป็น</label>
      <div class="col-sm-8">
        <input type="text" name="ref_relationship" class="form-control" id="ref_relationship" placeholder="เกี่ยวข้องเป็น" value="<?php echo $this->user['ref']['relationship']?>"/>
      </div>
    </div>

    <div class="form-group">
      <label for="ref_phone" class="col-sm-4 control-label">เบอร์โทรศัพท์บุคคลอ้างอิง</label>
      <div class="col-sm-8">
        <input type="text" name="ref_phone" class="form-control" id="ref_phone" placeholder="เบอร์โทรศัพท์บุคคลอ้างอิง" data-inputmask='"mask": "099-999-9999"' data-mask value="<?php echo $this->user['ref']['phone']?>"/>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">บันทึก</button>
  </form>
</div>
<script>
$(function(){
  $('[data-mask]').inputmask();
  $('#birthday').datepicker({
    dateFormat: "yy-mm-dd",
    minDate: '-80Y',
    maxDate: '-15Y',
    yearRange: '-100:+0',
    changeMonth: true,
    changeYear: true
  });
  $('.showdate').datepicker({
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true
  });
  _.upload.create('#avatar',function(d,e){$('#img-avatar').attr('src',d.file);});
});
</script>
