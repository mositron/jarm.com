<?php
team::session()->logged();

$type=5;

$db=Load::DB();
Load::$core->assign('type',$type);

if(in_array(Load::$path[0],['update']))
{
  require_once(__DIR__.'/team.announce.'.Load::$path[0].'.php');
}
elseif(is_numeric(Load::$path[0]))
{
  require_once(__DIR__.'/team.announce.view.php');
}
else
{
  require_once(__DIR__.'/team.announce.home.php');
}
?>
