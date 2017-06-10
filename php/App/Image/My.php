<?php
namespace Jarm\App\Image;
use Jarm\Core\Load;

class My extends Service
{
  public function get_my()
  {
    Load::Session()->logged();
    Load::$core->data['title'] = 'รูปภาพของคุณ - '.Load::$core->data['title'];
    Load::$core->data['description'] = 'รูปภาพของคุณ - '.Load::$core->data['description'];
    Load::$core->assign('image',Load::DB()->find('image',['dd'=>['$exists'=>false],'u'=>Load::$my['_id']],['_id'=>1,'ty'=>1,'fd'=>1,'f'=>1,'u'=>1],['sort'=>['_id'=>-1],'limit'=>100]));
    Load::$core->data['content']=Load::$core->fetch('image/my');
  }
}
?>
