<h3 class="lotto-bar">เลขเด็ด และข่าวที่เกี่ยวกับหวย</h3>
<h1 class="news-h1"><?php echo $this->news['t']?></h1>
<div class="news-detail">
<?php echo $this->news['sm']?>
<?php echo preg_replace('/\<iframe(.*)width="([^"]+)"(.*)height="([^"]+)"(.*)iframe\>/i','<div class="flex-video widescreen"><iframe${1}width="620"${3}height="345"${5}iframe></div>',$this->news['d']);?>
</div>
