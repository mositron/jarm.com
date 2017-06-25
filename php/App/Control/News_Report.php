<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class News_Report
{
  public function __construct()
  {
  }
  public function get($parent,$id)
  {
    if(!Load::$my['am'])
    {
      Load::move('/news');
    }
    $db=Load::DB();
    if(isset(Load::$path[2]))
    {
      if(preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/',Load::$path[2]))
      {
        $date=Load::$path[2];
      }
      else
      {
        Load::move('/news/report');
      }
    }
    else
    {
      $date=date('Y-m-d');
    }

    $dfrom=strtotime($date.' 00:00:00');
    $dto=strtotime($date.' 23:59:59');

    $u=[];

    $user=Load::User();
    $news=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['da'=>['$gte'=>Load::Time()->from($dfrom),'$lte'=>Load::Time()->from($dto)]],['wt'=>1],['limit'=>1000]);
    for($i=0;$i<count($news);$i++)
    {
      $n=$news[$i];
      $n['u']=intval($n['u']);
      if(!isset($u[$n['u']]))
      {
        $u[$n['u']]=[
          'profile'=>$user->get($n['u'],true),
          'news'=>[]
        ];
      }
      $u[$n['u']]['news'][]=$n;
    }
//    print_r($news);
    return Load::$core
      ->assign('writer',$u)
      ->assign('news',$news)
      ->assign('dfrom',$dfrom)
      ->fetch('control/news.report');
  }
}
?>
