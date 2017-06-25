<?php
namespace Jarm\App\Lotto;
use Jarm\Core\Load;

class View extends Service
{
  public function get_view()
  {
    list($id,$link)=explode('-',Load::$path[1],2);
    $db=Load::DB();
    if(!$lotto=$db->findone('lotto',['_id'=>intval($id),'dd'=>['$exists'=>false],'pl'=>1]))
    {
      Load::move('/');
    }
    if(Load::$path[1]!=$lotto['_id'])
    {
      Load::move('/view/'.$lotto['_id'],true);
    }
    $last=$db->find('lotto',['dd'=>['$exists'=>false],'_id'=>['$ne'=>$lotto['_id']],'pl'=>1],['_id'=>1,'tm'=>1,'l'=>1,'l3'=>1,'a1'=>1,'l2'=>1],['sort'=>['tm'=>-1],'limit'=>3]);
    $tm=Load::Time()->from($lotto['tm'],'date');
    Load::$core->data['title'] = 'ตรวจหวยย้อนหลัง ตรวจสลากกินแบ่งรัฐบาลย้อนหลัง งวดที่ '.$tm;
    Load::$core->data['description'] = 'ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล ย้อนหลังงวดที่ '.$tm.'  ตรวจหวยย้อนหลัง ตรวจสลากกินแบ่งรัฐบาลย้อนหลัง อัพเดทรวดเร็ว';
    Load::$core->data['keywords'] = $tm.', ตรวจหวยย้อนหลัง, ตรวจสลากกินแบ่งย้อนหลัง, หวย, ตรวจสลากกินแบ่งรัฐบาล, '.$tm.', '.str_replace(' ',', ',$tm).', ตรวจสลากกินแบ่ง, หวยย้อนหลัง, เลขเด็ด, หวยเด็ด';
    return Load::$core
      ->assign('last',$last)
      ->assign('lotto',$lotto)
      ->fetch('lotto/view');
  }
}
?>
