<?php
namespace Jarm\App\Cron;
use Jarm\Core\Load;

class Article_Hour extends Service
{
  public function get_article_hour()
  {
    $echo='';
    foreach(Load::$conf['server']['article'] as $k=>$v)
    {
      $echo.=Load::Http()->get('https://'.$k.'/pull/'.$v['key'])."\r\n";
    }
    $db=Load::DB();
    $tmp=explode("\n",$echo);
    for($i=0;$i<count($tmp);$i++)
    {
      $cmd=explode('-',trim($tmp[$i]));
      if(count($cmd)==9)
      {
        $inc=[
            'do'=>intval($cmd[4]),
            'is'=>intval($cmd[5]),
            'mb'=>intval($cmd[6]),
            'tb'=>intval($cmd[7]),
            'dt'=>intval($cmd[8]),
          ];
        $db->update('article',['_id'=>intval($cmd[3])],['$inc'=>$inc]);
        $all=intval($cmd[4])+intval($cmd[5]);
        $inc['hour.'.intval($cmd[1])]=$all;
        if(intval($cmd[2]))
        {
          $inc['u.'.intval($cmd[2])]=$all;
        }
        if($db->findone('logs',['ty'=>'news','date'=>intval($cmd[0])]))
        {
          $db->update('logs',['ty'=>'news','date'=>intval($cmd[0])],['$inc'=>$inc]);
        }
        else
        {
          $inc['ty']='news';
          $inc['date']=intval($cmd[0]);
          $db->insert('logs',$inc);
        }
        echo trim($tmp[$i]).' -: OK<br>';
      }
      else
      {
        echo trim($tmp[$i]).' -: FAIL<br>';
      }
    }


    $now_h=date('G');
    $today=mktime(0,0,0);
    $day=3600*24;

    #for($i1=1;$i1<10;$i1++)
    #{
    #  $today-=$day;



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
      $u=[];
      $ds=[];
      $time=Load::Time();
      $n1=$db->find('article',['dd'=>['$exists'=>false],'pl'=>['$in'=>[1,2]],'ds'=>['$gte'=>Load::Time()->from($d1),'$lt'=>Load::Time()->from($d2)]],['u'=>1,'da'=>1,'ds'=>1]);
      for($i=0;$i<count($n1);$i++)
      {
        $v=$n1[$i];
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
      $n2=$db->find('news',['dd'=>['$exists'=>false],'pl'=>['$in'=>[1,2]],'ds'=>['$gte'=>Load::Time()->from($d1),'$lt'=>Load::Time()->from($d2)]],['u'=>1,'da'=>1,'ds'=>1]);
      for($i=0;$i<count($n2);$i++)
      {
        $v=$n2[$i];
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
        $db->update('logs',['ty'=>'news','date'=>$cday],['$set'=>['ur'=>$u,'hw'=>$ds,'urc'=>count($n1)+count($n2)]]);
      }
      echo '2-'.$cday.'-';
    #}
    exit;
  }
}
?>
