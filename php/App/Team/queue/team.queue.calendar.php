<?php


Load::$core->data['title']='ปฏิทินงาน | เบิกเงิน '.Load::$core->data['title'];

if(is_numeric(Load::$path[1]))
{
  if(!$queue=$db->findone('team_queue',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]]))
  {
    team::move('/queue');
  }
  if($queue['process']!='list_stock')
  {
    team::move('/queue');
  }
  Load::Ajax()->register(['getdata','updatequeue']);
  Load::$core->data['content']=Load::$core->assign('queue',$queue)
                  ->fetch('queue.calendar.insert');
}
else
{
  Load::Ajax()->register(['getdata']);
  Load::$core->data['content']=Load::$core->fetch('queue.calendar');
}

function getdata()
{
  $start=$_POST['start'];
  $end=$_POST['end'];
  $event_array=[];

  if(!$start)
  {
    $ds1=strtotime(date('Y-m').'-01');
  }
  else
  {
    $ds1=strtotime($start);
  }
  if(!$end)
  {
    $ds2=strtotime(date('Y-m-t').' 23:59:59');
  }
  else
  {
    $ds2=strtotime($end);
  }
  $event=Load::DB()->find('team_queue',['$or'=>[
                                          ['ds1'=>['$gte'=>Load::Time()->from($ds1),'$lte'=>Load::Time()->from($ds2)]],
                                          ['ds2'=>['$gte'=>Load::Time()->from($ds1),'$lte'=>Load::Time()->from($ds2)]],
                                          ['ds1'=>['$lte'=>Load::Time()->from($ds2)],'ds2'=>['$gte'=>Load::Time()->from($ds1)]]
                                        ]
                                      ]
                        );
  //echo $start.'-'.$end.'-';
  //print_r($event);
  $event_array=[];
  for($i=0;$i<count($event);$i++)
  {
    $e=$event[$i];
    $ev=[
          'ID'=>$e['_id'],
          'title'=>$e['name'],
          'start'=>($e['ds1']?date('Y-m-d',Load::Time()->sec($e['ds1'])):''),
          'end'=>($e['ds2']?date('Y-m-d',Load::Time()->sec($e['ds2'])):''),
          'url'=>'/queue/'.$e['_id'],
          'backgroundColor'=>'#ffffff',
          'borderColor'=>'#ffffff'
    ];
    $_c=[];
    for($j=0;$j<count($e['ref']);$j++)
    {
      if($e['ref'][$j])
      {
        $u=team::user()->get($e['ref'][$j],true);
        if($u['team']==1) // Photographer
        {
          $ev['backgroundColor']='#0c9348';
        }
        elseif($u['team']==3) // Production
        {
          $ev['backgroundColor']='#bd2132';
        }
        else // Content
        {
          $ev['backgroundColor']='#f2c347';
        }
        if(!isset($_c[$ev['backgroundColor']]))
        {
          $ev['borderColor']=$ev['backgroundColor'];
          $_c[$ev['backgroundColor']]=1;
          if(is_numeric(Load::$path[1])||
            empty(Load::$path[1])||
            (Load::$path[1]=='photographer'&&$u['team']==1)||
            (Load::$path[1]=='production'&&$u['team']==3)||
            (Load::$path[1]=='content'&&!in_array($u['team'],[1,3])))
          array_push($event_array,$ev);
        }
      }
    }
  }
  echo json_encode($event_array);
  exit;
  return '';
}

function updatequeue($par)
{
  global $queue;

  $arg=[];
  $arg['location']=trim($par['location']);
  $arg['province']=trim($par['province']);
  $ds=explode(' - ',trim($par['ds']),2);
  $arg['ds1']=Load::Time()->from(trim($ds[0]));
  $arg['ds2']=Load::Time()->from(trim($ds[1]));
  $arg['note_queue']=trim($par['note_queue']);
  $arg['process']='list_queue';
  $arg['pt.p']=intval($par['pt_p']);
  $arg['pd.p']=intval($par['pd_p']);
  $arg['gp.p']=intval($par['gp_p']);
  $arg['ct.p']=intval($par['ct_p']);
  if(!is_array($par['ref']))
  {
    if($par['ref'])
    {
      $par['ref']=[$par['ref']];
    }
    else
    {
      $par['ref']=[];
    }
  }
  $arg['ref']=array_values(array_filter(array_map('intval',(array)$par['ref'])));
  $arg['upq']=team::$my['_id'];
  $arg['dpq']=Load::Time()->now();

  Load::DB()->update('team_queue',['_id'=>$queue['_id']],['$set'=>$arg]);
  team::move('/queue/update/'.intval(Load::$path[1]).'?completed');
}

?>
