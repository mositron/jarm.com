<ul class="tv-list">
<li>
<a href="/drama/view/<?php echo $this->tv['_id']?>">
<img src="<?php echo $this->tv['img']?>">
<h1><?php echo $this->tv['name']?></h1>
<h2><?php if($this->tv['count']):?><?php echo $this->tv['count']?> ตอน, ล่าสุด <?php echo self::Time()->from($this->tv['last'],'date',1)?><?php else:?>เร็วๆนี้<?php endif?></h2>
</a>
</li>
</ul>

<script>
var last='';
function expand(a)
{
	e=$(a).parent().get(0);
	if(e==last)
	{
		$(e).animate({height:40}, 500);	
		last='';
	}
	else
	{
		if(last)
		{
			$(last).animate({height:40}, 500);	
		}
		last=e;
		var h=$(last).find('ul').height();
		$(last).animate({height: h+40}, 500);	
	}
}
</script>
<?php if(count($this->tv['peach'])==0):?>
<div style="padding:10px; margin:5px; text-align:center; background:#FFFEF2; border:1px solid #FFF3AA">ยังไม่มีเนื้อหาวิดีโอในเรื่องนี้ อาจจะเนื่องจากละครดังกล่าวยังไม่ออนแอร์ หรือไฟล์วิดิโอมีปัญหา<br><br>กรุณากลับมาอีกครั้ง.. หลังจากนี้</div>
<?php else:?>
<div style="padding:5px; margin:5px; text-align:center; background:#FFFEF2; border:1px solid #FFF3AA">กรุณาคลิกที่ ตอน&gt;ช่วง เพื่อเลือกดู</div>
<?php endif?>
<ul class="view-list">
<?php for($i=0;$i<($c=count($this->tv['peach']));$i++):$v=$this->tv['peach'][$i];?>
<li>
<a href="javascript:;" onClick="expand(this)">ตอนที่ <?php echo $c-$i?> : <?php echo self::Time()->from($v['ds'],'date',1)?></a>
<ul>
<?php for($z=0;$z<$cz=count($v['youtube']);$z++):?>
<li><a href="/drama/play?id=<?php echo $v['youtube'][$z]?>">  ช่วงที่ <?php echo ($z+1).' / '.$cz?></a></li>
<?php endfor?>
</ul>
</li>
<?php endfor?>
</ul>

