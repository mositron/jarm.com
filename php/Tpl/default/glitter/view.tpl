<ul class="breadcrumb">
<li><a href="/" title="กลิตเตอร์ Glitter"><i class="icon-home"></i> กลิตเตอร์</a></li>
<?php $p=$this->cate[$this->c]['p'];?>
<span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->cate[$p]['t']?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/c-1" title="กลิตเตอร์แสดงอารมณ์">แสดงอารมณ์</a></li>
   <li><a href="/c-41" title="กลิตเตอร์ทักทาย">ทักทาย</a></li>
   <li><a href="/c-71" title="กลิตเตอร์เทศกาล">เทศกาล</a></li>
   <li><a href="/c-91" title="กลิตเตอร์อื่นๆ">กลิตเตอร์อื่นๆ</a></li>
  </ul>
 </li>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->cate[$this->c]['t']?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/c-<?php echo $p?>"><?php echo $this->cate[$p]['t']?>ทั้งหมด</a></li>
   <li class="divider"></li>
 <?php for($i=0;$i<count($this->cate[$p]['l']);$i++):?>
 <?php $j=$this->cate[$p]['l'][$i];?>
   <li><a href="/c-<?php echo $j?>"><?php echo $this->cate[$j]['t']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <span class="divider">&raquo;</span><li> รายละเอียด</li>
</ul>
<h3 style="padding:5px; margin:5px 0px"><?php echo $this->glitter['t']?></h3>

<div class="row">
  <div class="col-sm-9">
    <div style="padding:0px; background:#fff; border:1px solid #ccc; text-align:center; margin:0px 0px 5px 0px; line-height:0px;">
      <img src="http://<?php echo $this->glitter['sv']?>.jarm.com/glitter/<?php echo $this->glitter['fd']?>/l.<?php echo $this->glitter['ty']?>" alt="<?php echo ($this->glitter['t'])?>" class="img-responsive" style="margin:0px auto">
    </div>
  </div>
  <style>@media (min-width: 768px){._share>div{float:none;width:auto;margin:5px 0px 0px;}}</style>
  <div class="col-sm-3">
    <div class="_share bottom">
  		<div class="facebook"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Facebook</a></div>
  		<div class="twitter"><p>0</p><a href="javascript:;"><span></span> <small>ทวีตไปยัง</small> Twitter</a></div>
  		<div class="google"><p>0</p><a href="javascript:;"><span></span> <small>แชร์ไปยัง</small> Google+</a></div>
  	</div>
  	<script>$(function(){_.share({title:'<?php echo $this->glitter['t']?>',url:'<?php echo URI?>',img:'<?php echo $this->data['image']?>',cb:function(a,b,c){if(a=='facebook'){}}});});</script>

    <ul>
    <li>ดาวน์โหลด: <?php echo number_format(intval($this->glitter['do']))?> ครั้ง</li>
    <li>อัพโหลดโดย: <a href="http://jarm.com/user/<?php echo $this->user['_id']?>" target="_blank"><?php echo $this->user['name']?></a></li>
    <li>เมื่อ: <?php echo self::Time()->from($this->glitter['da'],'date')?></li>
    <li>ประเภท:
    <?php $tags='glitter';?>
    <?php $i=0;foreach((array)$this->glitter['c'] as $v):?>
    <?php if($i):?>, <?php endif?><a href="/c-<?php echo $v?>"><?php echo $this->cate[$v]['t']?></a>
    <?php $tags.=', '.$this->cate[$v]['t'];?>
    <?php $i++;endforeach?>
    </li>
    <?php if($this->glitter['zp']):?><li style="margin-bottom:5px;"><a href="/download/<?php echo $this->glitter['_id']?>" rel="nofollow" class="btn btn-warning">     ดาวน์โหลด     </a></li><?php endif?>
    <li>
      <?php if(self::$my['am']):?><span class="btn btn-default btn-xs" onClick="_.ajax.gourl('<?php echo URL?>','recommend')">ตั้งแนะนำ</span><?php endif?>
      <?php if((self::$my['am']>=9) || (self::$my['_id']==$this->glitter['u'])):?><a href="/update/<?php echo $this->glitter['_id']?>" class="btn btn-default btn-xs">แก้ไข</a><?php endif?>
    </li>
    </ul>
  </div>
</div>

<div style="padding:5px; border:1px solid #ddd; background:#fff; border-radius:5px;">
  Copy โค้ด กลิตเตอร์ ในช่องนี้ไปใส่ในเว็บหรือเว็บบอร์ดได้เลยจ้า<br>
  <strong>แบบ HTML</strong><br>
  <textarea class="form-control" style="height:50px"><a href="https://glitter.jarm.com/view/<?php echo $this->glitter['_id']?>" title="กลิตเตอร์ Glitter"><img src="http://<?php echo $this->glitter['sv']?>.jarm.com/glitter/<?php echo $this->glitter['fd']?>/l.<?php echo $this->glitter['ty']?>" alt="กลิตเตอร์ Glitter"></a></textarea>
  <strong>แบบ BBCode</strong> (เว็บบอร์ด หรือ forum)<br>
  <textarea class="form-control" style="height:30px">[url=https://glitter.jarm.com/view/<?php echo $this->glitter['_id']?>][img]http://<?php echo $this->glitter['sv']?>.jarm.com/glitter/<?php echo $this->glitter['fd']?>/l.<?php echo $this->glitter['ty']?>[/img][/url]</textarea>
</div>

<h3 class="bar-heading">กลิตเตอร์ใกล้เคียง</h3>
<div class="gl-new row clear-line">
<?php for($i=0;$i<count($this->relate);$i++):?>
<div class="col-xs-6 col-sm-3 col-md-3">
<a href="/view/<?php echo $this->relate[$i]['_id']?>">
<img src="http://<?php echo $this->relate[$i]['sv']?>.jarm.com/glitter/<?php echo $this->relate[$i]['fd']?>/t.<?php echo $this->relate[$i]['ty']?>" class="img-responsive">
</a>
<p><?php echo $this->relate[$i]['t']?></p>
</div>
<?php endfor?>
</div>

<h4 class="bar-heading" style="margin:10px 0px 0px 0px">ความคิดเห็น</h4>
<div class="fb-comments" data-href="https://glitter.jarm.com/view/<?php echo $this->glitter['_id']?>" data-num-posts="30" data-width="710"></div>
