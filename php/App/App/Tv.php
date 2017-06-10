<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Tv extends Service
{
  public function get_tv()
  {
    $serv=[
      'get_apps'=>'get_apps',
      'list.last'=>'json_list_last',
      'list.cate'=>'json_list_cate',
      'episode'=>'json_episode',
      'episode.app'=>'json_episode_app',
      'part'=>'json_part',
      'cate'=>'json_cate',
    ];
    $this->{$serv[$_GET['json']]??'json_cate'}();
    exit;
  }

  public function json_cate()
  {
    $cate=[];
    $tmp=Load::DB()->find('tv_cate',[],['name_th'=>1,'id'=>1,'count'=>1],['sort'=>['id'=>1]]);
    for($i=0;$i<count($tmp);$i++)
    {
      $cate[]=['id'=>$tmp[$i]['id'],'t'=>$tmp[$i]['name_th'],'c'=>$tmp[$i]['count']];
    }

    $data=[
      'status'=>'ok',
      'mode'=>'cate',
      'pages'=>1,
      'content'=>$cate
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

  public function json_episode_app()
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $arg=['dd'=>['$exists'=>false],'content_season_id'=>intval($_GET['id'])];
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
    $option=['sort'=>['modified_date'=>-1],'limit'=>$count];

    $pages=1;
    $episode=[];
    $db=Load::DB();
    if($c=$db->count('tv_episode',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $tmp=$db->find('tv_episode',$arg,['name_th'=>1,'part_items_app'=>1,'date'=>1,'thumbnail'=>1],['sort'=>['modified_date'=>-1],'skip'=>$skip,'limit'=>$count]);
      $pages=ceil($c/$count);
      for($i=0;$i<count($tmp);$i++)
      {
        $p=[];
        for($j=0;$j<count($tmp[$i]['part_items_app']);$j++)
        {
          $s=$tmp[$i]['part_items_app'][$j];
          $p[]=['id'=>$s['id'],'t'=>$s['name_th'],'i'=>($s['cover']?$s['cover']:$s['thumbnail']),'l'=>$s['stream_url']];
        }
        $episode[]=['t'=>$tmp[$i]['name_th'],'d'=>Load::Time()->from($tmp[$i]['date'],'date'),'i'=>$tmp[$i]['thumbnail'],'p'=>$p];
      }
    }

    $data=[
                'status'=>'ok',
                'mode'=>'episode',
                'pages'=>$pages,
                'content'=>$episode
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

  public function json_episode()
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $arg=['dd'=>['$exists'=>false],'content_season_id'=>intval($_GET['id'])];
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
    $option=['sort'=>['modified_date'=>-1],'limit'=>$count];

    $pages=1;
    $episode=[];
    $db=Load::DB();
    if($c=$db->count('tv_episode',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $tmp=$db->find('tv_episode',$arg,['_id'=>1,'name_th'=>1,'part_items'=>1,'date'=>1,'thumbnail'=>1],['sort'=>['modified_date'=>-1],'skip'=>$skip,'limit'=>$count]);
      $pages=ceil($c/$count);
      for($i=0;$i<count($tmp);$i++)
      {
        $p=[];
        for($j=0;$j<count($tmp[$i]['part_items']);$j++)
        {
          $s=$tmp[$i]['part_items'][$j];
          $p[]=['t'=>$s['name_th'],'i'=>str_replace(['&lt;','&gt;','?auto=true','/v/73/'],['<','>','?auto=false','/v/76/'],$s['stream_url'])];
        }
        $episode[]=['id'=>$tmp[$i]['_id'],'t'=>$tmp[$i]['name_th'],'d'=>Load::Time()->from($tmp[$i]['date'],'date'),'i'=>$tmp[$i]['thumbnail'],'p'=>$p];
      }
    }

    $data=[
      'status'=>'ok',
      'mode'=>'episode',
      'pages'=>$pages,
      'content'=>$episode
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

  public function json_list_cate()
  {

    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $arg=['dd'=>['$exists'=>false],'cate_id'=>intval($_GET['id'])];
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
    $option=['sort'=>['modified_date'=>-1],'limit'=>$count];

    $pages=1;
    $list=[];
    $db=Load::DB();
    if($c=$db->count('tv_list',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $tmp=$db->find('tv_list',$arg,['name_th'=>1,'content_id'=>1,'content_season_id'=>1,'thumbnail'=>1,'modified_date'=>1],['sort'=>['modified_date'=>-1],'skip'=>$skip,'limit'=>$count]);
      $pages=ceil($c/$count);
      for($i=0;$i<count($tmp);$i++)
      {
        $list[]=['id'=>$tmp[$i]['content_season_id'],'t'=>$tmp[$i]['name_th'],'i'=>$tmp[$i]['thumbnail'],'d'=>Load::Time()->from($tmp[$i]['modified_date'],'date')];
      }
    }

    $data=[
      'status'=>'ok',
      'mode'=>'list.cate',
      'pages'=>$pages,
      'content'=>$list
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

  public function json_list_last()
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $arg=['dd'=>['$exists'=>false],'modified_date'=>['$lte'=>Load::Time()->now]];

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

    $pages=1;
    $list=[];
    $db=Load::DB();
    if($c=$db->count('tv_list',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $tmp=$db->find('tv_list',$arg,['name_th'=>1,'content_id'=>1,'content_season_id'=>1,'thumbnail'=>1,'modified_date'=>1],['sort'=>['modified_date'=>-1],'skip'=>$skip,'limit'=>$count]);
      $pages=ceil($c/$count);
      for($i=0;$i<count($tmp);$i++)
      {
        $list[]=['id'=>$tmp[$i]['content_season_id'],'t'=>$tmp[$i]['name_th'],'i'=>$tmp[$i]['thumbnail'],'d'=>Load::Time()->from($tmp[$i]['modified_date'],'date')];
      }
    }

    $data=[
      'status'=>'ok',
      'mode'=>'list.last',
      'pages'=>$pages,
      'content'=>$list
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

  public function json_part()
  {
    $arg=['dd'=>['$exists'=>false],'_id'=>intval($_GET['id'])];
    $pages=1;
    $db=Load::DB();
    $tmp=$db->findone('tv_episode',$arg,['_id'=>1,'name_th'=>1,'part_items'=>1,'date'=>1,'thumbnail'=>1]);

    $p=[];
    for($j=0;$j<count($tmp['part_items']);$j++)
    {
      $s=$tmp['part_items'][$j];
      $p[]=['t'=>$s['name_th'],'i'=>str_replace(['&lt;','&gt;','?auto=true','/v/73/'],['<','>','?auto=false','/v/76/'],$s['stream_url'])];
    }
    $episode=['id'=>$tmp['_id'],'t'=>$tmp['name_th'],'d'=>Load::Time()->from($tmp['date'],'date'),'i'=>$tmp['thumbnail'],'p'=>$p];
    $data=[
      'status'=>'ok',
      'mode'=>'part',
      'pages'=>$pages,
      'content'=>$episode
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
