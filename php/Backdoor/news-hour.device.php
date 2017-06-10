<?php

require_once __DIR__.'/door.php';

//$folder->clean('bin/impression');
//exit;

$now = intval(date('YmdH'));

echo 'NOW - '.$now.'<br>';
$day=getlist($inf=_FILES.'bin/news-view/','/^(([0-9]+)\-([0-9]+)\-([0-9]+))$/iU');
//echo '<pre>'.print_r($news,1).'</pre>';
for($i=0;$i<count($day);$i++)
{
  echo 'day: '.$day[$i].'<br>';
  $hour = getlist($inf.$day[$i].'/','/^([0-9]+)$/iU');
  for($j=0;$j<count($hour);$j++)
  {
    echo 'hour: '.$hour[$j].'<br>';
    $d = intval(str_replace('-','',$day[$i]).''.$hour[$j]);
    if($now>$d) //
    {
      $news = getlist($inf.$day[$i].'/'.$hour[$j].'/','/^([0-9]+)$/iU');
      for($k=0;$k<count($news);$k++)
      {
        echo 'news: '.$news[$k].'<br>';
        $imp = getlist($inf.$day[$i].'/'.$hour[$j].'/'.$news[$k].'/','/^(([0-9]+)\.txt)$/iU');
        echo '<pre>'.print_r($imp,1).'</pre>';
        $log = [];
        $logu = [];
        for($m=0;$m<count($imp);$m++)
        {
          $log2=(array)unserialize(file_get_contents($inf.$day[$i].'/'.$hour[$j].'/'.$news[$k].'/'.$imp[$m]));
          foreach($log2 as $kl=>$vl)
          {
            if(!isset($log[$kl]))
            {
              $log[$kl]=0;
              $logu['stats.'.$kl]=0;
            }
            $log[$kl]+=$vl;
            $logu['stats.'.$kl]+=$vl;
          }
        }
        //ksort($log);
        //echo '<pre>'.print_r($log,true).'</pre><br><br>';
        $arg=['news'=>intval($news[$k]),'time'=>$time->from($day[$i]),'day'=>intval(str_replace('-','',$day[$i])),'hour'=>intval($hour[$j])];
        if($da=$db->findone('news_hour',$arg))
        {
          $db->update('news_hour',['_id'=>$da['_id']],['$inc'=>$logu]);
        }
        else
        {
          $arg['stats']=$log;
          $db->insert('news_hour',$arg);
        }
        $db->update('news',['_id'=>intval($news[$k])],['$inc'=>['do'=>intval($log['do'])]]);
        $folder->clean('bin/news-view/'.$day[$i].'/'.$hour[$j].'/'.$news[$k]);
      }
      $folder->clean('bin/news-view/'.$day[$i].'/'.$hour[$j]);
    }
  }
  if(!count($hour))
  {
    $folder->clean('bin/news-view/'.$day[$i]);
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
