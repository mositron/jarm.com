<style>
.form-control{border-color:#eee;border-radius:0px;height:40px; font-size:18px;}
.story .-padding{padding:0px 10px;border:1px solid #eee;background:#fff;margin:10px 0px;border-radius:4px;}
</style>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<div class="story">
  <div class="-padding">
<h2 class="bar-heading"><?php echo $this->blog['t']?><small class="pull-right" style="margin-top:10px;"><a href="/post/<?php echo $this->blog['l']?>">เขียนเรื่องใหม่</a></small></h2>
<table class="table" width="100%">
  <thead>
    <tr><th>หัวข้อ</th><th width="120" class="text-right">สถานะ</th><th width="80"></th></tr>
  </thead>
  <tbody>
  <?php if(count($this->post)>0):?>
  <?php foreach($this->post as $v):?>
    <tr>
      <td>
        <?php if($v['pl']):?>
          <a href="/<?php echo $v['bl']?>/<?php echo $v['_id']?>/<?php echo $v['l']?>"><?php echo $v['t']?></a>
        <?php else:?>
        <?php echo $v['t']?>
        <?php endif?>
        <br><small><?php echo $this->cate[$v['c']]['t']?></small></td>
      <td class="text-right"><?php echo $v['pl']?($v['pl']==2?'เผยแพร่เฉพาะ':'เผยแพร่ทั่วไป'):'แบบร่าง'?></td>
      <td class="text-right">
        <a href="/post/<?php echo $v['bl']?>/<?php echo $v['_id']?>" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="แก้ไขบล็อก"><span class="glyphicon glyphicon-pencil"></span></a>
        <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="ลบบล็อก"><span class="glyphicon glyphicon-trash"></span></button>
      </td>
    </tr>
  <?php endforeach?>
  <?php else:?>
    <tr><td colspan="3"><div style="padding:50px;text-align:center">ยังไม่มีโพสต์</div></td></tr>
  <?php endif?>
  </tbody>
</table>
</div>
</div>
