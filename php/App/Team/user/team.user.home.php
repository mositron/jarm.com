<?php
Load::$core->data['title']='สมาชิก | '.Load::$core->data['title'];

Load::Ajax()->register('newuser');

$_=['status'=>1];
if(Load::$path[0]=='jarm')
{
  $_['code']=['$gt'=>100,'$lte'=>500];
}
elseif(Load::$path[0]=='racing')
{
  $_['code']=['$gt'=>500,'$lte'=>900];
}

if(team::$my['grade']==99)
{
  unset($_['status']);
}
$user=$db->find('team_user',$_,[],['sort'=>['code'=>1]]);

Load::$core->data['content']=Load::$core->assign('user',$user)
                ->fetch('user.home');

function newuser($par)
{
  if(team::$my['grade']==99)
  {
    $arg=[];
    $arg['status']=0;
    $arg['type']=intval($par['code_type']);
    $arg['team']=intval($par['team']);
    $arg['pos']=intval($par['position']);
    $arg['nickname']=$par['nickname'];
    $arg['txt']=$par['work_start_year'].'-'.substr('00'.$par['work_start_month'],-2).'-'.substr('00'.$par['work_start_day'],-2);
    $arg['work']=['start'=>Load::Time()->from($par['work_start_year'].'-'.substr('00'.$par['work_start_month'],-2).'-'.substr('00'.$par['work_start_day'],-2))];
    $arg['phone']=$par['phone'];

    $c=901;
    if($arg['type']==1)
    {
      $c=101;
    }
    elseif($arg['type']==2)
    {
      $c=501;
    }
    elseif($arg['type']==3)
    {
      $c=301;
    }
    elseif($arg['type']==4)
    {
      $c=701;
    }
    $db=Load::DB();
    if($max=$db->find('team_user',['type'=>$arg['type']],['code'=>1],['sort'=>['code'=>-1],'limit'=>1]))
    {
      $c=$max[0]['code']+1;
    }
    $arg['code']=$c;
    $id=$db->insert('team_user',$arg);
    //Load::Ajax()->alert('/user/update/'.$id.'?added');
    team::move('/user/update/'.$id.'?added');
  }
}
?>
