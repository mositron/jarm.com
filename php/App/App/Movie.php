<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Movie extends Service
{
  public function get_movie()
  {
    $serv=[
      'get_news'=>'json_news',
      'get_news_view'=>'json_news_view',
      'get_now'=>'json_now',
      'get_soon'=>'json_soon',
      'get_movie'=>'json_movie',
      'get_apps'=>'get_apps',
    ];
    $this->{$serv[$_GET['json']]??'json_now'}();
    exit;
  }

  public function json_movie()
  {
    $db=Load::DB();
    if(!$movie=$db->findone('droid_movie',['_id'=>intval($_GET['id']),'dd'=>['$exists'=>false]]))
    {
      exit;
    }
    $movie['tm']=Load::Time()->from($movie['tm'],'date');
    $data=[
      'status'=>'ok',
      'content'=>$movie,
      'mode'=>'movie',
    ];

    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($data).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($data);
    }
  }

  public function json_news()
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];

    if($count<10)
    {
      $count=40;
    }
    elseif($count>100)
    {
      $count=100;
    }
    if($page<1)
    {
      $page=1;
    }

    $db=Load::DB();

    $_=['dd'=>['$exists'=>false],'pl'=>1,'c'=>5,'exl'=>0];

    $news=[];
    $pages=1;
    if($c=$db->count('news',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $tmp=(new \Jarm\App\News\Service(['ignore'=>1]))->find($_,[],['skip'=>$skip,'limit'=>$count]);

      for($i=0;$i<count($tmp);$i++)
      {
        $news[]=['id'=>$tmp[$i]['_id'],'title'=>$tmp[$i]['t'],'thumbnail'=>$tmp[$i]['img_s']];
      }

      if($orderby!='views')
      {
        $pages=ceil($c/$count);
      }
    }

    $data=[
      'status'=>'ok',
      'pages'=>$pages,
      'posts'=>$news
    ];

    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($data).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($data);
    }
  }

  public function json_news_view()
  {
    $db=Load::DB();
    if(!$news=$db->findone('news',['_id'=>intval($_GET['id']),'dd'=>['$exists'=>false],'pl'=>1],['_id'=>1,'t'=>1,'d'=>1]))
    {
      exit;
    }
    $data=[
      'status'=>'ok',
      'template'=>Load::$core->assign('news',$news)->fetch('app/movie.news.view')
    ];
    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($data).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($data);
    }
  }

  public function json_now()
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $sn=(string)$_GET['sn'];
    $ar=(string)$_GET['ar'];

    if($count<10)
    {
      $count=40;
    }
    elseif($count>100)
    {
      $count=100;
    }
    if($page<1)
    {
      $page=1;
    }

    $db=Load::DB();
    $sort=['tm'=>-1];
    $_=['dd'=>['$exists'=>false],'tm'=>['$lte'=>Load::Time()->now()],'pass'=>0,'en'=>['$exists'=>true]];
    $data=[];

    $movie=[];
    $pages=1;


    if($c=$db->count('droid_movie',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $tmp=$db->find('droid_movie',$_,['_id'=>1,'th'=>1,'en'=>1,'c'=>1,'tm'=>1,'fd'=>1,'in'=>1],['sort'=>$sort,'skip'=>$skip,'limit'=>$count]);
      for($i=0;$i<count($tmp);$i++)
      {
        $tmp[$i]['tm']=Load::Time()->from($tmp[$i]['tm'],'date');
        $movie[]=$tmp[$i];
      }
      $pages=ceil($c/$count);
    }

    $data=[
                'status'=>'ok',
                'pages'=>$pages,
                'posts'=>$movie,
    ];


    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($data).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($data);
    }
  }

  public function json_soon()
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $sn=(string)$_GET['sn'];
    $ar=(string)$_GET['ar'];

    if($count<10)
    {
      $count=40;
    }
    elseif($count>100)
    {
      $count=100;
    }
    if($page<1)
    {
      $page=1;
    }

    $db=Load::DB();
    $sort=['tm'=>1];
    $_=['dd'=>['$exists'=>false],'tm'=>['$gt'=>Load::Time()->now()],'en'=>['$exists'=>true]];
    $data=[];

    $movie=[];
    $pages=1;


    if($c=$db->count('droid_movie',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $tmp=$db->find('droid_movie',$_,['_id'=>1,'th'=>1,'en'=>1,'c'=>1,'tm'=>1,'fd'=>1,'in'=>1],['sort'=>$sort,'skip'=>$skip,'limit'=>$count]);
      for($i=0;$i<count($tmp);$i++)
      {
        $tmp[$i]['tm']=Load::Time()->from($tmp[$i]['tm'],'date');
        $movie[]=$tmp[$i];
      }
      $pages=ceil($c/$count);
    }

    $data=[
      'status'=>'ok',
      'pages'=>$pages,
      'posts'=>$movie,
    ];

    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($data).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($data);
    }
  }
}
?>
