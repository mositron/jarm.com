<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Article_Report
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
        Load::move('/article/report');
      }
    }
    else
    {
      $date=date('Y-m-d');
    }

    $dfrom=strtotime($date.' 00:00:00');
    $dto=strtotime($date.' 23:59:59');

    $u=[];

    Load::$core->data['title']='บทความ - รายงานการเขียนบทความ - '.Load::$core->data['title'];
    $user=Load::User();
    $article=$parent->find(['pl'=>['$in'=>[1,2]],'da'=>['$gte'=>Load::Time()->from($dfrom),'$lte'=>Load::Time()->from($dto)]],['wt'=>1],['limit'=>1000]);
    for($i=0;$i<count($article);$i++)
    {
      $n=$article[$i];
      $n['u']=intval($n['u']);
      if(!isset($u[$n['u']]))
      {
        $u[$n['u']]=[
          'profile'=>$user->get($n['u'],true),
          'article'=>[]
        ];
      }
      if(!is_array($n['c']))
      {
        $n['c']=[$n['c']];
      }
      $u[$n['u']]['article'][]=$n;
    }
//    print_r($article);
    return Load::$core
      ->assign('writer',$u)
      ->assign('article',$article)
      ->assign('dfrom',$dfrom)
      ->fetch('control/article.report');
  }
}
?>
