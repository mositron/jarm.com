<ul class="breadcrumb">
  <li><a href="/">แผงควบคุม</a></li>
</ul>
<style>
.table thead tr th{text-align:center;}
.table tbody tr td.c{text-align:center;}
.w80{width:80px;}
.w100{width:100px;}
.w130{width:130px;font-size:13px;}
.w200{width:200px; font-size:13px;}
.wright, .table tbody tr td.wright{text-align:right !important;}
.wimg{width:40px;}
.wimg img{width:40px;}
.mbox{margin:0px 0px 10px;padding:0px 5px;}
.mbox .bar-heading{padding-left:5px; color:#000; letter-spacing:1px;}
.mbox-ads > div{margin:24px 20px;}
.mbox-ads > div > div{text-align:center; color:#999; font-size:12px}
.mbox-ads > div > div:first-child{border-right:1px solid #ccc}
.mbox-ads > div > div strong{color: #000;font-size: 44px;display: block;font-family: sans-serif;font-weight: normal;}

.mbox-member > div{margin:10px 20px;}
.mbox-member > div > div{text-align:center; color:#999; font-size:12px; padding-top:10px; padding-bottom:10px;}
.mbox-member > div > div strong{color: #000;font-size: 26px;display: block;font-family: sans-serif;font-weight: normal; line-height:1em;}

.b-right{border-right:1px solid #ccc}
.b-bottom{border-bottom:1px solid #ccc}

.i-sc{margin:0px;}
.i-sc a{margin:15px 0px;display:block;padding:10px;font-size:20px;text-align:center;letter-spacing: 1px;color:#fff;}
.i-sc .i-fb a{background:#3B5998}
.i-sc .i-yt a{background:#CC181E}
.i-sc .i-tw a{background:#1DA1F2}
.i-sc .i-is a{background:#8a3ab9}
</style>
<div class="row i-sc">
  <div class="col-xs-6 col-sm-3 col-md-3 i-fb"><a href="https://www.facebook.com/jarm/" target="blank">Facebook</a></div>
  <div class="col-xs-6 col-sm-3 col-md-3 i-yt"><a href="https://www.youtube.com/channel/UCiRcAr47LLBJU43mfJ2cgLg" target="blank">Youtube</a></div>
  <div class="col-xs-6 col-sm-3 col-md-3 i-tw"><a href="https://twitter.com/jarm_news" target="blank">Twitter</a></div>
  <div class="col-xs-6 col-sm-3 col-md-3 i-is"><a href="https://www.instagram.com/jarm/" target="blank">Instagram</a></div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="mbox">
      <h3 class="bar-heading"><a href="<?php echo self::uri(['news'])?>">ข่าวล่าสุด</a> <small class="pull-right" style="margin-top:12px;"><a href="<?php echo self::uri(['news'])?>">ข่าวทั้งหมด</a></small></h3>
      <div class="row row-margin0 news-left2 clear-line">
        <?php for($i=0;$i<count($this->news);$i++):$v2=$this->news[$i];?>
        <div class="col-xs-6 col-sm-6 col-md-6">
          <a href="<?php echo $v2['link']?>" target="_blank"><img data-original="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
          <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
          <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span></p>
        </div>
      <?php endfor?>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="mbox">
      <h3 class="bar-heading">เพื่อนใหม่ <small class="pull-right" style="margin-top:12px;"></small></h3>
      <div class="table-responsive">
        <table class="table table-hover table-striped" width="100%">
          <thead><tr><th>#</th><th>ชื่อ</th></tr></thead>
          <tbody><?php foreach($this->friend as $v):?><?php $u=$this->user->get($v['_id'],true);?><tr><td class="c wimg"><a href="<?php echo $u['link']?>" target="_blank"><img src="<?php echo $u['img']?>"></a></td><td><a href="<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a><div style="font-size:13px;"><span class="ago" datetime="<?php echo self::Time()->sec($v['da'])?>"><?php echo self::Time()->from($v['da'],'ago')?></span> ที่ผ่านมา</div></td></tr><?php endforeach?></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>$("img.lazy").lazyload({failure_limit:15,effect:"fadeIn"});</script>
