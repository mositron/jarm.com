<?php
namespace Jarm\App\Out;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'ลิ้งค์ไปยังเว็บภายนอก',
      'description'=>'ลิ้งค์ไปยังเว็บภายนอก - สังคมออนไลน์ของคนไทย',
      'keywords'=>'ภายนอก',
    ]);
  }

  public function _home()
  {
    Load::$core->data['content'] = Load::$core->fetch('home');
  }
}
?>
