<?php


$db=Load::DB();
$lottery=$db->find('lotto',['dd'=>['$exists'=>false],'pl'=>1],['tm'=>1],['sort'=>['tm'=>-1],'limit'=>1]);
$news=$db->find('news',['pl'=>1,'dd'=>['$exists'=>false],'c'=>22],['ds'=>1],['sort'=>['_id'=>-1],'limit'=>1]);
$set=$db->find('lotto_set',[],['da'=>1],['sort'=>['_id'=>-1],'limit'=>1]);

Load::$core->assign('news',$news[0]);
Load::$core->assign('lottery',$lottery[0]);
Load::$core->assign('set',$set[0]);

Load::$core->data['content']=Load::$core->fetch('lotto.home');

/*
Load::$core->data['content']=json_encode(array('type'=>'lotto','category'=>[],'updated'=>date('r'),'format'=>$format,'data'=>[
                                                                                                            'news'=>['lastupdate'=>Load::Time()->sec($news[0]['ds'])],
                                                                                                            'lotto'=>['lastupdate'=>Load::Time()->sec($lotto[0]['da'])],
                                                                                                            'set'=>['lastupdate'=>Load::Time()->sec($set[0]['da'])]
  ]));

*/
?>
