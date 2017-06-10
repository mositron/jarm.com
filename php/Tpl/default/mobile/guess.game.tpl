
<div class="ans-head">
<?php if($this->app['img']):?><img src="https://s3.jarm.com/guess/<?php echo $this->app['fd']?>/s.jpg" style="float:left; margin:0px 15px 3px 10px; width:100px; height:100px;"><?php endif?>
<h1><?php echo $this->app['t']?></h1>
<div><?php echo $this->app['d']?></div>
<div>ประเภท: <a href="/guess/category/<?php echo $this->app['c']?>"><?php echo $this->cate[$this->app['c']]['t']?></a> - เล่นแล้ว <?php echo number_format(intval($this->app['do']))?> ครั้ง</div>
</div>


<form id="frmans">
<input type="hidden" name="uid" id="uid">
<?php for($i=0;$i<count($this->app['quest']);$i++):$v=$this->app['quest'][$i];shuffle($v['a']);?>
<div class="ans-list">
<h3>ข้อที่ <?php echo $i+1?>. <?php echo $v['t']?></h3>
<ul class="nav">
<?php for($j=0;$j<count($v['a']);$j++):?>
<li><label><input type="radio" class="rdans" name="ans<?php echo $i?>" value="<?php echo $v['a'][$j]['id']?>"> <?php echo $v['a'][$j]['t']?></label></li>
<?php endfor?>
</ul>
</div>
<?php endfor?>
</form>

<div style="text-align:center; margin:5px"><span class="cplaya btn btn-info btn-large" onClick="playapp()">ดูคำตอบ</span></div>
<div class="sharefb"><div style="text-align:center">... กรุณาคลิกที่.. ดูคำตอบ. ...</div></div>


<div style="margin:10px; padding:5px; border:5px solid #F69; background:#fff; border-radius:5px;">
    <div style="float:left; width:50px;"> <a href="<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><img src="<?php echo $this->user['img']?>" alt="<?php echo $this->user['name']?>" style="width:45px;"></a> </div>
    <div style="margin:0px 0px 0px 55px;"> ตั้งคำถามโดย: <a href="<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><?php echo $this->user['name']?></a><br>
        เมื่อ: <?php echo self::Time()->from($this->app['da'],'datetime')?> </div>
    <p style="clear:both"></p>
    <?php if($this->apps):?>
    <div>คำถามอื่นๆของ <a href="<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><?php echo $this->user['name']?></a></div>
<ul class="otherapp">
<?php for($i=0;$i<count($this->apps);$i++):?>
<li><a href="/guess/game/<?php echo $this->apps[$i]['_id']?>/?parent=<?php echo urlencode(URL)?>"><?php echo $this->apps[$i]['t']?></a></li>
<?php endfor?>
</ul>
<?php endif?>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/jarm.js"></script>
<script>
var repeatsend=0,postnow=false,checkbox=false,res=false,liked=false,ws={};
function playapp()
{
	if($('.rdans:checked').length!=<?php echo count($this->app['quest'])?>)
	{
		alert('กรุณาเลือกคำตอบให้ครบทุกข้อ');	
	}
	else
	{
		$('#uid').val(uid);
		$('.sharefb').html('<div style="text-align:center"><img src="<?php echo FILES_CDN?>img/global/load.gif"></div>');
		$('.cplaya').prop('disabled','disabled').html('กรุณารอซักครู่...');
		_.ajax.gourl('<?php echo URL?>','playapp',$('#frmans').get(0));
	}
};

function showresult(r)
{
	ws=r;
	$('.cplaya').removeProp('disabled').html('เล่นอีกครั้ง');
	var tmp='<div style="padding:"10px; text-align:center">'+
	'<strong>คำตอบคือ</strong>: '+ws.name+'<br>'+
	ws.description+
	'<!--br><a href="javascript:;" class="btn btn-fb" onclick="posttoshare()">โพสไปยัง Facebook</a--></div>';
	$('#frmans').get(0).reset();
	$('.sharefb').html(tmp);
	//posttoshare();
};
function posttoshare()
{
	$('.cplaya').prop('disabled','disabled').html('กรุณารอซักครู่...');
	$('.sharefb').html('<div style="padding:10px; text-align:center">กรุณารอซักครู่ เพื่อโพสข้อมูลไปยัง Facebook</div>');
	FB.api('/me/feed', 'post',ws,function(r)
	{
		var j='<br><br><a class="button" href="http://jarm.com/" target="_blank" onClick="closelike()">ปิดหน้าต่างนี้</a>';
		if(!r||r.error)
		{
			repeatsend++;
			if(repeatsend<5)
			{
				console.log(r.error);
				$('.sharefb').html('<div style="padding:10px; text-align:center">กรุณารอซักครู่ เพื่อโพสข้อมูลไปยัง Facebook ('+repeatsend+') - '+r.error+'</div>');
				setTimeout(function(){posttoshare();},100);
			}
			else
			{
				$('.sharefb').html('<div style="padding:10px; text-align:center">ไม่สามารถโพสข้อมูลไปยัง Facebook ได้เนื่องจากมีผู้ใชงานจำนวนมากในขณะนี้ <strong>กรุณาลองใหม่อีกครั้ง</strong>'+j+'</div>');
				repeatsend=0;
			}
		}
		else
		{
			var l='https://www.facebook.com/'+r.id;
			l=l.replace('_','/posts/');
			$('.cplaya').removeProp('disabled').html('เล่นอีกครั้ง');
			var tmp='<div style="padding:"10px; text-align:center">โพสไปยัง Facebook เรียบร้อยแล้ว<br>ลิ้งค์บนเฟสบุ๊คคือ <a href="'+l+'" target="_blank">'+l+'</a><br><br>'+
			'<strong>คำตอบคือ</strong>: '+ws.name+'<br>'+
			ws.description+
			'</div>';
			$('#frmans').get(0).reset();
			$('.sharefb').html(tmp);
			repeatsend=0;
		};
	});
}


</script>





