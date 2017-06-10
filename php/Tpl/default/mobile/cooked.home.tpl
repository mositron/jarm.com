
<div id="waiting"><div>กรุณารอซักครู่..</div></div>

<ul id="menu">
<li id="menu_fb"></li>
<li id="menu_view"><a href="">สุ่มเมนูวันนี้</a></li>
<li id="menu_recent"><a href="">เมนูก่อนหน้านี้</a></li>
<li><a href="/cooked/share">มีใครกินอะไรกันบ้าง</a></li>
<li><a href="/cooked/apps">แอพแนะนำ</a></li>
</ul>


<script>
function onlogged()
{
	$('#waiting_text').html('กำลังดึงข้อมูล Facebook');
	FB.api('/me', function(u) {
 		_.ajax.gourl('<?php echo URL?>','getmenu',u);
		$('#waiting_text').html('กำลังดึงข้อมูลสมาชิก');
     });
}
function showmenu(u)
{
	$('#menu_view>a').attr('href','/cooked/new/'+u._id);
	$('#menu_recent>a').attr('href','/cooked/recent/'+u._id);
	$('#menu_fb').html('<img src="http://graph.facebook.com/'+u.fb+'/picture?type=square"><div>'+u.name+'</div><p><a href="javascript:;" onclick="relogin()">เปลี่ยนบัญชี Facebook</a></p>');
	$('#waiting').css('display','none');
	$('#menu').css('display','block');
}
</script>