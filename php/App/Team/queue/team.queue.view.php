<?php

if(!$queue=$db->findone('team_queue',['_id'=>intval(Load::$path[0]),'dd'=>['$exists'=>false]]))
{
  team::move('/queue');
}

Load::Ajax()->register(['setstatus','setprocess'],'queue');

Load::$core->data['title']='ใบเบิก: '.$queue['_id'].' | เบิกเงิน '.Load::$core->data['title'];


$logs_type=[
  1=>'add',
  2=>'edit',
  3=>'delete',
  4=>'login',
  5=>'save'
];

$status_name=[
  0=>'รอส่งอนุมัติ',
  1=>'รอตรวจสอบ',
  2=>'ไม่ผ่านตรวจสอบ',
  3=>'รออนุมัติ',
  4=>'ไม่อนุมัติ',
  5=>'รอจ่าย',
  6=>'รอเคลียร์เงิน',
  7=>'รอเคลียร์บิล',
  8=>'เคลียร์บิลแล้ว',
  9=>'ยกเลิก'
];

$withdraw=$db->find('team_withdraw',['product'=>$queue['_id'],'status'=>['$gt'=>1]],['_id'=>1,'no'=>1,'da'=>1,'u'=>1,'status'=>1]);
$logs=$db->find('team_logs',['data'=>$queue['_id'],'status'=>1,'module'=>'production'],[],['sort'=>['_id'=>-1]]);

Load::$core->data['content']=Load::$core->assign('queue',$queue)
                ->assign('user',$user)
                ->assign('withdraw',$withdraw)
                ->assign('logs',$logs)
                ->assign('logs_type',$logs_type)
                ->assign('status_name',$status_name)
                ->fetch('queue.view');
?>
