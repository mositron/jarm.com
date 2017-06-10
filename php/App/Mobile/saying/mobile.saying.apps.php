<?php



$db=Load::DB();


Load::$core->assign('parent','/saying');

Load::$core->data['content']=Load::$core->fetch('saying.apps');
?>