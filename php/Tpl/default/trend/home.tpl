<style>
.trends .block h4 b{font-weight: normal; text-decoration: underline;}
.trends .block p b{font-weight: normal;}
.trends >div > h4{font-size: 24px; font-family: 'thaisansneue';}
.news-left2 > div{max-height: 229px; overflow: hidden;}
.news-left2 > div:after{ clear: both; content: ""; display: block;}
.news-left2 div>a{display: block; overflow: hidden; position: relative; background-color: #f0f0f0}
.news-left2 div>a img{width: auto;height: auto;position: absolute;left: -100%;right: -100%;top: -100%;bottom: -100%;margin: auto;min-height: 100%;min-width: 100%;}


.news-left2 h4{max-height: 63px; overflow: hidden;}
.news-left2 p{max-height: 51px; overflow: hidden;}
@media (min-width:992px){
	.news-left2 div>a{width: 120px; height: 80px;}
	.news-left2 h4{margin: 0px 0px 0px 130px;}
	.news-left2 p{margin: 3px 0px 0px 130px;}
}
/*
.news-left2 .noimg h4{margin-left:0px;}
.news-left2 .noimg p{margin-left:0px;}
*/
</style>
<div style="text-align:center;margin:0px 0px 10px"><a href="https://play.google.com/store/apps/details?id=com.doodroid.trend" target="_blank" title="กระแสวันนี้"><img src="https://cdn.jarm.com/img/banner/trend-banner.gif" alt="กระแสวันนี้" class="img-responsive" style="margin:auto"></a></div>
<?php $time=time()?>
<?php if(is_array($this->day)):?>
<?php foreach($this->day as $k=>$v):?>

<h3 class="bar-heading"><?php echo self::Time()->from($k.' 00:00:00','date')?></h3>

<div class="trends">
<?php if(is_array($v)):?>
<?php foreach($v as $k2=>$v2):?>
<div>
	<h4>
		<a href="/<?php echo urlencode($v2['lkey'])?>" target="_blank"><?php echo $v2['key']?></a>
    	<small>(<?php if($v2['desc']):?>คำใกล้เคียง: <?php echo $v2['desc']?>, <?php endif?>ค้นหา <?php echo number_format($v2['count'])?>+ ครั้ง)</small>
	</h4>
	<div class="block">
		<div class="row news-left2 news-padding clear-line">
			<?php $news=get_trend_news($v2['lkey'],$v2['desc']);?>
			<?php for($i=0;$i<count($news);$i++):?>
			<div class="col-xs-6 col-sm-3 col-md-6<?php echo $news[$i]['image']?'':' noimg'?>">
				<a href="<?php echo $news[$i]['url']?>" target="_blank"<?php echo $news[$i]['domain']!='jarm.com'?' rel="nofollow"':''?>><img src="<?php echo get_proxy_image($news[$i]['domain'],$news[$i]['image'])?>" class="img-responsive"><strong><?php echo $news[$i]['domain']?></strong></a>
				<h4><a href="<?php echo $news[$i]['url']?>" target="_blank"<?php echo $news[$i]['domain']!='jarm.com'?' rel="nofollow"':''?>><?php echo $news[$i]['title']?></a></h4>
				<p><?php echo $news[$i]['content']?>
			</div>
			<?php endfor?>
		</div>
	</div>
</div>
<?php endforeach?>
<?php endif?>
</div>
<?php endforeach?>
<?php endif?>

<style>
.news-more>div{height:60px; overflow: hidden;}
.news-more>div>a{float:left;display:block;margin:0px 7px 0px 0px;}
.news-more>div>a img{width:50px;height:50px;}
.news-more>div h4{margin:0px; padding:0px;}
.news-more>div p{font-size: 12px;margin: 0px;line-height: 16px;max-height: 32px;overflow: hidden;}
.news-more>div:after{display: block; content:""; clear: both;}
</style>
<h3 class="bar-heading">คำค้นหาอื่นๆ</h3>
<div class="row news-more news-padding clear-line">
	<?php for($i=0;$i<count($this->more);$i++):?>
	<div class="col-xs-6 col-sm-3 col-md-3">
		<a href="/<?php echo urlencode($this->more[$i]['lkey'])?>">
			<img src="<?php echo $this->more[$i]['img']?>">
		</a>
		<h4><a href="/<?php echo urlencode($this->more[$i]['lkey'])?>"><?php echo $this->more[$i]['key']?></a></h4>
		<p>ค้นหา <?php echo number_format($this->more[$i]['count'])?>+ ครั้ง<br><?php echo _get_time($this->more[$i]['date'])?><?php /*if($this->more[$i]['desc']):?><br>คำใกล้เคียง: <?php echo $this->more[$i]['desc']?><?php endif*/?></p>
	</div>
	<?php endfor?>
</div>
