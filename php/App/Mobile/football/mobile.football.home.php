<?php




Load::$core->data['content']=Load::$core->fetch('football.home');

/*
Load::$core->data['content']=json_encode(array('type'=>'football','category'=>[],'updated'=>date('r'),'format'=>$format,'data'=>array(
                                                                                                            'news'=>['lastupdate'=>Load::Time()->sec($news[0]['ds'])],
                                                                                                            'football'=>['lastupdate'=>Load::Time()->sec($football[0]['da'])],
                                                                                                            'set'=>['lastupdate'=>Load::Time()->sec($set[0]['da'])]
  )));

*/
?>
