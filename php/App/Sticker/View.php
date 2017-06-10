<?php
namespace Jarm\App\Sticker;
use Jarm\Core\Load;

class View extends Service
{
  public function get_view()
  {
    define('HIDE_SIDEBAR',1);
    if(!is_numeric(Load::$path[1]))
    {
      Load::move('/',true);
    }
    $db=Load::DB();
    if(!$app=$db->findOne('sticker',['_id'=>intval(Load::$path[1]),'pl'=>1,'dd'=>['$exists'=>false]]))
    {
      Load::move('/',true);
    }
    Load::$core->data['title'] = $app['t'].' - สติกเกอร์ไลน์ สติกเกอร์แชท Line Facebook ฟรี';
    Load::$core->data['description'] = $app['t'].' - ดาวน์โหลดสติกเกอร์ไลน์ สติกเกอร์แชท Line ฟรี';
    Load::$core->data['image']=Load::uri(['s3','/login/google']);

    Load::$core->data['content']=Load::$core
      ->assign('app',$app)
      ->assign('icon',$db->find('sticker_icon',['p'=>$app['_id'],'dd'=>['$exists'=>false]]))
      ->assign('user',Load::User()->get($app['u']))
      ->fetch('sticker/view');
  }
}
?>
