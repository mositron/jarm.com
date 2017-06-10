<style>
.bn{display:inline-block; padding:0px; height:20px; line-height:20px; width:20px; overflow:hidden; text-align:center; background:#CBEFF2; color:#000; text-shadow:1px 1px 0px #fff; vertical-align:middle;}
.bn.bn-a,.bn.bn-a1{background:#F3CECE;}
.bn.bn-f,.bn.bn-a6{background:#F7EBE1;}
.bn.bn-h,.bn.bn-i,.bn.bn-h1{background:#D6D4F4;}
.bn.bn-h2,.bn.bn-h3{background:#F1C5F0;}
.bn.bn-b{background:#CCC;}
.bn.bn-b1,.bn.bn-b2,.bn.bn-l,.bn.bn-r{background:#F1F2CB;}

.table .r{width:150px; text-align:right;}

.devices{padding:0px; margin:0px;}
.devices li{height:22px; line-height:22px; border-bottom:1px dashed #eee; list-style:inside circle; padding:0px 5px; font-size:13px;}
</style>

<ul class="breadcrumb">
   <li><a href="/"><span class="glyphicon glyphicon-eye-open"></span> แบนเนอร์ทั้งหมด</a></li>
  <span class="divider">&raquo;</span>
   <li>สถิติ</li>
</ul>

<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">สถิติ - <?php echo $this->banner['t']?></h2>

<table class="table" width="100%">
<tbody>
<tr><td class="r">ชื่อแบนเนอร์</td><td><?php echo $this->banner['t']?></td></tr>
<tr><td class="r">ไอดีข่าว</td><td><?php echo $this->banner['content']?></td></tr>
<tr><td class="r">ตำแหน่ง</td><td>
<?php foreach($this->advertorial_position as $k=>$s):?>
<?php if($this->banner[$k]):?>
<div style="padding-bottom:10px; margin-bottom:10px; border-bottom:2px solid #ccc;">
<h3 class="bar-heading"><?php echo $s['t']?></h3>
<?php foreach($this->banner[$k] as  $x=>$v):if(!$v)continue;?>
<div> - <?php echo $s['l'][$x]['t']?></div>
<?php endforeach?>
</div>
<?php endif?>
<?php endforeach?>

</td></tr>
<tr><td class="r">เวลาในการแสดงผล</td><td><?php echo self::Time()->from($this->banner['dt1'],'date')?> - <?php echo self::Time()->from($this->banner['dt2'],'date')?></td></tr>
<tr><td class="r">การเผยแพร่</td><td><?php echo $this->banner['pl']?'':'ไม่'?>แสดง</td></tr>
</tbody>
</table>
<div style="margin:10px">
    <h3 class="bar-heading">Overview <small style="float:right;color:#f60;font-size:14px;font-family:tahoma" id="adstime" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-calendar" style="margin-right:5px;"></span> <?php echo $this->start?> ~ <?php echo $this->stop?> <span class="caret"></span></small></h3>
    <h3 class="col-xs-12 bar-heading">Click</h3>
    <div class="row">
      <div class="col-sm-4">
        <div id="pie_click" style="height:300px;margin-top:10px;"></div>
      </div>
      <div class="col-sm-4">
        <h3 class="bar-heading">Top Browsers</h3>
        <ul class="devices">
        <?php foreach($this->click_browsers as $k=>$v):?>
            <li><?php echo $k?><span class="pull-right"><?php echo number_format(($v/$this->click_browsers_all)*100,2)?>%</span></li>
        <?php endforeach?>
        </ul>
      </div>
      <div class="col-sm-4">
        <h3 class="bar-heading">Top Devices</h3>
        <ul class="devices">
        <?php foreach($this->click_devices as $k=>$v):?>
            <li><?php echo $k?><span class="pull-right"><?php echo number_format(($v/$this->click_devices_all)*100,2)?>%</span></li>
        <?php endforeach?>
        </ul>
      </div>
    </div>
    <h3 class="bar-heading">Statistics</h3>
    <table width="100%" class="table table-striped">
    <thead>
    <tr>
    <th>Date</th>
    <th class="text-right" width="120">Clicks</th>
    </tr>
    </thead>
    <tbody>
    <?php for($i=count($this->stats)-1;$i>=0;$i--):$v=$this->stats[$i];?>
    <tr>
    <td><span class="label label-default"><?php echo date('D',strtotime($tm=substr($v['day'],6,2).'-'.substr($v['day'],4,2).'-'.substr($v['day'],0,4)))?></span> <?php echo $tm?><?php #echo substr($v['day'],6,2).' '.self::Time()->month[intval(substr($v['day'],4,2))-1]?></td>
    <td class="text-right"><?php echo number_format($click=intval($v['click']['do']))?></td>
    </tr>
    <?php endfor?>
    </tbody>
    </table>
</div>
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
  var line_click=<?php echo json_encode($this->line_click)?>;
  var pie_imp=<?php echo json_encode($this->pie_imp)?>;
  var pie_click=<?php echo json_encode($this->pie_click)?>;
  function labelFormatter(label, series) {
    return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
  }
    var plot = $.plot($("#chart"),
    [{data:line_imp,label: 'Impression',color:'#00BFFF'},{data:line_click,label: 'Click',color:'#fc79ef'}],
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
         show: true,
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
  $.plot('#pie_click', pie_click, {
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


$('#adstime').dateRangePicker({
  startDate:'<?php echo date('Y-m-d',self::Time()->sec($this->banner['dt1']))?>',
  endDate:'<?php echo date('Y-m-d')?>',
  shortcuts : null,
  separator : ' ~ ',
  customShortcuts:
  [
    {
      name: '7 วันล่าสุด',
      dates : function()
      {
        return [moment('<?php echo date('Y-m-d',strtotime('-1week'))?>').toDate(),moment('<?php echo date('Y-m-d')?>').toDate()];
      }
    },
    {
      name: 'อาทิตย์นี้',
      dates : function()
      {
        return [moment().day(0).toDate(),moment().day(6).toDate()];
      }
    },
    {
      name: 'เดือนนี้',
      dates : function()
      {
        return [moment('<?php echo date('Y-m-01')?>').toDate(),moment('<?php echo date('Y-m-d',strtotime('last day'))?>').toDate()];
      }
    },
    {
      name: 'เดือนที่แล้ว',
      dates : function()
      {
        return [moment('<?php echo date('Y-m-d',strtotime('first day of last month'))?>').toDate(),moment('<?php echo date('Y-m-d',strtotime('last day of last month'))?>').toDate()];
      }
    },
    {
      name: '3 เดือนที่ผ่านมา',
      dates : function()
      {
        return [moment('<?php echo date('Y-m-d',strtotime('first day of  -2month'))?>').toDate(),moment('<?php echo date('Y-m-d',strtotime('last day'))?>').toDate()];
      }
    },
  ],
  getValue: function()
  {
    return this.innerHTML;
  },
  setValue: function(s)
  {
    if(s!=this.innerHTML)
    {
      var t = s.split(' ~ ');
      this.innerHTML = s;
      window.location.href='?start='+t[0]+'&stop='+t[1];
    }
  }
})
.bind('datepicker-close',function()
{

});
</script>
