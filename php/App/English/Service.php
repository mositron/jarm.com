<?php
namespace Jarm\App\English;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'ฝึกภาษาอังกฤษ คำศัพท์ ประโยคภาษาอังกฤษ แปลไทยพร้อมเสียงอ่านและวิธีสะกดคำ',
      'description'=>'ฝึกภาษาอังกฤษ คำศัพท์ ประโยคภาษาอังกฤษ แปลไทยพร้อมเสียงอ่านและวิธีสะกดคำ โดย jarm.com',
      'keywords'=>'คำศัพท์, ฝึกภาษาอังกฤษ',
    ]);
  }

  public function get_home()
  {
    return Load::$core->fetch('english/home');
  }
}
?>
