<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="เกมส์"><i class="icon-home"></i> เกมส์</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/lionica" title="เกมส์สัตว์เลี้ยง "> Lionica (เกมสัตว์เลี้ยง)</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/lionica/play" title="แผนที่ Lionica "> แผนที่</a></li>
</ul>



<div id="lionica_container">
  <div id="lionica">
  <div id="lionica_loading"></div>
  <div id="lionica_init">
  <img id="sprite-map" src="http://s0.boxza.com/static/images/game/lionica/sprite/map.png">
  <img id="sprite-item" src="http://s0.boxza.com/static/images/game/lionica/sprite/item.png">
  <img id="sprite-char" src="http://s0.boxza.com/static/images/game/lionica/sprite/character.png">
  <img id="sprite-npc" src="http://s0.boxza.com/static/images/game/lionica/sprite/npc.png">
  <img id="sprite-monster" src="http://s0.boxza.com/static/images/game/lionica/sprite/monster.png">
  <img id="sprite-boss" src="http://s0.boxza.com/static/images/game/lionica/sprite/boss.png">
  <img id="sprite-warp" src="http://s0.boxza.com/static/images/game/lionica/sprite/warp.png">
  <img id="sprite-farm" src="http://s0.boxza.com/static/images/game/lionica/sprite/farm.png">
  <img id="sprite-pet" src="http://s0.boxza.com/static/images/game/lionica/sprite/pet.png">
  </div>
  
  <div id="lionica_game">
  <?php echo $this->lionica?>
  </div>
  </div>
</div>


<script>
_.lionica.job=<?php echo json_encode($this->job)?>;
_.lionica.npc=<?php echo json_encode($this->npc)?>;
$(window).load(function(e){
	setTimeout(function(){
	$('#lionica_init').css('display','none');
	$('#lionica_loading').css('display','none');
	$('#lionica_character').css('display','block');
	},3000);
});
</script>