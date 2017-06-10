
<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:5px 0px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->



<ul class="breadcrumb" style="margin:5px 0px 0px;">
<li><a href="/" title="ข่าว"><i class="icon-home"></i> หน้าแรกข่าว</a></li>
<span class="divider">&raquo;</span>
<li><a href="/<?php echo $this->cate[$this->c]['l']?>" title="ข่าว<?php echo $this->cate[$this->c]['t']?>">ข่าว<?php echo $this->cate[$this->c]['t']?></a></li>
</ul>



<div class="bcd">
<ul>
<?php for($i=0;$i<15;$i++): $v=$this->news[$i];?>
<?php if($i<3):?>
<li class="l1">
<a href="/view/<?php echo $v['_id']?>" target="_blank" class="l1">
<img src="https://s3.jarm.com/news/<?php echo $v['fd']?>/t.jpg" alt="<?php echo $v['t']?>">
<p><?php echo $v['t']?><?php if(self::Time()->sec($v['da'])>(time()-(3600*12))):?> <img src="https://cdn.jarm.com/static/img/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php else:?>
<li>
<a href="/view/<?php echo $v['_id']?>" target="_blank">
<img src="https://s3.jarm.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
<p><?php echo $v['t']?><?php if(self::Time()->sec($v['da'])>(time()-(3600*12))):?> <img src="https://cdn.jarm.com/static/img/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endif?>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>

<!-- BEGIN - BANNER : D -->
<?php if($this->_banner['d']):?>
<div style="overflow:hidden; margin:5px 0px 0px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['d'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : D -->

<div class="bcd">
<ul>
<?php for($i=15;$i<count($this->news);$i++):$v=$this->news[$i];?>
<li>
<a href="/view/<?php echo $v['_id']?>" target="_blank">
<img src="https://s3.jarm.com/news/<?php echo $v['fd']?>/s.jpg" alt="<?php echo $v['t']?>" class="i">
<p><?php echo $v['t']?><?php if(self::Time()->sec($v['da'])>(time()-(3600*12))):?> <img src="https://cdn.jarm.com/static/img/global/new/new<?php echo ($i%8)+1?>.gif" alt=""><?php endif?></p>
</a>
</li>
<?php endfor?>
<p class="clear"></p>
</ul>
</div>


<div style="text-align:center"><?php echo $this->pager?></div>
