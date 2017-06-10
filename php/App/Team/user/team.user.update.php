<?php

if(!$user=$db->findone('team_user',['_id'=>intval(Load::$path[1])]))
{
  team::move('/user');
}

if(team::$my['_id']!=$user['_id'] && team::$my['grade']!=99)
{
  team::move('/user');
}

Load::Ajax()->register('updateuser');
if($_FILES)
{
  $photo=Load::Photo();
  if($f=$_FILES['avatar']['tmp_name'])
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
          Load::Upload()->post('f1','upload','@'.$f,['name'=>$user['_id'].'-s','type'=>'jpg','folder'=>'team/user','width'=>160,'height'=>160,'fix'=>'bothtop']);
          Load::Upload()->post('f1','upload','@'.$f,['name'=>$user['_id'],'type'=>'jpg','folder'=>'team/user','width'=>500,'height'=>500,'fix'=>'bothtop']);
          echo json_encode(['file'=>'https://f1.jarm.com/team/user/'.$user['_id'].'-s.jpg?'.time()]);
        }
    }
    exit;
  }
}

Load::$core->data['title']='แก้ไข - สมาชิก | '.Load::$core->data['title'];

Load::$core->data['content']=Load::$core->assign('user',$user)
                ->fetch('user.update');

function updateuser($par)
{
  $arg=[];
  $arg['nickname']=trim($par['nickname']);
  $arg['th']=['first'=>trim($par['th_first']),'last'=>trim($par['th_last'])];
  $arg['en']=['first'=>trim($par['en_first']),'last'=>trim($par['en_last'])];
  $arg['sex']=trim($par['sex']);
  $arg['birthday']=Load::Time()->from(trim($par['birthday']));
  $arg['id_card']=trim($par['id_card']);
  $arg['bank']=['name'=>trim($par['bank_name']),'id'=>trim($par['bank_id']),'number'=>trim($par['bank_number'])];
  $arg['line_id']=trim($par['line_id']);
  $arg['phone']=trim($par['phone']);
  $arg['address']=['current'=>trim($par['address_current']),'card'=>trim($par['address_current'])];
  $arg['ref']=['first'=>trim($par['ref_first']),'last'=>trim($par['ref_last']),'relationship'=>trim($par['ref_relationship']),'phone'=>trim($par['ref_phone'])];

  if (team::$my['grade']==99)
  {
    $arg['email']=trim($par['email']);
    $arg['work.start']=Load::Time()->from($par['work_start']);
    $arg['type']=intval($par['code_type']);
    $arg['team']=intval($par['team']);
    $arg['pos']=intval($par['position']);
    $arg['status']=intval($par['status']);

  }
  Load::DB()->update('team_user',['_id'=>intval(Load::$path[1])],['$set'=>$arg]);
  team::move('/user/update/'.Load::$path[1].'?completed');
}
?>
