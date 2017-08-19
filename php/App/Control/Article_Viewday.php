<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Article_Viewday
{
  public function __construct()
  {
  }
  public function get($parent,$id)
  {
    $db=Load::DB();
    if(isset(Load::$path[2]))
    {
      if(preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/',Load::$path[2]))
      {
        $date=Load::$path[2];
      }
      else
      {
        Load::move('/article/view-day');
      }
    }
    else
    {
      $date=date('Y-m-d');
    }

    $dfrom=strtotime($date.' 00:00:00');
    $dto=strtotime($date.' 23:59:59');

    $u=[];

    Load::$core->data['title']='อ่านบทความประจำวัน - '.Load::$core->data['title'];
    $user=Load::User();
    $article=$parent->find(['da'=>['$gte'=>Load::Time()->from($dfrom),'$lte'=>Load::Time()->from($dto)]],['wt'=>1,'google'=>1,'do'=>1,'is'=>1],['sort'=>['do'=>-1]]);

    $tmp=[];
    for($i=0;$i<count($article);$i++)
    {
      $f=intval($article[$i]['is'])+intval($article[$i]['do']);
      $tmp[$i]=$f;
    }
    array_multisort($tmp,SORT_NUMERIC, SORT_DESC,$article);
    return Load::$core
      ->assign('user',$user)
      ->assign('article',$article)
      ->assign('dfrom',$dfrom)
      ->fetch('control/article.view-day');
  }
}
?>
