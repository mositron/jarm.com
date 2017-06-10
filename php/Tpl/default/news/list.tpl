<?php if($this->data['banner']['b']):?>
<!-- BEGIN - BANNER : B -->
<div class="_banner _banner-b"><?php echo $this->data['banner']['b']?></div>
<!-- END - BANNER : B -->
<?php endif?>
<?php if($this->data['banner']['c']):?>
<!-- BEGIN - BANNER : C -->
<div class="_banner _banner-c"><?php echo $this->data['banner']['c']?></div>
<!-- END - BANNER : C -->
<?php endif?>
<div class="col-content">
<ul class="breadcrumb">
  <li><a href="<?php echo self::uri(['news'])?>" title="ข่าววันนี้"><span class="glyphicon glyphicon-home"></span> ข่าววันนี้</a></li>
  <?php foreach($this->nav as $v):?>
    <span class="divider">&raquo;</span>
    <li><a href="<?php echo $v['link']?>" title="<?php echo $this->v['title']?>"><?php echo $v['title']?></a></li>
  <?php endforeach?>
</ul>

<div class="row row-margin0 news-left3 clear-line">
<?php for($i=0;$i<min(12,count($this->news));$i++): $v2=$this->news[$i];?>
  <div class="col-xs-6 col-sm-4 col-md-6">
    <a href="<?php echo $v2['link']?>" target="_blank"><img src="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive"><strong><?php echo $v2['cate']?></strong></a>
    <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
    <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
  </div>
  <?php endfor?>
</div>


<div class="row row-margin0 news-left3 clear-line">
<?php for($i=min(12,count($this->news));$i<min(24,count($this->news));$i++):$v2=$this->news[$i];?>
  <div class="col-xs-6 col-sm-4 col-md-6">
    <a href="<?php echo $v2['link']?>" target="_blank"><img src="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive"><strong><?php echo $v2['cate']?></strong></a>
    <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
    <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
  </div>
  <?php endfor?>
</div>

<?php if($this->data['banner']['d']):?>
<!-- BEGIN - BANNER : D -->
<div class="_banner _banner-d"><?php echo $this->data['banner']['d']?></div>
<!-- END - BANNER : D -->
<?php endif?>
<?php if($this->data['banner']['e']):?>
<!-- BEGIN - BANNER : E -->
<div class="_banner _banner-e"><?php echo $this->data['banner']['e']?></div>
<!-- END - BANNER : E -->
<?php endif?>
  <div class="row row-margin0 news-left3 clear-line">
  <?php for($i=min(24,count($this->news));$i<count($this->news);$i++):$v2=$this->news[$i];?>
    <div class="col-xs-6 col-sm-4 col-md-6">
      <a href="<?php echo $v2['link']?>" target="_blank"><img src="<?php echo $v2['img_s']?>" alt="<?php echo $v2['title']?>" class="img-responsive"><strong><?php echo $v2['cate']?></strong></a>
      <h4><a href="<?php echo $v2['link']?>" target="_blank"><?php echo $v2['title']?></a></h4>
      <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo $v2['sec']?>"><?php echo $v2['ago']?></span><span class="hidden-xs">ที่ผ่านมา</span></p>
    </div>
    <?php endfor?>
  </div>
  <div style="text-align:center"><?php echo $this->pager?></div>
</div>
