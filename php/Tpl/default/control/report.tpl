<style>
th{text-align:right;padding:2px !important;}
/*.writer{display:none;}*/
.writer img{width:30px;height:30px;}
td{text-align:right;font-size:13px;padding:3px 1px !important;}
.black{color:#000;}
.blue{color:#52BBC3;font-size:24px;text-align:center;}
.bar{height:100px;position:relative;border-bottom:1px solid #000;}
.bar>div{width:30px;margin:0px auto;overflow:hidden;color:#ccc;border-top-left-radius:15px;border-top-right-radius:15px;border-bottom:none;position:absolute;right:2px;bottom:0px;background:#52BBC3;text-align:center;}
.bar>div span{border-radius:20px;width:20px;height:20px;line-height:20px;overflow:hidden;background:#fff;display:inline-block;margin-top:5px;color:#52BBC3;}
.score>div{white-space:nowrap;}
.l{background:#f7f7f7;}
.score>div span{display:inline-block;overflow:hidden;width:6px;height:3px;margin-left:2px;margin-top:-1px;vertical-align:middle;}
/*.score>div.l span{margin-right:2px;margin-left:0px;}*/
span.down{width:0;height:0;border-left:3px solid transparent;border-right:3px solid transparent;border-top:3px solid #f00;}
span.up{width:0;height:0;border-left:3px solid transparent;border-right:3px solid transparent;border-bottom:3px solid #090;}
</style>
<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/report">รายงานระบบข่าว</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/report/<?php echo self::$path[1]?>"><?php echo self::Time()->month[intval(substr($this->date,4))-1].' '.(substr($this->date,0,4)+543)?></a></li>
</ul>
<?php
$sum=0;
$sum2=0;
$write=[];
$tmp=[];
for($i=0;$i<count($this->view);$i++):
  $v=$this->view[$i];
  $this->view[$i]['all']=intval($v['is'])+intval($v['do']);
  foreach($this->admin as $u):
    if($ur=$v['ur'][$u['_id']]):
      if(!isset($write[$u['_id']])):
        $write[$u['_id']]=0;
      endif;
      $write[$u['_id']]+=$ur;
    endif;
    $view=intval($v['u'][$u['_id']]);
    $tmp[$u['_id']]+=$view;
  endforeach;
endfor;

$all=[];
foreach($write as $k=>$v):
  $all[$k]=$tmp[$k];
endforeach;

$num = array_values($all);
$min = min($num);
$max = max($num);
$diff = $max-$min;
$k=[];
if($diff>0):
  $k=$all;
else:
  $k=$write;
endif;
arsort($k);
$k=array_keys($k);

$num2 = array_values($write);
$min2 = min($num2);
$max2 = max($num2);
$diff2 = $max2-$min2;
?>
<h4 class="bar-heading"></h4>
<table class="table">
<tbody>
<?php for($i=0;$i<count($this->view);$i++):$v=$this->view[$i];$date=substr($v['date'],0,4).'-'.substr($v['date'],4,2).'-'.substr($v['date'],6,2)?>
<tr>
<td class="blue" width="50"><?php echo intval(substr($v['date'],6))?></td>
<?php foreach($k as $u):
  if(!$ur=$v['ur'][$u])
  {
    $ur=0;
  }
?>
<td class="u<?php echo $u?> score writer">
  <div><?php echo number_format($v['u'][$u])?><span<?php if($i>0):?> class="<?php echo $v['u'][$u]>$this->view[$i-1]['u'][$u]?'up':($v['u'][$u]<$this->view[$i-1]['u'][$u]?'down':'')?>"<?php endif?>></span></div>
  <div class="l"><a href="/news/report/<?php echo $date?>/#u<?php echo $u?>" target="_blank"><?php echo number_format($ur)?><span<?php if($i>0):$uro=intval($this->view[$i-1]['ur'][$u]);?> class="<?php echo $ur>$uro?'up':($ur<$uro?'down':'')?>"<?php endif?>></span></a></div>
</td>
<?php endforeach?>
<td class="black score">
  <div><?php echo number_format($v['all'])?><?php $sum+=$v['all'];?><span<?php if($i>0):?> class="<?php echo $v['all']>$this->view[$i-1]['all']?'up':($v['all']<$this->view[$i-1]['all']?'down':'')?>"<?php endif?>></span></div>
  <div class="l"><?php $urc=intval($v['urc']);$urco=intval($this->view[$i-1]['urc']);?><?php $sum2+=$urc;?><?php echo number_format($urc)?><span<?php if($i>0):?> class="<?php echo $urc>$urco?'up':($urc<$urco?'down':'')?>"<?php endif?>></span></div>
</td>
</tr>
<?php endfor?>
<tr><td colspan="<?php echo count($k)+2?>">...</td></tr>
<?php
if($diff>0):
?>
<tr>
  <td></td>
  <?php foreach($k as $id=>$u):$p=(($all[$u]-$min)/$diff)?>
  <td class="u<?php echo $u?> bar writer" data-perc="<?php echo $p?>"><div style="height:<?php echo floor($p*65)+30?>px"><span><?php echo $id+1?></span></div></td>
  <?php endforeach?>
  <td></td>
</tr>
<tr>
  <td rowspan="2" style="vertical-align:middle;">อ่าน</td>
  <?php foreach($k as $id=>$u):$p=(($all[$u]-$min)/$diff)?>
  <td class="u<?php echo $u?>"><?php echo ceil($p*100)?>%</td>
  <?php endforeach?>
  <td></td>
</tr>
<?php endif?>
<tr>
  <?php if($diff<=0):?><td>อ่าน</td><?php endif?>
  <?php foreach($k as $u):?>
  <td class="u<?php echo $u?> writer"><div><?php echo number_format($all[$u])?></div></td>
  <?php endforeach?>
  <td class="black"><?php echo number_format($sum)?></td>
</tr>


<?php
if($diff2>0):
?>
<tr>
  <td></td>
  <?php foreach($k as $id=>$u):$p=(($write[$u]-$min2)/$diff2)?>
  <td class="u<?php echo $u?> bar writer" data-perc="<?php echo $p?>" style="height:55px;"><div style="height:<?php echo floor($p*49)+1?>px;"></div></td>
  <?php endforeach?>
  <td></td>
</tr>
<tr>
  <td rowspan="2" style="vertical-align:middle;"><div class="l">เขียน</div></td>
  <?php foreach($k as $id=>$u):$p=(($write[$u]-$min2)/$diff2)?>
  <td class="u<?php echo $u?>"><div class="l"><?php echo ceil($p*100)?>%</div></td>
  <?php endforeach?>
  <td></td>
</tr>
<?php endif?>
<tr>
  <?php if($diff2<=0):?><td><div class="l">เขียน</div></td><?php endif?>
  <?php foreach($k as $u):?>
  <td class="u<?php echo $u?> writer"><div class="l"><?php echo number_format($write[$u])?></div></td>
  <?php endforeach?>
  <td class="black"><div class="l"><?php echo number_format($sum2)?></div></td>
</tr>
</tbody>
<thead>
<tr>
<th width="50">วันที่</th>
<?php foreach($k as $u):$ur=$this->user->get($u,true);?>
<th class="u<?php echo $u?> writer"><a href="<?php echo $ur['link']?>" title="<?php echo $ur['name']?>" target="_blank"><img src="<?php echo $ur['img']?>"></a></th>
<?php endforeach?>
<th style="text-align:right">รวม</th>
</tr>
</thead>
<tfoot>
<th></th>
<?php foreach($k as $u):$ur=$this->user->get($u,true);?>
<th class="u<?php echo $u?> writer"><a href="<?php echo $ur['link']?>" title="<?php echo $ur['name']?>" target="_blank"><img src="<?php echo $ur['img']?>"></a></th>
<?php endforeach?>
<th style="text-align:right">รวม</th>
</tfoot>
</table>
<style>
<?php /*foreach($write as $k=>$v):?>
.writer.u<?php echo $k?>{display:table-cell;}
<?php endforeach*/?>
</style>
<h4 class="bar-heading">ประจำเดือน</h4>
<a href="/report">เดือนนี้</a><?php
for($i=intval(date('Ym'))-1;$i>=intval(date('Y').'01');$i--):
?>
, <a href="/report/<?php echo $i?>"><?php echo self::Time()->month[intval(substr($i,4))-1].' '.(substr($i,0,4)+543)?></a>
<?php endfor?>

<script>
var percentColors = [ //52bbc3  ,  d6c93e , 3dcc6c
    { pct: 0.0, color: { r: 0xff, g: 0x00, b: 0 } },
    { pct: 0.5, color: { r: 0xd6, g: 0xc9, b: 0x3e } },
    { pct: 1.0, color: { r: 0x3d, g: 0xcc, b: 0x6c } } ];
var getColorForPercentage = function(pct) {
    for (var i = 1; i < percentColors.length - 1; i++) {
        if (pct < percentColors[i].pct) {
            break;
        }
    }
    var lower = percentColors[i - 1];
    var upper = percentColors[i];
    var range = upper.pct - lower.pct;
    var rangePct = (pct - lower.pct) / range;
    var pctLower = 1 - rangePct;
    var pctUpper = rangePct;
    var color = {
        r: Math.floor(lower.color.r * pctLower + upper.color.r * pctUpper),
        g: Math.floor(lower.color.g * pctLower + upper.color.g * pctUpper),
        b: Math.floor(lower.color.b * pctLower + upper.color.b * pctUpper)
    };
    return 'rgb(' + [color.r, color.g, color.b].join(',') + ')';
    // or output as hex if preferred
}
$(function(){
  $('.bar').each(function(){
    var t=$(this),pc=parseFloat(t.data('perc'));
    t.find('div').css('background',getColorForPercentage(pc));
  });
});
</script>
