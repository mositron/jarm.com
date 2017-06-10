<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="ตรวจหวย"><span class="glyphicon glyphicon-home"></span> ตรวจหวย</a></li>
<span class="divider">&raquo;</span>
<li><a href="/list" title="ตรวจหวยย้อนหลัง"><span class="glyphicon glyphicon-list"></span> ตรวจหวยย้อนหลัง</a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo $this->lotto['_id']?>-<?php echo $this->lotto['l']?>.html" title="ตรวจหวยย้อนหลัง <?php echo self::Time()->from($this->lotto['tm'],'date')?>"><span class="glyphicon glyphicon-star"></span> ตรวจหวย <?php echo self::Time()->from($this->lotto['tm'],'date')?></a></li>
</ul>

<h2 style="padding:5px; margin:0px 0px 5px 0px; border:1px solid #f0f0f0; border-radius:5px; color:#00ADEF; text-align:center">ตรวจหวย สลากกินแบ่งรัฐบาลงวดที่ <?php echo self::Time()->from($this->lotto['tm'],'date')?></h2>

<table class="table lotto">
<tbody>
<tr>
<td>
<strong>รางวัลที่ 1</strong>
<div class="n1"><span><?php echo $this->lotto['a1']?></span></div>
<p>รางวัลละ 2,000,000 บาท</p>
</td>
<td>
<strong>เลขท้าย 3 ตัว</strong>
<div class="n1"><span><?php echo implode('</span><span>',$this->lotto['l3'])?></span></div>
<p>รางวัลละ 2,000 บาท</p>
</td>
<td>
<strong>เลขท้าย 2 ตัว</strong>
<div class="n1"><span><?php echo $this->lotto['l2']?></span></div>
<p>รางวัลละ 1,000 บาท</p>
</td>
</tr>
<tr>
<td>
<strong>ข้างเคียงรางวัลที่ 1</strong>
<div class="n2"><span><?php echo $this->lotto['a1']-1?></span><span><?php echo $this->lotto['a1']+1?></span></div>
<p>รางวัลละ 50,000 บาท</p>
</td>
<td colspan="2">
<strong>รางวัลที่ 2</strong>
<div class="n2"><span><?php echo implode('</span><span>',$this->lotto['a2'])?></span></div>
<p>รางวัลละ 100,000 บาท</p>
</td>
</tr>
<tr>
<td colspan="3">
<strong>รางวัลที่ 3</strong>
<div class="n3"><span><?php echo implode('</span><span>',$this->lotto['a3'])?></span></div>
<p>รางวัลละ 40,000 บาท</p>
</td>
</tr>
<tr>
<td colspan="3">
<strong>รางวัลที่ 4</strong>
<div class="n3">
<?php for($i=0;$i<count($this->lotto['a4']);$i++):?><span><?php echo $this->lotto['a4'][$i]?></span><?php echo ($i%10==9)?'<br>':''?><?php endfor?>
</div>
<p>รางวัลละ 20,000 บาท</p>
</td>
</tr>
<tr>
<td colspan="3">
<strong>รางวัลที่ 5</strong>
<div class="n3">
<?php for($i=0;$i<count($this->lotto['a5']);$i++):?><span><?php echo $this->lotto['a5'][$i]?></span><?php echo ($i%10==9)?'<br>':''?><?php endfor?>
</div>
<p>รางวัลละ 10,000 บาท</p>
</td>
</tr>
</tbody>

</table>


<h3 style="border:1px solid #f0f0f0; border-radius:5px; color:#00ADEF; padding:5px;">ตรวจหวย สลากกินแบ่งรัฐบาลย้อนหลัง</h3>

<div class="lotto-list">
<?php for($i=1;$i<count($this->last);$i++):?>
<h4> + <a href="<?php echo '/'.$this->last[$i]['_id'].'-'.$this->last[$i]['l'].'.html'?>">ตรวจหวย งวดวันที่ <?php echo self::Time()->from($this->last[$i]['tm'],'date')?></a></h4>
<table class="table lotto">
<tbody>
<tr>
<td>
<strong>รางวัลที่ 1</strong>
<div class="n1"><span><?php echo $this->last[$i]['a1']?></span></div>
<p>รางวัลละ 2,000,000 บาท</p>
</td>
<td>
<strong>เลขท้าย 3 ตัว</strong>
<div class="n1"><span><?php echo implode('</span><span>',$this->last[$i]['l3'])?></span></div>
<p>รางวัลละ 2,000 บาท</p>
</td>
<td>
<strong>เลขท้าย 2 ตัว</strong>
<div class="n1"><span><?php echo $this->last[$i]['l2']?></span></div>
<p>รางวัลละ 1,000 บาท</p>
</td>
</tr>
</table>
<?php endfor?>

</div>
<div class="socialshare">
<div><g:plusone size="medium" count="true" href="<?php echo URI?>"></g:plusone></div>
<div><fb:like href="<?php echo URI?>" send="false" layout="button_count" width="100" show_faces="false" font="tahoma"></fb:like></div>
<!--div><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo URI?>" data-count="horizontal" target="_blank">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div-->
<p></p>
</div>



<h4 style="margin:10px 0px 0px 0px">ความคิดเห็น</h4>
<div class="fb-comments" data-href="https://lotto.jarm.com/<?php echo $this->lotto['_id']?>" data-num-posts="30" data-width="710"></div>
