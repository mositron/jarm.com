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
.nav-clist ul{margin-left:10px; list-style:none}
.nav-clist ul ul{list-style:inside disc}
.nav-clist a{display:block; height:30px; line-height:30px; border-bottom:1px dashed #eee; text-indent:10px;; overflow:hidden;}
.cate-logs{text-align:center;}
</style>


<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
   <li><a href="/news">จัดการข่าว</a></li>
   <span class="divider">&raquo;</span>
   <li><a href="/news/topnews/<?php echo self::$path[1]?>">ข่าวประจำวันที่ <?php echo self::Time()->from($this->dfrom,'date')?></a></li>
   </ul>
<table class="table">
<?php for($i=0;$i<count($this->news);$i++):$v=$this->news[$i]?>
<?php $l=$v['link'];?>
<tr class="l<?php echo $i%2?>">
<td class="d">
<?php echo $i+1?>). <?php echo number_format($v['do']+$v['is'])?> ครั้ง - <a href="/news/c-<?php echo $v['c']?>"><?php echo self::$conf['news'][$v['c']]['t']?></a> -  <a href="<?php echo $l?>" target="_blank"><?php echo $v['t']?></a> -
โดย: <?php $u=$this->user->get($v['u'])?><a target="_blank" href="https://social.jarm.com/<?php echo $u['link']?>"><?php echo $u['name']?></a>
<?php if(is_array($v['google'])):?>
<br>คีย์เวิร์ดที่ค้นหา:
<?php $o=0;foreach($v['google'] as $key=>$do):?><?php echo ($o>0?', ':'')?><?php $q=str_replace(['#DOT#','#DOLLAR#'],['.','$'],$key)?><a href="https://www.google.co.th/search?q=<?php echo urlencode($q)?>" target="_blank"><?php echo $q?></a>(<?php echo number_format(intval($do))?>) <?php $o++;endforeach?>
<?php endif?>
</td>
</tr>
<?php endfor?>
</table>


</div>
<div class="col-sm-3">
<h4 style="margin:0px 0px 5px 5px; background:#f0f0f0; height:24px; line-height:24px; text-align:center;">ประจำวัน</h4>
<div class="nav-clist">
<ul>
<li><a href="/news/topnews"><?php echo self::Time()->day[date('w')]?> - วันนี้</a></li>
<?php
$now=time();
for($i=0;$i<31;$i++):
$now-=(3600*24);
?>
<li><a href="/news/topnews/<?php echo date('Y-m-d',$now)?>"><?php echo self::Time()->day[date('w',$now)]?> - <?php echo self::Time()->from($now,'date')?></a></li>
<?php endfor?>
</ul>
</div>
</div>
