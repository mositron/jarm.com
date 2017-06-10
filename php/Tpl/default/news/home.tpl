<div class="col-md-3">
  <h2 class="bar-heading">ข่าวยอดฮิตประจำวัน</h2>
  <div class="row news-bottom3 clear-line">
  <?php for($i=0;$i<count($this->hot);$i++):$v2=$this->hot[$i];?>
    <div class="col-xs-6 col-sm-3 col-md-12<?php echo ($i>9?' hidden-xs':'')?>">
      <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank">
        <img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy">
        <span><?php echo $i+1?></span>
        <strong><?php echo $v2['cate']?></strong>
      </a>
      <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
      <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
    </div>
    <?php endfor?>
  </div>
</div>
<div class="col-md-9">
  <div class="text-center">
    <?php if(!empty($this->data['banner']['b'])):?>
    <!-- BEGIN - BANNER : B -->
    <div class="_banner _banner-b"><?php echo $this->data['banner']['b']?></div>
    <!-- END - BANNER : B -->
    <?php endif?>
      <?php if(!empty($this->data['banner']['c'])):?>
    <!-- BEGIN - BANNER : C -->
    <div class="_banner _banner-c"><?php echo $this->data['banner']['c']?></div>
    <!-- END - BANNER : C -->
    <?php endif?>
  </div>
  <div class="row">
    <div class="col-sm-5">
      <div class="row news-bottom2 news-bottom2-2 clear-line">
        <?php for($i=0;$i<4;$i++):$v2=$this->news[$i];?>
        <div class="col-xs-6 col-sm-12">
          <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo $v2['cate']?></strong></a>
          <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
          <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
        </div>
        <?php endfor?>
      </div>
    </div>
    <div class="col-sm-7">
      <div class="row news-left2 clear-line">
        <?php for($i=4;$i<14;$i++):$v2=$this->news[$i];?>
        <div class="col-xs-6 col-sm-6 col-md-12">
          <a href="<?php echo $v2['link']?>" target="_blank"><img data-original="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo $v2['cate']?></strong></a>
          <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
          <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
        </div>
        <?php endfor?>
      </div>
    </div>
  </div>
  <div class="news-line"></div>
  <?php for($o=0;$o<5;$o++): $ofs=$o*18;?>
  <div class="row">
    <div class="col-sm-7">
      <div class="row news-left2 clear-line">
        <?php for($i=$ofs+14;$i<$ofs+27;$i++):$v2=$this->news[$i];?>
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
      <?php for($i=$ofs+27;$i<$ofs+32;$i++):$v2=$this->news[$i];?>
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
<script>
$("img.lazy").lazyload({failure_limit:25,effect:"fadeIn"});
function loadmore(i){$('#news-more').html('<span>กรุณารอซักครู่...<span>');_.ajax.gourl('/','loadmore',i);}
$(document).ready(function() {$(window).scroll(function(){if($(window).scrollTop() + $(window).height() + 200 >= $(document).height()){if($('#news-more>a').length){$('#news-more>a').trigger('click');}}});});
</script>
</div>
