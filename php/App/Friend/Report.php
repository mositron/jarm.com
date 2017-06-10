<?php
namespace Jarm\App\Friend;
use Jarm\Core\Load;

class Report extends Service
{
  public function get_report()
  {
    $db=Load::DB();
    if(isset($_GET['delete']))
    {
      list($id,$code)=explode('.',$_GET['delete'],2);
      if($f=$db->findone('msn',['_id'=>intval($id),'dd'=>['$exists'=>false]]))
      {
        if($code==md5($f['_id'].Load::$conf['friend']['key_delete'].$f['em']))
        {
          $db->update('msn',['_id'=>$f['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
          Load::$core->delete('friend.jarm.com/home');
          Load::move('/?deleted');
        }
      }
      Load::move('/');
    }
    if($f=$db->findone('msn',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]]))
    {
      Load::$core->assign('friend',$f);
    }
    echo Load::$core->fetch('friend/report');
    exit;
  }
}
?>
