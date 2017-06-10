<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Lotto extends Service
{
  public function get_lotto()
  {
    $serv=[
      ''=>'json_home',
      'lottery'=>'json_lottery',
      'lottery-last'=>'json_lottery_last',
      'set'=>'json_set',
      'news'=>'json_news',
    ];

    $serv2=[
      'lottery'=>'json_lottery_home',
      'lottery-id'=>'json_lottery_view',
      'lottery-last'=>'json_lottery_last',
      'set'=>'json_set',
      'news'=>'json_news_home',
      'news-id'=>'json_news_view',
      'get_apps'=>'get_apps',
    ];

    if(isset($_GET['json'])&&isset($serv2[$_GET['json']]))
    {
      define('A_JSON',1);
      $this->{$serv2[$_GET['json']]}();
    }
    elseif(isset($serv[Load::$path[1]]))
    {
      if(in_array(Load::$path[1],['lottery','news']))
      {
        if(is_numeric(Load::$path[2]))
        {
          $this->{'json_'.Load::$path[1].'_view'}();
        }
        else
        {
          $this->{'json_'.Load::$path[1].'_home'}();
        }
      }
      else
      {
        $this->{$serv[Load::$path[1]]}();
      }
    }
    else
    {
      $this->home();
    }
  }

  public function json_home()
  {
    $db=Load::DB();
    $lottery=$db->find('lotto',['dd'=>['$exists'=>false],'pl'=>1],['tm'=>1],['sort'=>['tm'=>-1],'limit'=>1]);
    $news=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['pl'=>1,'c'=>22],[],['limit'=>1]);
    $set=$db->find('lotto_set',[],['da'=>1],['sort'=>['_id'=>-1],'limit'=>1]);

    Load::$core->data['content']=Load::$core->assign('news',$news[0])
                    ->assign('lottery',$lottery[0])
                    ->assign('set',$set[0])
                    ->fetch('app/lotto.home');
  }

  public function json_lottery_last()
  {
    $cache=Load::$core;
    $key='app/lotto/lottery-last';
    #
    #if(!($lotto=$cache->get($key,300,true)))
    #{
      $db=Load::DB();
      $tmp=$db->find('lotto',['dd'=>['$exists'=>false],'pl'=>1],['_id'=>1,'tm'=>1,'a1'=>1,'f3'=>1,'l3'=>1,'l2'=>1,'l'=>1,'a2'=>1,'a3'=>1,'a4'=>1,'a5'=>1],['sort'=>['tm'=>-1],'limit'=>1]);
      $lotto=$tmp[0];
      $lotto['tm']=Load::Time()->from($lotto['tm'],'date');
    #  $cache->set($key,$lotto,true);
    #}

    if(defined('A_JSON'))
    {
      $data=[
                  'status'=>'ok',
                  'pages'=>1,
                  'content'=>$lotto
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
    else {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($lotto).');';
    }
    exit;
  }

  public function json_lottery_home()
  {
    $db=Load::DB();
    $lotto=$db->find('lotto',['dd'=>['$exists'=>false],'pl'=>1],['_id'=>1,'tm'=>1,'a1'=>1,'f3'=>1,'l3'=>1,'l2'=>1,'l'=>1,'a2'=>1,'a3'=>1,'a4'=>1,'a5'=>1],['sort'=>['tm'=>-1],'limit'=>24]);
    for($i=0;$i<count($lotto);$i++)
    {
      $lotto[$i]['tm']=Load::Time()->from($lotto[$i]['tm'],'date');
    }
    if(defined('A_JSON'))
    {
      $data=[
                  'status'=>'ok',
                  'pages'=>1,
                  'mode'=>'list',
                  'content'=>$lotto
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
    else {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($lotto).');';
    }
    exit;
  }

  public function json_lottery_view()
  {
    $db=Load::DB();

    if(defined('A_JSON'))
    {
      if(!$lotto=$db->findone('lotto',['_id'=>intval($_GET['id']),'dd'=>['$exists'=>false],'pl'=>1]))
      {
        exit;
      }
      $lotto['tm']=Load::Time()->from($lotto['tm'],'date');
      $data=[
        'status'=>'ok',
        'pages'=>1,
        'mode'=>'view',
        'content'=>$lotto
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
    else {
      if(!$lotto=$db->findone('lotto',['_id'=>intval(Load::$path[2]),'dd'=>['$exists'=>false],'pl'=>1]))
      {
        exit;
      }
      $lotto['tm']=Load::Time()->from($lotto['tm'],'date');
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($lotto).');';
    }
  }

  public function json_news_home()
  {
    $db=Load::DB();
    $news=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['pl'=>1,'c'=>22,'exl'=>0],[],['limit'=>30]);
    for($i=0;$i<count($news);$i++)
    {
      $news[$i]['ds']=Load::Time()->from($news[$i]['ds'],'date');
    }
    if(defined('A_JSON'))
    {
      $data=[
                  'status'=>'ok',
                  'pages'=>1,
                  'mode'=>'list',
                  'content'=>$news
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
    else {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($news).');';
    }
    exit;
  }

  public function json_news_view()
  {
    $db=Load::DB();
    if(defined('A_JSON'))
    {
      if(!$news=$db->findone('news',['_id'=>intval($_GET['id']),'dd'=>['$exists'=>false],'pl'=>1],['_id'=>1,'t'=>1,'sm'=>1,'d'=>1]))
      {
        exit;
      }
      $news['d']=$news['sm'].preg_replace('/\<iframe(.*)width="([^"]+)"(.*)height="([^"]+)"(.*)iframe\>/i','<div class="flex-video widescreen"><iframe${1}width="620"${3}height="345"${5}iframe></div>',$news['d']);
      unset($news['sm']);
      $data=[
                  'status'=>'ok',
                  'pages'=>1,
                  'mode'=>'view',
                  'content'=>$news
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
    else {
      if(!$news=$db->findone('news',['_id'=>intval(Load::$path[2]),'dd'=>['$exists'=>false],'pl'=>1],['_id'=>1,'t'=>1,'sm'=>1,'d'=>1]))
      {
        exit;
      }
      $news['d']=$news['sm'].preg_replace('/\<iframe(.*)width="([^"]+)"(.*)height="([^"]+)"(.*)iframe\>/i','<div class="flex-video widescreen"><iframe${1}width="620"${3}height="345"${5}iframe></div>',$news['d']);
      unset($news['sm']);
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($news).');';
    }
  }

  public function json_set()
  {
    $db=Load::DB();
    $set=$db->find('lotto_set',[],[],['sort'=>['_id'=>-1],'limit'=>31]);
    for($i=0;$i<count($set);$i++)
    {
      $set[$i]['tm']=Load::Time()->from($set[$i]['tm'],'date');
    }

    if(defined('A_JSON'))
    {
      $data=[
                  'status'=>'ok',
                  'pages'=>1,
                  'content'=>$set
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
    else {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($set).');';
    }
  }
}
?>
