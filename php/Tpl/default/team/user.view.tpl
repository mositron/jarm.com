<ul class="breadcrumb">
  <li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/user" title="">สมาชิก</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/user/<?php echo $this->user['_id']?>" title=""><?php echo $this->user['th']['first']?> <?php echo $this->user['th']['last']?></a></li>
  <?php if (team::$my['grade']==99||team::$my['_id']==$this->user['_id']):?>
    <span></span>
    <li class="pull-right" style="margin:-3px -2px 1px;"><a href="/user/update/<?php echo $this->user['_id']?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></li>
  <?php endif?>
</ul>

<style>
.lr{padding-top:7px;border-bottom:1px dashed #ccc;padding-bottom:3px;min-height:28px;}
</style>

<div class="box-white">
  <form action="<?php echo URL?>" class="form-horizontal" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="avatar" class="col-sm-4 control-label">รูปภาพประจำตัว</label>
    <div class="col-sm-8 lr">
      <img src="https://f1.jarm.com/team/user/<?php echo $this->user['_id']?>-s.jpg" class="img-responsive img-circle">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-4 control-label">อีเมล์</label>
    <div class="col-sm-8 lr"><?php echo $this->user['email']?></div>
  </div>
  <div class="form-group">
    <label for="nickname" class="col-sm-4 control-label">ชื่อเล่น</label>
    <div class="col-sm-8 lr"><?php echo $this->user['nickname']?></div>
  </div>

  <div class="form-group">
    <label for="th_first" class="col-sm-4 control-label">ชื่อจริง</label>
    <div class="col-sm-8 lr"><?php echo $this->user['th']['first']?></div>
  </div>

  <div class="form-group">
    <label for="th_last" class="col-sm-4 control-label">สกุลจริง</label>
    <div class="col-sm-8 lr"><?php echo $this->user['th']['last']?></div>
  </div>

  <div class="form-group">
    <label for="en_first" class="col-sm-4 control-label">Firstname</label>
    <div class="col-sm-8 lr"><?php echo $this->user['en']['first']?></div>
  </div>

  <div class="form-group">
    <label for="en_last" class="col-sm-4 control-label">Lastname</label>
    <div class="col-sm-8 lr"><?php echo $this->user['en']['last']?></div>
  </div>

  <div class="form-group">
    <label for="sex" class="col-sm-4 control-label">เพศ</label>
    <div class="col-sm-8 lr"><?php echo $this->user['sex']=='male'?'ผู้ชาย':''?> <?php echo $this->user['sex']=='female'?'ผู้หญิง':''?></div>
  </div>

  <div class="form-group">
    <label for="birthday" class="col-sm-4 control-label">วันเกิด</label>
    <div class="col-sm-8 lr"><?php echo $this->user['birthday']?date('Y-m-d',self::Time()->sec($this->user['birthday'])):''?></div>
  </div>

  <?php if (team::$my['grade']==99 || team::$my['grade']==9 || team::$my['grade']==14 || team::$my['_id']==$this->user['_id']): ?>
  <div class="form-group">
    <label for="birthday" class="col-sm-4 control-label">วันเริ่มงาน</label>
    <div class="col-sm-8 lr"><?php echo $this->user['word']['start']?date('Y-m-d',self::Time()->sec($this->user['word']['start'])):''?></div>
  </div>

  <div class="form-group">
    <label for="id_card" class="col-sm-4 control-label">เลขประจำตัวบัตรประชาชน</label>
    <div class="col-sm-8 lr"><?php echo $this->user['id_card']?></div>
  </div>

  <div class="form-group">
    <label for="deposit_account_name" class="col-sm-4 control-label">ชื่อบัญชีธนาคาร</label>
    <div class="col-sm-8 lr"><?php echo $this->user['bank']['name']?></div>
  </div>

  <div class="form-group">
    <label for="bank_ID" class="col-sm-4 control-label">ธนาคาร</label>
    <div class="col-sm-8 lr"><?php echo $this->bank[$this->user['bank']['id']]?></div>
  </div>

  <div class="form-group">
    <label for="deposit_account_number" class="col-sm-4 control-label">เลขบัญชีธนาคาร</label>
    <div class="col-sm-8 lr"><?php echo $this->user['bank']['number']?></div>
  </div>
  <?php endif?>
  <div class="form-group">
    <label for="line_id" class="col-sm-4 control-label">Line ID</label>
    <div class="col-sm-8 lr"><?php echo $this->user['line_id']?></div>
  </div>

  <div class="form-group">
    <label for="phone" class="col-sm-4 control-label">เบอร์โทรศัพท์ที่ติดต่อได้</label>
    <div class="col-sm-8 lr"><?php echo $this->user['phone']?></div>
  </div>

  <?php if (team::$my['grade']==99 || team::$my['grade']==9 || team::$my['grade']==14 || team::$my['_id']==$this->user['_id']): ?>
  <div class="form-group">
    <label for="address_current" class="col-sm-4 control-label">ที่อยู่ปัจจุบัน</label>
    <div class="col-sm-8 lr"><?php echo $this->user['address']['current']?></div>
  </div>

  <div class="form-group">
    <label for="address_card" class="col-sm-4 control-label">ที่อยู่ตามบัตรประชาชน</label>
    <div class="col-sm-8 lr"><?php echo $this->user['address']['card']?></div>
  </div>

  <div class="form-group">
    <label for="ref_first" class="col-sm-4 control-label">ชื่อบุคคลอ้างอิง</label>
    <div class="col-sm-8 lr"><?php echo $this->user['ref']['first']?></div>
  </div>

  <div class="form-group">
    <label for="ref_last" class="col-sm-4 control-label">นามสกุลบุคคลอ้างอิง</label>
    <div class="col-sm-8 lr"><?php echo $this->user['ref']['last']?></div>
  </div>

  <div class="form-group">
    <label for="ref_relationship" class="col-sm-4 control-label">เกี่ยวข้องเป็น</label>
    <div class="col-sm-8 lr"><?php echo $this->user['ref']['relationship']?></div>
  </div>

  <div class="form-group">
    <label for="ref_phone" class="col-sm-4 control-label">เบอร์โทรศัพท์บุคคลอ้างอิง</label>
    <div class="col-sm-8 lr"><?php echo $this->user['ref']['phone']?></div>
  </div>
<?php endif?>
  </form>
</div>
