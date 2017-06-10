<?php



$db=Load::DB();


Load::$core->assign('parent','/tv');

Load::$core->data['content']=Load::$core->fetch('tv.apps');
?>