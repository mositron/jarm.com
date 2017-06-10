<div id="user-bar"><img src="http://graph.facebook.com/<?php echo $this->user['fb']?>/picture?type=square"> <?php echo $this->user['name']?></div>



<div id="waiting"><div id="waiting_text">กรุณารอซักครู่..</div></div>

<div id="cooked">
<h4>เพิ่มเมนูใหม่</h4>
<div id="additem" style="text-align:left">
<form onSubmit="_.ajax.gourl('<?php echo URL?>','newitem',this);return false">
<div><span>ชื่อเมนู</span><br><input type="text" name="name" class="tbox" placeholder="บังคับกรอก" required></div>
<div><span>วัตถุดิบ</span><br>
<input type="text" name="mat" class="tbox" placeholder="บังคับกรอก" required>
<input type="text" name="mat" class="tbox" placeholder="บังคับกรอก" required>
<input type="text" name="mat" class="tbox" placeholder="ถ้ามี">
<input type="text" name="mat" class="tbox" placeholder="ถ้ามี">
<input type="text" name="mat" class="tbox" placeholder="ถ้ามี">
<input type="text" name="mat" class="tbox" placeholder="ถ้ามี">
<input type="text" name="mat" class="tbox" placeholder="ถ้ามี">
<input type="text" name="mat" class="tbox" placeholder="ถ้ามี">
<input type="text" name="mat" class="tbox" placeholder="ถ้ามี">
<input type="text" name="mat" class="tbox" placeholder="ถ้ามี">
 </div>
 <div><input type="submit" class="btn" value="เพิ่มเมนูนี้"></div>
 </form>
</div>
</div>
<div id="preload"></div>


<script>
var m={
	user:<?php echo json_encode($this->user)?>,
	start:function()
	{
		$('#cooked').css('display','block');
	},
}


function onlogged()
{
	$('#waiting_text').css('display','none');
	if(uid!=<?php echo self::$path[2]?>)
	{
		m.start();
	}
	else
	{
		window.location.href='/cooked';
	}
}
//$(window).resize(m.resize);
</script>