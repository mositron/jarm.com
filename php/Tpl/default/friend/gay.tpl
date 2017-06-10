<div class="left pf-l">
<div class="hr">
<h3><i></i> เพื่อน<?php echo $this->type[F_TYPE]?>แนะนำ</h3>
<div>
<ul>
<?php foreach($this->rec as $v):?>
<li>
<a href="msnim:add?contact=<?php echo $v['em']?>"><img src="https://s3.jarm.com/msn/rec/<?php echo $v['fd'].'/'.$v['pt']?>" alt="<?php echo $v['em']?>">
<span class="<?php echo $v['ty']?>"><?php echo $this->type[$v['ty']]?><i></i></span>
</a>
<p><i></i><a href="msnim:add?contact=<?php echo $v['em']?>"><?php echo $v['em']?></a></p>
<span><i></i><?php echo $this->province[$v['pr']]['name_th']?></span>
</li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
</div>
</div>
<div class="right pf-r">


<div class="fb-like-box" data-href="https://www.facebook.com/jarm" data-width="240" data-height="550" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="width:240px;overflow:hidden;"></div>
</div>
<div class="clear"></div>

<!--object height="600" width="970" data="http://static.yeechat.com/123flashchat.swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"  codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab" type="application/x-shockwave-flash" id="topcmm_123flashchat"><param value="http://static.yeechat.com/123flashchat.swf" name="movie" /><param value="#FFFFFF" name="bgcolor" /> <param value="always" name="allowScriptAccess" /><param name=flashvars value="init_room=17845&init_skin=default"><embed allowScriptAccess="always" name="topcmm_123flashchat" bgcolor="#FFFFFF" height="600" width="970" type="application/x-shockwave-flash" flashvars="init_room=17845&init_skin=default" src="http://static.yeechat.com/123flashchat.swf" /></embed></object><script src="http://static.yeechat.com/123flashchat.js" language="javascript" /></script-->

<div style="margin:0px;">
<h3 class="hn"><i></i> เพื่อน<?php echo $this->type[F_TYPE]?>มาใหม่ (<a href="/t-<?php echo F_TYPE?>">หาเพื่อน<?php echo $this->type[F_TYPE]?>ทั้งหมด</a>)</h3>
<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="หาเพื่อน"><span class="glyphicon glyphicon-home"></span> หาเพื่อน</a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo F_TYPE?>" title="หาเพื่อน<?php echo $this->type[F_TYPE]?>"><span class="glyphicon glyphicon-home"></span> หาเพื่อน<?php echo $this->type[F_TYPE]?></a></li>
 </ul>

<table class="table table-striped">
<thead><tr><th>วันที่โพส</th><th>เพศ</th><th>ชื่อ</th><th>ข้อความทักทาย</th><th>จังหวัด</th><th>อายุ</th><th></th></tr></thead>
<tbody>
<?php foreach($this->msn as $v):?>
<?php
if($v['ty']=='boy')
{
	$t='info';
}
elseif($v['ty']=='girl')
{
	$t='important';
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
	$t='ladyboy';
}
?>
<tr class="<?php echo $v['ty']?>">
<td class="ti"><?php echo self::Time()->from($v['da'],'date',true)?></td>
<td class="ty"><span class="label label-<?php echo $t?>"><?php echo $this->type[$v['ty']]?></span></td>
<td class="em"><a href="msnim:add?contact=<?php echo $v['em']?>" rel="nofollow"><?php echo $v['em']?></a></td>
<td class="ms"><?php echo $v['ms']?>
<?php if($v['fd']&&$v['pt']):?> <a href="https://s3.jarm.com/msn/<?php echo $v['fd']?>/<?php echo $v['pt']?>" rel="gallery"  class="pirobox_gall" title="<?php echo $v['em']?>"><span class="label">รูป</span></a><?php endif?>
<?php if($v['cm']):?> <img src="<?php echo FILES_CDN?>img/friend/cm.png" alt="มีกล้อง"><?php endif?>
<?php if($v['fb']):?> <a href="https://www.facebook.com/<?php echo $v['fb']?>" rel="nofollow"><img src="<?php echo FILES_CDN?>img/friend/fb.png" alt="Facebook"></a> <?php endif?>
<?php if($v['tw']):?> <a href="https://twitter.com/<?php echo $v['tw']?>" rel="nofollow"><img src="<?php echo FILES_CDN?>img/friend/tw.png" alt="Twitter"></a> <?php endif?>
<?php if($v['ln']):?><span class="label">Line: <?php echo $v['ln']?></span><?php endif?>
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



<script>
var NotUseFBGlobal=true,uid=0;
function addfb()
{
	if(uid)
	{
		$('input[name=facebook]').val(uid)
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
		  FB.api('/me', function(r) {uid=(r.username?r.username:r.id);});
		}
	});
};
</script>
