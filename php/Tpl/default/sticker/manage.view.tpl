<style type="text/css">
.table .col-sm-12{margin-bottom:2px;}
.table .colum{width:130px; text-align:right;}
.table td.r{width:130px; text-align:right;}
#imgs > div{padding: 5px;border-bottom: 1px dashed #ccc;}
</style>
<div>
<ul class="nav nav-tabs">
<li><a href="/manage/" class="h"> สติกเกอร์ของฉัน</a></li>
<li><a href="/manage/new"<?php if(self::$path[0]=='new'):?> class="active"<?php endif?>><span class="glyphicon glyphicon-plus"></span> เพิ่มสติกเกอร์ใหม่</a></li>
</ul>

<?php if($this->error):?>
<div class="alert alert-error">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">ผิดพลาด!</h4>
 <?php echo implode('<br>',$this->error);?>
</div>
<?php endif?>


<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/manage">สติกเกอร์ของคุณ </a><?php if($this->app['pl']):?>, <a href="/view/<?php echo $this->app['_id']?>">หน้าแสดงผล</a><?php endif?>)
</div>
<?php endif?>
<?php if($this->app['pl']):?>
<div class="alert alert-info">
  <h4 class="alert-heading">เผยแพร่แล้ว!</h4>
 เกมนี้ทำการเผยแพร่แล้ว  (กลับไปยัง <a href="/manage">สติกเกอร์ของคุณ </a><?php if($this->app['pl']):?>, <a href="/view/<?php echo $this->app['_id']?>">หน้าแสดงผล</a><?php endif?>)
</div>
<?php endif?>

<div style="padding:5px; margin-bottom:5px;">
<div id="getview">
<form method="post" enctype="multipart/form-data" action="<?php echo URL?>">
<table cellpadding="5" cellspacing="1" border="0" class="table table-condensed">
<tr class="warning"><td colspan="2" style="text-align:center">รายละเอียดสติกเกอร์</td></tr>
<tr><td class="colum">ชื่อสติกเกอร์ <small>:</small></td><td valign='top'><input type="text" class="col-sm-12" name="title" value="<?php echo $this->app['t']?>" maxlength="50" required><br><span class="req">*</span> สูงสุดไม่เกิน 30 ตัวอักษร</td></tr>
<tr><td class="colum">รูปภาพตัวอย่าง <small>:</small></td><td valign='top'>
<div><img src="<?php if($this->app['img']):?><?php echo self::uri(['s3','/sticker/cover/'.$this->app['fd'].'/s.png'])?><?php endif?>" class="prv-img"></div>
<input type="file" name="photo" id="photo"<?php echo self::$path[0]=='new'?' required':''?>> <br>*  ขนาดภาพประมาณ 200x200 (ระบบย่อและ crop ให้อัตโนมัติ)
</td></tr>
<tr><td class="colum">หมวดของสติกเกอร์ <small>:</small></td><td valign='top'>
<select name="cate" required>
<option value="">เลือกหมวดของสติกเกอร์</option>
<?php foreach($this->cate as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $this->app['c']==$k?' selected':''?>><?php echo $v['t']?></option>
<?php endforeach?>
</select>
</td>
</tr>
<tr><td class="colum">ที่มา <small>:</small></td><td valign='top'>
<select name="ref" required>
<option value="">เลือกที่มา</option>
<?php foreach($this->ref as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $this->app['ref']==$k?' selected':''?>><?php echo $v['t']?></option>
<?php endforeach?>
</select>
</td>
</tr>
<tr><td class="colum">รูปภาพสติกเกอร์ <small>:</small></td><td valign='top'>
<div style="color:#f00">
<strong>กฏในการอัพโหลดรูปภาพ</strong><br>
- ต้องเป็นรูปภาพของตัวเอง หรือรูปภาพฟรีที่ไม่มีลิขสิทธิ์<br>
- ต้องเป็นรูปภาพที่คล้ายหรือเป็น Collection เดียวกัน<br>
- ต้องมีอย่างน้อย 5 รูปถึงจะเผยแพร่ได้<br>
- สติกเกอร์ 1ชุด สามารถมีรูปภาพได้ไม่เกิน 30รูป <br>
- ต้องเป็นรูปภาพประเภท sticker หรือ icon เท่านั้น<br>
* หากฝ่าฝืน สติกเกอร์ของคุณจะถูกลบทันทีโดยไม่ต้องแจ้งให้ทราบล่วงหน้า
</div>
<div id="imgs" class="row">
<?php if($this->icon):$i=0;?>
<ul class="thumbnails row-count-4">
<?php foreach($this->icon as $icon):?>
<li class="col-sm-3 text-center">
<div><img src="<?php echo self::uri(['s3','/sticker/icon/'.$icon['fd'].'/'.($icon['gif']?$icon['gif']:$icon['png'])])?>" class="prv-img"></div>
<label><input type="checkbox" name="delo[]" value="<?php echo $icon['_id']?>"> ลบรูปภาพนี้</label>
</li>
<?php endforeach?>
</ul>
<?php endif?>

<div style="padding:10px; border:1px solid #ccc; background:#f8f8f8; margin:5px 0px 0px">
<strong>สามารถเพิ่มได้ครั้งละหลายไฟล์</strong><br>
<input type="file" name="photo_icon[]" multiple>
</div>
</div>

</td></tr>
<?php if(self::$my['am']>=9):?>
<tr><td>ตั้งเป็นสติกเกอร์ยอดฮิต</td><td>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="rc" value="1"<?php echo $this->app['rc']?' checked':''?>> เกมยอดฮิต</label>
<label class="checkbox inline"><input type="radio" name="rc" value=""<?php echo !$this->app['rc']?' checked':''?>> เกมทั่วไป</label>
</div>
</td></tr>
<?php endif?>

<tr><td>การแสดงผล</td><td>
<div class="controls category">
<label class="checkbox inline"><input type="radio" name="published" value="1"<?php echo $this->app['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox inline"><input type="radio" name="published" value="0"<?php echo !$this->app['pl']?' checked':''?>> ไม่แสดง</label>
</div>
- ตั้งให้สติกเกอร์นี้แสดงผลในหน้าเว็บ และสามารถนำไปใช้งานได้<br>
- ต้องมีรูปภาพอย่างน้อย 5 รูป ถึงจะสามารถเผยแพร่ได้
</td></tr>

<tr><td class="colum"></td><td valign='top'><input type="submit" class="btn btn-info" value="          บันทึก          ">  หรือกลับไปยัง <a href="/manage" class="btn btn-xs btn-default">สติกเกอร์ของฉัน</a></td></tr>
</table>
</form>

</div>
</div>
</div>


<script>
function delans(e)
{
  if(confirm('ต้องการลบคำตอบนี้หรือไม่'))
  {
    $(e).parent().parent().parent().parent().remove();
    $('.ans_no').each(function(index, element) {
      $(this).html(index+1);
    });
    calans();
  }
}

function delquest(e)
{
  if(confirm('ต้องการลบคำถามนี้หรือไม่'))
  {
    $(e).parent().parent().parent().parent().remove();
    $('.quest_no').each(function(index, element) {
      $(this).html(index+1);
    });
  }
}

function addans()
{
  if($('.quest_no').length>=10)
  {
    alert('สามารถคำตอบได้สูงสุด 10 คำตอบเท่านั้น');
    return;
  }
  $('#app_answer').append('<table width="100%" class="table table-condensed">'+
'<tbody>'+
'<tr class="info"><td colspan="2" style="text-align:center">ผลลัพธ์ที่ <span class="ans_no"></span><input type="hidden" name="ans_id[]" value=""></td></tr>'+
'<tr><td class="r">ชื่อผลลัพธ์</td><td><input type="text" name="ans_t[]" class="col-sm-12 inp_ans" value="" onBlur="calans()" required></td></tr>'+
'<tr><td class="r">คำอธิบายผลลัพธ์</td><td><textarea name="ans_d[]" class="col-sm-12" style="height:70px" required></textarea></td></tr>'+
'<tr><td class="r">รูปภาพประกอบ</td><td><input type="file" name="ans_i[]"><br>ปล่อยว่างได้: ขนาดภาพประมาณ 200x200 (ระบบย่อและ crop ให้อัตโนมัติ)</td></tr>'+
'<tr><td class="r"></td><td><a href="javascript:;" class="btn btn-xs btn-default" onClick="delans(this)"><span class="glyphicon glyphicon-trash"></span> ลบคำตอบนี้</a></td></tr>'+
'</tbody>'+
'</table>');
  $('.ans_no').each(function(index, element) {
        $(this).html(index+1);
    });
  calans();
}

function addquest()
{
  if($('.quest_no').length>=20)
  {
    alert('สามารถคำถามได้สูงสุด 20 คำถามเท่านั้น');
    return;
  }
  var tmp='<table width="100%" class="table table-condensed">'+
'<tbody>'+
'<tr class="info"><td colspan="2" style="text-align:center">คำถามที่ <span class="quest_no"></span><input type="hidden" name="quest_id[]" value=""></td></tr>'+
'<tr class="q"><td class="r">คำถาม</td><td><input type="text" name="quest_t[]" class="col-sm-12" value="" required></td></tr>';
  var c=$('#app_answer > table').length;
  for(var j=0;j<c;j++)
  {
    tmp+='<tr class="a"><td class="r">คำตอบที่ <span class="qans_no"></span></td><td><input type="text" name="quest_a[]" class="col-sm-12" value="" required><div class="ans_v"></div></td></tr>';
  }
  tmp+='<tr class="r"><td class="r"></td><td><a href="javascript:;" class="btn btn-xs btn-default" onClick="delquest(this)"><span class="glyphicon glyphicon-trash"></span> ลบคำถามนี้</a> - หมายเหตุ: ระบบจะสลับคำถาม และสลับคำตอบให้อัตโนมัติ</td></tr>'+
'</tbody>'+
'</table>';
  $('#app_question').append(tmp);
  $('.quest_no').each(function(index, element) {
        $(this).html(index+1);
    });
  calans();
}

function calans()
{
  var a=$('.inp_ans');
  $('#app_question > table').each(function(index, element) {
        var q=$(this).find('tr.a');
    if(a.length<q.length)
    {
      q.slice(a.length).remove();
    }
    else if(a.length>q.length)
    {
      var w=$(this).find('tr.r');
      for(var o=q.length;o<a.length;o++)
      {
        w.before('<tr class="a"><td class="r">คำตอบที่ <span class="qans_no"></span></td><td><input type="text" name="quest_a[]" class="col-sm-12" value="" required><div class="ans_v"></div></td></tr>');
      }
    }
    $(this).find('.qans_no').each(function(index, element) {
            $(this).html(index+1);
        });
    $(this).find('.ans_v').each(function(index, element) {
            $(this).html('ตรงกับผลลัพธ์:  '+(index+1)+'. '+a.get(index).value);
        });
    });
}

$(function(){calans();});
</script>
