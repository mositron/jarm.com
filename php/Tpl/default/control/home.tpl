<style>
.ipie{margin:0 auto 10px;text-align:center;display:table;vertical-align:middle;font-size:20px;}
.ipie .piesite{display:inline-block;vertical-align:middle;position:relative;width:1em;height:1em;font-size:6em;margin:0px 10px;cursor:default;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing: border-box;}
.ipie .percent{position:absolute;top:1.1em;left:0;width:100%;font-size:.3em;text-align:center;z-index:2}
.ipie .piesite>#slice{position:absolute;width:1em;height:1em;clip:rect(0px,1em,1em,0.5em)}
.ipie .piesite>#slice.gt50{clip:rect(auto,auto,auto,auto)}
.ipie .piesite>#slice>.pie{position:absolute;border:.1em solid #444;width:.8em;height:.8em;clip:rect(0em,0.5em,1em,0em);border-radius:.5em;box-sizing:content-box;transition:all 0.1s linear;}
.ipie .piesite.red>#slice>.pie{border-color:#df6c4f}
.ipie .piesite.green>#slice>.pie{border-color:#3c948b}
.ipie .piesite.yellow>#slice>.pie{border-color:#ecd06f}
.ipie .piesite.blue>#slice>.pie{border-color:#1a99aa}
.ipie .piesite.purple>#slice>.pie{border-color:#7519a9}
.ipie .piesite.orange>#slice>.pie{border-color:#e56916}
.ipie .piesite.pink>#slice>.pie{border-color:#f218b6}
.ipie .piesite>#slice>.pie.fill{-webkit-transform:rotate(180deg)!important;transform:rotate(180deg)!important}
.ipie .piesite.fill>.percent{display:none}
.ipie .piesite:after{content:'';display:block;position:absolute;top:.1em;left:.1em;width:.8em;height:.8em;background:#fff;border-radius:100%;z-index:1}
.ipie .piesite:before{content:'';display:block;position:absolute;width:1em;height:1em;border-radius:.5em;opacity:.5;z-index:0}
.ipie .piesite.red:before{background:#df6c4f}
.ipie .piesite.green:before{background:#3c948b}
.ipie .piesite.yellow:before{background:#ecd06f}
.ipie .piesite.blue:before{background:#1a99aa}
.ipie .piesite.purple:before{background:#c58be5}
.ipie .piesite.orange:before{background:#edb48e}
.ipie .piesite.pink:before{background:#ed8ed3}

.table thead tr th{text-align:center;}
.table tbody tr td.c{text-align:center;}
.w80{width:80px;}
.w100{width:100px;}
.w130{width:130px;font-size:13px;}
.w200{width:200px; font-size:13px;}
.wright, .table tbody tr td.wright{text-align:right !important;}
.wimg{width:40px;}
.wimg img{width:40px;}
.mbox{margin: 0px 0px 10px;padding: 0px 5px 10px;}
.mbox .bar-heading{padding: 5px;color: #000;letter-spacing: 1px;line-height: 2em;height: 2em;margin-bottom: 10px;}
.mbox-ads > div{margin:24px 20px;}
.mbox-ads > div > div{text-align:center; color:#999; font-size:12px}
.mbox-ads > div > div:first-child{border-right:1px solid #f0f0f0}
.mbox-ads > div > div strong{color: #000;font-size: 44px;display: block;font-family: sans-serif;font-weight: normal;}

.mbox-member > div{margin:10px 20px;}
.mbox-member > div > div{text-align:center; color:#999; font-size:12px; padding-top:10px; padding-bottom:10px;}
.mbox-member > div > div strong{color: #000;font-size: 26px;display: block;font-family: sans-serif;font-weight: normal; line-height:1em;}

.b-right{border-right:1px solid #f3f3f3}
.b-bottom{border-bottom:1px solid #f3f3f3}

#pageview{height:150px; margin:5px;}
#diff{height:150px; margin:5px;}
#pageweb{height:150px; margin:5px;}

.legend table {background: none;}

.flot-y-axis .tickLabel { font-size: 9px }
.flot-x-axis .tickLabel { font-size: 8px; font-family:tahoma;}
</style>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/flot/jquery.flot.growraf.js"></script>
<script>
var _timer=[];
var _finish;
var _sec;

function drawTimer(c, a, m) {
  $("#pie_"+c).html('<div class="percent"></div><div id="slice"'+(a>(m/2)?' class="gt50"':'')+'><div class="pie"></div>'+(a>(m/2)?'<div class="pie fill"></div>':'')+'</div>');
  var b = 360 / m * a;
  $('#pie_'+c+' #slice .pie').css({'-moz-transform':'rotate('+b+'deg)','-webkit-transform':'rotate('+b+'deg)','-o-transform':'rotate('+b+'deg)',transform:'rotate('+b+'deg)'});
  var j = 1000 / m;
  a = Math.floor(a * j) / j;
  $('#pie_'+c+' .percent').html('<span class="int">'+a.toString().split('.')[0]+'</span>');
}
function stoppie(d, b,m) {
  var c = (_finish - (new Date().getTime())) / 1000;
  var a = m - ((c / sec) * m);
  var j = 1000 / m;
  a = Math.floor(a * j) / j;
  if (a <= b || $("#pie_"+d+" .percent").length==0) {
    drawTimer(d, a, m)
  } else {
    clearInterval(_timer[d]);
    $("#pie_"+d+" .percent").html('<span class="int">'+$("#pie_"+d).data("pie").toString().split(".")[0]+'</span>');
  }
}

$(function(){
  var pageview_x=<?php echo json_encode($this->pageview['x'])?>;
  var pageview_do=<?php echo json_encode($this->pageview['do'])?>;
  var pageview_do2=<?php echo json_encode($this->pageview['do'])?>;
  var pageview_is=<?php echo json_encode($this->pageview['is'])?>;
  var pageview_tb=<?php echo json_encode($this->pageview['tb'])?>;
  var pageview_mb=<?php echo json_encode($this->pageview['mb'])?>;
  var pageview_dt=<?php echo json_encode($this->pageview['dt'])?>;
  var pageview_all=<?php echo json_encode($this->pageview['all'])?>;
  var diff_today=<?php echo json_encode($this->diff['today'])?>;
  var diff_yesterday=<?php echo json_encode($this->diff['yesterday'])?>;
  var diff_yesterday2=<?php echo json_encode($this->diff['yesterday2'])?>;
  function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>"+label+"<br/>"+Math.round(series.percent)+"%</div>";
  }
  setTimeout(function(){
    var plot = $.plot($("#pageview"),
    [
      {data:pageview_all,label: 'ทั้งหมด',color:'#cccccc',grow:{growings:[{stepMode:"linear"}]}},
      {data:pageview_is,label: 'Instant Article',color:'#fc79ef',grow:{growings:[{stepMode:"linear"}]}},
      {data:pageview_do,label: 'หน้าเว็บ',color:'#17A0DA',grow:{growings:[{stepMode:"linear"}]}},
    ],
    {
      series: {
         lines: { show: true, fill:0.1},
         points: { show: true },
         clickable:true,
         hoverable:true,
         shadowSize: 2,
         grow:{active:true,duration:2000}
      },
      grid: { hoverable: true, clickable: true ,borderWidth:{top:0,right:0,bottom:1,left:0},borderColor: {bottom: "#000000"}},
      xaxis: { ticks: pageview_x},
      yaxis: { min: 0,autoscaleMargin: 0.05,color:'#f0f0f0',
              tickFormatter: function (v, axis) {
                v+='';x=v.split('.');x1=x[0];x2=x.length>1?'.'+x[1]:'';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {x1=x1.replace(rgx, '$1'+','+'$2');}
                return x1+x2;
              }
      },
      legend: {
         show: true,
         labelBoxBorderColor: '#ccc',
         noColumns: 4,
         position: 'ne',
         margin: 0,
         backgroundColor: '#fff',
         backgroundOpacity: 0.5,
      }
    });
    $("<div id='tooltip'></div>").css({
      position: "absolute",
      display: "none",
      border: "1px solid #ccc",
      padding: "2px",
      "background-color": "#fff",
      opacity: 0.8
    }).appendTo("body");
    $("#pageview").bind("plothover", function (event, pos, item) {
      if (item) {
        var x = item.datapoint[0],y = item.datapoint[1]+'';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(y)) {y=y.replace(rgx, '$1'+','+'$2');}
        $("#tooltip").html(item.series.label+' = '+y)
          .css({top: item.pageY+5, left: item.pageX+5})
          .fadeIn(200);
      } else {
        $("#tooltip").hide();
      }
    });
    $("#pageview").bind("plotclick", function (event, pos, item) {
      if (item) {
        plot.highlight(item.series, item.datapoint);
      }
    });
  },200);

  setTimeout(function(){
    var plot = $.plot($("#diff"),
    [
    {data:diff_yesterday2,label: 'วานซืน',color:'#f0f0f0',grow:{growings:[{stepMode:"linear"}]}},
    {data:diff_yesterday,label: 'เมื่อวาน',color:'#bfbfbf',grow:{growings:[{stepMode:"linear"}]}},
    {data:diff_today,label: 'วันนี้',color:'#17A0DA',grow:{growings:[{stepMode:"linear"}]}},
    ],
    {
    series: {
       lines: { show: true, fill:0.1},
       points: { show: true },
       clickable:true,
       hoverable:true,
       shadowSize: 2,
       grow:{active:true,duration:2000}
    },
    grid: { hoverable: true, clickable: true ,borderWidth:{top:0,right:0,bottom:1,left:0},borderColor: {bottom: "#000000"}},
    xaxis: { ticks: [[0,0],[1,1],[2,2],[3,3],[4,4],[5,5],[6,6],[7,7],[8,8],[9,9],[10,10],[11,11],[12,12],[13,13],[14,14],[15,15],[16,16],[17,17],[18,18],[19,19],[20,20],[21,21],[22,22],[23,23]]},
    yaxis: { autoscaleMargin: 0.05,color:'#f0f0f0',
            tickFormatter: function (v, axis) {
              v+='';x=v.split('.');x1=x[0];x2=x.length>1?'.'+x[1]:'';
              var rgx = /(\d+)(\d{3})/;
              while (rgx.test(x1)) {x1=x1.replace(rgx, '$1'+','+'$2');}
              return x1+x2;
            }
    },
    legend: {
       show: true,
       labelBoxBorderColor: '#ccc',
       noColumns: 3,
       position: 'nw',
       margin: 1,
       backgroundColor: '#fff',
       backgroundOpacity: 0.1,
      }
    });
    $("#diff").bind("plothover", function (event, pos, item) {
      if (item) {
        var x = item.datapoint[0],y = item.datapoint[1]+'';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(y)) {y=y.replace(rgx, '$1'+','+'$2');}
        $("#tooltip").html(item.series.label+' = '+y)
          .css({top: item.pageY+5, left: item.pageX+5})
          .fadeIn(200);
      } else {
        $("#tooltip").hide();
      }
    });
    $("#diff").bind("plotclick", function (event, pos, item) {
      if (item) {
        plot.highlight(item.series, item.datapoint);
      }
    });
  },400);

  setTimeout(function(){
    var plot = $.plot($("#pageweb"),
    [
      {data:pageview_do2,label: 'ทั้งหมด',color:'#cccccc',grow:{growings:[{stepMode:"linear"}]}},
      {data:pageview_tb,label: 'Tablet',color:'#fec2f8',grow:{growings:[{stepMode:"linear"}]}},
      {data:pageview_mb,label: 'Mobile',color:'#fc79ef',grow:{growings:[{stepMode:"linear"}]}},
      {data:pageview_dt,label: 'Desktop',color:'#17A0DA',grow:{growings:[{stepMode:"linear"}]}},
    ],
    {
      series: {
         lines: { show: true, fill:0.1},
         points: { show: true },
         clickable:true,
         hoverable:true,
         shadowSize: 2,
         grow:{active:true,duration:2000}
      },
      grid: { hoverable: true, clickable: true ,borderWidth:{top:0,right:0,bottom:1,left:0},borderColor: {bottom: "#000000"}},
      xaxis: { ticks: pageview_x},
      yaxis: { min: 0,autoscaleMargin: 0.05,color:'#f0f0f0',
              tickFormatter: function (v, axis) {
                v+='';x=v.split('.');x1=x[0];x2=x.length>1?'.'+x[1]:'';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {x1=x1.replace(rgx, '$1'+','+'$2');}
                return x1+x2;
              }
      },
      legend: {
         show: true,
         labelBoxBorderColor: '#ccc',
         noColumns: 4,
         position: 'ne',
         margin: 0,
         backgroundColor: '#fff',
         backgroundOpacity: 0.5,
        }
     });

    $("#pageweb").bind("plothover", function (event, pos, item) {
      if (item) {
        var x = item.datapoint[0],y = item.datapoint[1]+'';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(y)) {y=y.replace(rgx, '$1'+','+'$2');}
        $("#tooltip").html(item.series.label+' = '+y)
          .css({top: item.pageY+5, left: item.pageX+5})
          .fadeIn(200);
      } else {
        $("#tooltip").hide();
      }
    });
    $("#pageweb").bind("plotclick", function (event, pos, item) {
      if (item) {
        plot.highlight(item.series, item.datapoint);
      }
    });
  },600);

  setTimeout(function(){
    sec = 1;
    _finish = new Date().getTime()+(sec*1000);
    $(".piesite").each(function(a) {
      _timer[a] = setInterval("stoppie("+a+", " +$("#pie_"+a).data("pie")+ "," +$("#pie_"+a).data("maxpie")+ ")",100)
    });
  },1000);
});
</script>
<div class="row">
  <div class="col-sm-6">
    <div class="mbox mbox-ads">
      <h3 class="bar-heading">โฆษณา</h3>
      <div class="row">
        <div class="col-xs-6">
          <div class="ipie"><div class="piesite pink" id="pie_4" data-pie="<?php echo $this->ads['banner']?>" data-maxpie="10"></div></div>Banner
        </div>
        <div class="col-xs-6">
          <div class="ipie"><div class="piesite orange" id="pie_5" data-pie="<?php echo $this->ads['advertorial']?>" data-maxpie="10"></div></div>Advertorial
        </div>
      </div>
    </div>
    <div class="mbox mbox-member">
    <?php
    $all=($wait=intval($this->member['wait']))+
    ($active=intval($this->member['active']))+
    ($ban=intval($this->member['ban']))+
    ($hold=intval($this->member['hold']));
    ?>
      <h3 class="bar-heading">สมาชิก <small class="pull-right" style="margin-top:12px;"><?php echo number_format($all)?> รายการ</small></h3>
      <div class="row">
        <div class="col-xs-6 b-right b-bottom">
          <div class="ipie"><div class="piesite yellow" id="pie_0" data-pie="<?php echo $wait?>" data-maxpie="<?php echo $all?>"></div></div>
          รอยืนยัน
        </div>
        <div class="col-xs-6 b-bottom">
          <div class="ipie"><div class="piesite green" id="pie_1" data-pie="<?php echo $active?>" data-maxpie="<?php echo $all?>"></div></div>
          ยืนยันแล้ว
        </div>
        <div class="col-xs-6 b-right">
          <div class="ipie"><div class="piesite red" id="pie_2" data-pie="<?php echo $ban?>" data-maxpie="<?php echo $all?>"></div></div>
          แบน
        </div>
        <div class="col-xs-6">
          <div class="ipie"><div class="piesite blue" id="pie_3" data-pie="<?php echo $hold?>" data-maxpie="<?php echo $all?>"></div></div>
          เลิกใช้งาน
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="mbox">
      <h3 class="bar-heading">เพจวิว<small class="pull-right" style="margin-top:12px;">ต่อชม.</small></h3>
      <div id="diff"></div>
    </div>
    <div class="mbox">
      <h3 class="bar-heading">เพจวิว<small class="pull-right" style="margin-top:12px;">ต่อวัน</small></h3>
      <div id="pageview"></div>
    </div>
    <div class="mbox">
      <h3 class="bar-heading">เพจวิว<small class="pull-right" style="margin-top:12px;">เฉพาะหน้าเว็บ</small></h3>
      <div id="pageweb"></div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="mbox">
      <h3 class="bar-heading"><a href="/user">ผู้ดูแล</a> <small class="pull-right" style="margin-top:12px;"><?php echo count($this->admin)?> รายการ | <a href="/user">ทั้งหมด</a></small></h3>
      <div style="max-height:300px;" class="noscroll">
        <table class="table table-hover table-striped" width="100%">
        <thead><tr><th>#</th><th>รูป</th><th>ชื่อ</th><th>ใช้งานล่าสุด</th></tr></thead>
        <tbody><?php foreach($this->admin as $v):?><?php $u=$this->user->get($v['_id'],true);?><tr><td class="c w80"><?php echo $u['_id']?></td><td class="c wimg"><a href="<?php echo $u['link']?>" target="_blank"><img src="<?php echo $u['img']?>"></a></td><td><a href="<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a> - (ระดับ <?php echo $u['am']?>)<br><?php echo $u['em']?></td><td class="c w130"><span class="ago" datetime="<?php echo self::Time()->sec($v['du'])?>"><?php echo self::Time()->from($v['du'],'ago')?></span><br>ที่ผ่านมา</td></tr><?php endforeach?></tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <!--div class="mbox">
      <h3 class="bar-heading">หาเพื่อน  <small class="pull-right" style="margin-top:12px;">แจ้งลบ <span id="friendcount"><?php echo count($this->friend)?></span> รายการ (<a href="javascript:;" onClick="delfriends()">ลบทั้งหมด</a>)</small></h3>
      <div style="max-height:300px;" class="noscroll">
        <table class="table table-hover table-friend" width="100%">
        <tbody>
        <?php if($this->friend):?>
        <?php foreach($this->friend as $v):?>
        <tr id="friend<?php echo $v['_id']?>">
        <td><span class="label label-default"><?php echo $v['em']?></span> - ip: <?php echo $v['ip']?><br><?php echo $v['ms']?></td>
        <td class="c w150"><a href="javascript:;" onClick="delfriend(<?php echo $v['_id']?>)" class="btn btn-xs btn-warning">ลบ</a></td>
        </tr>
        <?php endforeach?>
        <?php endif?>
        </tbody>
        </table>
      </div>
    </div-->
    <div class="mbox">
      <h3 class="bar-heading">แคช</h3>
      <div style="padding:5px 5px 2px; border-bottom:1px dashed #ccc;">
        <form>
          <label style="font-weight:normal"><input type="radio" class="dm-cache" name="domain" value="jarm.com" checked> jarm.com</label>
          <label style="font-weight:normal"><input type="radio" class="dm-cache" name="domain" value="autocar.in.th"> autocar.in.th</label>
          <!--label style="font-weight:normal"><input type="radio" class="dm-cache" name="domain" value="teededball.com"> teededball.com</label-->
          <a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','clearcache',$('.dm-cache:checked').val())" class="btn btn-warning btn-xs pull-right"><span class="glyphicon glyphicon-refresh"></span> ล้างแคช</a>
        </form>
      </div>
      <div style="max-height:270px;" class="noscroll">
        <table class="table table-hover" width="100%">
        <thead><tr><th>เว็บ</th><th>โดย</th><th>เวลา</th></tr></thead>
        <tbody><?php if($this->logs):?><?php foreach($this->logs as $v):?><?php $u=$this->user->get($v['u'],true);?><tr><td><?php echo $v['dm']?></td><td><a href="<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a></td><td class="w130 wright"><span class="ago" datetime="<?php echo self::Time()->sec($v['da'])?>"><?php echo self::Time()->from($v['da'],'ago')?></span> ที่ผ่านมา</td></tr><?php endforeach?><?php endif?></tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
function delfriend(id)
{
  _.box.confirm({'title':'ลบข้อความ','detail':'ต้องการลบข้อความนี้หรือไม่',click:function(){_.ajax.gourl('/','delfriend',id);}});
}

function delfriends()
{
  _.box.confirm({'title':'ลบข้อความ','detail':'ต้องการลบข้อความทั้งหมดหรือไม่',click:function(){_.ajax.gourl('/','delfriends');}});
}
</script>
