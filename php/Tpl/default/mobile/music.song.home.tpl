
<div class="music-bar"><a href="/music">หน้าแรก</a> &raquo; <a href="/music/song">เพลงใหม่</a>
<?php $url='/music/song';?>
<?php if($this->q):?>
<?php $url.='/q-'.urlencode($this->q);?>
&raquo; ค้นหา "<?php echo $this->q?>"
<?php elseif($this->sn):?>
<?php $url.='/sn-'.urlencode($this->sn);?>
&raquo; ชื่อเพลงขึ้นต้นด้วย "<?php echo $this->sn?>"
<?php elseif($this->ar):?>
<?php $url.='/ar-'.urlencode($this->ar);?>
&raquo; ศิลปินขึ้นต้นด้วย "<?php echo $this->ar?>"
<?php endif?>
</div>

<div class="song-list">
<div class="th">
<div>ชื่อเพลง</div>
<div>อัลบั้ม</div>
<div>ศิลปิน</div>
</div>
<?php for($i=0;$i<count($this->music);$i++):?>
<a href="/music/song/<?php echo $this->music[$i]['_id']?>">
<div><?php echo $this->music[$i]['sn']?></div>
<div><?php echo $this->music[$i]['al']?></div>
<div><?php echo $this->music[$i]['ar']?></div>
</a>
<?php endfor?>
</div>


<div class="page-nav">
<?php if($this->page>1):?>
<a href="/<?php echo $url.($this->page>2?'/page-'.($this->page-1):'')?>">ย้อนกลับ</a>
<?php endif?>
<?php if($this->page<$this->maxpage):?>
<a href="<?php echo $url.'/page-'.($this->page+1)?>">ถัดไป</a>
<?php endif?>
</div>