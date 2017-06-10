<style>
.f0{color:#fff !important;}
.f1{color:#000 !important;}
.f2{color:#000080 !important;}
.f3{color:#008000 !important;}
.f4{color:#cc0000 !important;}
.f5{color:#800000 !important;}
.f6{color:#800080 !important;}
.f7{color:#F60 !important;}
.f8{color:#B2B200 !important;}
.f9{color:#85B200 !important;}
.f10{color:#008080 !important;}
.f11{color:#2693FF !important;}
.f12{color:#0000FF !important;}
.f13{color:#FF00FF !important;}
.f14{color:#808080 !important;}
.f15{color:#A300D9 !important;}
.f16{color:#E62C6B !important;}
.f17{color:#FF0000 !important;}
.f18{color:#03C3FF !important;}
.f21{color:#cc6600 !important;}


.b0{background:#fff !important;}
.b1{background:#000 !important;}
.b2{background:#000080 !important;}
.b3{background:#008000 !important;}
.b4{background:#cc0000 !important;}
.b5{background:#800000 !important;}
.b6{background:#800080 !important;}
.b7{background:#F60 !important;}
.b8{background:#B2B200 !important;}
.b9{background:#85B200 !important;}
.b10{background:#008080 !important;}
.b11{background:#2693FF !important;}
.b12{background:#0000FF !important;}
.b13{background:#FF00FF !important;}
.b14{background:#808080 !important;}
.b15{background:#A300D9 !important;}
.b16{background:#E62C6B !important;}
.b17{background:#FF0000 !important;}
.b18{background:#03C3FF !important;}
.b21{background:#cc6600 !important;}

.s0{text-shadow: 0 0 5px #fff !important; filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#ffffff);}
.s1{text-shadow: 0 0 5px #000 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#000000)}
.s2{text-shadow: 0 0 5px #000080 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#000080)}
.s3{text-shadow: 0 0 5px #008000 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#008000)}
.s4{text-shadow: 0 0 5px #cc0000 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#cc0000)}
.s5{text-shadow: 0 0 5px #800000 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#800000)}
.s6{text-shadow: 0 0 5px #800080 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#800080)}
.s7{text-shadow: 0 0 5px #FF6600 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#FF6600)}
.s8{text-shadow: 0 0 5px #B2B200 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#B2B200)}
.s9{text-shadow: 0 0 5px #85B200 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#85B200)}
.s10{text-shadow: 0 0 5px #008080 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#008080)}
.s11{text-shadow: 0 0 5px #2693FF !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#2693FF)}
.s12{text-shadow: 0 0 5px #0000FF !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#0000FF)}
.s13{text-shadow: 0 0 5px #FF00FF !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#FF00FF)}
.s14{text-shadow: 0 0 5px #808080 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#808080)}
.s15{text-shadow: 0 0 5px #A300D9 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#A300D9)}
.s16{text-shadow: 0 0 5px #E62C6B !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#E62C6B)}
.s17{text-shadow: 0 0 5px #FF0000 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#FF0000)}
.s18{text-shadow: 0 0 5px #03C3FF !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#03C3FF)}
.s21{text-shadow: 0 0 5px #cc6600 !important;filter: progid:DXImageTransform.Microsoft.Glow(Strength=5, Color=#cc6600)}
</style>
<h2 class="bar-heading"><?php echo _get_nick($this->user['n'])?></h2>
<div style="position:relative">
<div style="position:absolute; right:5px;top:5px;"><img src="https://graph.facebook.com/<?php echo $this->user['u']?>/picture?width=100&height=100" class="img-responsive"></div>
<table width="100%" class="tbservice" cellpadding="5" cellspacing="0" border="0">
    <tr>
        <td class="colum">Facebook: </td>
        <td><a href="https://www.facebook.com/app_scoped_user_id/<?php echo $this->user['u']?>" target="_blank"><?php echo $this->user['nd']?$this->user['nd']:_get_nick($this->user['n'],false)?></td>
    </tr>
    <tr>
        <td class="colum">บั๊ก: </td>
        <td><?php echo number_format(intval($this->user['bu']))?></td>
    </tr>
    <tr>
        <td class="colum">คะแนนโหวต: </td>
        <td><?php echo number_format(intval($this->user['v']))?></td>
    </tr>
    <tr>
        <td class="colum">คะแนนออนไลน์: </td>
        <td><?php echo number_format(intval($this->online['t']))?></td>
    </tr>
    <tr>
        <td class="colum">สัตว์เลี้ยง: </td>
        <td>
        <?php if(is_array($this->user['inv'])):?>
        <?php foreach($this->user['inv'] as $v):?><img src="https://chat.jarm.com/v/rank/<?php echo $v?>.gif"> <?php endforeach?>
        <?php endif?>
        </td>
    </tr>
    <tr>
      <td class="colum">ของขวัญ: </td>
      <td><?php if($this->gift):?>
          <div>
              <?php foreach($this->gift as $v):?>
              <img src="https://chat.jarm.com/v/gift/64/<?php echo $v['gf']?>.png" class="show-tooltip-s" alt="" title="<strong><?php echo $v['n']?><strong><br>มอบโดย <?php echo _get_nick($v['by'],false)?>">
              <?php endforeach?>
          </div>
          <?php endif?>
          <?php if($thi->user['u']!=self::$my['_id']):?>
          <input type="button" class="button" value=" ส่งของขวัญให้ <?php echo _get_nick($this->user['n'],false)?>" onClick="_.box.load('/game/gift/<?php echo self::$profile['_id']?> #gift_send')">
          <?php endif?>
          <div style=" padding:5px; color:#c00"><strong>ของขวัญ</strong> จะหายไปทันทีเมื่อหมดอายุ</div></td>
  </tr>
  <tr>
      <td colspan="2" align="center" style="background:#f0f0f0; text-align:center; font-weight:bold;">Friends Collection</td>
  </tr>
  <tr>
      <td class="colum">เจ้าของ: </td>
      <td>
      <?php if($this->owner):?>
        <a href="/user/<?php echo $own['u']?>" class="h"> <img src="https://graph.facebook.com/<?php echo $own['u']?>/picture" style="width:24px; vertical-align:middle"> <?php echo _get_nick($this->own['n'])?></a>
      <?php endif?>
      </td>
  </tr>
  <tr>
      <td class="colum">Collection: </td>
      <td>
        <?php /*if($this->collection):?>
        <?php if(self::$profile['_id']==self::$my['_id']):?>
          <?php $j=0;foreach(self::$profile['pet']['col'] as $v): if($co=$u->profile($v)):?>
          <p><a href="<?php echo $co['link']?>" class="h"><img src="<?php echo $co['img']?>" style="width:20px; vertical-align:middle"> <?php echo $co['name']?></a> - ค่าตัว <?php echo $co['pet']['price']?> บ๊อก (<a href="javascript:;" onClick="_.box.confirm({title:'ขายคืนให้ Jarm',detail:'คุณสามารถขายคืนได้ในราคา 30% จากราคาล่าสุดเท่านั้น ต้องการดำเนินการต่อหรือไม่',click:function(){_.ajax.gourl('/<?php echo URL?>','sellpet',<?php echo $co['_id']?>);}})">ขายคืน</a>)</p>
          <?php endif;endforeach;?>
          <?php else:?>
          <?php $j=0;foreach(self::$profile['pet']['col'] as $v): if($co=$u->profile($v)):?>
          <?php echo $j>0?', ':''?><a href="<?php echo $co['link']?>" class="h"><img src="<?php echo $co['img']?>" style="width:20px; vertical-align:middle"> <?php echo $co['name']?></a>
          <?php $j++;endif;endforeach;?>
          <?php endif?>
          <?php endif*/?>
      </td>
  </tr>
  <tr>
      <td class="colum">ค่าตัว: </td>
      <td><strong><?php echo number_format(max(intval($this->user['p']),2000))?></strong> บั๊ก</td>
  </tr>
  <?php if($this->user['u']!=self::$my['_id']):?>
  <tr>
      <td></td>
      <td><input type="button" class="button blue" value=" ซื้อ <?php echo _get_nick($this->user['n'],false)?> " onClick="_.box.confirm({title:'ซื้อเป็น Collection',detail:'คุณต้องการซื้อบุคคลนี้ในราคา <?php echo number_format(max(intval($this->user['p']),2000))?> บั๊กหรือไม่<div style=\'padding:5px;border:1px solid #e0e0e0;margin:5px 0px\'><strong>กติกา</strong><br>- ทุกการซื้อ 1 ครั้ง มูลค่าคนที่ถูกซื้อจะเพิ่มไป 40%<br>- หากมีคนมาซื้อต่อคุณ คุณจะได้กำไร 10% จากราคาที่เคยซื้อไว้<br>- คนที่ถูกซื้อจะได้ประมาณ 7% ของราคาที่ถูกซื้อ<br><br>หากไม่พอใจ สามารถขายคืนเข้า Boxza ได้ บ๊อกคืน 30% ของราคาล่าสุด</div>',click:function(){_.ajax.gourl('/user/<?php echo URL?>','buypet);}})"></td>
  </tr>
  <?php endif?>
  <tr>
      <td colspan="2" align="center" style="background:#f0f0f0; text-align:center; font-weight:bold;"></td>
  </tr>
  <tr>
      <td class="colum">สมัครสมาชิกเมื่อ: </td>
      <td><?php echo self::Time()->from($this->user['da'],'datetime')?></td>
  </tr>
  <tr>
      <td class="colum">ออนไลน์ล่าสุด: </td>
      <td><?php echo self::Time()->from($this->user['du'],'datetime')?></td>
  </tr>
</table>
</div>
