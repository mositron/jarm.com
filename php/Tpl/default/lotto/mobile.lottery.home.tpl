<h3 class="lotto-bar">สลากกินแบ่งรัฐบาล</h3>
<div class="lotto-list">
<?php for($i=0;$i<count($this->lotto);$i++):?>
<div>
<h1> <!--a href="/mobile/lottery/<?php echo $this->lotto[$i]['_id']?>"-->งวดวันที่ <?php echo self::Time()->from($this->lotto[$i]['tm'],'date')?><!--/a--></h1>
<div>
<div class="l1"><strong>รางวัลที่ 1</strong><span><?php echo $this->lotto[$i]['a1']?></span></div>
<div class="l2"><strong>เลขท้าย 3 ตัว</strong><span><?php echo implode('</span><span>',$this->lotto[$i]['l3'])?></span></div>
<div class="l3"><strong>เลขท้าย 2 ตัว</strong><span><?php echo $this->lotto[$i]['l2']?></span></div>
<p></p>
</div>
</div>
<?php endfor?>
</div>