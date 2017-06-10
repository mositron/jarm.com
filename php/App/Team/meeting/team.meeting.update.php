<?php

if(!$meeting=$db->findone('team_meeting',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]]))
{
  team::move('/meeting');
}

if(team::$my['_id']!=$meeting['u'] && team::$my['grade']!=99)
{
  team::move('/meeting');
}

Load::Ajax()->register('updatemeeting');

Load::$core->data['title']='แก้ไข - การประชุม | '.Load::$core->data['title'];

Load::$core->data['content']=Load::$core->assign('meeting',$meeting)
                ->fetch('meeting.update');

function updatemeeting($par)
{
  $arg=[];
  $arg['title']=trim($par['title']);
  $arg['detail']=stripslashes(trim($par['detail']));
  $arg['ref']=array_values(array_filter(array_map('intval',(array)$par['ref'])));
  $arg['dp']=Load::Time()->from($par['time']);
  $arg['ue']=team::$my['_id'];
  $arg['de']=Load::Time()->now();

  $id=Load::DB()->update('team_meeting',['_id'=>intval(Load::$path[1])],['$set'=>$arg]);
  team::move('/meeting/update/'.intval(Load::$path[1]).'?completed');
}
?>
