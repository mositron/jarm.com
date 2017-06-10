<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<title><?php echo $this->data['title']?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<style>
html,body,div,p {margin: 0px;padding: 0px;border: 0px;}
body{ font-family:Tahoma; font-size: 16px; line-height: 1.6em; color: #ccc; background:#000; padding:0px; text-shadow:1px 1px 0px #222; margin:0px;}
a{ text-decoration:none; color:#0CF8FF}

.radio-h1{height: 40px;margin: 0px;padding: 0px 10px;background:#222;line-height: 40px;font-size:24px; color:#0CF8FF}


.tabs{height:50px;overflow: scroll;overflow-y: hidden;-webkit-overflow-scrolling: touch;white-space:nowrap; background:#555; margin:0px; padding:0px; list-style:none; text-align:center;}
.tabs li{display:inline-block; height:50px;}
.tabs li a{display:inline-block; height:50px;min-width:100px;text-align:center;}
.tabs li a.active{border-bottom: 5px solid #444;height: 45px;}
.tabs li a span{display:block; height:30px; line-height:30px; margin:10px 0px; font-size:18px; border-left:1px solid #6b6b6b; color:#f3f3f3;padding:0px 30px;}
.tabs li:first-child a span{border-left:none;}


.apps-list{list-style:none;margin:0px; padding:0px; text-shadow: none;}
.apps-list li{border-bottom:1px solid #333; overflow:hidden; background:#fff;}
.apps-list li:nth-child(odd){ background:#f4f4f4;}
.apps-list li a{height:62px;display:block;color: #191919; text-decoration: none; padding:0px 5px;}
.apps-list li a img{float:left; width:50px; height:50px; background:#ccc; margin:5px 10px 0px 0px;border-radius:4px; border:1px solid #000;}
.apps-list h1{font-size:24px; color:#333;margin:0px;padding: 7px 0px 0px; font-size: 20px; overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.apps-list h2{font-size:14px; color:#888; font-weight:normal; margin:0px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}

.home-list{list-style:none;margin:0px; padding:0px;}
.home-list li{border-bottom:1px solid #333; overflow:hidden;}
.home-list li:nth-child(even){background:#191919;}
.home-list li a{height:62px;display:block;color: #ccc; text-decoration: none; padding:0px 5px; overflow:hidden;}
.home-list img{display:inline-block; float:left; width:50px; height:50px;margin:5px 10px 0px 0px;border-radius:4px;}
.home-list h1{font-size:20px; color:#fff; padding:7px 0px 0px; margin:0px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.home-list h2{font-size:14px; color:#999; font-weight:normal; margin:0px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
</style>
</head>
<body>
<ul class="tabs"><li><a href="/radio" class="<?php echo !self::$path[0]?'active':''?>"><span>กรุงเทพมหานคร</span></a></li><li><a href="/radio/apps" class="<?php echo self::$path[0]=='apps'?'active':''?>"><span>แอพแนะนำ</span></a></li></ul>

<?php echo $this->data['content']?>
</body>
</html>
