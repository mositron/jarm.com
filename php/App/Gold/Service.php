<?php
namespace Jarm\App\Gold;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'ราคาทอง ราคาทองคำวันนี้ ราคาทองล่าสุด ซื้อขายทอง ทองคำแท่ง ทองคำรูปพรรณ กราฟราคาทองคำ',
      'description'=>'ราคาทอง อัพเดทราคาทองล่าสุด อัพเดทราคาทองวันนี้ อัพเดทราคาซื้อขายทองวันนี้ล่าสุดที่ Jarm Gold',
      'keywords'=>'ทอง, ราคาทอง, ทองคำ, ทองรูปพรรณ, ทองคำแท่ง, ซื้อขายทอง, ราคาทองล่าสุด, ราคาทองวันนี้',
    ]);
  }

  public function get_home()
  {
    Load::$core->data['content']=Load::$core
      ->assign('msg',Load::DB()->findone('msg',['_id'=>'gold']))
      ->fetch('gold/home');
  }
}
?>
