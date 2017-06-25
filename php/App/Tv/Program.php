<?php
namespace Jarm\App\Tv;
use Jarm\Core\Load;

class Program extends Service
{
  public function get_program()
  {
    $db=Load::DB();
    if($list=$db->findone('tv_list',['_id'=>intval(Load::$path[1])]))
    {
      Load::$core->data['title'] = $list['name_th'].' - ดู'.$list['name_th'].'ย้อนหลัง ดูทีวีย้อนหลัง';
      Load::$core->data['image'] = $list['cover'];
      $db->update('tv_list',['_id'=>$list['_id']],['$inc'=>['do'=>1]]);
      $episode=$db->find('tv_episode',['content_season_id'=>$list['content_season_id']],[],['sort'=>['date'=>-1],'limit'=>100]);
      return Load::$core
        ->assign('list',$list)
        ->assign('episode',$episode)
        ->fetch('tv/program');
    }
    else
    {
      return ['move'=>'/'];
    }
  }
}
?>
