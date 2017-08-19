<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Lyric extends Service
{
  public function get_lyric()
  {
    $serv=[
      ''=>'json_home',
      'get_home'=>'json_home',
      'get_news'=>'json_news',
      'get_news_view'=>'json_news_view',
      'news-id'=>'json_news_view',
      'get_song'=>'json_song',
      'get_song_view'=>'json_song_view',
      'song-id'=>'json_song_view',
      'get_search'=>'json_search',
      'get_apps'=>'get_apps',
    ];
    $this->{$serv[$_GET['json']]?:'json_home'}();
    exit;
  }

  public function json_home()
  {
    $db=Load::DB();

    $music=$db->find('music',['dd'=>['$exists'=>false]],['_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'sn'=>1,'ar'=>1,'al'=>1,'yt'=>1,'da'=>1],['sort'=>['_id'=>-1],'limit'=>10]);
    $news=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['pl'=>1,'c'=>24,'exl'=>0],[],['limit'=>5]);
    $data=[
      'status'=>'ok',
      'pages'=>1,
      'content'=>['music'=>$music,'news'=>$news]
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

    $_=['dd'=>['$exists'=>false],'pl'=>1,'c'=>24,'exl'=>0];

    $news=[];
    $pages=1;
    if($c=$db->count('news',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $tmp=(new \Jarm\App\News\Service(['ignore'=>1]))->find($_,[],['skip'=>$skip,'limit'=>$count]);
      for($i=0;$i<count($tmp);$i++)
      {
        $news[]=['id'=>$tmp[$i]['_id'],'ds'=>Load::Time()->from($tmp[$i]['ds'],'date'),'title'=>$tmp[$i]['t'],'thumbnail'=>Load::uri([($tmp[$i]['sv']?:'f1'),'/news/'.$tmp[$i]['fd'].'/s.jpg'])];
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
    if(!$news=Load::DB()->findone('news',['_id'=>intval($_GET['id']),'dd'=>['$exists'=>false],'pl'=>1],['_id'=>1,'t'=>1,'d'=>1]))
    {
      exit;
    }
    $data=[
      'status'=>'ok',
      'template'=>Load::$core->assign('news',$news)->fetch('app/lyric.news.view')
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

  public function json_search()
  {
    $db=Load::DB();
    $_=['dd'=>['$exists'=>false]];
    if(!$q=trim(strval($_GET['q'])))
    {
      exit;
    }

    $ty=($_GET['ty']=='title'?'sn':'ar');
    $sort=[$ty=>1];
    $_[$ty]=new \MongoDB\BSON\Regex('^'.$q,'i');

    $tmp=$db->find('music',$_,['_id'=>1,'sn'=>1,'ar'=>1,'al'=>1],['sort'=>$sort,'skip'=>0,'limit'=>20]);

    for($i=0;$i<count($tmp);$i++)
    {
      $tmp[$i][$ty]=str_replace($q,'<span>'.$q.'</span>',$tmp[$i][$ty]);
      $music[]=['id'=>$tmp[$i]['_id'],'sn'=>$tmp[$i]['sn'],'ar'=>$tmp[$i]['ar'],'al'=>$tmp[$i]['al']];
    }

    $data=[
      'status'=>'ok',
      'mode'=>'search',
      'content'=>$music,
      'q'=>$q,
      'ty'=>$ty,
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

  public function json_song()
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $sn=(string)$_GET['sn'];
    $ar=(string)$_GET['ar'];

    if($count<10)
    {
      $count=100;
    }
    elseif($count>1000)
    {
      $count=100;
    }
    if($page<1)
    {
      $page=1;
    }

    $db=Load::DB();
    $sort=['_id'=>-1];
    $_=['dd'=>['$exists'=>false]];
    $data=[];
    if($sn)
    {
      $sort=['sn'=>1];
      $_['fc.sn']=$sn;
      $data['sn']=$sn;
    }
    elseif($ar)
    {
      $sort=['ar'=>1];
      $_['fc.ar']=$ar;
      $data['ar']=$ar;
    }


    $music=[];
    $pages=1;


    if($c=$db->count('music',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $tmp=$db->find('music',$_,['_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'sn'=>1,'ar'=>1,'al'=>1,'yt'=>1,'da'=>1],['sort'=>$sort,'skip'=>$skip,'limit'=>$count]);
      for($i=0;$i<count($tmp);$i++)
      {
        $music[]=['id'=>$tmp[$i]['_id'],'sn'=>$tmp[$i]['sn'],'ar'=>$tmp[$i]['ar'],'al'=>$tmp[$i]['al']];
      }

      if($orderby!='views')
      {
        $pages=ceil($c/$count);
      }
    }

    $data=[
      'status'=>'ok',
      'pages'=>$pages,
      'posts'=>$music,
      'data'=>$data,
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

  public function json_song_view()
  {
    $db=Load::DB();

    if(!$music=$db->findone('music',['_id'=>intval($_GET['id']),'dd'=>['$exists'=>false]]))
    {
      exit;
    }

    $music['sn2']=$music['sn'];
    $z=mb_strpos($music['sn'],'(',0,'utf-8');
    if($z>3)
    {
      $music['sn2']=trim(mb_substr($music['sn'],0,$z,'utf-8'));
    }
    require_once(ROOT.'modules/music/lyric/music.lyric.update.php');

    $music['ly']=nl2br($music['ly']);

    $relate=$db->find('music',['_id'=>['$ne'=>$music['_id']],'ar'=>$music['ar'],'al'=>$music['al'],'dd'=>['$exists'=>false]],['_id'=>1,'sn'=>1],['sort'=>['_id'=>-1],'limit'=>20]);

    $data=[
      'status'=>'ok',
      'template'=>Load::$core
        ->assign('music',$music)
        ->assign('relate',$relate)
        ->fetch('app/lyric.song.view')
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
