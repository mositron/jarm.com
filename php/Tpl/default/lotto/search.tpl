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

<h3>ตรวจหวย ตรวจสลากกินแบ่งรัฐบาลจากตัวเลข</h3>
<div align="center">
<form method="post" action="/search">
<input type="text" name="lotto" class="tbox" value="<?php echo $this->lq?implode(', ',$this->lq):''?>">  
<select name="lotto_date" class="tbox">
<?php foreach($this->lotto as $v):?>
<option value="<?php echo $v['_id']?>"<?php echo $_POST['lotto_date']==$v['_id']?' selected':''?>><?php echo self::Time()->from($v['tm'],'date')?> </option>
<?php endforeach?>
</select>
<input type="submit" class="button blue" value=" ตรวจผลสลาก ">
</form>
</div>
<?php if($this->lq&&$this->li):?>
<?php foreach($this->lq as $v):?>
<div>ผลสลากของหมายเลข <?php echo $v?></div>
<?php if($v==$this->li['a1']):?>
- คุณถูก <strong>รางวัลที่ 1</strong>: <?php echo $this->li['a1']?>
<?php elseif($v==$this->li['a1']-1):?>
- คุณถูก <strong>รางวัลข้างเคียงรางวัลที่ 1</strong>: <?php echo $this->li['a1']-1?>
<?php elseif($v==$this->li['a1']+1):?>
- คุณถูก <strong>รางวัลข้างเคียงรางวัลที่ 1</strong>: <?php echo $this->li['a1']+1?>
<?php elseif(in_array($v,(array)$this->li['a2'])):?>
- คุณถูก <strong>รางวัลที่ 2</strong>: <?php echo $v?>
<?php elseif(in_array($v,(array)$this->li['a3'])):?>
- คุณถูก <strong>รางวัลที่ 3</strong>: <?php echo $v?>
<?php elseif(in_array($v,(array)$this->li['a4'])):?>
- คุณถูก <strong>รางวัลที่ 4</strong>: <?php echo $v?>
<?php elseif(in_array($v,(array)$this->li['a5'])):?>
- คุณถูก <strong>รางวัลที่ 5</strong>: <?php echo $v?>
<?php elseif(in_array(substr($v,-3),$this->li['l3'])):?>
- คุณถูก <strong>เลขท้าย 3 ตัว</strong>: <?php echo substr($v,-3)?>
<?php elseif(substr($v,-2)==$this->li['l2']):?>
- คุณถูก <strong>เลขท้าย 2 ตัว</strong>: <?php echo substr($v,-2)?>
<?php else:?>
- ไม่ถูกรางวัลใดๆ
<?php endif?>
<?php endforeach?>
<?php endif?>
<h3 style="border:1px solid #f0f0f0; border-radius:5px; color:#00ADEF; padding:5px;">ตรวจหวย สลากกินแบ่งรัฐบาลย้อนหลัง</h3>
<div>
<ul class="relotto">
<?php for($i=0;$i<count($this->lotto);$i++):?>
<li><a href="/view/<?php echo $this->lotto[$i]['_id']?>">งวดวันที่ <?php echo self::Time()->from($this->lotto[$i]['tm'],'date')?></a></li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>

