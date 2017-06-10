
<style>
.tab__id{width:80px;}
.tab_view{width:80px;}
</style>

<div>
<ul class="nav nav-tabs">
<li class="active"><a href="/manage/" class="h"> เกมส์ของฉัน</a></li>
<li><a href="/manage/new"><span class="glyphicon glyphicon-plus"></span> สร้างเกมใหม่</a></li>
<li><a href="https://tech.jarm.com/tips/6011" target="_blank"><span class="glyphicon glyphicon-question-sign"></span> วิธีสร้างเกมทายใจ</a></li>
</ul>

<div style="padding:5px; margin-bottom:5px;">
<div id="getapp"><?php echo $this->getapp?></div>
</div>
</div>

<script>
function adel(i){_.box.confirm({title:'ลบเกม',detail:'คุณต้องการลบเกมนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delapp',i);}});}
</script>


