


<?php $create=false;?>
<div id="lionica_character">
<ul>
<?php for($i=0;$i<5;$i++):?>
<li>
<?php if($this->char[$i]):?>
<a href="javascript:;" onClick="_.lionica.player.select(<?php echo $this->char[$i]['_id']?>)" class="char-<?php echo $this->char[$i]['_id']?>">
<i class="char char-class-<?php echo $this->char[$i]['job']?>-<?php echo $this->char[$i]['gender']?> char-head-<?php echo $this->char[$i]['gender']?>-<?php echo $this->char[$i]['hair']?>-<?php echo $this->char[$i]['color']?> char-d"><div></div></i>
<p class="n"><?php echo $this->char[$i]['n']?></p>
<p class="j">Lv. <?php echo $this->char[$i]['lv']?> - <?php echo $this->job[$this->char[$i]['job']]?$this->job[$this->char[$i]['job']]['name']:''?></p>
</a>
<?php else:?>
<div class="char-available">ว่าง</div>
<?php $create=true;?>
<?php endif?>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
<div>
<p class="pull-left">
<button class="btn btn-inverse btn-play" onClick="_.lionica.player.play()" disabled>เข้าเกม</button>
</p>
<p class="pull-right">
<button class="btn btn-inverse btn-delete" onClick="_.lionica.player.delete()" disabled>ลบตัวละคร</button>
<button class="btn btn-inverse btn-create" onClick="_.lionica.player.create()"<?php if(!$create):?> disabled<?php endif?>>สร้างตัวละคร</button>
</p>
</div>
</div>

<div id="lionica_create">
<form onSubmit="_.ajax.gourl('/lionica/play','newchar',this);return false">
<h4>สร้างตัวละคร</h4>
<div><label><strong>ชื่อตัวละคร</strong>
<input type="text" class="tbox" name="name" maxlength="20" required>
</label>
</div>
<div style="text-align:center"><i class="char char-1-1-1-1-1 char-d" id="new_preview_d"><div></div></i> <i class="char char-1-1-1-1-1 char-l" id="new_preview_l"><div></div></i> <i class="char char-1-1-1-1-1 char-r" id="new_preview_r"><div></div></i> <i class="char char-1-1-1-1-1 char-u" id="new_preview_u"><div></div></i></div>
<div><strong>เพศ</strong>
<?php $r=rand(1,2);foreach(array(1=>'ชาย',2=>'หญิง') as $k=>$v):?>
<label><input type="radio" class="new_gender" name="gender" onClick="_.lionica.player.preview()" value="<?php echo $k?>"<?php echo $k==$r?' checked':''?>> <?php echo $v?></label>
<?php endforeach?>
</div>
<div><strong>อาชีพ</strong>
<?php $r=rand(1,4);foreach($this->job as $k=>$v):?>
<label><input type="radio" class="new_job" name="job" onClick="_.lionica.player.preview()" value="<?php echo $k?>"<?php echo $k==$r?' checked':''?>> <?php echo $v['name']?></label>
<?php endforeach?>
</div>
<div><strong>ทรงผม</strong>
<?php $r=rand(1,5);foreach(array(1,2,3,4,5) as $v):?>
<label><input type="radio" class="new_hair" name="hair" onClick="_.lionica.player.preview()" value="<?php echo $v?>"<?php echo $v==$r?' checked':''?>> แบบที่ <?php echo $v?></label>
<?php endforeach?>
</div>
<div><strong>สีผม</strong>
<?php $r=rand(1,7);foreach(array(1=>'แดง',2=>'น้ำตาล',3=>'ทอง',4=>'เขียว',5=>'ฟ้า',6=>'ขาว',7=>'ดำ') as $k=>$v):?>
<label><input type="radio" class="new_color" name="color" onClick="_.lionica.player.preview()" value="<?php echo $k?>"<?php echo $k==$r?' checked':''?>> สี<?php echo $v?></label>
<?php endforeach?>
</div>

<div><input type="submit" value="  สร้าง. " class="btn btn-inverse pull-left"><input type="button" value="ยกเลิก" class="btn btn-inverse pull-right" onClick="_.lionica.player.created()"></div>
</form>
</div>
