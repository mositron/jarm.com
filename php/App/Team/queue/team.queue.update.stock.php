<?php

Load::Ajax()->register(['updatequeue']);


Load::$core->data['content']=Load::$core->assign('queue',$queue)
                ->fetch('queue.update.stock');

function updatequeue($par)
{
  global $queue;

  $arg=[];
  $arg['name']=trim($par['name']);
  $arg['phone']=trim($par['phone']);
  $arg['type']=intval($par['type']);
  $arg['detail']=trim($par['detail']);
  $arg['note']=trim($par['note']);
  $arg['ue']=team::$my['_id'];
  $arg['de']=Load::Time()->now();

  Load::DB()->update('team_queue',['_id'=>$queue['_id']],['$set'=>$arg]);
  team::move('/queue/update/'.intval(Load::$path[1]).'?completed');
}

?>
