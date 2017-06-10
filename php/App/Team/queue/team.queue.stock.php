<?php

Load::Ajax()->register('delreport');

Load::$core->data['title']='รายชื่องาน - คิวงาน | '.Load::$core->data['title'];

$queue=$db->find('team_queue',['dd'=>['$exists'=>false],'status'=>1,'process'=>'list_stock'],[],['sort'=>['da'=>-1]]);

Load::$core->data['content']=Load::$core->assign('queue',$queue)
                ->assign('page',$page)
                ->fetch('queue.stock');


function delreport($i)
{
  $arg=['_id'=>intval($i),'u'=>team::$my['_id']];
  if(team::$my['grade']==99)
  {
    unset($arg['u']);
  }
  Load::DB()->update('team_queue',$arg,['$set'=>['dd'=>Load::Time()->now()]]);
  team::move(URL);
}

?>
