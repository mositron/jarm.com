<style>
.news-bottom3 div > a {height: 140px !important;}
@media (max-width: 992px){
.news-bottom3 div > a {height: 130px !important;}
}
</style>

<ul class="breadcrumb">
  <li><a href="/" title="ดูทีวีย้อนหลัง"><span class="glyphicon glyphicon-home"></span> ดูทีวีย้อนหลัง</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/program/<?php echo $this->list['_id']?>" title="<?php echo $this->list['name_th']?>"><?php echo $this->list['name_th']?></a></li>
</ul>
<div class="_share">
  <div class="facebook"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Facebook</a></div>
  <div class="twitter"><p>0</p><a href="javascript:;"><span></span> <small>ทวีตไปยัง</small> Twitter</a></div>
  <div class="google"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Google+</a></div>
</div>
<script>$(function(){_.share({title:'<?php echo $this->list['name_th']?> - ดู<?php echo $this->list['name_th']?>ย้อนหลัง',url:'<?php echo URI?>',img:'<?php echo $this->data['image']?>',cb:function(a,b,c){if(a=='facebook'){}}});});</script>
<h1 class="bar-heading"><a href="/player/<?php echo $this->episode['_id']?>"><?php echo $this->list['name_th']?></a></h1>
<div class="row news-bottom3 clear-line">
<?php for($i=0;$i<count($this->episode);$i++):$v2=$this->episode[$i];?>
  <div class="col-xs-6 col-sm-4 col-md-4">
    <a href="/player/<?php echo $v2['_id']?>" title="<?php echo $v2['name_th']?> <?php echo self::Time()->from($v2['date'],'date')?>" target="_blank">
      <img src="<?php echo $v2['thumbnail']?>" alt="<?php echo $v2['name_th']?>" class="img-responsive lazy">
      <!--strong></strong-->
    </a>
    <h4><a href="/program/<?php echo $v2['_id']?>" title="<?php echo $v2['name_th']?> <?php echo self::Time()->from($v2['date'],'date')?>" target="_blank"><?php echo self::Time()->from($v2['date'],'date')?></a></h4>
    <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo self::Time()->sec($v2['date'])?>"><?php echo self::Time()->from($v2['date'],'ago')?></span><span class="hidden-xs">ที่ผ่านมา</span> <span class="glyphicon glyphicon-eye-open"></span> <?php echo number_format($v2['do'])?><span class="hidden-xs"> ครั้ง</span></p>
  </div>
<?php endfor?>
</div>
