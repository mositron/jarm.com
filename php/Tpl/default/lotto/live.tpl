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

<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="ตรวจหวย"><span class="glyphicon glyphicon-home"></span> ตรวจหวย</a></li>
<span class="divider">&raquo;</span>
<li class="active"><a href="/set" title="ถ่ายทอดหวย ตรวจหวยออนไลน์ ถ่ายทอดสดผลหวย"><span class="glyphicon glyphicon-list"></span> ถ่ายทอดหวย</a></li>
</ul>

<h3 style="margin-bottom:5px">ถ่ายทอดหวย ตรวจหวยออนไลน์ ถ่ายทอดสดหวย ถ่ายทอดผลหวย</h3>

<style>
#mediaspace iframe[style],#mediaspace embed[style],#mediaspace object[style],#mediaspace_wrapper[style],#mediaspace_wrapper{width:100% !important;}

</style>
<div style="margin:5px 0px">
  <!--script type='text/javascript' src='<?php echo FILES_CDN?>js/jwplayer/jwplayer.js'></script>
  <div class="flex-video widescreen"><div id='mediaspace'>กรุณารอซํกครู่</div></div>
  <script type='text/javascript'>
	 jwplayer('mediaspace').setup({
		'flashplayer':'<?php echo FILES_CDN?>js/jwplayer/player.swf',
		'skin':'<?php echo FILES_CDN?>js/jwplayer/skin/stormtrooper.zip',
		'bufferlength': '3',
		'controlbar': 'bottom',
		'width': '628',
		'height': '385',
		'autostart':'true',
		'streamer': 'rtmp://fms1.prd.go.th/nbttv',
		'file':'livestream'
	 });
	 </script-->


<!--div style="border: 0; width: 640px; height: 360px; overflow: hidden;">

<iframe style="width: 670px; height: 480px; margin-top: -120px; margin-left: -30px;" src="http://live.springnewstv.tv/" width="640" height="360" scrolling="no"></iframe>

</div-->


  <script type='text/javascript' src='<?php echo FILES_CDN?>js/jwplayer/jwplayer.js'></script>
  <div class="flex-video widescreen"><div id="mediaspace">กรุณารอซํกครู่</div></div>
  <script type='text/javascript'>
	 jwplayer('mediaspace').setup({
		'flashplayer': 'http://live.springnewstv.tv/player/player.swf',
		'skin':'<?php echo FILES_CDN?>js/jwplayer/skin/stormtrooper.zip',
		'bufferlength': '3',
		'controlbar': 'bottom',
		'width': '628',
		'height': '385',
		'autostart':'true',
		'streamer': 'rtmp://livestream.springnews.co.th/live',
		'file':'livestream1'
	 });
	 </script>

<!--object type="application/x-shockwave-flash" data="http://live.springnewstv.tv/player/player.swf" width="100%" height="100%" bgcolor="#000000" id="player" name="player" tabindex="0"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="seamlesstabbing" value="true"><param name="wmode" value="opaque"><param name="flashvars" value="netstreambasepath=http%3A%2F%2Flive.springnewstv.tv%2F&amp;id=player&amp;title=Spring%20News%20TV%20-%20Live%20Streaming&amp;skin=player%2Fnewtubedark.zip&amp;autostart=true&amp;plugins=http%3A%2F%2Fplugins.longtailvideo.com%2F5%2Fsharing%2Fsharing.swf&amp;levels=%5B%5BJSON%5D%5D%5B%7B%22bitrate%22%3A%2275%22%2C%22file%22%3A%22livestream1%22%7D%2C%7B%22bitrate%22%3A%22250%22%2C%22file%22%3A%22livestream2%22%7D%2C%7B%22bitrate%22%3A%22450%22%2C%22file%22%3A%22livestream3%22%7D%5D&amp;streamer=rtmp%3A%2F%2Flivestream.springnews.co.th%2Flive%2F&amp;provider=rtmp&amp;sharing.code=&amp;sharing.link=http%3A%2F%2Flive.springnewstv.tv%2F&amp;sharing.pluginmode=HYBRID&amp;controlbar.position=over"></object-->

</div>

<div style="padding:10px; text-align:center;">หากไม่สามารถดูการถ่ายทอดหวยออนไลน์ได้ กรุณารีเฟรสหน้าเว็บ หรือกด F5 ใหม่อีกครั้ง</div>
<!--div class="flex-video widescreen">
<embed width="600" height="450" src="http://player.longtailvideo.com/player.swf" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" flashvars="autostart=true&amp;file=livestream?width=600&amp;height=450&amp;streamer=rtmp://fms1.prd.go.th/nbttv">
</embed>
</div-->

<div class="fb-comments" data-href="<?php echo self::uri(['lotto','/live'])?>" data-num-posts="5" data-width="710"></div>
