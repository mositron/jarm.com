<?php

Load::Ajax()->register('newwithdraw');

Load::$core->data['title']='เพิ่ม - เบิกเงิน | '.Load::$core->data['title'];

Load::$core->data['content']=Load::$core->fetch('withdraw.insert');

function newwithdraw($par)
{
  $arg=[];
  $arg['form']=intval($par['form']);
  $arg['type']=intval($par['type']);
  $arg['product']=intval($par['product']);
  $arg['team']=intval($par['team']);
  if($arg['form']&&$arg['type']&&$arg['team'])
  {
    //$arg['product']&&
    if($arg['type']!=1 || $arg['product'])
    {
      $arg['remark']=stripslashes(trim($par['remark']));
      //$arg['dp']=Load::Time()->from($par['time']);
      $arg['u']=team::$my['_id'];
      $arg['ue']=team::$my['_id'];
      $arg['de']=Load::Time()->now();

      $arg['status']=0;
      $arg['status2']=['u'=>0,'ur'=>0,'uru'=>0];
      $arg['status3']=['u'=>0,'uc'=>0,'ucu'=>0];
      $arg['status4']=['u'=>0,'uc'=>0];
      $arg['status5']=['u'=>0];
      $arg['status6']=['u'=>0,'uc'=>0];
      $arg['status7']=['u'=>0];
      $arg['status8']=['u'=>0];

      $id=Load::DB()->insert('team_withdraw',$arg);
      team::move('/withdraw/update/'.$id.'?completed');
      return;
    }
  }
  Load::Ajax()->alert('กรุณาเลือกข้อมูลให้ครบถ้วน');
}
?>
