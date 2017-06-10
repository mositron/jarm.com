<?php

require_once __DIR__.'/door.php';


# notify
#$db->remove('game_lottery_answer',['da'=>['$lte'=>$time->now(-3600*24*3)]]);
#$db->remove('game_namtoa',['da'=>['$lte'=>$time->now(-3600*24*3)]]);
#$db->remove('game_slave',['fn'=>1,'da'=>['$lte'=>$time->now(-3600*24*3)]]);
#$db->remove('chat_thief',['da'=>['$lte'=>$time->now(-3600*24*3)]]);
#$db->remove('lionica_drop',['da'=>['$lte'=>$time->now(-3600*3)]]);
#$db->remove('football_game',['fn'=>['$exists'=>true],'fnd'=>['$lte'=>$time->now(-3600*30)]]);
#$db->remove('point',['da'=>['$lte'=>$time->now(-3600*24*3)]]);
#$db->remove('gift',['ex'=>['$lte'=>$time->now(-3600*24*7)]]);

echo '<br>user_thank - remove: '.$db->remove('user_thank',['da'=>['$lte'=>$time->now(-3600*24*15)]]);

echo '<br>msn - update: '.
  $db->update('msn',[
      'dd'=>['$exists'=>false],
      'da'=>['$lte'=>$time->now(-3600*24*30)]
    ],
    ['$set'=>['dd'=>$time->now(),'auto_delete'=>1]],
    ['multiple'=>true]
  );

echo '<br>msn - remove: '.$db->remove('msn',['da'=>['$lte'=>$time->now(-3600*24*120)]]);
echo '<br>msn - remove: '.$db->remove('msn',['dd'=>['$lte'=>$time->now(-3600*24*90)]]);
echo '<br>ads_hour - remove: '.$db->remove('ads_hour',['da'=>['$lte'=>$time->now(-3600*24*365)]]);
echo '<br>news_day - remove: '.$db->remove('news_day',['da'=>['$lte'=>$time->now(-3600*24*32)]]);

$news=[];
$tmp=$db->find('news_hour',['lk'=>['$exists'=>false],'da'=>['$lte'=>$time->now(-3600*24)]],[],['sort'=>['_id'=>1],'limit'=>10000]);
for($i=0;$i<count($tmp);$i++)
{
  $t = $tmp[$i];
  if(!isset($news[$t['news']]))
  {
    if(!$n=$db->findone('news',['_id'=>$t['news']]))
    {
      $n['pass']=true;
    }
    else
    {
      $n['gt']=($n['ds']?Load::Time()->sec($n['ds']):Load::Time()->sec($n['da']))+(3600*25);
    }
    $news[$t['news']] = $n;
    echo '<br> find news: '.$n['_id'];
  }
  if(!$news[$t['news']]['pass'])
  {
    #echo '<br> not pass: '.$t['news'];
    if(Load::Time()->sec($t['da']) > $news[$t['news']]['gt'])
    {
      #echo '<br> <span style="background:"#f00;color:#fff"> remove: </span> '.$t['news'].' - '.$t['day'].' '.$t['hour'].' - '.$t['_id'];
      $db->remove('news_hour',['_id'=>$t['_id']]);
    }
    else
    {
      #echo '<br> lock: '.$t['news'].' - '.$t['day'].' '.$t['hour'].' - '.$t['_id'];
      $db->update('news_hour',['_id'=>$t['_id']],['$set'=>['lk'=>1]]);
    }
  }
  else
  {

  }
}

echo '<br>news_hour - remove: '.$db->remove('news_hour',['da'=>['$lte'=>$time->now(-3600*24*32)]]);
?>

<script>
setTimeout(function(){window.location.href='?<?php echo time()?>'},5000);
</script>
