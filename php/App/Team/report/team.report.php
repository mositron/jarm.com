<?php
team::session()->logged();

$db=Load::DB();
$tmp=$db->find('team_customer',[],['_id'=>1,'name'=>1],['sort'=>['name'=>1]]);
$customer=[];
for($i=0;$i<count($tmp);$i++)
{
  $c=$tmp[$i];
  $customer[$c['_id']]=$c;
}
Load::$core->assign('customer',$customer);
if(is_numeric(Load::$path[0]))
{
  require_once(__DIR__.'/team.report.view.php');
}
elseif(in_array(Load::$path[0],['update']))
{
  require_once(__DIR__.'/team.report.update.php');
}
else
{
  require_once(__DIR__.'/team.report.home.php');
}
?>
