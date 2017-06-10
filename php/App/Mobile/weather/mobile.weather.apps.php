<?php



$db=Load::DB();


Load::$core->assign('parent','/weather');

Load::$core->data['content']=Load::$core->fetch('weather.apps');
?>