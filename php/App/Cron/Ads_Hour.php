<?php
namespace Jarm\App\Cron;
use Jarm\Core\Load;

class Ads_Hour extends Service
{
  public function get_ads_hour()
  {
    foreach(Load::$conf['server']['php'] as $k=>$v)
    {
      echo $v.':82 - '.Load::Http()->get('http://'.$v.':82/ads-hour.php').'<br>';
    }
    $db=Load::DB();
    if($last=$db->find('ads_hour',[],['day'=>1],['sort'=>['_id'=>-1],'limit'=>1]))
    {
      if($day=$last[0]['day'])
      {
        echo 'day - '.$day.'<br>';
        $last_id=false;
        $log=['imp'=>[],'click'=>[]];
        $ads=	$db->find('ads_hour',['day'=>$day],[],['sort'=>['ads'=>1,'hour'=>1]]);
        for($i=0;$i<count($ads);$i++)
        {
          $a = $ads[$i];
          if($last_id!=$a['ads'])
          {
            if($last_id)
            {
              $this->updateads($day,$last_id,$log);
              echo 'update - '.$day.' - '.$last_id.'<br>';
            }
            $last_id=$a['ads'];
            $log=['imp'=>[],'click'=>[]];
          }
          echo 'getting - '.$a['ads'].' - '.$a['hour'].'<br>';

          $log2=(array)$a['imp'];
          foreach($log2 as $kl=>$vl)
          {
            if(!isset($log['imp'][$kl]))
            {
              $log['imp'][$kl]=0;
            }
            $log['imp'][$kl]+=$vl;
          }
          $log2=(array)$a['click'];
          foreach($log2 as $kl=>$vl)
          {
            if(!isset($log['click'][$kl]))
            {
              $log['click'][$kl]=0;
            }
            $log['click'][$kl]+=$vl;
          }
        }
        if($last_id)
        {
          $this->updateads($day,$last_id,$log);
          echo 'update - '.$day.' - '.$last_id.'<br>';
        }
      }
    }
    exit;
  }

  public function updateads($day,$id,$log)
  {
    $db=Load::DB();
    $log['ds']=Load::Time()->now();
    $d = ''.$day.'';
    $log['time']=Load::Time()->from(substr($d,0,4).'-'.substr($d,4,2).'-'.substr($d,6,2));
    if($ads=$db->findone('ads_day',['day'=>$day,'ads'=>$id],['_id'=>1]))
    {
      $db->update('ads_day',['_id'=>$ads['_id']],['$set'=>$log]);
    }
    else
    {
      $log['day']=$day;
      $log['ads']=$id;
      $db->insert('ads_day',$log);
    }
  }
}
?>
