<style>
.no-box .horo-sel{width:60px; text-align:center;}
.no-box .horo-no{width:30px; text-align:center;}
</style>
<script>
function horoshow()
{
	var sum=0;
	$('.horo-no').each(function() {
        sum += Math.floor($(this).val());
    });
	var prefix = $('.horo-sel').val();
	for(var i=0;i<prefix.length;i++)
	{
		sum += Math.floor(prefix.substr(i,1));
	}
	sum += '  (<a href="/phone/'+sum+'.html">ดูรายละเอียดคำทำนาย</a>)';
	$('.horo-rs').html(sum);
}
</script>

<div class="no-box">
<p>ตัวเลขเบอร์มือถือของคุณมีความหมาย อยากรู้เพียงแค่กรอกเบอร์มือถือ</p>
<h3>ดูดวงของคุณจากเบอร์มือถือ</h3>
<div class="l1">ค้นหาเบอร์ <select class="tbox horo-sel" name="n0"><?php for($i=80;$i<=96;$i++):?><option value="0<?php echo $i?>">0<?php echo $i?></option><?php endfor?></select> -
<?php for($i=1;$i<=7;$i++):?><?php if($i==4):?> - <?php endif?><input type="text" class="tbox horo-no" name="n<?php echo $i?>" maxlength="1"> <?php endfor?> <input type="button" class="button" value="ดูผลทำนาย" onClick="horoshow()"></div>
<div class="l2">ผลรวมเบอร์โทรศัพท์ของคุณ <span class="horo-rs">0</span></div>
</div>

<?php require(__CONF.'ads/ads.adsense.body2.php');?>

<div style="padding:0px; background:#fff;">
<div style="padding:5px">
<div class="mview">
<div class="l"><h3>ผลคำทำนายของหมายเลข <span><?php echo $this->phone['_id']?></span></h3></div>
<div class="v"><?php echo $this->phone['d']?></div>
</div>

<div class="socialshare">
<div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
<p class="clear"></p>
</div>

<div style="padding:10px 0px 0px 0px">
<h4>ความคิดเห็น</h4>
<div class="fb-comments" data-href="<?php echo URI?>" data-num-posts="10" data-width="710"></div>
</div>

<?php /*
<?php if(count($this->phone['mb'])):?>
<div>
<h4 style="color:#F89C1B; padding:3px 10px; margin:5px 0px; border-bottom:3px solid #F89C1B; font-size:18px"><a href="http://www.luckysim.com/" target="_blank" style="color:#F89C1B;">เบอร์สวย เลขมงคล</a> ที่มีผลลัพธ์เท่ากับ <?php echo $this->phone['_id']?>
<small class="pull-right" style="margin-top:7px;">สนใจเบอร์สวย ติดต่อ 084-322-5222</small>
</h4>
<ul class="lks row-count-2">
<?php $i=0;foreach($this->phone['mb'] as $v):?>
<li class="l<?php echo intval($i/2)%2?> col-sm-6" onClick="goluckysim('0<?php echo $v['t'].$v['no']?>')"><i class="pv pv<?php echo $v['pv']?>"></i>
<strong><?php echo getno($v['cl'],$v['t'])?></strong>
<p><?php echo number_format(intval($v['pr']))?> <i></i></p>
</li>
<?php $i++;endforeach?>
<p class="clear"></p>
</ul>

</div>
<?php endif?>
*/ ?>

<div class="no-hot">
<h3>ผลรวมตัวเลขเด่น</h3>
<div style="margin:0px 10px">
<ul class="du thumbnails row-count-2">
<?php $i=0;foreach($this->mhit as $v):?>
<li class="n<?php echo (intval($i/2)%2)?> col-sm-6">
<i><a href="/phone/<?php echo $v['_id']?>.html"><?php echo $v['_id']?></a></i>
<p><a href="/phone/<?php echo $v['_id']?>.html"><?php echo mb_substr($v['d'],0,170,'utf-8')?>...</a></p>
<span></span>
</li>
<?php $i++;endforeach?>
</ul>
</div>
</div>

</div>
</div>
