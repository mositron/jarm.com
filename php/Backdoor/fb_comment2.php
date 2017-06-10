<?php

require_once __DIR__.'/door.php';

$post='229722963822965_1265291296932788';
$token='EAAJotQPOgNsBANuDI9hGExRsHkje9mtylzUQGObyF2fbsqbKHYpV4dZBEkdh4HD90YE0ry4DKB8yuwyoZCofDp70oKSblk5Om3Wop54qNnzSAP2zrRKo9nfxjRPwPHlPHOf1d4z8Pc8kRZCyoCmKi4SswFF7eCbtHZAhpi1HfVFzfZBaAoYnA';

$next=$_GET['next'];


Jarm\Core\Load::$conf['db']['collection']['event_gold']='s4';

if(!$next)
{
  $url='https://graph.facebook.com/v2.9/'.$post.'/comments?limit=1000&access_token='.$token;
}
else
{
  $url='https://graph.facebook.com/v2.9/'.$post.'/comments?limit=1000&after='.$next.'&access_token='.$token;
}
$data=file_get_contents($url);
$data=json_decode($data,true);

if($data['data'])
{
  for($i=0;$i<count($data['data']);$i++)
  {
    $d=$data['data'][$i];
    if($u=$db->findone('event_gold',['fb'=>$d['from']['id'],'ty'=>'comment','p'=>$post]))
    {
      $db->update('event_gold',['_id'=>$u['_id']],['$set'=>['n'=>$d['from']['name']]]);
    }
    else
    {
      $db->insert('event_gold',['fb'=>$d['from']['id'],'n'=>$d['from']['name'],'p'=>$post,'p2'=>$d['id'],'ty'=>'comment']);
    }
  }
}

if($data['paging']&&$data['paging']['next'])
{
  $next=$data['paging']['cursors']['after'];
  echo '<script>setTimeout(function(){window.location.href="?next='.$next.'"},2000);</script>';
  echo 'next: '.$next;
}
else
{
  echo 'success';
}

exit;
?>
