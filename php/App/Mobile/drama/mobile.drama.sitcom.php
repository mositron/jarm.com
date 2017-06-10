<?php


Load::$core->assign('tv',Load::DB()->find('tvreturn',['dd'=>['$exists'=>false],'type'=>'sitcom'],['_id'=>1,'name'=>1,'img'=>1,'last'=>1,'count'=>1],['sort'=>['order'=>-1],'limit'=>50]));


Load::$core->data['content']=Load::$core->fetch('drama.sitcom');



?>
