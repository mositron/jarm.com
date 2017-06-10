<?php

if(!$queue=$db->findone('team_queue',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]]))
{
  team::move('/queue');
}

if(team::$my['_id']!=$queue['u'] && team::$my['grade']!=99)
{
  team::move('/queue/'.$queue['_id']);
}

Load::$core->data['title']='แก้ไข - คิวงาน | '.Load::$core->data['title'];

if($_FILES)
{
  $photo=Load::Photo();
  if($f=$_FILES['photo']['tmp_name'])
  {
    $size=@getimagesize($f);
    switch (strtolower($size['mime']))
    {
      case 'image/gif':
      case 'image/jpg':
      case 'image/jpeg':
      case 'image/bmp':
      case 'image/wbmp':
      case 'image/png':
      case 'image/x-png':
        if($size[0]>=1 && $size[1]>=1)
        {
          Load::Upload()->post('f1','upload','@'.$f,['name'=>$queue['_id'],'type'=>'jpg','folder'=>'team/queue','width'=>133,'height'=>133,'fix'=>'inboth']);
          echo json_encode(['file'=>'https://f1.jarm.com/team/queue/'.$queue['_id'].'.jpg?'.time()]);
        }
    }
    exit;
  }
}


if($queue['process']=='list_stock')
{
  require_once(__DIR__.'/team.queue.update.stock.php');
}
elseif($queue['process']=='list_queue')
{
  require_once(__DIR__.'/team.queue.update.queue.php');
}
elseif($queue['process']=='list_process')
{
  require_once(__DIR__.'/team.queue.update.process.php');
}
elseif($queue['process']=='list_complete')
{
  require_once(__DIR__.'/team.queue.update.complete.php');
}

?>
