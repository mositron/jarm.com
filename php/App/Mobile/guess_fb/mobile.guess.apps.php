<?php



$db=Load::DB();


Load::$core->assign('parent','/guess');

Load::$core->data['content']=Load::$core->fetch('guess.apps');
?>