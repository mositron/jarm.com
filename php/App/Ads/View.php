<?php
namespace Jarm\App\Ads;
use Jarm\Core\Load;

class View extends Service
{
  public function get_view()
  {
    list($id,$sc)=explode('-',Load::$path[1],2);
    $db=Load::DB();
    if(!$banner=$db->findone('ads',['_id'=>intval($id),'dd'=>['$exists'=>false]]))
    {
      Load::move('/');
    }

    Load::$core->data['title']=$banner['t'];

    if((Load::$my&&Load::$my['am']>9)||$sc==$banner['sc']||$this->check_perm('banner'))
    {
      if($_GET['start'])
      {
        $start=trim($_GET['start']);
      }
      else
      {
        $start=date('Y-m-d',strtotime('-1month'));
      }
      if($_GET['stop'])
      {
        $stop=trim($_GET['stop']);
      }
      else
      {
        $stop=date('Y-m-d');
      }

      $mn=['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
      $stats=$db->find('ads_day',['ads'=>$banner['_id'],'day'=>['$gte'=>intval(str_replace('-','',$start)),'$lte'=>intval(str_replace('-','',$stop))]],['day'=>1,'imp'=>1,'click'=>1],['day'=>1]);

      $day=[];
      $x = $line_imp = $line_click = [];
      $pie_imp = ['mb'=>['label'=>'Mobile','data'=>0,'color'=>'#0cc2ff'],'tb'=>['label'=>'Tablet','data'=>0,'color'=>'#64d6fc'],'pc'=>['label'=>'Desktop','data'=>0,'color'=>'#9fe0f9']];
      $pie_click = ['mb'=>['label'=>'Mobile','data'=>0,'color'=>'#fc23e6'],'tb'=>['label'=>'Tablet','data'=>0,'color'=>'#fc79ef'],'pc'=>['label'=>'Desktop','data'=>0,'color'=>'#f9b1f1']];
      $sa = $su = $sv = 0;
      $imp_devices=[];
      $imp_devices_all=0;
      $imp_browsers=[];
      $imp_browsers_all=0;
      $click_devices=[];
      $click_devices_all=0;
      $click_browsers=[];
      $click_browsers_all=0;
      for($i=0;$i<count($stats);$i++)
      {
        $_imp = intval($stats[$i]['imp']['do']);
        $_click = intval($stats[$i]['click']['do']);
        $sa += $_imp;
        $line_imp[]=[$i,$_imp];
        $line_click[]=[$i,$_click];
        $day[]=$stats[$i]['day'];
        $pie_imp['mb']['data']+=intval($stats[$i]['imp']['mb']);
        $pie_imp['tb']['data']+=intval($stats[$i]['imp']['tb']);
        $pie_imp['pc']['data']+=intval($stats[$i]['imp']['pc']);
        $pie_click['mb']['data']+=intval($stats[$i]['click']['mb']);
        $pie_click['tb']['data']+=intval($stats[$i]['click']['tb']);
        $pie_click['pc']['data']+=intval($stats[$i]['click']['pc']);
        $x[]=[$i,substr(''.$stats[$i]['day'],6,2).'<br>'.$mn[intval(substr(''.$stats[$i]['day'],4,2))-1]];

        foreach((array)$stats[$i]['imp'] as $k=>$v)
        {
          if(substr($k,0,3)=='pf_')
          {
            $n=ucwords(str_replace('_',' ',substr($k,3)));
            if(!isset($imp_devices[$n]))
            {
              $imp_devices[$n]=0;
            }
            $imp_devices[$n]+=$v;
            $imp_devices_all+=$v;
          }
          elseif(substr($k,0,3)=='bs_')
          {
            $n=ucwords(str_replace('_',' ',substr($k,3)));
            if(!isset($imp_browsers[$n]))
            {
              $imp_browsers[$n]=0;
            }
            $imp_browsers[$n]+=$v;
            $imp_browsers_all+=$v;
          }
        }
        foreach((array)$stats[$i]['click'] as $k=>$v)
        {
          if(substr($k,0,3)=='pf_')
          {
            $n=ucwords(str_replace('_',' ',substr($k,3)));
            if(!isset($click_devices[$n]))
            {
              $click_devices[$n]=0;
            }
            $click_devices[$n]+=$v;
            $click_devices_all+=$v;
          }
          elseif(substr($k,0,3)=='bs_')
          {
            $n=ucwords(str_replace('_',' ',substr($k,3)));
            if(!isset($click_browsers[$n]))
            {
              $click_browsers[$n]=0;
            }
            $click_browsers[$n]+=$v;
            $click_browsers_all+=$v;
          }
        }
      }
      arsort($imp_devices);
      arsort($imp_browsers);
      arsort($click_devices);
      arsort($click_browsers);

      return Load::$core
        ->assign('banner',$banner)
        ->assign('stats',$stats)
        ->assign('month',$mn)
        ->assign('line_imp',$line_imp)
        ->assign('line_click',$line_click)
        ->assign('pie_imp',array_values($pie_imp))
        ->assign('pie_click',array_values($pie_click))
        ->assign('imp_devices',array_slice($imp_devices,0,14))
        ->assign('imp_browsers',array_slice($imp_browsers,0,14))
        ->assign('click_devices',array_slice($click_devices,0,14))
        ->assign('click_browsers',array_slice($click_browsers,0,14))
        ->assign('imp_devices_all',max(1,$imp_devices_all))
        ->assign('imp_browsers_all',max(1,$imp_browsers_all))
        ->assign('click_devices_all',max(1,$click_devices_all))
        ->assign('click_browsers_all',max(1,$click_browsers_all))
        ->assign('start',$start)
        ->assign('stop',$stop)
        ->assign('x',$x)
        ->fetch('ads/view.'.$banner['ty']);
    }
    else
    {
      return Load::$core->fetch('ads/permission');
    }
  }
}

?>
