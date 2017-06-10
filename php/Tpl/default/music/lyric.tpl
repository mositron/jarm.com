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


<style>
.song td a{color:#555;}
table.song tr td.div{width:100px; font-size:12px}
table.song tr td.tm{width:100px; text-align:center; font-size:12px}
.song td div{display:block;overflow:hidden;white-space:nowrap; width:100px; text-overflow:ellipsis; font-weight:normal;}
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

.cv{float:left; width:95px; line-height:0px;}
.cv img{width:80px; border:1px solid #ccc; padding:3px;}
.dt{float:left; line-height:22px;}
.socialshare{float:right}
.down{cursor:pointer; text-decoration:underline; color:#06C;}
.relate{list-style:inside circle;}
.relate li{float:left; height:24px; line-height:24px; border-bottom:1px dashed #f0f0f0; margin:0px 0px 0px 5px;list-style:inside circle;overflow:hidden;white-space:nowrap; text-overflow:ellipsis;}
.bx{border:1px solid #f0f0f0; padding:5px; margin-bottom:5px}
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
.amvid{padding:5px; text-align:center; margin:5px; background:#f0f0f0;}
</style>
<ul class="breadcrumb">
<li><a href="/" title="เพลง เนื้อเพลง"><span class="glyphicon glyphicon-home"></span> เพลง</a></li>
<span class="divider">&raquo;</span>
<li><a href="/list" title="เพลงใหม่ เนื้อเพลงใหม่"><span class="glyphicon glyphicon-list"></span> เพลงใหม่</a></li>
<span class="divider">&raquo;</span>
<li class="active"> เพลง เนื้อเพลง <?php echo $this->music['sn']?></li>
</ul>
<div style="line-height:1.8em; margin:5px 0px;">
<div>

<h2 style="padding:5px; margin:5px 0px"><a href="/lyric/<?php echo $this->music['_id']?>">เพลง เนื้อเพลง<?php echo $this->music['sn']?> - <?php echo $this->music['ar']?></a></span></h2>
<?php require(__CONF.'ads/ads.adsense.body2.php');?>
<div class="bx">
<div class="cv"><img src="<?php echo $this->data['image']?>" alt="<?php echo $this->music['sn']?> - <?php echo $this->music['al']?> - <?php echo $this->music['ar']?>"></div>
<div class="dt">
เพลง เนื้อเพลง: <?php echo $this->music['sn']?><br>
อัลบั้ม: <?php echo $this->music['al']?><br>
ศิลปิน: <?php echo $this->music['ar']?><br>
ค่ายเพลง: <?php echo $this->type[$this->music['ty']]?><br>
</div>
<div class="socialshare">
<div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
<p></p>
</div>

<div class="clear"></div>
<div class="ls">
เพลง ฟังเพลงออนไลน์ ฟังเพลง <?php echo $this->music['sn']?> - <?php echo $this->music['ar']?>
<?php if($this->music['yt']):?>
<div class="flex-video widescreen"><iframe width="696" height="391" src="http://www.youtube.com/embed/<?php echo $this->music['yt']?>" frameborder="0" allowfullscreen></iframe></div>
<?php if(self::$my['am']):?>
<div class="amvid"><a href="javascript:" onClick="_.ajax.gourl(\'<?php echo URL?>\',\'setvdo\',\'\');">ยกเลิกวิดีโอนี้เป็นเพลงหลัก</a></div>
<?php endif?>
<?php elseif($this->music['ty']=='rs'):?>
<div class="rs">
<div><object width="300" height="300"><param name="movie" value="http://embed.rsonlinemusic.com/flash/player_song_emb.swf" /><param name="quality" value="high" /><param name="flashVars" value="type=SongID&id=<?php echo $this->music['sid']?>&autoPlay=false&from=emb" /><param name="wmode" value="transparent" /><embed src="http://embed.rsonlinemusic.com/flash/player_song_emb.swf" width="300" height="300" quality="high" flashvars="type=SongID&id=<?php echo $this->music['sid']?>&autoPlay=false&from=emb" wmode="transparent"></embed></object></div>
</div>
<?php elseif($this->music['ty']=='gm'):?>
<div class="gm">
<div><object width="340" height="201"><param name="movie" value="http://www.gmember.com/flash/jedakrAkraM.swf?param1=<?php echo $this->music['sid']?>&songid=<?php echo $this->music['sid']?>" /><param name="allowScriptAccess" value="never" /><param name="wmode" value="transparent" /><embed allowscriptaccess="never" src="http://www.gmember.com/flash/jedakrAkraM.swf?songid=<?php echo $this->music['sid']?>&param1=<?php echo $this->music['sid']?>" type="application/x-shockwave-flash" width="340" height="201" wmode="transparent"></embed></object></div>
</div>
<?php elseif($this->music['ty']=='yp'):?>
<div class="yp">
<div><embed src="http://embed.you2play.com/you2play/flash/song_player3.swf" width="400" height="170" flashvars="_SID=<?php echo $this->music['sid']?>" type="application/x-shockwave-flash" allowscriptaccess="always" movie="http://embed.you2play.com/you2play/flash/song_player3.swf"></embed></div>
</div>
<?php endif?>
</div>
</div>

<?php #require(__CONF.'ads/ads.adsense.body-responsive.php');?>

<div class="bx">
<h3 class="cp">เพลง เนื้อเพลง <?php echo $this->music['sn']?></h3>
<div class="ndetail"><?php echo $this->music['ly']?></div>
</div>
<?php if($this->relate):?>
<div class="bx">
<h4 class="cp">เพลง เนื้อเพลงอื่นๆในอัลบั้มนี้</h4>
<ul class="relate row-count-2">
<?php for($i=0;$i<count($this->relate);$i++):?>
<li class="col-sm-6">
<a href="/lyric/<?php echo $this->relate[$i]['_id']?>">เนื้อเพลง <?php echo $this->relate[$i]['sn']?></a>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>
<?php endif?>

<?php if($this->music['vd'] && count($this->music['vd'])):?>
<div class="bx">
<h3 class="cp">คลิปวิดีโอ - ฟังเพลง ดู MV <?php echo $this->music['sn']?> - <?php echo $this->music['ar']?></h3>
<div id="svid"></div>
<ul class="vid row row-count-4">
<?php $j=0;for($i=0;$i<count($this->music['vd']);$i++): if($this->music['yt']==$this->music['vd'][$i]['id'])continue;?>
<li class="col-sm-3">
<a href="javascript:;" onClick="playvid('<?php echo $this->music['vd'][$i]['id']?>');"><img src="http://i2.ytimg.com/vi/<?php echo $this->music['vd'][$i]['id']?>/default.jpg" alt="<?php echo $this->music['vd'][$i]['t']?>"></a>
<p><?php echo $this->music['vd'][$i]['t']?></p>
</li>
<?php if($j==7)break;?>
<?php $j++;endfor?>
<p class="clear"></p>
</ul>
</div>
<?php endif?>


<?php if($this->music['fs'] && count($this->music['fs'])):?>
<div class="bx">
<h3 class="cp">ค้นหาเพลง <?php echo $this->music['sn']?> จากเพลงจาก 4share.com</h3>
<table class="table">
<thead>
<tr>
<th style="text-align:center">ชื่อไฟล์</th>
<th style="text-align:center; width:100px">ขนาดไฟล์</th>
<th style="text-align:center; width:150px">อัพโหลดเมื่อ</th>
</tr>
</thead>
<tbody>
<?php $j=0;for($i=0;$i<count($this->music['fs']);$i++):?>
<tr>
<td><a href="<?php echo $this->music['fs'][$i]['l']?>" target="_blank" rel="nofollow"><?php echo $this->music['fs'][$i]['n']?></a></td>
<td style="text-align:center; width:100px"><?php echo $this->music['fs'][$i]['s']?></td>
<td style="text-align:center; width:150px"><?php echo self::Time()->from($this->music['fs'][$i]['da'],'datetime')?></td>
</tr>
<?php $j++;endfor?>
</tbody>
</table>
</div>
<?php endif?>
<div class="bx">
<h3 class="cp">ดาวน์โหลดเพลง  <?php echo $this->music['sn']?> - <?php echo $this->music['ar']?></h3>
ดาวน์โหลดเพลง <?php echo $this->music['sn']?> อัลบั้ม: <?php echo $this->music['al']?> ศิลปิน: <?php echo $this->music['ar']?> <span onClick="download()" class="down">ได้ที่นี่</span>
.mp3 <?php echo $this->music['sn2']?> Chord <?php echo $this->music['sn2']?> คอร์ด <?php echo $this->music['sn2']?> Lyric <?php echo $this->music['sn2']?> เนื้อเพลง <?php echo $this->music['sn2']?> 4shared.com
</div>


<h4 style="margin:10px 0px 0px 0px; padding:5px; text-align:center; background:#f9f9f9;">แสดงความคิดเห็นด้วย Facebook</h4>
<div class="fb-comments" data-href="https://music.jarm.com/lyric/<?php echo $this->music['_id']?>" data-num-posts="10" data-width="720"></div>




</div>
</div>

<script>
function download()
{
<?php if($this->music['ty']=='rs'):?>
window.open(unescape('%68%74%74%70%3A%2F%2F%77%77%77%2E%72%73%6F%6E%6C%69%6E%65%6D%75%73%69%63%2E%63%6F%6D%2F%73%6F%6E%67%2E%70%68%70%3F%73%6F%6E%67%5F%69%64%3D')+'<?php echo $this->music['sid']?>');
<?php elseif($this->music['ty']=='gm'):?>
window.open(unescape('%68%74%74%70%3A%2F%2F%6D%75%73%69%63%2E%67%6D%65%6D%62%65%72%2E%63%6F%6D%2F%64%6F%77%6E%6C%6F%61%64%2F%53%6F%6E%67%2D')+'<?php echo $this->music['sid']?>');
<?php elseif($this->music['ty']=='yp'):?>
_.box.alert('เพลงนี้ยังไม่เปิดให้ดาวน์โหลดในขณะนี้');
<?php endif?>
}
function playvid(v)
{
	var h='<div class="flex-video widescreen"><iframe width="710" height="400" src="http://www.youtube.com/embed/'+v+'?autoplay=1" frameborder="0" allowfullscreen></iframe></div>';
<?php if(self::$my['am']):?>h+='<div class="amvid"><a href="javascript:" onclick="_.ajax.gourl(\'<?php echo URL?>\',\'setvdo\',\''+v+'\');">ตั้งวิดีโอนี้เป็นเพลงหลักของเนื้อเพลงนี้</a></div>';<?php endif?>
	$('#svid').html(h);
}
</script>
