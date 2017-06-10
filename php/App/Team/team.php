<?php
if(Load::$path[0]=='_')
{
  define('HASH',1);
  array_shift(Load::$path);
}

Load::$core->data['title'] = 'Team - Jarm.com & BoxzaRacing.com';
Load::$core->data['description'] = '';
Load::$core->data['keywords'] = '';


Load::$conf['db']['collection']['team_user']='s2';
Load::$conf['db']['collection']['team_user_position']='s2';
Load::$conf['db']['collection']['team_user_team']='s2';
Load::$conf['db']['collection']['team_customer']='s2';
Load::$conf['db']['collection']['team_content']='s2';
Load::$conf['db']['collection']['team_manual']='s2';
Load::$conf['db']['collection']['team_withdraw']='s2';
Load::$conf['db']['collection']['team_withdraw_data']='s2';
Load::$conf['db']['collection']['team_withdraw_list']='s2';
Load::$conf['db']['collection']['team_logs']='s2';
Load::$conf['db']['collection']['team_queue']='s2';
Load::$conf['db']['collection']['team_meeting']='s2';
Load::$conf['db']['collection']['team_report']='s2';
Load::$conf['db']['collection']['team_brand']='s2';

$team=[0=>'',1=>'Jarm',2=>'Racing'];

$bank=[
1=>'กรุงเทพ Bangkok Bank',
2=>'กรุงไทย Krung Thai Bank',
3=>'กรุงศรีอยุธยา Bank of Ayudhaya',
4=>'กสิกรไทย KasikornBank',
5=>'เกียรตินาคิน Kiatnakin Bank',
6=>'ซิติแบงก์ Citibank',
7=>'ทหารไทย Thai Military Bank',
8=>'ทิสโก้ Thai Investment and Securities Company Bank',
9=>'ไทย BankThai',
10=>'ไทยพาณิชย์ Siam Commercial Bank',
11=>'ธนชาต Thanachart Bank',
12=>'นครหลวงไทย Siam City Bank',
13=>'ยูโอบี United Overseas Bank, Thailand',
14=>'สแตนดาร์ดชาร์เตอร์ด Standard Chartered Bank Thai',
15=>'เมกะสากลพาณิชย์ Mega International Commercial Bank',
16=>'สินเอเชีย Asia Credit Limited Bank',
17=>'เอสเอ็มอี (SME) SME Bank of Thailand',
18=>'ธกส. Bank for Agriculture and Agricultural Coopera...',
19=>'เพื่อการส่งออกและนำเข้า Export-Import Bank of Thai...',
20=>'ออมสิน Government Saving Bank',
21=>'อาคารสงเคราะห์ Government Housing Bank',
22=>'อิสลามแห่งประเทศไทย Islamic Bank of Thailand',
];

$content_type=[
1=>['n'=>'วิธีใช้งานบัตรลงเวลา','l'=>'card'],
2=>['n'=>'วันหยุดประจำปี','l'=>'holidays'],
3=>['n'=>'กฎระเบียบ','l'=>'rule'],
4=>['n'=>'กฎระเบียบการออกกอง','l'=>'production'],
5=>['n'=>'ประกาศ','l'=>'notification'],
6=>['n'=>'เบี้ยเลี้ยง','l'=>'allowance'],
];

require_once(__DIR__.'/team.class.php');

team::session();

$perm=[];
$perm['permPhotoID'] = [1,2,49,28,17];
$perm['permVDOID'] = [1,2,49,19,79,83,17];
$perm['permGraphicID'] = [1,2,49,18,23,17];
$perm['permContentID'] = [1,2,49,39,24,17];
$perm['appointment'] = [34,38,20,77,78,81,82,17];
$perm['permAppointment'] = array_unique(array_merge($perm['permPhotoID'], $perm['permVDOID'], $perm['permGraphicID'], $perm['permContentID'], $perm['appointment']));

Load::$core->assign('bank',$bank)
    ->assign('perm',$perm)
    ->assign('content_type',$content_type);

$hash=['#mn-team-withdraw'=>'','#mn-team-queue'=>''];

require_once(_::run(
						       [
										'' => 'home',
                    'oauth'=>'oauth',
										'announce'=>'announce',
										'user'=>'user',
										'report'=>'report',
										'meeting'=>'meeting',
										'queue'=>'queue',
										'customer'=>'customer',
										'withdraw'=>'withdraw',
										'manual'=>'manual',
										'import'=>'import',
						],
						true
));

if(defined('HASH'))
{
  while(@ob_end_clean());
  header('Content-type: application/json');
  $hash['title']=Load::$core->data['title'];
  $hash['module']=MODULE_LINK;
  $hash['content']=Load::$core->data['content'];
  $hash['url']=URL;
  echo json_encode($hash);
}
else
{
  echo Load::$core->assign('hash',$hash)
            ->fetch3('team/tpl/team');
}

exit;
?>
