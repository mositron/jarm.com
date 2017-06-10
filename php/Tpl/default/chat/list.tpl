<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:0px 0px 5px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->

<style>
<style>
.tab_id{width:50px; text-align:center;}
.tab_published{width:100px;}
.tab_time{width:150px;}
.tab_s{font-weight:bold; color:#F60}
.tab_s strong{ color:#690}
.tab_s strong.ex{ color:#000}
.tab_t{ text-align:left}
.tab_s .cl{padding:5px; text-align:center; margin:5px 0px 0px 0px; border:1px solid #f0f0f0; background-color:#f8f8f8; color:#000; text-shadow:1px 1px 0px #fff; font-weight:normal}
.tbservice th{ text-align:center;}
.tbservice td{border-left:1px solid #fff;border-top:1px solid #fff; text-align:center;}
.tab_name{text-align:left}
.tbservice .l1 td{background-color:#fafafa;}
</style>

<div>

<div style="margin:5px 0px 0px 0px; border:1px solid #f00; background:#fff4f8; color:#d00; text-align:center; padding:5px;">ระบบจะทำการลบห้องที่ไม่มีการใช้งานนานเกิน 7 วัน โดยอัตโนมัติ</div>
<div style="padding:5px; margin-bottom:5px;">
<div id="getchat"><?php echo $this->getchat?></div>
</div>
</div>


