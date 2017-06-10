
<style>

#tbresult>div{text-align:center;}
#tbresult>div p{margin:0px;}
#tbresult>div:nth-child(6n+1){margin-left:0px; clear:both;}
</style>

<div>

<div style="padding:5px; margin-bottom:5px;">
<div id="getimage"><?php echo $this->getimage?></div>
</div>
</div>

<script>
function adel(i,j){_.box.confirm({title:'จัดการรูปภาพ',detail:'คุณต้องการ'+(j?'แสดง':'ซ่อน')+'นี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','visible',i,j);}});}
</script>


