<h3 class="fbimage-bar">รายการเมนู</h3>

<ul class="item-list">
    <?php for($i=0;$i<count($this->cooked);$i++):$v=$this->cooked[$i];?>
    <li>
   <?php echo $v['n']?>
   <p><?php echo implode(', ',$v['m'])?></p>
    </li>
    <?php endfor?>
</ul>

<div class="page-nav">
<?php if($this->page>1):?>
<a href="/cooked/item<?php echo $this->page>2?'/page-'.($this->page-1):''?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="/cooked/item/page-<?php echo $this->page+1?>">ถัดไป</a>
<?php endif?>
</div>