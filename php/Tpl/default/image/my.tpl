<style>
.recent{margin:5px 0px 0px 0px;}
.recent li{line-height:0px;margin-bottom:3px;text-align:center; padding:5px 0px; border:1px solid #f0f0f0; overflow:hidden;}
.recent li img.i{max-width:120px;}
.recent li .c{ margin:6px 0px 0px 0px; border:1px solid #eee; padding:5px; text-align:center; background:#f9f9f9;}

</style>


<div style="padding:5px 0px 5px 5px;">
<h2 style="padding:5px; margin:0px 0px 5px; border-bottom:1px solid #f0f0f0;">รูปภาพของคุณ - ล่าสุด</h2>
<div style="padding:5px; border:1px solid #f0f0f0;">image.jarm.com - เว็บฝากรูปภาพฟรี ให้คุณฝากรูปฟรีสูงสุด 10MB ต่อรูปฟรี!! ไม่มีวันหมดอายุ</div>

<ul class="recent thumbnails row-count-4">
<?php for($i=0;$i<count($this->image);$i++):?>
<li class="col-sm-3">
<a href="/v/<?php echo $this->image[$i]['f'].'.'.$this->image[$i]['ty']?>" target="_blank"><img src="<?php echo $this->image[$i]['sv']?>.jarm.com/image/<?php echo $this->image[$i]['fd'].'/s.'.$this->image[$i]['ty']?>" class="i"></a>
<div class="c">
<a href="javascript:;" onClick="_.box.load('/report/<?php echo $this->image[$i]['_id']?> #report')"><span class="glyphicon glyphicon-trash"></span> แจ้งลบ/ลบ</a>
</div>
</li>
<?php endfor?>
</ul>

</div>
