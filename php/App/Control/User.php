<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class User extends Service
{
  public function _user()
  {
    if($this->check_perm('banner',7))
    {
      Load::Ajax()->register(['setadmin','setban'],$this);
    }
    $db=Load::DB();
    $arg = ['$or'=>[['am'=>['$gte'=>1]],['em'=>new \MongoDB\BSON\Regex("\@inet\-rev\.co\.th","i")]]];
    $admin=$db->find('user',$arg,['_id'=>1,'if.am'=>1,'am'=>1,'du'=>1,'em'=>1,'st'=>1],['sort'=>['am'=>-1,'du'=>-1]]);
    $active=[];
    $ban=[];
    for($i=0;$i<count($admin);$i++)
    {
      if($admin[$i]['st']==1||$admin[$i]['st']==0)
      {
        $active[]=$admin[$i];
      }
      else
      {
        $ban[]=$admin[$i];
      }
    }
    $admin=array_merge($active,$ban);
    return Load::$core
      ->assign('user',Load::User())
      ->assign('admin',$admin)
      ->fetch('control/user');
  }

  public function setadmin($a,$i)
  {
    $db=Load::DB();
    if(Load::$my['am']>=7)
    {
      $a=intval($a);
      $u=Load::User()->get($a,true);
      if(intval($u['am'])<7)
      {
        if($i)
        {
          $db->update('user',['_id'=>$a],['$set'=>['am'=>1,'st'=>1]]);
          Load::Ajax()->alert('เพิ่มสิทธิ์เรียบร้อยแล้ว');
        }
        else
        {
          $db->update('user',['_id'=>$a],['$unset'=>['am'=>1]]);
          Load::Ajax()->alert('ลดสิทธิ์เรียบร้อยแล้ว');
        }
        Load::User()->reset($a);
      }
    }
    Load::Ajax()->script('setTimeout(function(){window.location.href="/user";},2000);');
  }

  public function setban($a)
  {
    $db=Load::DB();
    if(Load::$my['am']>=7)
    {
      $a=intval($a);
      $u=Load::User()->get($a,true);
      if(intval($u['am'])<7)
      {
        $db->update('user',['_id'=>$a],['$unset'=>['am'=>1],'$set'=>['st'=>2]]);
        Load::Ajax()->alert('แบนเรียบร้อยแล้ว');
        Load::User()->reset($a);
      }
    }
    Load::Ajax()->script('setTimeout(function(){window.location.href="/user";},2000);');
  }
}
?>
