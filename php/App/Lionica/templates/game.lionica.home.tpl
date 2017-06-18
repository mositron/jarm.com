 <style>
 .hero-unit p{font-size:14px; margin-bottom:0px;}
 </style>
<ul class="breadcrumb" style="margin-bottom:5px;">
<li><a href="/" title="เกมส์"><i class="icon-home"></i> เกมส์</a></li>
<span class="divider">&raquo;</span>
<li><a href="/lionica" title="เกมสัตว์เลี้ยง "> Lionica</a></li>
</ul>

<?php require(HANDLERS.'ads/ads.adsense.body2.php');?>
<div style="padding:5px 5px 0px 5px;">
<div class="hero-unit" style="margin-bottom:5px; padding:20px 20px;">
  <h1>Lionica</h1>
  <p>เกม เกมต่อสู้ เกมเก็บเลเวล เลี้ยงสัตว์ ปลูกผัก บนเว็บบราวเซอร์</p>
  <p>ร่วมผจญภัยไปกับ Lionica ที่มาพร้อมกับ 4 อาชีพหลักคือ Warrior, Magician, Archer, Thief พร้อมด้วยระบบและกิจกรรมต่างๆมากมายภายในเกม.</p>
  <p>เปิด Open Beta วันที่ 31 สิงหาคม 2556 เวลา 12.00 น. พร้อมกิจกรรม (<a href="http://game.boxza.com/forum/topic/10766" target="_blank">รายละเอียดเพิ่มเติม</a>)</p>
  <p>อัพเดทความเคลื่อนไหวผ่านทาง Facebook ได้ที่ <a href="https://www.facebook.com/Lionica.TH" target="_blank">www.facebook.com/Lionica.TH</a></p>
  <p><a class="btn btn-warning btn-large" href="/lionica/play" style="margin-top:15px; width:100%; box-sizing:border-box">เข้าเกม / เล่นเกมเดี๋ยวนี้</a></p>
  <p style="padding:5px 10px; background:#fff; border-radius:5px; margin:5px 0px"><strong>รองรับบราวเซอร์</strong>:<br>
  <a href="http://www.mozilla.org/en-US/firefox/new/" target="_blank"><img src="http://s0.boxza.com/static/images/browser/firefox.gif"> FireFox</a>,
  <a href="http://www.opera.com/computer/windows" target="_blank"><img src="http://s0.boxza.com/static/images/browser/opera.gif"> Opera</a>,
  <a href="http://www.apple.com/th/safari/" target="_blank"><img src="http://s0.boxza.com/static/images/browser/safari.gif"> Safari</a> (v.6+),
  <a href="https://www.google.com/intl/en/chrome/browser/" target="_blank"><img src="http://s0.boxza.com/static/images/browser/chrome.gif"> Chrome</a>,
  <a href="http://windows.microsoft.com/en-us/internet-explorer/ie-10-worldwide-languages" target="_blank"><img src="http://s0.boxza.com/static/images/browser/msie.gif"> Internet Explorer</a> (v.10+)
  </p>
  
  <p style="padding:5px 10px; background:#fff; border-radius:5px; margin:5px 0px"><strong>ข้อมูลเกม</strong>:<br>
  <strong>NPC / Monster ในแผนที่</strong>: 
  <a href="/lionica/info/map/1" target="_blank">Toledo</a>,
  <a href="/lionica/info/map/2" target="_blank">Pomona</a>,
  <a href="/lionica/info/map/3" target="_blank">Vesta</a>,
  <a href="/lionica/info/map/4" target="_blank">Ostuni</a>,
  <a href="/lionica/info/map/6" target="_blank">Hidden Canyon</a>
  </p>
  
  
  
  
</div>

<div style="margin:5px 0px"><?php require(HANDLERS.'ads/ads.yengo.body2.php');?></div>

<h3 class="forum_cp" style="margin:5px 0px"><a href="/forum/lionica" target="_blank">พูดคุยเกี่ยวกับเกม  Lionica</a> <small>(<a href="/forum/new-topic/17" target="_blank">เพิ่มกระทู้ใหม่</a>)</small></h3>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="hforum">
<thead>
<tr><th>&nbsp;</th><th>หัวข้อ</th><th>ผู้ตั้ง</th><th>อ่าน</th><th>ตอบ</th><th>ล่าสุด</th></tr>
</thead>
<tbody>
<?php $i=0;?>
<?php foreach($this->topic as $val):?>
<tr class="l<?php echo $i%2?>">
	<td class="ticon"><i class="i0"></i></td>
	<td class="ttitle"><p><a href="/forum/topic/<?php echo $val['_id']?>" target="_blank"><?php echo $val['t']?></a></p></td>
    <td class="tpost"><p><?php $p=$this->user->profile($val['u']);?><a href="http://boxza.com/<?php echo $p['link']?>" target="_blank"><?php echo $p['name']?></a></p></td>
	<td class="tview"><?php echo number_format($val['do'])?></td>
	<td class="treply"><?php echo number_format($val['cm']['c'])?></td>
	<td class="ttime"><p>
	<?php 
	if($val['cm']['d']):
	?>
    <?php echo time::show($val['cm']['d'][0]['t'],'datetime',true)?>
    <?php else:?>
    <?php echo time::show($val['ds'],'datetime',true)?>
    <?php endif?></p>
	</td>
</tr>
<?php $i++;endforeach?>
</tbody>
</table>


<div class="fb-comments" data-href="http://game.boxza.com/lionica" data-num-posts="50" data-width="710"></div>
</div>
