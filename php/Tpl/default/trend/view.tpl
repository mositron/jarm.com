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
.trend-graph{text-align: center;overflow: hidden;height: 240px;position: relative;}
.trend-graph iframe{margin-top: -105px; width: 100%; min-width: 350px;left:0px;bottom:0px; position: absolute;}
</style>

<ul class="breadcrumb">
  <li><a href="/" title="กระแสวันนี้"><span class="glyphicon glyphicon-home"></span> กระแสวันนี้</a></li>
	<span class="divider">&raquo;</span>
   <li><a href="/<?php echo urlencode($this->trend['key'])?>"><?php echo $this->trend['key']?></a></li>
   <span></span>
    <li class="pull-right hidden-xs"><small><a href="/update/<?php echo $this->trend['_id']?>" rel="nofollow">แก้ไข</a></small></li>
</ul>

<div style="text-align:center;margin:0px 0px 10px"><a href="https://play.google.com/store/apps/details?id=com.doodroid.trend" target="_blank" title="กระแสวันนี้"><img src="https://cdn.jarm.com/img/banner/trend-banner.gif" alt="กระแสวันนี้" class="img-responsive" style="margin:auto"></a></div>

<div class="trends">
	<h1 class="news-h1">
		<a href="/<?php echo urlencode($this->trend['key'])?>"><?php echo $this->trend['key']?></a>
    	<small>(<?php if($this->trend['desc']):?>คำใกล้เคียง: <?php echo $this->trend['desc']?>, <?php endif?>ค้นหา <?php echo number_format($this->trend['count'])?>+ ครั้ง)</small>
	</h1>
	<div class="row">
		<div class="col-sm-6">
			<h4 class="bar-heading">24 ชมที่ผ่านมา</h4>
			<div class="trend-graph">
				<script type="text/javascript" src="//www.google.co.th/trends/embed.js?hl=th&q=<?php echo urlencode($this->trend['key'])?>&date=now+1-d&cmpt=q&tz=Etc/GMT-7&tz=Etc/GMT-7&content=0&cid=TIMESERIES_GRAPH_0&export=5&w=320&h=340&geo=TH"></script>
			</div>
		</div>
		<div class="col-sm-6">
			<h4 class="bar-heading">1 เดือนที่ผ่านมา</h4>
			<div class="trend-graph">
				<script type="text/javascript" src="//www.google.co.th/trends/embed.js?hl=th&q=<?php echo urlencode($this->trend['key'])?>&date=today+1-m&cmpt=q&tz=Etc/GMT-7&tz=Etc/GMT-7&content=0&cid=TIMESERIES_GRAPH_0&export=5&w=320&h=340&geo=TH"></script>
			</div>
		</div>
	</div>
	<h4 class="bar-heading">ข่าวหรือข้อมูลที่เกี่ยวข้อง</h4>
	<div class="block">
		<div class="row news-left2 news-padding clear-line">
			<?php $news=get_trend_news($this->trend['lkey'],$this->trend['desc'],50);?>
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
