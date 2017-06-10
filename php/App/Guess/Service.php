<?php
namespace Jarm\App\Guess;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public $types;
  public $cate;
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'เกมทายใจ เกมส์ทายใจ เกมวัดดวง เกมทายผล เกมตลก เกมฮาฮา',
      'description'=>'เกมทายใจ เกมส์ทายใจ เกมส์วัดดวง เกมส์ทายผล เกมส์ตลก เกมส์ฮาฮา เกมส์เฟสบุ๊ค เกมfacebook',
      'keywords'=>'เกมทายใจ, เกมส์ทายใจ, เกมทายผล, เกมตลก, เกมวัดดวง',
    ]);

    $this->types=[
      'once'=>'มีคำตอบให้เลือก (ทำนายผล) - 1 คำถาม',
      //'multi'=>'มีคำตอบให้เลือก (ทำนายผล) - หลายคำถาม',
      'photo'=>'สุ่มรูปภาพเป็นคำตอบ',
    ];

    $this->cate=[
      1=>['t'=>'การ์ตูน'],
      2=>['t'=>'เกมส์'],
      3=>['t'=>'กีฬา'],
      4=>['t'=>'เพลง ละคร ภาพยนต์'],
      5=>['t'=>'บันเทิง ดารา นักร้อง'],
      6=>['t'=>'รถ ยานพาหนะ'],
      7=>['t'=>'กิจกรรม'],
      8=>['t'=>'ไลฟ์สไตล์'],
      9=>['t'=>'ความรัก'],
      10=>['t'=>'ตลก ขำขัน กวนๆ'],
      11=>['t'=>'ดวง ทำนาย พยากรณ์'],
      99=>['t'=>'อื่นๆ']
    ];

    Load::$core
      ->assign('types',$this->types)
      ->assign('cate',$this->cate);
  }

  public function get_category()
  {
    $c=explode('-',Load::$path[0]);
    if($c[0]=='cate'&&isset($this->cate[$c[1]]))
    {
      define('HIDE_REQUEST',1);

      extract(Load::Split()->get('/cate-'.$c[1],0,['page']));

      Load::$core->data['title'] = $this->cate[$c[1]]['t'].' - เกมทายใจ เกมส์ทายใจ เกมวัดดวง เกมทายผล เกมตลก เกมฮาฮา';
      Load::$core->data['description'] = $this->cate[$c[1]]['t'].' - เกมทายใจ เกมส์ทายใจ เกมส์วัดดวง เกมส์ทายผล เกมส์ตลก เกมส์ฮาฮา เกมส์เฟสบุ๊ค เกมfacebook';
      Load::$core->data['keywords'] = $this->cate[$c[1]]['t'].', เกมทายใจ, เกมส์ทายใจ, เกมทายผล, เกมตลก, เกมวัดดวง';

      $db=Load::DB();
      if($count=$db->count('guess',['pl'=>1,'c'=>intval($c[1]),'dd'=>['$exists'=>false]]))
      {
        list($pg,$skip)=Load::Pager()->navigation(100,$count,[$url,'page-'],$page);
        $app=$db->find('guess',['pl'=>1,'c'=>intval($c[1]),'dd'=>['$exists'=>false]],['t'=>1,'d'=>1,'l'=>1,'fd'=>1,'u'=>1,'p'=>1,'do'=>1,'f'=>1],['sort'=>['_id'=>-1],'skip'=>$skip,'limit'=>100]);
      }

      Load::$core->data['content']=Load::$core
        ->assign('c',$c[1])
        ->assign('pager',$pg)
        ->assign('user',Load::User())
        ->assign('app',$app)
        ->fetch('guess/category');
    }
    else
    {
      Load::move('/',true);
    }
  }
}
?>
