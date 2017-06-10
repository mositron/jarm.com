<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<link href="<?php echo FILES_CDN?>css/jarm.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="game_online" class="gbox" style="width:550px;">
<div class="gbox_header">เวลาออนไลน์</div>
<div class="gbox_content" style="text-align:center">
<div style="height:500px; overflow:auto">

<div style="padding:5px; text-align:center; background:#f5f5f5; text-shadow:1px 1px 0px #fff;">ออนไลน์ประจำเดือนนี้</div>
<table width="100%" class="table">
<thead>
<tr>
<th>อันดับ</th>
<th>ชื่อ</th>
<th>ออนไลน์ (นาที)</th>
</tr>
</thead>
<tbody>
<?php $j=1;for($i=0;$i<count($this->month);$i++):?>
<?php if($u=$this->month[$i]):?>
  <tr>
  <td style="text-align:center; width:50px;"><?php echo $j?></td>
  <td style="text-align:left;"><a href="/user/<?php echo $u['u']?>" target="_blank"><?php echo _get_nick($u['n']);?></a></td>
  <td style="text-align:center; width:100px;"><?php echo number_format($u['t'])?></td>
    </tr>
<?php $j++;endif?>
 <?php endfor?>
 </tbody>
</table>
</div>
</div>
<div class="gbox_footer"><input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</div>
</body>
</html>
