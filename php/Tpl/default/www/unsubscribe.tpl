<?php

$a = '';

if($_GET['type']=='invite')
{
	$_code = md5('unsubscribe'.md5($_GET['email']));
	if($_code == $_GET['code'])
	{
		$a = 'yes';
	}
	else
	{
		$a = 'no';
	}
}
?>
<div style="text-align:center; padding:50px">
<div style="width:500px; text-align:center; margin:50px auto; box-shadow:5px 5px 0px #f0f0f0; border:1px solid #e8e8e8; padding:50px 0px; line-height:2.6em; background:#fff;">
<?php if($a=='yes'):?>
<h3>You unsubscribed successfully.</h3>
<div>ยกเลิกการรับการเชิญชวนจากเพื่อนๆของคุณเรียบร้อยแล้ว</div>

<?php elseif($a=='no'):?>
<h3>เกิดข้อผิดพลาด.</h3>
<div>ข้อมูลยืนยันการยกเลิกการเชิญชวนไม่ถูกต้อง</div>
<?php else:?>
<h3>เกิดข้อผิดพลาด.</h3>
<div>ข้อมูลไม่ถูกต้อง</div>
<?php endif?>
</div></div>
