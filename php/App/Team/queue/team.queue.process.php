<?php

Load::Ajax()->register('delreport');

Load::$core->data['title']='กำลังดำเนินการ - คิวงาน | '.Load::$core->data['title'];

$queue=$db->find('team_queue',['dd'=>['$exists'=>false],'status'=>1,'process'=>'list_process'],[],['sort'=>['ds1'=>-1]]);

Load::$core->data['content']=Load::$core->assign('queue',$queue)
                ->assign('page',$page)
                ->fetch('queue.process');
?>
