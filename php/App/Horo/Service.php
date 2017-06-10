<?php
namespace Jarm\App\Horo;
use Jarm\Core\Load;

class Service extends \Jarm\App\News\Service
{
  public function __construct()
  {
    $path=(Load::$path[0]??'');
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'ดูดวง ดูดวงรายวัน ดูดวงความรัก ทำนายฝัน ดูดวงวันเกิด ดูดวงไพ่ยิปซี ดูดวงเนื้อคู่ ดูดวงเบอร์โทรศัพท์  ดูดวงเบอร์มือถือ ทํานายความฝัน',
      'description'=>'ศูนย์รวมข้อมูล ดูดวง ดูดวงความรัก ดูดวงรายวัน ทำนายฝัน ดูดวงไพ่ยิปซี ดูดวงวันเกิด ดูดวงเนื้อคู่ ดูดวงเบอร์โทรศัพท์  ดูดวงเบอร์มือถือ หมอดู เปิดให้บริการฟรี.',
      'keywords'=>'ดูดวง, ดูดวงรายวัน, ดูดวงไพ่ยิปซี, ดูดวงเนื้อคู่, ดูดวงความรัก, ดูดวงวันเกิด, ดูดวงรายวัน, ดูดวงประจำวัน, ดูดวงเบอร์โทรศัพท์, ทํานายความฝัน',
      'nav-header'=>'<div><a href="/" title="ดูดวง">ดูดวง</a></div><i></i><ul>
      <li><a href="/cate/1" title="ดูดวงรายวัน"'.(URL=='/cate/1'?' class="active"':'').'> ดูดวงรายวัน</a></li>
      <li><a href="/cate/4" title="ดูดวงรายเดือน"'.(URL=='/cate/4'?' class="active"':'').'> ดูดวงรายเดือน</a></li>
      <li><a href="/cate/7" title="ดูดวงรายปี"'.(URL=='/cate/7'?' class="active"':'').'> ดูดวงรายปี</a></li>
      <li><a href="/cate/2" title="ดูดวงความรัก"'.(URL=='/cate/2'?' class="active"':'').'> ดูดวงความรัก</a></li>
      <li><a href="/cate/5" title="ทายนิสัย"'.(URL=='/cate/5'?' class="active"':'').'> ทายนิสัย</a></li>
      <li><a href="/cate/6" title="ทำนายฝัน"'.(URL=='/cate/6'?' class="active"':'').'> ทำนายฝัน</a></li>
      <li><a href="/phone" title="ดูดวงมือถือ"'.($path=='phone'?' class="active"':'').'> ดูดวงมือถือ</a></li>
      </ul>'
    ]);
  }
}
?>
