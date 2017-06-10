<?php
team::session()->logged();

$db=Load::DB();

$position=[];
$tmp=$db->find('team_user_position',[],[],['sort'=>['display'=>1]]);
for($i=0;$i<count($tmp);$i++)
{
  $p=$tmp[$i];
  $position[$p['_id']]=$p;
}
$team=[];
$tmp=$db->find('team_user_team',[],[],['sort'=>['display'=>1]]);
for($i=0;$i<count($tmp);$i++)
{
  $p=$tmp[$i];
  $team[$p['_id']]=$p;
}
$status=[
          -1=>['t'=>'ออกแล้ว','n'=>'Banned','l'=>'danger'],
          0=>['t'=>'รอยืนยัน','n'=>'Pending','l'=>'warning'],
          1=>['t'=>'พนักงาน','n'=>'Approved','l'=>'success'],
          2=>['t'=>'ทดลองงาน','n'=>'Probation','l'=>'info'],
];

Load::$core->assign('team',$team)
    ->assign('status',$status)
    ->assign('position',$position);


if(in_array(Load::$path[0],['update','team','position']))
{
  require_once(__DIR__.'/team.user.'.Load::$path[0].'.php');
}
elseif(is_numeric(Load::$path[0]))
{
  require_once(__DIR__.'/team.user.view.php');
}
else
{
  require_once(__DIR__.'/team.user.home.php');
}
?>
