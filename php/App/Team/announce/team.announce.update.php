<?php
if(team::$my['grade']!=99)
{
  team::move('/announce');
}

if(!$content=$db->findone('team_content',['_id'=>intval(Load::$path[1])]))
{
  team::move('/announce');
}

if(team::$my['_id']!=$content['u'] && team::$my['grade']!=99)
{
  team::move('/announce');
}

Load::Ajax()->register('updatecontent');


Load::$core->data['title']='แก้ไข - '.$content_type[5]['n'].' | '.Load::$core->data['title'];

Load::$core->data['content']=Load::$core->assign('content',$content)
                ->fetch('announce.update');

function updatecontent($par)
{
  $arg=[];
  $arg['title']=trim($par['title']);
  $arg['detail']=stripslashes(trim($par['detail']));
  $arg['ue']=team::$my['_id'];
  $arg['de']=Load::Time()->now();
  Load::DB()->update('team_content',['_id'=>intval(Load::$path[1])],['$set'=>$arg]);
  team::move('/announce/update/'.Load::$path[1].'?completed');
}
?>
