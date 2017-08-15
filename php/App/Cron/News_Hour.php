<?php
namespace Jarm\App\Cron;
use Jarm\Core\Load;

class News_Hour extends Service
{
  public function get_news_hour()
  {
    foreach(Load::$conf['server']['php'] as $k=>$v)
    {
      echo $v.' - '.Load::Http()->get('http://'.$v.':82/news-hour.php').'<br>';
    }


    $db=Load::DB();
    $now_h=date('G');
    $today=mktime(0,0,0);
    $day=3600*24;
/*
    for($i1=1;$i1<10;$i1++)
    {
      $today-=$day;

*/

    if($now_h<6)
    {
      $d1=$today-$day;
      $d2=$today;
    }
    else
    {
      $d1=$today;
      $d2=$today+$day;
    }
    $n=$db->find('news',['dd'=>['$exists'=>false],'pl'=>['$in'=>[1,2]],'ds'=>['$gte'=>Load::Time()->from($d1),'$lt'=>Load::Time()->from($d2)]],['u'=>1,'da'=>1,'ds'=>1]);
    $u=[];
    $ds=[];
    $time=Load::Time();
    for($i=0;$i<count($n);$i++)
    {
      $v=$n[$i];
      if(!isset($u[$v['u']]))
      {
        $u[$v['u']]=0;
      }
      $u[$v['u']]++;
      $hr=date('G',$time->sec($v['ds']));
      if(!isset($ds[$hr]))
      {
        $ds[$hr]=0;
      }
      $ds[$hr]++;
    }

    $cday=intval(date('Ymd',$d1));
    if($db->findone('logs',['ty'=>'news','date'=>$cday]))
    {
      echo 1;
      $db->update('logs',['ty'=>'news','date'=>$cday],['$set'=>['ur'=>$u,'hw'=>$ds,'urc'=>count($n)]]);
    }
      echo '2-'.$cday.'-';

//  }
/*
    $db=Load::DB();
    if($last=$db->find('news_hour',[],['day'=>1],['sort'=>['_id'=>-1],'limit'=>1]))
    {
      if($day=$last[0]['day'])
      {
        //$day = 20150529;
        echo 'day - '.$day.'<br>';
        $last_id=false;
        $do_count=['do'=>0,'mb'=>0,'tb'=>0,'pc'=>0,'hour'=>[]];
        $log=['stats'=>[]];
        $news=	$db->find('news_hour',['day'=>$day],[],['sort'=>['news'=>1,'hour'=>1]]);
        for($i=0;$i<count($news);$i++)
        {
          $a = $news[$i];
          if($last_id!=$a['news'])
          {
            if($last_id)
            {
              $this->updatenews($day,$last_id,$log);
              echo 'update - '.$day.' - '.$last_id.'<br>';
            }
            $last_id=$a['news'];
            $log=['stats'=>[]];
          }
          echo 'getting - '.$a['news'].' - '.$a['hour'].'<br>';

          $log2=(array)$a['stats'];
          foreach($log2 as $kl=>$vl)
          {
            if(!isset($log['stats'][$kl]))
            {
              $log['stats'][$kl]=0;
            }
            $log['stats'][$kl]+=$vl;
          }
          $h=intval($a['hour']);
          if(!isset($do_count['hour'][$h]))
          {
            $do_count['hour'][$h]=0;
          }
          $do_count['hour'][$h]+=$a['stats']['do'];

          if($a['stats']['do'])
          {
            $do_count['do']+=$a['stats']['do'];
          }
          if($a['stats']['mb'])
          {
            $do_count['mb']+=$a['stats']['mb'];
          }
          if($a['stats']['tb'])
          {
            $do_count['tb']+=$a['stats']['tb'];
          }
          if($a['stats']['pc'])
          {
            $do_count['pc']+=$a['stats']['pc'];
          }
        }
        if($last_id)
        {
          $this->updatenews($day,$last_id,$log);
          echo 'update - '.$day.' - '.$last_id.'<br>';
        }

        if($db->findone('logs',['ty'=>'news','date'=>$day]))
        {
          $db->update('logs',['ty'=>'news','date'=>$day],['$set'=>$do_count]);
        }
        else
        {
          $do_count['ty']='news';
          $do_count['date']=$day;
          $db->insert('logs',$do_count);
        }
      }
    }
    */
    exit;
  }

  public function updatenews($day,$id,$log)
  {
    $db=Load::DB();
    $log['ds']=Load::Time()->now();
    $d = ''.$day.'';
    $log['time']=Load::Time()->from(substr($d,0,4).'-'.substr($d,4,2).'-'.substr($d,6,2));
    if($news=$db->findone('news_day',['day'=>$day,'news'=>$id],['_id'=>1]))
    {
      $db->update('news_day',['_id'=>$news['_id']],['$set'=>$log]);
    }
    else
    {
      $log['day']=$day;
      $log['news']=$id;
      $db->insert('news_day',$log);
    }
  }
}
?>
