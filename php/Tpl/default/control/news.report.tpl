<div class="col-sm-9">
<style>
.table .i{width:50px; line-height:0px; padding:3px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:26px; line-height:26px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}
.table .d{ font-size:13px}
.table .d p{clear:both}
.table .a{ width:115px; text-align:right;}
.tbpage{padding:5px; text-align:right}
.tbpage .pager{text-align:right}
.table .dropdown-menu{left:auto; right:0px; min-width:100px;}
.table .btn-group{margin-top:8px;}

.nav-clist{margin-left:5px;}
.nav-clist ul{margin-left:10px; list-style:none;}
.nav-clist ul ul{list-style:inside disc}
.nav-clist a{display:block; height:30px; line-height:30px; border-bottom:1px dashed #eee; text-indent:10px;; overflow:hidden;}
.cate-logs{text-align:center;}
</style>


<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
   <li><a href="/news">จัดการข่าว</a></li>
   <span class="divider">&raquo;</span>
   <li><a href="/news/report/<?php echo self::$path[1]?>">ข่าวประจำวันที่ <?php echo self::Time()->from($this->dfrom,'date')?></a></li>
   </ul>

<?php foreach($this->writer as $k=>$v):?>
<h3><a target="_blank" href="https://jarm.com/user/<?php echo $v['profile']['_id']?>"><img src="<?php echo $v['profile']['img']?>" style="width:32px;"> <?php echo $v['profile']['name']?></a><small> - <?php echo count($v['news'])?> บทความ</small></h3>
<table class="table">
<?php for($i=0;$i<count($v['news']);$i++):?>
<?php $l=$v['news'][$i]['link'];?>
<tr class="l<?php echo $i%2?>">
<td class="d">
<a href="/news/c-<?php echo $v['news'][$i]['c']?>"><?php echo self::$conf['news'][$v['news'][$i]['c']]['t']?></a> -  <a href="<?php echo $l?>" target="_blank"><?php echo $v['news'][$i]['t']?></a> -
ดู: <?php echo number_format($v['news'][$i]['do']+$v['news'][$i]['is'])?> ครั้ง
<?php if($v['news'][$i]['pl']==1):?>
<span class="label label-success">เผยแพร่แล้ว</span>
<?php elseif($this->news[$i]['pl']==2):?>
<span class="label label-info">แสดงเฉพาะหน้าเนื้อหา</span>
<?php endif?>
<?php if(!empty($v['news'][$i]['wt'])):?><span class="label label-warning">รอตรวจสอบ</span><?php endif?>
</td>
</tr>
<?php endfor?>
</table>

<?php endforeach?>

</div>
<div class="col-sm-3">
<h4 style="margin:0px 0px 5px 5px; background:#f0f0f0; height:24px; line-height:24px; text-align:center;">ประจำวัน</h4>
<div class="nav-clist">
<ul>
<li><a href="/news/report"><?php echo self::Time()->day[date('w')]?> - วันนี้</a></li>
<?php
$now=time();
for($i=0;$i<31;$i++):
$now-=(3600*24);
?>
<li><a href="/news/report/<?php echo date('Y-m-d',$now)?>"><?php echo self::Time()->day[date('w',$now)]?> - <?php echo self::Time()->from($now,'date')?></a></li>
<?php endfor?>
</ul>
</div>
</div>
