<?php



$db=Load::DB();


Load::$core->assign('parent','/friend');

Load::$core->data['content']=Load::$core->fetch('friend.apps');
?>