<ul class="breadcrumb" style="margin-bottom:5px;">
<li><a href="/" title="เกมส์"><i class="icon-home"></i> เกมส์</a></li>
<span class="divider">&raquo;</span>
<li><a href="/lionica" title="เกมส์สัตว์เลี้ยง "> Lionica (เกมส์สัตว์เลี้ยง)</a></li>
<span class="divider">&raquo;</span>
<li>ข้อมูลแผนที่, NPC, มอนสเตอร์</li>
<span class="divider">&raquo;</span>
<li><a href="/lionica/info/map/<?php echo $this->map['_id']?>" title="แผนที่ <?php echo $this->map['name']?> "> <?php echo $this->map['name']?></a></li>
</ul>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>

<style>
.img-monster{display:inline-block; width:32px; height:48px; background:url(http://s0.boxza.com/static/images/game/lionica/sprite/monster.png) 0px 0px no-repeat;}
.img-npc{display:inline-block; width:32px; height:48px; background:url(http://s0.boxza.com/static/images/game/lionica/sprite/npc.png) 0px 0px no-repeat;}
.img-item{display:inline-block; width:24px; height:24px; background:url(http://s0.boxza.com/static/images/game/lionica/sprite/item.png) 0px 0px no-repeat;}
.img-block{width:50px; text-align:center;}
.table td.img-cap{text-align:right; width:95px; background:#f5f5f5; color:#555; text-shadow:1px 1px 0px #fff;}
.table td.img-cap small{font-size:10px}
.table td,.table th{padding:4px; line-height:1.6em;}
</style>
<div style="padding:5px">
<h2>แผนที่: <?php echo $this->map['name']?></h2>
<p>
<img src="http://s0.boxza.com/static/images/game/lionica/info/map/<?php echo $this->map['_id']?>.png">
</p>

<?php if(is_array($this->npc)):?>
<h4>NPC</h4>
<table class="table" width="100%">
<?php foreach($this->npc as $k=>$v):?>
<tr>
<td rowspan="2" class="img-block">
<i class="img-npc" style="background-position:<?php echo $v['css']?>"></i>
</td>
<td colspan="2"><strong><?php echo $v['name']?></strong> - <?php echo $v['detail']?></td>
</tr>
<tr><td class="img-cap">ตำแหน่ง</td><td><?php echo $v['loc']?></td></tr>
<?php endforeach?>
</table>
<?php endif?>

<?php if(is_array($this->monster)):?>
<h4>Monster</h4>
<table class="table" width="100%">
<?php foreach($this->monster as $k=>$v):?>
<tr>
<td rowspan="4" class="img-block">
<i class="img-monster" style="background-position:<?php echo $v['css']?>"></i>
</td>
<td colspan="8"><strong><?php echo $v['name']?></strong></td>
</tr>
<tr><td class="img-cap">LV <small>(เลเวล)</small></td><td><?php echo $v['lv']?></td><td class="img-cap">HP <small>(เลือด)</small></td><td><?php echo $v['hp']?></td><td class="img-cap">Element <small>(ธาตุ)</small></td><td><?php echo $this->element[$v['ele']]?></td><td class="img-cap">Exp <small>(ประสบการณ์)</small></td><td><?php echo $v['exp']?></td></tr>
<tr><td class="img-cap">Atk <small>(โจมตี)</small></td><td><?php echo $v['atk']?></td><td class="img-cap">Def <small>(ป้องกัน)</small></td><td><?php echo $v['def']?></td><td class="img-cap">Hit <small>(แม่นยำ)</small></td><td><?php echo $v['hit']?></td><td class="img-cap">Flee <small>(หลบหลีก)</small></td><td><?php echo $v['free']?></td></tr>
<tr><td class="img-cap">Drop <small>(ไอเท็ม)</small></td><td colspan="7"><?php echo $v['drop']?></td></tr>
<?php endforeach?>
</table>
<?php endif?>
</div>

<div style="padding:5px; margin:5px 0px; background:#f5f5f5; border-radius:5px;">*** ไอเท็มที่มอนสเตอร์ทุกตัวดรอปเหมือนกัน: <i class="img-item" style="background-position:-120px -360px"></i> Guild Coin, <i class="img-item" style="background-position:-168px -360px"></i> Attack Crystal, <i class="img-item" style="background-position:-192px -360px"></i> Defence Crystal, <i class="img-item" style="background-position:0px -384px"></i> Earth Stone, <i class="img-item" style="background-position:-24px -384px"></i> Water Stone, <i class="img-item" style="background-position:-48px -384px"></i> Fire Stone, <i class="img-item" style="background-position:-72px -384px"></i> Wind Stone, <i class="img-item" style="background-position:-96px -384px"></i> Thunder Stone
</div>


 
<div class="fb-comments" data-href="http://game.boxza.com/lionica/info/map/<?php echo $this->map['_id']?>" data-num-posts="50" data-width="710"></div>
 