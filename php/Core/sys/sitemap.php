<?php
header('Content-type: text/xml; charset=utf-8');
$dm=[
    'news'=>0,
    'game'=>2,
    'tech'=>3,
    'ent'=>4,
    'movie'=>5,
    'politic'=>9,
    'horo'=>20,
    'weather'=>21,
    'lotto'=>22,
    'music'=>24,
    'asiangames'=>25,
    'korea'=>26,
    'beauty'=>27,
    'knowledge'=>30,
    'cooking'=>31,
    'restaurant'=>32,
    'trend'=>-1,
    'radio'=>-1,
    'chat'=>-1,
    'about'=>-1,
    'friend'=>-1,
    'lesbian'=>-1,
    'boyz'=>-1,
    'guess'=>-1,
    'feed'=>-1
];

$url=[];
if(isset($dm[Load::$type]) && $dm[Load::$type]>=0)
{
  $url[]=['loc'=>'https://'.Load::$type.'.jarm.com/','changefreq'=>'daily','priority'=>'0.8'];
  $_=['dd'=>['$exists'=>false],'pl'=>1];
  if($dm[Load::$type]>0)
  {
    $_['c']=$dm[Load::$type];
  }
  $news=Load::DB()->find('news',$_,['_id'=>1,'c'=>1,'sv'=>1,'fd'=>1],['sort'=>['_id'=>-1],'limit'=>50]);
  for($i=0;$i<count($news);$i++)
  {
  //  $url[]=['loc'=>Load::link()::news($news[$i]),'image:image'=>'<image:loc>https://'.$news[$i]['sv'].'.jarm.com/news/'.$news[$i]['fd'].'/m.jpg</image:loc>'];
  }
}
else
{
  $url[]=['loc'=>'http://jarm.com/','changefreq'=>'daily','priority'=>'0.9'];
  foreach($dm as $k=>$v)
  {
    if($v>=0)
    {
      $url[]=['loc'=>'https://'.$k.'.jarm.com/','changefreq'=>'daily','priority'=>'0.8'];
    }
    else
    {
      $url[]=['loc'=>'https://'.$k.'.jarm.com/'];
    }
  }
}
$tpl->assign('url',$url);
echo $tpl->fetch2('www.system.sitemap');
exit;
?>
