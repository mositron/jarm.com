
<style type="text/css">
.tmp_colum{background:#F5F5F5;}
.tmp_colum td{background:#FFFFFF;text-align:center; }
.tmp_colum .h{background:#4BA1D8; color:#FFF}
#getphoto label{display:block; width:100px; margin:3px; float:left }


.prv-sticker h4{padding:5px; background:#f5f5f5; margin:5px 0px 5px}
.prv-sticker img{float:left; margin:2px 5px 3px 0px; width:100px; height:70px;}
.prv-sticker hr{margin:5px 0px; color:#fff; background:#fff; height:1px;border:none; border-bottom:1px solid #ccc}
.prv-sticker p{clear:both}
.ans-img > div{width:120px; text-align:center; min-height:100px; float:left}
.ans-img img.o,.ans-ch table img.o{width:100px}

.ans-ch table{margin-bottom:5px}
.tbservice .ans-ch .colum { width:60px !important}
.req{color:#fff; background:#f00; display:inline-block; font-size:12px; padding:3px 5px;}
</style>
<div id="newapp" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('/manage','newapp',this);_.box.close();return false;">
<div class="gbox_header">เพิ่ม Application ใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="500">
<tr><td align="right">ชื่อ Application :</td><td align="left"><input type="text" name="title" size="40" class="tbox" required><span class="req">*</span></td></tr>
<tr><td align="right">ประเภท :</td><td align="left"><select name="type" class="tbox"><option value="rp">สุ่มรูปภาพเป็นคำตอบ</option><option value="ch">มีคำตอบให้เลือก (ทำนายผล)</option></select><span class="req">*</span></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>
<div id="newans" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newans',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มคำตอบใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="500">
<tr><td align="right">คำตอบ(ตัวเลือก) :</td><td align="left"><input type="text" name="answer" size="40" class="tbox" required><span class="req">*</span></td></tr>
<tr><td align="right">ผลลัพธ์ :</td><td align="left"><textarea name="result" class="tbox" style="width:99%; height:100px; resize:none" maxlength="500"></textarea><span class="req">*</span></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<div>
<ul class="tabs" style="text-align: left;">
<li class="left"><a href="/manage/" class="h"> Apps ของฉัน</a></li>
<li class="left"><a href="/manage/<?php echo self::$path[1]?>">แก้ไข App นี้</a></li>
<p class="clear"></p>
</ul>

<div id="getview">

<table cellpadding="5" cellspacing="1" border="0" class="table tbservice">
<tr><th colspan="2" style="text-align:center">รายละเอียด Application</th></tr>
<tr><td class="colum">คำถาม <small>:</small></td><td valign='top'><?php echo $this->app['t']?></td></tr>
<tr><td class="colum">รูปภาพ <small>:</small></td><td valign='top'>
<div><img src="<?php if($this->app['p']):?>//s3.jarm.com/sticker/<?php echo $this->app['fd']?>/<?php echo $this->app['p']?><?php endif?>" class="prv-img"></div>
</td></tr>
</table>

<div style="height:0px; overflow:hidden; border-top:1px dashed #999; margin:10px 10px 20px"></div>

<div style="margin:5px 0px; padding:5px; text-align:center; border:1px solid #f0f0f0;">


<table cellpadding="5" cellspacing="1" border="0" class="table tbservice">
<tr><th colspan="2" style="text-align:center">เพิ่ม Tab ของ Application ไปยัง Fanpage</th></tr>
<tr><td class="colum"></td><td valign='top'>
<a href="http://www.facebook.com/dialog/pagetab?app_id=363249230402073&next=<?php echo urlencode(URI.'?ap=363249230402073')?>" class="btn btn-info">เพิ่ม Tab ไปยัง Fanpage</a>
<div style="padding:5px;">ในกรณีที่ ไม่มีไม่มีรายการหน้า Fanpage ให้เลือก ให้ใช้ปุ่มเพิ่มด้านล่างนี้แทน</div>

<a href="http://www.facebook.com/dialog/pagetab?app_id=329339543807804&next=<?php echo urlencode(URI.'?ap=329339543807804')?>" class="btn">เพิ่ม Tab #2</a>
<a href="http://www.facebook.com/dialog/pagetab?app_id=391472957568868&next=<?php echo urlencode(URI.'?ap=391472957568868')?>" class="btn">เพิ่ม Tab #3</a>
<a href="http://www.facebook.com/dialog/pagetab?app_id=458317327529238&next=<?php echo urlencode(URI.'?ap=458317327529238')?>" class="btn">เพิ่ม Tab #4</a>


</td></tr>
<?php if($this->app['fba']&&$this->app['fbp']):?>
<tr><td></td><td><a href="https://www.facebook.com/pages/<?php echo $this->app['fbp']?>/<?php echo $this->app['fbp']?>?sk=app_<?php echo $this->app['fba']?>" class="btn">ไปยัง App นี้บน Fanpage</a></td></tr>
<?php endif?>
<tr><th colspan="2" style="text-align:center">วิธีเปลี่ยนชื่อ Tab และ Icon ของแอพบนแฟนเพจ</th></tr>
<tr><td class="colum"></td><td valign='top'>
<p>1. ไปยังหน้าแฟนเพจ แล้วคลิกขยาย Tab ทั้งหมด</p>
<img src="<?php echo self::uri(['s3','/img/fbapp/help-1.png'])?>"><br><br>
<p>2. คลิกที่ icon มุมบนของ tab ที่เราต้องการจะแก้</p>
<img src="<?php echo self::uri(['s3','/img/fbapp/help-2.png'])?>"><br><br>
<p>3. เลือก "แก้ไขการตั้งค่า" </p>
<img src="<?php echo self::uri(['s3','/img/fbapp/help-3.png'])?>"><br><br>
<p>4. ใส่รูปภาพ และชื่อของ tab ที่ต้องการ แล้วบันทึก </p>
<img src="<?php echo self::uri(['s3','/img/fbapp/help-4.png'])?>"><br><br>
</td></tr>
</table>

</div>
</div>
</div>
