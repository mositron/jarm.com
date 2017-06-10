<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo $this->data['title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/mobile.weather.css?<?php echo APP_VERSION?>">
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
</head>
<body>
<div class="bar">
<div>
<?php if($this->parent):?>
<a href="<?php echo $this->parent?>" class="bar-back"></a>
<?php endif?>
<div class="bar-title">พยากรณ์อากาศ+</div>
<a href="/weather/print" class="bar-print"></a>
<a href="<?php echo URL?>" class="bar-refresh"></a>
</div>
</div>
<ul class="tabs"><li><a href="/weather/news" class="<?php echo self::$path[0]=='news'?'active':''?>"><span>ข่าว</span></a></li><li><a href="/weather/place/z-3" class="<?php echo $this->z=='3'?'active':''?>"><span>ภาคกลาง</span></a></li><li><a href="/weather/place/z-1" class="<?php echo $this->z=='1'?'active':''?>"><span>ภาคเหนือ</span></a></li><li><a href="/weather/place/z-2" class="<?php echo $this->z=='2'?'active':''?>"><span>ภาคอีสาน</span></a></li><li><a href="/weather/place/z-4" class="<?php echo $this->z=='4'?'active':''?>"><span>ภาคตะวันออก</span></a></li><li><a href="/weather/place/z-5" class="<?php echo $this->z=='5'?'active':''?>"><span>ภาคใต้<small>(ตะวันออก)</small></span></a></li><li><a href="/weather/place/z-6" class="<?php echo $this->z=='6'?'active':''?>"><span>ภาคใต้<small>(ตะวันตก)</small></span></a></li><li><a href="/weather/apps" class="<?php echo self::$path[0]=='apps'?'active':''?>"><span>แอพแนะนำ</span></a></li></ul>
<?php echo $this->data['content']?>
</body>
</html>
