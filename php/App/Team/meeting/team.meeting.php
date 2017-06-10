<?php
team::session()->logged();

$db=Load::DB();
$tmp=$db->find('team_user',['status'=>1],[],['sort'=>['code'=>1]]);
$people=[];
for($i=0;$i<count($tmp);$i++)
{
  $people[$tmp[$i]['_id']]=$tmp[$i];
}
Load::$core->assign('people',$people);

if(in_array(Load::$path[0],['update','insert']))
{
  require_once(__DIR__.'/team.meeting.'.Load::$path[0].'.php');
}
elseif(is_numeric(Load::$path[0]))
{
  require_once(__DIR__.'/team.meeting.view.php');
}
else
{
  require_once(__DIR__.'/team.meeting.home.php');
}
?>
