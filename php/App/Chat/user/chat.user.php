<?php

if(!Load::$path[0])
{
  Load::move('/',true);
}

if(!Load::$path[0]=='me')
{
  Load::move('/user/'.Load::$my['_id']);
}

if(!is_numeric(Load::$path[0]))
{
  Load::move('/');
}

if(!$user=Load::DB()->findone('chatroom_user',['u'=>Load::$path[0],'dd'=>['$exists'=>false]]))
{
  Load::move('/',true);
}

Load::$core->data['title'] = _get_nick($user['n'],false).' - Jarm Chat โปรไฟล์ส่วนตัว';
Load::$core->data['description'] =  'เกี่ยวกับ '._get_nick($user['n'],false).' - '.Load::$core->data['description'];
Load::$core->data['keywords'] = _get_nick($user['n'],false).', ประวัติ, โปรไฟล์';

Load::Ajax()->register(['vote','setrec','sendgift','addpoint','setban','resetavatar','setblock','hackbywut','setverify','sethideall','buypet','sellpet','savecrop'],'user');


Load::$core->assign('user',$user);
Load::$core->assign('gift', Load::DB()->find('chatroom_gift',array('u'=>$user['u'],'ex'=>array('$gte'=>Load::Time()->now())),[],['sort'=>['_id'=>-1]]));
Load::$core->assign('online', Load::DB()->findone('chatroom_online',array('u'=>$user['u'],'m'=>date('n'))));

Load::$core->data['content']=Load::$core->fetch('user');
?>
