
<ul class="breadcrumb">
<li><a href="/" title="กลิตเตอร์ Glitter"><i class="icon-home"></i> กลิตเตอร์</a></li>

<?php if($p=$this->cate[$this->c]['p']):?>
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
 <?php elseif($this->c):?>

<span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->cate[$this->c]['t']?> <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/c-1" title="กลิตเตอร์แสดงอารมณ์">แสดงอารมณ์</a></li>
   <li><a href="/c-41" title="กลิตเตอร์ทักทาย">ทักทาย</a></li>
   <li><a href="/c-71" title="กลิตเตอร์เทศกาล">เทศกาล</a></li>
   <li><a href="/c-91" title="กลิตเตอร์อื่นๆ">กลิตเตอร์อื่นๆ</a></li>
  </ul>
 </li>
 <span class="divider">&raquo;</span>
 <li class="dropdown">
 <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->cate[$this->c]['t']?>ทั้งหมด <span class="caret"></span></a>
  <ul class="dropdown-menu">
   <li><a href="/c-<?php echo $this->c?>"><?php echo $this->cate[$this->c]['t']?>ทั้งหมด</a></li>
   <li class="divider"></li>
 <?php for($i=0;$i<count($this->cate[$this->c]['l']);$i++):?>
 <?php $j=$this->cate[$this->c]['l'][$i];?>
   <li><a href="/c-<?php echo $j?>"><?php echo $this->cate[$j]['t']?></a></li>
   <?php endfor?>
  </ul>
 </li>
 <?php endif?>
</ul>
<style>
.gl-new div{text-align:center; margin-bottom:5px;}
.gl-new div > a{display: block;background: white;margin: 0px auto;line-height: 0px;padding: 0px;border: 1px solid #DDD;}
.gl-new div p{margin: 0px auto 0px auto;height: 20px;line-height: 20px;overflow: hidden;background: #DDD;border: 1px solid #DDD; text-shadow:1px 1px 0px #fff;white-space:nowrap; text-overflow:ellipsis; text-indent:5px;}
.gl-new div img{}
</style>
<div class="gl-new row clear-line">
<?php for($i=0;$i<count($this->last);$i++):?>
<div class="col-xs-6 col-sm-3 col-md-3">
<a href="/view/<?php echo $this->last[$i]['_id']?>">
<img src="http://<?php echo $this->last[$i]['sv']?>.jarm.com/glitter/<?php echo $this->last[$i]['fd']?>/t.<?php echo $this->last[$i]['ty']?>" class="img-responsive">
</a>
<p><?php echo $this->last[$i]['t']?></p>
</div>
<?php endfor?>
</div>


<div style="text-align:center"><?php echo $this->pager?></div>
