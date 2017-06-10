<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" lang="th" xml:lang="th">
<head>
<meta charset="UTF-8">
<title><?php echo $this->data['title']?></title>
<meta name="Description" content="<?php echo $this->data['description']?>" />
<meta name="Keywords" content="<?php echo $this->data['keywords']?>" />
<meta name="Copyright" content="jarm.com" />
<meta name="google-site-verification" content="hSfRFCcDswWyu5qloNfX7fM9e7-7ok-Al6KFIyVphJA" />
<meta property="fb:pages" content="229722963822965" />
<meta property="fb:app_id" content="<?php echo self::$conf['social']['facebook']['appid']?>" />
<meta property="og:type" content="<?php echo $this->data['type']?>" />
<meta property="og:title" content="<?php echo $this->data['title']?>" />
<meta property="og:image" content="<?php echo $this->data['image']?>" />
<meta property="og:url" content="<?php echo URI?>" />
<link rel="canonical" href="<?php echo URI?>" />
<meta property="og:site_name" content="<?php echo $this->data['sitename']?>" />
<meta property="og:description" content="<?php echo $this->data['description']?>" />
<meta property="og:locale" content="th_TH" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/jarm-all.css" />
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="<?php echo $this->data['feed']['title']?>" href="<?php echo $this->data['feed']['url']?>" />
<script type="text/javascript" src="<?php echo FILES_CDN?>js/jarm-all.js"></script>
<!--[if lt IE 9]>
<script src="<?php echo FILES_CDN?>js/html5shiv/html5shiv.js"></script>
<![endif]-->
<link href="https://plus.google.com/+BoxzaOnline" rel="publisher" />
<style>
body{background:#fff;}
body>.container>.row{background:none;box-shadow:none;}
.row-body{min-height:400px;}
</style>
</head>
<body class="body-<?php echo self::$sub?> body-<?php echo self::$sub?>-<?php echo MODULE?>">
<div id="navbar-header" class="navbar-fixed-top">
    <div class="container">
	    <a class="navbar-brand" href="http://jarm.com/" title="Jarm"></a>
        <nav role="navigation"><!-- collapse navbar-collapse bs-navbar-collapse -->
          <ul class="nav navbar-nav pull-left">
          	<span></span>
          	<li><a href="<?php echo self::uri(['team','/'])?>" title="Jarm Team">Team</a></li>
          </ul>
        </nav>
    </div>
</div>
<div class="container">
  <div class="row row-body">
    <style>
    .box-border{width:300px;margin:50px auto;border:1px solid #ddd;background:#f7f7f7;text-align:center;}
    .box-border>div{margin:10px;}
    .btn-fb{color:#fff;background:#3b5998;text-align:center;display:block;margin:0px 0px 10px;}
    .btn-gg{color:#fff;background:#c00;text-align:center;display:block;margin:0px 0px 10px;}
    a.btn-fb:hover,a.btn-gg:hover{color:#fff;}
    </style>
    <div class="box-border">
      <h2 class="bar-heading" style="margin-bottom:10px">เข้าสู่ระบบ</h2>
      <div>
        <div><span class="glyphicon glyphicon-user" style="font-size:200px;color:#ccc;margin:0px auto 10px;"></span></div>
        <?php if($_GET['error']):?><div style="padding:5px; margin:0px 0px 20px; color:#f00; background:#fff;border:1px solid #f00; text-align:center"><?php echo get_error($_GET['error'])?></div> <?php endif?>
        <!--div><a href="https://team.jarm.com/oauth/facebook/<?php echo $this->q?>" class="btn btn-md btn-fb">เข้าระบบด้วยบัญชี Facebook</a></div-->
        <div><a href="https://team.jarm.com/oauth/google/<?php echo $this->q?>" class="btn btn-md btn-gg">เข้าระบบด้วยบัญชี Google</a></div>
      </div>
      <div>เฉพาะพนักงาน.<br> ใช้อีเมล์ @inet-rev.co.th หรือ @boxzaracing.com ในการล็อคอินเข้าใช้งานเท่านั้น.
    </div>
  </div>
</div>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-31362918-1', 'jarm.com');
ga('send', 'pageview');
</script>
</body>
</html>
