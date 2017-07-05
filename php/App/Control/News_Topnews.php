<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class News_Topnews
{
  public function __construct()
  {
  }
  public function get($parent,$id)
  {
    Load::Session()->logged();
    if(! Load::$my['am'])
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
        Load::move('/news/topnews');
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
    $news=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['da'=>['$gte'=>Load::Time()->from($dfrom),'$lte'=>Load::Time()->from($dto)]],['wt'=>1,'google'=>1,'do'=>1,'is'=>1],['sort'=>['do'=>-1]]);

    $tmp=[];
    for($i=0;$i<count($news);$i++)
    {
      $f=intval($news[$i]['is'])+intval($news[$i]['do']);
      $tmp[$i]=$f;
    }
    array_multisort($tmp,SORT_NUMERIC, SORT_DESC,$news);
    return Load::$core
      ->assign('user',$user)
      ->assign('news',$news)
      ->assign('dfrom',$dfrom)
      ->fetch('control/news.topnews');
  }
}
?>
