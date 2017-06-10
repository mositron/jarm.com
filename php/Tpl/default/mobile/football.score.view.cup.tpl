<style>
.match2 tr td{width:50px;}
.match2 tr td.n{text-align:left; width:auto}
h2 small{font-size:12px;}
</style>

<ul class="football-tabs">
<?php foreach($this->league as $k=>$v):?>
<li><a href="/football/score/<?php echo $k?>" title="ตารางคะแนน <?php echo $v['t']?>"<?php echo self::$path[1]==$k?' class="active"':''?>><span><?php echo $v['t2']?></span></a></li>
<?php endforeach?>
<p class="clear"></p>
</ul>

<h2 class="football-bar"><i></i> ตารางคะแนนฟุตบอล <?php echo $this->_league[self::$path[1]]['t']?> ฤดูกาล <?php echo $this->_league[self::$path[1]]['s']?> <small>ตารางอันดับฟุตบอล <?php echo $this->_league[self::$path[1]]['t']?> ฤดูกาล <?php echo $this->_league[self::$path[1]]['s']?></small></h2>

<?php 
		if($this->score && count($this->score)):
			$ty=['A','B','C','D','E','F','G','H','I','J','K','L','M','N'];	
			$pp=4;
			$p2=2;
			$co=count($this->score);
			$no=ceil($co/$pp);
			foreach($this->score as $k=>$v):
?>

<?php if($k%$pp==0):?>
<h3 class="hs"><?php echo $this->_league[self::$path[1]]['t']?> - กลุ่ม <?php echo $ty[intval($k/$pp)]?></h3>
<table class="score score2">
<thead>
<tr>
<th>อันดับ</th>
<th colspan="2">ทีม</th>
<th>เตะ</th>
<th>ชนะ</th>
<th>เสมอ</th>
<th>แพ้</th>
<th>ได้</th>
<th>เสีย</th>
<th class="gd">GD</th>
<th class="p">คะแนน</th>
</tr>
</thead>
<tbody>
<?php endif?>
<tr class="l<?php echo $k%2?>">
<td><?php echo $r=(($k%$pp)+1)?></td>
<td class="i"><i><img src="https://s3.jarm.com/football/team/<?php echo $this->_team[$v['t']['_id']]['fd']?>/s.png" alt="<?php echo $this->_team[$v['t']['_id']]['f']?>"></i></td>
<td class="n<?php echo $r<=$p2?' n2':''?>"><p><!--a href="/team/<?php echo $this->_team[$v['t']['_id']]['l']?>"--><?php echo $this->_team[$v['t']['_id']]['f']?><!--/a--></p></td>
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

