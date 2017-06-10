
<?php
$radio = $this->radio[$this->id];
?>
<style>
.rd{margin:0px}
.rd li a{display:block; height:26px; line-height:26px; border-bottom:1px dashed #ccc; color:#666; text-indent:5px; font-size:12px; overflow:hidden;}
.rd li a:hover{background:#f0f0f0}
</style>

<ul class="breadcrumb">
<li><a href="/" title="ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์"><span class="glyphicon glyphicon-home"></span> ฟังเพลง</a></li>
<span class="divider">&raquo;</span>
<li><?php echo $radio['t']?> ฟังเพลง <?php echo $radio['t']?>  ฟังเพลงออนไลน์ <?php echo $radio['t']?></li>
</ul>

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



<div class="row">
<div class="col-sm-3">
<div>

<ul class="rd">
<?php foreach($this->radio as $k=>$v):?>
<li><a href="/<?php echo $v['l']?>" title="<?php echo $v['t']?> ฟังเพลง ฟังวิทยุออนไลน์ <?php echo $v['t']?>"><?php echo $v['t']?></a></li>
<?php endforeach?>
<p class="clear"></p>
</ul>
</div>
</div>
<div class="col-sm-9">
<h1 class="news-h1"><?php echo $radio['t']?></h1>
<p>ฟังเพลง<?php echo $radio['t']?>  ฟังเพลงออนไลน์<?php echo $radio['t']?>  ฟังวิทยุออนไลน์<?php echo $radio['t']?></p>
<div class="row">
<div class="col-sm-3  text-center">
<img src="<?php echo FILES_CDN?>img/radio/<?php echo $radio['im']?>" alt="<?php echo $radio['t']?>">
</div>
<div class="col-sm-9 text-center">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Jarm - 336x280 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:336px;height:280px"
     data-ad-client="ca-pub-8383574629063856"
     data-ad-slot="7879089727"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
</div>
<h3>ฟังเพลง <?php echo $radio['t']?> <small>ฟังเพลงออนไลน์ <?php echo $radio['t']?> ฟังวิทยุออนไลน์ <?php echo $radio['t']?></small></h3>

<div style="margin:10px 0px">
<?php
if($radio['ty']=='flash'):
?>
  <script type="text/javascript" src="<?php echo FILES_CDN?>js/jwplayer/jwplayer.js"></script>
  <div id='mediaspace'>กรุณารอซํกครู่</div>
  <script type='text/javascript'>
	 jwplayer('mediaspace').setup({
		'flashplayer': '<?php echo $radio['py']['swf']?$radio['py']['swf']:'/_cdn/js/jwplayer/player.swf'?>',
		'file': '<?php echo $radio['py']['file']?>',
		'skin':'/_cdn/js/jwplayer/skin/stormtrooper.zip',
		'bufferlength': '3',
		<?php if( $radio['py']['streamer']):?>'streamer': '<?php echo $radio['py']['streamer']?>',<?php endif?>
		<?php if( $radio['py']['type']):?>'type': '<?php echo $radio['py']['type']?>',<?php endif?>
		'autostart': 'true',
		'controlbar': 'bottom',
		'width': '400',
		'height': '24',
	 });
	 </script>
<?php
endif;
?></div>

<div style="text-align:center;padding:5px 0px"><a href="https://play.google.com/store/apps/details?id=com.doodroid.radio" title="ฟังวิทยุออนไลน์ ผ่านแอพ Android ฟรี" target="_blank"><img src="https://cdn.jarm.com/img/banner/radio-banner.gif" class="img-responsive"></a></div>

<div style="margin-bottom:5px;">
<a href="/" title="ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์" target="_blank">ฟังเพลง</a>ทุกแนว ทั้งเพลงสนุก เพลงรัก เพลงคิดถึง เพลงอกหัก และอีกหลากหลายอารมณ์ได้ที่ Jarm Radio
</div>
   		<div class="socialshare">
            <div style="float:left"><div class="fb-like" data-href="https://www.facebook.com/jarm" data-width="90" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div></div>
            <div style="float:left;"><div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/115817126393353079017" data-rel="publisher"></div></div>
            <div><div class="g-plusone" data-size="medium" data-annotation="inline" data-width="90" data-href="<?php echo URI?>"></div></div>
            <div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
            <div><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-lang="th" data-hashtags="jarm" rel="nofollow">ทวีต</a></div>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            <p></p>
        </div>


<div style="padding:10px 0px 0px 0px">
<h4 style="padding: 8px;background: #f7f7f7;color: #f90;">ฟังเพลงแล้ว รู้สึกกันยังไง แสดงความรู้สึกกันได้ที่นี่เลย</h4>
<div class="fb-comments" data-href="<?php echo URI?>" data-num-posts="100" data-width="500"></div>
</div>

</div>
</div>
