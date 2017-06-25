<?php
namespace Jarm\App\Tv;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    $path=(Load::$path[0]??'');
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'ทีวีย้อนหลัง',
      'description'=>'ทีวีย้อนหลัง',
      'keywords'=>'ทีวีย้อนหลัง, ดูทีวี',
      'nav-header'=>'<div><a href="/" title="ดูทีวีย้อนหลัง รายการย้อนหลัง">ทีวีย้อนหลัง</a></div><i></i><ul>
      <li><a href="/lakorn-on-air"'.($path=='lakorn-on-air'?' class="active"':'').'>ละครใหม่</a></li>
      <li><a href="/music-video"'.($path=='music-video'?' class="active"':'').'>มิวสิควิดีโอ</a></li>
      <li><a href="/variety"'.($path=='variety'?' class="active"':'').'>วาไรตี้</a></li>
      <li><a href="/cartoon"'.($path=='cartoon'?' class="active"':'').'>การ์ตูน</a></li>
      <li><a href="/news"'.($path=='news'?' class="active"':'').'>ข่าว</a></li>
      <li><a href="/series"'.($path=='series'?' class="active"':'').'>ซีรีย์</a></li>
      </ul>'
    ]);
  }

  public function get_cate()
  {
    $db=Load::DB();
    if($cate=$db->findone('tv_cate',['link'=>Load::$path[0]]))
    {
      Load::$core->data['title'] = $cate['name_th'].' - ดู'.$cate['name_th'].'ย้อนหลัง ดูทีวีย้อนหลัง';
      $list=$db->find('tv_list',['cate_id'=>$cate['id']],[],['sort'=>['modified_date'=>-1],'limit'=>40]);
      return Load::$core
        ->assign('cate',$cate)
        ->assign('list',$list)
        ->fetch('tv/cate');
    }
    else
    {
      return ['move'=>'/'];
    }
  }
}
?>
