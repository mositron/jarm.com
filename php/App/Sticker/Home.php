<?php
namespace Jarm\App\Sticker;
use Jarm\Core\Load;

class Home extends Service
{
  public function get_home()
  {
    define('HIDE_REQUEST',1);
    $db=Load::DB();
    $sticker=$db->find('sticker',['pl'=>1,'dd'=>['$exists'=>false],'ref'=>'fb'],['t'=>1,'fd'=>1,'f'=>1,'img'=>1],['sort'=>['_id'=>-1],'limit'=>30]);
    return Load::$core
      ->assign('sticker',$sticker)
      ->fetch('sticker/home');
  }
}
?>
