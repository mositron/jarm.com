
<style>
.ti{min-width:50px; text-align:center;}
</style>

<div class="row">
<div class="col-sm-8">
<?php if($this->_banner['b']):?>
<!-- BEGIN - BANNER : B -->
<div class="_banner _banner-b"><?php echo $this->_banner['b']?></div>
<!-- END - BANNER : B -->
<?php endif?>
<?php if($this->_banner['c']):?>
<!-- BEGIN - BANNER : C -->
<div class="_banner _banner-c"><?php echo $this->_banner['c']?></div>
<!-- END - BANNER : C -->
<?php endif?>

<?php if($this->_banner['d']):?>
<!-- BEGIN - BANNER : D -->
<div class="_banner _banner-d"><?php echo $this->_banner['d']?></div>
<!-- END - BANNER : D -->
<?php endif?>
<?php if($this->_banner['e']):?>
<!-- BEGIN - BANNER : E -->
<div class="_banner _banner-e"><?php echo $this->_banner['e']?></div>
<!-- END - BANNER : E -->
<?php endif?>


</div>
<div class="col-sm-4">
<!--nipa-->

<div class="fb-like-box" data-href="https://www.facebook.com/jarm" data-width="320" data-height="450" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="width:240px;overflow:hidden;"></div>
</div>
</div>

<div style="margin:5px 0px;">


<h3 class="bar-title"><i></i> เพื่อนมาใหม่</h3>


<ul class="breadcrumb">
<li><a href="/" title="หาเพื่อน"><span class="glyphicon glyphicon-home"></span> หาเพื่อน</a></li>
<span class="divider">&raquo;</span>
 <li class="dropdown">
 <?php $purl=($this->c?'/c-'.$this->c:'');?>
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->z?$this->zone[$this->z]['n']:'ทุกภูมิภาค'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><?php if($purl):?><a href="<?php echo $purl?>">ทุกภูมิภาค</a><?php else:?><a href="/">กลับหน้าแรก</a><?php endif?></li>
   <li class="divider"></li>
   <li><a href="/z-1<?php echo $purl?>">กรุงเทพและปริมณฑล</a></li>
   <li><a href="/z-2<?php echo $purl?>">ภาคเหนือ</a></li>
   <li><a href="/z-3<?php echo $purl?>">ภาคตะวันออกเฉียงเหนือ</a></li>
   <li><a href="/z-4<?php echo $purl?>">ภาคตะวันตก</a></li>
   <li><a href="/z-5<?php echo $purl?>">ภาคตะวันออก</a></li>
   <li><a href="/z-6<?php echo $purl?>">ภาคกลาง</a></li>
   <li><a href="/z-7<?php echo $purl?>">ภาคใต้</a></li>
  </ul>
 </li>
<?php if($this->z):?>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->p?$this->province[$this->p]['name_th']:'ทุกจังหวัด'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/z-<?php echo $this->z?><?php echo $purl?>">ทุกจังหวัด</a></li>
   <li class="divider"></li>
 <?php for($i=0;$i<count($this->zone[$this->z]['l']);$i++):?>
 <?php $j=$this->zone[$this->z]['l'][$i];?>
   <li><a href="/p-<?php echo $j.$purl?>"><?php echo $this->province[$j]['name_th']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <?php endif?>

 <?php $insub=false;?>
<?php $curl = '/'.($this->p?'p-'.$this->p.'/':($this->z?'z-'.$this->z.'/':''));?>

</ul>

<?php $turl=$curl.($this->c?'c-'.$this->c.'/':'')?>
<ul class="nav nav-tabs" style="margin-bottom:5px;">
  <li<?php echo !$this->t?' class="active"':''?>><a href="<?php echo $turl?>">ทั้งหมด</a></li>
  <?php foreach($this->type as $k=>$v):?>
  <li<?php echo $this->t==$k?' class="active"':''?>><a href="<?php echo $turl?>t-<?php echo $k?>"><?php echo $v?></a></li>
  <?php endforeach?>
</ul>

<table class="table table-striped">
<thead><tr><th></th><th>เพศ</th><th>อีเมลเฟสบุ๊ค</th><th>ข้อความทักทาย</th><th>จังหวัด</th><th>อายุ</th><th></th></tr></thead>
<tbody>
<?php if($this->msn):?>
<?php foreach($this->msn as $v):?>
<?php
if($v['ty']=='boy')
{
	$t='info';
}
elseif($v['ty']=='girl')
{
	$t='danger';
}
elseif($v['ty']=='gay')
{
	$t='inverse';
}
elseif($v['ty']=='lesbian')
{
	$t='warning';
}
else
{
	$t='warning';
}
?>
<tr class="<?php echo $v['ty']?>">
<td class="ti"><?php echo self::Time()->from($v['da'],'date',true)?></td>
<td class="ty"><span class="label label-<?php echo $t?>"><?php echo $this->type[$v['ty']]?></span></td>
<td class="em"><a href="https://www.facebook.com/search/results/?q=<?php echo urlencode($v['em'])?>" target="_blank" rel="nofollow"><?php echo $v['em']?></a></td>
<td class="ms"><?php echo $v['ms']?>
<?php if($v['cm']):?> <img src="<?php echo FILES_CDN?>img/friend/cm.png" alt="มีกล้อง"><?php endif?>
<?php if($v['fb']):?> <a href="https://www.facebook.com/app_scoped_user_id/<?php echo $v['fb']?>" target="_blank" rel="nofollow"><span class="label label-default">Facebook</span></a> <?php endif?>
<?php if($v['tw']):?> <a href="https://twitter.com/<?php echo $v['tw']?>" target="_blank" rel="nofollow"><span class="label label-default">Twitter</span></a> <?php endif?>
<?php if($v['ln']):?><span class="label label-default">Line: <?php echo $v['ln']?></span><?php endif?>
</td>
<td class="pr"><?php echo $this->province[$v['pr']]['name_th']?></td>
<td class="ag"><?php echo $v['ag']?'<span class="badge badge-'.$t.'">'.$v['ag'].'</span>':''?></td>
<td class="d"><button class="btn btn-xs btn-default" onClick="_.box.load('/report/<?php echo $v['_id']?> #report')">แจ้งลบ</button></td>
</tr>
<?php endforeach?>
<?php else:?>
<tr><td colspan="6" style="height:100px; text-align:center; vertical-align:middle">ไม่มีข้อมูล</td></tr>
<?php endif?>
</tbody>
</table>

<div style="text-align:center"><?php echo $this->pager?></div>
</div>
