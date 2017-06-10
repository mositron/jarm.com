<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Jarm.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jarm.com/css/jarm-all.css" />
  <script type="text/javascript" src="https://cdn.jarm.com/js/jarm-all.js"></script>
  <style>
  body{background:transparent;color:#333;font-family:tahoma;font-size:64px;padding:0px;margin:20px 0px;overflow:hidden;text-align:center;}
  .box{border-radius:16px;background:#fff;color:#333;margin:20px 0px 0px;}
  .box>div{padding:0px 10px 10px;text-align:center;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;line-height:56px;}
  .box>div span{display:inline-block;margin:0px 10px;font-size:40px}
.bar-heading{height:60px;line-height:60px;font-size:56px;}
  h2.bar-heading{font-size:60px; color:#fff;text-align:center; height:60px;line-height:60px;}
  marquee{padding:0px;margin:0px 0px 0px;height:60px;line-height:60px;}
  .col-xs-4 .box{margin-right:10px;}
  </style>
</head><body>

<div style="padding:20px">
<h2 class="bar-heading">สลากกินแบ่งรัฐบาล งวดประจำวันที่ <span class="txt_tm"></span></h2>
<div class="row">
<div class="col-xs-4">
  <div class="box">
    <h3 class="bar-heading">รางวัลที่ 1</h3>
    <div class="txt_a1"></div>
  </div>
  <div class="box">
    <h3 class="bar-heading">เลขท้าย 2 ตัว</h3>
    <div class="txt_l2"></div>
  </div>
  <div class="box">
    <h3 class="bar-heading">เลขหน้า 3 ตัว</h3>
    <div class="txt_f3"></div>
  </div>
  <div class="box">
    <h3 class="bar-heading">เลขท้าย 3 ตัว</h3>
    <div class="txt_l3"></div>
  </div>
</div>
<div class="col-xs-8">
  <div class="box">
    <h3 class="bar-heading bar_slide"></h3>
    <div class="txt_slide"></div>
  </div>
</div>
</div>
</div>
</body>
<script>

var a=['','','',''],cur=-1,delay=0;
function getlotto()
{
  $.getJSON("https://app.jarm.com/lotto?json=lottery-last&callback=?",function(json){
  console.log(json);
  $('.txt_tm').html('<span>'+json.content.tm+'</span>');
  $('.txt_a1').html('<span>'+json.content.a1+'</span>');
  $('.txt_l2').html('<span>'+json.content.l2+'</span>');
  $('.txt_f3').html('<span>'+($.isArray(json.content.f3)?json.content.f3.join('</span><span>'):'-')+'</span>');
  $('.txt_l3').html('<span>'+($.isArray(json.content.l3)?json.content.l3.join('</span><span>'):'-')+'</span>');
  a[0]='<span>'+($.isArray(json.content.a2)?json.content.a2.join('</span><span>'):'')+'</span>';
  a[1]='<span>'+($.isArray(json.content.a3)?json.content.a3.join('</span><span>'):'')+'</span>';
  a[2]='<span>'+($.isArray(json.content.a4)?json.content.a4.join('</span><span>'):'')+'</span>';
  a[3]='<span>'+($.isArray(json.content.a5)?json.content.a5.join('</span><span>'):'')+'</span>';
});
};
function lottodelay()
{
  if(delay==0)
  {
    cur++;
    if(cur>=a.length)
    {
      cur=0;
    }
    if(a[cur]=='<span></span>')
    {
      return;
    }
    $('.txt_slide').html('<marquee scrollamount="5">'+a[cur]+'</marquee>');
    $('.bar_slide').html('รางวัลที่ '+(cur+2));
  }
  delay++;

  if(delay>=Math.floor($('.txt_slide').html().length/10)+10)
  {
    delay=0;
  }
}
setInterval(getlotto,5000);
setInterval(lottodelay,1000);
getlotto();
</script>
</html>
