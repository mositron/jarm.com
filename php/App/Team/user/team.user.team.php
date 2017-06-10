<?php
if(team::$my['grade']!=99)
{
  Load::move('/user');
}
Load::Ajax()->register(['newteam','delteam']);

Load::$core->data['title']='จัดการทีมสมาชิก | '.Load::$core->data['title'];

$user=$db->find('team_user_team',[],[],['sort'=>['name'=>1]]);

Load::$core->data['content']=Load::$core->assign('user',$user)
                ->fetch('user.team');

function newteam($par)
{
  $db=Load::DB();
  $arg=[];
  $arg['status']=1;
  $arg['name']=trim($par['name']);
  $arg['display']=trim($par['display']);
  if($db->findone('team_user_team',['$or'=>[['name'=>$arg['name']]],['display'=>$arg['display']]]))
  {
    Load::Ajax()->alert('มีทีมนี้อยู่แล้ว');
  }
  else
  {
    $id=$db->insert('team_user_team',$arg);
    team::move('/user/team/?added='.$id);
  }
}
function delteam($id)
{
  Load::DB()->update('team_user_team',['_id'=>intval($id)],['$set'=>['status'=>0]]);
  team::move('/user/team/?deleted='.$id);
}
?>
