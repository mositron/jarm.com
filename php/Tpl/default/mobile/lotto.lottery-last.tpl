<h3 class="lotto-bar">สลากกินแบ่งรัฐบาล งวดล่าสุด</h3>
<div class="lotto-list">
<div>
<h1>งวดวันที่ <?php echo self::Time()->from($this->lotto['tm'],'date')?></h1>
<div>
<div class="l1"><strong>รางวัลที่ 1</strong><span><?php echo $this->lotto['a1']?$this->lotto['a1']:'-รอประกาศผล-'?></span></div>
<div class="l2"><strong>เลขท้าย 3 ตัว</strong><span><?php echo $this->lotto['l3']?implode('</span><span>',$this->lotto['l3']):'รอประกาศผล'?></span></div>
<div class="l3"><strong>เลขท้าย 2 ตัว</strong><span><?php echo $this->lotto['l2']?$this->lotto['l2']:'รอประกาศผล'?></span></div>
<p></p>
</div>
<div>
<div class="l1"><strong>ข้างเคียง</strong><span><?php if($this->lotto['a1']):?><?php echo $this->lotto['a1']-1?></span><span><?php echo $this->lotto['a1']+1?><?php else:?>รอประกาศผล<?php endif?></span></div>
<div class="l4"><strong>รางวัลที่ 2</strong><span><?php echo $this->lotto['a2']?implode('</span><span>',$this->lotto['a2']):'รอประกาศผล'?></span></div>
<p></p>
</div>
<div>
<div class="l5"><strong>รางวัลที่ 3</strong><span><?php echo $this->lotto['a3']?implode('</span><span>',$this->lotto['a3']):'รอประกาศผล'?></span></div>
</div>
<div>
<div class="l5"><strong>รางวัลที่ 4</strong><span><?php for($j=0;$j<count($this->lotto['a4']);$j++):?><span><?php echo $this->lotto['a4'][$j]?></span><?php #echo ($j%10==9)?'<br>':''?><?php endfor?></span></div>
</div>
<div>
<div class="l5"><strong>รางวัลที่ 5</strong><span><?php for($j=0;$j<count($this->lotto['a5']);$j++):?><span><?php echo $this->lotto['a5'][$j]?></span><?php #echo ($j%10==9)?'<br>':''?><?php endfor?></span></div>
</div>
</div>
</div>