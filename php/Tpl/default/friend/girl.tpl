
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
<div class="fb-like-box" data-href="https://www.facebook.com/jarm" data-width="320" data-height="450" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="width:240px;overflow:hidden;"></div>
</div>
</div>

<div>
<h3 class="bar-title"><i></i> เพื่อน<?php echo $this->type[F_TYPE]?>มาใหม่ (<a href="/t-<?php echo F_TYPE?>">หาเพื่อน<?php echo $this->type[F_TYPE]?>ทั้งหมด</a>)</h3>
<ul class="breadcrumb">
<li><a href="/" title="หาเพื่อน"><span class="glyphicon glyphicon-home"></span> หาเพื่อน</a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo F_TYPE?>" title="หาเพื่อน<?php echo $this->type[F_TYPE]?>"><span class="glyphicon glyphicon-home"></span> หาเพื่อน<?php echo $this->type[F_TYPE]?></a></li>
 </ul>

<table class="table table-striped">
<thead><tr><th></th><th>เพศ</th><th>ชื่อ</th><th>ข้อความทักทาย</th><th>จังหวัด</th><th>อายุ</th><th></th></tr></thead>
<tbody>
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
<td class="em"><a href="msnim:add?contact=<?php echo $v['em']?>" rel="nofollow"><?php echo $v['em']?></a></td>
<td class="ms"><?php echo $v['ms']?>
<?php if($v['fd']&&$v['pt']):?> <a href="https://s3.jarm.com/msn/<?php echo $v['fd']?>/<?php echo $v['pt']?>" rel="gallery"  class="pirobox_gall" title="<?php echo $v['em']?>"><span class="label label-default">รูป</span></a><?php endif?>
<?php if($v['cm']):?> <img src="<?php echo FILES_CDN?>img/friend/cm.png" alt="มีกล้อง"><?php endif?>
<?php if($v['fb']):?> <a href="https://www.facebook.com/<?php echo $v['fb']?>" rel="nofollow"><span class="label label-default">Facebook</span></a> <?php endif?>
<?php if($v['tw']):?> <a href="https://twitter.com/<?php echo $v['tw']?>" rel="nofollow"><span class="label label-default">Twitter</span></a> <?php endif?>
<?php if($v['ln']):?><span class="label label-default">Line: <?php echo $v['ln']?></span><?php endif?>
</td>
<td class="pr"><?php echo $this->province[$v['pr']]['name_th']?></td>
<td class="ag"><?php echo $v['ag']?'<span class="badge badge-'.$t.'">'.$v['ag'].'</span>':''?></td>
<td class="d"><button class="btn btn-xs btn-default" onClick="_.box.load('/report/<?php echo $v['_id']?> #report')">แจ้งลบ</button></td>
</tr>
<?php endforeach?>
</tbody>
</table>
<div style="text-align:center"><?php echo $this->pager?></div>
</div>
