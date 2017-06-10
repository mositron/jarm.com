<?php
namespace Jarm\App\Weather;
use Jarm\Core\Load;

class Service extends \Jarm\App\News\Service
{
  public $cate;
  public $zone;
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'พยากรณ์อากาศ อากาศวันนี้ สภาพอากาศ พยากรณ์อากาศวันนี้ พยากรณ์อากาศพรุ่งนี้ ภาคเหนือ ภาคกลาง ภาคตะวันออก ภาคใต้ ภาคอีสาน และทุกจังหวัดในประเทศไทย',
      'description'=>'ศูนย์รวมข้อมูลพยากรณ์อากาศ อากาศวันนี้ สภาพอากาศ พยากรณ์อากาศวันนี้ พยากรณ์อากาศพรุ่งนี้ พยากรณ์อากาศภาคเหนือ พยากรณ์อากาศภาคกลาง พยากรณ์อากาศภาคตะวันออก พยากรณ์อากาศภาคใต้ พยากรณ์อากาศภาคอีสาน ครบทุกจังหวัดในประเทศไทย',
      'keywords'=>'พยากรณ์อากาศ, อากาศวันนี้, พยากรณ์อากาศวันนี้, พยากรณ์อากาศพรุ่งนี้, ภาคเหนือ, ภาคกลาง, ภาคตะวันออก, ภาคใต้, ภาคอีสาน, จังหวัด',
    ]);

    $clink=['forecast'=>1,'warning'=>2];
    $rlink=array_flip($clink);
    $this->cate=[
      1=>['t'=>'สภาพอากาศ','l'=>$rlink[1],'tt'=>'สภาพอากาศ อุณหภูมิ ข่าวสภาพอากาศ'],
      2=>['t'=>'เตือนภัย','l'=>$rlink[2],'tt'=>'เตือยภัย น้ำท่วม แผ่นดินไหว ฝนตกหนัก ข่าวเตือนภัย'],
    ];

    $this->zone=[
      1=>'ภาคเหนือ',
      2=>'ภาคตะวันออกเฉียงเหนือ (อีสาน)',
      3=>'ภาคกลาง',
      4=>'ภาคตะวันออก',
      5=>'ภาคใต้(ฝั่งตะวันออก)',
      6=>'ภาคใต้(ฝั่งตะวันตก)'
    ];
    Load::$core->assign('cate',$this->cate);
    Load::$core->assign('zone',$this->zone);
  }

  public function _home()
  {
    $db=Load::DB();
    $wt=$db->find('weather',[],['_id'=>1,'name'=>1,'zone'=>1,'today'=>1],['sort'=>['name'=>1]]);
    $weather=[1=>[],2=>[],3=>[],4=>[],5=>[],6=>[]];
    foreach($wt as $v)
    {
      $weather[$v['zone']][]=$v;
    }
    Load::$core->assign('weather',$weather);
    Load::$core->data['content']=Load::$core->fetch('weather/home');
  }

  public function get_place()
  {
    $db=Load::DB();
    if(!$weather=$db->findone('weather',['_id'=>intval(Load::$path[1])]))
    {
      Load::move('/',true);
    }
    Load::$core->data['title']='พยากรณ์อากาศ'.$weather['name'].' สภาพอากาศ'.$weather['name'].' - '.Load::$core->data['title'];
    Load::$core->data['description']='พยากรณ์อากาศ'.$weather['name'].' สภาพอากาศ'.$weather['name'].' - '.Load::$core->data['description'];

    Load::$core->assign('weather',$weather);
    Load::$core->data['content']=Load::$core->fetch('weather/place');
  }
}
?>
