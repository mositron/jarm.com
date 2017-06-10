<h3 class="matching-bar">อับดับสมาชิกสูงสุด</h3>
<ul class="top-list">
<?php $i=1;foreach($this->user as $v):?>
<li data-market="com.doodroid.<?php echo $k?>">
<a href="https://www.facebook.com/profile.php?id=<?php echo $v['fb']?>" target="_blank">
<img src="http://graph.facebook.com/<?php echo $v['fb']?>/picture?type=square">
<h1><?php echo $i?>. <?php echo $v['name']?></h1>
<h2>คะแนนสะสมสูงสุด <?php echo number_format($v['score'])?>, เลเวล <?php echo $v['lv']?></h2>
</a>
</li>
<?php $i++;endforeach?>
</ul>