<?php
namespace Jarm\App\Lotto;
use Jarm\Core\Load;

//define('HIDE_ADS',1);

class Service extends \Jarm\App\News\Service
{
  public function __construct()
  {
    $path=(Load::$path[0]?:'home');
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'หวย ตรวจหวย เลขเด็ด ตรวจสลากกินแบ่งรัฐบาล สลากกินแบ่ง หวยหุ้น ห้วยหุ้นไทย',
      'description'=>'หวย ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล หวยหุ้น ห้วยหุ้นไทย เลขเด็ด หวยเด็ด อัพเดทรวดเร็ว',
      'keywords'=>'ตรวจหวย, หวย, ตรวจสลากกินแบ่งรัฐบาล, ตรวจสลากกินแบ่ง, เลขเด็ด, หวยเด็ด, หวย, หวยหุ้น, ห้วยหุ้นไทย',
      'nav-header'=>'<ul>
      <li><a href="/" title="หวย ตรวจหวย ล็อตเตอร์รี่"'.($path=='home'?' class="active"':'').'>ตรวจหวย</a></li>
      <li><a href="/live" title="ถ่ายทอดหวย ตรวจหวยออนไลน์ ถ่ายทอดหวนออนไลน์"'.($path=='live'?' class="active"':'').'> ถ่ายทอดหวย</a></li>
      <li><a href="/list" title="ตรวจหวยย้อนหลัง"'.($path=='list'?' class="active"':'').'> ตรวจหวยย้อนหลัง</a></li>
      <li><a href="/set" title="หวยหุ้น หวยหุ้นไทย"'.($path=='set'?' class="active"':'').'> หวยหุ้น</a></li>
      <li><a href="/lucky" title="ข่าวหวย เลขเด็ดหวย เลขเด็ดหวยหุ้น"'.($path=='lucky'?' class="active"':'').'> เลขเด็ด</a></li>
      </ul>',
      'hide_adsense'=>true
    ]);
  }

  public function get_list()
  {
    $db=Load::DB();
    extract(Load::Split()->get('/list/',0,['page']));
    $_=['dd'=>['$exists'=>false],'pl'=>1];
    Load::$core->data['title']='ตรวจหวยย้อนหลัง'.($page>1?' หน้า '.$page:'').' - '.Load::$core->data['title'];
    Load::$core->data['description']=Load::$core->data['title'].', '.Load::$core->data['description'];
    if($count=$db->count('lotto',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation(48,$count,['/list','/page-'],$page);
      $lotto=$db->find('lotto',$_,['_id'=>1,'tm'=>1,'a1'=>1,'f3'=>1,'l3'=>1,'l2'=>1,'l'=>1],['sort'=>['tm'=>-1],'skip'=>$skip,'limit'=>48]);
    }
    return Load::$core
      ->assign('lotto',$lotto)
      ->assign('pager',$pg)
      ->fetch('lotto/list');
  }
}
?>
