<?php


if(in_array(Load::$path[0],['google','logout']))
{
  require_once(__DIR__.'/team.oauth.'.Load::$path[0].'.php');
}

team::session();
if(team::$my)
{
  if($_GET['redirect_uri'])
  {
    Load::move($_GET['redirect_uri']);
  }
  else
  {
    Load::move(['team']);
  }
}

Load::$core->data['title'] = 'ล็อคอิน';
Load::$core->data['description'] = Load::$core->data['title'].' - ซื้อขายบ้าน เจ้าของขายเอง';
Load::$core->data['keywords'] = 'ล็อคอิน, login, signin, สังคมออนไลน์';

Load::$core->assign('q',$_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:'');
echo Load::$core->fetch('oauth');
exit;

function get_error($er)
{
  switch ($er) {
    case 'invalid-user':
      return 'ไม่มีอีเมล์ '.$_GET['email'].' ในระบบ';
    case 'empty':
      return 'ระบบไม่สามารถค้นหาอีเมล์ของคุณได้';
    case 'email-facebook':
      return 'ไม่สามารถใช้งานอีเมล์ @facebook.com ได้';
    case 'verified':
      return 'อีเมล์นี้ยังไม่ได้ยืนยันการใช้งาน facebook';
    default:
      return $er;
  }
}
?>
