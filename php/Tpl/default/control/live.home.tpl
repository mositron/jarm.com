<style>
.form-group{border-bottom: 1px solid #eee;padding: 10px 0px;margin-bottom: 0px;}
.form-group>label{display:block;padding: 2px 6px;text-shadow: 1px 1px 0px #fff;border-radius: 4px;background:#f6f6f6;}
</style>
<h3 class="bar-heading">สร้างเครื่องมือ Live</h3>
<div style="padding:0px 10px 20px;">
<form class="form-horizontal" onsubmit="genpage(this);return false;" id="form">
  <div class="form-group">
    <label>ประเภท</label>
    <div style="padding:0px 25px">
      <?php $i=0;foreach ($this->type as $k=>$v):?>
      <label class="radio">
        <input type="radio" name="type" onclick="checkType()" value="<?php echo $k?>"<?php echo $i==0?' checked':''?>> <?php echo $v?>
      </label>
      <?php if($k=='like'):?>
        <div style="padding:0px 10px;border:1px dashed #ccc">
          <?php foreach ($this->like as $k2=>$v2):?>
          <label class="checkbox-inline">
            <input type="checkbox" name="like" class="like" value="<?php echo $k2?>"<?php echo $k2!='like'?' checked':''?>>
            <img src="https://cdn.jarm.com/img/live/<?php echo $v2?>.gif" width="32" height="32" style="margin:-5px 0px 0px -10px">
          </label>
        <?php endforeach?>
        </div>
      <?php elseif($k=='slide'):?>
        <div style="padding:5px 10px;border:1px dashed #ccc">
          ลิ้งค์รูปภาพ - ฝากไฟล์ไว้ที่อื่นแล้วน้ำลิ้งค์รูปภาพมาใช้งาน <input type="text" name="img" class="form-control" value="https://www.google.co.th/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png">
          <div style="margin-top:5px;">
            เวลาในการเคลื่อนที่ - ตั้งแต่เริ่มวิ่งจากขวาสุดจนรูปภาพหายไป
            <input type="text" name="speed" class="form-control" style="display:inline-block;width:60px" value="30"> วินาที
          </div>
          <div style="margin-top:5px;">
            เวลาในการซ่อนรูปภาพ - ดีเลย์สำหรับการแสดงรูปภาพในครั้งต่อไป
            <input type="text" name="delay" class="form-control" style="display:inline-block;width:60px" value="20"> วินาที
          </div>
        </div>
      <?php endif?>
      <?php $i++;endforeach?>
    </div>
  </div>
  <div class="form-group request_token">
    <label for="exampleInputEmail1">Access Token</label>
    <input type="text" class="form-control" value="<?php echo $this->access?>" name="access" id="access">
    <p class="help-block"><a href="javascript:;" onclick="window.open('https://developers.facebook.com/tools/debug/accesstoken?q='+$('#access').val(),'_blank')" class="btn btn-xs btn-warning">ตรวจสอบ</a></a>
  </div>
  <div class="form-group request_token">
    <label>เพจ</label>
    <div style="padding:0px 25px">
      <?php $i=0;foreach ($this->page as $k=>$v):?>
      <label class="radio">
        <input type="radio" class="page" name="page" value="<?php echo $v['id']?>"<?php echo $i==0?' checked':''?>> <?php echo $v['t']?>
      </label>
      <?php $i++;endforeach?>
    </div>
  </div>
  <div class="form-group request_token">
    <label>ไอดีโพส</label>
    <input type="text" class="form-control" id="post" value="<?php echo $this->postid?>">
    <p class="help-block">เฉพาะตัวเลข - ไอดีโพสชุดหลัง</p>
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-primary">สร้างหน้าเว็บ</button>
  </div>
</form>

<script>
function genpage(t)
{
  var like='',url='';
  if(t.type.value=='like')
  {
    $('.like:checked').each(function(i,v){
      like+='-'+$(v).val();
    });
  }
  if(t.type.value=='slide')
  {
    url=t.type.value+'-'+t.speed.value+'-'+t.delay.value+'/?img='+t.img.value;
  }
  else if(t.type.value=='lotto')
  {
    url=t.type.value;
  }
  else
  {
    url=t.type.value+like+'/'+t.page.value+'/'+t.post.value+'/'+t.access.value;
  }
  window.open('<?php echo self::uri(['control','/live/'])?>'+url,'_blank');
}
function checkType()
{
  var t=$('#form').get(0).type.value;
  if(t=='comment'||t=='note'||t=='like')
  {
    $('.request_token').css('display','block');
  }
  else
  {
    $('.request_token').css('display','none');
  }
}
checkType();
</script>
