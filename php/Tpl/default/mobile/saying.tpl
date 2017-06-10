<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo $this->data['title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"> 
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/mobile.saying.css?<?php echo APP_VERSION?>">
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
</head>
<body>
<div class="bar">
<div>
<?php if($this->parent):?>
<a href="<?php echo $this->parent?>" class="bar-back"></a>
<?php endif?>
<div class="bar-title">saying+ </div>
<a href="/saying/print" class="bar-print"></a>
<a href="<?php echo URL?>" class="bar-refresh"></a>
</div>
</div>
<ul class="tabs"><li><a href="/saying" class="<?php echo !self::$path[0]?'active':''?>"><span>หน้าแรก</span></a></li><li><a href="/saying/recent" class="<?php echo self::$path[0]=='recent'?'active':''?>"><span>ล่าสุด</span></a></li><li><a href="/saying/ref/fb" class="<?php echo self::$path[0]=='ref'&&self::$path[1]=='fb'?'active':''?>"><span>Facebook</span></a></li><li><a href="/saying/ref/line" class="<?php echo self::$path[0]=='ref'&&self::$path[1]=='line'?'active':''?>"><span>Line</span></a></li><li><a href="/saying/apps" class="<?php echo self::$path[0]=='apps'?'active':''?>"><span>แอพแนะนำ</span></a></li></ul>
<?php echo $this->data['content']?>
</body>
</html>