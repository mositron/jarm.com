<style>
.img-r div{ padding:5px; border-bottom:1px dashed #f0f0f0;}
.img-r div span{display:block; font-size:12px; font-weight:bold;}
.img-r input.tbox{width:100%; text-indent:5px;}

.img-info{padding:5px; text-align:left; line-height:1.6em; border:1px solid #f0f0f0; background:#f9f9f9;}
.img-info li{width:49%; float:left}
</style>
<div style="padding:5px 5px 5px;">
<h2 style="padding:5px; margin:0px 0px 5px; border-bottom:1px solid #f0f0f0;">รูปภาพ - <?php echo $this->image['n']?></h2>
<div style="padding:10px; border:1px solid #f0f0f0; text-align:center; margin:5px 0px;"><a href="http://<?php echo $this->image['sv']?>.jarm.com/image/<?php echo $this->image['fd'].'/o.'.$this->image['ty']?>" rel="gallery" class="pirobox_gall" title="<?php echo $this->image['n']?>"><img src="http://<?php echo $this->image['sv']?>.jarm.com/image/<?php echo $this->image['fd'].'/m.'.$this->image['ty']?>"></a></div>
<div>
<div class="img-info">
<h4>รายละเอียดรูปภาพ</h4>
<ul>
<li><span>ชื่อรูปภาพ</span>: <?php echo $this->image['n']?></li>
<li><span>ประเภทรูปภาพ</span>: <?php echo $this->image['ty']?></li>
<li><span>ขนาดรูปภาพ</span>: <?php echo $this->image['w']?>x<?php echo $this->image['h']?> pixel</li>
<li><span>ขนาดไฟล์</span>: <?php echo number_format(intval($this->image['si'])/1024,2)?> KB</li>
<li><span>อัพโหลดเมื่อ</span>: <?php echo self::Time()->from($this->image['da'],'datetime')?></li>
<li><span>จำนวนผู้ชม</span>: <?php echo number_format(intval($this->image['do']))?> ครั้ง</li>
<li><span>เข้าชมล่าสุดเมื่อ</span>: <?php echo self::Time()->from($this->image['ds'],'datetime')?></li>
<li><a href="javascript:;" onClick="_.box.load('/report/<?php echo $this->image['_id']?> #report')"><span class="glyphicon glyphicon-trash"></span> แจ้งลบ/ลบ</a></li>
<p class="clear"></p>
</ul>
</div>
<div>
<div class="img-r">
<div><span>ลิงค์หน้าเว็บ</span><input type="text" class="tbox" value="https://image.jarm.com/v/<?php echo $this->image['f']?>.<?php echo $this->image['ty']?>" onMouseOver="this.select()" onFocus="this.select()"></div>
<div><span>ลิงค์รูปภาพ -  ขนาดรูป 200x200 - มีลายน้ำ</span><input type="text" class="tbox" value="http://<?php echo $this->image['sv']?>.jarm.com/image/<?php echo $this->image['fd']?>/s.<?php echo $this->image['ty']?>" onMouseOver="this.select()" onFocus="this.select()"></div>
<div><span>ลิงค์รูปภาพ - ขนาดรูป 600x800 - มีลายน้ำ</span><input type="text" class="tbox" value="http://<?php echo $this->image['sv']?>.jarm.com/image/<?php echo $this->image['fd']?>/m.<?php echo $this->image['ty']?>" onMouseOver="this.select()" onFocus="this.select()"></div>
<div><span>ลิงค์รูปภาพ - รูปดั้งเดิม - ไม่มีลายน้ำ</span><input type="text" class="tbox" value="http://<?php echo $this->image['sv']?>.jarm.com/image/<?php echo $this->image['fd']?>/o.<?php echo $this->image['ty']?>" onMouseOver="this.select()" onFocus="this.select()"></div>
<div><span>HTML Code[Thumbnail]</span><input type="text" class="tbox" value="&lt;a href=&quot;https://image.jarm.com/v/<?php echo $this->image['f']?>.<?php echo $this->image['ty']?>&quot; target=&quot;_blank&quot; title=&quot;ฝากรูป&quot;&gt;&lt;img src=&quot;http://<?php echo $this->image['sv']?>.jarm.com/image/<?php echo $this->image['fd']?>/s.<?php echo $this->image['ty']?>&quot; border=&quot;0&quot; title=&quot;ฝากรูป&quot;&gt;&lt;/a&gt;" onMouseOver="this.select()" onFocus="this.select()"></div>
<div><span>HTML Code[View size]</span><input type="text" class="tbox" value="&lt;a href=&quot;https://image.jarm.com/v/<?php echo $this->image['f']?>.<?php echo $this->image['ty']?>&quot; target=&quot;_blank&quot; title=&quot;ฝากรูป&quot;&gt;&lt;img src=&quot;http://<?php echo $this->image['sv']?>.jarm.com/image/<?php echo $this->image['fd']?>/m.<?php echo $this->image['ty']?>&quot; border=&quot;0&quot; title=&quot;ฝากรูป&quot;&gt;&lt;/a&gt;" onMouseOver="this.select()" onFocus="this.select()"></div>
<div><span>BBCode[Thumbnail]</span><input type="text" class="tbox" value="[url=https://image.jarm.com/v/<?php echo $this->image['f']?>.<?php echo $this->image['ty']?>][img]http://<?php echo $this->image['sv']?>.jarm.com/image/<?php echo $this->image['fd']?>/s.<?php echo $this->image['ty']?>[/img][/url]" onMouseOver="this.select()" onFocus="this.select()"></div>
<div><span>BBCode[View size]</span><input type="text" class="tbox" value="[url=https://image.jarm.com/v/<?php echo $this->image['f']?>.<?php echo $this->image['ty']?>][img]http://<?php echo $this->image['sv']?>.jarm.com/image/<?php echo $this->image['fd']?>/m.<?php echo $this->image['ty']?>[/img][/url]" onMouseOver="this.select()" onFocus="this.select()"></div>
</div>

</div>
<p class="clear"></p>
</div>
</div>


<div>
<h4 style="margin:10px 0px 0px 0px; padding:5px; text-align:center; background:#f0f0f0;">แสดงความคิดเห็นด้วย Facebook</h4>
<div class="fb-comments" data-href="<?php echo URI?>" data-num-posts="30" data-width="720"></div>
</div>
