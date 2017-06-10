<?php


$db=Load::DB();
$cooked=$db->find('cooked_line',['dd'=>['$exists'=>false]],[],['sort'=>['_id'=>-1],'limit'=>50]);

Load::$core->assign('parent','/cooked');
Load::$core->assign('cooked',$cooked);
Load::$core->data['content']=Load::$core->fetch('cooked.share');


?>