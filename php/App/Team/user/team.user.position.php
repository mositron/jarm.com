<?php
if(team::$my['grade']!=99)
{
  Load::move('/user');
}
Load::Ajax()->register(['newposition','delposition']);

Load::$core->data['title']='จัดการตำแหน่งสมาชิก | '.Load::$core->data['title'];

$user=$db->find('team_user_position',[],[],['sort'=>['name'=>1]]);

Load::$core->data['content']=Load::$core->assign('user',$user)
                ->fetch('user.position');

function newposition($par)
{
  $db=Load::DB();
  $arg=[];
  $arg['status']=1;
  $arg['name']=trim($par['name']);
  $arg['display']=trim($par['display']);
  if($db->findone('team_user_position',['$or'=>[['name'=>$arg['name']]],['display'=>$arg['display']]]))
  {
    Load::Ajax()->alert('มีตำแหน่งนี้อยู่แล้ว');
  }
  else
  {
    $id=$db->insert('team_user_position',$arg);
    team::move('/user/position/?added='.$id);
  }
}
function delposition($id)
{
  Load::DB()->update('team_user_position',['_id'=>intval($id)],['$set'=>['status'=>0]]);
  team::move('/user/position/?deleted='.$id);
}
?>
