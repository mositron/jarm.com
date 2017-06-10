<?php
Load::$core->data['title']='รายงาน | '.Load::$core->data['title'];

$expire=strtotime(date('Y-m-d 00:00:00',strtotime('-1 day')));
Load::Ajax()->register(['newreport','delreport']);

$report=$db->find('team_report',['u'=>team::$my['_id'],'dd'=>['$exists'=>false]],[],['sort'=>['_id'=>-1]]);

Load::$core->data['content']=Load::$core->assign('report',$report)
                ->assign('expire',$expire)
                ->fetch('report.home');

function newreport($par)
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
  $arg['u']=team::$my['_id'];
  $arg['ue']=team::$my['_id'];
  $arg['dp']=Load::Time()->from(date('Y-m-d 00:00:00'));
  $arg['de']=Load::Time()->now();
  $arg['d']=[
              [
                'title'=>implode("\r\n",$title),
                'time'=>trim($par['time']),
                'note'=>trim($par['note']),
                'link'=>trim($par['link']),
                'customer'=>intval($par['customer']),
                'id'=>time(),
              ]
            ];
  if($r=$db->findone('team_report',['u'=>team::$my['_id'],'dp'=>$arg['dp']]))
  {
    $db->update('team_report',['_id'=>$r['_id']],['$set'=>['ue'=>$arg['ue'],'de'=>$arg['de']],'$push'=>['d'=>$arg['d'][0]]]);
  }
  else
  {
    $id=$db->insert('team_report',$arg);
  }
  team::move('/report');
}
function delreport($sid)
{
  list($_id,$id)=explode('-',$sid);
  Load::DB()->update('team_report',['_id'=>intval($_id),'u'=>team::$my['_id']],['$pull'=>['d'=>['id'=>intval($id)]]]);
  team::move(URL);
}
?>
