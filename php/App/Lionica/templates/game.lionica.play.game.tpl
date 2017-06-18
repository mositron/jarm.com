<div class="b-char">
  <div class="name"><span id="char_lv"><?php echo $this->char['lv']?></span> <span><?php echo $this->char['n']?></span></div>
  <div class="char char-class-<?php echo $this->char['job']?>-<?php echo $this->char['gender']?> char-head-<?php echo $this->char['gender']?>-<?php echo $this->char['hair']?>-<?php echo $this->char['color']?> char-d">
    <div></div>
  </div>
  <div class="status">
    <div id="char_hp">
      <div id="char_hp_bar" style="width:<?php echo intval(($this->char['hp']/$this->char['mhp'])*100)?>%;"></div>
      <div id="char_hp_text"><?php echo $this->char['hp']?> / <?php echo $this->char['mhp']?></div>
    </div>
    <div id="char_mp">
      <div id="char_mp_bar" style="width:<?php echo intval(($this->char['mp']/$this->char['mmp'])*100)?>%;"></div>
      <div id="char_mp_text"><?php echo $this->char['mp']?> / <?php echo $this->char['mmp']?></div>
    </div>
  </div>
</div>
<div class="b-pet">
  <div id="pet-icon"></div>
  <div class="status">
    <div id="pet_hp">
      <div id="pet_hp_bar"></div>
      <div id="pet_hp_text"></div>
    </div>
    <div id="pet_xp">
      <div id="pet_xp_bar"></div>
      <div id="pet_xp_text"></div>
    </div>
  </div>
</div>
<div class="b-exp">
  <div>
    <div id="char_exp_text"><?php echo $this->char['hp']?> / <?php echo $this->char['mhp']?></div>
    <div id="char_exp" style="width:<?php echo floor(($this->char['xp']/$this->char['mxp'])*100)?>%"></div>
    <span style="left:10%"></span> <span style="left:20%"></span> <span style="left:30%"></span> <span style="left:40%"></span> <span style="left:50%"></span> <span style="left:60%"></span> <span style="left:70%"></span> <span style="left:80%"></span> <span style="left:90%"></span> </div>
</div>
<div class="lbox lmove drop">
  <div class="name">
    <div class="text">ไอเท็มที่รอเก็บ (<span id="drop_ea">0</span>/100)</div>
  </div>
  <div class="drop_div">
    <div id="drop_text"></div>
  </div>
</div>
<!--div class="lbox" style="position: absolute;bottom: 200px;left: 5px;width: 320px;z-index: 9999;padding: 5px 0px;background: rgba(0,0,0,0.4);color: #f00;text-shadow: 1px 1px 0px #000;text-align: center;">ขณะนี้ EXP x10, DROP x100 จนปิด Close Beta</div-->
<div class="lbox logs">
  <div class="logs_div">
    <div id="logs_text"></div>
  </div>
</div>
<div class="lbox lmove lresize guild">
  <div class="name">
    <div class="text">กิลด์</div>
    <div class="close" onClick="_.lionica.box('guild','none');">X</div>
  </div>
  <div class="guild_div bresize">
    <div id="guild_text">กรุณารอซักครู่...</div>
  </div>
</div>
<div class="lbox lmove shop">
  <div class="name">
    <div class="text">ร้านค้า</div>
    <div class="close" onClick="_.lionica.box('shop','none');">X</div>
  </div>
  <div class="shop_div bresize">
    <div id="shop_text">กรุณารอซักครู่...</div>
  </div>
</div>
<div class="lbox chat">
  <div class="chat_div">
    <div id="chat_text"></div>
  </div>
  <div class="chat_input"><span class="dropup"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span>ทั่วไป</span> <b class="caret"></b></a>
    <ul class="dropdown-menu">
      <li><a href="javascript:;" onclick="_.lionica.chat.to='map';$('.chat_input span > a > span').html('ทั่วไป');">ทั่วไป</a></li>
      <li><a href="javascript:;" onclick="_.lionica.chat.to='guild';$('.chat_input span > a > span').html('กิลด์');">กิลด์</a></li>
      <li><a href="javascript:;" onclick="_.lionica.chat.to='shout';$('.chat_input span > a > span').html('ตะโกน');">ตะโกน</a></li>
    </ul>
    </span>
    <input type="text" maxlength="100">
  </div>
</div>
<div class="minimap">
  <div class="name">
    <div class="text"></div>
  </div>
  <div class="minimap_area">
    <div class="minimap_div">
      <div class="minimap_move">
        <div class="minimap_text">
          <canvas id="minimap_canvas"></canvas>
          <div class="plot" id="plot"></div>
        </div>
      </div>
    </div>
    <div class="minimap_show">
      <label>
        <input type="checkbox" name="show-people" value="1"  onClick="_.lionica.render.show(this,'people')" checked>
        ผู้เล่นอื่น</label>
      <label>
        <input type="checkbox" name="show-monster" value="1" onClick="_.lionica.render.show(this,'monster')" checked>
        มอนสเตอร์</label>
    </div>
  </div>
</div>
<div class="lbox lmove lresize skill">
  <div class="name">
    <div class="text">สกิล</div>
    <div class="close" onClick="_.lionica.box('skill','none');">X</div>
  </div>
  <div class="skill_div bresize">
    <div class="skill_text"></div>
  </div>
</div>
<div class="lbox ai">
  <div class="name">
    <div class="text">AI - ระบบช่วยเล่น</div>
    <div class="close" onClick="_.lionica.box('ai','none');">X</div>
  </div>
  <div class="ai_div">
    <div class="ai_text">
      <p>ทำงานอัตโนมัติเมื่อ</p>
      <p>HP มากกว่าหรือเท่ากับ
        <input type="number" class="_inp _inp-ai-hp" value="30">
        %</p>
      <p>MP มากกว่าหรือเท่ากับ
        <input type="number" class="_inp _inp-ai-mp" value="0">
        %</p>
      <p>
        <input type="checkbox" class="_inp-ai-lock" value="1">
        ล็อคตำแหน่งพื้นที่บริเวณนี้</p>
      <p>
        <input type="button" class="_btn _btn-ai btn btn-inverse btn-mini" value="เริ่มทำงาน" onClick="_.lionica.ai()">
      </p>
    </div>
  </div>
</div>
<div class="lbox lmove target">
  <div class="target_div">
    <p id="target_name"></p>
    <p id="target_hp" style="background-position: 0px 0px;"></p>
  </div>
</div>
<div class="lbox control">
  <ul class="control_ul">
    <li onClick="_.lionica.box('profile','toggle');" id="btn-profile"><span id="btn-profile-ptr"><?php echo $this->char['stats']['ptr']?></span><i style="background-position:0px -456px"></i></li>
    <li onClick="_.lionica.box('guild','toggle');"><i style="background-position:-192px -456px"></i></li>
    <li onClick="_.lionica.box('inventory','toggle');"><i style="background-position:-24px -456px" id="inventory_bin"></i></li>
    <li onClick="_.lionica.box('chat','toggle');"><i style="background-position:-48px -456px"></i></li>
    <li onClick="_.lionica.box('logs','toggle');"><i style="background-position:-72px -456px"></i></li>
    <li onClick="_.lionica.box('minimap','toggle');"><i style="background-position:-96px -456px"></i></li>
    <li onClick="_.lionica.box('skill','toggle');"><i style="background-position:-120px -456px"></i></li>
    <li onClick="_.lionica.box('vender','toggle');"><i style="background-position:-264px -456px"></i></li>
    <li onClick="_.lionica.box('ai','toggle');"><i style="background-position:-144px -456px"></i></li>
    <li onClick="_.lionica.sound.open()"><i style="background-position:-216px -456px" id="btn-sound"></i></li>
    <li onClick="_.lionica.fullscreen()"><i style="background-position:-168px -456px"></i></li>
    <li onClick="_.lionica.player.select()"><i style="background-position:-288px -456px"></i></li>
  </ul>
</div>
<div class="lbox lmove npc">
  <div class="name">
    <div class="text"></div>
    <div class="close" onClick="_.lionica.box('npc','none');">X</div>
  </div>
  <div class="npc_div">
    <div class="npc_text"></div>
  </div>
</div>
<div class="lbox lmove vender">
  <div class="name">
    <div class="text">ร้านค้า / ตั้งร้าน</div>
  </div>
  <div class="vender_div">
    <div class="left">กรุณารอซักครู่..</div>
    <div class="right">กรุณารอซักครู่..</div>
    <p class="clear"></p>
  </div>
</div>
<div class="lbox lmove profile">
  <div class="name">
    <div class="text">Character</div>
    <div class="close" onClick="_.lionica.box('profile','none');">X</div>
  </div>
  <div class="profile_div">
    <div>
      <div class="profile-char">
        <div class="char char-class-<?php echo $this->char['job']?>-<?php echo $this->char['gender']?> char-head-<?php echo $this->char['gender']?>-<?php echo $this->char['hair']?>-<?php echo $this->char['color']?> char-d">
          <div></div>
        </div>
        <p><?php echo $this->char['n']?></p>
        <p><?php echo $this->_job[$this->char['job']]['name']?></p>
      </div>
      <div class="char_stats_up">
        <div class="lionica-popup" data-popup="เพิ่มค่า ATK(โจมตี) สำหรับ Warrior, Archer, Thief"><i class="item" style="background-position:0px -600px"></i> STR
          <p class="pull-right"><span id="char_str"><?php echo $this->char['stats']['str']?></span><span id="char_str_up" class="char_up_click" onClick="_.lionica.api('profile',{'type':'stats','up':'str'})"></span></p>
        </div>
        <div class="lionica-popup" data-popup="เพิ่มค่า FREE(หลบหลีก) สำหรับทุกอาชีพ"><i class="item" style="background-position:-24px -600px"></i> AGI
          <p class="pull-right"><span id="char_agi"><?php echo $this->char['stats']['agi']?></span><span id="char_agi_up" class="char_up_click" onClick="_.lionica.api('profile',{'type':'stats','up':'agi'})"></span></p>
        </div>
        <div class="lionica-popup" data-popup="เพิ่มค่า HP(เลือด) สำหรับทุกอาชีพ"><i class="item" style="background-position:-48px -600px"></i> VIT
          <p class="pull-right"><span id="char_vit"><?php echo $this->char['stats']['vit']?></span><span id="char_vit_up" class="char_up_click" onClick="_.lionica.api('profile',{'type':'stats','up':'vit'})"></span></p>
        </div>
        <div class="lionica-popup" data-popup="เพิ่มค่า Hit(แม่นยำ) สำหรับทุกอาชีพ"><i class="item" style="background-position:-72px -600px"></i> DEX
          <p class="pull-right"><span id="char_dex"><?php echo $this->char['stats']['dex']?></span><span id="char_dex_up" class="char_up_click" onClick="_.lionica.api('profile',{'type':'stats','up':'dex'})"></span></p>
        </div>
        <div class="lionica-popup" data-popup="เพิ่มค่า MAx MP(มานา) สำหรับทุกอาชีพ และค่า ATK(โจมตี) สำหรับ Magician"><i class="item" style="background-position:-96px -600px"></i> INT
          <p class="pull-right"><span id="char_int"><?php echo $this->char['stats']['int']?></span><span id="char_int_up" class="char_up_click" onClick="_.lionica.api('profile',{'type':'stats','up':'int'})"></span></p>
        </div>
        <div class="lionica-popup" data-popup="ค่า point ที่ว่าง สำหรับการอัพ">
          <p class="pull-right char_stats_ptr"> Point: <span id="char_ptr"><?php echo $this->char['stats']['ptr']?></span> </p>
        </div>
      </div>
      <p class="clear"></p>
    </div>
    <div class="char_stats_result">
      <div><i class="item" style="background-position:-120px -600px"></i> Max HP
        <p class="pull-right"><span id="char_mhp"><?php echo $this->char['mhp']?></span></p>
      </div>
      <div><i class="item" style="background-position:-168px -600px"></i> ATK
        <p class="pull-right"><span id="char_atk"><?php echo $this->char['atk']?></span></p>
      </div>
      <div><i class="item" style="background-position:-144px -600px"></i> Max MP
        <p class="pull-right"><span id="char_mmp"><?php echo $this->char['mmp']?></span></p>
      </div>
      <div><i class="item" style="background-position:-192px -600px"></i> DEF
        <p class="pull-right"><span id="char_def"><?php echo $this->char['def']?></span></p>
      </div>
      <div><i class="item" style="background-position:-216px -600px"></i> HIT
        <p class="pull-right"><span id="char_hit"><?php echo $this->char['hit']?></span></p>
      </div>
      <div><i class="item" style="background-position:-240px -600px"></i> FLEE
        <p class="pull-right"><span id="char_free"><?php echo $this->char['free']?></span></p>
      </div>
      <p class="clear"></p>
    </div>
  </div>
</div>
<div class="lbox lmove lresize inventory">
  <div class="name">
    <div class="text"></div>
    <div class="close" onClick="_.lionica.box('inventory','none');">X</div>
  </div>
  <div class="inventory_eq">
    <ul>
      <?php foreach(array(2,3,4,5,6,7,8) as $i):?>
      <?php if($this->eq[$i]):?>
      <li id="eq_<?php echo $i?>" class="inv-unuse" data-type="<?php echo $i?>" data-inv="<?php echo $this->eq[$i]['inv']?>"><i class="item" style="background-position:<?php echo $this->eq[$i]['css']?>"></i></li>
      <?php else:?>
      <li id="eq_<?php echo $i?>"></li>
      <?php endif?>
      <?php endforeach?>
    </ul>
    <ul class="ul2">
      <?php foreach(array(11,12,9) as $i):?>
      <?php if($this->eq[$i]):?>
      <li id="eq_<?php echo $i?>" class="inv-unuse" data-type="<?php echo $i?>" data-inv="<?php echo $this->eq[$i]['inv']?>"><i class="item" style="background-position:<?php echo $this->eq[$i]['css']?>"></i></li>
      <?php else:?>
      <li id="eq_<?php echo $i?>"></li>
      <?php endif?>
      <?php endforeach?>
    </ul>
  </div>
  <div class="inventory_div bresize" data-offset="31">
    <div class="inventory_text"></div>
  </div>
  <div class="inventory_silver">
    <p class="inv-help pull-left">ดับเบิลคลิก เพื่อใช้งาน</p>
    <p class="pull-right"><span id="char_silver"><?php echo $this->char['hp']?></span> Silver.</p>
  </div>
</div>
<div id="map_frame">
  <div id="map_move">
    <div id="map">
      <canvas id="map_canvas"></canvas>
      <canvas id="life_canvas"></canvas>
      <div id="map_weather"></div>
    </div>
  </div>
</div>
<div id="psound"></div>
