<?php

Load::$core->assign('user',Load::DB()->find('matching_user',['dd'=>['$exists'=>false]],['_id'=>1,'name'=>1,'fb'=>1,'score'=>1,'lv'=>1],['sort'=>['score'=>-1,'lv'=>-1,'_id'=>1],'limit'=>100]));

Load::$core->assign('parent','/matching');
Load::$core->data['content']=Load::$core->fetch('matching.top');

?>
