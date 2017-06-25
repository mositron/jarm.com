<?php
namespace Jarm\App\Sticker;
use Jarm\Core\Load;

class Facebook extends Service
{
  public function get_facebook()
  {
    extract(Load::Split()->get('/facebook/',0,['page']));
    if(!$page || $page<1)
    {
      $page=1;
    }
    Load::$core->data['title'] = 'สติกเกอร์เฟสบุ๊ค Facebook Sticker '.($page>1?'หน้า '.$page.' ':'').'- ดาวน์โหลดสติกเกอร์ฟรี แจกสติกเกอร์ฟรี';
    Load::$core->data['description'] = 'สติกเกอร์เฟสบุ๊ค Facebook Sticker '.($page>1?'หน้า '.$page.' ':'').'- ดาวน์โหลดสติกเกอร์ฟรี แจกสติกเกอร์ฟรี Sticker Facebook ฟรี';
    Load::$core->data['keywords'] = 'facebook, sticker, สติกเกอร์, เฟสบุ๊ค';
    $db=Load::DB();
    $_=['pl'=>1,'ref'=>'fb','dd'=>['$exists'=>false]];
    if($count=$db->count('sticker',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation(100,$count,['/facebook/','page-'],$page);
      $sticker=$db->find('sticker',$_,['_id'=>1,'t'=>1,'fd'=>1],['sort'=>['_id'=>-1],'skip'=>$skip,'limit'=>100]);
    }
    return Load::$core
      ->assign('pager',$pg)
      ->assign('sticker',$sticker)
      ->fetch('sticker/facebook');
  }
}
?>
