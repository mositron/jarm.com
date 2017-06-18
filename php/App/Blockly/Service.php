<?php
namespace Jarm\App\Blockly;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'Blockly ฝึกเขียนโค๊ด เขียนโปรแกรม แบบลากวาง',
      'description'=>'Blockly ฝึกเขียนโค๊ด เขียนโปรแกรม แบบลากวาง สำหรับเด็กหรือผู้ริเริ่มหัดเขียนโค๊ดหรือโปรแกรม',
      'keywords'=>'blockly, เขียนโค๊ด, หัดเขียนโปรแกรม',
    ]);
  }

  public function get_home()
  {
    Load::$core->data['content']=Load::$core
      ->fetch('blockly/home');
  }
}
?>
