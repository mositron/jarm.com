<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo $this->data['title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/mobile.oil.css?<?php echo APP_VERSION?>">
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
</head>
<body>
<div class="bar">
<div>
<?php if($this->parent):?>
<a href="<?php echo $this->parent?>" class="bar-back"></a>
<?php endif?>
<div class="bar-title">ราคาน้ำมัน+</div>
<a href="/oil/print" class="bar-print"></a>
<a href="<?php echo URL?>" class="bar-refresh"></a>
</div>
</div>
<ul class="tabs"><li><a href="/oil/gas-type" class="<?php echo self::$path[0]=='gas-type'?'active':''?>"><span>น้ำมัน(ประเภท)</span></a></li><li><a href="/oil/gas-brand" class="<?php echo self::$path[0]=='gas-brand'?'active':''?>"><span>น้ำมัน(ปั๊ม)</span></a></li><li><a href="/oil/lpg-type" class="<?php echo self::$path[0]=='lpg-type'?'active':''?>"><span>LPG(ความจุ)</span></a></li><li><a href="/oil/lpg-brand" class="<?php echo self::$path[0]=='lpg-brand'?'active':''?>"><span>LPG(ปั๊ม)</span></a></li><li><a href="/oil/ngv" class="<?php echo self::$path[0]=='ngv'?'active':''?>"><span>NGV</span></a></li><li><a href="/oil/apps" class="<?php echo self::$path[0]=='apps'?'active':''?>"><span>แอพแนะนำ</span></a></li></ul>
<?php echo $this->data['content']?>
</body>
</html>
