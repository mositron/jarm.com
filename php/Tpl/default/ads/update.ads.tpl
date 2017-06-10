<style>
.form-horizontal .form-group {margin-bottom:8px;padding-bottom: 10px;border-bottom: 1px dashed #F0F0F0;}
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

<div id="newbanner" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newbanner',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มแบนเนอร์ใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right" width="150">ชื่อแบนเนอร์:</td><td align="left"><input type="text" name="title" size="50" class="tbox" required></td></tr>
<tr><td align="right" width="150">ตำแหน่ง</td><td><input type="hidden" class="ads-position" name="position" value="l"><span class="ads-position-label">L</span></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<div>
<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
   <li><a href="/ads/all"><span class="glyphicon glyphicon-eye-open"></span> แบนเนอร์ทั้งหมด</a></li>

<?php if($this->access):?>
    <li class="pull-right"><a href="/ads/all"><span class="glyphicon glyphicon-eye-open"></span> กลับไปหน้ารวม</a></li>
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
<object width="<?php echo $this->banner['w']?>" height="<?php echo $this->banner['h']?>"><param name="movie" value="https://ads.jarm.com/_upload/<?php echo $this->banner['fd']?>/<?php echo $this->banner['s']?>"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="transparent"><embed src="https://s2.jarm.com/banner/<?php echo $this->banner['fd']?>/<?php echo $this->banner['s']?>" type="application/x-shockwave-flash" width="<?php echo $this->banner['w']?>" height="<?php echo $this->banner['h']?>" allowscriptaccess="always" allowfullscreen="true" wmode="transparent"></embed></object>
<?php else:?>
<img src="https://ads.jarm.com/_upload/<?php echo $this->banner['fd']?>/<?php echo $this->banner['s']?>?rnd=<?php echo rand(1,9999)?>" class="img-responsive"><br>
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

<?php if(!$this->banner['p']):?>
<div class="form-group">
<label class="col-sm-2 control-label" for="input01">ตำแหน่ง:</label>
<div class="col-sm-10">
<div style="padding-bottom:5px; margin-bottom:5px; border-bottom:1px solid #F90"><span class="bn bn-a">A</span> 960x125, <span class="bn">B</span> - <span class="bn">E</span> 628x90, <span class="bn bn-f">F</span> 960x125, <span class="bn bn-h">H</span> - <span class="bn bn-h">I</span> 300x250, <span class="bn bn-b1">B1</span> - <span class="bn bn-b2">B2</span> 125x450</div>
<?php foreach($this->position as $k=>$s):?>
<div style="padding-bottom:10px; margin-bottom:10px; border-bottom:2px solid #ccc;">
<h3 class="bar-heading"><?php echo $s['t']?></h3>
<?php foreach($s['l'] as  $x=>$v):?>
<div>
<?php if(count($s['l'])>1):?>
<strong><?php echo $v['t']?></strong><br>
<?php endif?>
<?php for($i=0;$i<count($v['l']);$i++):?>
<?php $c=($this->banner[$k][$x]??[]);?>
<?php if($k=='teededball'):?>
<?php echo $i?', ':''?><label class="checkbox-inline"><input type="checkbox" name="<?php echo $k?>[<?php echo $x?>][]" value="<?php echo $v['l'][$i]?>"<?php echo in_array($v['l'][$i],$c)?' checked':''?>> <?php echo $this->football_position[$v['l'][$i]]?></label>
<?php else:?>
<?php echo $i?', ':''?><label class="checkbox-inline"><input type="checkbox" name="<?php echo $k?>[<?php echo $x?>][]" class="ads-pos-<?php echo $v['l'][$i]?>" onClick="getAdsA1()" value="<?php echo $v['l'][$i]?>"<?php echo in_array($v['l'][$i],$c)?' checked':''?>> <span class="bn bn-<?php echo $v['l'][$i]?>"><?php echo strtoupper($v['l'][$i])?></span></label>
<?php endif?>
<?php endfor?>
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
<?php else:?>

<?php endif?>

 <div class="form-group">
<label class="col-sm-2 control-label" for="input02">การเผยแพร่:</label>
<div class="col-sm-10 category">
<label class="checkbox-inline"><input type="radio" name="publish" value="1"<?php echo $this->banner['pl']?' checked':''?>> แสดงผล</label>
<label class="checkbox-inline"><input type="radio" name="publish" value="0"<?php echo !$this->banner['pl']?' checked':''?>> ไม่แสดง</label>
</div>
</div>


 <div class="form-group form-ads-a1" style="display:none">
<label class="col-sm-2 control-label" for="input02">โฆษณาตำแหน่ง L:</label>
<div class="col-sm-10" style="padding-top:7px;" id="ads-l">
<?php if($this->adsL):?>
<?php echo $this->adsL['t']?> <a href="/view/<?php echo $this->adsL['_id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-tasks"></span></a>
<a href="/update/<?php echo $this->adsL['_id']?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
<?php else:?>
<a href="javascript:;" onClick="newads('l')"><span class="glyphicon glyphicon-plus"></span> เพิ่ม</a>
<?php endif?>
</div>
</div>

 <div class="form-group form-ads-a1" style="display:none">
<label class="col-sm-2 control-label" for="input02">โฆษณาตำแหน่ง R:</label>
<div class="col-sm-10" style="padding-top:7px;" id="ads-r">
<?php if($this->adsR):?>
<?php echo $this->adsR['t']?> <a href="/view/<?php echo $this->adsR['_id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-tasks"></span></a>
<a href="/update/<?php echo $this->adsR['_id']?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
<?php else:?>
<a href="javascript:;" onClick="newads('r')"><span class="glyphicon glyphicon-plus"></span> เพิ่ม</a>
<?php endif?>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="input02">สถิติสำหรับบุคคลภายนอก:</label>
<div class="col-sm-10" style="padding-top:7px;"><a href="https://ads.jarm.com/view/<?php echo $this->banner['_id'].'-'.$this->banner['sc']?>" target="_blank">https://ads.jarm.com/view/<?php echo $this->banner['_id'].'-'.$this->banner['sc']?></a><br>
หน้าแสดงสถิติสำหรับลูกค้าหรือบุคคลภายนอก*
</div>
</div>


<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/">ยกเลิก</a>
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
  if($('.ads-pos-a1:checked').length || $('.ads-pos-a:checked').length)
  {
    $('.form-ads-a1').css('display','block');
  }
  else
  {
    $('.form-ads-a1').css('display','none');
  }
}
$(function() {
  $( ".date" ).datepicker({dateFormat: 'yy-mm-dd'});
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
