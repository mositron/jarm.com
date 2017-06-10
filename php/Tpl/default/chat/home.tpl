<!-- BEGIN - BANNER : B -->
<?php if($this->_banner['b']):?>
<div style="overflow:hidden; margin:0px 0px 5px; text-align:center">
<ul class="_banner _banner-once">
<?php foreach($this->_banner['b'] as $_bn):?>
<li><?php echo $_bn?></li>
<?php endforeach?>
</ul>
</div>
<?php endif?>
<!-- END - BANNER : B -->


<style>
._hd li.notify{padding:0px}
.tbservice td,.tbservice th{text-align:center;}
.tbservice td.tab_name{text-align:left; width:100px}
.tbservice td.tab_welcome{text-align:left}
.tab_published{ width:80px;}

.chat-feature{margin-top: 5px; margin-bottom: 5px;}
.chat-feature li{height:130px; overflow:hidden;}
.chat-feature li > p{width:120px; float:left;padding:5px 0px; text-align:center; background:#f5f5f5; margin:0px 0px 0px 5px;}
.chat-feature li > div{margin:0px 0px 0px 130px;}
.chat-feature li > div h4 {height: 30px;line-height: 30px;background: #F0F0F0;padding: 0px 0px 0px 10px;text-shadow: 1px 1px 0px #FFF;}
.chat-feature li > div p{ line-height:1.8em; text-indent:10px;}
</style>
<h2 class="bar-heading">สร้างห้องแชทฟรี <small>แชท แชทหาเพื่อน แชทสด คุยสด แชทรูม ดูกล้อง ส่องเว็บแคม พูดคุยหาเพื่อน โชว์กล้องผ่านเว็บแคม </small></h2>


<?php require(__CONF.'ads/ads.dfp-12.php');?>

<style>
.chat-room>div a{display: block; overflow: hidden; position: relative; background-color: #f0f0f0; height: 120px; margin:5px 0px;}
.chat-room>div img{width: auto;height: auto;position: absolute;left: -100%;right: -100%;top: -100%;bottom: -100%;margin: auto;min-height: 100%;min-width: 100%;}
.chat-room>div p{position:absolute;width: 100%;left:0px; bottom: 0px; background: #000; background-color: rgba(0,0,0,0.7);color:#fff; text-align: center; white-space: nowrap; text-overflow:ellipsis; overflow: hidden; font-size: 20px; margin: 0px;}
.chat-room>div div{position: absolute; right:0px; top:0px; color: #f0f0f0;background: #000; background-color: rgba(0,0,0,0.7); padding: 2px 5px; font-size: 13px;}
.chat-room>div div span{color:#1E9FD9; font-size: 12px; margin-right: 3px;}
</style>
<h3 class="bar-heading">ห้องแชทยอดนิยม</h3>
<div class="row chat-room clear-line">
<?php for($i=0;$i<min(8,count($this->chat));$i++):$c=$this->chat[$i];?>
<div class="col-xs-6 col-sm-3 col-md-3">
  <a href="/<?php echo $c['l']?$c['l']:'room/'.$c['_id']?>">
    <img src="https://chat.jarm.com/v/room/<?php echo $c['fd']?>/t.jpg" class="img-responsive">
    <p>ห้อง<?php echo $c['n']?></p>
    <div><span class="glyphicon glyphicon-user"></span><?php echo $c['cu']?> <span class="glyphicon glyphicon-transfer"></span><?php echo $c['cv']?></div>
  </a>
</div>
<?php endfor?>
</div>


<?php require(__CONF.'ads/ads.dfp-34.php');?>

<div class="row chat-room clear-line">
<?php for($i=8;$i<count($this->chat);$i++):$c=$this->chat[$i];?>
<div class="col-xs-6 col-sm-3 col-md-3">
  <a href="/<?php echo $c['l']?$c['l']:'room/'.$c['_id']?>">
    <img src="https://chat.jarm.com/v/room/<?php echo $c['fd']?>/t.jpg" class="img-responsive">
    <p>ห้อง<?php echo $c['n']?></p>
    <div><span class="glyphicon glyphicon-user"></span><?php echo $c['cu']?> <span class="glyphicon glyphicon-transfer"></span><?php echo $c['cv']?></div>
  </a>
</div>
<?php endfor?>
</div>


<!--div class="chat-feature">
<ul class="thumbnails row-count-2">
<li class="span6">
<p><img src="<?php echo FILES_CDN?>img/chat/home-webcam.png" alt="แชทผ่านกล้อง"></p>
<div><h4>แชทผ่านกล้อง</h4>
<p>แชทสด คุยสด แชทรูม รองรับการสนทนาผ่านกล้องเว็บแคม สามารถดูกล้องทั้งเสียงและภาพ แบบไม่จำกัดจำนวนจอ</p>
</div>
</li>
<li class="span6">
<p><img src="<?php echo FILES_CDN?>img/chat/home-bank.png" alt="ธนาคาร"></p>
<div><h4>ธนาคาร</h4>
<p>ระบบธนาคาร สำหรับแลกบ๊อกเป็นคะแนน เพื่อมาใช้งานภายในห้องแชท</p>
</div>
</li>
<li class="span6">
<p><img src="<?php echo FILES_CDN?>img/chat/home-shop.png" alt="ร้านค้า"></p>
<div><h4>ร้านค้า</h4>
<p>ร้านค้าขายไอเท็มสำหรับใช้ภายในแชท เพื่อเพิ่มประสิทธิ์ภาพของไอดีคุณภายในแชท</p>
</div>
</li>
<li class="span6">
<p><img src="<?php echo FILES_CDN?>img/chat/home-namtoa.png" alt="เกมน้ำเต้า"></p>
<div><h4>เกมน้ำเต้า</h4>
<p>เกมเสี่ยงดวง น้ำเต้า ปู ปลา เพิ่มความสนุกสนานและเพื่อหาคะแนนเพิ่มจากการเสี่ยงดวงภายในแชท</p>
</div>
</li>
<li class="span6">
<p><img src="<?php echo FILES_CDN?>img/chat/home-slave.png" alt="เกมสลาฟ"></p>
<div><h4>เกมสลาฟ</h4>
<p>เกมไพ่สำหรับเล่นกับเพื่อนๆภายในแชท เพิ่มความสนุกและหาคะแนนเพิ่มเติมจากการวัดดวงกับเพื่อนภายในแชท</p>
</div>
</li>
<li class="span6">
<p><img src="<?php echo FILES_CDN?>img/chat/home-lotto.png" alt="ล็อตเตอรี่"></p>
<div><h4>ล็อตเตอรี่</h4>
<p>เกมเสี่ยงดวงจากการทายตัวเลข ที่อาจจะทำให้ควรรวยภายในพริบตา</p>
</div>
</li>
<li class="span6">
<p><img src="<?php echo FILES_CDN?>img/chat/home-thief.png" alt="ขโมย"></p>
<div><h4>ขโมย</h4>
<p>เกมขโมยคะแนนจากเพื่อน เพิ่มความสนุกสนานยิ่งขึ้น เมื่อคุณสามารถขโมยคะแนนจากผู้อื่นได้</p>
</div>
</li>

<li class="span6">
<p><img src="<?php echo FILES_CDN?>img/chat/home-logs.png" alt="หน้าต่างเกมส์"></p>
<div><h4>หน้าต่างเกมส์</h4>
หน้าต่างแสดงการกระทำทุกอย่างภายในเกม ซึ่งแยกออกจากหน้าต่างแชท
</div>
</li>
</ul>

</div-->


<div class="fb-comments" data-href="<?php echo self::uri(['chat','/'])?>" data-num-posts="50" data-width="720"></div>
