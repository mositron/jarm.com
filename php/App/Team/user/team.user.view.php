<?php

if(!$user=$db->findone('team_user',['_id'=>intval(Load::$path[0])]))
{
  team::move('/user');
}


Load::$core->data['title']=$user['th']['first'].' '.$user['th']['last'].' - สมาชิก | '.Load::$core->data['title'];

Load::$core->data['content']=Load::$core->assign('user',$user)
                ->fetch('user.view');
?>
