
<style>
.tab__id{width:80px;}
.tab_view{width:80px;}
</style>

<div>
<ul class="nav nav-tabs">
<li class="active"><a href="/manage/" class="h"> สติกเกอร์ของฉัน</a></li>
<li><a href="/manage/new"><span class="glyphicon glyphicon-plus"></span> เพิ่มสติกเกอร์ใหม่</a></li>
</ul>

<div style="padding:5px; margin-bottom:5px;">
<div id="getapp"><?php echo $this->getapp?></div>
</div>
</div>

<script>
function adel(i){_.box.confirm({title:'ลบสติกเกอร์',detail:'คุณต้องการลบสติกเกอร์นี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delapp',i);}});}
</script>


