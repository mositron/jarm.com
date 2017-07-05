<?php
namespace Jarm\App\Story;
use Jarm\Core\Load;

class Home extends Service
{
  public function _home()
  {

    $db=Load::DB();
    $post=$db->find('story_post',['dd'=>['$exists'=>false],'pl'=>1],[],['sort'=>['ds'=>-1],'limit'=>20]);
    return Load::$core
      ->assign('post',$post)
      ->assign('user',Load::User())
      ->fetch('story/home');
  }
}
?>
