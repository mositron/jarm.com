<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class News_Topnews
{
  public function __construct($parent,$id)
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
    $news=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['da'=>['$gte'=>Load::Time()->from($dfrom),'$lte'=>Load::Time()->from($dto)]],['wt'=>1,'google'=>1],['sort'=>['do'=>-1]]);

    Load::$core->data['content']=Load::$core
      ->assign('user',$user)
      ->assign('news',$news)
      ->assign('dfrom',$dfrom)
      ->fetch('control/news.topnews');
  }
}
?>
