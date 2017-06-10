<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo $this->data['title']?></title>
<meta name="Description" content="<?php echo $this->data['description']?>">
<meta name="Keywords" content="<?php echo $this->data['keywords']?>">
<meta name="Copyright" content="jarm.com">
<meta name="google-site-verification" content="hSfRFCcDswWyu5qloNfX7fM9e7-7ok-Al6KFIyVphJA" />
<meta property="fb:app_id" content="<?php echo self::$conf['social']['facebook']['appid']?>">
<?php if($this->data['google']):?>
<link rel="author" href="https://plus.google.com/<?php echo $this->data['google']['id']?>/posts"/>
<?php endif?>
<meta property="og:type" content="<?php echo $this->data['type']?$this->data['type']:'website'?>">
<meta property="og:title" content="<?php echo $this->data['title']?>">
<meta property="og:url" content="<?php echo URI?>">
<meta property="og:site_name" content="หวย">
<meta property="og:description" content="<?php echo $this->data['description']?>">
<meta property="og:locale" content="th_TH">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/lotto.mobile.css?<?php echo time()?>">
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
</head>
<body>
<div class="bar">
<div>
<?php if($this->parent):?>
<a href="<?php echo $this->parent?>" class="bar-back"></a>
<?php endif?>
<div class="bar-title">ตรวจหวย+</div>
<a href="<?php echo URL?>" class="bar-refresh"></a>
</div>
</div>
<?php echo $this->data['content']?>
</body>
</html>
