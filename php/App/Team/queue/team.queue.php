<?php
team::session()->logged();

$province=require(HANDLERS.'config/province.php');

$db=Load::DB();

$type=[
1=>['name'=>'Magazine','display'=>'Magazine'],
2=>['name'=>'Garage','display'=>'Garage'],
3=>['name'=>'People','display'=>'People'],
4=>['name'=>'Team','display'=>'Team'],
5=>['name'=>'Girl','display'=>'Girl'],
6=>['name'=>'Event','display'=>'Event'],
7=>['name'=>'Content','display'=>'Content'],
9=>['name'=>'รายการ','display'=>'รายการ'],
10=>['name'=>'Clip VDO Presentation','display'=>'Clip VDO Presentation'],
11=>['name'=>'Viral Clip TVC','display'=>'Viral Clip TVC'],
12=>['name'=>'Highlight','display'=>'Highlight'],
8=>['name'=>'อื่นๆ','display'=>'อื่นๆ'],
];

$tmp=$db->find('team_user',['status'=>1],[],['sort'=>['code'=>1]]);
$people=[];
for($i=0;$i<count($tmp);$i++)
{
  $people[$tmp[$i]['_id']]=$tmp[$i];
}
Load::$core->assign('type',$type)
    ->assign('people',$people)
    ->assign('province',$province);

$page='';
if(in_array(Load::$path[0],['update','insert','stock','wait','process','complete','calendar']))
{
  require_once(__DIR__.'/team.queue.'.Load::$path[0].'.php');
}
elseif(is_numeric(Load::$path[0]))
{
  require_once(__DIR__.'/team.queue.view.php');
}
else
{
  require_once(__DIR__.'/team.queue.stock.php');
}

$hash['#mn-team-queue']='
<li'.($page=='stock'?' class="active"':'').'><a href="/queue/stock"><i class="fa fa-file-text-o"></i> รายชื่องาน <span class="label label-default pull-right">'.$db->count('team_queue',['process'=>'list_stock','status'=>1]).'</span></a></li>
<li'.($page=='wait'?' class="active"':'').'><a href="/queue/wait"><i class="fa fa-list"></i> รอดำเนินการ <span class="label label-warning pull-right">'.$db->count('team_queue',['process'=>'list_queue','status'=>1]).'</span></a></li>
<li'.($page=='process'?' class="active"':'').'><a href="/queue/process"><i class="fa fa-list-ol"></i> กำลังดำเนินการ <span class="label label-danger pull-right">'.$db->count('team_queue',['process'=>'list_process','status'=>1]).'</span></a></li>
<li'.($page=='complete'?' class="active"':'').'><a href="/queue/complete"><i class="fa fa-file-video-o"></i> ดำเนินการแล้ว <span class="label label-success pull-right">'.$db->count('team_queue',['process'=>'list_complete','status'=>1]).'</span></a></li>
<li'.($page=='calendar'?' class="active"':'').'><a href="/queue/calendar"><i class="fa fa-calendar"></i> ตารางงาน</a>'.(Load::$path[0]=='calendar'?'
<ul>
<li><a href="/queue/calendar/production" style="font-size:12px;background:#bd2132;margin:3px 0px 3px 40px;border-radius:4px;color:#fff;height:22px;line-height:22px;">Production</a></li>
<li><a href="/queue/calendar/photographer" style="font-size:12px;background:#0c9348;margin:3px 0px 3px 40px;border-radius:4px;color:#fff;height:22px;line-height:22px;">Photographer</a></li>
<li><a href="/queue/calendar/content" style="font-size:12px;background:#f2c347;margin:3px 0px 3px 40px;border-radius:4px;color:#fff;height:22px;line-height:22px;">Content</a></li>
</ul>
':'').'</li>
';
?>
