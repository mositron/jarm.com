<?php
namespace Jarm\App\Guess;
use Jarm\Core\Load;

class Home extends Service
{
  public function get_home()
  {
    define('HIDE_REQUEST',1);
    $data=[];
    $db=Load::DB();
    $data['app']=$db->find('guess',['pl'=>1,'dd'=>['$exists'=>false]],['t'=>1,'d'=>1,'l'=>1,'fd'=>1,'p'=>1,'do'=>1,'u'=>1,'f'=>1],['sort'=>['do'=>1],'limit'=>30]);
    $data['appn']=$db->find('guess',['pl'=>1,'dd'=>['$exists'=>false]],['t'=>1,'d'=>1,'l'=>1,'fd'=>1,'p'=>1,'do'=>1,'u'=>1,'f'=>1],['sort'=>['_id'=>-1],'limit'=>21]);
    shuffle($data['app']);
    $data['app'] = array_slice($data['app'],0,6);
    return Load::$core
      ->assign('user',Load::User())
      ->assign('app',$data['app'])
      ->assign('appn',$data['appn'])
      ->fetch('guess/home');
  }
}
?>
