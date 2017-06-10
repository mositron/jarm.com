<style type="text/css">
.table .col-sm-12{margin-bottom:2px;}
.table .colum{width:130px; text-align:right;}
.table td.r{width:130px; text-align:right;}
</style>
<div>
<ul class="nav nav-tabs">
<li><a href="/manage/" class="h"> เกมส์ของฉัน</a></li>
<li><a href="/manage/new"<?php if(self::$path[0]=='new'):?> class="active"<?php endif?>><span class="glyphicon glyphicon-plus"></span> สร้างเกมใหม่</a></li>
<li><a href="https://tech.jarm.com/tips/6011" target="_blank"><span class="glyphicon glyphicon-question-sign"></span> วิธีสร้างเกมทายใจ</a></li>
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
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/manage">เกมส์ของคุณ </a><?php if($this->app['pl']):?>, <a href="/game/<?php echo $this->app['_id']?>">หน้าเล่นเกม</a><?php endif?>)
</div>
<?php endif?>
<?php if($this->app['pl']):?>
<div class="alert alert-info">
  <h4 class="alert-heading">เผยแพร่แล้ว!</h4>
 เกมนี้ทำการเผยแพร่แล้ว  (กลับไปยัง <a href="/manage">เกมส์ของคุณ </a><?php if($this->app['pl']):?>, <a href="/game/<?php echo $this->app['_id']?>">หน้าเล่นเกม</a><?php endif?>)
</div>
<?php endif?>

<div style="padding:5px; margin-bottom:5px;">
<div id="getview">
<form method="post" enctype="multipart/form-data" action="<?php echo URL?>">
<table cellpadding="5" cellspacing="1" border="0" class="table table-condensed">
<tr class="warning"><td colspan="2" style="text-align:center">รายละเอียดเกม</td></tr>
<tr><td class="colum">ชื่อเกม <small>:</small></td><td valign='top'><input type="text" class="col-sm-12" name="title" value="<?php echo $this->app['t']?>" maxlength="50" required><br><span class="req">*</span> สูงสุดไม่เกิน 50 ตัวอักษร</td></tr>
<tr><td class="colum">รูปภาพประกอบ <small>:</small></td><td valign='top'>
<div><img src="<?php if($this->app['img']):?>https://s4.jarm.com/guess/<?php echo $this->app['fd']?>/s.jpg<?php endif?>" class="prv-img"></div>
<input type="file" name="photo" id="photo"<?php echo self::$path[0]=='new'?' required':''?>> <br>*  ขนาดภาพประมาณ 200x200 (ระบบย่อและ crop ให้อัตโนมัติ)
</td></tr>
<tr><td class="colum">คำอธิบายของเกม <small>:</small></td><td valign='top'>
<select name="cate" required>
<option value="">เลือกหมวดของเกม</option>
<?php foreach($this->cate as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $this->app['c']==$k?' selected':''?>><?php echo $v['t']?></option>
<?php endforeach?>
</select>
<tr><td class="colum">คำอธิบายของเกม <small>:</small></td><td valign='top'><textarea name="detail" class="col-sm-12" style="height:100px" required><?php echo $this->app['d']?></textarea><br><span class="req">*</span> สูงสุดไม่เกิน 150 ตัวอักษร, ใช้สำหรับโฆษณาให้ผู้อื่นมาเล่น</td></tr>
<tr class="warning"><td colspan="2" style="text-align:center">คำตอบของเกม (ผลลัพธ์)</td></tr>
<tr><td colspan="2" style="text-align:center">
<div id="app_answer">
<?php $ans=max(2,count($this->app['ans']));for($i=0;$i<$ans;$i++):?>
<?php if($this->app['ans'][$i]):?>
<table width="100%" class="table table-condensed">
<tbody>
<tr class="info"><td colspan="2" style="text-align:center">ผลลัพธ์ที่ <span class="ans_no"><?php echo $i+1?></span><input type="hidden" name="ans_id[]" value="<?php echo $i?>"></td></tr>
<tr><td class="r">ชื่อผลลัพธ์</td><td><input type="text" name="ans_t[]" class="col-sm-12 inp_ans" value="<?php echo $this->app['ans'][$i]['t']?>" onBlur="calans()" required></td></tr>
<tr><td class="r">คำอธิบายผลลัพธ์</td><td><textarea name="ans_d[]" class="col-sm-12" style="height:70px" required><?php echo $this->app['ans'][$i]['d']?></textarea></td></tr>
<tr><td class="r">รูปภาพประกอบ</td><td><?php if($this->app['ans'][$i]['i']):?><img src="https://s4.jarm.com/guess/<?php echo $this->app['fd']?>/<?php echo $this->app['ans'][$i]['i']?>" style="max-height:100px; max-width:100px"><br><?php endif?><input type="file" name="ans_i[]"><br>ปล่อยว่างได้: ขนาดภาพประมาณ 200x200 (ระบบย่อและ crop ให้อัตโนมัติ)</td></tr>
<?php if($i>=2):?><tr><td class="r"></td><td><label><input type="checkbox" name="ans_del[]" value="<?php echo $i?>"> ลบคำตอบนี้</label> (หากลบคำตอบนี้ กรุณากดบันทึกอีกครั้ง)</td></tr><?php endif?>
</tbody>
</table>
<?php else:?>
<table width="100%" class="table table-condensed">
<tbody>
<tr class="info"><td colspan="2" style="text-align:center">ผลลัพธ์ที่ <span class="ans_no"><?php echo $i+1?></span><input type="hidden" name="ans_id[]" value=""></td></tr>
<tr><td class="r">ชื่อผลลัพธ์</td><td><input type="text" name="ans_t[]" class="col-sm-12 inp_ans" value="" onBlur="calans()" required></td></tr>
<tr><td class="r">คำอธิบายผลลัพธ์</td><td><textarea name="ans_d[]" class="col-sm-12" style="height:70px" required></textarea></td></tr>
<tr><td class="r">รูปภาพประกอบ</td><td><input type="file" name="ans_i[]"><br>ปล่อยว่างได้: ขนาดภาพประมาณ 200x200 (ระบบย่อและ crop ให้อัตโนมัติ)</td></tr>
<?php if($i>=2):?><tr><td class="r"></td><td><a href="javascript:;" class="btn btn-xs btn-default" onClick="delans(this)"><span class="glyphicon glyphicon-trash"></span> ลบคำตอบนี้</a></td></tr><?php endif?>
</tbody>
</table>
<?php endif?>
<?php endfor?>
</div>
<div style="padding:4px; background:#f0f0f0;"><a href="javascript:;" class="btn btn-warning" onClick="addans()"><span class="glyphicon glyphicon-plus"></span> เพิ่มคำตอบใหม่</a></div>
</td></tr>
<tr class="warning"><td colspan="2" style="text-align:center">คำถามของเกม (โจทย์)</td></tr>
<tr><td colspan="2" style="text-align:center">
<div id="app_question">
<?php $quest=max(1,count($this->app['quest']));for($i=0;$i<$quest;$i++):?>
<?php if($this->app['quest'][$i]):?>
<table width="100%" class="table table-condensed">
<tbody>
<tr class="info"><td colspan="2" style="text-align:center">คำถามที่ <span class="quest_no"><?php echo $i+1?></span><input type="hidden" name="quest_id[]" value="<?php echo $i?>"></td></tr>
<tr class="q"><td class="r">คำถาม</td><td><input type="text" name="quest_t[]" class="col-sm-12" value="<?php echo $this->app['quest'][$i]['t']?>" required></td></tr>
<?php for($j=0;$j<$ans;$j++):?>
<tr class="a"><td class="r">คำตอบที่ <span class="qans_no"><?php echo $j+1?></span></td><td><input type="text" name="quest_a[]" class="col-sm-12" value="<?php echo $this->app['quest'][$i]['a']&&$this->app['quest'][$i]['a'][$j]?$this->app['quest'][$i]['a'][$j]['t']:''?>" required><div class="ans_v"></div></td></tr>
<?php endfor?>
<tr class="r"><td class="r"></td><td><a href="javascript:;" class="btn btn-xs btn-default" onClick="delquest(this)"><span class="glyphicon glyphicon-trash"></span> ลบคำถามนี้</a> - หมายเหตุ: ระบบจะสลับคำถาม และสลับคำตอบให้อัตโนมัติ</td></tr>
</tbody>
</table>
<?php else:?>
<table width="100%" class="table table-condensed">
<tbody>
<tr class="info"><td colspan="2" style="text-align:center">คำถามที่ <span class="quest_no"><?php echo $i+1?></span><input type="hidden" name="quest_id[]" value=""></td></tr>
<tr class="q"><td class="r">คำถาม</td><td><input type="text" name="quest_t[]" class="col-sm-12" value="" required></td></tr>
<?php for($j=0;$j<$ans;$j++):?>
<tr class="a"><td class="r">คำตอบที่ <span class="qans_no"><?php echo $j+1?></span></td><td><input type="text" name="quest_a[]" class="col-sm-12" value="" required><div class="ans_v"></div></td></tr>
<?php endfor?>
<tr class="r"><td class="r"></td><td><a href="javascript:;" class="btn btn-xs btn-default" onClick="delquest(this)"><span class="glyphicon glyphicon-trash"></span> ลบคำถามนี้</a> - หมายเหตุ: ระบบจะสลับคำถาม และสลับคำตอบให้อัตโนมัติ</td></tr>
</tbody>
</table>
<?php endif?>
<?php endfor?>
</div>
<div style="padding:4px; background:#f0f0f0;"><a href="javascript:;" class="btn btn-warning" onClick="addquest()"><span class="glyphicon glyphicon-plus"></span> เพิ่มคำถามใหม่</a></div>
</td></tr>
<?php if(self::$my['am']>=9):?>
<tr><td>ตั้งเป็นเกมยอดฮิต</td><td>
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
ตั้งให้เกมนี้แสดงผลในหน้าเว็บ และสามารถเล่นได้ทันที
</td></tr>

<tr><td class="colum"></td><td valign='top'><input type="submit" class="btn btn-info" value="          บันทึก          ">  หรือกลับไปยัง <a href="/manage" class="btn btn-xs btn-default">เกมส์ของฉัน</a></td></tr>
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

