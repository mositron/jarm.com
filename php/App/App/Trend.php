<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Trend extends Service
{
  public function get_trend()
  {
    $serv=[
      ''=>'json_recent',
      'get_recent_posts'=>'json_recent',
      //'get_category_posts'=>'category',
      'get_news'=>'json_news',
      'get_recommend'=>'json_recommend',
      'get_apps'=>'get_apps',
    ];
    $this->{$serv[$_GET['json']]??'json_recent'}();
    exit;
  }

  public function json_recent()
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];

    $arg=['dd'=>['$exists'=>false],'pl'=>1];

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

    $option=['sort'=>['date'=>-1,'time'=>-1],'limit'=>$count,'skip'=>(($page-1)*$count)];

    $pages=1;
    $image=[];
    $db=Load::DB();
    if($c=$db->count('trend_key',$arg))
    {
      $tmp=$db->find('trend_key',$arg,[],$option);
      for($i=0;$i<count($tmp);$i++)
      {
        $image[]=['id'=>$tmp[$i]['_id'],'title'=>$tmp[$i]['key'],'thumbnail'=>'http:'.$tmp[$i]['img'],
        'detail'=>'ค้นหา '.number_format($tmp[$i]['count']).'+ ครั้ง, '.$this->_get_time($tmp[$i]['date'])];
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

  public function _getfile($i)
  {
    return str_replace(['_s.png','_s.jpg'],['_o.png','_o.jpg'],$i);
  }

  public function _get_time($t)
  {
    return Load::Time()->from($t,'date');
  }

  public function json_news()
  {
    $id=(int)$_GET['id'];

    $db=Load::DB();
    if(!$trend=$db->findOne('trend_key',['_id'=>$id]))
    {
      exit;
    }

    $data=[
      'status'=>'ok',
      'news'=>$this->json_trend_news($trend['lkey'],$trend['desc'],50)
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
  public function json_recommend()
  {
    $news=[];
    $db=Load::DB();
    $tmp=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['pl'=>1,'ds'=>['$gte'=>Load::Time()->now(-3600*24)]],[],['sort'=>['do'=>-1],'limit'=>20]);
    for($i=0;$i<count($tmp);$i++)
    {
      $news[]=[
        'title'=>$tmp[$i]['t'],
        'image'=>'http://'.$tmp[$i]['sv'].'.jarm.com/news/'.$tmp[$i]['fd'].'/s.jpg',
        'url'=>$tmp[$i]['link'],
        'detail'=>'ข่าว'.Load::$conf['news'][$tmp[$i]['c']]['t'].', อ่าน '.number_format(intval($tmp[$i]['do'])).' ครั้ง',
      ];
    }
    $data=[
      'status'=>'ok',
      'news'=>$news
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

  public function json_trend_news($key,$relate='',$limit=8)
  {
    $db=Load::DB();
    $news=[];
    if(count($news)<=$limit)
    {
      if($tmp=$db->find('trend_news',['key'=>$key],[],['sort'=>['order'=>-1,'du'=>-1],'limit'=>$limit-count($news)]))
      {
        $news = array_merge($news, $tmp);
      }
    }
    return $news;
  }
  public function json_proxy_image($domain,$image)
  {
    if($domain=='jarm.com'||$domain=='facebook.com')
    {
      return $image;
    }
    elseif($image)
    {
      return 'https://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?url='.urlencode($image).'&resize_w=200&container=focus&refresh=3600000';
    }
    else
    {
      return '';
    }
  }
}
?>
