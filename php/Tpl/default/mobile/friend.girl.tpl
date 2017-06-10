<script>
function geturl(a)
{
	window.location.href='/friend/girl/province-'+a.province.value+'/min-'+a.min.value+'/max-'+a.max.value;
}
</script>
<div class="find-friend">
<h3>ค้นหาเพื่อนหญิง</h3>
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
<i class="i2"><a href="javascript:;" onClick="if(confirm('ต้องการลบข้อความนี้หรือไม่'))_.ajax.gourl('/friend','delms',<?php echo $this->friend[$i]['_id']?>);">ลบข้อความ</a></i>
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



<div class="page-nav">
<?php if($this->page>1):?>
<a href="<?php echo $this->parm['url']?><?php echo $this->page>2?'/page-'.($this->page-1):''?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="<?php echo $this->parm['url']?>/page-<?php echo $this->page+1?>">ถัดไป</a>
<?php endif?>
</div>