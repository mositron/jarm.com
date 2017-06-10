<style>
.news-bottom3 div > a {height: 140px !important;}
@media (max-width: 992px){
.news-bottom3 div > a {height: 130px !important;}
}
</style>


<h2 class="bar-heading"><a href="/<?php echo $this->cate['link']?>"><?php echo $this->cate['name_th']?></a></h2>
<div class="row news-bottom3 clear-line">
<?php for($i=0;$i<count($this->list);$i++):$v2=$this->list[$i];?>
  <div class="col-xs-6 col-sm-4 col-md-4">
    <a href="/program/<?php echo $v2['_id']?>" title="<?php echo $v2['name_th']?>" target="_blank">
      <img src="<?php echo $v2['thumbnail']?>" alt="<?php echo $v2['name_th']?>" class="img-responsive lazy">
      <!--strong></strong-->
    </a>
    <h4><a href="/program/<?php echo $v2['_id']?>" target="_blank"><?php echo $v2['name_th']?></a></h4>
    <p><span class="glyphicon glyphicon-time"></span> <span class="ago" datetime="<?php echo self::Time()->sec($v2['modified_date'])?>"><?php echo self::Time()->from($v2['modified_date'],'ago')?></span><span class="hidden-xs">ที่ผ่านมา</span> <span class="glyphicon glyphicon-eye-open"></span> <?php echo number_format($v2['do'])?><span class="hidden-xs"> ครั้ง</span></p>
  </div>
<?php endfor?>
</div>
