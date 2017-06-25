<?php
namespace Jarm\App\Lotto;
use Jarm\Core\Load;

class Home extends Service
{
  public function get_home($arg=[])
  {
    Load::cache();
    $db=Load::DB();
    $lotto_last=$db->findOne('lotto',['dd'=>['$exists'=>false]],[],['sort'=>['tm'=>-1],'limit'=>1]);
    $tm=Load::Time()->from($lotto_last['tm'],'date');
    Load::$core->data['title'] = 'หวย ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm.' สลากกินแบ่ง หวยหุ้น ห้วยหุ้นไทย';
    Load::$core->data['description'] = 'หวย ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm.' ตรวจหวยย้อนหลัง ตรวจสลากกินแบ่งรัฐบาล ย้อนหลัง  หวยหุ้น ห้วยหุ้นไทย เลขเด็ด หวยเด็ด อัพเดทรวดเร็ว';
    Load::$core->data['keywords'] = 'หวย, ตรวจหวย, ตรวจสลากกินแบ่งรัฐบาล, '.$tm.', '.str_replace(' ',', ',$tm).', ตรวจสลากกินแบ่ง, เลขเด็ด, หวยเด็ด, หวยหุ้น, ห้วยหุ้นไทย';
    Load::$core->data['rss']=Load::uri(['feed','/news-7-1/rss']);

    $lotto=$db->find('lotto',['dd'=>['$exists'=>false],'pl'=>1],[],['sort'=>['tm'=>-1],'limit'=>4]);
    $news=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['pl'=>1,'c'=>$arg['cate'],'cs'=>1],[],['limit'=>12]);

    $set=$db->find('lotto_set',[],[],['sort'=>['_id'=>-1],'limit'=>1]);
    $topic=$db->find('forum',['c'=>['$in'=>[5,191,192]],'dd'=>['$exists'=>false]],['_id'=>1,'t'=>1,'ds'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>['$slice'=>-1],'da'=>1],['sort'=>['ds'=>-1],'limit'=>10],false);


    return Load::$core
      ->assign('lotto_last',$lotto_last)
      ->assign('lotto',$lotto)
      ->assign('news',$news)
      ->assign('set',$set)
      ->assign('topic',$topic)
      ->assign('user',Load::User())
      ->fetch('lotto/home');
  }
}
?>
