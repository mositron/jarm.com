<?php

require_once __DIR__.'/door.php';
//$folder->clean('bin/impression');
//exit;

$now_day = date('Y-m-d');
$now_hour = date('H');

echo 'NOW - '.$now_day.'/'.$now_hour.'<br>';

$ads=getlist($inf=_FILES.'bin/ads-impression/','/^([0-9]+)$/iU');
echo '<pre>'.print_r($ads,1).'</pre>';
for($i=0;$i<count($ads);$i++)
{
  $id = $ads[$i];
  echo 'id: '.$id.'<br>';
  $day = getlist($inf.$id.'/','/^(([0-9]+)\-([0-9]+)\-([0-9]+))$/iU');
  for($j=0;$j<count($day);$j++)
  {
    echo 'day: '.$day[$j].'<br>';
    $hour = 	getlist($inf.$id.'/'.$day[$j].'/','/^([0-9]+)$/iU');
    for($k=0;$k<count($hour);$k++)
    {
      // not current hour
      echo 'hour: '.$hour[$k].'<br>';
      if($day[$j]!=$now_day || $hour[$k]!=$now_hour)
      {
        echo $id.'/'.$day[$j].'/'.$hour[$k].' - OK<br>';
        $imp = getlist($inf.$id.'/'.$day[$j].'/'.$hour[$k].'/','/^(([0-9]+)\.txt)$/iU');

        $log = [];
        $logu = [];
        for($m=0;$m<count($imp);$m++)
        {
          $log2=(array)unserialize(file_get_contents($inf.$id.'/'.$day[$j].'/'.$hour[$k].'/'.$imp[$m]));
          foreach($log2 as $kl=>$vl)
          {
            if(!isset($log[$kl]))
            {
              $log[$kl]=0;
              $logu['imp.'.$kl]=0;
            }
            $log[$kl]+=$vl;
            $logu['imp.'.$kl]+=$vl;
          }
        }
        //ksort($log);
        //echo '<pre>'.print_r($log,true).'</pre><br><br>';
        $arg=['ads'=>intval($id),'time'=>$time->from($day[$j]),'day'=>intval(str_replace('-','',$day[$j])),'hour'=>intval($hour[$k])];
        if($da=$db->findone('ads_hour',$arg))
        {
          $db->update('ads_hour',['_id'=>$da['_id']],['$inc'=>$logu]);
        }
        else
        {
          $arg['imp']=$log;
          $db->insert('ads_hour',$arg);
        }
        $db->update('ads',['_id'=>intval($id)],['$set'=>['ds'=>$time->now()],'$inc'=>['imp'=>intval($log['do'])]]);
        $folder->clean('bin/ads-impression/'.$id.'/'.$day[$j].'/'.$hour[$k]);
        usleep(10000);
      }
      else
      {
        echo $id.'/'.$day[$j].'/'.$hour[$k].' - Waiting<br>';
      }
    }
    if($day[$j]!=$now_day)
    {
      usleep(10000);
      $folder->clean('bin/ads-impression/'.$id.'/'.$day[$j]);
    }
  }
}


$ads=getlist($inf=_FILES.'bin/ads-click/','/^([0-9]+)$/iU');
for($i=0;$i<count($ads);$i++)
{
  $id = $ads[$i];
  $day = getlist($inf.$id.'/','/^(([0-9]+)\-([0-9]+)\-([0-9]+))$/iU');
  for($j=0;$j<count($day);$j++)
  {
    $hour = 	getlist($inf.$id.'/'.$day[$j].'/','/^([0-9]+)$/iU');
    for($k=0;$k<count($hour);$k++)
    {
      // not current hour
      if($day[$j]!=$now_day || $hour[$k]!=$now_hour)
      {
        echo $id.'/'.$day[$j].'/'.$hour[$k].'<br>';
        $imp = getlist($inf.$id.'/'.$day[$j].'/'.$hour[$k].'/','/^(([0-9]+)\.txt)$/iU');

        $log = [];
        $logu = [];
        for($m=0;$m<count($imp);$m++)
        {
          $log2=(array)unserialize(file_get_contents($inf.$id.'/'.$day[$j].'/'.$hour[$k].'/'.$imp[$m]));
          foreach($log2 as $kl=>$vl)
          {
            if(!isset($log[$kl]))
            {
              $log[$kl]=0;
              $logu['click.'.$kl]=0;
            }
            $log[$kl]+=$vl;
            $logu['click.'.$kl]+=$vl;
          }
        }
        //ksort($log);
        //echo '<pre>'.print_r($log,true).'</pre><br><br>';
        $arg=['ads'=>intval($id),'day'=>intval(str_replace('-','',$day[$j])),'hour'=>intval($hour[$k])];
        if($da=$db->findone('ads_hour',$arg))
        {
          $db->update('ads_hour',['_id'=>$da['_id']],['$inc'=>$logu]);
        }
        else
        {
          $arg['click']=$log;
          $db->insert('ads_hour',$arg);
        }
        $db->update('ads',['_id'=>intval($id)],['$set'=>['ds'=>$time->now()],'$inc'=>['click'=>intval($log['do'])]]);
        $folder->clean('bin/ads-click/'.$id.'/'.$day[$j].'/'.$hour[$k]);
      }
    }
    if($day[$j]!=$now_day)
    {
      $folder->clean('bin/ads-click/'.$id.'/'.$day[$j]);
    }
  }
}


function getlist($path,$pattern)
{
  $f=[];
  if(is_dir($path))
  {
    if($dh=opendir($path))
    {
      while(($dir=readdir($dh))!==false)
      {
        if(preg_match($pattern,$dir,$file))
        {
          array_push($f,$file[1]);
        }
      }
      closedir($dh);
    }
  }
  sort($f);
  return $f;
}
//$folder->clean('bin/impression');
echo 'OK';
?>
