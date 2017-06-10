<?php
$poem_delay = 600;
$tmp=[];
$found=false;
$foundbot=false;
$topuser=false;
$uadmin=[];
//$sadmin=[];
//$sadmin=[7,88,43416];
$nick=getnicks($chat->cache,$chat->room);

foreach($nick as $k=>$v)
{
  if($v['_id']==$chat->myid)
  {
    $found=true;
    $mynick=['_id'=>$chat->myid,'t'=>$chat->time2,'n'=>$chat->myname,'d'=>'','l'=>$chat->mylink,'i'=>$chat->myimg,'ip'=>$_SERVER['REMOTE_ADDR'],'mb'=>0,'am'=>0,'rk'=>0,'vid'=>$chat->vid];
    if(Load::$my['logged'])
    {
      $pb=$chat->time2-$v['t'];
      if($v['t'] && ($chat->time2>$v['t']) && ($pb < 90))
      {
        if(!$chat->data['last'])
        {
          $chat->data['last']=$chat->time2;
          $chat->save=true;
        }
        elseif($chat->data['last']<($chat->time2 - 300))
        {
          $_cu=0;
          $_cv=0;
          foreach($nick as $conline)
          {
            if($conline['mb'])
            {
              $_cu++;
            }
            else
            {
              $_cv++;
            }
          }
          $chat->data['last']=$chat->time2;
          Load::DB()->update('chatroom',['_id'=>$chat->room],array('$set'=>array('cu'=>$_cu,'cv'=>$_cv,'c'=>$_cu+$_cv,'du'=>Load::Time()->now())));
          $chat->save=true;
        }
        $du=Load::Time()->sec(Load::$my['du']);
        if(!$du)
        {
          $user->update(Load::$my['_id'],['$set'=>['du'=>Load::Time()->now()]]);
        }
        elseif($chat->time2 > $du+300)
        {
          if($chat->time2 < $du+420)
          {
            $exp=1;
            if(Load::$my['ci'])
            {
              $item=require_once(ROOT.'modules/chat/game/chat.game.item.config.php');
              if($item[Load::$my['ci']])
              {
                if(intval($item[Load::$my['ci']]['s'])>0)
                {
                  $exp=(100+intval($item[Load::$my['ci']]['s']))/100;
                }
              }
            }
            //$chat->mybux+=abs(floor((($chat->inner?EXP_RATE:1)*5)*$exp));
            $bux=abs(floor(5*$exp));
            $chat->mybux+=$bux;
            $user->bux($chat->myid,$bux,'list-online');
            Load::DB()->update('chatroom_online',array('u'=>Load::$my['_id'],'r'=>$chat->room,'m'=>date('n')),['$set'=>['n'=>Load::$my['name']],'$inc'=>['t'=>5]],['upsert'=>true]);
          }
          $user->update(Load::$my['_id'],array('$set'=>array('du'=>Load::Time()->now())));
        }
        if($chat->myadmin && isset($chat->data['admin'][Load::$my['_id']]))
        {
          $chat->data['admin'][Load::$my['_id']]['ds']=$chat->time2;
          $chat->saveadmin();
        }
      }
      $mynick=array_merge($mynick,array('d'=>$chat->myname,'l'=>$chat->mylink,'i'=>$chat->myimg,'mb'=>1,'am'=>$chat->myadmin,'bux'=>number_format($chat->mybux),'box'=>number_format($chat->mybox),'rk'=>$chat->myitem));
    }

    if(!isset($chat->data['bot'][$v['_id']]))
    {
      $v=$mynick;
    }
  }
  elseif($v['_id']==$chat->data['room']['vj'] && $chat->data['room']['vj']!='')
  {
    Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'vj','data'=>['u'=>$v['_id'],'s'=>$v['vid']]];
  }
  /*
  elseif($chat->room==1&&in_array($v['_id'],$sadmin))
  {
    $uadmin[$v['_id']]=1;
    if($v['t'] && ($chat->time2-$v['t'] > 60))
    {
      $au=Load::User()->get($v['_id'],true);
      if($chat->time2 > (Load::Time()->sec($au['du'])+300))
      {
        Load::DB()->update('chat_online',array('u'=>$au['_id'],'r'=>$chat->room,'m'=>date('n')),['$inc'=>['t'=>5]],['upsert'=>true]);
        Load::User()->update($au['_id'],array('$set'=>array('if.ch.du'=>Load::Time()->now())));
      }
      $v['t']=$chat->time2;
    }
  }
  */
  if(isset($chat->data['bot'][$v['_id']]))
  {
    $v['n']=$chat->data['bot'][$v['_id']]['n'];
    $v['i']=str_replace('http://','https://',$chat->data['bot'][$v['_id']]['i']);
    $v['l']=$chat->data['bot'][$v['_id']]['l'];
    $v['am']=intval($chat->data['admin'][$v['_id']]['lv']);
    $v['rk']=0;


    if(Load::$my['logged'] && $v['_id']==$chat->myid)
    {
      $v=$mynick;
    }
    $cbot=$chat->data['bot'][$v['_id']];
    if($cbot['ty']=='poem1'||$cbot['ty']=='poem2'||$cbot['ty']=='poem3'&&!$foundpoem)
    {
      if(!isset($v['ck']))
      {
        $v['ck']=rand(10,$poem_delay);
      }
      if($v['ck']+$poem_delay <= $chat->time2)
      {
        $v['ck']=$chat->time2;
        $pm=@file(__DIR__.'/'.$cbot['ty'].'.txt');
        if(!isset($v['ln']))
        {
          $v['ln']=rand(1,count($pm));
        }
        if($v['ln']>=count($pm))$v['ln']=0;
        if($ms=trim($pm[$v['ln']]))
        {
          $clbot=1;
          $ambot=0;
          if(isset($chat->data['admin'][$v['_id']]))
          {
            $ambot=$chat->data['admin'][$v['_id']]['lv'];
          }
          if($cbot['color'])
          {
            $clbot=$cbot['color'];
            if(is_array($cbot['color']))
            {
              $clbot=$cbot['color'];
              shuffle($clbot);
              $clbot=$clbot[0];
            }
          }
          $chat->inserttext(array('ty'=>'ms','u'=>$v['_id'],'m'=>$ms,'c'=>$clbot,'n'=>$v['n'],'l'=>$v['l'],'i'=>str_replace('http://','https://',$v['i']),'mb'=>1,'rk'=>$v['rk'],'am'=>$ambot));
        }
        $v['ln']++;
        $foundpoem=true;
      }
    }
    $v['t']=$chat->time2;
    $chat->data['bot'][$v['_id']]['found']=true;
    $foundbot++;
  }
  if($v['t']+120>=$chat->time2)
  {
    $tmp[$v['_id']]=$v;
  }
}

if(count($chat->data['wait']))
{
  $wait=[];
  $change=false;
  for($i=0;$i<count($chat->data['wait']);$i++)
  {
    if($chat->data['wait'][$i]['wt'] && $chat->data['wait'][$i]['wt']<=$chat->time2)
    {
      $change=true;
      $chat->inserttext($chat->data['wait'][$i]);
    }
    elseif($chat->data['wait'][$i]['wt'])
    {
      $wait[]=$chat->data['wait'][$i];
    }
  }
  if($change)
  {
    $chat->data['wait']=$wait;
    $chat->save=true;
  }
}


if(!$found)
{
  $tmp[$chat->myid]=['_id'=>$chat->myid,'t'=>$chat->time2,'l'=>$chat->mylink,'i'=>$chat->myimg,'n'=>$chat->myname,'d'=>'','ip'=>$_SERVER['REMOTE_ADDR'],'mb'=>0,'am'=>0,'bux'=>0,'box'=>0,'rk'=>$chat->myitem];
  if(Load::$my['logged'])
  {
    $tmp[$chat->myid]['mb']=1;
    $tmp[$chat->myid]['am']=$chat->myadmin;
    $tmp[$chat->myid]['bux']=number_format($chat->mybux);
    $tmp[$chat->myid]['box']=number_format($chat->mybox);
    if($chat->myadmin && isset($chat->data['admin'][Load::$my['_id']]))
    {
      $chat->data['admin'][Load::$my['_id']]['ds']=$chat->time2;
      $chat->saveadmin();
    }
  }
  $mynick=$tmp[$chat->myid];
}
/*
if($chat->room==1)
{
  foreach($sadmin as $l)
  {
    if(!$uadmin[$l])
    {
      $ua=Load::User()->get($l,true);
      $tmp[$l]=array('_id'=>$l,'t'=>$chat->time2,'l'=>'','i'=>$ua['img'],'n'=>$ua['name'],'d'=>'','ip'=>$ua['ip'],'mb'=>1,'am'=>0,'bux'=>0,'box'=>0,'rk'=>intval($ua['ci']));
      $tmp[$l]['l']=$ua['link'];
      $tmp[$l]['d']=$ua['name'];
      $tmp[$l]['mb']=1;
      $tmp[$l]['am']=9;
    }
  }
}
*/

if(is_array($chat->data['bot'])&&$foundbot<count($chat->data['bot']))
{
  foreach($chat->data['bot'] as $a=>$b)
  {
    if(!$chat->data['bot'][$a]['found'])
    {
      $tmp[$a]=array('_id'=>$a,'t'=>$chat->time2,'l'=>$b['l'],'i'=>str_replace('http://','https://',$b['i']),'n'=>$b['n'],'mb'=>1,'am'=>($chat->data['admin'][$a]?$chat->data['admin'][$a]['lv']:0),'d'=>'','rk'=>intval($b['rk']));
    }
  }
}
$chat->cache->set('ca2','chatbox_user_'.$chat->room,$tmp,false,3600*24);
Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'my','data'=>$mynick];
Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'list','data'=>$tmp];
Load::$core->data['content'][] = array('method'=>'chatbox','type'=>'video','data'=>(Load::$my['logged']?getvideokey():''));

$key='chat/room/'.$chat->room.'/topuser';
$cache=Load::$core;
if(!($topuser=$cache->get($key,300,true)))
{
  $topuser=Load::DB()->find('chatroom_online',array('r'=>$chat->room,'m'=>date('n')),[],['sort'=>['t'=>-1],'limit'=>10]);
  $cache->set($key,$topuser,true);
}
Load::$core->data['content'][] = ['method'=>'chatbox','type'=>'topuser','data'=>$topuser];

function getvideokey()
{
  $data=array('_id'=>Load::$my['_id'],'ip'=>$_SERVER['REMOTE_ADDR'],'time'=>time());
  $d = strtr(base64_encode(json_encode($data)), '+/', '-_');
  $s = strtr(base64_encode(hash_hmac('sha256', $d, Load::$conf['chat_key'].$data['_id'], true)), '+/', '-_');
  return $s.'.'.$d;
}
?>
