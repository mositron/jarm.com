<style>
.news-detail{font-size:14px;}
</style>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/announce" title=""><?php echo $this->content_type[$this->type]['n']?></a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/announce/<?php echo $this->content['_id']?>" title=""><?php echo $this->content['title']?></a></li>
	<?php if (team::$my['grade']==99):?>
		<span></span>
		<li class="pull-right" style="margin:-3px -2px 1px;"><a href="/announce/update/<?php echo $this->content['_id']?>" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></a></li>
	<?php endif?>
</ul>

<div class="box-white">
  <h1 class="news-h1"><?php echo $this->content['title']?></h1>
  <div class="news-detail"><?php echo $this->content['detail']?></div>
</div>
