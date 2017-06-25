<style>
.story{margin:20px auto;max-width:700px;}
.story hr{cursor:default;margin:20px 0px;border:1px solid #ddd;}
.story ul{list-style:none inside;padding:0px 10px;}
.story .bar-heading{margin:10px 0px 10px;}
.story .pboard{background:#fff;padding:10px;border-radius:4px;border:1px solid #eee;}
.story .pboard div>div{font-size:12px;}
.story .pboard h1{margin:0px;}
.story .pboard h2{margin:0px;font-size:16px;color:#999;font-weight:normal;}
.story .pboard .pull-right{padding-left:20px;border-left:1px solid #eee;}
.story .pboard .pull-right img{width:40px;margin:0px 0px -1px 8px;float:right;border-radius:3px;}
.story .pboard .glyphicon{color:#999;font-size:7px;border:1px solid #ddd;padding:2px;border-radius:2px;vertical-align:middle;margin-top:-4px;}

.story .pcard{margin:10px;padding-bottom:10px;border-bottom:1px solid #f0f0f0;}
.story .pcard .-avatar{float:left;}
.story .pcard .-avatar img{width:40px;height:40px;border-radius:4px;}
.story .pcard .-poster{margin-left:50px;}
.story .pcard .-time{margin-left:50px;font-size:12px;color:#ccc;}

.story .post{border:1px solid #eee;background:#fff;margin:10px 0px 10px;border-radius:4px;}
.story .post .-title{margin:0px;padding:0px 10px;}
.story .post .-title a{color:#52BBC3}
.story .post .-detail{margin:10px;}
.story .post .-detail img{max-width:100%;height:auto;}

.form-control{border-color:#eee;border-radius:0px;height:40px; font-size:18px;}
</style>
<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<div class="story">
<div id="newblog" style="margin-bottom:10px;padding-bottom:10px;border-bottom:1px solid #eee;<?php if(self::$path[1]!='new'):?>display:none;<?php endif?>">
<h2 class="bar-heading">สร้างบล็อกใหม่</h2>
<form method="post" action="<?php echo URL?>" onsubmit="_.ajax.gourl('<?php echo URL?>','newblog',this);return false">
  <fieldset>
    <div class="form-group">
      <input type="text" class="form-control" name="title" placeholder="ชื่อบล็อก (ไม่เกิน 100 ตัวอักษร)" required>
    </div>
    <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon" id="basic-addon">https://story.jarm.com/</span>
        <input type="text" class="form-control" id="username" name="username" placeholder="username (a-z หรือ 0-9 จำนวน 6-16 ตัวอักษร)" aria-describedby="basic-addon" required>
      </div>
    </div>
    <div class="form-group">
      <textarea class="form-control" name="detail" placeholder="อธิบายเกี่ยวกับบล็อกนี้ (ไม่เกิน 200 ตัวอักษร)" required></textarea>
    </div>
    <div class="form-group">
      <select name="cate" class="form-control" required>
        <option value="">เลือกประเภทเนื้อหา</option>
      <?php foreach ($this->cate as $k=>$v):?>
        <?php if($v['di']):?><option data-divider="true" disabled>------------------</option><?php endif?>
        <option value="<?php echo $k?>"><?php echo $v['t']?></option>
      <?php endforeach?>
      </select>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-primary">สร้าง</button>
    </div>
  </fieldset>
</form>
</div>

<h2 class="bar-heading">บล็อกของฉัน<small class="pull-right" style="margin-top:5px;"><button class="btn btn-xs btn-info" onclick="$('#newblog').css('display','block');">สร้างบล็อกใหม่</button></small></h2>
<table class="table" width="100%">
  <thead>
    <tr><th>บล็อก</th><th width="100" class="text-right">จำนวนเรื่อง</th><th width="250"></th></tr>
  </thead>
  <tbody>
  <?php if(count($this->blog)>0):?>
  <?php foreach($this->blog as $v):?>
    <tr><td><a href="/<?php echo $v['l']?>"><?php echo $v['t']?></a><br><small><?php echo $this->cate[$v['c']]['t']?></small></td>
      <td class="text-right"><?php echo intval($v['i'])?></td>
      <td class="text-right">
        <a href="/post/<?php echo $v['l']?>" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span> เขียนเรื่องใหม่</a>
        <a href="/blog/<?php echo $v['l']?>" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="top" title="จัดการโพสต์"><span class="glyphicon glyphicon-th-list"></span></a>
        <a href="/blog/<?php echo $v['l']?>/edit" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="แก้ไขบล็อก"><span class="glyphicon glyphicon-pencil"></span></a>
        <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="ลบบล็อก"><span class="glyphicon glyphicon-trash"></span></button>
      </td>
    </tr>
  <?php endforeach?>
  <?php else:?>
    <tr><td colspan="3"><div style="padding:50px;text-align:center">ยังไม่มีบล็อก</div></td></tr>
  <?php endif?>
  </tbody>
</table>
</div>
