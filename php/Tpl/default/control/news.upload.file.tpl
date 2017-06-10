<div>
<?php for($i=0;$i<count($this->file);$i++):?>
<div style="float:left; padding:5px;">
<a href="javascript:;" onClick="selectf('https://<?php echo self::getServ($this->news['sv'])?>.jarm.com/news/<?php echo $this->news['fd'].'/'.$this->file[$i]?>')" style="display:block; cursor:pointer"><img src="https://<?php echo self::getServ($this->news['sv'])?>.jarm.com/news/<?php echo $this->news['fd'].'/'.$this->file[$i]?>" class="img-t"></a>
<p align="center"><a href="javascript:;" onClick="deli('<?php echo $this->file[$i]?>')"><img src="<?php echo FILES_CDN?>img/global/delete.gif"></a></p>
</div>
<?php endfor?>
<?php if(!count($this->file)):?>
<div style="padding:20px; text-align:center">- ยังไม่มีไฟล์ -</div>
<?php endif?>
</div>
