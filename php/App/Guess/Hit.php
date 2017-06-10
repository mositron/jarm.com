<?php
namespace Jarm\App\Guess;
use Jarm\Core\Load;

class Hit extends Service
{
  public function get_hit()
  {
    define('HIDE_REQUEST',1);

    Load::$core->data['title'] = 'ยอดฮิต - เกมทายใจ เกมส์ทายใจ เกมวัดดวง เกมทายผล เกมตลก เกมฮาฮา';
    Load::$core->data['description'] = 'ยอดฮิต - เกมทายใจ เกมส์ทายใจ เกมส์วัดดวง เกมส์ทายผล เกมส์ตลก เกมส์ฮาฮา เกมส์เฟสบุ๊ค เกมfacebook';
    Load::$core->data['keywords'] = 'ยอดฮิต, เกมทายใจ, เกมส์ทายใจ, เกมทายผล, เกมตลก, เกมวัดดวง';

    $db=Load::DB();
    $count=$db->count('guess',['pl'=>1,'rc'=>1,'dd'=>['$exists'=>false]]);

    extract(Load::Split()->get('/hit/',0,['page']));
    list($pg,$skip)=Load::Pager()->navigation(100,$count,['/hit/','page-'],$page);

    $app=$db->find('guess',['pl'=>1,'dd'=>['$exists'=>false]],['t'=>1,'d'=>1,'l'=>1,'fd'=>1,'p'=>1,'do'=>1,'u'=>1,'f'=>1],['sort'=>['do'=>-1],'skip'=>$skip,'limit'=>100]);

    Load::$core->data['content']=Load::$core
      ->assign('pager',$pg)
      ->assign('user',Load::User())
      ->assign('app',$app)
      ->fetch('guess/hit');

  }
}
?>
