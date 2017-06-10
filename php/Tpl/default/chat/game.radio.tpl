<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="UTF-8">
<link href="<?php echo FILES_CDN?>css/jarm.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="game_radio" class="gbox" style="width:450px;">
<div class="gbox_header">ตารางเวลา PJ</div>
<div class="gbox_content" style="text-align:center">
<div style="height:400px; overflow:auto">
<?php if($this->pj):?>
<div style="padding:5px; text-align:center; background:#f5f5f5; text-shadow:1px 1px 0px #fff;">ตารางเวลา PJ ประจำ jarm.com</div>
<table width="100%" class="table">
<thead>
<tr>
<th style="text-align:center;">ชื่อ</th>
<th style="text-align:center; width:200px;">เวลา</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->pj);$i++):?>
<tr>
<td style="text-align:center;"><?php $u=$this->user->get($this->pj[$i]['u']);?><a href="<?php echo $u['link']?>" target="_blank"><?php echo _get_nick($u['name']);?></a></td>
<td style="text-align:center; width:200px;"><?php echo $this->pj[$i]['t']?></td>
</tr>
<?php endfor?>
</tbody>
</table>
<?php endif?>


<div style="padding:5px; text-align:center; background:#f5f5f5; text-shadow:1px 1px 0px #fff; margin:10px 0px 0px 0px">ประวัติการเตะ Auto DJ / PJ  (<a href="javascript:;" onClick="_.ajax.gourl('/game/radio','kickdj');">เตะ</a>)</div>

<table width="100%" class="table">
<thead>
<tr>
<th style="text-align:center;">ชื่อ</th>
<th style="text-align:center; width:200px;">เวลา</th>
</tr>
</thead>
<tbody>
<?php for($i=0;$i<count($this->kick);$i++):?>
<tr>
<td style="text-align:center;"><?php $u=$this->user->get($this->kick[$i]['u']);?><a href="<?php echo $u['link']?>" target="_blank"><?php echo _get_nick($u['name']);?></a></td>
<td style="text-align:center; width:200px;"><?php echo self::Time()->from($this->kick[$i]['da'],'datetime')?></td>
</tr>
<?php endfor?>
</tbody>
</table>
</div>
</div>
<div class="gbox_footer"><input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</div>
</body>
</html>
