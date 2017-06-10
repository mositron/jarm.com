<style>

.cv{float:left; width:75px; line-height:0px;}
.cv img{width:60px; border:1px solid #ccc; padding:3px;}
.dt{float:left; line-height:22px;}
.relate{list-style:inside circle;}
.relate li{float:left; height:24px; line-height:24px; border-bottom:1px dashed #f0f0f0; margin:0px 0px 0px 5px;list-style:inside circle;overflow:hidden;white-space:nowrap; text-overflow:ellipsis;}
.cp{height:30px; line-height:30px; border-bottom:1px dashed #f0f0f0; margin:0px 5px 5px; padding:0px 5px; overflow:hidden;white-space:nowrap; text-overflow:ellipsis;}
.rs{width:300px; height:56px; overflow:hidden; position:relative;}
.rs > div{position:absolute; top:-120px;}
.gm{width:330px; height:70px; overflow:hidden; position:relative;}
.gm > div{position:absolute; top:-2px; left:-2px;}
.yp{width:400px; height:64px; overflow:hidden; position:relative;}
.yp > div{position:absolute; top:-106px; left:0px;}
.ls{ border:1px dashed #f0f0f0; padding:5px; margin:5px 0px 0px 0px}
.vid li{padding:5px 0px; margin-bottom:5px;border:1px solid #f9f9f9; text-align:center;}
.vid li a{display:block;}
.vid li p{margin:4px 5px 0px;line-height:16px; overflow:hidden; font-size:11px; background:#f9f9f9; padding:3px 0px; text-indent:5px;}
</style>


<div class="music-bar"><a href="/music">หน้าแรก</a> &raquo; <a href="/music/song">เพลงใหม่</a></div>


<h2 style="padding:5px; text-align:center; margin:5px 0px"><?php echo $this->music['sn']?></h2>
<div class="song-box">
<div class="cv"><img src="https://s3.jarm.com/music/<?php echo $this->music['fd']?>/<?php echo $this->music['s']?>"></div>
<div class="dt">
อัลบั้ม: <?php echo $this->music['al']?><br>
ศิลปิน: <?php echo $this->music['ar']?><br>
ค่ายเพลง: <?php echo $this->type[$this->music['ty']]?><br>
</div>

<div class="clear"></div>
<?php if($this->music['yt']):?>
<div class="ls">
ฟังเพลง <?php echo $this->music['sn']?> จาก Youtube
<div class="flex-video widescreen"><iframe width="696" height="391" src="http://www.youtube.com/embed/<?php echo $this->music['yt']?>" frameborder="0" allowfullscreen></iframe></div>
</div>
<?php endif?>
</div>

<div class="song-box">
<h3 class="cp">เนื้อเพลง <?php echo $this->music['sn']?></h3>
<div class="ndetail"><?php echo $this->music['ly']?></div>
</div>

<?php if($this->relate):?>
<div class="song-box song-relate">
<h4>เพลง เนื้อเพลงอื่นๆในอัลบั้มนี้</h4>
<ul>
<?php for($i=0;$i<count($this->relate);$i++):?>
<li><a href="/music/song/<?php echo $this->relate[$i]['_id']?>">เพลง <?php echo $this->relate[$i]['sn']?></a></li>
<?php endfor?>
</ul>
</div>
<?php endif?>


<?php if($this->music['vd'] && count($this->music['vd'])):?>
<div class="song-box song-mv">
<h4>คลิปวิดีโอ - ฟังเพลง ดู MV <?php echo $this->music['sn']?> - <?php echo $this->music['ar']?></h4>
<div id="svid"></div>
<ul>
<?php $j=0;for($i=0;$i<count($this->music['vd']);$i++): if($this->music['yt']==$this->music['vd'][$i]['id'])continue;?>
<li>
<a href="javascript:;" onClick="playvid('<?php echo $this->music['vd'][$i]['id']?>');"><img src="http://i2.ytimg.com/vi/<?php echo $this->music['vd'][$i]['id']?>/default.jpg" alt="<?php echo $this->music['vd'][$i]['t']?>"></a>
<p><?php echo $this->music['vd'][$i]['t']?></p>
</li>
<?php if($j==7)break;?>
<?php $j++;endfor?>
</ul>
</div>
<?php endif?>


<?php if($this->music['fs'] && count($this->music['fs'])):?>
<div class="song-box song-4shared">
<h4>ค้นหาเพลง <?php echo $this->music['sn']?> จาก 4share.com</h4>
<table>
<tbody>
<?php $j=0;for($i=0;$i<count($this->music['fs']);$i++):?>
<tr>
<td><a href="<?php echo $this->music['fs'][$i]['l']?>" target="_blank" rel="nofollow"><?php echo $this->music['fs'][$i]['n']?></a></td>
<td style="text-align:center; width:100px"><?php echo $this->music['fs'][$i]['s']?></td>
</tr>
<?php $j++;endfor?>
</tbody>
</table>
</div>
<?php endif?>


<script>
function playvid(v)
{
	var h='<div class="flex-video widescreen"><iframe width="710" height="400" src="http://www.youtube.com/embed/'+v+'?autoplay=1" frameborder="0" allowfullscreen></iframe></div>';
	document.getElementById('svid').innerHTML=h;
}
</script>