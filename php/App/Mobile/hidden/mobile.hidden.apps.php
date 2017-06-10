<?php



$db=Load::DB();


Load::$core->assign('parent','/hidden');

Load::$core->data['content']=Load::$core->fetch('hidden.apps');
?>