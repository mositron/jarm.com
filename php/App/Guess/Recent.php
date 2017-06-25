<?php
namespace Jarm\App\Guess;
use Jarm\Core\Load;

class Recent extends Service
{
  public function get_recent()
  {
    define('HIDE_REQUEST',1);
    Load::$core->data['title'] = 'มาใหม่ - เกมทายใจ เกมส์ทายใจ เกมวัดดวง เกมทายผล เกมตลก เกมฮาฮา';
    Load::$core->data['description'] = 'มาใหม่ - เกมทายใจ เกมส์ทายใจ เกมส์วัดดวง เกมส์ทายผล เกมส์ตลก เกมส์ฮาฮา เกมส์เฟสบุ๊ค เกมfacebook';
    Load::$core->data['keywords'] = 'มาใหม่, เกมทายใจ, เกมส์ทายใจ, เกมทายผล, เกมตลก, เกมวัดดวง';
    $db=Load::DB();
    $count=$db->count('guess',['pl'=>1,'dd'=>['$exists'=>false]]);
    extract(Load::Split()->get('/recent/',0,['page']));
    list($pg,$skip)=Load::Pager()->navigation(100,$count,['/recent/','page-'],$page);
    $app=$db->find('guess',['pl'=>1,'dd'=>['$exists'=>false]],['t'=>1,'d'=>1,'l'=>1,'fd'=>1,'p'=>1,'u'=>1,'do'=>1,'f'=>1],['sort'=>['_id'=>-1],'skip'=>$skip,'limit'=>100]);
    return Load::$core
      ->assign('pager',$pg)
      ->assign('user',Load::User())
      ->assign('app',$app)
      ->fetch('guess/recent');
  }
}
?>
