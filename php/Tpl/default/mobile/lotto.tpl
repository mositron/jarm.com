<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo $this->data['title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/mobile.lotto.css?<?php echo APP_VERSION?>">
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
</head>
<body>
<div class="bar">
<div>
<?php if($this->parent):?>
<a href="<?php echo $this->parent?>" class="bar-back"></a>
<?php endif?>
<div class="bar-title">ตรวจหวย+</div>
<a href="/lotto/print" class="bar-print"></a>
<a href="<?php echo URL?>" class="bar-refresh"></a>
</div>
</div>
<ul class="tabs"><li><a href="/lotto/lottery-last" class="<?php echo self::$path[0]=='lottery-last'?'active':''?>"><span>หวยล่าสุด</span></a></li><li><a href="/lotto/lottery" class="<?php echo self::$path[0]=='lottery'?'active':''?>"><span>หวยย้อนหลัง</span></a></li><li><a href="/lotto/set" class="<?php echo self::$path[0]=='set'?'active':''?>"><span>หวยหุ้น</span></a></li><li><a href="/lotto/news" class="<?php echo self::$path[0]=='news'?'active':''?>"><span>เลขเด็ด</span></a></li><li><a href="/lotto/apps" class="<?php echo self::$path[0]=='apps'?'active':''?>"><span>แอพแนะนำ</span></a></li></ul>
<?php echo $this->data['content']?>
</body>
</html>
