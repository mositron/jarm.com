<style>
.table .i{width:50px; line-height:0px;}
.table .t{width:60px; font-size:18px; color:#666; text-align:center; vertical-align:middle}
.table strong{display:block; font-size:14px; height:26px; line-height:26px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;}
.table .d{font-size:12px; color:#999; padding:3px;}
.table .d p{clear:both}
.table .p{width:80px;}
.table .p span{height:55px; line-height:55px; display:block; padding:0px; text-align:center; width:80px;}
.table .p span.label-success{font-size:18px;}
.table .do{width:90px; font-size:18px; text-align:center;}
.table .do div{height: 55px;line-height: 55px;color: #000;border: 1px solid #ccc;border-radius: 4px;width: 90px;background-color: #f5f5f5;}
.table .a{ width:170px; text-align:right; padding:4px 0px;}
.table .a div{text-align:center; margin-top:5px;}
.table .a .btn{padding:11px 8px;font-size:11px;border-bottom:2px solid #2b9fa5;}
.tbpage{padding:5px; text-align:right}
.tbpage .pager{text-align:right}
.table .dropdown-menu{left:auto; right:0px; min-width:100px;}
.table .btn-group{margin-top:8px;}

.nowrap a{font-size:16px;}

.nav-clist{margin-left:5px; list-style:inside decimal; max-height:2650px; overflow:scroll; padding:0px;}
.nav-clist ul{margin-left:10px; list-style:inside circle; padding:0px;}
.nav-clist ul ul{list-style:inside disc}
.nav-clist a{display:block; height:22px; line-height:22px; border-bottom:1px dashed #eee; text-indent:10px;; overflow:hidden;}
.cate-logs{text-align:center;}
</style>
<script>
function instant(i){_.box.confirm({title:'อัพเดทข้อมูลไปยัง Instant Article',detail:'ระบบนี้ใช้สำหรับข่าวเก่าที่ยังไม่เคยแสดงบน Instant Aticle หรือข่าวเก่าที่มีการแก้ไขหรืออัพเดทเนื้อหาใหม่ เพื่อส่งเข้าคิวการอัพเดทให้ Facebook (ใช้เวลาประมาณ 3-5 นาที)<br>ต้องการดำเนินการต่อหรือไม่.',click:function(){_.ajax.gourl('/news','instant',i)}});}
function cdel(i){_.box.confirm({title:'ลบประกาศ',detail:'คุณต้องการลบข่าวเรื่องนี้หรือไม่',click:function(){_.ajax.gourl('/news','delnews',i)}});}
</script>
<div id="newnews" class="gbox">
<form method="post" onSubmit="_.ajax.gourl('<?php echo URL?>','newnews',this);_.box.close();return false;">
<div class="gbox_header">เพิ่มข่าวใหม่</div>
<div class="gbox_content">
<table cellpadding="5" cellspacing="5" border="0" align="center" width="450">
<tr><td align="right">หัวข้อข่าว:</td><td align="left"><input type="text" name="title" size="50" class="form-control" required></td></tr>
<tr><td align="right">ประเภทข่าว:</td><td align="left">
<select name="type" class="cate form-control" required>
<option value="">- เลือก -</option>
<?php foreach(self::$conf['news'] as $k=>$v):?>
<?php if($v['s']):?>
<optgroup label="<?php echo $v['t']?>"></optgroup>
<?php foreach($v['s'] as $k2=>$v2):?>
<?php if($v2['s']):?>
<optgroup label=" &nbsp; &nbsp; <?php echo $v2['t']?>"></optgroup>
<?php foreach($v2['s'] as $k3=>$v3):?>
<option value="<?php echo $k.'-'.$k2.'-'.$k3?>"> &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $v3['t']?></option>
<?php endforeach?>
<?php else:?>
<option value="<?php echo $k.'-'.$k2?>"> &nbsp; &nbsp; <?php echo $v2['t']?></option>
<?php endif?>
<?php endforeach?>
<?php else:?>
<option value="<?php echo $k?>"><?php echo $v['t']?></option>
<?php endif?>
<?php endforeach?>
</select>
</td></tr>
</table>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ถัดไป "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>

<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/news">จัดการข่าว</a></li>
  <?php if(!empty($this->cp[0])):?>
  <span class="divider">&raquo;</span>
  <li><a href="/news/c-<?php echo $this->cp[0]?>"><?php echo self::$conf['news'][$this->cp[0]]['t']?></a></li>
  <?php endif?>
  <?php if(!empty($this->cp[1])):?>
  <span class="divider">&raquo;</span>
  <li><a href="/news/c-<?php echo $this->cp[0]?>_<?php echo $this->cp[1]?>"><?php echo self::$conf['news'][$this->cp[0]]['s'][$this->cp[1]]['t']?></a></li>
  <?php endif?>
  <?php if(!empty($this->cp[2])):?>
  <span class="divider">&raquo;</span>
  <li><a href="/news/c-<?php echo $this->cp[0]?>_<?php echo $this->cp[1]?>_<?php echo $this->cp[2]?>"><?php echo self::$conf['news'][$this->cp[0]]['s'][$this->cp[1]]['s'][$this->cp[2]]['t']?></a></li>
   <?php endif?>
  <li class="pull-right"><a href="/news/topnews">รายงานยอดการอ่านข่าวประจำวัน</a></li>
  <li class="pull-right"><a href="/news/report">รายงานการเขียนข่าวประจำวัน</a></li>
  <li class="pull-right"><a href="javascript:;" onClick="_.box.open('#newnews')"><span class="glyphicon glyphicon-plus"></span> เพิ่มข่าวใหม่</a></li>
</ul>

<div class="row">
<div class="col-md-10">
<table class="table">
<tr><th>รูปภาพ</th><!--th>ต้องการ</th--><th>รายละเอียด</th><th>ผู้ชม</th><th></th></tr>
<?php $last=time()-(3600*24*EXPIRE_NEWS);for($i=0;$i<count($this->news);$i++):?>
<?php $l=$this->news[$i]['link'];?>
<tr class="l<?php echo $i%2?>">
<td class="i"><?php if($this->news[$i]['img']):?><a href="<?php echo $l?>" target="_blank"><img src="https://<?php echo self::getServ($this->news[$i]['sv'])?>.jarm.com/news/<?php echo $this->news[$i]['fd']?>/s.jpg?<?php echo $last?>" style="height:55px;"></a><?php endif?></td>
<td class="d">
<div class="nowrap"><a href="/news/c-<?php echo $this->news[$i]['c']?>"><?php echo self::$conf['news'][$this->news[$i]['c']]['t']?></a> -  <a href="<?php echo $l?>" target="_blank"><?php echo $this->news[$i]['t']?></a></div>
<?php $u=$this->user->get($this->news[$i]['u'],true);?>
โดย: <a href="<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a>, สร้างเมื่อ: <?php echo self::Time()->from($this->news[$i]['da'],'datetime',true)?><?php if(isset($this->news[$i]['ds'])&&(self::Time()->sec($this->news[$i]['ds'])!=self::Time()->sec($this->news[$i]['da']))):?>, เผยแพร่: <?php echo self::Time()->from($this->news[$i]['ds'],'datetime',true)?><?php endif?>
</td>
<td class="p">
<?php if($this->news[$i]['pl']==1):?>
<span class="label label-success" style="line-height:40px;">
  <?php echo number_format($this->news[$i]['do']+$this->news[$i]['is'])?><br>
  <em style="padding:2px;margin: -15px 0px 0px;font-size:9px;display: block;height: 20px;line-height: 20px;opacity:0.7"><?php echo number_format($this->news[$i]['do'])?> / <?php echo number_format($this->news[$i]['is'])?></em>
</span>
<?php elseif($this->news[$i]['pl']==2):?>
<span class="label label-info"><?php echo number_format($this->news[$i]['do'])?></span>
<?php elseif(!empty($this->news[$i]['wt'])):?>
<span class="label label-warning">รอตรวจสอบ</span>
<?php else:?>
<span class="label label-danger">รอแสดงผล</span>
<?php endif?>
</td>
<td class="a">

<div class="btn-group" role="group" aria-label="เครื่องมือ">
<?php if($this->news[$i]['do']>0):?>
<a href="/news/stats/<?php echo $this->news[$i]['_id']?>" class="btn btn-default"><span class="glyphicon glyphicon-stats"></span><br>สถิติ</a>
<?php endif?>
<a href="javascript:;" onClick="instant(<?php echo $this->news[$i]['_id']?>)" class="btn btn-default"><span class="glyphicon glyphicon-open"></span><br>Instant</a>
<?php if(self::Time()->sec($this->news[$i]['da'])<$last):?>
<a href="javascript:;" class="btn btn-disabled"><span class="glyphicon glyphicon-remove-sign"></span><br>หมดเวลาแก้ไข</a>
<?php else:?>
<?php if(self::$my['am'] || $this->news[$i]['u']==self::$my['_id']):?>
<a href="/news/<?php echo $this->news[$i]['_id']?>" class="btn btn-default"><span class="glyphicon glyphicon-wrench"></span><br>แก้ไข</a>
<?php if(self::$my['am']):?>
<a href="javascript:;" onClick="cdel(<?php echo $this->news[$i]['_id']?>)" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span><br>ลบ</a>
<?php endif?>
<?php endif?>
<?php endif?>
</div>
</td>
</tr>
<?php endfor?>
<?php if(!$this->count):?>
<tr><td colspan="4" style="text-align:center; vertical-align:middle; height:100px; border:1px solid #f7f7f7">ไม่มีข้อมูล</td></tr>
<?php endif?>
</table>
<div align="center"><?php echo $this->pager?></div>
</div>
<div class="col-md-2 hidden-xs hidden-sm">


<style>
.trends{margin-bottom:10px;}
.trends > div{ padding:3px; border-bottom:1px solid #f0f0f0;}
.trends > div:nth-child(even){background:#f8f8f8;}
.trends > div .k{ font-size:16px;}
.trends > div .k span{font-size:12px; color:#999}
.trends > div .r,.trends > div .c{ font-size:12px;}
</style>
<?php if(is_array($this->trends)):?>
<h3 class="bar-heading" style="background:#f4f4f4; padding-left:5px;"><span class="glyphicon glyphicon-signal"></span> กระแสวันนี้</h3>
<?php foreach($this->trends as $k=>$v):?>
<div class="bar-heading"><?php echo self::Time()->from($k.' 00:00:00','date')?></div>

<div class="trends">
<?php if(is_array($v)):?>
<?php foreach($v as $k2=>$v2):?>
<div>
  <div class="k"><span><?php echo $k2+1?>.</span> <a href="https://www.google.com/?q=<?php echo urlencode($v2['key'])?>" target="_blank"><?php echo $v2['key']?></a></div>
    <?php if($v2['desc']):?><div class="r">คำใกล้เคียง: <?php echo $v2['desc']?></div><?php endif?>
    <div class="c">ค้นหา <?php echo number_format($v2['count'])?>+ ครั้ง</div>
</div>
<?php endforeach?>
<?php endif?>
</div>
<?php endforeach?>
<?php endif?>

</div>
</div>
