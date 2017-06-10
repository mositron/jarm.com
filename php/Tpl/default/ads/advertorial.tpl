<style>
.table .i{width:50px; line-height:0px; padding:3px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:26px; line-height:26px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}
.table .d{padding:5px 5px 0px 5px}
.table .d p{clear:both}
.table .a{ width:75px; text-align:right;}
.tbpage{padding:5px; text-align:right}
.tbpage .pager{text-align:right}
.table .dropdown-menu{left:auto; right:0px; min-width:100px;}
.table .btn-group{margin-top:8px;}
.table th.c,.table td.c{text-align:center;}

.bar-menu{padding-left:10px;}
.nav-menu{padding:0px; margin:0px;}
.nav-menu li{padding:0px; margin:0px;}
.nav-menu li a{display:block; border-bottom:1px dashed #f0f0f0; color:#888; height:30px; line-height:30px; overflow:hidden;white-space:nowrap; text-overflow:ellipsis; padding:0px 0px 0px 10px;}
.nav-menu li a:hover{background:#f7f7f7; color:#333;}
.nav-menu li.active a{color:#F60 !important;}
</style>
<script>
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบแบนเนอร์นี้หรือไม่',click:function(){_.ajax.gourl('/advertorial','delbanner',i)}});}
</script>


<div id="newbanner" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newbanner',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มแบนเนอร์ใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right" width="150">ชื่อแบนเนอร์:</td><td align="left"><input type="text" name="title" size="50" class="tbox" style="width:100%" required></td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>
<ul class="breadcrumb">
  <li><a href="/"><span class="glyphicon glyphicon-eye-open"></span> แบนเนอร์</a></li>
  <li class="pull-right"><a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','clearcache')"><span class="glyphicon glyphicon-reload"></span> เคลียร์แคช</a> &nbsp; &nbsp; </li>
  <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newbanner');"><span class="glyphicon glyphicon-plus"></span> เพิ่มแบนเนอร์</a> &nbsp; &nbsp; </li>
</ul>
<div class="row">
  <div class="col-sm-2">
    <h4 class="bar-heading bar-menu">Banner</h4>
    <ul class="nav-menu">
      <li><a href="/home/active"> &raquo; กำลังใช้งาน</a></li>
      <li><a href="/home/inactive"> &raquo; เลิกใช้งาน</a></li>
      <li><a href="/home/all"> &raquo; ทั้งหมด</a></li>
    </ul>
    <h4 class="bar-heading bar-menu">Advertorial</h4>
    <ul class="nav-menu">
      <li<?php echo $this->status=='active'?' class="active"':''?>><a href="/advertorial/active"> &raquo; กำลังใช้งาน</a></li>
      <li<?php echo $this->status=='inactive'?' class="active"':''?>><a href="/advertorial/inactive"> &raquo; เลิกใช้งาน</a></li>
      <li<?php echo $this->status=='all'?' class="active"':''?>><a href="/advertorial/all"> &raquo; ทั้งหมด</a></li>
    </ul>
  	<h4 class="bar-heading bar-menu">Relate</h4>
    <ul class="nav-menu">
      <li><a href="/relate/active"> &raquo; กำลังใช้งาน</a></li>
      <li><a href="/relate/inactive"> &raquo; เลิกใช้งาน</a></li>
      <li><a href="/relate/all"> &raquo; ทั้งหมด</a></li>
    </ul>
  </div>
  <div class="col-sm-10">
    <!--ul class="nav nav-tabs">
      <li<?php echo !$this->site?' class="active"':''?>><a href="/advertorial/<?php echo $this->status?>">ทุกโดเมน</a></li>
      <?php foreach($this->position as $k=>$v):?>
      <li<?php echo $this->site==$k?' class="active"':''?>><a href="/advertorial/<?php echo $this->status?>/site-<?php echo $k?>"><?php echo $k?></a></li>
      <?php endforeach?>
    </ul-->


    <table class="table table-striped" width="100%">
    <tr><th class="c">ชื่อแบนเนอร์</th><th class="c">เริ่มแสดง</th><th class="c">จบแสดง</th><th class="c">คลิก</th><th class="c">สถานะ</th><th class="a c"></th></tr>
    <?php if(count($this->banner)):?>
    <?php for($i=0;$i<count($this->banner);$i++):$b=$this->banner[$i];?>
    <tr class="l<?php echo $i%2?>">
    <td class=""><?php echo $this->banner[$i]['t']?></td>
    <td class="c"><?php echo self::Time()->from($b['dt1'],'date')?></td>
    <td class="c"><?php echo self::Time()->from($b['dt2'],'date')?></td>
    <td class="c"><?php echo number_format($b['click'])?></td>
    <td class="c"><span class="label label-<?php echo $b['pl']?'success':'warning'?>"><?php echo $b['pl']?'':'ไม่'?>แสดง</span></td>
    <td class="a">
    <?php if(intval($b['click'])>10):?>
    <a href="/view/<?php echo $b['_id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-tasks"></span></a-->
    <a href="/update/<?php echo $b['_id']?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
    <?php else:?>
    <a href="/update/<?php echo $b['_id']?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
    <a href="javascript:;" onClick="cdel(<?php echo $b['_id']?>)" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
    <?php endif?>
      </td>
    </tr>
    <?php if(isset($this->inner[$b['_id']])):$in=$this->inner[$b['_id']];?>
    <?php for($j=0;$j<count($in);$j++):$n=$in[$j];?>
    <tr class="l<?php echo $i%2?>">
    <td class="" colspan="3"><span class="glyphicon glyphicon-chevron-right"></span> <?php echo $n['t']?></td>
    <td class="c"><?php echo number_format($n['imp'])?></td>
    <td class="c"><?php echo number_format($n['click'])?></td>
    <td class="c"><span class="label label-<?php echo $n['pl']?'success':'warning'?>"><?php echo $n['pl']?'':'ไม่'?>แสดง</span></td>
    <td class="a">
    <a href="/view/<?php echo $n['_id']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-tasks"></span></a>
    <a href="/update/<?php echo $n['_id']?>" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>
    </td>
    </tr>
    <?php endfor?>
    <?php endif?>
    <?php endfor?>
    <?php else:?>
    <tr><td colspan="7" style="text-align:center; padding:50px 0px; font-size:18px"><em>ไม่มีข้อมูล</em></td></tr>
    <?php endif?>
    </table>
  </div>
</div>
