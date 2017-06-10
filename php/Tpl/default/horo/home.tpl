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

<?php require(__CONF.'ads/ads.dfp-12.php');?>

<?php for($j=1;$j<=6;$j++):?>
<h3 class="bar-heading"><a href="/<?php echo self::$conf['news']['cate'][$j]['l']?>" title="<?php echo self::$conf['news']['cate'][$j]['tt']?>"><?php echo self::$conf['news']['cate'][$j]['t']?></a></h3>
<div class="row news-bottom">
  <?php for($i=0;$i<count($this->news[$j]);$i++): $v=$this->news[$j][$i];?>
    <div class="col-sm-3">
        <a href="<?php echo $v['link']?>" target="_blank">
            <img src="<?php echo $v['img_s']?>" alt="<?php echo $v['title']?>" class="img-responsive">
            <p><?php echo $v['title']?><?php echo $v['icon']?></p>
        </a>
    </div>
  <?php endfor?>
</div>
<?php endfor?>


<?php require(__CONF.'ads/ads.dfp-34.php');?>

<div class="no-hot">
    <h3 class="bar-heading">ผลรวมตัวเลขเด่น</h3>
    <div class="row">
    <?php $i=0;foreach($this->mhit as $v):?>
    <div class="n<?php echo (intval($i/2)%2)?> col-sm-6">
        <i><a href="/phone/<?php echo $v['_id']?>.html"><?php echo $v['_id']?></a></i>
        <p><a href="/phone/<?php echo $v['_id']?>.html"><?php echo mb_substr($v['d'],0,170,'utf-8')?>...</a></p>
        <span></span>
    </div>
    <?php $i++;endforeach?>
    </div>
</div>
