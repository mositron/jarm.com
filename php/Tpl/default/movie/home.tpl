<?php $count = count($this->news)?>
<div class="row">
    <div class="col-md-3">
      <div>
            <h2 class="bar-heading">ข่าวน่าสนใจ</h2>
            <div class="row news-bottom3 clear-line">
            <?php for($i=0;$i<count($this->hot);$i++):$v2=$this->hot[$i];?>
                <div class="col-xs-6 col-sm-3 col-md-12<?php echo ($i>9?' hidden-xs':'')?>">
                    <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank">
                        <img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy">
                        <span><?php echo $i+1?></span>
                        <strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong>
                    </a>
                    <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
                    <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo self::Time()->sec($v2['ds'])?>"><?php echo self::Time()->from($v2['ds'],'ago')?></span><span class="hidden-xs">ที่ผ่านมา</span> <?php /*<span class="glyphicon glyphicon-eye-open"></span> <?php echo number_format($v2['do'])?><span class="hidden-xs"> ครั้ง</span>*/?></p>
                </div>
            <?php endfor?>
            </div>
        </div>
    </div>
  <div class="col-md-9">
        <div class="text-center">
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
        </div>
        <?php require(__CONF.'ads/ads.dfp-12.php');?>
      <div class="row">
            <div class="col-sm-5">
                <div class="row row-margin0 news-bottom2 news-bottom2-2 clear-line">
        <?php for($i=0;$i<min($count,4);$i++):$v2=$this->news[$i];?>
                    <div class="col-xs-6 col-sm-12">
                        <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
                        <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
                        <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo self::Time()->sec($v2['ds'])?>"><?php echo self::Time()->from($v2['ds'],'ago')?></span><span class="hidden-xs">ที่ผ่านมา</span><?php /*if($v2['do']):?> <span class="glyphicon glyphicon-eye-open"></span> <?php echo number_format($v2['do'])?><span class="hidden-xs"> ครั้ง</span><?php endif*/?></p>
                    </div>
                <?php endfor?>
                </div>
            </div>
            <div class="col-sm-7">
              <div class="row row-margin0 news-left2 clear-line">
        <?php for($i=4;$i<min($count,14);$i++):$v2=$this->news[$i];?>
                    <div class="col-xs-6 col-sm-6 col-md-12">
                        <a href="<?php echo $v2['link']?>" target="_blank"><img data-original="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
                        <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
                        <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo self::Time()->sec($v2['ds'])?>"><?php echo self::Time()->from($v2['ds'],'ago')?></span><span class="hidden-xs">ที่ผ่านมา</span><?php /*if($v2['do']):?> <span class="glyphicon glyphicon-eye-open"></span> <?php echo number_format($v2['do'])?><span class="hidden-xs"> ครั้ง</span><?php endif*/?></p>
                    </div>
                <?php endfor?>
                </div>
            </div>
        </div>
        <?php require(__CONF.'ads/ads.dfp-34.php');?>
        <div class="news-line"></div>
        <?php for($o=0;$o<5;$o++): $ofs=$o*18;?>
        <div class="row">
            <div class="col-sm-7">
              <div class="row row-margin0 news-left2 clear-line">
        <?php for($i=$ofs+14;$i<min($count,$ofs+28);$i++):$v2=$this->news[$i];?>
                    <div class="col-xs-6 col-sm-6 col-md-12">
                        <a href="<?php echo $v2['link']?>" target="_blank"><img data-original="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
                        <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
                        <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo self::Time()->sec($v2['ds'])?>"><?php echo self::Time()->from($v2['ds'],'ago')?></span><span class="hidden-xs">ที่ผ่านมา</span><?php /*if($v2['do']):?> <span class="glyphicon glyphicon-eye-open"></span> <?php echo number_format($v2['do'])?><span class="hidden-xs"> ครั้ง</span><?php endif*/?></p>
                    </div>
                <?php endfor?>
                </div>
            </div>
            <div class="col-sm-5">
              <div class="row row-margin0 news-bottom2 clear-line">
        <?php for($i=$ofs+28;$i<min($count,$ofs+34);$i++):$v2=$this->news[$i];?>
                    <div class="col-xs-6 col-sm-12">
                        <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
                        <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
                        <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo self::Time()->sec($v2['ds'])?>"><?php echo self::Time()->from($v2['ds'],'ago')?></span><span class="hidden-xs">ที่ผ่านมา</span><?php /*if($v2['do']):?> <span class="glyphicon glyphicon-eye-open"></span> <?php echo number_format($v2['do'])?><span class="hidden-xs"> ครั้ง</span><?php endif*/?></p>
                    </div>
                <?php endfor?>
                 </div>
            </div>
        </div>
        <div class="news-line"></div>
        <?php endfor?>
    </div>
</div>

<script>
$("img.lazy").lazyload({failure_limit:25,effect:"fadeIn"});
</script>
