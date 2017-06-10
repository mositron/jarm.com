<style>
.form-horizontal .form-group {
margin-bottom:8px;
padding-bottom: 10px;
border-bottom: 1px dashed #F0F0F0;
}
.bn{display:inline-block; padding:0px; height:20px; line-height:20px; width:20px; overflow:hidden; text-align:center; background:#CBEFF2; color:#000; text-shadow:1px 1px 0px #fff; vertical-align:middle;}
.bn.bn-a{background:#F3CECE;}
.bn.bn-f{background:#F7EBE1;}
.bn.bn-h,.bn.bn-i{background:#D6D4F4;}
.bn.bn-b1,.bn.bn-b2{background:#F1F2CB;}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>js/ui/jquery-ui-1.10.1.custom.min.css">
<script type="text/javascript" src="<?php echo FILES_CDN?>js/ui/jquery-ui-1.10.1.custom.min.js"></script>


<div>


<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
   <li><a href="/banner"><span class="glyphicon glyphicon-eye-open"></span> แบนเนอร์ทั้งหมด</a></li>

<?php if($this->access):?>
    <li class="pull-right"><a href="/banner"><span class="glyphicon glyphicon-eye-open"></span> กลับไปหน้ารวม</a></li>
<?php else:?>
 <li class="pull-right"><span class="glyphicon glyphicon-question-sign"></span> ไม่มีสิทธิ์แก้ไขข้อมูลภายในส่วนนี้</li>
<?php endif?>
</ul>

<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">แก้ไขแบนเนอร์</h2>

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
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/banner">แบนเนอร์ทั้งหมด </a>)
</div>
<?php endif?>
<?php if($this->banner['pl']):?>
<div class="alert alert-info">  <h4 class="alert-heading">เผยแพร่แล้ว!</h4> แบนเนอร์นี้ทำการเผยแพร่แล้ว</div>
<?php endif?>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="form-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="col-sm-2 control-label" for="input01">ชื่อแบนเนอร์:</label>
<div class="col-sm-10">
<input type="text" id="input01" class="form-control" name="title" value="<?php echo htmlspecialchars($this->banner['t'],ENT_QUOTES,'utf-8')?>" required>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>

 <div class="form-group">
<label class="col-sm-2 control-label">ประเภท:</label>
<div class="col-sm-10">
<label class="checkbox-inline"><input type="radio" name="type" onClick="checktype()" value="0"<?php echo !$this->banner['tyc']?' checked':''?>> รูปภาพ</label>
<label class="checkbox-inline"><input type="radio" name="type" onClick="checktype()" value="1"<?php echo $this->banner['tyc']?' checked':''?>> โค๊ด</label>
</div>
</div>

<div id="type_img">
<div class="form-group">
<label class="col-sm-2 control-label" for="input10">รูปภาพ / Flash:</label>
<div class="col-sm-10">
<?php if($this->banner['s']):?>
<?php if($this->banner['ex']=='swf'):?>
<object width="<?php echo $this->banner['w']?>" height="<?php echo $this->banner['h']?>"><param name="movie" value="https://s2.jarm.com/banner/<?php echo $this->banner['fd']?>/<?php echo $this->banner['s']?>"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="transparent"><embed src="https://s2.jarm.com/banner/<?php echo $this->banner['fd']?>/<?php echo $this->banner['s']?>" type="application/x-shockwave-flash" width="<?php echo $this->banner['w']?>" height="<?php echo $this->banner['h']?>" allowscriptaccess="always" allowfullscreen="true" wmode="transparent"></embed></object>
<?php else:?>
<img src="https://s2.jarm.com/banner/<?php echo $this->banner['fd']?>/<?php echo $this->banner['s']?>"><br>
<?php endif?>
<div style="padding:5px; border:1px solid #ddd; background:#f5f5f5;">ประเภทไฟล์: <?php echo $this->banner['ex']?>, กว้าง: <?php echo $this->banner['w']?>, สูง: <?php echo $this->banner['h']?> </div>
<?php endif?>
<input type="file" id="input10" class="form-control" size="20" name="o">
<p class="help-block">* บังคับเลือก - ระบบจะใช้รูปภาพเดิม โดยไม่มีการ resize</p>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="input12">ลิ้งค์ปลายทาง:</label>
<div class="col-sm-10">
<input type="text" id="input12" class="form-control" name="link" value="<?php echo htmlspecialchars($this->banner['l'],ENT_QUOTES,'utf-8')?>">
</div>
</div>
</div>
<div id="type_code">
<div class="form-group">
<label class="col-sm-2 control-label" for="input13">โค๊ด:</label>
<div class="col-sm-10">
<textarea id="input13" class="form-control" style="height:100px" name="code"><?php echo htmlspecialchars($this->banner['code'],ENT_QUOTES,'utf-8')?></textarea>
</div>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="input03">รายละเอียด:</label>
<div class="col-sm-10">
<textarea id="input03" class="form-control" name="detail"><?php echo $this->banner['d']?></textarea>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label" for="input01">ตำแหน่ง:</label>
<div class="col-sm-10">
<div style="padding-bottom:5px; margin-bottom:5px; border-bottom:1px solid #F90"><span class="bn bn-a">A</span> 960x125, <span class="bn">B</span> - <span class="bn">E</span> 628x90, <span class="bn bn-f">F</span> 960x125, <span class="bn bn-h">H</span> - <span class="bn bn-h">I</span> 300x250, <span class="bn bn-b1">B1</span> - <span class="bn bn-b2">B2</span> 125x450</div>
<?php foreach($this->position as $k=>$v):?>
<div>
<strong><?php echo $v['t']?></strong><br>
<?php for($i=0;$i<count($v['l']);$i++):?>
<?php $c=($this->banner['p']&&is_array($this->banner['p'][$k]))?$this->banner['p'][$k]:[];?>
<?php if($k=='football'):?>
<?php echo $i?', ':''?><label class="checkbox-inline"><input type="checkbox" name="position[<?php echo $k?>][]" value="<?php echo $v['l'][$i]?>"<?php echo in_array($v['l'][$i],$c)?' checked':''?>> <?php echo $this->football_position[$v['l'][$i]]?></label>
<?php else:?>
<?php echo $i?', ':''?><label class="checkbox-inline"><input type="checkbox" name="position[<?php echo $k?>][]" value="<?php echo $v['l'][$i]?>"<?php echo in_array($v['l'][$i],$c)?' checked':''?>> <span class="bn bn-<?php echo $v['l'][$i]?>"><?php echo strtoupper($v['l'][$i])?></span></label>
<?php endif?>
<?php endfor?>
</div>
<?php endforeach?>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="input09">ลำดับในการแสดง:</label>
<div class="col-sm-10">
<input type="number" id="input09" class="form-control" name="sort" value="<?php echo $this->banner['so']?>">
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">เวลาในการแสดงผล:</label>
<div class="col-sm-10">จาก
<input type="text" class="col-sm-2 date" name="date1" value="<?php echo date('Y-m-d',$this->banner['dt1']?self::Time()->sec($this->banner['dt1']):time())?>" required> - ถึง
<input type="text" class="col-sm-2 date" name="date2" value="<?php echo date('Y-m-d',$this->banner['dt2']?self::Time()->sec($this->banner['dt2']):time())?>" required>
</div>
</div>

 <div class="form-group">
<label class="col-sm-2 control-label" for="input02">การเผยแพร่:</label>
<div class="col-sm-10 category">
<label class="checkbox-inline"><input type="radio" name="publish" value="1"<?php echo $this->banner['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox-inline"><input type="radio" name="publish" value="0"<?php echo !$this->banner['pl']?' checked':''?>> ไม่แสดง</label>
</div>
</div>


<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/news">ยกเลิก</a>
</div>
</div>
</fieldset>
</form>



</div>

<script>
  $(function() {
    $( ".date" ).datepicker({
      dateFormat: 'yy-mm-dd',
    });
  checktype();
  });
function checktype()
{
  if($('input[name=type]:checked').val()=='1')
  {
    $('#type_code').css('display','block');
    $('#type_img').css('display','none');
  }
  else
  {
    $('#type_code').css('display','none');
    $('#type_img').css('display','block');
  }
}
</script>
