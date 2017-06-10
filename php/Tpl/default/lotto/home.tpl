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

<?php if($this->lotto_last['_id']!=$this->lotto[0]['_id']):?>
<h2 style="padding:5px; margin:5px 0px 5px 0px;color:#6D6E70; text-align:center">ตรวจหวย ตรวจสลากกินแบ่งรัฐบาลงวดที่ <?php echo self::Time()->from($this->lotto_last['tm'],'date')?></h2>
<div style="padding:10px; text-align:center; border:1px solid #f0f0f0; background:#f9f9f9; font-size:14px">กำลังรออัพเดทข้อมูลสำหรับ หวย สลากกินแบ่งรัฐบาลงวดที่ <?php echo self::Time()->from($this->lotto_last['tm'],'date')?></div>

<?php endif?>


<div class="hidden-xs" style="text-align:right; padding:2px 5px; margin-bottom:5px; background:#f5f5f5;">
  <form method="post" action="<?php echo self::uri(['lotto','/search'])?>" style="margin: 3px 0px 0px 0px;color: white;padding: 0px;">
    <span style="color:#333;">ตรวจสลาก</span>
    <input type="text" name="lotto" class="tbox" placeholder="กรอกเลขสลากของคุณ" style="width:150px; text-indent:5px;">
    <select name="lotto_date" class="tbox" style="width:170px;">
      <?php foreach((array)$this->lotto_all as $v):?>
      <option value="<?php echo $v['_id']?>"><?php echo self::Time()->from($v['tm'],'date')?> </option>
      <?php endforeach?>
    </select>
    <input type="submit" class="btn btn-default btn-xs" style="margin:0px; vertical-align:text-bottom;" value=" ค้นหา ">
  </form>
</div>


<h2 style="padding:5px; margin:5px 0px 5px 0px;color:#6D6E70; text-align:center">ตรวจหวย ตรวจสลากกินแบ่งรัฐบาลงวดที่ <?php echo self::Time()->from($this->lotto[0]['tm'],'date')?></h2>

<table class="table lotto" style="-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none;">
<tbody>
<tr>
<td>
<strong>ตรวจหวย รางวัลที่ 1</strong>
<div class="n1"><span><?php echo $this->lotto[0]['a1']?$this->lotto[0]['a1']:'รอประกาศผล'?></span></div>
</td>
<td>
<strong>เลขหน้า 3 ตัว</strong>
<div class="n1"><span><?php echo $this->lotto[0]['f3']?implode('</span><span>',$this->lotto[0]['f3']):'รอประกาศผล'?></span></div>
</td>
<td>
<strong>เลขท้าย 3 ตัว</strong>
<div class="n1"><span><?php echo $this->lotto[0]['l3']?implode('</span><span>',$this->lotto[0]['l3']):'รอประกาศผล'?></span></div>
</td>
<td>
<strong>เลขท้าย 2 ตัว</strong>
<div class="n1"><span><?php echo $this->lotto[0]['l2']?$this->lotto[0]['l2']:'รอประกาศผล'?></span></div>
</td>
</tr>
<tr>
<td><p>รางวัลละ 2,000,000 บาท</p></td>
<td><p>รางวัลละ 2,000 บาท</p></td>
<td><p>รางวัลละ 2,000 บาท</p></td>
<td><p>รางวัลละ 1,000 บาท</p></td>
</tr>
<tr>
<td>
<strong>ข้างเคียงรางวัลที่ 1</strong>
<div class="n2"><span><?php if($this->lotto[0]['a1']):?><?php echo substr('000000'.(intval($this->lotto[0]['a1'])-1),-6)?></span><span><?php echo substr('000000'.(intval($this->lotto[0]['a1'])+1),-6)?><?php else:?>รอประกาศผล<?php endif?></span></div>
</td>
<td colspan="3">
<strong>ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล รางวัลที่ 2</strong>
<div class="n2"><span><?php echo $this->lotto[0]['a2']?implode('</span><span>',$this->lotto[0]['a2']):'รอประกาศผล'?></span></div>
</td>
</tr>
<tr>
<td><p>รางวัลละ 50,000 บาท</p></td>
<td colspan="3"><p>รางวัลละ 100,000 บาท</p></td>
</tr>
<tr><td colspan="4">
<div style="text-align:center;padding:5px 0px"><a href="https://play.google.com/store/apps/details?id=com.doodroid.lotto" title="ตรวจหวย ผ่านแอพ Android ฟรี" target="_blank"><img src="https://cdn.jarm.com/img/banner/lotto-banner.gif" class="img-responsive" style="margin:10px auto;"></a></div>
</td></tr>
<tr>
<td colspan="4">
<strong>ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล รางวัลที่ 3</strong>
<p>รางวัลละ 40,000 บาท</p>
<div class="n3"><span><?php echo $this->lotto[0]['a3']?implode('</span><span>',$this->lotto[0]['a3']):'รอประกาศผล'?></span></div>
</td>
</tr>
<tr>
<td colspan="4">
<strong>ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล รางวัลที่ 4</strong>
<p>รางวัลละ 20,000 บาท</p>
<div class="n3">
<?php for($i=0;$i<count($this->lotto[0]['a4']);$i++):?><span><?php echo $this->lotto[0]['a4'][$i]?></span><?php echo ($i%10==9)?'<!--br-->':''?><?php endfor?>
</div>
</td>
</tr>
<tr>
<td colspan="4">
<strong>ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล รางวัลที่ 5</strong>
<p>รางวัลละ 10,000 บาท</p>
<div class="n3">
<?php for($i=0;$i<count($this->lotto[0]['a5']);$i++):?><span><?php echo $this->lotto[0]['a5'][$i]?></span><?php echo ($i%10==9)?'<!--br-->':''?><?php endfor?>
</div>
</td>
</tr>
</tbody>
</table>

<h3 class="bar-heading"><a href="/news" title="ข่าวหวย เลขเด็ดหวย">เลขเด็ด หวย สลากกินแบ่งรัฐบาล</a></h3>

<div class="row news-bottom">
<?php for($i=0;$i<count($this->news);$i++): $v=$this->news[$i];?>
<div class="col-sm-3">
<a href="<?php echo $v['link']?>" target="_blank">
<img src="<?php echo $v['img_s']?>" alt="<?php echo $v['title']?>" class="img-responsive">
<p><?php echo $v['title']?><?php echo $v['icon']?></p>
</a>
</div>
<?php endfor?>
</div>


<h3 class="bar-heading">ความคิดเห็น</h3>
<div class="fb-comments" data-href="<?php echo self::uri(['lotto','/'])?>" data-num-posts="10" data-width="710"></div>
<script>$('.lotto').attr('unselectable', 'on').css('user-select', 'none').on('selectstart', false);</script>
