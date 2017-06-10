<style>
.form-horizontal .form-group {
margin-bottom:8px;
padding-bottom: 10px;
border-bottom: 1px dashed #F0F0F0;
}
.bn{display:inline-block; padding:0px; height:20px; line-height:20px; width:20px; overflow:hidden; text-align:center; background:#CBEFF2; color:#000; text-shadow:1px 1px 0px #fff; vertical-align:middle;}
.bn.bn-a,.bn.bn-a1{background:#F3CECE;}
.bn.bn-f,.bn.bn-a6{background:#F7EBE1;}
.bn.bn-h,.bn.bn-i,.bn.bn-h1{background:#D6D4F4;}
.bn.bn-h2,.bn.bn-h3{background:#F1C5F0;}
.bn.bn-b{background:#CCC;}
.bn.bn-b1,.bn.bn-b2,.bn.bn-l,.bn.bn-r{background:#F1F2CB;}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>js/ui/jquery-ui-1.10.1.custom.min.css">
<script type="text/javascript" src="<?php echo FILES_CDN?>js/ui/jquery-ui-1.10.1.custom.min.js"></script>

<div>
<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
   <li><a href="/relate/all"><span class="glyphicon glyphicon-eye-open"></span> ข่าวใกล้เคียง</a></li>

<?php if($this->access):?>
    <li class="pull-right"><a href="/relate/all"><span class="glyphicon glyphicon-eye-open"></span> กลับไปหน้ารวม</a></li>
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
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/relate">แบนเนอร์ทั้งหมด </a>)
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
<label class="col-sm-2 control-label" for="input02">ไอดีข่าว:</label>
<div class="col-sm-10">
<input type="text" id="input02" class="form-control" name="content" value="<?php echo htmlspecialchars($this->banner['content'],ENT_QUOTES,'utf-8')?>" required>
<p class="help-block">* บังคับกรอก - ไอดีของข่าวที่จะนำมาแสดง</p>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="input01">ตำแหน่ง:</label>
<div class="col-sm-10">
<?php foreach($this->relate_position as $k=>$s):?>
<div style="padding-bottom:10px; margin-bottom:10px; border-bottom:2px solid #ccc;">
<h3 class="bar-heading"><?php echo $s['t']?></h3>
<?php foreach($s['l'] as  $x=>$v):?>
<?php $c=$this->banner[$k]??[];?>
<div>
<label class="checkbox-inline"><input type="checkbox" name="<?php echo $k?>[<?php echo $x?>]" class="ads-pos" value="1"<?php echo !empty($c[$x])?' checked':''?>> <span><?php echo $v['t']?></span></label>
</div>
<?php endforeach?>
</div>
<?php endforeach?>
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

<!--div class="form-group">
<label class="col-sm-2 control-label" for="input02">สถิติสำหรับบุคคลภายนอก:</label>
<div class="col-sm-10" style="padding-top:7px;"><a href="https://ads.jarm.com/view/<?php echo $this->banner['_id'].'-'.$this->banner['sc']?>" target="_blank">https://ads.jarm.com/view/<?php echo $this->banner['_id'].'-'.$this->banner['sc']?></a><br>
หน้าแสดงสถิติสำหรับลูกค้าหรือบุคคลภายนอก*
</div>
</div-->


<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/relate">ยกเลิก</a>
</div>
</div>
</fieldset>
</form>



</div>

<script>
function newads(t)
{
  if(t=='l')
  {
    $('.ads-position').val('l')
    $('.ads-position-label').html('L');
  }
  else
  {
    $('.ads-position').val('r')
    $('.ads-position-label').html('R');
  }
  _.box.open('#newbanner');
}

function getAdsA1()
{
  //asd-pos-a1
  if($('.ads-pos-a1:checked').length)
  {
    $('.form-ads-a1').css('display','block');
  }
  else
  {
    $('.form-ads-a1').css('display','none');
  }
}
$(function() {
    $( ".date" ).datepicker({
      dateFormat: 'yy-mm-dd',
    });
  checktype();
  getAdsA1();
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
