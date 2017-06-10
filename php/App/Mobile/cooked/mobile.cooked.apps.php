<?php



$db=Load::DB();


Load::$core->assign('parent','/cooked');

Load::$core->data['content']=Load::$core->fetch('cooked.apps');
?>