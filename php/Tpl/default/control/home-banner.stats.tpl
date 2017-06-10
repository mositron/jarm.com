<link rel="stylesheet" type="text/css" href="<?php echo FILES_CDN?>js/ui/jquery-ui-1.10.1.custom.min.css">
<script type="text/javascript" src="<?php echo FILES_CDN?>js/ui/jquery-ui-1.10.1.custom.min.js"></script>



<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
	<span class="divider">&raquo;</span> 
   <li><a href="/banner"><span class="glyphicon glyphicon-eye-open"></span> แบนเนอร์ทั้งหมด</a></li>
 
    <li class="pull-right"><a href="/banner"><span class="glyphicon glyphicon-eye-open"></span> กลับไปหน้ารวม</a></li>
</ul>
 
<h2 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">สถิติ - <?php echo $this->banner['t']?></h2>

<table class="table" width="100%">
<tbody>
<tr><td style="width:120px; text-align:right">ชื่อแบนเนอร์</td><td><?php echo $this->banner['t']?></td></tr>
<tr><td style="width:120px; text-align:right">รูปภาพ/Flash</td><td>
<?php if($this->banner['s']):?>
<?php if($this->banner['ex']=='swf'):?>
<object width="<?php echo $this->banner['w']?>" height="<?php echo $this->banner['h']?>"><param name="movie" value="https://s2.jarm.com/banner/<?php echo $this->banner['fd']?>/<?php echo $this->banner['s']?>"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><param name="wmode" value="transparent"><embed src="https://s2.jarm.com/banner/<?php echo $this->banner['fd']?>/<?php echo $this->banner['s']?>" type="application/x-shockwave-flash" width="<?php echo $this->banner['w']?>" height="<?php echo $this->banner['h']?>" allowscriptaccess="always" allowfullscreen="true" wmode="transparent"></embed></object>
<?php else:?>
<img src="https://s2.jarm.com/banner/<?php echo $this->banner['fd']?>/<?php echo $this->banner['s']?>"><br>
<?php endif?>
<div style="padding:5px; border:1px solid #ddd; background:#f5f5f5;">ประเภทไฟล์: <?php echo $this->banner['ex']?>, กว้าง: <?php echo $this->banner['w']?>, สูง: <?php echo $this->banner['h']?> </div>
<?php endif?>
</td></tr>
<tr><td style="width:120px; text-align:right">ลิ้งค์ปลายทาง</td><td><?php echo $this->banner['l']?></td></tr>
<tr><td style="width:120px; text-align:right">รายละเอียด</td><td><?php echo $this->banner['d']?></td></tr>
<tr><td style="width:120px; text-align:right">ตำแหน่ง</td><td><?php echo $this->position[$this->banner['p']]?></td></tr>
<tr><td style="width:120px; text-align:right">ลำดับในการแสดง</td><td><?php echo $this->banner['so']?></td></tr>
<tr><td style="width:120px; text-align:right">การเผยแพร่</td><td><?php echo $this->banner['pl']?'':'ไม่'?>แสดง</td></tr>
</tbody>
</table>


<h4 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">กราฟแสดงการคลิก 1 เดือนล่าสุด</h4>
<div style="margin:10px">
<div id="chart" style="height:400px; width:730px;"></div>
<div style="margin:10px 0px 0px" id="getstats"></div>
</div>

<script type="text/javascript" src="<?php echo FILES_CDN?>js/jquery/flot/jquery.flot.js"></script>
<script>
var line=<?php echo json_encode($this->k)?>;
$(function(){
	var line1=<?php echo json_encode($this->a)?>;
    var plot = $.plot($("#chart"),
           [ { data: line1, label: 'สถิติ 1 เดือนล่าสุด: <?php echo $this->_a?>',color:'#00BFFF'}], {
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
		 			if(k)inet.ajax.gourl('<?php echo URL?>','getstats',k);
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


<style>
.tblast tr th{ text-align:center;}
.tblast .t{width:100px; text-align:center}
.tblast .s{width:50px; text-align:center}
.tblast .b{ text-align:left; font-size:11px}
</style>

<h4 style="padding:5px; margin:5px; background:#f9f9f9; text-align:center">การคลิก 100 ครั้งล่าสุด</h4>

<table class="table table-striped table-bordered tblast" width="100%">
<thead>
<tr>
<th class="t">Time</th>
<th class="t">IP</th>
<th>User-Agent</th>
<th>Service</th>
<th>Position</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->last);$i++):?>
<tr>
<td class="t"><?php echo self::Time()->from($this->last[$i]['da'],'datetime',true)?></td>
<td class="t"><?php echo $this->last[$i]['ip']?></td>
<td class="b"><?php echo $this->last[$i]['ua']?></td>
<td class="s"><?php echo $this->last[$i]['p']?></td>
<td class="s"><?php echo strtoupper($this->last[$i]['s'])?></td>
</tr>
<?php endfor?>
</tbody>
</table>







