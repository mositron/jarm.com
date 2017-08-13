<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Report extends Service
{
  public function _report()
  {
    Load::Session()->logged();
    if(!Load::$my['am'])
    {
      return Load::$core->fetch('control/permission');
    }
    $db=Load::DB();
    if(isset(Load::$path[1]))
    {
      if(preg_match('/^([0-9]{4})([0-9]{2})$/',Load::$path[1]))
      {
        $date=Load::$path[1];
      }
      else
      {
        Load::move('/report');
      }
    }
    else
    {
      $date=date('Ym');
    }

    Load::$core->data['title']='รายงานระบบข่าว - '.Load::$core->data['title'];
    $dfrom=intval($date.'00');
    $dto=intval($date.'99');
    $user=Load::User();
    $db=Load::DB();
    $admin=$db->find('user',['am'=>['$gte'=>1]],[],['sort'=>['_id'=>1]]);
    $view=$db->find('logs',['ty'=>'news','date'=>['$gte'=>$dfrom,'$lte'=>$dto]],[],['sort'=>['_id'=>1]]);
    return Load::$core
      ->assign('user',$user)
      ->assign('view',$view)
      ->assign('date',$date)
      ->assign('admin',$admin)
      ->fetch('control/report');
  }
}
?>
