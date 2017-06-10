<?php

if(!$content=$db->findone('team_content',['_id'=>intval(Load::$path[0])]))
{
  team::move('/announce');
}


Load::$core->data['title']=$content['t'].' - '.$content_type[$type]['n'].' | '.Load::$core->data['title'];

Load::$core->data['content']=Load::$core->assign('content',$content)
                ->fetch('announce.view');
?>
