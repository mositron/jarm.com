<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" lang="th" xml:lang="th">
<head>
<meta charset="UTF-8" />
<title><?php echo $this->data['title']?></title>
<meta name="Description" content="<?php echo $this->data['description']?>" />
<meta name="Keywords" content="<?php echo $this->data['keywords']?>" />
<meta name="Copyright" content="<?php echo self::$conf['domain']?>" />
<meta name="google-site-verification" content="FJ3DhHStMNIffQ42XF_QTInRPNZzzQNGSI16TXvqzVs" />
<meta name="google-site-verification" content="sE3ogQILu7zo-F16GGoUACs67CBA5_JeY033Owa86Xw" />
<meta name="google-site-verification" content="j9r7dcU4J0Zk8YIhUIShU59esQVQvgq-sPPv1HjLSTY" />
<meta property="article:author" content="<?php echo self::$conf['social']['facebook']['pageurl']?>" />
<meta property="fb:pages" content="<?php echo self::$conf['social']['facebook']['pageid']?>" />
<meta property="fb:app_id" content="<?php echo self::$conf['social']['facebook']['appid']?>" />
<meta property="og:type" content="<?php echo $this->data['type']?>" />
<meta property="og:title" content="<?php echo $this->data['title']?>" />
<meta property="og:image" content="<?php echo $this->data['image']?>" />
<meta property="og:url" content="<?php echo URI?>" />
<link rel="canonical" href="<?php echo self::$core->data['canonical']?:URI?>" />
<meta property="og:site_name" content="<?php echo $this->data['sitename']?>" />
<meta property="og:description" content="<?php echo $this->data['description']?>" />
<meta property="og:locale" content="th_TH" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300&amp;subset=latin-ext,thai,vietnamese">
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/jarm-all.css" />
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo FILES_CDN?>img/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo FILES_CDN?>img/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo FILES_CDN?>img/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo FILES_CDN?>img/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo FILES_CDN?>img/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo FILES_CDN?>img/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo FILES_CDN?>img/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo FILES_CDN?>img/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo FILES_CDN?>img/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo FILES_CDN?>img/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo FILES_CDN?>img/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo FILES_CDN?>img/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo FILES_CDN?>img/favicon/favicon-16x16.png">
<link rel="icon" type="image/x-icon" href="<?php echo FILES_CDN?>img/favicon/favicon.ico" />
<link rel="manifest" href="<?php echo FILES_CDN?>img/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#FFFFFF">
<meta name="msapplication-TileImage" content="<?php echo FILES_CDN?>img/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#FFFFFF">
<link rel="alternate" type="application/rss+xml" title="<?php echo $this->data['feed']['title']?>" href="<?php echo $this->data['feed']['url']?>" />
<script type="text/javascript" src="<?php echo FILES_CDN?>js/jarm-all.js"></script>
<!--[if lt IE 9]>
<script src="<?php echo FILES_CDN?>js/html5shiv/html5shiv.js"></script>
<![endif]-->
<link href="https://plus.google.com/+BoxzaOnline" rel="publisher" />
<script type="text/javascript" async defer src="https://apis.google.com/js/platform.js?publisherid=115817126393353079017">{lang: 'th'}</script>
<script type='text/javascript'>
  var crtg_nid = '4825';
  var crtg_cookiename = 'crtg_rta';
  var crtg_varname = 'crtg_content';
  function crtg_getCookie(c_name){ var i,x,y,ARRCookies=document.cookie.split(";");for(i=0;i<ARRCookies.length;i++){x=ARRCookies[i].substr(0,ARRCookies[i].indexOf("="));y=ARRCookies[i].substr(ARRCookies[i].indexOf("=")+1);x=x.replace(/^\s+|\s+$/g,"");if(x==c_name){return unescape(y);} }return'';}
  var crtg_content = crtg_getCookie(crtg_cookiename);
  var crtg_rnd=Math.floor(Math.random()*99999999999);
  (function(){
  var crtg_url=location.protocol+'//rtax.criteo.com/delivery/rta/rta.js?netId='+escape(crtg_nid);
  crtg_url +='&cookieName='+escape(crtg_cookiename);
  crtg_url +='&rnd='+crtg_rnd;
  crtg_url +='&varName=' + escape(crtg_varname);
  var crtg_script=document.createElement('script');crtg_script.type='text/javascript';crtg_script.src=crtg_url;crtg_script.async=true;
  if(document.getElementsByTagName("head").length>0)document.getElementsByTagName("head")[0].appendChild(crtg_script);
  else if(document.getElementsByTagName("body").length>0)document.getElementsByTagName("body")[0].appendChild(crtg_script);
  })();
  </script>
  <script type='text/javascript'>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
  googletag.cmd.push(function() {
    var crtg_split = (crtg_content || '').split(';');
    var pubads = googletag.pubads();
    for (var i=1;i<crtg_split.length;i++){
      pubads.setTargeting("" + (crtg_split[i-1].split('='))[0] + "", "" + (crtg_split[i-1].split('='))[1] + "");
    }
  });
</script>
<?php if(!$this->data['hide_adsense']):?>
<script type='text/javascript'>
  var googletag = googletag || {};
  googletag.cmd = googletag.cmd || [];
  (function() {
    var gads = document.createElement('script');
    gads.async = true;
    gads.type = 'text/javascript';
    var useSSL = 'https:' == document.location.protocol ;
    gads.src = (useSSL ? 'https:' : 'http:') +
      '//www.googletagservices.com/tag/js/gpt.js';
    var node = document.getElementsByTagName('script')[0];
    node.parentNode.insertBefore(gads, node);
  })();
  googletag.cmd.push(function() {
    var w=$(document).width();
    if(w>970)
    {
      googletag.defineSlot('/52288173/LeaderBoard', [[970, 90], [728, 90], [468, 60], [320, 50], [300, 100]], 'div-gpt-ad-1475485285325-0').addService(googletag.pubads());
      googletag.defineSlot('/52288173/320x100-1', [[468, 60], [320, 50], [300, 100], [300, 75], [300, 50]], 'div-gpt-ad-1473244406891-0').addService(googletag.pubads());
    }
    else if(w>470)
    {
      googletag.defineSlot('/52288173/LeaderBoard', [[468, 60], [320, 50], [300, 100]], 'div-gpt-ad-1475485285325-0').addService(googletag.pubads());
      googletag.defineSlot('/52288173/320x100-1', [[468, 60], [320, 50], [300, 100], [300, 75], [300, 50]], 'div-gpt-ad-1473244406891-0').addService(googletag.pubads());
    }
    else
    {
      googletag.defineSlot('/52288173/LeaderBoard', [[320, 50], [300, 100]], 'div-gpt-ad-1475485285325-0').addService(googletag.pubads());
      googletag.defineSlot('/52288173/320x100-1', [[320, 50], [300, 100], [300, 75], [300, 50]], 'div-gpt-ad-1473244406891-0').addService(googletag.pubads());
    }
    googletag.defineSlot('/52288173/336x280-1', [[336, 280], [300, 250]], 'div-dfp-336x280-1').addService(googletag.pubads());
    googletag.defineSlot('/52288173/336x280-2', [[336, 280], [300, 250]], 'div-dfp-336x280-2').addService(googletag.pubads());
    googletag.defineSlot('/52288173/336x280-3', [[336, 280], [300, 250]], 'div-dfp-336x280-3').addService(googletag.pubads());
    googletag.defineSlot('/52288173/336x280-4', [[336, 280], [300, 250]], 'div-dfp-336x280-4').addService(googletag.pubads());
    googletag.defineSlot('/52288173/336x280-5', [[336, 280], [300, 250]], 'div-dfp-336x280-5').addService(googletag.pubads());
    googletag.defineSlot('/52288173/336x280-6', [[336, 280], [300, 250]], 'div-dfp-336x280-6').addService(googletag.pubads());
    googletag.defineSlot('/52288173/336x280-7', [[336, 280], [300, 250]], 'div-dfp-336x280-7').addService(googletag.pubads());
    googletag.defineSlot('/52288173/336x280-8', [[336, 280], [300, 250]], 'div-dfp-336x280-8').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.pubads().collapseEmptyDivs();
    googletag.enableServices();
  });
</script>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-8383574629063856",
    enable_page_level_ads: true
  });
</script>
<?php endif?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '723126181102933');
fbq('track', '<?php echo $this->data['pixel']??'PageView'?>');
</script>
<!-- End Facebook Pixel Code -->
<script>$(document).ready(function(){setTimeout(function(){$('#_pgb').css('display','none');},10);});</script>
</head>
<body class="body-<?php echo $name=strtolower(self::$sub)?> body-<?php echo $name?>-<?php echo self::$path[0]??'home'?>"><div id="_pgb"><div><p></p><p></p><p></p></div></div>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=723126181102933&ev=<?php echo $this->data['pixel']??'PageView'?>&noscript=1" /></noscript>
<div id="wrap">
  <div id="nav-slide">
    <div class="-top">
      <h3>MENU<a href="javascript:;" class="-close pull-right"><span class="glyphicon glyphicon-remove"></span></a></h3>
      <ul>
        <?php if($this->data['nav-fixed']):?>
        <?php echo $this->data['nav-fixed'][1]?>
        <li class="divider"></li>
        <?php endif?>
        <?php if(self::$my):?>
        <li><a href="<?php echo self::uri(['my'])?>">แผงควบคุม</a></li>
        <li><a href="<?php echo self::$my['link']?>">- โปรไฟล์ส่วนตัว</a></li>
        <li><a href="<?php echo self::uri(['my','/settings'])?>">- ตั้งค่าการใช้งาน</a></li>
        <li><a href="<?php echo self::uri(['oauth','/logout'])?>"> ออกจากระบบ</a></li>
        <?php if(self::$my['am']):?>
        <li class="divider"></li>
        <li><a href="<?php echo self::uri(['control'])?>">ระบบควบคุม(ผู้ดูแล)</a></li>
        <li><a href="<?php echo self::uri(['control','/news'])?>">- เขียนข่าว</a></li>
        <li><a href="<?php echo self::uri(['control','/lotto'])?>">- ตรวจหวย</a></li>
        <?php endif?>
        <?php elseif(self::$app=='oauth'):?>
        <li><a href="<?php echo self::uri(['oauth','/signup?'.$_SERVER['QUERY_STRING']])?>">สมัครสมาชิก</a></li>
        <li><a href="<?php echo self::uri(['oauth','/login?'.$_SERVER['QUERY_STRING']])?>">ล็อคอิน</a></li>
        <?php else:?>
        <li><a href="<?php echo self::uri(['oauth','/signup?redirect_uri='.urlencode(URI)])?>">สมัครสมาชิก</a></li>
        <li><a href="<?php echo self::uri(['oauth','/login?redirect_uri='.urlencode(URI)])?>">ล็อคอิน</a></li>
        <?php endif?>
        <li class="divider"></li>
        <li><a href="<?php echo self::uri([''])?>" title="<?php echo self::$conf['domain']?>">หน้าแรก</a></li>
        <li><a href="<?php echo self::uri(['news'])?>" title="ข่าว ข่าววันนี้ ข่าวเด่น ข่าวด่วน ข่าวสด ข่าวตามกระแส">ข่าววันนี้</a></li>
        <li><a href="<?php echo self::uri(['ent'])?>" title="ข่าวบันเทิง ดารา บันเทิง ข่าวดารา ซุบซิบดารา ติดกระแสดารา ภาพหลุดดารา">ข่าวบันเทิง</a></li>
        <li><a href="<?php echo self::uri(['korea'])?>" title="เกาหลี ดาราเกาหลี นักร้องเกาหลี ซีรีย์เกาหลี ข่าวเกาหลี">ข่าวเกาหลี</a></li>
        <li class="divider"></li>
        <li><a href="<?php echo self::uri(['live'])?>" title="Facebook Live - ถ่ายทอดสด">ถ่ายทอดสด</a></li>
        <li><a href="<?php echo self::uri(['english'])?>" title="ฝึกคำศัพท์ ท่องศัพท์ ภาษาอังกฤษ 300 คำ">คำศัพท์ภาษาอังกฤษ</a></li>
        <li><a href="<?php echo self::uri(['knowledge'])?>" title="เกร็ดความรู้ สาระน่ารู้">เกร็ดความรู้</a></li>
        <li><a href="<?php echo self::uri(['eat'])?>" title="อาหาร ร้านอาหาร เมนูอาหาร">อาหาร</a></li>
        <li><a href="<?php echo self::uri(['beauty'])?>" title="ผู้หญิง แฟนชั่น">ผู้หญิง</a></li>
        <li><a href="<?php echo self::uri(['healthy'])?>" title="สุขภาพ">สุขภาพ</a></li>
        <li><a href="<?php echo self::uri(['home'])?>" title="บ้านและสวน">บ้านและสวน</a></li>
        <li><a href="<?php echo self::uri(['tech'])?>" title="เทคโนโลยี ข่าวไอที">เทคโนโลยี</a></li>
        <li><a href="<?php echo self::uri(['lotto'])?>" title="หวย ตรวจหวย เลขเด็ด">ตรวจหวย</a></li>
        <li><a href="<?php echo self::uri(['lotto','/set'])?>" title="หวยหุ้น หวยหุ้นวันนี้">หวยหุ้น</a></li>
        <li><a href="<?php echo self::uri(['movie'])?>" title="หนัง หนังใหม่ ดูหนังออนไลน์ หนังเข้าใหม่">หนังใหม่</a></li>
        <li><a href="<?php echo self::uri(['music'])?>" title="เพลง เพลงใหม่ เนื้อเพลง">เพลงใหม่</a></li>
        <li><a href="<?php echo self::uri(['radio'])?>" title="ฟังวิทยุออนไลน์">วิทยุออนไลน์</a></li>
        <li><a href="<?php echo self::uri(['horo'])?>" title="ดูดวง ดูดวงรายวัน ดูดวงความรัก ทำนายฝัน">ดูดวง</a></li>
        <li><a href="<?php echo self::uri(['horo','/phone'])?>" title="ดูดวงเบอร์โทรศัพท์ เบอร์มือถือ">ดูดวงเบอร์โทรศัพท์</a></li>
        <li><a href="<?php echo self::uri(['weather'])?>" title="พยากรณ์อากาศ สภาพอากาศ">พยากรณ์อากาศ</a></li>
        <li><a href="<?php echo self::uri(['game'])?>" title="เกมส์ เกม เกมส์ออนไลน์">เกมส์</a></li>
        <li><a href="<?php echo self::uri(['guess'])?>" title="เกมทายใจ เกมส์วัดดวง เกมเฟสบุ๊ค เกมทายนิสัย เกมตลก เกมฮาฮา">เกมทายใจ</a></li>
        <li><a href="<?php echo self::uri(['tv'])?>" title="ทีวีย้อนหลัง ละครย้อนหลัง">ทีวีย้อนหลัง</a></li>
        <li><a href="<?php echo self::uri(['gold'])?>" title="ราคาทอง ราคาทองคำวันนี้">ราคาทองวันนี้</a></li>
        <li><a href="<?php echo self::uri(['feed'])?>" title="RSS Feed">RSS Feed</a></li>
      </ul>
    </div>
    <div class="-bottom"></div>
  </div>
  <div id="navbar-header" class="navbar-fixed-top">
    <!--style>body{padding-top: 0px;}#navbar-header{margin-bottom:10px;}</style>
    <div style="background:#62C1ED;text-align:center"><img src="https://static.jarm.com/img/global/mom-day.jpg" class="img-responsive" style="margin:0px auto;"></div-->
    <div class="container">
      <button type="button" class="navbar-toggle collapsed">
        <span class="icon-bar icon-bar-top"></span>
        <span class="icon-bar icon-bar-middle"></span>
        <span class="icon-bar icon-bar-bottom"></span>
      </button>
      <a class="navbar-brand" href="<?php echo self::uri([''])?>" title="Jarm.com"></a>
      <nav role="navigation"<?php if($this->data['nav-fixed']):?> class="have-nav-fixed"<?php endif?>>
        <ul class="nav navbar-nav pull-left">
          <li class="nav-news-today"><a href="<?php echo self::uri(['news'])?>" title="ข่าววันนี้">ข่าววันนี้</a></li>
          <li class="nav-news-ent"><a href="<?php echo self::uri(['ent'])?>" title="ข่าวบันเทิง ข่าวดารา">ข่าวบันเทิง</a></li>
          <li class="nav-news-korea"><a href="<?php echo self::uri(['korea'])?>" title="ข่าวเกาหลี">ข่าวเกาหลี</a></li>
          <li class="nav-search"><form action="<?php echo self::uri(['search'])?>" method="get"><input type="text" name="q" placeholder="ค้นหา" class="hsearch ev"><button type="submit" class="glyphicon glyphicon-search"></button></form></li>
        </ul>
        <ul class="nav navbar-nav pull-right">
          <?php if($this->data['nav-fixed']):?>
            <li class="dropdown-fixed"><?php echo $this->data['nav-fixed'][0]?></li>
          <?php endif?>
          <?php if(self::$my):?>
            <li><a href="<?php echo self::$my['link']?>" rel="setting" class="dropdown-toggle" data-toggle="dropdown">เมนูสมาชิก <span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu">
              <li><a href="<?php echo self::uri(['my'])?>">แผงควบคุม</a></li>
              <li><a href="<?php echo self::$my['link']?>">- โปรไฟล์ส่วนตัว</a></li>
              <li><a href="<?php echo self::uri(['my','/settings'])?>">- ตั้งค่าการใช้งาน</a></li>
              <li class="divider"></li>
              <?php if(self::$my['am']):?>
              <li><a href="<?php echo self::uri(['control'])?>">ระบบควบคุม(ผู้ดูแล)</a></li>
              <li><a href="<?php echo self::uri(['control','/news'])?>">- เขียนข่าว</a></li>
              <li><a href="<?php echo self::uri(['control','/lotto'])?>">- ตรวจหวย</a></li>
              <li class="divider"></li>
              <?php endif?>
              <li><a href="<?php echo self::uri(['oauth','/logout'])?>"> ออกจากระบบ</a></li>
            </ul>
          </li>
          <?php elseif(self::$app=='oauth'):?>
          <li><a href="<?php echo self::uri(['oauth','/signup?'.$_SERVER['QUERY_STRING']])?>">สมัครสมาชิก</a></li>
          <li><a href="<?php echo self::uri(['oauth','/login?'.$_SERVER['QUERY_STRING']])?>">ล็อคอิน</a></li>
          <?php else:?>
          <li><a href="<?php echo self::uri(['oauth','/signup?redirect_uri='.urlencode(URI)])?>">สมัครสมาชิก</a></li>
          <li><a href="<?php echo self::uri(['oauth','/login?redirect_uri='.urlencode(URI)])?>">ล็อคอิน</a></li>
          <?php endif?>
        </ul>
      </nav>
    </div>
  </div>
  <div class="container">
    <?php if(!empty($this->data['banner']['a'])):?>
    <!-- BEGIN - BANNER : A -->
    <div class="_banner _banner-a"><?php echo $this->data['banner']['a']?></div>
    <!-- END - BANNER : A -->
    <div class="_banner _banner-l" id="jarm_b_l" style="display:none"></div>
    <div class="_banner _banner-r" id="jarm_b_r" style="display:none"></div>
  <?php elseif(!$this->data['hide_adsense']):?>
    <!-- /52288173/LeaderBoard -->
    <div style="margin:0px -5px;"><div id='div-gpt-ad-1475485285325-0' style="padding:15px 0px;text-align:center;margin:0px auto"><script>googletag.cmd.push(function() { googletag.display('div-gpt-ad-1475485285325-0'); });</script></div></div>
    <?php endif?>
  </div>
  <?php if($this->data['nav-header']):?>
  <div id="nav-header"><div class="container"><?php echo $this->data['nav-header']?></div></div>
  <?php endif?>
  <div class="container" id="content">
    <?php if($this->data['div_row']):?>
    <div class="row col-one">
      <?php echo $this->data['content']?>
    </div>
    <?php else:?>
    <?php echo $this->data['content']?>
    <?php endif?>
  </div>
  <div class="footer">
    <?php if(!empty($this->data['banner']['f'])):?>
    <div class="container">
      <div style="text-adivgn:center; overflow:hidden; line-height:0px;padding:20px 10px; text-align:center;">
        <!-- BEGIN - BANNER : F -->
        <div class="_banner _banner-f"><?php echo $this->data['banner']['f']?></div>
        <!-- END - BANNER : F -->
      </div>
    </div>
    <div style="height:2px;overflow:hidden;border-top:1px solid #222;border-bottom: 1px solid #393939;box-sizing: border-box;margin-bottom: 20px;"></div>
    <?php endif?>
    <div class="l2">
      <div class="container">
        <div class="pull-left text-left"><span class="hidden-xs">ติดต่อลง</span>โฆษณา: 0880-900-800<span class="hidden-xs">, </span><span class="visible-xs"></span>อีเมล์: ads@jarm.com<br>แนะนำติชม<span class="hidden-xs">/ฝากข่าวประชาสัมพันธ์</span>: info@jarm.com<br>&copy; 2017 jarm.com<span class="hidden-xs">, All Rights Reserved.</span></div>
      </div>
    </div>
  </div>
</div>
<div id="fb-root"></div>
<?php if($this->data['sc-bottom']):?>
<div id="sc-bottom">
  <div>
    <p>ติดตามเราจากช่องทางอื่นๆ</p>
    <div class="row sc-row">
      <div class="col-xs-3 sc-fb"><a href="https://www.facebook.com/jarm/" target="blank"><span><i></i>Facebook</span></a></div>
      <div class="col-xs-3 sc-yt"><a href="https://www.youtube.com/channel/UCiRcAr47LLBJU43mfJ2cgLg" target="blank"><span><i></i>Youtube</span></a></div>
      <div class="col-xs-3 sc-tw"><a href="https://twitter.com/jarm_news" target="blank"><span><i></i>Twitter</span></a></div>
      <div class="col-xs-3 sc-ig"><a href="https://www.instagram.com/jarm/" target="blank"><span><i></i>Instagram</span></a></div>
    </div>
  </div>
</div>
<?php endif?>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.9&appId=<?php echo self::$conf['social']['facebook']['appid']?>";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-31362918-1', 'jarm.com');
ga('send', 'pageview');
</script>
<!--script type="text/javascript" src="https://cdn.jarm.com/js/snowstorm/snowstorm-min.js"></script>
<script>
snowStorm.usePositionFixed = true;
snowStorm.zIndex = 9;
snowStorm.excludeMobile = false;
</script-->
</body>
</html>
