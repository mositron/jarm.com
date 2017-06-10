<style>
.div-text{padding:7px 0px 7px;border-bottom:1px dashed #ccc;}
.btn-app {border-radius: 3px;position: relative;padding: 15px 5px;margin: 0 0 10px 10px;min-width: 80px;height: 60px;text-align: center;color: #666;border: 1px solid #ddd;background-color: #f4f4f4;font-size: 12px;}
.btn-app>.badge {position: absolute;top: -3px;right: -10px;font-size: 10px;font-weight: 400;}
.btn-app>.fa, .btn-app>.glyphicon, .btn-app>.ion {font-size: 20px;display: block;}
select.form-control + .chosen-container-multi .chosen-choices li.search-choice{margin:3px 5px 3px 0px;}
</style>
<ul class="breadcrumb">
  <li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/queue" title="">คิวงาน</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/queue/update/<?php echo $this->queue['_id']?>" title="">แก้ไข</a></li>
</ul>

<div class="box-white">
  <?php if($_SERVER['QUERY_STRING']=='completed'):?>
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
   ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว
  </div>
  <?php endif?>

  <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','updatequeue',this);return false;">
    <div class="form-group">
      <label>สถานที่ทำงาน</label>
      <input type="text" name="location" class="form-control" value="<?php echo $this->queue['location']?>" required>
    </div>

    <div class="form-group">
      <label>จังหวัด</label>
      <select name="province" id="province" class="form-control" required>
        <option value="0">เลือกจังหวัด</option>
        <?php foreach ((array)$this->province as $k=>$v):?>
          <option value="<?php echo $k?>"<?php echo $this->queue['province']==$k?' selected':''?>><?php echo $v['name_th']?></option>
        <?php endforeach?>
      </select>
    </div>

    <div class="form-group">
      <label>วันและเวลานัด</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-calendar"></i>
        </div>
        <input type="text" name="ds" readonly="readonly" class="form-control showdate" value="<?php echo $this->queue['ds1']?date('Y-m-d H:i',self::Time()->sec($this->queue['ds1'])).':00':''?><?php echo $this->queue['ds2']?' - '.date('Y-m-d H:i',self::Time()->sec($this->queue['ds2'])).':00':''?>" id="ds"/>
      </div>
    </div>

    <div class="form-group">
      <label>หมายเหตุ การนัดคิว</label>
      <textarea name="note_queue" id="note_queue" rows="3" cols="80" class="form-control" placeholder="หมายเหตุ"><?php echo $this->queue['note_queue']?></textarea>
    </div>

    <div class="form-group">
      <label>ทีมที่ต้องดำเนินงานต่อจากเสร็จคิวงาน</label>
      <div class="input-group">
        <?php foreach(['pt'=>['camera','Photo'],'pd'=>['film','Video Editor'],'gp'=>['photo','Graphic'],'ct'=>['newspaper-o','Content']] as $k=>$v):?>
        <a class="btn btn-app<?php echo $this->queue[$k]['p']?' active':''?>">
          <span class="badge bg-<?php echo $this->queue[$k]['p']?'green':'red'?>"><i class="fa fa-<?php echo $this->queue[$k]['p']?'check':'remove'?>"></i></span>
          <i class="fa fa-<?php echo $v[0]?>"></i> <?php echo $v[1]?>
          <input type="hidden" name="<?php echo $k?>_p"<?php echo $this->queue[$k]['p']?' value="1"':''?>>
        </a>
      <?php endforeach?>
      </div>
    </div><!-- /.form group -->

    <div class="form-group">
      <label>เจ้าหน้าที่ที่เกี่ยวข้อง</label>
      <select name="ref" data-placeholder="เลือกผู้เกี่ยวข้อง" class="chzn-select form-control" multiple required>
        <optgroup label="BOSS">
        <?php $last=1;foreach($this->people as $k=>$v):?>
        <?php if($v['code']>100 && $v['code']<=300 && $last!=2):$last=2;?>
        </optgroup><optgroup label="Jarm.com - iNet Revolutions">
        <?php elseif($v['code']>300 && $v['code']<=500 && $last!=3):$last=3;?>
        </optgroup><optgroup label="Jarm.com - ฝึกงาน">
        <?php elseif($v['code']>500 && $v['code']<=700 && $last!=4):$last=4;?>
        </optgroup><optgroup label="BoxzaRacing - Racing Box">
        <?php elseif($v['code']>700 && $v['code']<=900 && $last!=5):$last=5;?>
        </optgroup><optgroup label="BoxzaRacing - ฝึกงาน">
        <?php endif?>
        <option value="<?php echo $k?>"<?php echo in_array($k,(array)$this->queue['ref'])?' selected':''?>><?php echo $v['nickname'].' - '.$v['th']['first'].' '.$v['th']['last']?></option>
        <?php endforeach?>
        </optgroup>
      </select>
    </div>

    <div class="form-group">
      <label>หัวข้อ</label>
      <input type="text" name="name" class="form-control" value="<?php echo $this->queue['name']?>" required>
    </div>

    <div class="form-group">
      <label>เบอร์ติดต่อ</label>
      <input type="text" name="phone" class="form-control" value="<?php echo $this->queue['phone']?>" required>
    </div>

    <div class="form-group">
      <label>ประเภทงาน</label>
      <select name="type" id="type" class="form-control" required>
        <option value="0">เลือกประเภท</option>
        <?php foreach ((array)$this->type as $k=>$v):?>
          <option value="<?php echo $k?>"<?php echo $this->queue['type']==$k?' selected':''?>><?php echo $v['display']?></option>
        <?php endforeach?>
      </select>
    </div>

    <div class="form-group">
      <label>รูปภาพ</label>
      <div><img src="https://f1.jarm.com/team/queue/<?php echo $this->queue['_id']?>.jpg" id="img-photo"></div>
      <input type="file" id="photo" name="photo" class="form-control">
    </div>

    <div class="form-group">
      <label>รายละเอียดงาน</label>
      <textarea name="detail" id="detail" rows="3" cols="80" class="form-control" placeholder="รายละเอียดงาน"><?php echo $this->queue['detail']?></textarea>
    </div>

    <div class="form-group">
      <label>หมายเหตุ รายชื่องาน</label>
      <textarea name="note" id="note" rows="3" cols="80" class="form-control" placeholder="หมายเหตุ"><?php echo $this->queue['note']?></textarea>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
  </form>

  <div style="padding:10px 0px;border-top:1px solid #ddd;">
    <div class="row">
      <div class="col-xs-3 text-right">สร้างรายชื่องานโดย:</div>
      <?php $u=team::user()->get($this->queue['u'],true);?>
      <div class="col-xs-5"><a href="/user/<?php echo $u['_id']?>"><img src="https://f1.jarm.com/team/user/<?php echo $u['_id']?>-s.jpg" class="user-image" style="width: 25px; height: 25px; border-radius: 50%;" /> <?php echo $u['nickname']?> - <?php echo $u['name']?></a></div>
      <div class="col-xs-1 text-right">เมื่อ:</div>
      <div class="col-xs-3"><?php echo self::Time()->from($this->queue['da'],'datetime')?></div>
    </div>
    <?php if($this->queue['ue']):?>
    <div class="row">
      <div class="col-xs-3 text-right">แก้ไขรายชื่องานล่าสุดโดย:</div>
      <?php $u=team::user()->get($this->queue['ue'],true);?>
      <div class="col-xs-5"><a href="/user/<?php echo $u['_id']?>"><img src="https://f1.jarm.com/team/user/<?php echo $u['_id']?>-s.jpg" class="user-image" style="width: 25px; height: 25px; border-radius: 50%;" /> <?php echo $u['nickname']?> - <?php echo $u['name']?></a></div>
      <div class="col-xs-1 text-right">เมื่อ:</div>
      <div class="col-xs-3"><?php echo self::Time()->from($this->queue['de'],'datetime')?></div>
    </div>
    <?php endif?>
    <?php if($this->queue['upq']):?>
    <div class="row">
      <div class="col-xs-3 text-right">นัดคิวงานโดย:</div>
      <?php $u=team::user()->get($this->queue['upq'],true);?>
      <div class="col-xs-5"><a href="/user/<?php echo $u['_id']?>"><img src="https://f1.jarm.com/team/user/<?php echo $u['_id']?>-s.jpg" class="user-image" style="width: 25px; height: 25px; border-radius: 50%;" /> <?php echo $u['nickname']?> - <?php echo $u['name']?></a></div>
      <div class="col-xs-1 text-right">เมื่อ:</div>
      <div class="col-xs-3"><?php echo self::Time()->from($this->queue['dpq'],'datetime')?></div>
    </div>
    <?php endif?>
  </div>
</div>
<script>
$(function(){
  _.upload.create('#photo',function(d,e){$('#img-photo').attr('src',d.file);});
  $('.showdate').daterangepicker(
  {
    showInputs: false,
    timePicker: true,
    timePickerIncrement: 15,
    timePicker24Hour: true,
    showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD HH:mm:ss'
        }
  });
  $('.btn-app').click(function() {
    if($(this).hasClass('active'))
    {
      $(this).removeClass('active');
      $(this).find('.badge').addClass('bg-red').removeClass('bg-green');
      $(this).find('span>i').addClass('fa-remove').removeClass('fa-check');
      $(this).find('input[type="hidden"]').val('');
    }
    else
    {
      $(this).addClass('active');
      $(this).find('.badge').addClass('bg-green').removeClass('bg-red');
      $(this).find('span>i').addClass('fa-check').removeClass('fa-remove');
      $(this).find('input[type="hidden"]').val('1');
    }
    return false;
  });

  var config = {
     '.chzn-select'           : {},
     '.chzn-select-deselect'  : {allow_single_deselect:true},
     '.chzn-select-no-single' : {disable_search_threshold:10},
     '.chzn-select-no-results': {no_results_text:'Oops, nothing found!'},
     '.chzn-select-width'     : {width:"95%"}
   }
   for (var selector in config) {
     $(selector).chosen(config[selector]);
   }
});
</script>
