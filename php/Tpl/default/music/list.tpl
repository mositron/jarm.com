<style>
.song td a{color:#555;}
table.song tr td.div{width:100px; font-size:12px}
table.song tr td.tm{width:100px; text-align:center; font-size:12px}
.song td.div div{display:block;overflow:hidden;white-space:nowrap; width:100px; text-overflow:ellipsis; font-weight:normal;}
.song td.i{width:20px;vertical-align:middle; text-align:center;}
table.song td.i  img{width:16px !important; height:16px !important;}
.bm{border:1px solid #f0f0f0; background:#fcfcfc; padding:0px 5px 5px; margin-bottom:5px; color:#ccc;}
.bm h4{ background:#f6f6f6; height:24px; line-height:24px; margin:0px -5px; padding:0px 10px; color:#222; text-shadow:1px 1px 0px #fff;}
@media only screen and (max-width: 767px) {
	table.song th:nth-child(3),
	table.song td:nth-child(3),
	table.song th:nth-child(5),
	table.song td:nth-child(5){display: none;}
}
</style>

<?php if($this->_banner['b']):?>
<!-- BEGIN - BANNER : B -->
<div class="_banner _banner-b"><?php echo $this->_banner['b']?></div>
<!-- END - BANNER : B -->
<?php endif?>
<?php if($this->_banner['c']):?>
<!-- BEGIN - BANNER : C -->
<div class="_banner _banner-c"><?php echo $this->_banner['c']?></div>
<!-- END - BANNER : C -->
<?php endif?>



<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="เพลง"><span class="glyphicon glyphicon-home"></span> เพลง</a></li>
<span class="divider">&raquo;</span>
<li><a href="/list" title="เพลงใหม่ เนื้อเพลงใหม่"><span class="glyphicon glyphicon-list"></span> เพลงใหม่</a></li>
<?php if($this->q):?>
<span class="divider">&raquo;</span>
<li><a href="/list/q-<?php echo urlencode($this->q)?>" title="ค้นหาเพลงหรือเนื้อเพลง ด้วยคำว่า <?php echo $this->q?>">ค้นหาเพลงหรือเนื้อเพลง ด้วยคำว่า <?php echo $this->q?></a></li>
<?php elseif($this->sn):?>
<span class="divider">&raquo;</span>
<li><a href="/list/sn-<?php echo $this->sn?>" title="เพลง เนื้อเพลง ชื่อเพลงขึ้นต้นด้วย <?php echo $this->sn?>">เพลง เนื้อเพลง ชื่อเพลงขึ้นต้นด้วย <?php echo $this->sn?></a></li>
<?php elseif($this->ar):?>
<span class="divider">&raquo;</span>
<li><a href="/list/ar-<?php echo $this->ar?>" title="เพลง เนื้อเพลง ศิลปินขึ้นต้นด้วย <?php echo $this->ar?>">เพลง เนื้อเพลง ศิลปินขึ้นต้นด้วย <?php echo $this->ar?></a></li>
<?php endif?>
</ul>

<?php require(__CONF.'ads/ads.adsense.body2.php');?>

<table class="table table-striped table-hover song" width="100%">
<thead>
<tr>
<th></th>
<th>เพลง <small>เนื้อเพลง</small></th>
<th>อัลบั้ม</th>
<th>ศิลปิน</th>
<th>เพิ่มเมื่อ</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->music);$i++):?>
<tr>
<td class="i"><img src="<?php echo FILES_CDN?>img/music/play-<?php echo $this->music[$i]['yt']?'':'n'?>yt.gif" alt=""></td>
<td><a href="/lyric/<?php echo $this->music[$i]['_id']?>" target="_blank" title="เพลง เนื้อเพลง <?php echo $this->music[$i]['sn']?> <?php echo $this->music[$i]['ar']?>"><strong><?php echo $this->music[$i]['sn']?></strong></a></td>
<td class="div"><div><?php echo $this->music[$i]['al']?></div></td>
<td class="div"><div><?php echo $this->music[$i]['ar']?></div></td>
<td class="tm"><?php echo self::Time()->from($this->music[$i]['da'],'date')?></td>
</tr>
<?php if($i==20):?>
<tr><td colspan="5"><?php require(__CONF.'ads/ads.adsense.body2-2.php');?></td></tr>
<?php endif?>
<?php endfor?>
</tbody>
</table>

<div style="text-align:center"><?php echo $this->pager?></div>
