
<h3 class="football-bar">บอลพรุ่งนี้ ตารางบอลพรุ่งนี้</h3>

<?php
if($this->match):
  $_i=0;
  foreach($this->match as $m):
    $l='';
    if($m['list']):
      $tn=self::Time()->day[date('w',self::Time()->sec($m['tm']))].' '.self::Time()->from($m['tm'],'date');
?>
<h3 class="match-bar">บอลวัน<?php echo $tn?></h3>

<table class="match" width="100%">
<thead>
<tr>
<th>เวลา</th>
<th colspan="2">ทีมเจ้าบ้าน</th>
<th>ราคา</th>
<th colspan="2">ทีมเยือน</th>
</tr>
</thead>
<tbody>
<?php foreach($m['list'] as $k=>$v):?>
<?php if($l!=$v['lg']):?>
<tr>
<td colspan="6" class="h"><strong><?php echo $this->_league[$v['lg']]['t']?></strong> -  วัน<?php echo $tn?></td>
</tr>
<?php $l=$v['lg'];$i=0;endif?>
<tr class="l<?php echo $i%2?>">
<td class="t"><?php echo self::Time()->from($v['tm'],'time')?></td>
<td class="i"><a href="/football/match/<?php echo $v['_id']?>"><i><img src="https://s3.jarm.com/football/team/<?php echo $this->_team[$v['t1']['_id']]['fd']?>/s.png" alt="<?php echo $this->_team[$v['t1']['_id']]['t']?>"></i></a></td>
<td class="n"><a href="/football/match/<?php echo $v['_id']?>"> <?php echo $this->_team[$v['t1']['_id']]['t']?></a></td>
<td class="p"><span><?php echo $v['fp']?></span></td>
<td class="n"><a href="/football/match/<?php echo $v['_id']?>"><?php echo $this->_team[$v['t2']['_id']]['t']?></a></td>
<td class="i"><a href="/football/match/<?php echo $v['_id']?>"><i><img src="https://s3.jarm.com/football/team/<?php echo $this->_team[$v['t2']['_id']]['fd']?>/s.png" alt="<?php echo $this->_team[$v['t2']['_id']]['t']?>"></i></a></td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>
<?php endif?>
<?php $_i++;endforeach?>
<?php endif?>
