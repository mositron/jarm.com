<?php
namespace Jarm\App\Lotto;
use Jarm\Core\Load;

class Set extends Service
{
  public function get_set()
  {
    $db=Load::DB();
    $set=$db->find('lotto_set',[],[],['sort'=>['_id'=>-1],'limit'=>11]);
    $tm=Load::Time()->from($set[0]['tm'],'date');
    Load::$core->data['title'] = 'หวยหุ้น หวยหุ้นวันนี้ หวยหุ้นวันที่ '.$tm.' ห้วยหุ้นไทย สถิติหวยหุ้น';
    Load::$core->data['description'] = 'หวยหุ้น สถิติหวยหุ้น ตรวจหวยหุ้น  หวยหุ้นวันนี้ ตรวจหวยหุ้นย้อนหลัง ห้วยหุ้นไทย เลขเด็ดหวยหุ้น  อัพเดทรวดเร็ว';
    Load::$core->data['keywords'] = 'หวยหุ้น, หวย, ตรวจหวยหุ้น, สถิติหวยหุ้น, หวยหุ้นวันนี้, ห้วยหุ้นไทย';
    $index=$db->findone('msg',['_id'=>'lotto_set']);
    $topic=$db->find('forum',['c'=>['$in'=>[192]],'dd'=>['$exists'=>false]],['_id'=>1,'t'=>1,'ds'=>1,'ic'=>1,'u'=>1,'do'=>1,'cm.c'=>1,'cm.d'=>['$slice'=>-1],'da'=>1],['sort'=>['ds'=>-1],'limit'=>10],false);
    Load::$core->data['content']=Load::$core
      ->assign('set',$set)
      ->assign('index',$index)
      ->assign('topic',$topic)
      ->assign('user',Load::User())
      ->fetch('lotto/set');
  }
}
?>
