<?php
namespace Jarm\App\Glitter;
use Jarm\Core\Load;

class Home extends Service
{
  public function get_home()
  {
    $db=Load::DB();
    $last=$db->find('glitter',['dd'=>['$exists'=>false]],['_id'=>1,'t'=>1,'sv'=>1,'fd'=>1,'ty'=>1],['sort'=>['_id'=>-1],'limit'=>52]);
    $rec=$db->find('glitter',['dd'=>['$exists'=>false]],['_id'=>1,'t'=>1,'sv'=>1,'fd'=>1,'ty'=>1],['sort'=>['rc'=>-1,'_id'=>-1],'limit'=>12]);
    return Load::$core
      ->assign('last',$last)
      ->assign('rec',$rec)
      ->fetch('glitter/home');
  }
}
?>
