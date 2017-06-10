
<?php #if($this->fb['id']&&$this->fb['name']):?>
<div class="user"><img src="http://graph.facebook.com/<?php echo $this->fb['id']?>/picture?type=square"><p><?php echo $this->fb['name']?></p><div><a href="/friend/logout">ออกจากระบบ</a></div></div>


<div class="add-friend">
<h3>ฝากข้อมูลของคุณ</h3>
<form action="/friend" method="post" onSubmit="addfriend(this);return false">
<input type="hidden" name="fb_id" value="<?php echo $this->fb['id']?>">
<input type="hidden" name="fb_name" value="<?php echo $this->fb['name']?>">
<div><strong>จังหวัด</strong><p><select name="province" id="a_province"><option value="">- เลือกจังหวัด -</option><?php foreach($this->province as $k=>$v):if(!$k)continue;?><option value="<?php echo $k?>"> - <?php echo $v['name_th']?></option><?php endforeach?></select></p></div>
<div><strong>เพศ</strong><p><select name="type" id="a_type"><option value="">- เลือกเพศ -</option><?php foreach($this->type as $k=>$v):?><option value="<?php echo $k?>"><?php echo $v?></option><?php endforeach?></select></p></div>
<div><strong>อายุ</strong><p><select name="age" id="a_age"><?php for($i=13;$i<=60;$i++):?><option value="<?php echo $i?>"><?php echo $i?></option><?php endfor?></select></p></div>
<div><strong>Line</strong><p><input type="text" name="line" id="a_line" class="tbox" style="width:90%"></p></div>
<div><strong>ข้อความทักทาย</strong><p><textarea name="msg" id="a_msg" class="tbox" style="width:95%; height:100px;"></textarea></p></div>
<div><strong>&nbsp;</strong><p><input type="submit" value=" เพิ่มข้อมูล " class="btn btn-play"></p></div>
<p></p>
</form>
</div>

<script>
function addfriend(a)
{
	var prov=$.trim($('#a_province').val());
	var type=$.trim($('#a_type').val());
	var age=$.trim($('#a_age').val());
	var msg=$.trim($('#a_msg').val());
	if(prov.length<1)
	{
		alert('กรุณาเลือกจังหวัด');	
	}
	else if(type.length<1)
	{
		alert('กรุณาเลือกเพศ');	
	}
	else if(age.length<1)
	{
		alert('กรุณาเลือกอายุ');	
	}
	else if(msg.length<5)
	{
		alert('กรุณากรอกข้อความอย่างน้อย 5 ตัวอักษร');	
	}
	else
	{
		_.ajax.gourl('<?php echo  URL?>','newfriend',a);
	}
}
</script>
<?php #endif?>

<script>
function geturl(a)
{
	window.location.href='/friend/province-'+a.province.value+'/type-'+a.type.value+'/min-'+a.min.value+'/max-'+a.max.value;
}
</script>
<div class="find-friend">
<h3>ค้นหาเพื่อน</h3>
<form action="/friend" method="get" onSubmit="geturl(this);return false">
<div>
<strong>จังหวัด</strong>
<p>
<select name="province">
<option value="">- ทั้งหมด -</option>
<?php foreach($this->zone as $k=>$v):?>
<option value="<?php echo $z=implode('_',$v['l'])?>"<?php echo $z==$this->_province?' selected':''?>><?php echo $v['n']?></option>
<?php foreach($v['l'] as $p):?>
<option value="<?php echo $p?>"<?php echo ($this->_province==$p)?' selected':''?>> - <?php echo $this->province[$p]['name_th']?></option>
<?php endforeach?>
<?php endforeach?>
</select>
</p>
</div>
<div>
<strong>เพศ</strong>
<p>
<select name="type">
<option value="">- ทั้งหมด -</option>
<?php foreach($this->type as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $k==$this->_type?' selected':''?>><?php echo $v?></option>
<?php endforeach?>
</select>
</p>
</div>
<div>
<strong>อายุ</strong>
<p>
<select name="min"><?php for($i=13;$i<=60;$i++):?><option value="<?php echo $i?>"<?php echo $i==$this->_min?' selected':''?>><?php echo $i?></option><?php endfor?></select>
 - 
<select name="max"><?php for($i=13;$i<=60;$i++):?><option value="<?php echo $i?>"<?php echo $i==$this->_max?' selected':''?>><?php echo $i?></option><?php endfor?></select>
</p>
</div>
<div><strong>&nbsp;</strong><p><input type="submit" value=" ค้นหา " class="btn btn-play"></p></div>
<p></p>
</form>
</div>

<div class="friend">
<?php for($i=0;$i<count($this->friend);$i++):?>
<div class="ty-<?php echo $this->friend[$i]['ty']?> ms-<?php echo $this->friend[$i]['_id']?>">
<i class="i1"><?php echo $this->type[$this->friend[$i]['ty']]?></i>
<?php if($this->fb['id']==$this->friend[$i]['fb_id'] || self::$my['_id']==1):?>
<i class="i2"><a href="javascript:;" onClick="if(confirm('ต้องการลบข้อความนี้หรือไม่'))_.ajax.gourl('<?php echo URL?>','delms',<?php echo $this->friend[$i]['_id']?>);">ลบข้อความ</a></i>
<?php endif?>
<!--div class="tm"><?php echo str_replace('-','<br>',self::Time()->from($this->friend[$i]['da'],'datetime',1))?></div-->
<div class="im"><a href="/friend/facebook?id=<?php echo $this->friend[$i]['fb_id']?>"><img src="http://graph.facebook.com/<?php echo $this->friend[$i]['fb_id']?>/picture?type=square&width=100&heighjt=100"></a></div>
<div class="ct">
<div class="nm"><?php echo $this->friend[$i]['fb_name']?></div>
<div class="dt">
<?php if($this->friend[$i]['line']):?><span class="line">Line: <?php echo $this->friend[$i]['line']?></span>, <?php endif?>
<span class="age">อายุ: <?php echo $this->friend[$i]['ag']?></span>, 
<span class="prov"><?php echo $this->province[$this->friend[$i]['pr']]['name_th']?></span>
</div>
<div class="ms"><?php echo $this->friend[$i]['ms']?></div>
</div>
</div>
<?php endfor?>
</div>