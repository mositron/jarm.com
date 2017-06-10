<style>
.box-border{max-width: 500px;margin: 30px auto 40px;padding: 20px;background: #fff;border-radius: 10px;border: 3px solid #f0f0f0;}
.box-border2{max-width:700px;}

@media (max-width: 768px) {
  .box-border{margin-top:-5px !important; margin-bottom:5px !important;}
}
</style>
<div class="col-content">
  <div class="box-border">
    <h2 class="bar-heading" style="margin-bottom:10px">เข้าสู่ระบบ</h2>
    <div>
    <?php if(isset($this->error)):?><div style="padding:5px; margin:5px 5px 0px; color:#fff; background-color:#f00; text-align:center"><?php echo $this->error?></div> <?php endif?>
      <form method="post" action="<?php echo URI.$this->q?>" class="form-horizontal">
        <input type="hidden" name="type" value="login">
        <div class="form-group">
          <label for="inpEmail" class="col-sm-2 control-label">อีเมล์</label>
          <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="inpEmail" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <label for="inpPass" class="col-sm-2 control-label">รหัสผ่าน</label>
          <div class="col-sm-10">
            <input type="password" name="password" class="form-control" id="inpPass" placeholder="">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label><input name="aways" type="checkbox" value="1"> เข้าสู่ระบบอัตโนมัติ (ล็อคอินแบบถาวร)</label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" value=" เข้าระบบ " class="btn btn-info"> | <a href="javascript:;" onClick="_.box.open('#forget')">ลืมรหัสผ่าน</a>
          </div>
        </div>
        <div class="form-group">
          <style>
          .btn-fb{color:#fff;background:#3b5998;text-align:center;display:block;margin:0px 0px 10px;}
          .btn-gg{color:#fff;background:#c00;text-align:center;display:block;margin:0px 0px 10px;}
          a.btn-fb:hover,a.btn-gg:hover{color:#fff;}
          </style>
          <?php if(isset($_GET['error'])):?><div style="padding:5px; margin:0px 0px 20px; color:#f00; background:#fff;border:1px solid #f00; text-align:center"><?php echo get_error($_GET['error'])?></div> <?php endif?>
          <div><a href="/login/facebook" class="btn btn-md btn-fb">เข้าระบบด้วยบัญชี Facebook</a></div>
          <div><a href="/login/google" class="btn btn-md btn-gg">เข้าระบบด้วยบัญชี Google</a></div>
        </div>
      </form>
    </div>
    <div class="olg-reg">
      <h2 class="bar-heading" style="margin-bottom:10px">สมัครสมาชิก</h2>
      <div>
        <div>ยังไม่มีบัญชีของ Jarm? สร้างบัญชีใหม่ฟรี ภายในไม่ถึง 1 นาที</div>
        <div><a href="/signup/<?php echo $this->q??''?>" class="btn btn-sm btn-success">สร้างบัญชีใหม่</a></div>
      </div>
    </div>
    <div id="forget" class="gbox" style="width:450px">
      <form onSubmit="_.ajax.gourl('/login','forget',this);_.box.close();return false;">
        <div class="gbox_header">ลืมรหัสผ่าน</div>
        <div class="gbox_content" style="text-align:left;">
          <table cellpadding="10" cellspacing="1" border="0" width="100%" class="tbservice">
            <tr><td class="colum">อีเมล์</td><td align="left"><input type="text" name="email" class="tbox" style="width:200px"></td></tr>
          </table>
        </div>
        <div class="gbox_footer"><input type="submit" class="button blue" value=" ขอเปลี่ยนรหัสผ่าน "> <input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
      </form>
    </div>
  </div>
</div>
