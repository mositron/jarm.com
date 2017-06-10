<?php
namespace Jarm\App\Image;
use Jarm\Core\Load;

class Report extends Service
{
  public function get_report()
  {
    $db=Load::DB();
    if($f=$db->findone('image',['_id'=>intval(Load::$path[1])]))
    {
      Load::$core->assign('image',$f);
    }
    echo Load::$core->fetch('image/report');
    exit;
  }
}
?>
