<?php

Load::Ajax()->register('delreport');

Load::$core->data['title']=$status_name[$page].' - เบิกเงิน | '.Load::$core->data['title'];

$arg = (new Advance())->$page(false);

$sort=['da'=>-1];
if(is_numeric($arg['status']))
{
  $sort=['status'.$arg['status'].'.d'=>-1];
}

$withdraw=$db->find('team_withdraw',$arg,[],['sort'=>$sort]);

Load::$core->data['content']=Load::$core->assign('withdraw',$withdraw)
                ->assign('page',$page)
                ->fetch('withdraw.'.$page);


function delreport($i)
{
  $arg=['_id'=>intval($i),'u'=>team::$my['_id']];
  if(team::$my['grade']==99)
  {
    unset($arg['u']);
  }
  Load::DB()->update('team_withdraw',$arg,['$set'=>['dd'=>Load::Time()->now()]]);
  team::move(URL);
}

?>
