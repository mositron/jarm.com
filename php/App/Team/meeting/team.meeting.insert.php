<?php

Load::Ajax()->register('newmeeting');

Load::$core->data['title']='เพิ่ม - การประชุม | '.Load::$core->data['title'];

Load::$core->data['content']=Load::$core->fetch('meeting.insert');

function newmeeting($par)
{
  $arg=[];
  $arg['title']=trim($par['title']);
  $arg['detail']=stripslashes(trim($par['detail']));
  $arg['ref']=array_values(array_filter(array_map('intval',(array)$par['ref'])));
  $arg['dp']=Load::Time()->from($par['time']);
  $arg['u']=team::$my['_id'];
  $arg['ue']=team::$my['_id'];
  $arg['de']=Load::Time()->now();
  $id=Load::DB()->insert('team_meeting',$arg);
  team::move('/meeting/update/'.$id.'?completed');
}
?>
