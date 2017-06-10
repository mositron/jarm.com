<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Guess extends Service
{
  public function get_guess()
  {
    $serv=[
      'get_apps'=>'get_apps',
      'hit'=>'json_hit',
      'recent'=>'json_recent',
      'list'=>'json_list',
      'view'=>'json_view',
      'play'=>'json_play',
    ];

    $cate=[
      1=>['t'=>'การ์ตูน'],
      2=>['t'=>'เกมส์'],
      3=>['t'=>'กีฬา'],
      4=>['t'=>'เพลง ละคร ภาพยนต์'],
      5=>['t'=>'บันเทิง ดารา นักร้อง'],
      6=>['t'=>'รถ ยานพาหนะ'],
      7=>['t'=>'กิจกรรม'],
      8=>['t'=>'ไลฟ์สไตล์'],
      9=>['t'=>'ความรัก'],
      10=>['t'=>'ตลก ขำขัน กวนๆ'],
      11=>['t'=>'ดวง ทำนาย พยากรณ์'],
      99=>['t'=>'อื่นๆ']
    ];

    if(isset($_GET['json'])&&isset($serv[$_GET['json']]))
    {
      $this->{$serv[$_GET['json']]}($cate);
    }
    exit;
  }

  public function json_hit($cate)
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $arg=['pl'=>1,'dd'=>['$exists'=>false]];

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
    if($c=$db->count('guess',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $list=$db->find('guess',$arg,['_id'=>1,'t'=>1,'d'=>1,'img'=>1,'c'=>1,'l'=>1,'fd'=>1,'p'=>1,'u'=>1,'do'=>1,'f'=>1],['sort'=>['do'=>-1],'skip'=>$skip,'limit'=>$count]);
      $pages=ceil($c/$count);
    }

    $data=[
                'status'=>'ok',
                'mode'=>'hit',
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

  public function json_recent($cate)
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $arg=['pl'=>1,'dd'=>['$exists'=>false]];


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
    if($c=$db->count('guess',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $list=$db->find('guess',$arg,['_id'=>1,'t'=>1,'d'=>1,'img'=>1,'c'=>1,'l'=>1,'fd'=>1,'p'=>1,'u'=>1,'do'=>1,'f'=>1],['sort'=>['_id'=>-1],'skip'=>$skip,'limit'=>$count]);
      $pages=ceil($c/$count);
    }

    $data=[
      'status'=>'ok',
      'mode'=>'recent',
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

  public function json_list($cate)
  {
    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $cate=(int)$_GET['cate'];
    $arg=['pl'=>1,'c'=>$cate,'dd'=>['$exists'=>false]];


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
    if($c=$db->count('guess',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation($count,$c,[$url,'page-'],$page);
      $list=$db->find('guess',$arg,['_id'=>1,'t'=>1,'d'=>1,'img'=>1,'c'=>1,'l'=>1,'fd'=>1,'p'=>1,'u'=>1,'do'=>1,'f'=>1],['sort'=>['_id'=>-1],'skip'=>$skip,'limit'=>$count]);
      $pages=ceil($c/$count);
    }

    $data=[
                'status'=>'ok',
                'mode'=>'recent',
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

  public function json_view($cate)
  {
    $id=(int)$_GET['id'];

    Load::Ajax()->register(['playapp']);

    $db=Load::DB();
    if(!$app=$db->findOne('guess',['_id'=>$id,'pl'=>1,'dd'=>['$exists'=>false]]))
    {
      exit;
    }

    $quest=[];
    $ans=[];

    shuffle($app['quest']);

    $data=[
      'status'=>'ok',
      'mode'=>'view',
//            'pages'=>$pages,
      'content'=>Load::$core->assign('app',$app)->assign('cate',$cate)->fetch('app/guess.view')
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

  public function json_play($cate)
  {
    $db=Load::DB();
    $play=false;
    $k=date('Y-m-d');
    if($q=$db->findOne('guess',['_id'=>intval($_GET['id']),'pl'=>1]))
    {
      $ans=[];
      for($i=0;$i<count($q['quest']);$i++)
      {
        $v=strval($_GET['ans'.$i]);
        if($v!='')
        {
          $v=intval($v);
          if(!isset($ans[$v]))
          {
            $ans[$v]=0;
          }
          $ans[$v]++;
        }
      }
      arsort($ans);
      $k=array_keys($ans);
      $rs=$k[0];
      $fb=[
        'message'=>$q['t'].' (via Android)',
        'name'=>$q['ans'][$rs]['t'],
        'caption'=>$q['t'],
        'link'=>'https://play.google.com/store/apps/details?id=com.doodroid.guess',
//        'picture'=>Load::uri(['s3','/guess/'.$q['fd'].'/s.jpg']),
        'description'=>$q['ans'][$rs]['d'],
        'actions'=>[['name'=>'เกมทายใจ+ for Android','link'=>'https://play.google.com/store/apps/details?id=com.doodroid.guess']]
      ];
      if($q['ans'][$rs]['i'])
      {
      //  $fb['picture']=Load::uri(['s3','/guess/'.$q['fd'].'/'.$q['ans'][$rs]['i']]);
      }

      if($_GET['callback'])
      {
        header('Content-type: text/javascript');
        echo $_GET['callback'].'('.json_encode($fb).')';
      }
      else
      {
        header('Content-type: application/json');
        echo json_encode($fb);
      }


      $u=$arg['uid'];

      $num=5;
      if($pa=$db->findOne('guess_play',['a'=>$q['_id'],'k'=>$k]))
      {
        if(!in_array($u,(array)$pa['p']))
        {
          $num=10;
          $db->update('guess_play',['_id'=>$pa['_id']],['$push'=>['p'=>$u],'$set'=>['c'=>intval($pa['c'])+1]]);
          $db->update('guess',['_id'=>$q['_id']],['$set'=>['do'=>intval($q['do'])+1]]);
        }
      }
      else
      {
        $num=10;
        $db->insert('guess_play',['a'=>$q['_id'],'k'=>$k,'p'=>[$u],'c'=>1]);
        $db->update('guess',['_id'=>$q['_id']],['$set'=>['do'=>intval($q['do'])+1]]);
      }
      if($_setans)
      {
        $db->update('guess_play',['a'=>$q['_id'],'k'=>$k],['$set'=>['o.'.$u=>$_setans]]);
      }
    }
  }
}
?>
