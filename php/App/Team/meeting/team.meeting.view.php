<?php

if(!$meeting=$db->findone('team_meeting',['_id'=>intval(Load::$path[0]),'dd'=>['$exists'=>false]]))
{
  team::move('/meeting');
}


Load::$core->data['title']=$meeting['title'].' | '.Load::$core->data['title'];

Load::$core->data['content']=Load::$core->assign('meeting',$meeting)
                ->fetch('meeting.view');
?>
