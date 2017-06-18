
<ul class="breadcrumb" style="margin-bottom:10px;">
<li><a href="/" title="เกมส์"><i class="icon-home"></i> เกมส์</a></li>
<span class="divider">&raquo;</span>
<li><a href="/lionica" title="เกมส์สัตว์เลี้ยง "> Lionica (เกมส์สัตว์เลี้ยง)</a></li>
<span class="divider">&raquo;</span>
<li><a href="/lionica/rank" title="เกมส์สัตว์เลี้ยง "> อันดับสัตว์เลี้ยง</a></li>
</ul>



<div class="petrank">
<h4>100 อันดับผู้เล่น</h4>
<ul>
<?php for($i=0;$i<count($this->toplevel);$i++):$n=$this->toplevel[$i]?>
<li>
<i class="char char-class-<?php echo $n['job']?>-<?php echo $n['gender']?> char-head-<?php echo $n['gender']?>-<?php echo $n['hair']?>-<?php echo $n['color']?> char-d"><div></div></i>
<p><?php echo $i+1?>. <?php echo $n['n']?> - Lv. <?php echo $n['lv']?>, อาชีพ: <?php echo $this->_job[$n['job']]['name']?>, กิลด์: <?php echo $n['g']?$n['g']['n']:'-'?></p>
<p>Max HP: <?php echo $n['mhp']?>, Max MP: <?php echo $n['mmp']?>, Atk: <?php echo $n['atk']?>, Def: <?php echo $n['def']?>, Hit: <?php echo $n['hit']?>, Flee: <?php echo $n['free']?></p>
</li>
<?php endfor?>
</ul>
</div>
