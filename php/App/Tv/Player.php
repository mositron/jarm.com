<?php
namespace Jarm\App\Tv;
use Jarm\Core\Load;

class Player extends Service
{
  public function get_player()
  {
    $db=Load::DB();
    if($episode=$db->findone('tv_episode',['_id'=>intval(Load::$path[1])]))
    {
      $title = $episode['name_th'].' '.Load::Time()->from($episode['date'],'date');
      Load::$core->data['title'] = $title.' - ดู'.$episode['name_th'].'ย้อนหลัง ดูทีวีย้อนหลัง';
      Load::$core->data['image'] = $episode['cover'];
      $db->update('tv_episode',['_id'=>$episode['_id']],['$inc'=>['do'=>1]]);
      $list=$db->findone('tv_list',['content_season_id'=>$episode['content_season_id']]);
      return Load::$core
        ->assign('list',$list)
        ->assign('title',$title)
        ->assign('episode',$episode)
        ->fetch('tv/player');
    }
    else
    {
      return ['move'=>'/'];
    }
  }
}
?>
