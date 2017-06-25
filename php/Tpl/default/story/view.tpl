<style>
.story{margin:20px auto;max-width:700px;}
.story hr{cursor:default;margin:20px 0px;border:1px solid #ddd;}
.story ul{list-style:none inside;padding:0px 10px;}
.story .bar-heading{margin:10px 0px 10px;}
.story .-detail{padding:10px;}
.story .-detail img{max-width:100%;height:auto;}
.story .bcard{background:#fcfcfc;padding:10px;border-radius:4px;border:1px solid #eee;}
.story .bcard div>div{font-size:12px;}
.story .bcard .pull-right{padding-left:20px;border-left:1px solid #eee;}
.story .bcard .pull-right img{width:40px;margin:0px 0px -1px 8px;float:right;border-radius:3px;}
.story .bcard .glyphicon{color:#999;font-size:7px;border:1px solid #ddd;padding:2px;border-radius:2px;vertical-align:middle;margin-top:-4px;}

.nav-story{border:4px solid #f9f9f9;padding:10px;border-radius:4px;}
.nav-story:after{content:"";display:block;clear:both;}
.nav-story>div{width:50%;overflow:hidden;float:left;min-height:30px;}
.nav-story .-next{text-align:right;}
.nav-story small{display:block;border-bottom:1px dashed #f0f0f0}
</style>

<div class="story">
  <div class="bcard clearfix">
    <div class="pull-left">
      <a href="/<?php echo $this->blog['l']?>"><?php echo $this->blog['t']?></a>
      <div><span class="glyphicon glyphicon-list"></span> <?php echo $this->cate[$this->post['c']?:$this->blog['c']]['t']?></div>
    </div>
    <div class="pull-right">
      <img src="<?php echo $this->user['img']?>">
      <a href="<?php echo $this->user['link']?>"><span class="glyphicon glyphicon-user"></span>  <?php echo $this->user['name']?></a>
      <div><span class="glyphicon glyphicon-time"></span> <?php echo self::Time()->from($this->post['ds'],'date')?></div>
    </div>
  </div>
  <h2 class="bar-heading"><?php echo $this->post['t']?></h2>
  <div class="-detail"><?php echo $this->post['d']?></div>
  <div class="nav-story">
    <div class="-prev"><?php if($this->prev):?>
      <small>เรื่องก่อนหน้า</small> <a href="/<?php echo $this->prev['bl']?>/<?php echo $this->prev['_id']?>/<?php echo $this->prev['l']?>"><?php echo $this->prev['t']?></a>
    <?php endif?></div>
    <div class="-next"><?php if($this->next):?>
      <small>เรื่องถัดไป</small> <a href="/<?php echo $this->next['bl']?>/<?php echo $this->next['_id']?>/<?php echo $this->next['l']?>"><?php echo $this->next['t']?></a>
    <?php endif?></div>
  </div>
  <div>
    <h3 class="bar-heading" style="margin-top:5px">แสดงความคิดเห็น</h3>
    <div class="fb-comments" data-href="<?php echo self::$core->data['canonical']?:URI?>" data-num-posts="30" data-width="100%" data-version="v2.9"></div>
  </div>
</div>
