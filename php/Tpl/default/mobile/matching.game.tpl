<div id="user-bar">
<div class="left">Lv. <span id="user-lv"><?php echo $this->lv?></span> (<span id="user-score">0</span>)</div>
<div class="right">
<div id="progress"><div id="progress_bar"></div><p id="progress_text">เหลือเวลา <span id="time-remain"><?php echo $this->game['time']?></span> วินาที</p></div>
<a href="/matching" class="icon-exit"></a>
<!--a href="javascript:;">ขอดูภาพ</a-->
<!--a href="javascript:;">เฉลย 1คู่</a-->
</div>

</div>
<!--div id="sub-bar">
  <div id="social">
    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fjarm&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:58px; height:21px;" allowtransparency="true"></iframe>
    <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FIntrend365-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%25A2%25E0%25B8%25B7%25E0%25B8%2594-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%2581%25E0%25B8%25A3%25E0%25B8%25B5%25E0%25B8%2599-%25E0%25B8%2581%25E0%25B8%25B2%25E0%25B8%2587%25E0%25B9%2580%25E0%25B8%2581%25E0%25B8%2587-%25E0%25B9%2580%25E0%25B8%25AA%25E0%25B8%25B7%25E0%25B9%2589%25E0%25B8%25AD%25E0%25B8%259C%25E0%25B9%2589%25E0%25B8%25B2%25E0%25B9%2581%25E0%25B8%259F%25E0%25B8%258A%25E0%25B8%25B1%25E0%25B9%2588%25E0%25B8%2599%2F786402811370068&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=true&amp;font&amp;action=like&amp;height=21&amp;appId=124335767713181" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:58px; height:21px;" allowTransparency="true"></iframe>
</div>
</div-->



<div id="waiting"><div id="waiting_text">กรุณารอซักครู่..</div></div>

<div id="matching"></div>
<div id="preload"></div>


<script>
var m={
	user:<?php echo json_encode($this->user)?>,game:<?php echo json_encode($this->game)?>,progress:100,ctime:60,tmr:'',tmrpre:'',card:[],opened:[],state:-2,score:0,fail:0,wall:false,resend:0,
	start:function()
	{
		m.state=-1;
		m.ctime=m.game.time;
		m.tmr=setInterval(function(){m.delay()},1000);
	},
	open:function()
	{
		var tmp='',ind,dis=(m.game.max-m.game.min)+1;
		
		m.card=[];
		m.opened=[];
		m.score=0;
		m.fail=0;
		m.state=-2;
		
		var i,mx=parseInt((m.game.cell*m.game.cell)/2),cm;
		for(var i=0;i<mx;i++)
		{
			m.card.push(m.game.min+(i%dis));
			m.opened.push(false);
		}
		for(i=0;i<mx;i++)
		{
			cm=m.card[i];
			m.card.push(cm);
			m.opened.push(false);
		}
		m.card=m.shuffle(m.card);
		for(i=0;i<m.card.length;i++)
		{
			tmp+='<div onclick="m.opencard('+i+');"><p><img src="<?php echo FILES_CDN?>img/mobile/matching/'+m.game.icon+'/'+m.card[i]+'.png"></p><div id="cell_'+i+'"></div></div>';
		}
		$('#user-score').html(m.score-m.fail);
		$('#user-fail').html('');
		$('#progress').css('display','block');
		$('#waiting').css('display','none');
		$('#matching').css('display','block').html(tmp);
		$('#preload').html('<div class="msg-box"><h3>เตรียมพร้อม!.</h3><div>เกมเลเวล <span class="bg-lv"><?php echo $this->lv?></span><br>คุณพร้อมหรือยัง... .. .<br><br><a href="javascript:;" onClick="m.preload()" class="btn btn-play">เริ่มเกมเดี๋ยวนี้</a></div></div>').css('display','block');
		m.resize();
	},
	opencard:function(i)
	{
		if(!m.opened[i])
		{
			if(m.state==-1)	
			{
				m.state=i;
				m.opened[i]=true;
				$('#cell_'+i).css('display','none');
			}
			else if(m.state>=0)
			{
				m.opened[i]=true;
				$('#cell_'+i).css('display','none');
				if(m.card[m.state]==m.card[i])
				{
					$('#cell_'+m.state).parent().addClass('opened');
					$('#cell_'+i).parent().addClass('opened');
					
					m.score+=m.game.score;
					$('#user-score').html(m.score-m.fail);
					
					m.state=-1;
					var pass=true;
					for(var j=0;j<m.opened.length;j++)
					{
						if(!m.opened[j])
						{
							pass=false;	
						}
					}
					if(pass)
					{
						_.ajax.gourl('<?php echo URL?>','setpass',{'lv':<?php echo $this->lv?>,'score':m.score,'fail':m.fail,'id':m.user._id,'fb':uid});
						clearInterval(m.tmr);	
					}
				}
				else
				{
					var ci=m.state;
					m.state=-2;
					m.fail+=m.game.fail;
					$('#user-score').html(m.score-m.fail);
					//$('#user-fail').html('(-'+m.fail+')');
					
					setTimeout(function(){
						m.opened[ci]=false;
						$('#cell_'+ci).css('display','block');
						m.opened[i]=false;
						$('#cell_'+i).css('display','block');
						m.state=-1;
					},1000);
				}
			}
			$('#cell_'+i).parent().css('opacity',0).animate({opacity:1},500);
		}
		else
		{
			$('#cell_'+i).parent().css('opacity',0.5).animate({opacity:1},700);
		}
	},
	nextlevel:function(play,user)
	{
		var tmp='',tmp2='';
		if(user&&user.wall)
		{
			tmp2='<div style="padding:5px; text-align:center" id="btn-post-fb"><a href="javascript:;" onclick="m.post()" class="btn btn-fb">โพสไปยัง Facebook</a></div>';	
		}
		if(play)
		{
			tmp+='<div class="msg-box"><h3>สำเร็จ!.</h3><div>ผ่านเกมเลเวล <?php echo $this->lv?> แล้ว...<br><br>'+tmp2+'<div id="btn-no-fb"><a href="/matching/game/<?php echo $this->user['_id']?>/'+user.lv+'" class="btn btn-next">เกมถัดไป (Lv.'+user.lv+')</a><a href="/matching/game/<?php echo $this->user['_id']?>/<?php echo $this->lv?>" class="btn">เล่นเกมนี้ซ้ำอีกครั้ง</a><a href="/matching/score/<?php echo $this->user['_id']?>" class="btn">ไปหน้าคะแนนสะสม</a></div></div></div>';
		}
		else
		{
			tmp+='<div class="msg-box"><h3>เลเวลสูงสุดแล้ว.</h3><div>ขณะนี้เกมจับคู่จำกัดเลเวลสูงสุดที่ <?php echo $this->maxlv?>. กรุณารออัพเดทเลเวลใหม่เร็วๆนี้.<br><br>'+tmp2+'<div id="btn-no-fb"><a href="/matching/score/<?php echo $this->user['_id']?>" class="btn">ไปหน้าคะแนนสะสม</a><a href="/matching" class="btn btn-exit">ออกจากเกม</a></div></div></div>';
		}
		$('#preload').html(tmp).css('display','block');	
	},
	playagain:function(play)
	{
		var tmp='';
		if(play)
		{
			tmp+='<div class="msg-box"><h3>ล้มเหลว!.</h3><div>คุณไม่ผ่านเกมนี้<br><br><a href="<?php echo URL?>" class="btn btn-next">เล่นอีกครั้ง</a></div></div>';
		}
		else
		{
			tmp+='<div class="msg-box"><h3>เลเวลสูงสุดแล้ว.</h3><div>ขณะนี้เกมจับคู่จำกัดเลเวลสูงสุดที่ <?php echo $this->maxlv?>. กรุณารออัพเดทเลเวลใหม่เร็วๆนี้.<br><br><a href="/matching" class="btn btn-exit">ออกจากเกม</a></div></div>';
		}
		$('#preload').html(tmp).css('display','block');
	},
	shuffle:function(o){for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);return o;},
	preload:function()
	{
		$('#preload').css('display','none');
		var op=10,cpre=0;
		
		m.tmrpre=setInterval(function(){
			var c=m.game.cell*m.game.cell;
			if(c>cpre)
			{
				$('#cell_'+cpre).css('display','none');
			}
			if(cpre-op>=0)
			{
				$('#cell_'+(cpre-op)).css('display','block');
			}
			cpre++;
			if(c<cpre-op)
			{
				clearInterval(m.tmrpre);
				m.start();
			}
		},100);
	},
	delay:function()
	{
		m.ctime--;
		$('#time-remain').html(m.ctime);
		$('#progress_bar').css('width',parseInt((m.ctime/m.game.time)*m.progress));
		if(m.ctime<=0)
		{
			$('#progress_text').html('หมดเวลา');
			$('#waiting').css('display','none');
			$('#matching').css('display','block');
			$('#preload').html('<div class="msg-box"><h3>หมดเวลา</h3><div>หมดเวลาสำหรับเกมนี้แล้ว คุณต้องการเล่นใหม่อีกครั้งหรือไม่...<br><br><a href="<?php echo URL?>" class="btn">เริ่มใหม่อีกครั้ง</a></div>').css('display','block');
			clearInterval(m.tmr);
		}
	},
	resize:function()
	{
		var w=$(window).width(),h=$(window).height();
		var top=$('#user-bar').offset().top+$('#user-bar').height(),space = h-top;
		var c=(100-m.game.cell-1)/m.game.cell;
		var ml=parseInt(w/100);
		var bw=parseInt((w/100)*c);
		var bh=parseInt((space-(ml*(m.game.cell+1)))/m.game.cell);
		m.progress=Math.min(300,w-220);
		$('#progress').css({'width':m.progress});
		$('#matching>div').css({'margin':ml+'px 0px 0px 1%','height':bh,'width':bw});
		$('#matching>div>div,#matching>div>p').css({'height':bh-2,'width':bw});
		$('#preload').css({'top':top,'height':space});
	},
	result:function(w)
	{
		m.wall=w;
	},
	post:function()
	{
		$('#btn-no-fb').css('display','none');
		$('#btn-post-fb').html('กำลังโพสไป Facebook กรุณารอซักครู่...');
		FB.api('/me/feed', 'post',m.wall,function(r)
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
					$('#btn-post-fb').html('ไม่สามารถโพสไป Facebook ได้ในขณะนี้');
					$('#btn-no-fb').css('display','block');
					m.resend=0;
				}
			}
			else
			{
				$('#btn-post-fb').html('โพสไป Facebook เรียบร้อยแล้ว...');
				$('#btn-no-fb').css('display','block');
				m.resend=0;
			};
		});
	}
}

function onlogged()
{
	$('#waiting_text').html('กำลังดึงข้อมูล facebook');
	if(uid==<?php echo $this->user['fb']?>)
	{
		<?php if($this->lv>=$this->maxlv):?>
		$('#waiting').css('display','none');
		m.nextlevel(false);
		m.resize();
		<?php else:?>
		m.open();
		<?php endif?>
	}
	else
	{
		window.location.href='/matching';
	}
}
$(window).resize(m.resize);
</script>