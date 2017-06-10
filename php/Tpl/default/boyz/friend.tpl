<?php if($this->page == 1):?>

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


<style>
.nav-zone{padding-left:10px;}
.nav-zone ul li {padding: 0px 0px 0px 20px;list-style: inside;}
.ti{min-width:50px; text-align:center;}
</style>

<div class="zone-box">
<h3 class="bar-title"><i></i> หาเพื่อนเกย์ตามจังหวัด หาเพื่อนเกย์ตามภูมิภาค</h3>


<ul class="row nav-zone row-count-3">
<?php foreach($this->pc as $k=>$n):?>
<li class="col-sm-4">
<h4><a href="/friend/z-<?php echo $k?>" title="หาเพื่อนเกย์ <?php echo $this->zone[$k]['n']?>"><span class="glyphicon glyphicon-map-marker"></span><?php echo $this->zone[$k]['n']?></a></h4>
<ul>
<?php
foreach($n as $v):?>
<li><a href="/friend/p-<?php echo $v['_id']?>"><?php echo $v['t']?></a></li>
<?php endforeach?>
<li><a href="/friend/z-<?php echo $k?>" title="หาเพื่อนเกย์<?php echo $this->zone[$k]['n']?> ทั้งหมด">ทั้งหมด</a></li>
</ul>
</li>
<?php endforeach?>
</ul>
</div>
<?php endif?>

<div>
<h3 class="bar-title"> เพื่อนเกย์มาใหม่</h3>
<ul class="breadcrumb">
<li><a href="/" title="เกย์ ชายรักชาย"><span class="glyphicon glyphicon-home"></span> เกย์</a></li>
<span class="divider">&raquo;</span>
<li><a href="/friend" title="หาเพื่อนเกย์"><span class="glyphicon glyphicon-list"></span> หาเพื่อนเกย์</a></li>
<span class="divider">&raquo;</span>
 <li class="dropdown">
 <?php $purl=($this->c?'/c-'.$this->c:'');?>
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->z?$this->zone[$this->z]['n']:'ทุกภูมิภาค'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><?php if($purl):?><a href="/friend<?php echo $purl?>">ทุกภูมิภาค</a><?php else:?><a href="/">กลับหน้าแรก</a><?php endif?></li>
   <li class="divider"></li>
   <li><a href="/friend/z-1<?php echo $purl?>">กรุงเทพและปริมณฑล</a></li>
   <li><a href="/friend/z-2<?php echo $purl?>">ภาคเหนือ</a></li>
   <li><a href="/friend/z-3<?php echo $purl?>">ภาคตะวันออกเฉียงเหนือ</a></li>
   <li><a href="/friend/z-4<?php echo $purl?>">ภาคตะวันตก</a></li>
   <li><a href="/friend/z-5<?php echo $purl?>">ภาคตะวันออก</a></li>
   <li><a href="/friend/z-6<?php echo $purl?>">ภาคกลาง</a></li>
   <li><a href="/friend/z-7<?php echo $purl?>">ภาคใต้</a></li>
  </ul>
 </li>
<?php if($this->z):?>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->p?$this->province[$this->p]['name_th']:'ทุกจังหวัด'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/friend/z-<?php echo $this->z?><?php echo $purl?>">ทุกจังหวัด</a></li>
   <li class="divider"></li>
 <?php for($i=0;$i<count($this->zone[$this->z]['l']);$i++):?>
 <?php $j=$this->zone[$this->z]['l'][$i];?>
   <li><a href="/friend/p-<?php echo $j.$purl?>"><?php echo $this->province[$j]['name_th']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <?php endif?>
<?php $insub=false;?>
<?php $curl = '/'.($this->p?'p-'.$this->p.'/':($this->z?'z-'.$this->z.'/':''));?>
</ul>
<?php if($this->page > 1):?>
<div style="text-align:center"><?php echo $this->pager?></div>
<?php endif?>
<table class="table table-striped">
<thead><tr><th></th><th>เพศ</th><th>ชื่อ</th><th>ข้อความทักทาย</th><th>จังหวัด</th><th>อายุ</th><th></th></tr></thead>
<tbody>
<?php if($this->msn):?>
<?php foreach($this->msn as $v):?>
<?php
if($v['ty2']=='gay3')
{
	$t='danger';
}
elseif($v['ty2']=='gay1')
{
	$t='default';
}
elseif($v['ty2']=='gay2')
{
	$t='warning';
}
else
{
	$t='info';
}
?>
<tr class="<?php echo $v['ty']?>">
<td class="ti"><?php echo self::Time()->from($v['da'],'date',true)?></td>
<td class="ty"><span class="label label-<?php echo $t?>"><?php echo $this->type[$v['ty2']]?></span></td>
<td class="em"><a href="msnim:add?contact=<?php echo $v['em']?>" rel="nofollow"><?php echo $v['em']?></a></td>
<td class="ms"><?php echo $v['ms']?>
<?php if($v['fd']&&$v['pt']):?> <a href="https://s3.jarm.com/msn/<?php echo $v['fd']?>/<?php echo $v['pt']?>" rel="gallery"  class="pirobox_gall" title="<?php echo $v['em']?>"><span class="label label-default">รูป</span></a><?php endif?>
<?php if($v['cm']):?> <img src="<?php echo FILES_CDN?>img/friend/cm.png" alt="มีกล้อง"><?php endif?>
<?php if($v['fb']):?> <a href="https://www.facebook.com/app_scoped_user_id/<?php echo $v['fb']?>" rel="nofollow"><span class="label label-default">Facebook</span></a> <?php endif?>
<?php if($v['tw']):?> <a href="https://twitter.com/<?php echo $v['tw']?>" rel="nofollow"><span class="label label-default">Twitter</span></a> <?php endif?>
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

<script>
var NotUseFBGlobal=true,uid=0,fb_id='',fb_name='';
function addfb()
{
	if(uid)
	{
		$('input[name=facebook]').val(uid);
		$('#facebook_id').val(fb_id);
		$('#facebook_name').val(fb_name);
	}
	else
	{
		_.box.confirm({title:'ไปยัง Facebook',detail:'ระบบจะทำการ redirect ไปยัง facebook เพื่อรับค่า facebook url ของคุณ<br>ต้องการให้ระบบทำงานต่อไปหรือไม่',click:function(){top.location='https://graph.facebook.com/oauth/authorize?client_id=<?php echo self::$conf['social']['facebook']['appid']?>&redirect_uri=<?php echo urlencode(URI)?>';}});
	}
}
function addin()
{
	if(_.my)
	{
		$('input[name=inettown]').val(_.my.link);
	}
	else
	{
		_.box.alert('คุณยังไม่ได้ล็อคอิน');
	}
}
window.fbAsyncInit = function() {
  FB.init({appId:<?php echo self::$conf['social']['facebook']['appid']?>,status:true,cookie:true,xfbml:true});
  FB.getLoginStatus(function(r){
	  if(r.status=='connected')
	  {
		  uid=r.authResponse.userID;
		  FB.api('/me', function(r) {uid=(r.username?r.username:r.id);fb_name=r.name,fb_id=r.id});
		}
	});
};
</script>
