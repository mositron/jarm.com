<?php



$db=Load::DB();


Load::$core->assign('parent','/football');

Load::$core->data['content']=Load::$core->fetch('football.apps');
?>