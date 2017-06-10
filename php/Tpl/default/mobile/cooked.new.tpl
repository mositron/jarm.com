<div id="user-bar"><img src="http://graph.facebook.com/<?php echo $this->user['fb']?>/picture?type=square"> <?php echo $this->user['name']?></div>
<!--div id="sub-bar">
  <div id="social">
    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fjarm&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:58px; height:21px;" allowtransparency="true"></iframe>
    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FIntrend365-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%25A2%25E0%25B8%25B7%25E0%25B8%2594-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%2581%25E0%25B8%25A3%25E0%25B8%25B5%25E0%25B8%2599-%25E0%25B8%2581%25E0%25B8%25B2%25E0%25B8%2587%25E0%25B9%2580%25E0%25B8%2581%25E0%25B8%2587-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%259C%25E0%25B9%2589%25E0%25B8%25B2%25E0%25B9%2581%25E0%25B8%259F%25E0%25B8%258A%25E0%25B8%25B1%25E0%25B9%2588%25E0%25B8%2599%2F786402811370068&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:58px; height:21px;" allowTransparency="true"></iframe>
</div>
</div-->



<div id="waiting"><div id="waiting_text">กรุณารอซักครู่..</div></div>

<div id="cooked">

<div id="result"></div>

<button type="button" class="btn btn-get" onClick="m.get()">สุ่มเมนู!.</button>

<div id="filter">
<h4>วัตถุดิบที่ไม่ต้องการในเมนูของคุณ<a href="/cooked/filter">+</a></h4>
<div id="filter_in">
<?php if($this->user['ft']):?>
<ul>
<?php for($i=count($this->user['ft'])-1;$i>=0;$i--):$v=$this->user['ft'][$i];?>
<li><a href="/cooked/filter/<?php echo urlencode($v['n'])?>/<?php echo $v['ty']?>"><strong><?php echo $v['n']?> </strong><i></i></a></li>
<?php endfor?>
</ul>
<?php else:?>
<div>ยังไม่วัตถุดิบที่ไม่ต้องการ</div>
<?php endif?>
</div>
<p>คลิกที่รายการ เพื่อแก้ไข หรือลบ</p>
</div>
</div>
<div id="preload"></div>


<script>
var m={
	user:<?php echo json_encode($this->user)?>,ms:{},
	start:function()
	{
		$('#cooked').css('display','block');
	},
	get:function()
	{
		$('#result').html('<div>กรุณารอซักครู่...</div>');
		_.ajax.gourl('<?php echo URL?>','get');
	},
	select:function(n)
	{
		$('#result').html('<div>กรุณารอซักครู่...</div>');
		_.ajax.gourl('<?php echo URL?>','select',n);
	},
	complete:function(c)
	{
		m.ms={
						message:'กำลังจะกิน: '+c.n+"\n วัตถุดิบ: "+c.m.join(', '),
						name:'กินไรดี+',
						caption:'หากคุณคิดไม่ออกว่าจะกินอะไรดี.. เราช่วยได้!.',
						link:'https://play.google.com/store/apps/details?id=com.doodroid.cooked',
						picture:'https://lh5.ggpht.com/3DOKOIzl_fpt1ZlhWYD6wpjsFnSqm-_JSZTJE3_L7XdZ8tsqRrG-ZwOzDHTyUz8rO-c',
						description:'กินไรดี+ for Android ช่วยคิดเมนูอาหารให้คุณได้ พร้อมแชร์ไปให้เพื่อนหรือจะแอบดูว่าเพื่อนกินอะไรบ้าง.. ก็ได้!.',
						actions:[{name:'กินไรดี+ for Android',link:'https://play.google.com/store/apps/details?id=com.doodroid.cooked'}]
					};
		$('#result').html('<h3>'+c.n+'</h3><p>วัตถุดิบ: '+c.m.join(', ')+'</p><div><div id="post-fb"></div><div><input type="button" class="btn btn-fb" value=" โพสไปยัง Facebook " onclick="m.facebook()"><a href="/cooked/recent/<?php echo $this->user['_id']?>" class="btn btn-recent">ไปยังหน้าเมนูล่าสุดของคุณ</a></div></div>');
		
	},
	facebook:function()
	{
		$('.btn-get,#result').css('display','none');
		$('#waiting').css('display','block');
		$('#waiting_text').html('กำลังโพสไป Facebook กรุณารอซักครู่...');
		FB.api('/me/feed', 'post',m.ms,function(r)
		{
			// รอซักครู่
			if(!r||r.error)
			{
				m.resend++;
				if(m.resend<5)
				{
					// รอซักครู่
					setTimeout(function(){m.post();},100);
				}
				else
				{
					$('#post-fb').html('ไม่สามารถโพสไป Facebook ได้ในขณะนี้');				
					$('.btn-get,#result').css('display','block');
					$('#waiting').css('display','none');
					m.resend=0;
				}
			}
			else
			{
				$('#post-fb').html('โพสไป Facebook เรียบร้อยแล้ว...');		
				$('.btn-get,#result').css('display','block');
				$('#waiting,.btn-fb').css('display','none');
				$('.btn-recent').remove('right');
				m.resend=0;
			};
		});
	},
	newfilter:function(n)
	{
		_.ajax.gourl('<?php echo URL?>','newfilter',n);
	},
	editfilter:function(n,o)
	{
		_.ajax.gourl('<?php echo URL?>','editfilter',o,n);	
	},
	delfilter:function(n)
	{
		_.ajax.gourl('<?php echo URL?>','delfilter',n);	
	}
}


function onlogged()
{
	$('#waiting').css('display','none');
	if(uid!=<?php echo self::$path[1]?>)
	{
		m.start();
	}
	else
	{
		window.location.href='/cooked';
	}
}
//$(window).resize(m.resize);
</script>