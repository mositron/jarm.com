<style>
.table .i{width:50px; line-height:0px; padding:3px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:26px; line-height:26px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}
.table .d{padding:5px 5px 0px 5px}
.table .d p{clear:both}
.table .a{ width:115px; text-align:right;}
.tbpage{padding:5px; text-align:right}
.tbpage .pager{text-align:right}
.table .dropdown-menu{left:auto; right:0px; min-width:100px;}
.table .btn-group{margin-top:8px;}
.table th.c,.table td.c{text-align:center;}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบแบนเนอร์นี้หรือไม่',click:function(){_.ajax.gourl('/home-banner','delhome_banner',i)}});}
</script>


<div id="newbanner" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newhome_banner',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มข่าวใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right" width="150">ชื่อแบนเนอร์:</td><td align="left"><input type="text" name="title" size="50" class="tbox" required></td></tr>
<tr><td align="right">ตำแหน่ง:</td><td align="left">
<select name="position" class="tbox" required><option value="">- เลือก -</option>
<?php foreach($this->position as $key=>$value):?>
<option value="<?php echo $key?>"><?php echo $value?></option>
<?php endforeach?>
</select>
</td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<div>



<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
   <li><a href="/home-banner"><span class="glyphicon glyphicon-eye-close"></span> แบนเนอร์หน้าแรก</a></li>

<?php if($this->access):?>
   <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newbanner');"><span class="glyphicon glyphicon-plus"></span> เพิ่ม</a> &nbsp; &nbsp; </li>
<?php else:?>
 <li class="pull-right"><span class="glyphicon glyphicon-question-sign"></span> ไม่มีสิทธิ์แก้ไขข้อมูลภายในส่วนนี้</li>
<?php endif?>
</ul>

<ul class="nav nav-tabs">
  <li<?php echo !self::$path[0]?' class="active"':''?>><a href="/home-banner">ทั้งหมด</a></li>
<?php foreach($this->position as $key=>$value):?>
<li<?php echo self::$path[0]==$key?' class="active"':''?>><a href="/home-banner/<?php echo $key?>"><?php echo $value?></a></li>
<?php endforeach?>
</ul>


<table class="table" width="100%">
<tr><th class="c">ชื่อแบนเนอร์</th><th class="c">ประเภท</th><th class="c">ตำแหน่ง</th><th class="c">ลำดับ</th><th class="c">คลิก</th><th class="c">สถานะ</th><th class="c">สร้างเมื่อ</th><th class="a c"></th></tr>
<?php for($i=0;$i<count($this->banner);$i++):?>
<tr class="l<?php echo $i%2?> bn<?php echo $this->banner[$i]['_id']?>">
<td class=""><?php echo $this->banner[$i]['t']??''?></td>
<td class="c"><?php echo $this->banner[$i]['ex']??''?></td>
<td class="c"><?php echo $this->position[$this->banner[$i]['p']]?></td>
<td class="c"><?php echo $this->banner[$i]['so']??''?></td>
<td class="c"><?php echo number_format($this->banner[$i]['do']??0)?></td>
<td class="c"><?php echo ($this->banner[$i]['pl']??0)?'':'ไม่'?>แสดง</td>
<td class="c"><?php echo self::Time()->from($this->banner[$i]['da'],'date')?></td>
<td class="a">
<a href="/home-banner/stats/<?php echo $this->banner[$i]['_id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-tasks"></span></a>
<?php if($this->access):?>
<a href="/home-banner/<?php echo $this->banner[$i]['_id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-wrench"></span></a>
<a href="javascript:;" onClick="cdel(<?php echo $this->banner[$i]['_id']?>)" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
<?php endif?>
</td>
</tr>
<?php endfor?>
<?php if(!$this->count):?>
<tr><td colspan="7" style="text-align:center; vertical-align:middle; height:100px; border:1px solid #f7f7f7">ไม่มีข้อมูล</td></tr>
<?php endif?>
</table>
</div>
