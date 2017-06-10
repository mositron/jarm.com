<?php

Load::Ajax()->register(['updatequeue']);


Load::$core->data['content']=Load::$core->assign('queue',$queue)
                ->fetch('queue.update.queue');

function updatequeue($par)
{
  global $queue;

  $arg=[];
  $arg['name']=trim($par['name']);
  $arg['phone']=trim($par['phone']);
  $arg['type']=intval($par['type']);
  $arg['detail']=trim($par['detail']);
  $arg['note']=trim($par['note']);

  $arg['location']=trim($par['location']);
  $arg['province']=trim($par['province']);
  $ds=explode(' - ',trim($par['ds']),2);
  $arg['ds1']=Load::Time()->from(trim($ds[0]));
  $arg['ds2']=Load::Time()->from(trim($ds[1]));
  $arg['note_queue']=trim($par['note_queue']);
  $arg['pt.p']=intval($par['pt_p']);
  $arg['pd.p']=intval($par['pd_p']);
  $arg['gp.p']=intval($par['gp_p']);
  $arg['ct.p']=intval($par['ct_p']);
  if(!is_array($par['ref']))
  {
    if($par['ref'])
    {
      $par['ref']=[$par['ref']];
    }
    else
    {
      $par['ref']=[];
    }
  }
  $arg['ref']=array_values(array_filter(array_map('intval',(array)$par['ref'])));
  $arg['ueq']=team::$my['_id'];
  $arg['deq']=Load::Time()->now();


  Load::DB()->update('team_queue',['_id'=>$queue['_id']],['$set'=>$arg]);
  team::move('/queue/update/'.intval(Load::$path[1]).'?completed2');
}

?>
