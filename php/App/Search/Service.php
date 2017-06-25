<?php
namespace Jarm\App\Search;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'ค้นหา ค้นหาข้อมูล ค้นหาข่าว ค้นหารูปภาพ ภายใน jarm.com',
      'description'=>'ค้นหาข้อมูล ค้นหาข่าว ค้นหารูปภาพ ค้นหากระทู้ ค้นหาบทความ ภายใน jarm.com',
      'keywords'=>'ค้นหา, ค้นหาข้อมูล, ค้นหารูปภาพ, ค้นหาข่าว, ค้นหากระทู้, jarm',
    ]);
  }

  public function _home()
  {
    return Load::$core->fetch('search/home');
  }
}
?>
