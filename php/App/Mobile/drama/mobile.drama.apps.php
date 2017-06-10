<?php



$db=Load::DB();


Load::$core->assign('parent','/drama');

Load::$core->data['content']=Load::$core->fetch('drama.apps');
?>