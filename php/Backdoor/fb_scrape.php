<?php

require_once __DIR__.'/door.php';


define('TOKEN',Load::$conf['live']['token']);


Jarm\Core\Load::$conf['db']['collection']['event_gold']='s4';

get_like('229722963822965_1256201037841814');
get_comment('229722963822965_1256201037841814');
get_like('229722963822965_1265291296932788');
get_comment('229722963822965_1265291296932788');

function get_like($post,$next='')
{
  $db=Jarm\Core\Load::DB();
  if(!$next)
  {
    $url='https://graph.facebook.com/v2.9/'.$post.'/likes?limit=1000&access_token='.TOKEN;
  }
  else
  {
    $url='https://graph.facebook.com/v2.9/'.$post.'/likes?limit=1000&after='.$next.'&access_token='.TOKEN;
  }
  $data=file_get_contents($url);
  $data=json_decode($data,true);

  if($data['data'])
  {
    for($i=0;$i<count($data['data']);$i++)
    {
      $d=$data['data'][$i];
      if($u=$db->findone('event_gold',['fb'=>$d['id'],'ty'=>'like','p'=>$post]))
      {
        $db->update('event_gold',['_id'=>$u['_id']],['$set'=>['n'=>$d['name'],'p'=>$post]]);
      }
      else
      {
        $db->insert('event_gold',['fb'=>$d['id'],'n'=>$d['name'],'p'=>$post,'ty'=>'like']);
      }
    }
  }

  if($data['paging']&&$data['paging']['next'])
  {
    get_like($post,$data['paging']['cursors']['after']);
  }
  else
  {
    echo $post.' - success<br>';
  }
}

function get_comment($post,$next='')
{
  $db=Jarm\Core\Load::DB();
  if(!$next)
  {
    $url='https://graph.facebook.com/v2.9/'.$post.'/comments?limit=1000&access_token='.TOKEN;
  }
  else
  {
    $url='https://graph.facebook.com/v2.9/'.$post.'/comments?limit=1000&after='.$next.'&access_token='.TOKEN;
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
    get_comment($post,$data['paging']['cursors']['after']);
  }
  else
  {
    echo $post.' - success<br>';
  }
}
exit;
?>
