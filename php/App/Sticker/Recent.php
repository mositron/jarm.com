<?php
namespace Jarm\App\Sticker;
use Jarm\Core\Load;

class Recent extends Service
{
  public function get_recent()
  {
    extract(Load::Split()->get('/recent/',1,['page']));

    if(!$page || $page<1)
    {
      $page=1;
    }

    Load::$core->data['title'] = 'สติกเกอร์ล่าสุด สติกเกอร์มาใหม่ '.($page>1?'หน้า '.$page.' ':'').'- สติกเกอร์มาใหม่ สติกเกอร์ฟรีล่าสุด ดาวน์โหลดสติกเกอร์ล่าสุดฟรี';
    Load::$core->data['description'] = 'ล่าสุด สติกเกอร์ล่าสุด สติกเกอร์มาใหม่ '.($page>1?'หน้า '.$page.' ':'').'- สติกเกอร์มาใหม่ สติกเกอร์ฟรีล่าสุด ดาวน์โหลดสติกเกอร์ล่าสุดฟรี';
    Load::$core->data['keywords'] = 'facebook, sticker, สติกเกอร์, เฟสบุ๊ค';

    $db=Load::DB();
    $_=['pl'=>1,'dd'=>['$exists'=>false]];
    if($count=$db->count('sticker',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation(100,$count,['/recent/','page-'],$page);
      $sticker=$db->find('sticker',$_,['_id'=>1,'t'=>1,'fd'=>1],['sort'=>['_id'=>-1],'skip'=>$skip,'limit'=>100]);
    }

    Load::$core->data['content']=Load::$core
      ->assign('pager',$pg)
      ->assign('sticker',$sticker)
      ->fetch('sticker/recent');
  }
}
?>
