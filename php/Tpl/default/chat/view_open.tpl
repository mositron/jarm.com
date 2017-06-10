
<style>
._ft{display:none;}
._hd li.notify{padding:0px}

body{overflow:hidden; padding:0px;}
._hd{border-bottom:none; position:static;}
._hd nav{width:100%;}
._hd-bt{margin-bottom:40px; display:none;}
.head-logo{display:none;}
.hbar.navbar{display:none;}
body > .container{width:100%; margin:0px}
._ct{box-shadow:none; width:100%; padding:0px; margin:0px;}
._ct-in{background:none;}

.fl_table{border-collapse:separate}
.fl_table td{ padding:5px; background:#FFF;text-align:center !important}
.fl_table th{ padding:5px; background:#F8F8F8; text-align:center !important}
.gbox_content .tbservice th,.gbox_content .tbservice td{text-align:center;}
.gbox_content .tbservice td.i{width:50px !important}
.gbox_content .tbservice td.c{width:150px !important}
.gbox_content #slavelast .tbservice td.c{width:120px !important}

.tbitem .f{width:60px !important; text-align:center;}
.tbitem .b{width:80px !important; text-align:center;}


.tblotto{border-collapse: separate; border-spacing:1px; background:#ccc;}
.tblotto thead tr th{text-align:center; font-weight:bold; background:#f7f7f7; vertical-align:middle !important; border:none;}
.tblotto tbody tr td{text-align:center; background:#fff; vertical-align:middle; border:none;}
.tblotto tr .nb{width:80px !important}
</style>



<div class="bz_chat">
<h3 title="Jarm Chat" class="bz_chat_lg"><a href="<?php echo self::uri(['chat','/'])?>" title="แชท"></a></h3>
<div class="bz_chat_radio"></div>
<div class="bz_chat_room"><ul><li><a href="<?php echo self::uri(['chat','/list'])?>" title="ห้องแชททั้งหมด" target="_blank"><i class="icon-all-chat"></i></a></li><li class="on"><a href="<?php echo self::uri(['chat','/manage'])?>" title="สร้างห้องแชทฟรี" target="_blank"><i class="icon-new-chat"></i></a></li></ul></div>
<div class="bz_chat_popup"></div>
<div class="bz_chat_rl">
<div class="bz_chat_ch">
<div class="bz_chat_ch_l_main bz_chat_ch_l one on"></div>
</div>

<div class="bz_chat_nl">
<div class="bz_chat_nl_h"><i></i>ชื่อของคุณ</div>
<div class="bz_chat_nl_l bz_chat_nl_ll"></div>
<div><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2F%E0%B8%A3%E0%B8%B1%E0%B8%87%E0%B8%82%E0%B8%AD%E0%B8%87%E0%B9%81%E0%B8%A1%E0%B8%A7%E0%B8%81%E0%B9%8A%E0%B8%AD%E0%B8%87%2F1534696463431854&amp;send=false&amp;layout=button_count&amp;width=100&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:60px; height:21px;" allowtransparency="true"></iframe><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Ffarmmii.fasion&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px;" allowTransparency="true"></iframe></div>

<div>
<div style="display:inline-block; width:78px"><div class="g-follow" data-annotation="none" data-height="20" data-href="//plus.google.com/115817126393353079017" data-rel="publisher"></div></div>
<div style="display:inline-block; width:78px"><div class="g-follow" data-annotation="none" data-height="20" data-href="//plus.google.com/101529563615466592393" data-rel="publisher"></div></div>
</div>
<script type="text/javascript">
  window.___gcfg = {lang: 'th'};
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<div class="bz_chat_set l0">
<?php if(date('G')>=9):?>
<?php if(!self::$my):?>
<p style="padding:3px 1px; text-align:center; font-size:12px; background:#f5f5f5; color:#f00;">กรุณาล็อคอิน</p>
<?php elseif(intval(self::$my['st'])<1):?>
<p style="padding:3px 1px; text-align:center; font-size:12px; background:#f5f5f5; color:#f00;">กรุณายืนยันการสมัครสมาชิก</p>
<?php endif?>
<?php if(EXP_RATE>1):?>
<p style="padding:3px 1px; text-align:center; font-size:12px; background:#669900; color:#fff;">บั๊ก คูณ <?php echo EXP_RATE?> (9.00-24.00)</p>
<?php endif?>
<?php endif?>
<p style="padding:3px 2px; font-size:12px;"><a href="javascript:;" onClick="_.chat.video.publish('<?php echo getvideokey()?>')"><i class="icon-cam"></i> เปิดกล้อง</a></p>
<label><input type="checkbox" id="bz_chat_ecolor1" value="1" onClick="_.chat.enablecolor(this,1);" checked> เปิดใช้งานชื่อมีสี</label>
<label><input type="checkbox" id="bz_chat_ecolor2" value="1" onClick="_.chat.enablecolor(this,2);" checked> เปิดใช้งานข้อความมีสี</label>
</div>
<div class="bz_chat_nl_h"><i></i>สมาชิกออนไลน์ (<span id="bz_chat_nl_ol">0</span>)</div>
<div class="bz_chat_nl_h2">+ <span id="bz_chat_nl_ol1">0</span> ผู้ดูแล (<a href="javascript:;" onClick="_.chat.api('admin',{last:_.chat.lastid,cmd:'list'});">/admin list</a>)</div>
<div class="bz_chat_nl_l bz_chat_nl_lll"></div>
<div class="bz_chat_nl_h2">+ <span id="bz_chat_nl_ol2">0</span> สมาชิก</div>
<div class="bz_chat_nl_l bz_chat_nl_llll"></div>
<div class="bz_chat_nl_h2">+ <span id="bz_chat_nl_ol3">0</span> บุคคลทั่วไป</div>
<div class="bz_chat_nl_l bz_chat_nl_lllll"></div>
</div>
<div class="bz_chat_game">
<ul>
<li><a href="javascript:;" onClick="_.box.load('/game/item #game_item')"><img src="<?php echo FILES_CDN?>img/chat/item.png" alt="ร้านค้า"><p>ร้านค้า</p></a></li>
<?php if($this->room['_id']<7):?>
<li><a href="javascript:;" onClick="_.box.load('/game/radio #game_radio')"><img src="<?php echo FILES_CDN?>img/chat/radio.png" alt="ตารางดีเจประจำ Jarm Chat"><p>ตารางเวลา PJ</p></a></li>
<?php endif?>
<li><a href="javascript:;" onClick="_.box.load('/game/online/<?php echo $this->room['_id']?> #game_online')"><img src="<?php echo FILES_CDN?>img/chat/online.png" alt="ธนาคาร"><p>เวลาออนไลน์</p></a></li>
<li><a href="javascript:;" onClick="_.box.load('/game/bank #game_bank')"><img src="<?php echo FILES_CDN?>img/chat/bank.png" alt="ธนาคาร"><p>ธนาคาร</p></a></li>
<li><a href="<?php echo self::uri(['game','/lionica'])?>" target="_blank"><img src="<?php echo FILES_CDN?>img/chat/pet.png" alt="ร้านค้า"><p>สัตว์เลี้ยง</p></a></li>
<li><a href="javascript:;" onClick="_.box.load('/game/namtoa #game_namtoa')"><img src="<?php echo FILES_CDN?>img/chat/namtoa/2.jpg" alt="เกมน้ำเต้า"><p>เกมน้ำเต้า</p></a></li>
<li><a href="javascript:;" onClick="_.box.load('/game/slave #game_slave')"><img src="<?php echo FILES_CDN?>img/chat/card/card.gif" alt="เกมสลาฟ"><p>เกมสลาฟ</p></a></li>
<li><a href="javascript:;" onClick="_.box.load('/game/lottery #game_lottery')"><img src="<?php echo FILES_CDN?>img/chat/lottery.png" alt="ล็อตเตอรี่"><p>ล็อตเตอรี่</p></a></li>
<li><a href="javascript:;" onClick="_.box.load('/game/thief #game_thief')"><img src="<?php echo FILES_CDN?>img/chat/thief.png" alt="ขโมย"><p>ขโมย</p></a></li>
<li><a href="javascript:;" onClick="_.chat.game();$('#bz_box_game').css('display','block');"><img src="<?php echo FILES_CDN?>img/chat/logs.png" alt="ขโมย"><p>หน้าต่างเกมส์</p></a></li>
</ul>
</div>
<p class="clear"></p>
</div>
<div class="bz_chat_box">
<div class="bz_chat_swf"><embed src="/_cdn/flash/chat/sound.swf" quality="high" wmode="transparent" id="bz_chat_swf" allowscriptaccess="always" type="application/x-shockwave-flash" width="1" height="1"></embed></div>
<div class="bz_chat_inp">
<select name="mp" class="bz_chat_pv"><option value="0">ส่งถึงทุกคน</option></select>
<input type="text" name="ms" class="bz_chat_mb" maxlength="150">
<p class="clear"></p>
</div>
<div>
<ul class="bz_chat_col">
<li>
<a href="javascript:;" class="bz_chat_col_sel">เลือกสีข้อความ</a>
<ul>
 <li><a href="javascript:;" class="f1" onClick="_.chat.color('1')">สีข้อความ</a></li>
  <li><a href="javascript:;" class="f14" onClick="_.chat.color('14')">สีข้อความ</a></li>
  <li><a href="javascript:;" class="f2" onClick="_.chat.color('2')">สีข้อความ</a></li>
  <li><a href="javascript:;" class="f12" onClick="_.chat.color('12')">สีข้อความ</a></li>
  <li><a href="javascript:;" class="f11" onClick="_.chat.color('11')">สีข้อความ</a></li>
  <li><a href="javascript:;" class="f3" onClick="_.chat.color('3')">สีข้อความ</a></li>
  <li><a href="javascript:;" class="f10" onClick="_.chat.color('10')">สีข้อความ</a></li>
  <li><a href="javascript:;" class="f16" onClick="_.chat.color('16')">สีข้อความ</a></li>
  <li><a href="javascript:;" class="f4" onClick="_.chat.color('4')">สีข้อความ</a></li>
  <li><a href="javascript:;" class="f5" onClick="_.chat.color('5')">สีข้อความ</a></li>
  <li><a href="javascript:;" class="f6" onClick="_.chat.color('6')">สีข้อความ</a></li>
  <li><a href="javascript:;" class="f15" onClick="_.chat.color('15')">สีข้อความ</a></li>
</ul>
</li>
  <li><i class="bz_chat_clear" title="เคลียร์หน้าจอ" onClick="_.chat.clear()"></i></li>
  <li><i class="bz_chat_scroll" title="ข้อความเลื่อนลงอัตโนมัติ" onClick="_.chat.scroll()"></i></li>
  <li><i class="bz_chat_oneline" title="เปิด/ปิดการแสดงข้อความแบบบรรทัดเดียว" onClick="_.chat.oneline()"></i></li>
  <li><i class="bz_chat_sound" title="เปิด/ปิดเสียงการแจ้งเตือน" onClick="_.chat.esound()"></i></li>
  <p class="clear"></p>
</ul>
<div class="bz_chat_emo">
<strong></strong>
<a href="#!e1" onClick="_.chat.emoticon('e1');return false;"><img src="<?php echo FILES_CDN?>chat/emoticon/e/1.gif" /></a>
<a href="#!e2" onClick="_.chat.emoticon('e2');return false;"><img src="<?php echo FILES_CDN?>chat/emoticon/e/2.gif" /></a>
<a href="#!e3" onClick="_.chat.emoticon('e3');return false;"><img src="<?php echo FILES_CDN?>chat/emoticon/e/3.gif" /></a>
<a href="#!e4" onClick="_.chat.emoticon('e4');return false;"><img src="<?php echo FILES_CDN?>chat/emoticon/e/4.gif" /></a>
<a href="#!e5" onClick="_.chat.emoticon('e5');return false;"><img src="<?php echo FILES_CDN?>chat/emoticon/e/5.gif" /></a>
<a href="#!e6" onClick="_.chat.emoticon('e6');return false;"><img src="<?php echo FILES_CDN?>chat/emoticon/e/6.gif" /></a>
<a href="#!e7" onClick="_.chat.emoticon('e7');return false;"><img src="<?php echo FILES_CDN?>chat/emoticon/e/7.gif" /></a>
<a href="#!e8" onClick="_.chat.emoticon('e8');return false;"><img src="<?php echo FILES_CDN?>chat/emoticon/e/8.gif" /></a>
<a href="#!e9" onClick="_.chat.emoticon('e9');return false;"><img src="<?php echo FILES_CDN?>chat/emoticon/e/9.gif" /></a>
<a href="#!e10" onClick="_.chat.emoticon('e10');return false;"><img src="<?php echo FILES_CDN?>chat/emoticon/e/10.gif" /></a>
<a href="#!e11" onClick="_.chat.emoticon('e11');return false;"><img src="<?php echo FILES_CDN?>chat/emoticon/e/11.gif" /></a>
  <span class="bz_chat_moreclick"></span>
  <span class="bz_chat_share"><iframe src="//www.facebook.com/plugins/follow.php?href=http%3A%2F%2Fwww.facebook.com%2Fpositron.th&amp;width=90&amp;height=80&amp;colorscheme=light&amp;layout=button&amp;show_faces=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:90px; height:21px;" allowTransparency="true"></iframe><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2F%E0%B8%A3%E0%B8%B1%E0%B8%87%E0%B8%82%E0%B8%AD%E0%B8%87%E0%B9%81%E0%B8%A1%E0%B8%A7%E0%B8%81%E0%B9%8A%E0%B8%AD%E0%B8%87%2F1534696463431854&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:115px; height:21px;" allowtransparency="true"></iframe></span>
</div>
<div style="clear:both"></div>
</div>
</div>
</div>


<script type="text/javascript">
_.chat.room=<?php echo $this->room['_id']?>;
_.game.bet.room=<?php echo $this->room['_id']?>;
_.chat.load();
</script>
