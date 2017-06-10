<?php
function setstatus($id,$st)
{
  global $queue;
  if($st=='process')
  {
    $_ = array(
        'process'=>'list_process',
        'upp'=>Load::$my['_id'],
        'dpp'=>Load::Time()->now(),
      );
    Load::DB()->update('team_queue',['_id'=>intval($id)],['$set'=>$_]);
    Load::move(URL);
  }
}

function setprocess($team,$link='')
{
  global $queue;
  $ajax=Load::Ajax();
  $_=false;
  if($team=='photo')
  {
    $_ = array(
      'pt.u'=>Load::$my['_id'],
      'pt.d'=>Load::Time()->now()
    );
  }
  elseif($team=='production')
  {
    $_ = array(
      'pd.u'=>Load::$my['_id'],
      'pd.d'=>Load::Time()->now(),
      'pd.l'=>trim($link),
    );
  }
  elseif($team=='graphic')
  {
    $_ = array(
      'gp.u'=>Load::$my['_id'],
      'gp.d'=>Load::Time()->now(),
    );
  }
  elseif($team=='content')
  {
    $_ = array(
      'ct.u'=>Load::$my['_id'],
      'ct.d'=>Load::Time()->now(),
      'ct.l'=>trim($link)
    );
  }
  if($_)
  {
    Load::DB()->update('team_queue',['_id'=>$queue['_id']],['$set'=>$_]);
    Load::move(URL);
  }
}
?>
