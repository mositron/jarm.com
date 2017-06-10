<h3 class="football-bar">ข่าวฟุตบอล รวมทุกลีกดัง</h3>
<div class="news-content">
<h1 class="news-h1"><img src="<?php echo FILES_CDN?>img/football/forum/<?php echo $this->news['c']?>.png" style="vertical-align:middle"> <?php echo $this->news['t']?></h1>
<div class="news-detail">

<?php if(count($this->news['o']) && is_array($this->news['o'])):?>
<div style="margin:5px; padding:5px; text-align:center">
<?php foreach($this->news['o'] as $v):?>
<?php if($v):?>
<p style="padding:3px; line-height:0px;">
<img src="https://<?php echo $this->news['sv']?>.jarm.com/forum/<?php echo $this->news['fd']?>/<?php echo $v?>">
</p>
<?php endif?>
<?php endforeach?>
</div>
<?php endif?>
  
<?php echo preg_replace('/\<iframe(.*)width="([^"]+)"(.*)height="([^"]+)"(.*)iframe\>/i','<div class="flex-video widescreen"><iframe${1}width="620"${3}height="345"${5}iframe></div>',$this->news['d']);?>
</div>

</div>