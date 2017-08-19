<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Fbsticker extends Service
{
  public function get_fbsticker()
  {
    $serv=[
      ''=>'json_recent',
      'get_recent_posts'=>'json_recent',
      'get_category_posts'=>'json_category',
      'get_post'=>'json_view',
      'get_apps'=>'get_apps',
    ];
    $this->{$serv[$_GET['json']]?:'json_recent'}();
    exit;
  }

  public function json_recent()
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];

    $arg=['dd'=>['$exists'=>false],'pl'=>1,'ref'=>'fb'];

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

    $option=['sort'=>['_id'=>-1],'limit'=>$count,'skip'=>(($page-1)*$count)];

    $pages=1;
    $image=[];
    $db=Load::DB();
    if($c=$db->count('sticker',$arg))
    {
      $tmp=$db->find('sticker',$arg,['t'=>1,'fd'=>1,'do'=>1,'f'=>1],$option);
      for($i=0;$i<count($tmp);$i++)
      {
        $image[]=['id'=>$tmp[$i]['_id'],'title'=>$tmp[$i]['t'],'thumbnail'=>$tmp[$i]['fd']];
      }
      $pages=ceil($c/$count);
    }

    $data=[
      'status'=>'ok',
      'pages'=>$pages,
      'posts'=>$image
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

  public function json_category()
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $cate=(int)$_GET['category_id'];

    $arg=['dd'=>['$exists'=>false],'pl'=>1,'c'=>$cate,'ref'=>'fb'];

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

    $option=['sort'=>['_id'=>-1],'limit'=>$count,'skip'=>(($page-1)*$count)];

    $pages=1;
    $image=[];
    $db=Load::DB();
    if($c=$db->count('sticker',$arg))
    {
      $tmp=$db->find('sticker',$arg,['t'=>1,'fd'=>1,'do'=>1,'f'=>1],$option);


      for($i=0;$i<count($tmp);$i++)
      {
        $image[]=['id'=>$tmp[$i]['_id'],'title'=>$tmp[$i]['t'],'thumbnail'=>$tmp[$i]['fd']];
      }
      $pages=ceil($c/$count);
    }

    $data=[
                'status'=>'ok',
                'pages'=>$pages,
                'posts'=>$image
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

  public function json_view()
  {
    $id=(int)$_GET['post_id'];
    $db=Load::DB();
    if(!$sticker=$db->findOne('sticker',['_id'=>$id,'pl'=>1,'dd'=>['$exists'=>false]]))
    {
      exit;
    }
    $icon=$db->find('sticker_icon',['p'=>$sticker['_id'],'dd'=>['$exists'=>false]]);
    $post=['id'=>$sticker['_id'],'title'=>$sticker['t'],'type'=>'post','sticker'=>$icon];
    $data=[
      'status'=>'ok',
      'post'=>$post
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
    exit;
  }
}
?>
