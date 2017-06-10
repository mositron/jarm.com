<?php

Load::$core->assign('user',Load::DB()->find('hidden_user',['dd'=>['$exists'=>false]],['_id'=>1,'name'=>1,'fb'=>1,'score'=>1,'lv'=>1],['sort'=>['score'=>-1,'lv'=>-1,'_id'=>1],'limit'=>100]));

Load::$core->assign('parent','/hidden');
Load::$core->data['content']=Load::$core->fetch('hidden.top');

?>
