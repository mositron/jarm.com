<div class="layer-1">
  <h1 class="talk-of-the-town">TALK OF THE TOWN <small class="hidden-xs">ข่าวดัง เรื่องฮิต ติดตามกระแสสังคม</small></h1>
  <div class="row">
    <div class="col-sm-7">
      <div id="talk-banner">
        <ul class="swipe-gallery">
          <?php if($this->hbanner['img']):?>
          <?php $i=0;foreach($this->hbanner['img'] as $v):?>
          <li><a href="<?php echo $v['l']?>" onClick="var v=window.open('<?php echo $v['pr']?>', '_blank');v.focus();return false" title="<?php echo $v['d']?>" target="_blank"><img src="https://f2.jarm.com/banner/<?php echo $v['fd']?>/<?php echo $v['s']?>" alt="<?php echo $v['d']?>" width="100%"></a></li>
          <?php $i++;endforeach?>
          <?php endif?>
        </ul>
        <nav></nav>
      </div>
    </div>
    <div class="col-sm-5 talk-top-5">
      <div class="row news-bottom3 clear-line news-adsv">
        <div data-advs-adspot-id="NTA0OjYwODQ" style="display:none"></div>
        <div data-advs-adspot-id="NTA0OjYwODQ" style="display:none"></div>
        <?php for($i=0;$i<min(4,count($this->hbanner['bottom']));$i++):$v=$this->hbanner['bottom'][$i];?>
        <div class="col-xs-6">
          <a href="<?php echo $v['l']?>" onClick="var v=window.open('<?php echo $v['pr']?>', '_blank');v.focus();return false" title="<?php echo $v['d']?>" target="_blank">
            <img data-original="https://f2.jarm.com/banner/<?php echo $v['fd']?>/<?php echo $v['s']?>" alt="<?php echo $v['d']?>" class="img-responsive lazy">
          </a>
          <h4><a href="<?php echo $v['l']?>" onClick="var v=window.open('<?php echo $v['pr']?>', '_blank');v.focus();return false" title="<?php echo $v['d']?>" target="_blank"><?php echo $v['d']?></a></h4>
        </div>
        <?php endfor?>
      </div>
    </div>
  </div>
</div>
<script src="https://js.mtburn.com/advs-instream.js"></script>
<script type="text/javascript">MTBADVS.InStream.Default.run({"immediately":true})</script>
<div class="layer-2">
  <div class="navbar news-tab">
    <ul class="nav"><li>ประเด็นฮอตประจำวัน</li><li><a href="<?php echo self::uri(['news','/'])?>" onClick="return newstab(0);" class="active news-tab-0" title="ข่าว ข่าววันนี้ ข่าวล่าสุด">ข่าวเด่น</a></li><li><a href="<?php echo self::uri(['news','/general'])?>" onClick="return newstab(1);" class="news-tab-1" title="ข่าวทั่วไป เรื่องทั่วไป">ทั่วไป</a></li><!--li><a href="<?php echo self::uri(['news','/private'])?>" onClick="return newstab(3);" class="news-tab-3" title="ข่าวโดนๆ">โดนๆ</a></li--><li><a href="<?php echo self::uri(['game','/'])?>" onClick="return newstab(6);" class="news-tab-6" title="เกมส์">เกมส์</a></li><li><a href="<?php echo self::uri(['tech','/'])?>" onClick="return newstab(5);" class="news-tab-5" title="เทคโนโลยี">เทคโนโลยี</a></li><li><a href="<?php echo self::uri(['movie','/'])?>" onClick="return newstab(4);" class="news-tab-4" title="หนัง หนังใหม่ ภาพยนตร์">หนังใหม่</a></li><li><a href="<?php echo self::uri(['pr','/'])?>" onClick="return newstab(2);" class="news-tab-2" title="ข่าวประชาสัมพันธ์">ข่าวประชาสัมพันธ์</a></li></ul>
  </div>
  <div class="jarm-news">
    <?php foreach($this->news as $k=>$v):?>
    <div class="main l<?php echo $k?>">
      <div class="row news-bottom2 clear-line">
      <?php for($i=0;$i<count($v);$i++):$v2=$v[$i];?>
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 <?php echo $v2['cls']?>">
          <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
          <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
        </div>
      <?php endfor?>
      </div>
    </div>
    <?php endforeach?>
  </div>
</div>
<div class="layer-3">
  <?php if(!empty($this->data['banner']['b'])):?>
  <!-- BEGIN - BANNER : B -->
  <div class="_banner _banner-b"><?php echo $this->data['banner']['b']?></div>
  <!-- END - BANNER : B -->
  <?php endif?>
  <h3><a href="<?php echo self::uri(['ent','/'])?>" target="_blank">ข่าวบันเทิง</a> <small class="hidden-xs">ดารา นักร้อง ซุบซิบดารา ภาพยนตร์</small></h3>
  <div class="row news-bottom2 clear-line">
  <?php for($i=0;$i<6;$i++):$v2=$this->ent[$i];?>
    <div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
      <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
      <h4><a href="<?php echo $v2['link']?>" target="_blank" style="max-height:42px;"><?php echo $v2['title']?></a></h4>
      <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
    </div>
  <?php endfor?>
  </div>
  <div class="row news-left2 clear-line">
  <?php for($i=6;$i<count($this->ent);$i++):$v2=$this->ent[$i]?>
    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
      <a href="<?php echo $v2['link']?>" target="_blank"><img data-original="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
      <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
      <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span></p>
    </div>
    <?php endfor?>
  </div>
</div>
<div class="layer-4">
  <h3><a href="<?php echo self::uri(['live','/'])?>" target="_blank">จาม จะเม้าท์</a> <small class="hidden-xs">ถ่ายทอดสด, Facebook Live</small></h3>
  <div class="row">
    <div class="col-md-8">
      <div class="row news-bottom2 clear-line">
        <?php for($i=0;$i<6;$i++):$v2=$this->live[$i];?>
        <div class="col-xs-6 col-sm-4 col-md-4">
          <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
          <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
          <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
        </div>
        <?php endfor?>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row news-left2 clear-line">
        <?php for($i=6;$i<count($this->live);$i++):$v2=$this->live[$i];?>
        <div class="col-xs-6 col-sm-4 col-md-12<?php echo $i>=9?' hidden-sm':''?><?php echo $i>=10?' hidden-xs':''?>">
          <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
          <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
          <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span></p>
        </div>
        <?php endfor?>
      </div>
    </div>
  </div>
</div>
<div class="layer-4">
  <h3><a href="<?php echo self::uri(['korea','/'])?>" target="_blank">ข่าวเกาหลี</a> <small class="hidden-xs">ดาราเกาหลี นักร้องเกาหลี เพลงเกาหลี</small></h3>
  <div class="row news-bottom2 clear-line">
  <?php for($i=0;$i<count($this->korea);$i++):$v2=$this->korea[$i];?>
    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
      <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
      <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
      <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
    </div>
  <?php endfor?>
  </div>
  <div>
    <?php if(!empty($this->data['banner']['c'])):?>
    <!-- BEGIN - BANNER : C -->
    <div class="_banner _banner-c" style="margin:5px 0px 0px;"><?php echo $this->data['banner']['c']?></div>
    <!-- END - BANNER : C -->
    <?php endif?>
  </div>
</div>
<div class="layer-4">
  <h3><a href="<?php echo self::uri(['knowledge','/'])?>" target="_blank">เกร็ดความรู้</a> <small class="hidden-xs">สาระน่ารู้ ความรู้รอบตัว</small></h3>
  <div class="row">
    <div class="col-md-8">
      <div class="row news-bottom2 clear-line">
        <?php for($i=0;$i<6;$i++):$v2=$this->knowledge[$i];?>
        <div class="col-xs-6 col-sm-4 col-md-4">
          <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
          <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
        </div>
        <?php endfor?>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-12">
          <?php if(!empty($this->data['banner']['g'])):?>
          <!-- BEGIN - BANNER : G -->
          <div class="_banner _banner-g"><?php echo $this->data['banner']['g']?></div>
          <!-- END - BANNER : G -->
          <?php endif?>
        </div>
        <div class="col-sm-8 col-md-12">
          <div class="row news-left2 clear-line">
            <?php for($i=6;$i<count($this->knowledge);$i++):$v2=$this->knowledge[$i];?>
            <div class="col-xs-6 col-sm-6 col-md-12">
              <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
              <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
            </div>
            <?php endfor?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="layer-4 row">
  <h3><a href="<?php echo self::uri(['eat','/'])?>" target="_blank">อาหาร</a> <small class="hidden-xs">กิน ดื่ม ร้านอาหาร เมนูอาหาร</small></h3>
  <div class="row news-bottom2 clear-line">
    <?php for($i=0;$i<count($this->eat);$i++):$v2=$this->eat[$i];?>
    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
      <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
      <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
    </div>
    <?php endfor?>
  </div>
</div>
<div class="layer-4">
  <h3><a href="<?php echo self::uri(['tech','/'])?>" target="_blank">เทคโนโลยี</a> <small class="hidden-xs">อัพเดทข่าวเทคโนโลยี มือถือ อุปกรณ์ไอที</small></h3>
  <div class="row">
    <div class="col-md-8">
      <div class="row news-bottom2 clear-line">
        <?php for($i=0;$i<6;$i++):$v2=$this->tech[$i];?>
        <div class="col-xs-6 col-sm-4 col-md-4">
          <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
          <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
        </div>
        <?php endfor?>
      </div>
      <?php if(!empty($this->data['banner']['d'])):?>
      <!-- BEGIN - BANNER : D -->
      <div class="_banner _banner-d" style="margin: 10px 0px 5px;"><?php echo $this->data['banner']['d']?></div>
      <!-- END - BANNER : D -->
      <?php endif?>
    </div>
    <div class="col-md-4">
      <div class="row news-left2 clear-line">
        <?php for($i=6;$i<count($this->tech)-(empty($this->data['banner']['d'])?1:0);$i++):$v2=$this->tech[$i];?>
        <div class="col-xs-6 col-sm-4 col-md-12<?php echo $i>=9?' hidden-sm':''?><?php echo $i>=10?' hidden-xs':''?>">
          <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
          <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
        </div>
        <?php endfor?>
      </div>
    </div>
  </div>
</div>
<div class="layer-4">
  <h3><a href="<?php echo self::uri(['beauty','/'])?>" target="_blank">ผู้หญิง</a> <small class="hidden-xs">แต่งหน้า เสริมสวย ความงาม สุขภาพ แฟชั่น ทรงผม ครบทุกเรื่องราวสำหรับผู้หญิง</small></h3>
  <div class="row news-bottom2 clear-line">
    <?php for($i=0;$i<count($this->beauty);$i++):$v2=$this->beauty[$i];?>
    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
      <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
      <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
      <?php /*<p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>*/?>
    </div>
    <?php endfor?>
  </div>
</div>
<div class="layer-4">
  <h3><a href="http://www.autocar.in.th/" target="_blank">รถใหม่</a> <small class="hidden-xs">รถยนต์ รถยนต์ป้ายแดง รีวิวรถใหม่</small></h3>
  <div class="row">
    <div class="col-md-8">
      <div class="row news-bottom2 clear-line">
        <?php for($i=0;$i<6;$i++):$v2=$this->car[$i];?>
        <div class="col-xs-6 col-sm-4 col-md-4">
          <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_t']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
          <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
          <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
        </div>
        <?php endfor?>
      </div>
      <?php if(!empty($this->data['banner']['e'])):?>
      <!-- BEGIN - BANNER : E -->
      <div class="_banner _banner-e" style="margin: 10px 0px 5px;"><?php echo $this->data['banner']['e']?></div>
      <!-- END - BANNER : E -->
      <?php endif?>
    </div>
    <div class="col-md-4">
      <div class="row news-left2 clear-line">
        <?php for($i=6;$i<count($this->car);$i++):$v2=$this->car[$i];?>
        <div class="col-xs-6 col-sm-4 col-md-12<?php echo $i>=9?' hidden-sm':''?><?php echo $i>=10?' hidden-xs':''?>">
          <a href="<?php echo $v2['link']?>" title="<?php echo $v2['title']?>" target="_blank"><img data-original="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive lazy"><strong><?php echo self::$conf['news'][$v2['c']]['t']?></strong></a>
          <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
          <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span></p>
        </div>
        <?php endfor?>
      </div>
    </div>
  </div>
</div>
<div class="layer-4 layer-9">
  <h3 class="bar-heading" style="margin-top:15px;"><a href="/">Web Directory</a> <small>ร่วมลิ้งค์เว็บที่น่าสนใจ</small></h3>
  <div class="row link-list clear-line">
    <div class="col-xs-6 col-sm-4 col-md-3">
      <h4 class="bar-heading">หนังสือพิมพ์</h4>
      <div><a href="http://www.bangkokbiznews.com" target="_blank" rel="nofollow" title="กรุงเทพธุรกิจ"><span class="glyphicon glyphicon-globe"></span> กรุงเทพธุรกิจ</a></div>
      <div><a href="http://www.khaosod.co.th" target="_blank" rel="nofollow" title="ข่าวสด"><span class="glyphicon glyphicon-globe"></span> ข่าวสด</a></div>
      <div><a href="http://www.komchadluek.net" target="_blank" rel="nofollow" title="คมชัดลึก"><span class="glyphicon glyphicon-globe"></span> คมชัดลึก</a></div>
      <div><a href="http://www.thansettakij.com" target="_blank" rel="nofollow" title="ฐานเศรษฐกิจ"><span class="glyphicon glyphicon-globe"></span> ฐานเศรษฐกิจ</a></div>
      <div><a href="http://www.daradaily.com" target="_blank" rel="nofollow" title="ดาราเดลี่"><span class="glyphicon glyphicon-globe"></span> ดาราเดลี่</a></div>
      <div><a href="http://www.dailynews.co.th" target="_blank" rel="nofollow" title="เดลินิวส์"><span class="glyphicon glyphicon-globe"></span> เดลินิวส์</a></div>
      <div><a href="http://www.thaipost.net" target="_blank" rel="nofollow" title="ไทยโพสต์"><span class="glyphicon glyphicon-globe"></span> ไทยโพสต์</a></div>
      <div><a href="http://www.thairath.co.th" target="_blank" rel="nofollow" title="ไทยรัฐ"><span class="glyphicon glyphicon-globe"></span> ไทยรัฐ</a></div>
      <div><a href="http://www.nationchannel.com" target="_blank" rel="nofollow" title="เนชั่น"><span class="glyphicon glyphicon-globe"></span> เนชั่น</a></div>
      <div><a href="http://www.nationweekend.com" target="_blank" rel="nofollow" title="เนชั่นสุดสัปดาห์"><span class="glyphicon glyphicon-globe"></span> เนชั่นสุดสัปดาห์</a></div>
      <div><a href="http://www.naewna.com" target="_blank" rel="nofollow" title="แนวหน้า"><span class="glyphicon glyphicon-globe"></span> แนวหน้า</a></div>
      <div><a href="http://www.bangkok-today.com" target="_blank" rel="nofollow" title="บางกอก ทูเดย์"><span class="glyphicon glyphicon-globe"></span> บางกอก ทูเดย์</a></div>
      <div><a href="http://www.bangkokpost.com" target="_blank" rel="nofollow" title="Bangkok Post"><span class="glyphicon glyphicon-globe"></span> บางกอก โพสต์</a></div>
      <div><a href="http://www.banmuang.co.th" target="_blank" rel="nofollow" title="บ้านเมือง"><span class="glyphicon glyphicon-globe"></span> บ้านเมือง</a></div>
      <div><a href="http://www.prachachat.net" target="_blank" rel="nofollow" title="ประชาชาติธุรกิจ"><span class="glyphicon glyphicon-globe"></span> ประชาชาติธุรกิจ</a></div>
      <div><a href="http://www.manager.co.th" target="_blank" rel="nofollow" title="ผู้จัดการ"><span class="glyphicon glyphicon-globe"></span> ผู้จัดการ</a></div>
      <div><a href="http://www.manager.co.th/mgrweekly" target="_blank" rel="nofollow" title="ผู้จัดการรายสัปดาห์"><span class="glyphicon glyphicon-globe"></span> ผู้จัดการรายสัปดาห์</a></div>
      <div><a href="http://www.posttoday.com" target="_blank" rel="nofollow" title="โพสต์ทูเดย์"><span class="glyphicon glyphicon-globe"></span> โพสต์ทูเดย์</a></div>
      <div><a href="http://www.matichon.co.th" target="_blank" rel="nofollow" title="มติชน"><span class="glyphicon glyphicon-globe"></span> มติชน</a></div>
      <div><a href="http://www.siamrath.co.th" target="_blank" rel="nofollow" title="สยามรัฐ"><span class="glyphicon glyphicon-globe"></span> สยามรัฐ</a></div>
      <div><a href="http://www.siamsport.co.th" target="_blank" rel="nofollow" title="สยามสปอร์ต"><span class="glyphicon glyphicon-globe"></span> สยามสปอร์ต</a></div>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-3">
      <h4 class="bar-heading">ทีวี</h4>
      <div><a href="http://www.thaitv3.com" target="_blank" rel="nofollow" title="ช่อง 3"><span class="glyphicon glyphicon-hd-video"></span> ช่อง 3</a></div>
      <div><a href="http://www.tv5.co.th" target="_blank" rel="nofollow" title="ช่อง 5"><span class="glyphicon glyphicon-sd-video"></span> ช่อง 5</a></div>
      <div><a href="http://www.ch7.com" target="_blank" rel="nofollow" title="ช่อง 7"><span class="glyphicon glyphicon-hd-video"></span> ช่อง 7</a></div>
      <div><a href="http://www.mcot.net" target="_blank" rel="nofollow" title="ช่อง 9"><span class="glyphicon glyphicon-sd-video"></span> ช่อง 9</a></div>
      <div><a href="http://www.prd.go.th" target="_blank" rel="nofollow" title="ช่อง 11"><span class="glyphicon glyphicon-sd-video"></span> ช่อง 11</a></div>
      <div><a href="http://www.thaipbs.or.th" target="_blank" rel="nofollow" title="Thai PBS"><span class="glyphicon glyphicon-sd-video"></span> Thai PBS - 3</a></div>
      <div><a href="http://www.springnewstv.tv" target="_blank" rel="nofollow" title="Spring News"><span class="glyphicon glyphicon-sd-video"></span> Spring News - 19</a></div>
      <div><a href="http://www.voicetv.co.th" target="_blank" rel="nofollow" title="Voice TV"><span class="glyphicon glyphicon-sd-video"></span> Voice TV - 21</a></div>
      <div><a href="http://www.nationchannel.com" target="_blank" rel="nofollow" title="Nation Channel"><span class="glyphicon glyphicon-sd-video"></span> Nation Channel - 22</a></div>
      <div><a href="http://workpointtv.com" target="_blank" rel="nofollow" title="WorkPoint"><span class="glyphicon glyphicon-sd-video"></span> Wordpoint - 23</a></div>
      <div><a href="http://www.now26.tv" target="_blank" rel="nofollow" title="NOW 26"><span class="glyphicon glyphicon-sd-video"></span> NOW - 26</a></div>
      <div><a href="http://www.thaich8.com" target="_blank" rel="nofollow" title="ช่อง 8"><span class="glyphicon glyphicon-sd-video"></span> ช่อง 8 - 27</a></div>
      <div><a href="http://mono29.mthai.com" target="_blank" rel="nofollow" title="Mono 29"><span class="glyphicon glyphicon-sd-video"></span> Mono - 29</a></div>
      <div><a href="http://www.onehd.net" target="_blank" rel="nofollow" title="One HD 31"><span class="glyphicon glyphicon-hd-video"></span> ONE - 31</a></div>
      <div><a href="http://www.thairath.tv" target="_blank" rel="nofollow" title="Thairath 32"><span class="glyphicon glyphicon-hd-video"></span> ไทยรัฐ TV - 32</a></div>
      <div><a href="http://www.gangcartoon.net" target="_blank" rel="nofollow" title="แก็งการ์ตูน"><span class="glyphicon glyphicon-sound-stereo"></span> Gang Cartoon</a></div>
      <h4 class="bar-heading">โรงหนัง</h4>
      <div><a href="http://www.majorcineplex.com" target="_blank" rel="nofollow" title="Major Cineplex"><span class="glyphicon glyphicon-facetime-video"></span> Major Cineplex</a></div>
      <div><a href="http://www.sfcinemacity.com" target="_blank" rel="nofollow" title="SF Cinema City"><span class="glyphicon glyphicon-facetime-video"></span> SF Cinema City</a></div>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-3">
      <h4 class="bar-heading">อาหาร เดลิเวอรี่</h4>
      <div><a href="http://www.chesters.co.th" target="_blank" rel="nofollow" title="Chester Grill"><span class="glyphicon glyphicon-cutlery"></span> Chester Grill - 1145</a></div>
      <div><a href="https://www.kfc.co.th" target="_blank" rel="nofollow" title="KFC"><span class="glyphicon glyphicon-cutlery"></span> KFC - 1150</a></div>
      <div><a href="http://www.mcthai.co.th" target="_blank" rel="nofollow" title="McDonald's"><span class="glyphicon glyphicon-cutlery"></span> McDonald's - 1711</a></div>
      <div><a href="http://www.mkrestaurant.com" target="_blank" rel="nofollow" title="MK Restaurant"><span class="glyphicon glyphicon-cutlery"></span> MK - 02-248-5555</a></div>
      <div><a href="http://www.oishigroup.com/product_delivery.php" target="_blank" rel="nofollow" title="Oishi"><span class="glyphicon glyphicon-cutlery"></span> Oishi - 1773</a></div>
      <div><a href="https://www.1112.com" target="_blank" rel="nofollow" title="Pizza Company 1112"><span class="glyphicon glyphicon-cutlery"></span> Pizza Company - 1112</a></div>
      <div><a href="https://www.pizzahut.co.th" target="_blank" rel="nofollow" title="Pizza Hut"><span class="glyphicon glyphicon-cutlery"></span> Pizza Hut - 1150</a></div>
      <div><a href="https://www.snpfood.com" target="_blank" rel="nofollow" title="S&P"><span class="glyphicon glyphicon-cutlery"></span> S&P - 1344</a></div>
      <div><a href="https://www.swensens1112.com" target="_blank" rel="nofollow" title="Swensens 1112"><span class="glyphicon glyphicon-cutlery"></span> Swensens - 1112</a></div>
      <div><a href="http://www.yayoirestaurants.com" target="_blank" rel="nofollow" title="Yayoi Restaurant"><span class="glyphicon glyphicon-cutlery"></span> Yayoi - 02-248-5555</a></div>
      <h4 class="bar-heading">สินค้า</h4>
      <div><a href="http://www.shopat7.com" target="_blank" rel="nofollow" title="7-Eleven"><span class="glyphicon glyphicon-btc"></span> 7-Eleven - สินค้าทั่วไป</a></div>
      <div><a href="http://www.advice.co.th" target="_blank" rel="nofollow" title="Advice"><span class="glyphicon glyphicon-btc"></span> Advice - สินค้าไอที</a></div>
      <div><a href="http://www.bananait.com" target="_blank" rel="nofollow" title="Banana IT"><span class="glyphicon glyphicon-btc"></span> Banana IT - สินค้าไอที</a></div>
      <div><a href="http://www.bigc.co.th" target="_blank" rel="nofollow" title="Big C"><span class="glyphicon glyphicon-btc"></span> Big C - สินค้าทั่วไป</a></div>
      <div><a href="http://www.central.co.th" target="_blank" rel="nofollow" title="Central Online"><span class="glyphicon glyphicon-btc"></span> Central - สินค้าทั่วไป</a></div>
      <div><a href="http://www.jib.co.th" target="_blank" rel="nofollow" title="J.I.B."><span class="glyphicon glyphicon-btc"></span> J.I.B. - สินค้าไอที</a></div>
      <div><a href="http://www.lazada.co.th" target="_blank" rel="nofollow" title="Lazada"><span class="glyphicon glyphicon-btc"></span> Lazada - สินค้าทั่วไป</a></div>
      <div><a href="http://www.officemate.co.th" target="_blank" rel="nofollow" title="Officemate"><span class="glyphicon glyphicon-btc"></span> Officemate - สินค้าสำนักงาน</a></div>
      <div><a href="http://www.tescolotus.com" target="_blank" rel="nofollow" title="Tesco Lotus"><span class="glyphicon glyphicon-btc"></span> Tesco Lotus - สินค้าทั่วไป</a></div>
      <div><a href="http://www.zalora.co.th" target="_blank" rel="nofollow" title="Zalora"><span class="glyphicon glyphicon-btc"></span> Zalora - สินค้าแฟชั่น</a></div>
    </div>
    <div class="col-xs-6 col-sm-4 col-md-3">
      <h4 class="bar-heading">วิทยุออนไลน์</h4>
      <div><a href="https://radio.jarm.com/89.0" title="89.0 Chill FM ฟังเพลง ฟังวิทยุออนไลน์ 89.0 Chill FM" target="_blank"><span class="glyphicon glyphicon-music"></span> 89.0 Chill FM</a></div>
      <div><a href="https://radio.jarm.com/91.0" title="91.0 สวพ91 Traffic Pro Bangkok ฟังเพลง ฟังวิทยุออนไลน์ 91.0 สวพ91 Traffic Pro Bangkok" target="_blank"><span class="glyphicon glyphicon-music"></span> 91.0 สวพ91 Traffic Pro Bangkok</a></div>
      <div><a href="https://radio.jarm.com/91.5" title="91.5 Fresz FM เฟรช เอฟเอ็ม ฟังเพลง ฟังวิทยุออนไลน์ 91.5 Fresz FM" target="_blank"><span class="glyphicon glyphicon-music"></span> 91.5 Fresz FM</a></div>
      <div><a href="https://radio.jarm.com/93.0" title="93.0 Cool FM ฟังเพลง ฟังวิทยุออนไลน์ 93.0 Cool FM" target="_blank"><span class="glyphicon glyphicon-music"></span> 93.0 Cool FM</a></div>
      <div><a href="https://radio.jarm.com/94.0" title="94.0 EFM ฟังเพลง ฟังวิทยุออนไลน์ 94.0 EFM" target="_blank"><span class="glyphicon glyphicon-music"></span> 94.0 EFM</a></div>
      <div><a href="https://radio.jarm.com/96.0" title="96.0 Sport Radio ฟังเพลง ฟังวิทยุออนไลน์ 96.0 Sport Radio" target="_blank"><span class="glyphicon glyphicon-music"></span> 96.0 Sport Radio</a></div>
      <div><a href="https://radio.jarm.com/97.5" title="97.5 Seed FM ฟังเพลง ฟังวิทยุออนไลน์ 97.5 Seed FM" target="_blank"><span class="glyphicon glyphicon-music"></span> 97.5 Seed FM</a></div>
      <div><a href="https://radio.jarm.com/98.0" title="98.0 Fat FM ฟังเพลง ฟังวิทยุออนไลน์ 98.0 Fat FM" target="_blank"><span class="glyphicon glyphicon-music"></span> 98.0 Fat FM</a></div>
      <div><a href="https://radio.jarm.com/98.5" title="98.5 Good FM ฟังเพลง ฟังวิทยุออนไลน์ 98.5 Good FM" target="_blank"><span class="glyphicon glyphicon-music"></span> 98.5 Good FM</a></div>
      <div><a href="https://radio.jarm.com/99.0" title="99.0 Active99 ฟังเพลง ฟังวิทยุออนไลน์ 99.0 Active99" target="_blank"><span class="glyphicon glyphicon-music"></span> 99.0 Active99</a></div>
      <div><a href="https://radio.jarm.com/100.0" title="100.0 จส.100 ฟังเพลง ฟังวิทยุออนไลน์ 100.0 จส.100" target="_blank"><span class="glyphicon glyphicon-music"></span> 100.0 จส.100</a></div>
      <div><a href="https://radio.jarm.com/102.0" title="102.0 คลื่นคนทำงาน ฟังเพลง ฟังวิทยุออนไลน์ 102.0 คลื่นคนทำงาน" target="_blank"><span class="glyphicon glyphicon-music"></span> 102.0 คลื่นคนทำงาน</a></div>
      <div><a href="https://radio.jarm.com/102.5" title="102.5 Get FM ฟังเพลง ฟังวิทยุออนไลน์ 102.5 Get FM" target="_blank"><span class="glyphicon glyphicon-music"></span> 102.5 Get FM</a></div>
      <div><a href="https://radio.jarm.com/103.0" title="103.0 Like FM ฟังเพลง ฟังวิทยุออนไลน์ 103.0 Like FM" target="_blank"><span class="glyphicon glyphicon-music"></span> 103.0 Like FM</a></div>
      <div><a href="https://radio.jarm.com/103.5" title="103.5 FM One ฟังเพลง ฟังวิทยุออนไลน์ 103.5 FM One" target="_blank"><span class="glyphicon glyphicon-music"></span> 103.5 FM One</a></div>
      <div><a href="https://radio.jarm.com/104.5" title="104.5 Love Radio ฟังเพลง ฟังวิทยุออนไลน์ 104.5 Love Radio" target="_blank"><span class="glyphicon glyphicon-music"></span> 104.5 Love Radio</a></div>
      <div><a href="https://radio.jarm.com/105.0" title="105.0 FM วิทยุไทย เพื่อเด็กและครอบครัว ฟังเพลง ฟังวิทยุออนไลน์ 105.0 FM วิทยุไทย เพื่อเด็กและครอบครัว" target="_blank"><span class="glyphicon glyphicon-music"></span> 105.0 FM วิทยุไทย เพื่อเด็กและครอบครัว</a></div>
      <div><a href="https://radio.jarm.com/105.5" title="105.5 Eazy FM ฟังเพลง ฟังวิทยุออนไลน์ 105.5 Eazy FM" target="_blank"><span class="glyphicon glyphicon-music"></span> 105.5 Eazy FM</a></div>
      <div><a href="https://radio.jarm.com/106.0" title="106.0 วิทยุครอบครัวข่าว ฟังเพลง ฟังวิทยุออนไลน์ 106.0 วิทยุครอบครัวข่าว" target="_blank"><span class="glyphicon glyphicon-music"></span> 106.0 วิทยุครอบครัวข่าว</a></div>
      <div><a href="https://radio.jarm.com/106.5" title="106.5 Green Wave ฟังเพลง ฟังวิทยุออนไลน์ 106.5 Green Wave" target="_blank"><span class="glyphicon glyphicon-music"></span> 106.5 Green Wave</a></div>
      <div><a href="https://radio.jarm.com/107.0" title="107.0 MET107 ฟังเพลง ฟังวิทยุออนไลน์ 107.0 MET107" target="_blank"><span class="glyphicon glyphicon-music"></span> 107.0 MET107</a></div>
    </div>
  </div>
</div>
<script>
function newstab(i){if($('.news-tab-'+i).hasClass('active')){return true;};$('.jarm-news .main').css('display','none');$('.jarm-news .l'+i).css('display','block');$('.news-tab .active').removeClass('active');$('.news-tab-'+i).addClass('active');$(window).trigger('scroll');return false;}
</script>
