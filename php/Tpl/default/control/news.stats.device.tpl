<style>
.bn{display:inline-block; padding:0px; height:20px; line-height:20px; width:20px; overflow:hidden; text-align:center; background:#CBEFF2; color:#000; text-shadow:1px 1px 0px #fff; vertical-align:middle;}
.bn.bn-a,.bn.bn-a1{background:#F3CECE;}
.bn.bn-f,.bn.bn-a6{background:#F7EBE1;}
.bn.bn-h,.bn.bn-i,.bn.bn-h1{background:#D6D4F4;}
.bn.bn-h2,.bn.bn-h3{background:#F1C5F0;}
.bn.bn-b{background:#CCC;}
.bn.bn-b1,.bn.bn-b2,.bn.bn-l,.bn.bn-r{background:#F1F2CB;}

.table .r{width:200px; text-align:right;}

.devices{padding:0px; margin:0px;}
.devices li{height:22px; line-height:22px; border-bottom:1px dashed #eee; list-style:inside circle; padding:0px 5px; font-size:13px;}
.devices li:nth-child(even){background: #f5f5f5;}
.devices2 li:nth-child(even){background:none !important;}
.devices2 li:nth-child(odd){background:#f5f5f5;}

</style>

<ul class="breadcrumb">
<li><a href="/" title="ข่าว ข่าววันนี้">ข่าว</a></li>
<span class="divider">&raquo;</span>
<li><a href="/news">ระบบจัดการข้อมูล</a></li>
<span class="divider">&raquo;</span>
<li>สถิติ</li>
</ul>

<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">สถิติ</h2>

<table class="table" width="100%">
<tbody>
<tr><td class="r">ข่าว</td><td><?php echo $this->news['t']?></td></tr>
<tr><td class="r">รูปภาพ</td><td>
<img src="https://<?php echo $this->news['sv']?>.jarm.com/news/<?php echo $this->news['fd']?>/t.jpg" class="img-responsive"><br>
</td></tr>
<tr><td class="r">เขียนเมื่อ</td><td><?php echo self::Time()->from($this->news['da'],'datetime')?></td></tr>
<tr><td class="r">แสดงผล</td><td><?php echo number_format(intval($this->news['do']))?> ครั้ง</td></tr>
<tr><td class="r">การเผยแพร่</td><td><?php echo $this->news['pl']?'':'ไม่'?>แสดง</td></tr>
<!--tr><td class="r">ลิ้งค์สำหรับบุคคลภายนอก</td><td><a href="<?php echo self::uri(['control','/news/stats/'.$v['_id'].'.'.$this->news['sc']])?>" target="_blank"><?php echo self::uri(['control','/news/stats/'.$v['_id'].'.'.$this->news['sc']])?></a></td></tr-->
</tbody>
</table>
<?php /*
<div style="margin:10px">
    <h3 class="bar-heading">24Hr <small style="float:right;margin-top:10px;font-size:18px;color:#f60; cursor:pointer" id="adstime">24ชม เริ่มจากเวลาที่เขียน (<?php echo $this->stats2[0]['day'].':'.$this->stats2[0]['hour']?> - <?php $c=count($this->stats2)-1;echo $this->stats2[$c]['day'].':'.$this->stats2[$c]['hour']?>)</small></h3>
    <div id="chart2" style="height:200px; margin-top:10px;"></div>
    <div class="row">
        <div class="col-sm-3">
            <div id="pie_imp2" style="height:300px;margin-top:10px;"></div>
        </div>
        <div class="col-sm-3">
            <h3 class="bar-heading">Top Browsers</h3>
            <ul class="devices">
            <?php foreach($this->imp_browsers2 as $k=>$v):?>
                <li><?php echo $k?><span class="pull-right"><?php echo number_format(($v/$this->imp_browsers_all2)*100,2)?>%</span></li>
            <?php endforeach?>
            </ul>
        </div>
        <div class="col-sm-3">
            <h3 class="bar-heading">Top Devices</h3>
            <ul class="devices">
            <?php foreach($this->imp_devices2 as $k=>$v):?>
                <li><?php echo $k?><span class="pull-right"><?php echo number_format(($v/$this->imp_devices_all2)*100,2)?>%</span></li>
            <?php endforeach?>
            </ul>
        </div>
        <div class="col-sm-3">
            <h3 class="bar-heading">Top Referrers</h3>
            <ul class="devices">
            <?php foreach($this->imp_referer2 as $k=>$v):?>
                <li><?php echo $k?><span class="pull-right"><?php echo number_format(($v/$this->imp_referer_all2)*100,2)?>%</span></li>
            <?php endforeach?>
            </ul><br>
            <h3 class="bar-heading">Top FB Pages</h3>
            <ul class="devices">
            <?php foreach($this->imp_page2 as $k=>$v):?>
                <li><?php echo $k?><span class="pull-right"><?php echo number_format(($v/$this->imp_page_all2)*100,2)?>%</span></li>
            <?php endforeach?>
            </ul>
        </div>
    </div>
</div>

<div style="margin:10px">
    <h3 class="bar-heading">Overview <small style="float:right;margin-top:10px;font-size:18px;color:#f60; cursor:pointer" id="adstime"><?php echo $this->start?> ~ <?php echo $this->stop?></small></h3>
    <div id="chart" style="height:200px; margin-top:10px;"></div>
    <div class="row">
        <div class="col-sm-3">
            <div id="pie_imp" style="height:300px;margin-top:10px;"></div>
        </div>
        <div class="col-sm-3">
            <h3 class="bar-heading">Top Browsers</h3>
            <ul class="devices">
            <?php foreach($this->imp_browsers as $k=>$v):?>
                <li><?php echo $k?><span class="pull-right"><?php echo number_format(($v/$this->imp_browsers_all)*100,2)?>%</span></li>
            <?php endforeach?>
            </ul>
        </div>
        <div class="col-sm-3">
            <h3 class="bar-heading">Top Devices</h3>
            <ul class="devices">
            <?php foreach($this->imp_devices as $k=>$v):?>
                <li><?php echo $k?><span class="pull-right"><?php echo number_format(($v/$this->imp_devices_all)*100,2)?>%</span></li>
            <?php endforeach?>
            </ul>
        </div>
        <div class="col-sm-3">
            <h3 class="bar-heading">Top Referrers</h3>
            <ul class="devices">
            <?php foreach($this->imp_referer as $k=>$v):?>
                <li><?php echo $k?><span class="pull-right"><?php echo number_format(($v/$this->imp_referer_all)*100,2)?>%</span></li>
            <?php endforeach?>
            </ul><br>
            <h3 class="bar-heading">Top FB Pages</h3>
            <ul class="devices">
            <?php foreach($this->imp_page as $k=>$v):?>
                <li><?php echo $k?><span class="pull-right"><?php echo number_format(($v/$this->imp_page_all)*100,2)?>%</span></li>
            <?php endforeach?>
            </ul>
        </div>
    </div>
    <h3 class="bar-heading">Statistics</h3>
    <table width="100%" class="table table-striped">
    <thead>
    <tr>
    <th>Date</th>
    <th class="text-right" width="120">Impressions</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i=count($this->stats)-1;$i>=0;$i--):$v=$this->stats[$i];?>
    <tr>
    <td><span class="label label-default"><?php echo date('D',strtotime($tm=substr($v['day'],6,2).'-'.substr($v['day'],4,2).'-'.substr($v['day'],0,4)))?></span> <?php echo $tm?><?php #echo substr($v['day'],6,2).' '.self::Time()->month[intval(substr($v['day'],4,2))-1]?></td>
    <td class="text-right"><?php echo number_format($imp=intval($v['stats']['do']))?></td>
    </tr>
    <?php endfor?>
    </tbody>
    </table>
</div>
*/ ?>
<?php if(self::$my && self::$my['am']>=9):?>
<div style="margin:10px">
    <h3 class="bar-heading">เพิ่มลดจำนวนการแสดงผล</h3>
    <div style="padding:5px 5px 2px; border-bottom:1px dashed #ccc; text-align:right">
      <input type="number" class="dm-do form-control" style="width:100px;padding:2px 5px;height:22px;vertical-align:middle;display:inline-block;" name="do" value="">
      <a href="javascript:;" onClick="_.ajax.gourl('<?php echo URL?>','addview',$('.dm-do').val())" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-plus"></span> เพิ่ม</a>
    </div>
    <div style="max-height:217px;" class="noscroll">
        <table class="table table-hover" width="100%">
            <thead><tr><th>จำนวน</th><th style="width:150px">โดย</th><th style="width:150px;text-align:right">เวลา</th></tr></thead>
            <tbody><?php $this->user=self::user();if($this->logs):?><?php foreach($this->logs as $v):?><?php $u=$this->user->get($v['u'],true);?><tr><td><?php echo $v['do']?></td><td><a href="<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a></td><td class="w130 text-right"><span class="ago" datetime="<?php echo self::Time()->sec($v['da'])?>"><?php echo self::Time()->from($v['da'],'ago')?></span> ที่ผ่านมา</td></tr><?php endforeach?><?php endif?></tbody>
        </table>
    </div>
</div>
<?php endif?>
<br><br>
<link rel="stylesheet" href="<?php echo FILES_CDN?>js/daterange/daterangepicker.css" />
<style>
.date-picker-wrapper .footer{background:none;}
.date-picker-wrapper .drp_top-bar .apply-btn{line-height:1.8em;}
</style>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/daterange/moment.min.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/daterange/jquery.daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/flot/jquery.flot.pie.min.js"></script>
<script>
$(function(){
  var line_imp=<?php echo json_encode($this->line_imp)?>;
  var pie_imp=<?php echo json_encode($this->pie_imp)?>;
  var line_imp2=<?php echo json_encode($this->line_imp2)?>;
  var pie_imp2=<?php echo json_encode($this->pie_imp2)?>;
  var line_jarm=<?php echo json_encode($this->line_jarm)?>;
  var line_happy=<?php echo json_encode($this->line_happy)?>;
  var line_onutz=<?php echo json_encode($this->line_onutz)?>;
  var line_message=<?php echo json_encode($this->line_message)?>;
  var line_jarm2=<?php echo json_encode($this->line_jarm2)?>;
  var line_happy2=<?php echo json_encode($this->line_happy2)?>;
  var line_onutz2=<?php echo json_encode($this->line_onutz2)?>;
  var line_message2=<?php echo json_encode($this->line_message2)?>;
  function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
  }
    var plot = $.plot($("#chart"),
    [{data:line_imp,label: 'Impression',color:'#fc79ef'},{data:line_jarm,label: 'Boxza',color:'#bbb'},{data:line_happy,label: 'Happy',color:'#ccc'},{data:line_onutz,label: 'Onutz',color:'#ddd'},{data:line_message,label: 'Message',color:'#eee'}],
    {
      series: {
         lines: { show: true, fill:0.1},
         points: { show: true },
           clickable:true,
           hoverable:true,
           shadowSize: 2
      },
      grid: { hoverable: true, clickable: true ,borderWidth:{top:0,right:0,bottom:1,left:0},borderColor: {bottom: "#000000"}},
      xaxis: { ticks: <?php echo json_encode($this->x)?>},
      yaxis: { min: 0,autoscaleMargin: 0.05,color:'#f0f0f0',
              tickFormatter: function (v, axis) {
                v+='';x=v.split('.');x1=x[0];x2=x.length>1?'.'+x[1]:'';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {x1=x1.replace(rgx, '$1'+','+'$2');}
                return x1 + x2;
              }
      },
      legend: {
         show: false,
         labelBoxBorderColor: '#ccc',
         noColumns: 1,
         position: 'nw',
         margin: 1,
         backgroundColor: '#fff',
         backgroundOpacity: 0.6,
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

  $("#chart").bind("plothover", function (event, pos, item) {
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
  $("#chart").bind("plotclick", function (event, pos, item) {
    if (item) {
      plot.highlight(item.series, item.datapoint);
    }
  });


  $.plot('#pie_imp', pie_imp, {
    series: {
      pie: {
        show: true,
                radius: 1,
        label: {
          show: true,
          radius: 3/4,
          formatter: labelFormatter,
          background: {opacity: 0.5,}
        }
      }
    },
    legend: {show: false}
  });


  var plot = $.plot($("#chart2"),
    [{data:line_imp2,label: 'Impression',color:'#00BFFF'},{data:line_jarm2,label: 'Boxza',color:'#bbb'},{data:line_happy2,label: 'Happy',color:'#ccc'},{data:line_onutz2,label: 'Onutz',color:'#ddd'},{data:line_message2,label: 'Message',color:'#eee'}],
    {
      series: {
         lines: { show: true, fill:0.1},
         points: { show: true },
           clickable:true,
           hoverable:true,
           shadowSize: 2
      },
      grid: { hoverable: true, clickable: true ,borderWidth:{top:0,right:0,bottom:1,left:0},borderColor: {bottom: "#000000"}},
      xaxis: { ticks: <?php echo json_encode($this->x2)?>},
      yaxis: { min: 0,autoscaleMargin: 0.05,color:'#f0f0f0',
              tickFormatter: function (v, axis) {
                v+='';x=v.split('.');x1=x[0];x2=x.length>1?'.'+x[1]:'';
                var rgx = /(\d+)(\d{3})/;
                while (rgx.test(x1)) {x1=x1.replace(rgx, '$1'+','+'$2');}
                return x1 + x2;
              }
      },
      legend: {
         show: false,
         labelBoxBorderColor: '#ccc',
         noColumns: 1,
         position: 'nw',
         margin: 1,
         backgroundColor: '#fff',
         backgroundOpacity: 0.6,
        }
     });


  $("#chart2").bind("plothover", function (event, pos, item) {
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
  $("#chart2").bind("plotclick", function (event, pos, item) {
    if (item) {
      plot.highlight(item.series, item.datapoint);
    }
  });


  $.plot('#pie_imp2', pie_imp2, {
    series: {
      pie: {
        show: true,
                radius: 1,
        label: {
          show: true,
          radius: 3/4,
          formatter: labelFormatter,
          background: {opacity: 0.5,}
        }
      }
    },
    legend: {show: false}
  });

});


</script>
