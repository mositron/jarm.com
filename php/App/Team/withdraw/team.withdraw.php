<?php
team::session()->logged();

$province=require(HANDLERS.'config/province.php');
$status_name=[
  'stock'=>'รอส่งอนุมัติ',
  'check'=>'รอตรวจสอบ',
  'recheck'=>'ไม่ผ่านตรวจสอบ',
  'approve'=>'รออนุมัติ',
  'disapprove'=>'ไม่อนุมัติ',
  'paid'=>'รอจ่าย',
  'pay'=>'รอเคลียร์เงิน',
  'clear'=>'รอเคลียร์บิล',
  'done'=>'เคลียร์บิลแล้ว',
  'all'=>'ใบเบิกทั้งหมด'
];
$type=[
  1=>[
      'name'=>'ออกงาน',
      'display'=>'ออกงาน',
  ],
  2=>[
      'name'=>'office',
      'display'=>'ออฟฟิค',
  ],
];

$form=[
  1=>[
      'name'=>'ปกติ',
      'display'=>'ปกติ',
  ],
  2=>[
      'name'=>'ล่วงหน้า',
      'display'=>'ล่วงหน้า',
  ]
];

$status=[
  0=>[
    'display'=>$status_name['stock'],
    'page'=>'stock',
    'name'=>'pedding'
  ],
  1=>[
    'display'=>$status_name['check'],
    'page'=>'check',
    'name'=>'check'
  ],
  2=>[
    'display'=>$status_name['recheck'],
    'page'=>'recheck',
    'name'=>'recheck'
  ],
  3=>[
    'display'=>$status_name['approve'],
    'page'=>'approve',
    'name'=>'approve'
  ],
  4=>[
    'display'=>$status_name['disapprove'],
    'page'=>'disapprove',
    'name'=>'disapprove'
  ],
  5=>[
    'display'=>$status_name['paid'],
    'page'=>'paid',
    'name'=>'paid'
  ],
  6=>[
    'display'=>$status_name['pay'],
    'page'=>'pay',
    'name'=>'pay'
  ],
  7=>[
    'display'=>$status_name['clear'],
    'page'=>'clear',
    'name'=>'clear'
  ],
  8=>[
    'display'=>$status_name['done'],
    'page'=>'done',
    'name'=>'done',
  ],
  9=>[
    'display'=>'ยกเลิก',
    'page'=>'cancle',
    'name'=>'cancle',
  ]
];

$queue_type=[
  1=>[
    'name'=>'Magazine',
    'display'=>'Magazine'
  ],
  2=>[
    'name'=>'Garage',
    'display'=>'Garage'
  ],
  3=>[
    'name'=>'People',
    'display'=>'People'
  ],
  4=>[
    'name'=>'Team',
    'display'=>'Team'
  ],
  5=>[
    'name'=>'Girl',
    'display'=>'Girl'
  ],
  6=>[
    'name'=>'Event',
    'display'=>'Event'
  ],
  7=>[
    'name'=>'Content',
    'display'=>'Content'
  ],
  8=>[
    'name'=>'อื่นๆ',
    'display'=>'อื่นๆ'
  ],
  9=>[
    'name'=>'รายการ',
    'display'=>'รายการ'
  ],
  10=>[
    'name'=>'Clip VDO Presentation',
    'display'=>'Clip VDO Presentation'
  ],
  11=>[
    'name'=>'Viral Clip TVC',
    'display'=>'Viral Clip TVC'
  ],
  12=>[
    'name'=>'Highlight',
    'display'=>'Highlight'
  ]
];
$db=Load::DB();
$tmp=$db->find('team_withdraw_list',['status'=>1],[],['sort'=>['name'=>1]]);
$list=[];
for($i=0;$i<count($tmp);$i++)
{
  $list[$tmp[$i]['_id']]=$tmp[$i];
}
$tmp=$db->find('team_queue',['status'=>1],[],['sort'=>['name'=>1]]);
$product=[];
for($i=0;$i<count($tmp);$i++)
{
  $product[$tmp[$i]['_id']]=$tmp[$i];
}
$tmp=$db->find('team_user_team',['status'=>1],[],['sort'=>['name'=>1]]);
$team=[];
for($i=0;$i<count($tmp);$i++)
{
  $team[$tmp[$i]['_id']]=$tmp[$i];
}


$adv = new Advance();

Load::$core->assign('adv',$adv)
    ->assign('product',$product)
    ->assign('status',$status)
    ->assign('list',$list)
    ->assign('team',$team)
    ->assign('type',$type)
    ->assign('form',$form)
    ->assign('province',$province)
    ->assign('queue_type',$queue_type)
    ->assign('status_name',$status_name);

$page='';
if(in_array(Load::$path[0],['update','insert']))
{
  require_once(__DIR__.'/team.withdraw.'.Load::$path[0].'.php');
}
elseif(in_array(Load::$path[0],['','stock','check','recheck','approve','disapprove','paid','pay','clear','done','all']))
{
  if(!($page=Load::$path[0]))
  {
    $page='stock';
  }
  require_once(__DIR__.'/team.withdraw.home.php');
}
elseif(is_numeric(Load::$path[0]))
{
  require_once(__DIR__.'/team.withdraw.view.php');
}
else
{
  $page='stock';
  require_once(__DIR__.'/team.withdraw.home.php');
}

$hash['#mn-team-withdraw']='
<li'.($page=='stock'?' class="active"':'').'><a href="/withdraw/stock"><i class="fa fa-file-text-o"></i> รอส่งอนุมัติ <span class="label label-status-0 pull-right">'.$adv->stock().'</span></a></li>
<li'.($page=='check'?' class="active"':'').'><a href="/withdraw/check"><i class="fa fa-pulse fa-spinner"></i> รอตรวจสอบ <span class="label label-status-1 pull-right">'.$adv->check().'</span></a></li>
<li'.($page=='recheck'?' class="active"':'').'><a href="/withdraw/recheck"><i class="fa fa-times"></i> ไม่ผ่านตรวจสอบ <span class="label label-status-2 pull-right">'.$adv->recheck().'</span></a></li>
<li'.($page=='approve'?' class="active"':'').'><a href="/withdraw/approve"><i class="fa fa-pulse fa-spinner"></i> รออนุมัติ <span class="label label-status-3 pull-right">'.$adv->approve().'</span></a></li>
<li'.($page=='disapprove'?' class="active"':'').'><a href="/withdraw/disapprove"><i class="fa fa-ban"></i> ไม่อนุมัติ <span class="label label-status-4 pull-right">'.$adv->disapprove().'</span></a></li>
<li'.($page=='paid'?' class="active"':'').'><a href="/withdraw/paid"><i class="fa fa-spin fa-circle-o-notch"></i> รอจ่าย <span class="label label-status-5 pull-right">'.$adv->paid().'</span></a></li>
<li'.($page=='pay'?' class="active"':'').'><a href="/withdraw/pay"><i class="fa fa-spin fa-refresh"></i> รอเคลียร์เงิน <span class="label label-status-6 pull-right">'.$adv->pay().'</span></a></li>
<li'.($page=='clear'?' class="active"':'').'><a href="/withdraw/clear"><i class="fa fa-spin fa-refresh"></i> รอเคลียร์บิล <span class="label label-status-7 pull-right">'.$adv->clear().'</span></a></li>
<li'.($page=='done'?' class="active"':'').'><a href="/withdraw/done"><i class="fa fa-check"></i> เคลียร์บิลแล้ว <span class="label label-status-8 pull-right">'.$adv->done().'</span></a></li>
<li'.($page=='all'?' class="active"':'').'><a href="/withdraw/all"><i class="fa fa-clone"></i> ใบเบิกทั้งหมด <span class="label label-status-all pull-right">'.$adv->all().'</span></a></li>
';

Class Advance
{
  public $permCheck = [62,47,67,92];
  public $permPaidLook = [67];
  public $permLook = [67,92,95];
  public $permClearLook = [62];
  public $permPositionCheck = [36];
  public $permPositionClearLook = [36];

  // รอส่ง
  public function stock($c=true)
  {
    //$arg=['status'=>1,'u'=>team::$my['_id'],'status2.u'=>0];
    $arg=['status'=>0,'u'=>team::$my['_id']];
    return $this->get($c,$arg);
  }
  // รอตรวจสอบ
  public function check($c=true)
  {
    //$arg=['status'=>2,'status3.uc'=>0,'status8.u'=>0];
    $arg=['status'=>1];
    if (in_array(team::$my['grade'],[99,98,97]) ||
        in_array(team::$my['_id'], $this->permCheck) ||
        in_array(team::$my['_id'], $this->permLook) ||
        in_array(team::$my['pos'], $this->permPositionCheck))
    {
    }
    else
    {
      $arg['u']=team::$my['_id'];
    }
    return $this->get($c,$arg);
  }
  // ไม่ผ่านตรวจสอบ
  public function recheck($c=true)
  {
    //$arg=['status'=>1,'status2.ur'=>['$ne'=>0]];
    $arg=['status'=>2];
    if (in_array(team::$my['grade'],[99,98,97]) ||
        in_array(team::$my['_id'], $this->permCheck) ||
        in_array(team::$my['_id'], $this->permLook) ||
        in_array(team::$my['pos'], $this->permPositionCheck))
    {
    }
    else
    {
      $arg['u']=team::$my['_id'];
    }
    return $this->get($c,$arg);
  }
  // รออนุมัติ
  public function approve($c=true)
  {
    //$arg=['status'=>3];
    $arg=['status'=>3];
    if (in_array(team::$my['grade'],[99,98,97]) ||
        in_array(team::$my['_id'], $this->permLook))
    {
    }
    else
    {
      $arg['u']=team::$my['_id'];
    }
    return $this->get($c,$arg);
  }
  // ไม่อนุมัติ
  public function disapprove($c=true)
  {
    //$arg=['status'=>2,'status3.uc'=>['$ne'=>0]];
    $arg=['status'=>4];
    if (in_array(team::$my['grade'],[99,98,97])||
        in_array(team::$my['_id'], $this->permLook))
    {
    }
    else
    {
      $arg['u']=team::$my['_id'];
    }
    return $this->get($c,$arg);
  }
  // รอจ่าย
  public function paid($c=true)
  {
    //$arg=['status'=>4,'status8.u'=>0];
    $arg=['status'=>5];
    if (in_array(team::$my['grade'],[99,97])||
        in_array(team::$my['_id'], $this->permPaidLook)||
        in_array(team::$my['_id'], $this->permLook))
    {
    }
    elseif (team::$my['grade'] == 98)
    {
      $arg['u']=team::$my['_id'];
    }
    else
    {
      $arg['u']=team::$my['_id'];
    }
    return $this->get($c,$arg);
  }

  public function pay($c=true)
  {
    //$arg=['status'=>5,'status8.u'=>0];
    $arg=['status'=>6];
    if (in_array(team::$my['grade'],[99,97]) ||
        in_array(team::$my['_id'], $this->permLook))
    {
    }
    elseif (team::$my['grade'] == 98)
    {
      $arg['u']=team::$my['_id'];
    }
    else
    {
      $arg['u']=team::$my['_id'];
    }
    return $this->get($c,$arg);
  }

  public function clear($c=true)
  {
    //$arg=['status'=>6,'status8.u'=>0];
    $arg=['status'=>7];
    if (in_array(team::$my['grade'],[99,97])||
        in_array(team::$my['_id'],$this->permLook)||
        in_array(team::$my['_id'],$this->permClearLook)||
        in_array(team::$my['pos'],$this->permPositionClearLook))
    {
    }
    elseif (team::$my['grade'] == 98)
    {
      $arg['u']=team::$my['_id'];
    }
    else
    {
      $arg['u']=team::$my['_id'];
    }
    return $this->get($c,$arg);
  }

  public function done($c=true)
  {
    //$arg=['status'=>7,'status8.u'=>0];
    $arg=['status'=>8];
    if (in_array(team::$my['grade'],[99,97])||
        in_array(team::$my['_id'], $this->permLook))
    {
    }
    elseif (team::$my['grade'] == 98)
    {
      $arg['u']=team::$my['_id'];
    }
    else
    {
      $arg['u']=team::$my['_id'];
    }
    return $this->get($c,$arg);
  }

  public function all($c=true)
  {
    //$arg=['status2.u'=>['$ne'=>0]];
    $arg=['status'=>['$gte'=>1]];
    if (in_array(team::$my['grade'],[99,97])||
        in_array(team::$my['_id'], $this->permLook))
    {
    }
    elseif (team::$my['grade'] == 98)
    {
      $arg['u']=team::$my['_id'];
    }
    else
    {
      $arg['u']=team::$my['_id'];
    }
    return $this->get($c,$arg);
  }

  public function get($c,$arg)
  {
    return $c?Load::DB()->count('team_withdraw',$arg):$arg;
  }
}
?>
