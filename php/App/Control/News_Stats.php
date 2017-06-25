<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class News_Stats
{
  public function __construct()
  {
  }
  public function get($parent,$id)
  {
    $db=Load::DB();
    list($id,$sc)=explode('-',Load::$path[2],2);
    if(!$parent->news=$db->findone('news',['_id'=>intval($id),'dd'=>['$exists'=>false]]))
    {
      Load::move('/news');
    }
    if(!$parent->news['sc'])
    {
      $parent->news['sc']=substr(md5(rand(1,999999)),8,16);
      $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['sc'=>$parent->news['sc']]]);
    }

    if(!((Load::$my&&Load::$my['am']>=1)||$sc==$parent->news['sc']))
    {
      Load::move('/');
    }
    Load::Ajax()->register('addview');
    if(!$parent->news['sv'])
    {
      $parent->news['sv']='s3';
    }
    Load::$core->data['title']='Admin - สถิติ: '.$parent->news['t'];
    return Load::$core
      ->assign('news',$parent->news)
      ->assign('logs',$db->find('logs',['ty'=>'addview','news'=>$parent->news['_id']],[],['sort'=>['_id'=>-1],'limit'=>100]))
      ->fetch('control/news.stats');
  }
}
?>
