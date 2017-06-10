<?php
namespace Jarm\App\Image;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    $path=(Load::$path[0]??'');
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'ฝากรูป ฝากรูปฟรี ฝากรูปภาพฟรี ไม่ลบไม่ล่ม มี API ใช้งานผ่านเว็บอื่นได้ รวดเร็วทันใจกับ jarm',
      'description'=>'ฝากรูปภาพฟรีสูงสุดถึง 10MB ต่อรูปภาพ ไม่ลบ ไม่ล่ม มีระบบ API สำหรับเว็บมาสเตอร์ใช้งานผ่านเว็บอื่นได้ รวดเร็วทันใจพร้อมนำไปใช้งานได้ทันที',
      'keywords'=>'ฝากรูป, ฝากรูปภาพ, ฝากรูปฟรี, ฝากรูปภาพฟรี',
      'nav-header'=>'<div><a href="/" title="ฝากรูป">ฝากรูป</a></div><i></i><ul>
      <li><a href="/my" title="รูปภาพของคุณ"'.($path=='my'?' class="active"':'').'>รูปภาพของคุณ</a></li>
      <li><a href="/recent" title="รูปภาพทั้งหมด"'.($path=='recent'?' class="active"':'').'>รูปภาพทั้งหมด</a></li>
      <li><a href="/developer" title="นักพัฒนา"'.($path=='developer'?' class="active"':'').'>นักพัฒนา</a></li>
      </ul>'
    ]);
  }
}
?>
