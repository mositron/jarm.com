

<style type="text/css">
.term{padding:10px; border:1px solid #f0f0f0; background-color:#fafafa; border-radius:5px; margin:5px 0px 0px 0px}


.prv-sticker h4{padding:5px; background:#f5f5f5; margin:5px 0px 5px}
.prv-sticker img{float:left; margin:2px 5px 3px 0px; width:100px; height:70px;}
.prv-sticker hr{margin:5px 0px; color:#fff; background:#fff; height:1px;border:none; border-bottom:1px solid #ccc}
.prv-sticker p{clear:both}

.legend table{background:none !important}
.legend table tr td.legendLabel{padding:2px !important; font-size:12px; vertical-align:middle !important;}
.legend table tr td strong{font-size:16px; color:#000;}
.legend table tr td.legendColorBox{padding:7px 2px 2px 2px !important}
.stats-u,.stats-d{ font-size:10px}
.stats-u{color:#690;}
.stats-d{color:#f00;}
</style>

<div>
<ul class="nav nav-tabs">
<li><a href="/manage/" class="h"> สติกเกอร์ของฉัน</a></li>
<li><a href="/manage/new"><span class="glyphicon glyphicon-plus"></span> เพิ่มสติกเกอร์ใหม่</a></li>
</ul>

<div style="padding:5px; margin-bottom:5px;">
<div id="getview">
<h4 style="padding: 10px; margin: 5px;text-shadow: 1px 1px 0px #000;"><?php echo $this->app['t']?> - <?php echo $this->app['l']?></h4>
<div style="margin:10px">
<div id="chart" style="height:450px; width:600px;"></div>
<div style="margin:10px 0px 0px" id="getstats"></div>
</div>
</div>
</div>
</div>

<script type="text/javascript" src="<?php echo FILES_CDN?>js/jquery/flot/jquery.flot.js"></script>
<script>
var line=<?php echo json_encode($this->k)?>;
$(function(){
	var line1=<?php echo json_encode($this->a)?>;
    var plot = $.plot($("#chart"),
           [ { data: line1, label: 'ผู้เล่น 14วันล่าสุด: <?php echo $this->_a?>',color:'#00BFFF'}], {
               series: {
                   lines: { show: true },
                   points: { show: true },
						 clickable:true,
						 hoverable:true,
						 shadowSize: 2
               },
               grid: { hoverable: true, clickable: true },
				  xaxis: { ticks: <?php echo json_encode($this->x)?>},
              yaxis: { min: 0,},
				  legend: {
					 show: true,
					 labelBoxBorderColor: '#ccc',
					 noColumns: 1,
					 position: 'nw',
					 margin: 3,
					 backgroundColor: '#f8f8f8',
					 backgroundOpacity: 0.6,
				  }
             });
				 
				 
    var previousPoint = null;
    $('#chart').bind('plothover', function (event, pos, item) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
						  if(previousPoint>0 && previousPoint<line.length-1)
						  {
							  $('#tooltip').remove();
							  var y = item.datapoint[1], l=item.series.label.split(':');
							  showTooltip(item.pageX, item.pageY, l[0] + ' = ' + y+' ครั้ง');
						  }
                }
            }
            else {
                $('#tooltip').remove();
                previousPoint = null;            
            }
    });
    $('#chart').bind('plotclick', function (event, pos, item) {
            if (item) {
					var k=line[item.dataIndex];
		 			if(k)_.ajax.gourl('<?php echo URL?>','getstats',k);
            }
    });
	 
	 
    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 5,
            left: x + 5,
            border: '1px solid #000',
            padding: '3px',
            'background-color': '#333',
				color:'#fff',
				'text-shadow':'1px 1px 0px #0',
            opacity: 0.80
        }).appendTo("body").fadeIn(200);
    }
});
</script>
