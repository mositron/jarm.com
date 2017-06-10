<?php
Load::$core->data['title']='รายงาน | '.Load::$core->data['title'];

list($id,$pos)=explode('-',Load::$path[1]);
$_=['_id'=>intval($id),'u'=>team::$my['_id']];
if(team::$my['grade']==99)
{
  unset($_['u']);
}
if(!$report=$db->findone('team_report',$_))
{
  team::move('/report');
}

if(!isset($report['d'][$pos]))
{
  team::move('/report');
}

Load::Ajax()->register(['updatereport']);


Load::$core->data['title']='แก้ไขรายงาน | '.Load::$core->data['title'];

Load::$core->data['content']=Load::$core->assign('detail',$report['d'][$pos])
                ->assign('report',$report)
                ->fetch('report.update');

function updatereport($par)
{
  $title=[];
  $t=trim($par['title']);
  $tmp=explode("\n",$t);
  for($i=0;$i<count($tmp);$i++)
  {
    if($t=trim($tmp[$i]))
    {
      $title[]=$t;
    }
  }
  $db=Load::DB();
  $arg=[];
  $arg['ue']=team::$my['_id'];
  $arg['de']=Load::Time()->now();
  list($id,$pos)=explode('-',Load::$path[1]);
  $arg['d.'.$pos.'.title']=implode("\r\n",$title);
  $arg['d.'.$pos.'.time']=trim($par['time']);
  $arg['d.'.$pos.'.note']=trim($par['note']);
  $arg['d.'.$pos.'.link']=trim($par['link']);
  $arg['d.'.$pos.'.customer']=intval($par['customer']);
  $db->update('team_report',['_id'=>intval($id)],['$set'=>$arg]);
  team::move(URL.'?completed');
}

?>
