<div class="story">
  <div class="posts">
    <?php for ($i = 0; $i < count($this->post); $i++):$u=$this->user->get($this->post[$i]['u'])?>
    <div class="post">
      <div class="pcard clearfix">
        <div class="pull-left">
          <div class="-avatar"><a href="<?php echo $u['link']?>"><img src="<?php echo $u['img']?>"></a></div>
          <div class="-poster"><a href="<?php echo $u['link']?>"><?php echo $u['name']?></a></div>
          <div class="-time"><?php echo self::Time()->from($this->post[$i]['ds'],'date')?></div>
        </div>
        <div class="pull-right">
          <div><span class="glyphicon glyphicon-th-list"></span> <?php echo $this->cate[$this->post[$i]['c']]['t']?></div>
        </div>
      </div>
      <h3 class="-title"><a href="<?php echo $l='/'.$this->post[$i]['bl'].'/'.$this->post[$i]['_id'].'/'.$this->post[$i]['l']?>"><?php echo $this->post[$i]['t']?></a></h3>
      <div class="-detail"><a href="<?php echo $l?>"><?php echo preg_replace('#</?a(\s[^>]*)?>#i','',$this->post[$i]['d']);?></a></div>
    </div>
    <?php endfor?>
  </div>
</div>
