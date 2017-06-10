<?php



$db=Load::DB();


Load::$core->assign('parent','/lotto');

Load::$core->data['content']=Load::$core->fetch('lotto.apps');
?>