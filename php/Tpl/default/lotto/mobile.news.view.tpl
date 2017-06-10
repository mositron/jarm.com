<h3 class="lotto-bar">เลขเด็ด และข่าวที่เกี่ยวกับหวย</h3>

<h1 class="news-h1"><?php echo $this->news['t']?></h1>
        <div class="_share">
                <div class="facebook"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Facebook</a></div>
                <div class="twitter"><p>0</p><a href="javascript:;"><span></span> <small>ทวีตไปยัง</small> Twitter</a></div>
                <div class="google"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Google+</a></div>
            </div>
			<script>$(function(){_.share({title:'<?php echo $this->news['t']?>',url:'<?php echo URI?>',img:'<?php echo $this->data['image']?>'});});</script>
            
        <div class="news-detail">
<?php echo $this->news['sm']?>
<?php echo preg_replace('/\<iframe(.*)width="([^"]+)"(.*)height="([^"]+)"(.*)iframe\>/i','<div class="flex-video widescreen"><iframe${1}width="620"${3}height="345"${5}iframe></div>',$this->news['d']);?>
</div>
