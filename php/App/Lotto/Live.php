<?php
namespace Jarm\App\Lotto;
use Jarm\Core\Load;

class Live extends Service
{
  public function get_live()
  {
    $lotto=Load::DB()->find('lotto',['dd'=>['$exists'=>false],'pl'=>1],[],['sort'=>['tm'=>-1],'limit'=>1]);
    $tm=Load::Time()->from($lotto[0]['tm'],'date');
    Load::$core->data['title'] = 'ถ่ายทอดหวย ตรวจหวยออนไลน์ ถ่ายทอดสดหวย ถ่ายทอดผลหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm;
    Load::$core->data['description'] = 'ถ่ายทอดหวย, ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm.' เลขเด็ด หวยเด็ด อัพเดทรวดเร็ว';
    Load::$core->data['keywords'] = 'ถ่ายทอด, ตรวจหวย, หวย, ตรวจสลากกินแบ่งรัฐบาล, '.$tm.', '.str_replace(' ',', ',$tm).', ตรวจสลากกินแบ่ง, เลขเด็ด, หวยเด็ด';
    return Load::$core->fetch('lotto/live');
  }
}
?>
