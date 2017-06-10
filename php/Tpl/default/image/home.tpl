<style>
.img-s{ padding:5px 0px 5px 5px; margin:5px 5px 10px; border:1px solid #e0e0e0; box-shadow:3px 3px 0px #e9e9e9;}
.img-s .l{width:37%; border:1px dashed #f0f0f0; float:left; margin:0px 2% 0px 0px; text-align:center; padding:5px 0px; line-height:0px;}
.img-s .r{width:60%; float:left;}
.img-s .r div{ padding:5px; border-bottom:1px dashed #f0f0f0;}
.img-s .r div span{display:inline-block; width:150px; font-size:12px;}
.img-s .r input.tbox{width:300px; text-indent:5px;}
.recent{margin:5px 0px 0px 0px;}
.recent li{line-height:0px; margin-bottom:3px;text-align:center; padding:5px 0px; border:1px solid #f0f0f0; overflow:hidden;}
.recent li img{max-width:120px;}
</style>

<div style="padding:5px; border:1px solid #f0f0f0; text-align:center;">image.jarm.com - เว็บฝากรูปภาพฟรี ให้คุณฝากรูปฟรีสูงสุด <strong>10MB</strong> ต่อรูปฟรี!! ไม่มีวันหมดอายุ</div>
<div style="padding:5px; text-align:center; margin:5px 0px; border:1px solid #f0f0f0">
<span><span id="file_select_tmp_thumbnail"></span></span>
</div>
<div id="file_up_tmp_thumbnail" class="flash"></div>
<div id="result"></div>

<div style="padding:5px; background:#FFFAF5; border:1px solid #F90; line-height:1.8em">
<h4>กฏกติกาในการฝากรูป</h4>
- อัพโหลดไฟล์รูปภาพได้สูงสุด <strong>10 MB</strong><br>
- ฝากรูปประเภท .jpg .jpeg .gif .png<br>
- ย่อรูปภาพโดยอัตโนมัติ ด้วยขนาด 200x200 และ 600x10240(กว้าง600) pixel<br>
- รูปภาพที่ย่ออัตโนมัติ จะเป็นภาพเคลื่อนไหว(.gif)<br>
- สามารถย้อนกลับมาดูรูปที่เคยมาฝากไว้ได้<br>
- ห้ามโพสรูปโป๊ลามกอนาจารเด็ดขาด<br>
- ต้องมี Flash Player จึงสามารถใช้ระบบอัพโหลดได้
</div>

<div class="recent">
<h4 style="padding:5px; background:#f0f0f0;">รูปภาพล่าสุด</h4>
<ul class="thumbnails row-count-4">
<?php for($i=0;$i<count($this->image);$i++):?>
<li class="col-sm-3">
<a href="/v/<?php echo $this->image[$i]['f'].'.'.$this->image[$i]['ty']?>" target="_blank"><img src="http://<?php echo $this->image[$i]['sv']?>.jarm.com/image/<?php echo $this->image[$i]['fd'].'/s.'.$this->image[$i]['ty']?>"></a>
</li>
<?php endfor?>
</ul>

</div>
