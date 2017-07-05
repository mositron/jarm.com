<div class="story">
  <div class="pboard clearfix">
    <div class="pull-left">
      <h1><a href="/<?php echo $this->blog['l']?>"><?php echo $this->blog['t']?></a></h1>
      <div><span class="glyphicon glyphicon-list"></span> <?php echo $this->cate[$this->post['c']?:$this->blog['c']]['t']?></div>
    </div>
    <div class="pull-right">
      <img src="<?php echo $this->user['img']?>">
      <a href="<?php echo $this->user['link']?>"><?php echo $this->user['name']?></a>
      <div><span class="glyphicon glyphicon-time"></span> <?php echo self::Time()->from($this->post['ds'],'date')?></div>
    </div>
  </div>
  <div class="posts">
    <div class="post">
      <h3 class="-title"><a href="<?php echo '/'.$this->post['bl'].'/'.$this->post['_id'].'/'.$this->post['l']?>"><?php echo $this->post['t']?></a></h3>
      <div class="-detail">
        <?php echo $this->post['d']?>
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
    </div>
  </div>
</div>
