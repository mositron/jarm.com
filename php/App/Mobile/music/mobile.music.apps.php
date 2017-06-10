<?php



$db=Load::DB();


Load::$core->assign('parent','/music');

Load::$core->data['content']=Load::$core->fetch('music.apps');
?>