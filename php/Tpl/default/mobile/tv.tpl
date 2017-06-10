<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo $this->data['title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"> 
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/mobile.tv.css?<?php echo APP_VERSION?>">
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
</head>
<body>
<ul class="tabs"><li><a href="/tv" class="<?php echo !self::$path[0]?'active':''?>"><span>กรุงเทพมหานคร</span></a></li><li><a href="/football/apps" class="<?php echo self::$path[0]=='apps'?'active':''?>"><span>แอพแนะนำ</span></a></li></ul>

<?php echo $this->data['content']?>
</body>
</html>