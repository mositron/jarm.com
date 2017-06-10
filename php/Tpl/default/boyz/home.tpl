<div class="row">
<div class="col-sm-8 col-content">
<?php if($this->_banner['b']):?>
<!-- BEGIN - BANNER : B -->
<div class="_banner _banner-b"><?php echo $this->_banner['b']?></div>
<!-- END - BANNER : B -->
<?php endif?>
</div>
<div class="col-sm-4 col-side">
<div class="fb-page" data-href="https://www.facebook.com/jarm" data-width="320" data-height="90" data-hide-cover="false" data-show-facepile="true" data-show-posts="true" style="overflow:hidden; margin:0px 0px 5px 5px;"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/jarm"><a href="https://www.facebook.com/jarm">jarm.com</a></blockquote></div></div>
</div>
</div>

<?php if($this->_banner['c']):?>
<!-- BEGIN - BANNER : C -->
<div class="_banner _banner-c"><?php echo $this->_banner['c']?></div>
<!-- END - BANNER : C -->
<?php endif?>

<h3 class="bar-title"><i></i> หาเพื่อนตามจังหวัด หรือตามภูมิภาค</h3>
<ul class="row nav-zone row-count-3">
<?php foreach($this->pc as $k=>$n):?>
<li class="col-sm-4">
<h4><a href="/friend/z-<?php echo $k?>"><span class="glyphicon glyphicon-map-marker"></span>เพื่อน<?php echo $this->zone[$k]['n']?></a></h4>
<ul>
<?php
foreach($n as $v):?>
<li><a href="/friend/p-<?php echo $v['_id']?>"><?php echo $v['t']?></a></li>
<?php endforeach?>
<li><a href="/friend/z-<?php echo $k?>">เพื่อน<?php echo $this->zone[$k]['n']?> ทั้งหมด</a></li>
</ul>
</li>
<?php endforeach?>
</ul>
<a name="post"></a>

<?php if($this->_banner['d']):?>
<!-- BEGIN - BANNER : D -->
<div class="_banner _banner-d"><?php echo $this->_banner['d']?></div>
<!-- END - BANNER : D -->
<?php endif?>

<style>
.nav-zone{padding-left:10px;}
.nav-zone ul li {padding: 0px 0px 0px 20px;list-style: inside;}
.ti{min-width:50px; text-align:center;}
</style>
<h3 class="bar-title"><i></i> ฝากข้อมูลของคุณ</h3>

<div class="alert alert-success al-completed" style="display:none">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลประกาศของคุณเรียบร้อยแล้ว
</div>
<div class="alert alert-success  al-deleted" style="display:none">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการลบข้อความของคุณเรียบร้อยแล้ว
</div>
<script>
$(function(){
var q=window.location.search;
if(q=='?completed')
{
  $('.al-completed').show(0)
}
else if(q=='?deleted')
{
  $('.al-deleted').show(0)
}
});
</script>
<form method="post" enctype="multipart/form-data" action="<?php echo URL?>" class="form-inline">
<table class="table ins" width="100%">
<tr><td class="colum">อีเมล์</td><td colspan="3"><input type="email" class="form-control" name="email" required> <span class="h"> * บังคับกรอก</span><?php if($this->error['email']):?><div class="error"><?php echo $this->error['email']?></div><?php endif?></td></tr>
<tr><td class="colum">เพศ</td><td width="40%"><select name="gender" class="form-control" required>
<option value="">กรุณาเลือก</option>
<?php foreach($this->type as $k=>$v):?>
<option value="<?php echo $k?>"><?php echo $v?></option>
<?php endforeach?>
</select> <span class="h"> * บังคับเลือก</span>
<?php if($this->error['gender']):?><div class="error"><?php echo $this->error['gender']?></div><?php endif?>
</td>
<td class="colum">อายุ</td><td width="40%"><select name="age" class="form-control">
<option value="">กรุณาเลือก</option>
<?php for($i=18;$i<=60;$i++):?>
<option value="<?php echo $i?>"><?php echo $i?></option>
<?php endfor?>
</select>
</td></tr>
<tr><td class="colum">จังหวัด</td><td width="40%">
<select name="province" class="form-control" required>
<option value="">กรุณาเลือก</option>
<?php foreach($this->province as $k=>$v):?>
<?php if($k):?>
<option value="<?php echo $k?>"><?php echo $v['name_th']?></option>
<?php endif?>
<?php endforeach?>
</select>
<span class="h"> * บังคับกรอก</span>
<?php if($this->error['province']):?><div class="error"><?php echo $this->error['province']?></div><?php endif?>
</td>
<td class="colum"><!--รูปภาพ--></td><td width="40%"><!--input type="file" name="photo" class="form-control"--></td></tr>
<tr>
<td class="colum">Facebook</td><td width="40%"><div class="input-group"><span class="input-group-addon">facebook.com/</span><input type="text" name="facebook" class="form-control" readonly></div> <input type="hidden" name="facebook_id" id="facebook_id"><input type="hidden" name="facebook_name" id="facebook_name"><button class="btn btn-default" type="button" onClick="addfb()">เพิ่ม!</button></td>
<td class="colum">Line</td><td><input type="text" name="line" class="form-control"></td>
</tr>
<tr>
<td class="colum">Jarm</td><td width="40%"><div class="input-group"><span class="input-group-addon">jarm.com/</span><input type="text"  name="inettown" class="form-control" readonly></div> <button class="btn btn-default" type="button" onClick="addin()">เพิ่ม!</button></td>
<td class="colum">Twitter</td><td width="40%"><div class="input-group"><span class="input-group-addon">@</span><input type="text" class="form-control col-sm-2" name="twitter"></div></td>
</tr>
<tr><td class="colum">ข้อความทักทาย</td><td colspan="3"><input type="text" class="form-control" name="message" minlength="3" maxlength="100" style="width:100%" required> <span class="h"> * บังคับกรอก</span><?php if($this->error['message']):?><div class="error"><?php echo $this->error['message']?></div><?php endif?></td></tr>
<tr><td class="colum"></td><td colspan="3"><label style="display:inline"><input type="checkbox" name="cam" value="1"> มีกล้อง</label> <span style="display:inline-block; margin:0px 0px 0px 10px; padding:5px; color:#c00"> ควรใช้อีเมล์สำรองแทนการใช้อีเมล์หลัก เพื่อหลีกเลี่ยงการสแปม</span></td></tr>
<tr><td class="colum"></td><td colspan="3"><input type="submit" value=" เพิ่มข้อมูล " class="btn btn-md btn-primary">  <a href="<?php echo self::uri(['boyz','/friend'])?>" style="color:#ff0000;">หาเพื่อนเกย์ สังคมชาวเกย์ เกย์คิง เกย์ควีน คลิกที่นี่</a> <br>(*** ห้ามอัพโหลดรูปภาพอนาจาร หรือใช้ข้อความหยาบคาย โดยเด็ดขาด ***)<br>*** ข้อมูล IP และเวลาในการโพสจะแสดงในหน้าต่างแจ้งลบโดยอัตโนมัติ ***<br><span style="color:#900">*** ข้อความทั้งหมดจะมีหายไปหลังจากทำการโพส 30 วัน **</span>
  <?php if($this->_banner['e']):?>
  <!-- BEGIN - BANNER : E -->
  <div class="_banner _banner-e"><?php echo $this->_banner['e']?></div>
  <!-- END - BANNER : E -->
  <?php endif?>
  <div style="text-align:center;padding:10px 0px;"><a href="https://play.google.com/store/apps/details?id=com.doodroid.friend" target="_blank"><img src="https://cdn.jarm.com/img/banner/friend-banner.gif" class="img-responsive"></a></div>
</td></tr>
</table>
</form>

<div>
<h3 class="bar-title"><i></i> เพื่อนมาใหม่</h3>
<ul class="breadcrumb">
<li><a href="/friend" title="หาเพื่อน"><span class="glyphicon glyphicon-home"></span> หาเพื่อน</a></li>
<span class="divider">&raquo;</span>
 <li class="dropdown">
 <?php $purl=($this->c?'/c-'.$this->c:'');?>
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->z?$this->zone[$this->z]['n']:'ทุกภูมิภาค'?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><?php if($purl):?><a href="/friend<?php echo $purl?>">ทุกภูมิภาค</a><?php else:?><a href="/">กลับหน้าแรก</a><?php endif?></li>
   <li class="divider"></li>
   <li><a href="/friend/z-1<?php echo $purl?>">เพื่อนกรุงเทพและปริมณฑล</a></li>
   <li><a href="/friend/z-2<?php echo $purl?>">เพื่อนภาคเหนือ</a></li>
   <li><a href="/friend/z-3<?php echo $purl?>">เพื่อนภาคตะวันออกเฉียงเหนือ</a></li>
   <li><a href="/friend/z-4<?php echo $purl?>">เพื่อนภาคตะวันตก</a></li>
   <li><a href="/friend/z-5<?php echo $purl?>">เพื่อนภาคตะวันออก</a></li>
   <li><a href="/friend/z-6<?php echo $purl?>">เพื่อนภาคกลาง</a></li>
   <li><a href="/friend/z-7<?php echo $purl?>">เพื่อนภาคใต้</a></li>
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
<?php $curl = '/friend/'.($this->p?'p-'.$this->p.'/':($this->z?'z-'.$this->z.'/':''));?>

</ul>

<?php $turl=$curl.($this->c?'c-'.$this->c.'/':'')?>
<ul class="nav nav-tabs" style="margin-bottom:5px;">
  <li class="active"><a href="<?php echo $turl?>">ทั้งหมด</a></li>
  <?php foreach($this->type as $k=>$v):?>
  <li><a href="<?php echo $turl?>t-<?php echo $k?>"><?php echo $v?></a></li>
  <?php endforeach?>
</ul>

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


<div class="fb-comments" data-href="<?php echo self::uri(['friend','/'])?>" data-num-posts="100" data-width="945"></div>
<script>
var NotUseFBGlobal=true,uid=0,fb_id='',fb_name='';
function addfb()
{
  FB.login(function(response) {
    if (response.authResponse) {
      FB.api('/me', function(r) {
        uid=(r.username?r.username:r.id);fb_name=r.name,fb_id=r.id;
        $('input[name=facebook]').val(uid);
        $('#facebook_id').val(fb_id);
        $('#facebook_name').val(fb_name);
      });
    }
  }, {scope: ''});
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
</script>
