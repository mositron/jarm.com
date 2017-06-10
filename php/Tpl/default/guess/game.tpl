<article class="col-sm-8 col-content">
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

<style>
.ans-list{margin:0px 10px 0px 30px; padding:10px; border-bottom:1px dashed #ccc;}
.ans-list h3{padding:2px 5px;}
.ans-list label input{margin:3px 10px; vertical-align:top;}
</style>
<ul class="breadcrumb">
    <li><a href="/" title="เกมทายใจ"><span class="glyphicon glyphicon-home"></span> เกมทายใจ</a></li>
    <span class="divider">&raquo;</span>
    <li><a href="/cate-<?php echo $this->app['c']?>" title="เกมทายใจ<?php echo $this->cate[$this->app['c']]['t']?>"><?php echo $this->cate[$this->app['c']]['t']?></a></li>
    <span class="divider">&raquo;</span>
    <li><?php echo $this->app['t']?></li>
    <?php if(self::$my['_id']==1):?><li class="pull-right"><a href="/manage/<?php echo $this->app['_id']?>">แก้ไข</a></li><?php endif?>
</ul>

<div>
<?php if($this->app['img']):?><img src="https://s3.jarm.com/guess/<?php echo $this->app['fd']?>/s.jpg" style="float:left; margin:0px 15px 3px 10px; width:100px; height:100px;"><?php endif?>
<h1><?php echo $this->app['t']?></h1>
<div><?php echo $this->app['d']?></div>
<div style="margin:5px 0px; padding:5px;">ประเภท: <a href="/<?php echo $this->app['c']?>" target="_blank"><?php echo $this->cate[$this->app['c']]['t']?></a> - เล่นแล้ว <?php echo number_format(intval($this->app['do']))?> ครั้ง</div>
</div>

<div align="center" style="margin-top:10px">
  <div>
    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fjarm&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:115px; height:21px;" allowtransparency="true"></iframe>
    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FIntrend365-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%25A2%25E0%25B8%25B7%25E0%25B8%2594-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%2581%25E0%25B8%25A3%25E0%25B8%25B5%25E0%25B8%2599-%25E0%25B8%2581%25E0%25B8%25B2%25E0%25B8%2587%25E0%25B9%2580%25E0%25B8%2581%25E0%25B8%2587-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%259C%25E0%25B9%2589%25E0%25B8%25B2%25E0%25B9%2581%25E0%25B8%259F%25E0%25B8%258A%25E0%25B8%25B1%25E0%25B9%2588%25E0%25B8%2599%2F786402811370068&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:115px; height:21px;" allowTransparency="true"></iframe>
 	<div style="display:inline-block; width:83px"><div class="g-follow" data-annotation="none" data-height="20" data-href="//plus.google.com/115817126393353079017" data-rel="publisher"></div></div>
	<div style="display:inline-block; width:83px"><div class="g-follow" data-annotation="none" data-height="20" data-href="//plus.google.com/101529563615466592393" data-rel="publisher"></div></div>
	</div>
<script type="text/javascript">
  window.___gcfg = {lang: 'th'};
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>

<div style="text-align:center">
<span class='st_sharethis_vcount' displayText='ShareThis'></span>
<span class='st_facebook_vcount' displayText='Facebook'></span>
<span class='st_twitter_vcount' displayText='Tweet'></span>
<span class='st_linkedin_vcount' displayText='LinkedIn'></span>
<span class='st_pinterest_vcount' displayText='Pinterest'></span>
<span class='st_email_vcount' displayText='Email'></span>
</div>
<div style="text-align:center;padding:5px 0px"><a href="https://play.google.com/store/apps/details?id=com.doodroid.guess" title="เกมทายใจ ผ่านแอพ Android ฟรี" target="_blank"><img src="https://cdn.jarm.com/img/banner/guess-banner.gif" class="img-responsive"></a></div>

<?php require(__CONF.'ads/ads.adsense.body2.php');?>

<form id="frmans">
<input type="hidden" name="uid" id="uid">
<?php for($i=0;$i<count($this->app['quest']);$i++):$v=$this->app['quest'][$i];shuffle($v['a']);?>
<div class="ans-list">
<h3>ข้อที่ <?php echo $i+1?>. <?php echo $v['t']?></h3>
<ul class="nav">
<?php for($j=0;$j<count($v['a']);$j++):?>
<li><label><input type="radio" class="rdans" name="ans<?php echo $i?>" value="<?php echo $v['a'][$j]['id']?>"> <?php echo $v['a'][$j]['t']?></label></li>
<?php endfor?>
</ul>
</div>
<?php endfor?>
</form>

<?php require(__CONF.'ads/ads.adsense.body2-2.php');?>

<div style="text-align:center; margin:5px"><span class="cplaya btn btn-info btn-large" onClick="playapp()">ดูคำตอบ</span></div>
<div class="sharefb" style="margin:10px"></div>

<div style="margin:10px 0px 0px; padding:5px; border-top:1px dashed #ddd;">
    <?php if($this->user['google']):?>
    <div style="float:left; width:50px;"> <a href="<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><img src="<?php echo $this->user['img']?>" alt="<?php echo $this->user['name']?>" style="width:45px;"></a> </div>
    <div style="margin:0px 0px 0px 55px;"> โดย: <a href="https://plus.google.com/<?php echo $this->user['google']['id']?>?rel=author" rel="author" target="_blank"><?php echo $this->user['google']['name']?></a><br>
        เมื่อ: <?php echo self::Time()->from($this->app['da'],'datetime')?> </div>
    <?php else:?>
    <div style="float:left; width:50px;"> <a href="<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><img src="<?php echo $this->user['img']?>" alt="<?php echo $this->user['name']?>" style="width:45px;"></a> </div>
    <div style="margin:0px 0px 0px 55px;"> เขียนโดย: <a href="<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><?php echo $this->user['name']?></a><br>
        เมื่อ: <?php echo self::Time()->from($this->app['da'],'datetime')?> </div>
    <?php endif?>
    <p class="clear"></p>
</div>
<div style="padding:10px 0px 0px 5px">
  <h4>ความคิดเห็น</h4>
  <div class="fb-comments" data-href="https://guess.jarm.com/game/<?php echo $this->app['_id']?>" data-num-posts="3" data-width="620"></div>
</div>


<script>
var repeatsend=0,postnow=false,checkbox=false,res=false,liked=false,ws={};
function playapp()
{
	if($('.rdans:checked').length!=<?php echo count($this->app['quest'])?>)
	{
		_.box.alert('กรุณาเลือกคำตอบให้ครบทุกข้อ');
	}
	else
	{
		$('#uid').val(uid);
		$('.sharefb').html('<div style="text-align:center"><img src="<?php echo FILES_CDN?>img/global/load.gif"></div>');
		$('.cplaya').prop('disabled','disabled').html('กรุณารอซักครู่...');
		_.ajax.gourl('<?php echo URL?>','playapp',$('#frmans').get(0));
	}
};

function showresult(r)
{
	ws=r;
	posttoshare();
};
function posttoshare()
{
	FB.api('/me/feed', 'post',ws,function(r)
	{
		var j='<br><br><a class="button" href="http://jarm.com/" target="_blank" onClick="closelike()">ปิดหน้าต่างนี้</a>';
		if(!r||r.error)
		{
			repeatsend++;
			if(repeatsend<5)
			{
				$('.sharefb').html('<div style="padding:"10px; text-align:center">กรุณารอซักครู่ เพื่อโพสข้อมูลไปยัง Facebook ('+repeatsend+')</div>');
				setTimeout(function(){posttoshare();},100);
			}
			else
			{
				$('.sharefb').html('<div style="padding:"10px; text-align:center">ไม่สามารถโพสข้อมูลไปยัง Facebook ได้เนื่องจากมีผู้ใชงานจำนวนมากในขณะนี้ <strong>กรุณาลองใหม่อีกครั้ง</strong>'+j+'</div>');
				repeatsend=0;
			}
		}
		else
		{
			var l='https://www.facebook.com/'+r.id;
			l=l.replace('_','/posts/');
			$('.cplaya').removeProp('disabled').html('เล่นอีกครั้ง');
			var tmp='<div style="padding:"10px; text-align:center">โพสไปยัง Facebook เรียบร้อยแล้ว<br>ลิ้งค์บนเฟสบุ๊คคือ <a href="'+l+'" target="_blank">'+l+'</a><br><br>'+
			'<strong>คำตอบคือ</strong>: '+ws.name+'<br>'+
			ws.description+
			'</div>';

			$('.sharefb').html(tmp);
			repeatsend=0;
		};
	});
}
</script>




</article>
<aside class="col-sm-4 col-side">
  <div class="fb-like-box" data-href="https://www.facebook.com/jarm" data-width="320" data-height="205" data-show-faces="true" data-stream="false" data-header="false" data-show-border="false" style="overflow:hidden; margin:0px 0px 5px 5px;"></div>
<?php echo $this->service?>
</aside>
