<?php
namespace Jarm\App\Www;
use Jarm\Core\Load;

class Home extends Service
{
  public function _home()
  {
    Load::cache();
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'จาม | ข่าว ข่าววันนี้ ข่าวบันเทิง ตรวจหวย ดูดวง เพลง รูปภาพ ผลบอล เนื้อเพลง ดูดวง หาเพื่อน ผู้หญิง เลสเบี้ยน เกย์',
      'description'=>'จาม.com |  สังคมออนไลน์ของคนไทยเต็มรูปแบบ พร้อมบริการ ข่าว เกมส์ อัลบั้ม รูปภาพ วิดีโอ หาเพื่อน ดูหนังออนไลน์ ลงประกาศฟรี และอื่นๆอีกมากมาย',
      'keywords'=>'จาม, jarm, ข่าว, ข่าววันนี้, ข่าวบันเทิง, ตรวจหวย, ดูดวง, เกมส์, เพลง, หนัง, รูปภาพ, เนื้อเพลง, ดูดวง, เกมส์, กลิตเตอร์, หาเพื่อน, ผู้หญิง, เลสเบี้ยน, เกย์, ฝากรูป, ผลบอล, ข่าวฟุตบอล, ผลบอลสด, วิเคราะห์บอล',
      'div_row'=>false,
    ]);

    $db=Load::DB();
    $_n=new \Jarm\App\News\Service(['ignore'=>1]);
    #news
    $news=[];
    $news[0]=$_n->findAll('news',12,['rc'=>['$gt'=>0],'c'=>['$ne'=>8]]);
    foreach([1=>10,2=>28/*,3=>8*/,4=>5,5=>3,6=>2] as $k=>$v)
    {
      $news[$k]=$_n->find(['c'=>$v],[],['limit'=>12]);
    }
    #weather
    $weather=[];
    $tmp=$db->find('weather',['_id'=>['$in'=>[38,2,18,55,77,75,33]]]);
    for($i=0;$i<count($tmp);$i++)
    {
      $weather[$tmp[$i]['_id']]=$tmp[$i];
    }
    #
    $fetch_ads=function($v){
      $u=['i'=>$v['_id'],'l'=>$v['l'],'t'=>time(),'p'=>Load::$app,'s'=>''];
      $d=strtr(base64_encode(json_encode($u)),'+/','-_');
      return 'https://jarm.com/ads/click/?__b='.urlencode($d);
    };
    $h1=$db->find('banner',['dd'=>['$exists'=>false],'ty'=>'home','pl'=>1,'p'=>'img'],[],['sort'=>['so'=>1,'_id'=>1],'limit'=>10]);
    for($i=0;$i<count($h1);$i++)
    {
        $h1[$i]['pr']=$fetch_ads($h1[$i]);
    }
    $h2=$db->find('banner',['dd'=>['$exists'=>false],'ty'=>'home','pl'=>1,'p'=>'bottom'],[],['sort'=>['so'=>1,'_id'=>1],'limit'=>12]);
    for($i=0;$i<count($h2);$i++)
    {
        $h2[$i]['pr']=$fetch_ads($h2[$i]);
    }
    return Load::$core
      ->assign('news',$news)
      ->assign('weather',$weather)
      ->assign('hbanner',['img'=>$h1,'bottom'=>$h2])
      ->assign('beauty',$_n->findAll('beauty',12,['c'=>27]))
      ->assign('car',$_n->findAll('car',10,['c'=>12]))
      ->assign('eat',$_n->findAll('eat',12,['c'=>32]))
      ->assign('ent',$_n->findAll('ent',12,['c'=>4]))
      ->assign('knowledge',$_n->findAll('knowledge',8,['c'=>30]))
      ->assign('korea',$_n->findAll('korea',12,['c'=>26]))
      ->assign('live',$_n->findAll('live',10,['c'=>35]))
      ->assign('tech',$_n->findAll('technology',11,['c'=>3]))
      ->assign('lotto_last',$db->find('lotto',['dd'=>['$exists'=>false],'pl'=>1],['tm'=>1,'a1'=>1,'l3'=>1,'l2'=>1],['sort'=>['tm'=>-1],'limit'=>1]))
      ->assign('lotto_all',$db->find('lotto',['dd'=>['$exists'=>false],'pl'=>1],['_id'=>1,'tm'=>1],['sort'=>['tm'=>-1],'limit'=>12]))
      ->assign('tv',$db->find('tv_list',['dd'=>['$exists'=>false],'modified_date'=>['$lte'=>Load::Time()->now()]],[],['sort'=>['modified_date'=>-1],'limit'=>8]))
      ->fetch('www/home');
  }
}
?>
