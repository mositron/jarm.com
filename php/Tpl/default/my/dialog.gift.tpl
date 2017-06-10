


<div id="gift_send" class="gbox" style="width:830px;">
<form onSubmit="_.ajax.gourl('/user/<?php echo $this->user['link']?>','sendgift',this);_.box.close();return false;">
<div class="gbox_header">มอบของขวัญให้ <?php echo $this->user['name']?></div>
<div class="gbox_content" style="text-align:center;">
<?php if($this->user && $this->user['_id']!=$this->my['_id']):?>
<input type="hidden" name="profile" value="<?php echo $this->user['_id']?>">
<div style="line-height:1.8em; padding:5px 10px 10px 20px; text-align:left">
<ul class="sgift" style="height: 400px;overflow: scroll;overflow-y: auto;">
<?php $i=0;foreach($this->gift as $k=>$v):
if(is_array($v['u'])&&!in_array($this->my['_id'],$v['u']))continue;
?>
<li>
<label>
<h5><?php echo $v['n']?></h5>
<img src="https://s1.jarm.com/gift/64/<?php echo $k?>.png">
<div>
ราคา: <?php echo $v['pr']?> บ๊อก<br>
ระยะเวลา: <?php echo $v['ex']?> วัน
</div>
<input type="radio" name="gift" value="<?php echo $k?>">
</label>
</li>
<?php if($i%5==4):?><p class="clear"></p><?php endif?>
<?php $i++;endforeach?>
<p class="clear"></p>
</ul>
<div style="margin:10px 10px 0px 10px; text-align:center; vertical-align:top; padding:5px; border:1px solid #f0f0f0; border-radius:5px;">ข้อความ: <textarea class="tbox" name="ms" style="width:450px; height:50px;" placeholder="กรอกข้อความของคุณที่นี่" required></textarea></div>
<div style="text-align:center; padding:5px; text-align:center; background:#f0f0f0; margin:10px 10px 0px">คุณมี  <?php echo intval($this->my['cd']['p'])?> บ๊อก</div>
</div>
<?php else:?>
<div style="padding:30px 50px; text-align:center">ไม่มีบุคคลดังกล่าว</div>

<?php endif?>
</div>
<div class="gbox_footer"><input type="submit" class="button blue" value=" ส่งเดี๋ยวนี้ "> <input type="button" class="button" value=" ยกเลิก " onClick="_.box.close()"></div>
</form>
</div>