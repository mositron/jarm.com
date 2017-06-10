<style>
.g-c{padding:0px 5px 5px;}
.g-c li{border-radius:5px; margin:5px 0px 0px 0px; padding:5px 5px 5px 5px; color:#231F20;}
.g-c h4{border-bottom:1px solid rgba(155,155,155,0.5); padding:5px; margin:0px 0px 5px;}
.g-c li a{color:#231F20;}
.g1{background:#F9EC73}
.g41{background:#A6E4F7}
.g71{background:#CAE5A1}
.g91{background:#F9C5D3}


.gl-rec div{text-align:center;margin-bottom:5px;}
.gl-rec div > a{display: block;background: white;margin: 0px auto;line-height: 0px;padding: 0px;border: 1px solid #DDD;}
.gl-rec div p{margin: 0px auto 0px auto;height: 20px;line-height: 20px;overflow: hidden;background: #DDD;border: 1px solid #DDD; text-shadow:1px 1px 0px #fff;white-space:nowrap; text-overflow:ellipsis; text-indent:5px;}
.gl-rec div img{}
.gl-new div{text-align:center; margin-bottom:5px;}
.gl-new div > a{display: block;background: white;margin: 0px auto;line-height: 0px;padding: 0px;border: 1px solid #DDD;}
.gl-new div p{margin: 0px auto 0px auto;height: 20px;line-height: 20px;overflow: hidden;background: #DDD;border: 1px solid #DDD; text-shadow:1px 1px 0px #fff;white-space:nowrap; text-overflow:ellipsis; text-indent:5px;}
.gl-new div img{}
</style>

<article class="col-sm-9 col-content">
<h3 class="bar-heading">กลิตเตอร์แนะนำ</h3>
<div class="gl-rec row clear-line">
<?php for($i=0;$i<count($this->rec);$i++):?>
<div class="col-xs-6 col-sm-3 col-md-3">
<a href="/view/<?php echo $this->rec[$i]['_id']?>">
<img src="http://<?php echo $this->rec[$i]['sv']?>.jarm.com/glitter/<?php echo $this->rec[$i]['fd']?>/t.<?php echo $this->rec[$i]['ty']?>" class="img-responsive">
</a>
<p><?php echo $this->rec[$i]['t']?></p>
</div>
<?php endfor?>
</div>

<h3 class="bar-heading">กลิตเตอร์มาใหม่</h3>
<div class="gl-new row clear-line">
<?php for($i=0;$i<count($this->last);$i++):?>
<div class="col-xs-6 col-sm-3 col-md-3">
<a href="/view/<?php echo $this->last[$i]['_id']?>">
<img src="http://<?php echo $this->last[$i]['sv']?>.jarm.com/glitter/<?php echo $this->last[$i]['fd']?>/t.<?php echo $this->last[$i]['ty']?>" class="img-responsive">
</a>
<p><?php echo $this->last[$i]['t']?></p>
</div>
<?php endfor?>
</div>

</article>
<aside class="col-sm-3 col-side">
  <ul class="g-c">
  <?php
  $c = 0; $i=0;
  foreach($this->cate as $k=>$v):
      if($v['l']):
          if($c) echo '</div></li>';
          $i=0;
          $c=$k;
  ?>
    <li class="g<?php echo $k?>"><h4><a href="/c-<?php echo $k?>"><?php echo $v['t']?></a></h4>
      <div>
      <?php continue;endif?>
      <?php if($i) echo ', ';?><a href="/c-<?php echo $k?>"><?php echo $v['t']?></a><?php $i++;endforeach?>
      </div>
    </li>
  </ul>
  <div class="fb-page" data-href="https://www.facebook.com/jarm" data-width="228" data-height="350" data-hide-cover="false" data-show-facepile="true" data-show-posts="true" style="overflow:hidden;"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/jarm"><a href="https://www.facebook.com/jarm">jarm.com</a></blockquote></div></div>
  <div class="g-page" data-href="//plus.google.com/u/0/115817126393353079017" data-width="228" data-rel="publisher"></div>
</aside>
