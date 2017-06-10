<?php
namespace Jarm\App\Sticker;
use Jarm\Core\Load;

class Fbimage extends Service
{
  public function get_fbimage()
  {
    define('HIDE_SIDEBAR',1);
    Load::Ajax()->register('visible');
    Load::$core->assign('getimage',$this->getimage());
    Load::$core->data['content']=Load::$core->fetch('fbimage');
  }

  public function getimage($page=1)
  {

    $rows = 100;
    $allorder = ['_id'=>'#','p'=>'รูปภาพ','t'=>'คำถาม','s'=>'สถานะ'];
    $allby=['desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง'];
    $all=['order','by','search','page'];

    extract(Load::Split()->get('/fbimage/',0,$all,$allorder,$allby));

    $arg = [];


    $db=Load::DB();
    if($count=$db->count('fbimage2',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation($rows,$count,[$url,'page-'],$page);
      $images=$db->find('fbimage2',$arg,[],['skip'=>$skip,'limit'=>$rows,'sort'=>[$order=>($by=='desc'?-1:1)]]);
    }


    Load::$core->assign(['images'=>$images,'pager'=>$pg,'count'=>number_format($count)]);
    for($i=0;$i<count($all);$i++)if(${$all[$i]}) Load::$core->assign($all[$i],${$all[$i]});
    return Load::$core->fetch('fbimage.list');
  }


  public function visible($i,$v=0)
  {
    $db=Load::DB();
    $arg=['_id'=>intval($i)];
    if($v)
    {
      $db->update('fbimage2',$arg,['$unset'=>['dd'=>1]]);
    }
    else
    {
      $db->update('fbimage2',$arg,['$set'=>['dd'=>Load::Time()->now()]]);
    }

    Load::Ajax()->jquery('#getimage','html',getimage());
  }
}
?>
