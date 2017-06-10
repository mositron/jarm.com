<style>
.table .i{width:50px; line-height:0px; padding:3px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:26px; line-height:26px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}
.table .d p{clear:both}
.table .a{ width:70px}
.tbpage{padding:5px; text-align:right}
.tbpage .pager{text-align:right}
.table .dropdown-menu{left:auto; right:0px; min-width:100px;}
.table .btn-group{margin-top:8px;}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบผลสลากกินแบ่งงวดงวดนี้หรือไม่',click:function(){_.ajax.gourl('/lotto','dellotto',i)}});}
</script>


<div id="newlotto" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newlotto',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มผลสลากกินแบ่งงวดใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right">งวดประจำวันที่:</td><td align="left">
<select name="day" class="tbox" style="width:auto" required><option value="">- เลือกวัน -</option>
<?php for($i=1;$i<31;$i++):?>
<option value="<?php echo $i?>"><?php echo $i?></option>
<?php endfor?>
</select>
<select name="month" class="tbox" style="width:auto" required><option value="">- เลือกเดือน -</option>
<?php for($i=0;$i<12;$i++):?>
<option value="<?php echo $i+1?>"><?php echo self::Time()->month[$i]?></option>
<?php endfor?>
</select>
<select name="year" class="tbox" style="width:auto" required><option value="">- เลือกปี -</option>
<?php for($i=date('Y');$i>date('Y')-10;$i--):?>
<option value="<?php echo $i?>"><?php echo $i+543?></option>
<?php endfor?>
</select>
</td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<div style="padding:5px; text-align:right">
<a href="javascript:;" class="btn btn-info" onClick="_.box.open('#newlotto')"><span class="glyphicon glyphicon-plus"></span> เพิ่มผลสลากกินแบ่งงวดใหม่</a>
</div>

<ul class="breadcrumb">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
   <li><a href="/lotto">ตรวจหวย</a></li>
</ul>


<table class="table">
<?php for($i=0;$i<count($this->lotto);$i++):?>
<?php $l=self::uri(['lotto','/view/'.$this->lotto[$i]['_id']]);?>
<tr class="l<?php echo $i%2?>">
<td class="d">
<strong><a href="<?php echo $l?>">งวดที่ <?php echo $this->lotto[$i]['tm']?self::Time()->from($this->lotto[$i]['tm'],'date'):''?></a></strong>
<div>รางวัลที่ 1: <?php echo $this->lotto[$i]['a1']?>, เลชท้าย 3 ตัว : <?php echo implode(' ',(array)$this->lotto[$i]['l3'])?>, เลขท้าย 2 ตัว:  <?php echo $this->lotto[$i]['l2']?></div>
</td>
<td class="a">
<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">ปรับแต่ง<span class="caret"></span></a>
  <ul class="dropdown-menu">
    <li><a href="/lotto/<?php echo $this->lotto[$i]['_id']?>"><span class="glyphicon glyphicon-wrench"></span> แก้ไข</a></li>
    <li><a href="javascript:;" onClick="cdel(<?php echo $this->lotto[$i]['_id']?>)"><span class="glyphicon glyphicon-remove"></span> ลบ</a></li>
  </ul>
</div>
</td>
</tr>
<?php endfor?>
<?php if(!$this->count):?>
<tr><td colspan="2" style="text-align:center; vertical-align:middle; height:100px; border:1px solid #f7f7f7">ไม่มีข้อมูล</td></tr>
<?php endif?>
</table>
<div class="tbpage"><?php echo $this->pager?></div>
<div style="padding:5px; margin:5px 0px; border:1px solid #f0f0f0; text-align:center">คัดลอกข้อมูลจาก <a href="http://www.glo.or.th/detail.php?link=result_text" target="_blank">http://www.glo.or.th/detail.php?link=result_text</a></div>
