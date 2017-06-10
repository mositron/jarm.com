<?php
namespace Jarm\App\Image;
use Jarm\Core\Load;

class Recent extends Service
{
  public function get_recent()
  {
    Load::$core->data['title'] = 'รูปภาพทั้งหมด - '.Load::$core->data['title'];
    Load::$core->data['description'] = 'รูปภาพทั้งหมด - '.Load::$core->data['description'];
    Load::$core->assign('image',Load::DB()->find('image',['dd'=>['$exists'=>false]],['_id'=>1,'ty'=>1,'fd'=>1,'f'=>1],['sort'=>['_id'=>-1],'limit'=>200]));
    Load::$core->data['content']=Load::$core->fetch('image/recent');
  }
}
?>
