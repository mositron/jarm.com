<style>
.news-detail{font-size:14px;padding:10px;}
</style>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/meeting" title="">การประชุม</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/meeting/<?php echo $this->meeting['_id']?>" title=""><?php echo $this->meeting['title']?></a></li>
	<?php if (team::$my['grade']==99||$this->meeting['u']==team::$my['_id']):?>
		<span></span>
		<li class="pull-right" style="margin:-3px -2px 1px;"><a href="/meeting/update/<?php echo $this->meeting['_id']?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></li>
	<?php endif?>
</ul>

<div class="box-white">
  <h1 class="news-h1"><?php echo $this->meeting['title']?></h1>
	<div>
		<h3 class="bar-heading">ประชุม: <?php echo self::Time()->from($this->meeting['dp'],'datetime')?></h3>
		<h4 class="bar-heading">โดย: <a href="/user/<?php echo $this->meeting['u']?>"><?php echo $this->people[$this->meeting['u']]['th']['first'].' '.$this->people[$this->meeting['u']]['th']['last']?></a> <small>&lt;<?php echo $this->people[$this->meeting['u']]['email']?>&gt; &lt;แก้ไขล่าสุด: <?php echo self::Time()->from($this->meeting['de'],'datetime')?>&gt;</small></h4>
		<div style="border-bottom:1px dashed #ccc;padding:5px;">
			<?php foreach((array)$this->meeting['ref'] as $k2=>$v2):$p=$this->people[$v2];?>
			<a href="/user/<?php echo $p['_id']?>" title="<?php echo $p['th']['first'].' '.$p['th']['last']?>"><img class="img-circle" src="https://f1.jarm.com/team/user/<?php echo $p['_id']?>-s.jpg" style="width:32px;"></a>
			<?php endforeach?>
		</div>
	</div>
  <div class="news-detail"><?php echo $this->meeting['detail']?></div>
</div>
