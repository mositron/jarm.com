<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#" lang="th" xml:lang="th">
<head>
<meta charset="UTF-8">
<title><?php echo Load::$core->data['title']?></title>
<meta name="Description" content="<?php echo Load::$core->data['description']?>" />
<meta name="Keywords" content="<?php echo Load::$core->data['keywords']?>" />
<meta name="Copyright" content="jarm.com" />
<meta name="google-site-verification" content="hSfRFCcDswWyu5qloNfX7fM9e7-7ok-Al6KFIyVphJA" />
<meta property="fb:pages" content="229722963822965" />
<meta property="fb:app_id" content="<?php echo Load::$conf['social']['facebook']['appid']?>" />
<meta property="og:type" content="<?php echo Load::$core->data['type']?>" />
<meta property="og:title" content="<?php echo Load::$core->data['title']?>" />
<meta property="og:image" content="<?php echo Load::$core->data['image']?>" />
<meta property="og:url" content="<?php echo URI?>" />
<link rel="canonical" href="<?php echo URI?>" />
<meta property="og:site_name" content="<?php echo Load::$core->data['sitename']?>" />
<meta property="og:description" content="<?php echo Load::$core->data['description']?>" />
<meta property="og:locale" content="th_TH" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>js/ui/jquery-ui-1.10.1.custom.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>js/icheck/skins/square/blue.css" />
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/ionicons/css/ionicons.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/awesome/css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>js/fullcalendar/fullcalendar.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>js/switchery/switchery.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>css/jarm-all.css" />
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/jarm.ico" />
<link rel="alternate" type="application/rss+xml" title="<?php echo Load::$core->data['feed']['title']?>" href="<?php echo Load::$core->data['feed']['url']?>" />
<script type="text/javascript" src="<?php echo FILES_CDN?>js/jarm-all.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/ui/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/icheck/icheck.min.js"></script>
<link href="<?php echo FILES_CDN?>js/chosen/chosen.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo FILES_CDN?>js/chosen/chosen.jquery.min.js"></script>
<link href="<?php echo FILES_CDN?>js/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo FILES_CDN?>js/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/inputmask/js/inputmask.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/inputmask/js/jquery.inputmask.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/switchery/switchery.min.js"></script>
<script>window.tinyMCEPreInit = {suffix:'.min',base:'/_cdn/js/tinymce'};</script>
<script type="text/javascript" src="/_cdn/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/_cdn/js/tinymce/jquery.tinymce.min.js"></script>

<!--[if lt IE 9]>
<script src="<?php echo FILES_CDN?>js/html5shiv/html5shiv.js"></script>
<![endif]-->
<link href="https://plus.google.com/+BoxzaOnline" rel="publisher" />
<script type="text/javascript" async defer
  src="https://apis.google.com/js/platform.js?publisherid=115817126393353079017">
  {lang: 'th'}
</script>
<style>
body{background:#e9eaed;}
._ctn{margin:0px auto;width:976px;box-sizing:content-box;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;padding-right:205px;position:relative;}
.mn-team{border-top:1px solid #ddd;border-bottom:1px solid #f3f3f3;margin:1px 0px;}
.mn-team>li>a{display:block;height:30px;line-height:30px;border-top:1px solid #f3f3f3;border-bottom:1px solid #ddd;font-size:14px;padding:0px 10px 0px 7px;}
.mn-team>li>a>.glyphicon{margin-right:5px;color:#999;}
.mn-team>li>a:hover .glyphicon{color:#333;}
.mn-team li.active>a{color:#f60;}
.mn-team li.active>a>.glyphicon{color:#f60;}
.mn-team li.active>a:hover>.glyphicon{color:#f50;}

.mn-team>li>ul a{display:block;height:28px;line-height:28px;border-top:1px solid #f3f3f3;border-bottom:1px solid #ddd;font-size:14px;padding:0px 5px 0px 23px;}
.mn-team>li>ul a>.glyphicon{margin-right:5px;color:#ccc;}
.mn-team>li>ul a:hover .glyphicon{color:#999;}
.mn-team>li>ul a .fa{margin-right: 7px;}
.mn-team>li>ul .pull-right{margin-top:7px;font-size:8px;}
.box-white{padding:10px;background:#fff;border-radius:4px;}
#team{text-align:center;}
#team:after,._ctn:after{display:block;content:"";clear:both}
#team-content{text-align:left;float:left;margin:0px 0px 0px 10px;width:790px;}
a,a:link,a:focus{text-decoration: none;}

.bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body{background-color: #00c0ef !important;}
.bg-maroon{background-color: #d81b60 !important;}
.bg-orange{background-color: #ff851b !important;}
.bg-purple{background-color: #605ca8 !important;}
.bg-yellow{background-color: #f39c12 !important;color: #fff !important}
.bg-green{background-color: #00a65a !important;color: #fff !important}
.bg-red{background-color:#dd4b39 !important;color: #fff !important}

.label-status-0{background-color: #00c0ef !important;}
.label-status-1{background-color: #f0ad4e !important;}
.label-status-2{background-color: #d9534f !important;}
.label-status-3{background-color: #f0ad4e !important;}
.label-status-4{background-color: #d9534f !important;}
.label-status-5{background-color: #ff851b !important;}
.label-status-6{background-color: #d81b60 !important;}
.label-status-7{background-color: #d81b60 !important;}
.label-status-8{background-color: #5cb85c !important;}
.label-status-9{background-color: #000 !important;}
.label-status-all{background-color: #605ca8 !important;}
.label-form-1{background-color: #7cad56 !important;}
.label-form-2{background-color: #6698cc !important;}
.label-type-1{background-color: #9a12ab !important;}
.label-type-2{background-color: #be0b6c !important;}

th.tb-col-date{width:125px;}
td.tb-col-date{font-size:12px;width:125px;}
th.tb-col-price,td.tb-col-price{text-align:right;width:90px;}

.btn-outline{border:1px solid #fff;background:transparent;color:#fff;}
.modal-warning .modal-header, .modal-warning .modal-footer {background-color:#db8b0b !important;color:#fff !important;border-color:#c87f0a;}
.modal-warning .modal-body{background-color:#f39c12 !important;color:#fff !important;}
.modal-danger .modal-header,.modal-danger .modal-footer{background-color:#d33724 !important;color:#fff !important;border-color:#c23321;}
.modal-danger .modal-body{background-color:#dd4b39 !important;color:#fff !important;}
.modal-title{color: inherit;}

.chosen-container{padding:5px 0px 0px 0px;}
select.form-control + .chosen-container.chosen-container-single .chosen-single{display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.428571429;color: #555;vertical-align: middle;background-color: #fff;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);-webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;background-image:none;}
select.form-control + .chosen-container.chosen-container-single .chosen-single div{top:4px;color:#000;}
select.form-control + .chosen-container .chosen-drop{background-color: #FFF;border: 1px solid #CCC;border: 1px solid rgba(0, 0, 0, 0.15);border-radius: 4px;-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);background-clip: padding-box;margin: 2px 0 0;}
select.form-control + .chosen-container .chosen-search input[type=text] {display: block;width: 100%;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.428571429;color: #555;vertical-align: middle;background-color: #FFF;border: 1px solid #CCC;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);-webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;background-image:none;}
select.form-control + .chosen-container .chosen-results{margin: 2px 0 0;padding: 5px 0;font-size: 14px;list-style: none;background-color: #fff;margin-bottom: 5px;}
select.form-control + .chosen-container .chosen-results li ,
select.form-control + .chosen-container .chosen-results li.active-result{display: block;padding: 3px 20px;clear: both;font-weight: normal;line-height: 1.428571429;color: #333;white-space: nowrap;background-image:none;}
select.form-control + .chosen-container .chosen-results li:hover,
select.form-control + .chosen-container .chosen-results li.active-result:hover,
select.form-control + .chosen-container .chosen-results li.highlighted{color: #FFF;text-decoration: none;background-color: #428BCA;background-image:none;}
select.form-control + .chosen-container-multi .chosen-choices{display: block;width: 100%;min-height: 34px;padding: 6px;font-size: 14px;line-height: 1.428571429;color: #555;vertical-align: middle;background-color: #FFF;border: 1px solid #CCC;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);-webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;background-image:none;}
select.form-control + .chosen-container-multi .chosen-choices li.search-field input[type="text"]{height:auto;padding:5px 0;}
select.form-control + .chosen-container-multi .chosen-choices li.search-choice{background-image: none;padding: 3px 24px 3px 5px;margin: 0 6px 0 0;font-size: 14px;font-weight: normal;line-height: 1.428571429;text-align: center;white-space: nowrap;vertical-align: middle;cursor: pointer;border: 1px solid #ccc;border-radius: 4px;color: #333;background-color: #FFF;border-color: #CCC;}
select.form-control + .chosen-container-multi .chosen-choices li.search-choice .search-choice-close{top:8px;right:6px;}
select.form-control + .chosen-container-multi.chosen-container-active .chosen-choices,
select.form-control + .chosen-container.chosen-container-single.chosen-container-active .chosen-single,
select.form-control + .chosen-container .chosen-search input[type=text]:focus{border-color:#66AFE9;outline:0;-webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.075),0 0 8px rgba(102, 175, 233, 0.6);box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.075),0 0 8px rgba(102, 175, 233, 0.6);}
select.form-control + .chosen-container-multi .chosen-results li.result-selected{display:list-item;color:#ccc;cursor:default;background-color:white;}


.timeline{position:relative;margin:0 0 30px 0;padding:0;list-style:none}
.timeline:before{content:'';position:absolute;top:0px;bottom:0;width:4px;background:#ddd;left:31px;margin:0;border-radius:2px}
.timeline>li{position:relative;margin-right:10px;margin-bottom:15px}
.timeline>li:before,.timeline>li:after{content:" ";display:table}
.timeline>li:after{clear:both}
.timeline>li>.timeline-item{-webkit-box-shadow:0 1px 1px rgba(0,0,0,0.1);box-shadow:0 1px 1px rgba(0,0,0,0.1);border-radius:3px;margin-top:0px;background:#fff;color:#444;margin-left:60px;margin-right:15px;padding:0;position:relative}
.timeline>li>.timeline-item>.time{color:#999;float:right;padding:10px;font-size:12px}
.timeline>li>.timeline-item>.timeline-header{margin:0;color:#555;border-bottom:1px solid #f4f4f4;padding:10px;font-size:16px;line-height:1.1}
.timeline>li>.timeline-item>.timeline-header>a{font-weight:600}
.timeline>li>.timeline-item>.timeline-body,.timeline>li>.timeline-item>.timeline-footer{padding:10px}
.timeline>li.time-label>span{font-weight:600;padding:5px;display:inline-block;background-color:#fff;border-radius:4px}
.timeline>li>.fa,.timeline>li>.glyphicon,.timeline>li>.ion{width:30px;height:30px;font-size:15px;line-height:30px;position:absolute;color:#666;background:#d2d6de;border-radius:50%;text-align:center;left:18px;top:0}
.timeline>.time-label>span{font-weight:600;padding:5px;display:inline-block;background-color:#fff;border-radius:4px}
.timeline-inverse>li>.timeline-item{background:#f0f0f0;border:1px solid #ddd;-webkit-box-shadow:none;box-shadow:none}
.timeline-inverse>li>.timeline-item>.timeline-header{border-bottom-color:#ddd}

</style>
<script>
var his={},lasturl='';
_.url='<?php echo URL?>';
$(function(){
  $('body').on('click','a',function(e){
    var url=$(this).attr('href');
    if(url && url.substr(0,1)=='/')
    {
      e.preventDefault();
      if(lasturl!=url)
      {
        lasturl=url;
        window.history.pushState({url:url}, '', url);
      }
      _getdata(url);
    }
  });
});

window.onpopstate = function(e){
  if(e.state)
  {
    _getdata(e.state.url);
  }
};

function _getdata(url)
{
  $('.modal-backdrop').remove();
  if(arguments.length>1)
  {
    if(lasturl!=url)
    {
      lasturl=url;
      window.history.pushState({url:url}, '', url);
    }
  }
  $('.mn-team small').remove();
  var p=url.split('/');
  $('.mn-team>li>a[href="/'+p[1]+'"]').append('<small class="pull-right" style="margin:-1px -3px 0px 0px"> <span class="fa fa-refresh fa-spin"></span></small>');
  $.getJSON('/_'+url, function(data) {
    $('.mn-team small').remove();
    $.each(data, function(key, val){
      switch(key)
      {
        case 'redirect':
          window.location.href=val;
          break;
        case 'title':
          document.title=val;
          break;
        case 'script':
          $.globalEval(val);
          break;
        case 'url':
          _.url=val;
          break;
        case 'content':
          his[url]=val;
          $('#team-content').html(val);
          $('html,body').animate({scrollTop:0}, 500,'easeOutExpo');
          break;
        case 'module':
          $('.mn-team>li.active').removeClass('active');
          $('.mn-team>li>a[href="/'+val+'"]').parent().addClass('active');
          break;
        default:
          $(key).html(val);
      }
    });
  });
}
</script>
</head>
<body class="body-<?php echo Load::$sub?> body-<?php echo Load::$sub?>-<?php echo MODULE?>">
<div id="navbar-header" class="navbar-fixed-top">
    <div class="_ctn">
	    <a class="navbar-brand" href="http://jarm.com/" title="Jarm"></a>
        <nav role="navigation"><!-- collapse navbar-collapse bs-navbar-collapse -->
          <ul class="nav navbar-nav pull-left">
          	<span></span>
          	<li><a href="/" title="Boxza Team">Team</a></li>
          </ul>
          <ul class="nav navbar-nav pull-right">
            <li class="notify_setting hidden-xs"><a href="<?php echo Load::$my['link']?>" rel="setting" class="dropdown-toggle" data-toggle="dropdown">เมนูสมาชิก <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                    <li><a href="/user/<?php echo team::$my['_id']?>">โปรไฟล์ส่วนตัว</a></li>
                    <li class="divider"></li>
                    <li><a href="'.Load::uri(['team','/oauth/logout']).'"> ออกจากระบบ</a></li>
                </ul>
            </li>
          </ul>
        </nav>
    </div>
</div>
<div id="team">
  <div class="_ctn">
    <div style="width:175px;float:left;text-align:left;overflow:hidden">
      <ul>
        <li><a href="/user/<?php echo team::$my['_id']?>"><img src="<?php echo team::$my['img']?>" style="width:16px;height:16px;" /> <?php echo team::$my['name']?></a></li>
      </ul>
      <h4 class="bar-heading">Team</h4>
      <ul class="mn-team">
        <li<?php echo MODULE_LINK=='user'?' class="active"':''?>><a href="/user"><span class="glyphicon glyphicon-user"></span> สมาชิก</a></li>
        <li<?php echo MODULE_LINK=='announce'?' class="active"':''?>><a href="/announce"><span class="glyphicon glyphicon-bullhorn"></span> ประกาศ</a></li>
        <li<?php echo MODULE_LINK=='report'?' class="active"':''?>><a href="/report"><span class="glyphicon glyphicon-calendar"></span> รายงาน</a></li>
        <li<?php echo MODULE_LINK=='meeting'?' class="active"':''?>><a href="/meeting"><span class="glyphicon glyphicon-certificate"></span> การประชุม</a></li>
        <li<?php echo MODULE_LINK=='queue'?' class="active"':''?>><a href="/queue"><span class="glyphicon glyphicon-sort-by-alphabet"></span> คิวงาน</a>
          <ul id="mn-team-queue"><?php echo $this->hash['#mn-team-queue']?></ul>
        </li>
        <li<?php echo MODULE_LINK=='queue-sale'?' class="active"':''?>><a href="/queue-sale"><span class="glyphicon glyphicon-sort-by-order"></span> คิวงาน - ฝ่ายขาย</a></li>
        <li<?php echo MODULE_LINK=='customer'?' class="active"':''?>><a href="/customer"><span class="glyphicon glyphicon-copyright-mark"></span> ข้อมูลลูกค้า</a></li>
        <li<?php echo MODULE_LINK=='withdraw'?' class="active"':''?>><a href="/withdraw"><span class="glyphicon glyphicon-bitcoin"></span> เบิกเงิน</a>
        <ul id="mn-team-withdraw"><?php echo $this->hash['#mn-team-withdraw']?></ul>
        </li>
        <li<?php echo MODULE_LINK=='manual'?' class="active"':''?>><a href="/manual"><span class="glyphicon glyphicon-book"></span> คู่มือ</a></li>
      </ul>
    </div>
    <div id="team-content">
      <?php echo Load::$core->data['content'];?>
    </div>
  </div>
  <div id="chat-body" style="width:205px;position:fixed;right:0px;top:0px;height:100%;background-clip:padding-box;background-color:#e9eaed;box-shadow:1px 0 0 #f0f0f2 inset;border-left:1px solid #ccc;">
    <div style="padding-top:50px;">chat</div>
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
