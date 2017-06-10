<?php

if(!$withdraw=$db->findone('team_withdraw',['_id'=>intval(Load::$path[0]),'dd'=>['$exists'=>false]]))
{
  team::move('/withdraw');
}

Load::Ajax()->register(['setstatus'],'withdraw');

Load::$core->data['title']='ใบเบิก: '.$withdraw['_id'].' | เบิกเงิน '.Load::$core->data['title'];

$user=$db->findone('team_user',['_id'=>$withdraw['u']],['th'=>1,'nickname'=>1]);
$data=$db->find('team_withdraw_data',['withdraw'=>$withdraw['_id']],[],['sort'=>['_id'=>1]]);
$prod=$product[$withdraw['product']];

Load::$core->data['content']=Load::$core->assign('withdraw',$withdraw)
                ->assign('user',$user)
                ->assign('prod',$prod)
                ->assign('data',$data)
                ->fetch('withdraw.view');
?>
