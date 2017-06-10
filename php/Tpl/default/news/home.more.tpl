<?php for($o=0;$o<4;$o++): $ofs=$o*18;?>
<div class="row">
  <div class="col-sm-7">
    <div class="row news-left2 clear-line">
    <?php for($i=$ofs;$i<$ofs+13;$i++):$v2=$this->news[$i];?>
      <div class="col-xs-6 col-sm-6 col-md-12">
        <a href="<?php echo $v2['link']?>" target="_blank"><img data-original="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo $v2['cate']?></strong></a>
        <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
        <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
      </div>
      <?php endfor?>
    </div>
  </div>
  <div class="col-sm-5">
    <div class="row news-bottom2 clear-line">
    <?php for($i=$ofs+13;$i<$ofs+18;$i++):$v2=$this->news[$i];?>
      <div class="col-xs-6 col-sm-12">
        <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo $v2['cate']?></strong></a>
        <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
        <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
      </div>
  <?php endfor?>
    </div>
  </div>
</div>
<div class="news-line"></div>
<?php endfor?>
<div id="news-more"><a href="javascript:;" onClick="loadmore(<?php echo $v2['_id']?>);">โหลดข่าวเพิ่มเติม...</a></div>
