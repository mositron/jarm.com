<style>
.news-bottom3 div > a {height: 140px !important;}
@media (max-width: 992px){
.news-bottom3 div > a {height: 130px !important;}
}
/*
.flex-video.widescreen{padding-bottom: 52.9%;}
*/
</style>

<ul class="breadcrumb">
	<li><a href="/" title="ดูทีวีย้อนหลัง"><span class="glyphicon glyphicon-home"></span> ดูทีวีย้อนหลัง</a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/program/<?php echo $this->list['_id']?>" title="<?php echo $this->list['name_th']?>"><?php echo $this->list['name_th']?></a></li>
	<span class="divider">&raquo;</span>
	<li><a href="/player/<?php echo $this->episode['_id']?>" title="<?php echo $this->title?>"><?php echo $this->title?></a></li>
</ul>

<?php require(__CONF.'ads/ads.dfp-12.php');?>

<div class="_share">
	<div class="facebook"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Facebook</a></div>
	<div class="twitter"><p>0</p><a href="javascript:;"><span></span> <small>ทวีตไปยัง</small> Twitter</a></div>
	<div class="google"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Google+</a></div>
</div>
<script>$(function(){_.share({title:'<?php echo $this->title?>',url:'<?php echo URI?>',img:'<?php echo $this->data['image']?>',cb:function(a,b,c){if(a=='facebook'){}}});});</script>
<h1 class="bar-heading"><a href="/player/<?php echo $this->episode['_id']?>"><?php echo $this->title?></a></h1>
<?php for($i=0;$i<count($this->episode['part_items']);$i++):$v2=$this->episode['part_items'][$i];?>
<div>
	<p><?php echo $v2['name_th']?></p>
	<div class="flex-video widescreen"><?php echo str_replace(['&lt;','&gt;','?auto=true'],['<','>','?auto=false'],$v2['stream_url'])?></div>
</div>
<?php endfor?>

<?php require(__CONF.'ads/ads.dfp-34.php');?>

<div class="socialshare">
	<div style="float:left"><div class="fb-like" data-href="https://www.facebook.com/jarm" data-width="90" data-colorscheme="light" data-layout="button_count" data-action="like" data-show-faces="false" data-send="false"></div></div>
	<div style="float:left;"><div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/115817126393353079017" data-rel="publisher"></div></div>
	<div><div class="g-plusone" data-size="medium" data-annotation="inline" data-width="90" data-href="<?php echo URI?>"></div></div>
	<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
	<div><a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-lang="th" data-hashtags="jarm" rel="nofollow">ทวีต</a></div>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	<p></p>
</div>

<style>
.news-native div {padding:0px;border-bottom: 1px dashed #ddd;margin-bottom: 10px;}
/*.news-native div:last-child{border:none; margin-bottom:0px;}*/
.news-native div > a { position:relative;overflow:hidden; display:block}
.news-native div > a strong{font-weight:normal;position:absolute; left:0px; top:0px; background:#000; background-color:rgba(0,0,0,0.6);color:#ccc; font-size:12px; padding:1px 5px; border-bottom-right-radius: 5px;z-index:1;}
.news-native h4{margin:3px 0px 0px;line-height: 21px; font-weight:normal;}
.news-native h4 a {font-size: 16px;color: #444;max-height:63px; overflow:hidden;display:block;}
</style>

<div class="row  news-native news-padding clear-line">
	 <div data-advs-adspot-id="ODIyOjU5MTk" style="display:none"></div>
	 <div data-advs-adspot-id="ODIyOjU5MTk" style="display:none"></div>
	 <!--div data-advs-adspot-id="MTU0OjU5MjA" style="display:none"></div-->
</div>

<script src="http://js.mtburn.com/advs-instream.js"></script>
<script type="text/javascript">MTBADVS.InStream.Default.run({"immediately":true})</script>

<h3 class="bar-heading" style="margin-top:5px">แสดงความคิดเห็นด้วย Facebook</h3>
<div class="fb-comments" data-href="<?php echo URI?>" data-num-posts="30" data-width="100%" data-version="v2.9"></div>
