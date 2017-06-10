<?php


$db=Load::DB();


$weather=$db->find('weather',['dd'=>['$exists'=>false]],['_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'sn'=>1,'ar'=>1,'al'=>1,'yt'=>1,'da'=>1],['sort'=>['_id'=>-1],'limit'=>10]);
$news=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['pl'=>1,'c'=>21,'exl'=>0],[],['limit'=>5]);

Load::$core->assign('news',$news);
Load::$core->assign('weather',$weather);

Load::$core->data['content']=Load::$core->fetch('weather.home');

/*
Load::$core->data['content']=json_encode(array('type'=>'weather','category'=>[],'updated'=>date('r'),'format'=>$format,'data'=>array(
                                                                                                            'news'=>['lastupdate'=>Load::Time()->sec($news[0]['ds'])],
                                                                                                            'weather'=>['lastupdate'=>Load::Time()->sec($weather[0]['da'])],
                                                                                                            'set'=>['lastupdate'=>Load::Time()->sec($set[0]['da'])]
  )));

*/
?>
