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
