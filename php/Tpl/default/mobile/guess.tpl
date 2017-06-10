<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo $this->data['title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/mobile.guess.css?<?php echo APP_VERSION?>">
<style>
.fbapp li div small{font-size: 12px;}
</style>
</head>
<body>
<div class="bar">
<div>
<?php if($this->parent):?><a href="<?php echo $this->parent?>" class="bar-back"></a><?php endif?>
<div class="bar-title">เกมทายใจ+</div>
<a href="/guess/print" class="bar-print"></a>
<a href="<?php echo URL?>" class="bar-refresh"></a>
</div>
</div>

<ul class="tabs"><li><a href="/guess" class="<?php echo !self::$path[0]?'active':''?>"><span>หน้าแรก</span></a></li><li><a href="/guess/recent" class="<?php echo self::$path[0]=='recent'?'active':''?>"><span>มาใหม่</span></a></li><li><a href="/guess/hit" class="<?php echo self::$path[0]=='hit'?'active':''?>"><span>ยอดฮิต</span></a></li><li><a href="<?php echo self::uri(['guess','/manage'])?>" target="_blank"><span>สร้างเกมทายใจ</span></a></li><li><a href="/guess/apps" class="<?php echo self::$path[0]=='apps'?'active':''?>"><span>แอพแนะนำ</span></a></li></ul>
<?php echo $this->data['content']?>
</body>
</html>
