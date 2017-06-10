<?php

Load::Ajax()->register('delreport');

Load::$core->data['title']='การประชุม | '.Load::$core->data['title'];

$meeting=$db->find('team_meeting',['dd'=>['$exists'=>false]],[],['sort'=>['dp'=>-1]]);

Load::$core->data['content']=Load::$core->assign('meeting',$meeting)
                ->fetch('meeting.home');


function delreport($i)
{
  $arg=['_id'=>intval($i),'u'=>team::$my['_id']];
  if(team::$my['grade']==99)
  {
    unset($arg['u']);
  }
  Load::DB()->update('team_meeting',$arg,['$set'=>['dd'=>Load::Time()->now()]]);
  team::move(URL);
}

?>
