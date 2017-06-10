<style>
h2 small{font-size:12px;}
.score2 ._hm,.score2 tr td._hm{ background:#262626;}
.score2 ._aw,.score2 tr td._aw{ background:#2c2c2c}
.score2 tr td.p{font-weight:bold}
.score2 tr.l0 td._hm{ background:#1c1c1c;}
.score2 tr.l0 td._aw{ background:#222}
.score tr th {vertical-align: middle;}
._tt2{border-bottom:1px solid #111;color:#F05A28 !important}
._hm2{border-bottom:1px solid #191919;color:#F05A28 !important}
._aw2{border-bottom:1px solid #222; color:#F05A28 !important}
</style>
<ul class="football-tabs">
<?php foreach($this->league as $k=>$v):?>
<li><a href="/football/score/<?php echo $k?>" title="ตารางคะแนน <?php echo $v['t']?>"<?php echo self::$path[1]==$k?' class="active"':''?>><span><?php echo $v['t2']?></span></a></li>
<?php endforeach?>
<p class="clear"></p>
</ul>

<h3 class="football-bar"><?php echo $this->_league[self::$path[1]]['t']?> <?php echo $this->_league[self::$path[1]]['s']?></h3>

<?php 
		if($this->score && count($this->score)):
			$pp=$co=count($this->score);
			$no=ceil($co/$pp);	
			foreach($this->score as $k=>$v):
?>

<?php if($k%$pp==0):?>
<table class="score score2">
<thead>
<tr>
<th rowspan="2">อันดับ</th>
<th rowspan="2" colspan="2">ทีม</th>
<th colspan="6" class="_tt2">ทั้งหมด</th>
<th rowspan="2" class="gd">GD</th>
<th rowspan="2" class="p">คะแนน</th>
</tr>
<tr>
<th>เตะ</th>
<th>ชนะ</th>
<th>เสมอ</th>
<th>แพ้</th>
<th>ได้</th>
<th>เสีย</th>
</tr>
</thead>
<tbody>
<?php endif?>
<tr class="l<?php echo $k%2?>">
<td><?php echo $v['r']?></td>
<td class="i"><i><img src="https://s3.jarm.com/football/team/<?php echo $this->_team[$v['t']['_id']]['fd']?>/s.png" alt="<?php echo $this->_team[$v['t']['_id']]['f']?>"></i></td>
<td class="n"><p><!--a href="/team/<?php echo $this->_team[$v['t']['_id']]['l']?>"--><?php echo $this->_team[$v['t']['_id']]['f']?><!--/a--></p></td>
<td><?php echo $v['k']?></td>
<td><?php echo $v['w']?></td>
<td><?php echo $v['d']?></td>
<td><?php echo $v['l']?></td>
<td><?php echo $v['g']?></td>
<td><?php echo $v['m']?></td>
<td class="gd"><?php echo intval($v['g'])-intval($v['m'])?></td>
<td class="p"><?php echo $v['p']?></td>
</tr>

<?php if($k%$pp==($pp-1)):?>
</tbody>
</table>
<?php endif?>
<?php endforeach?>
<?php endif?>


