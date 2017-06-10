<?php




Load::$core->data['content']=Load::$core->fetch('oil.home');

/*
Load::$core->data['content']=json_encode(array('type'=>'oil','category'=>[],'updated'=>date('r'),'format'=>$format,'data'=>array(
                                                                                                            'news'=>['lastupdate'=>Load::Time()->sec($news[0]['ds'])],
                                                                                                            'oil'=>['lastupdate'=>Load::Time()->sec($oil[0]['da'])],
                                                                                                            'set'=>['lastupdate'=>Load::Time()->sec($set[0]['da'])]
  )));

*/
?>
