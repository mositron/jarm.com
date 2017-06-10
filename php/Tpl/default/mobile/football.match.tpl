<div class="mview">
<div class="mv">
<strong><?php echo $this->_league[$this->match['lg']]['t']?></strong>
<span>ราคา: <?php echo $this->match['fp']?></span>
<p>เวลา: <?php echo self::Time()->from($this->match['tm'],'datetime')?></p>
</div>

<div class="bvs">
<h2><span class="left"><?php echo strtoupper($this->team1['n'])?></span><span class="right"><?php echo strtoupper($this->team2['n'])?></span></h2>
<h3><span class="left"><?php echo $this->team1['t']?></span><span class="right"><?php echo $this->team2['t']?></span></h3>
</div>
<div align="center">
<table class="tinfo" align="center">
<tbody>
<tr>
<td class="i1"><img src="https://s3.jarm.com/football/team/<?php echo $this->team1['fd']?>/o.png" alt="<?php echo $this->team1['n']?>"></td>
<td><?php if($this->match['ft']):?><?php echo $this->match['ft']?><?php endif?></td>
<td class="i2"><img src="https://s3.jarm.com/football/team/<?php echo $this->team2['fd']?>/o.png" alt="<?php echo $this->team2['n']?>"></td>
</tr>
</tbody>
</table>
</div>


<?php

$tm1=self::Time()->sec($this->match['tm']) - 1800;
$tm2=$tm1+5400;
$tm3=$tm1+86400;
$now=time();
?>


<?php if($this->match['kd']):?>
<div style="margin:5px 0px; text-align:center;">
<h3 class="hpy">สถิติการแข่งขัน</h3>
<table class="kdetail" align="center">
<thead>
<tr>
<th>ทีม <?php echo $this->_team[$this->match['t1']['_id']]['f']?></th>
<th></th>
<th>ทีม <?php echo $this->_team[$this->match['t2']['_id']]['f']?></th>
</tr>
</thead>
<tbody>
<?php $i=0;foreach($this->match['kd'] as $v):?>
<tr class="l<?php echo $i%2?>">
<td class="n"><?php echo $v['1']?></td>
<td class="m"><?php echo $v['t']?></td>
<td class="n"><?php echo $v['2']?></td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>
</div>
<?php endif?>

<?php if($this->match['ki']):?>
<div style="margin:5px 0px; text-align:center;">
<h3 class="hpy">รายละเอียดการแข่งขัน</h3>
<table class="kinfo" align="center">
<thead>
<tr>
<th colspan="2">รายละเอียดการแข่งขัน ทีม <?php echo $this->_team[$this->match['t1']['_id']]['f']?></th>
<th>นาที</th>
<th colspan="2">รายละเอียดการแข่งขัน ทีม <?php echo $this->_team[$this->match['t2']['_id']]['f']?></th>
</tr>
</thead>
<tbody>
<?php $i=0;$py=['1'=>[],'2'=>[],'i1'=>[],'i2'=>[],'o1'=>[],'o2'=>[]];foreach($this->match['ki'] as $v):?>
<tr class="l<?php echo $i%2?>">
<td class="ty"><?php echo $t1=gtype($v['t1']);$py['1'][$v['n1']].=$t1;?></td>
<td class="n"><?php echo $v['n1']?></td>
<td class="m"><?php echo $v['m']?></td>
<td class="n"><?php echo $v['n2']?></td>
<td class="ty"><?php echo $t2=gtype($v['t2']);$py['2'][$v['n2']].=$t2;?></td>
</tr>
<?php if(preg_match('/^\((\d+)\)\((\d+)\)/i',$v['n1'],$c)): $py['i1'][$c[1]]=true; $py['o1'][$c[2]]=true; endif?>
<?php if(preg_match('/^\((\d+)\)\((\d+)\)/i',$v['n2'],$c)): $py['i2'][$c[1]]=true; $py['o2'][$c[2]]=true; endif?>
<?php $i++;endforeach?>
</tbody>
</table>
<div style="background:#222; padding:5px; border:1px solid #333; margin:0px 5px;">
<?php echo gtype('g')?> คือ ทำประตู,
<?php echo gtype('g1')?> คือ ประตูลูกโทษ,
<?php echo gtype('g2')?> คือ ทำเข้าประตูตัวเอง,
<?php echo gtype('y')?> คือ ใบเหลือง,
<?php echo gtype('r')?> คือ ใบแดง,
<?php echo gtype('p')?> คือ เปลี่ยนตัว
</div>
</div>
<?php endif?>



<?php
$real=false;
if($this->match['py'])
{
  $py1=$this->match['py']['t1'];
  $real=true;
}
elseif($this->team1['py'])
{
  $py1=$this->team1['py'];
}
if($this->match['py']['t2'])
{
  $py2=$this->match['py']['t2'];
  $real=true;
}
elseif($this->team2['py'])
{
  $py2=$this->team2['py'];
}

if($py1||$py2):
?>
<div style="margin:5px 0px;">
<h3 class="hpy">รายชื่อนักเตะ<?php if(!$real):?>ที่คาดว่าจะลงสนาม<?php endif?></h3>
<div>
<?php
if($py1):
?>
<h4 align="center" style="color:#fff;">นักเตะของ <?php echo $this->_team[$this->match['t1']['_id']]['f']?></h4>
<div>
<div style="width:48%; float:left">
<ul class="player">
<?php foreach($py1['r'] as $v):?>
<li<?php if($py['o1'][$v['i']]):?> class="out"<?php endif?>><i><?php echo $v['i']?></i> <?php echo $v['n']?> <?php if($py['1'][$v['n']]): echo $py['1'][$v['n']]; endif;?> <?php if($py['i1'][$v['i']]):?> <i class="icon-in"></i> <?php endif?> <?php if($py['o1'][$v['i']]):?> <i class="icon-out"></i> <?php endif?></li>
<?php endforeach?>
</ul>
</div>
<div style="width:48%; float:left">
<ul class="player pl2">
<?php foreach($py1['s'] as $v):?>
<li<?php if($py['i1'][$v['i']]):?> class="in"<?php endif?>><i><?php echo $v['i']?></i> <?php echo $v['n']?> <?php if($py['1'][$v['n']]): echo $py['1'][$v['n']]; endif;?> <?php if($py['i1'][$v['i']]):?> <i class="icon-in"></i> <?php endif?> <?php if($py['o1'][$v['i']]):?> <i class="icon-out"></i> <?php endif?></li>
<?php endforeach?>
</ul>
</div>
<div class="clear"></div>
</div>
<?php endif?>
</div>
<div>
<?php
if($py2):
?>
<h4 align="center" style="color:#fff;">นักเตะของ <?php echo $this->_team[$this->match['t2']['_id']]['f']?></h4>
<div>
<div style="width:48%; float:left">
<ul class="player">
<?php foreach($py2['r'] as $v):?>
<li<?php if($py['o2'][$v['i']]):?> class="out"<?php endif?>><i><?php echo $v['i']?></i> <?php echo $v['n']?> <?php if($py['2'][$v['n']]): echo $py['2'][$v['n']]; endif;?> <?php if($py['i2'][$v['i']]):?> <i class="icon-in"></i> <?php endif?> <?php if($py['o2'][$v['i']]):?> <i class="icon-out"></i> <?php endif?></li>
<?php endforeach?>
</ul>
</div>
<div style="width:48%; float:left">
<ul class="player pl2">
<?php foreach($py2['s'] as $v):?>
<li<?php if($py['i2'][$v['i']]):?> class="in"<?php endif?>><i><?php echo $v['i']?></i> <?php echo $v['n']?> <?php if($py['2'][$v['n']]): echo $py['2'][$v['n']]; endif;?> <?php if($py['i2'][$v['i']]):?> <i class="icon-in"></i> <?php endif?> <?php if($py['o2'][$v['i']]):?> <i class="icon-out"></i> <?php endif?></li>
<?php endforeach?>
</ul>
</div>
<div class="clear"></div>
</div>
<?php endif?>
</div>
<div class="clear"></div>
</div>
<?php endif?>


<div style="margin:5px 0px 0px 0px">
<div>
<?php if($this->match1 && is_array($this->match1)):?>
<h3 class="hs">5 นัดล่าสุดของ <?php echo $this->_team[$this->match['t1']['_id']]['f']?></h3>
<table class="match">
<tbody>
<?php
foreach($this->match1 as $k=>$v):
if($v['ft']):
  list($ot,$rs,$st)=getmatchrs($this->match['t1']['_id'],$v);
?>
<tr>
<td style="width:50px; text-align:center; background:#222"><?php echo $rs?></td>
<td class="i"><i><img src="https://s3.jarm.com/football/team/<?php echo $this->_team[$ot]['fd']?>/s.png" alt="<?php echo $this->_team[$ot]['f']?>"></i></td>
<td class="n"><?php echo $this->_team[$ot]['f']?></td>
<td class="r"><?php echo $v['ft']?></td>
<td class="n"><?php echo $st?></td>
<td class="dt"><a href="/football/match/<?php echo $v['_id']?>">ผลบอล</a></td>
</tr>
<?php endif;endforeach?>
</tbody>
</table>
<?php endif?>
</div>
<div>
<?php if($this->match2 && is_array($this->match2)):?>
<h3 class="hs">5 นัดล่าสุดของ <?php echo $this->_team[$this->match['t2']['_id']]['t']?></h3>
<table class="match">
<tbody>

<?php
foreach($this->match2 as $k=>$v):
if($v['ft']):
  list($ot,$rs,$st)=getmatchrs($this->match['t2']['_id'],$v);
?>
<tr>
<td style="width:50px; text-align:center; background:#222"><?php echo $rs?></td>
<td class="i"><i><img src="https://s3.jarm.com/football/team/<?php echo $this->_team[$ot]['fd']?>/s.png" alt="<?php echo $this->_team[$ot]['f']?>"></i></td>
<td class="n"><?php echo $this->_team[$ot]['f']?></td>
<td class="r"><?php echo $v['ft']?></td>
<td class="n"><?php echo $st?></td>
<td class="dt"><a href="/football/match/<?php echo $v['_id']?>">ผลบอล</a></td>
</tr>
<?php endif; endforeach?>
</tbody>
</table>
<?php endif?>
</div>
<div class="clear"></div>
</div>
<div style="margin:5px 0px 0px 0px">
<div>
<?php if($this->match3 && is_array($this->match3)):?>
<h3 class="hs">5 นัดในบ้านล่าสุดของ <?php echo $this->_team[$this->match['t1']['_id']]['f']?></h3>
<table class="match">
<tbody>
<?php
foreach($this->match3 as $k=>$v):
if($v['ft']):
  list($ot,$rs,$st)=getmatchrs($this->match['t1']['_id'],$v);
?>
<tr>
<td style="width:50px; text-align:center; background:#222"><?php echo $rs?></td>
<td class="i"><i><img src="https://s3.jarm.com/football/team/<?php echo $this->_team[$ot]['fd']?>/s.png" alt="<?php echo $this->_team[$ot]['f']?>"></i></td>
<td class="n"><?php echo $this->_team[$ot]['f']?></td>
<td class="r"><?php echo $v['ft']?></td>
<td class="n"><?php echo $st?></td>
<td class="dt"><a href="/football/match/<?php echo $v['_id']?>">ผลบอล</a></td>
</tr>
<?php endif;endforeach?>
</tbody>
</table>
<?php endif?>
</div>
<div>
<?php if($this->match4 && is_array($this->match4)):?>
<h3 class="hs">5 นัดนอกบ้านล่าสุดของ <?php echo $this->_team[$this->match['t2']['_id']]['t']?></h3>
<table class="match">
<tbody>

<?php
foreach($this->match4 as $k=>$v):
if($v['ft']):
  list($ot,$rs,$st)=getmatchrs($this->match['t2']['_id'],$v);
?>
<tr>
<td style="width:50px; text-align:center; background:#222"><?php echo $rs?></td>
<td class="i"><i><img src="https://s3.jarm.com/football/team/<?php echo $this->_team[$ot]['fd']?>/s.png" alt="<?php echo $this->_team[$ot]['f']?>"></i></td>
<td class="n"><?php echo $this->_team[$ot]['f']?></td>
<td class="r"><?php echo $v['ft']?></td>
<td class="n"><?php echo $st?></td>
<td class="dt"><a href="/football/match/<?php echo $v['_id']?>">ผลบอล</a></td>
</tr>
<?php endif; endforeach?>
</tbody>
</table>
<?php endif?>
</div>
<div class="clear"></div>
</div>
<?php if($this->score && count($this->score)):?>
<h3 class="hpy" style="margin-top:5px;"><i></i> อันดับในตารางคะแนน</h3>
<table class="score score2">
<thead>
<tr>
<th>ลีก</th>
<th colspan="2">ทีม</th>
<th>อันดับ</th>
<th>เตะ</th>
<th>ชนะ</th>
<th>เสมอ</th>
<th>แพ้</th>
<th>ได้</th>
<th>เสีย</th>
<th class="p">คะแนน</th>
</tr>
</thead>
<tbody>
<?php foreach($this->score as $k=>$v):?>
<tr class="l<?php echo $k%2?>">
<td style="width:150px; color:#FAAF40"><p><?php echo $this->_league[$v['lg']]['t']?></p></td>
<td class="i"><i><img src="https://s3.jarm.com/football/team/<?php echo $this->_team[$v['t']['_id']]['fd']?>/s.png" alt="<?php echo $this->_team[$v['t']['_id']]['f']?>"></i></td>
<td class="n"><p><?php echo $this->_team[$v['t']['_id']]['f']?></p></td>
<td><?php echo ($this->_league[$v['lg']]['ty']=='c'?(($v['r']-1)%4)+1:$v['r'])?></td>
<td><?php echo $v['k']?></td>
<td><?php echo $v['w']?></td>
<td><?php echo $v['d']?></td>
<td><?php echo $v['l']?></td>
<td><?php echo $v['g']?></td>
<td><?php echo $v['m']?></td>
<td class="p"><?php echo $v['p']?></td>
</tr>
<?php endforeach?>
</tbody>
</table>
<?php endif?>
</div>
