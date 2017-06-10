<?php



$db=Load::DB();


Load::$core->assign('parent','/sticker');

Load::$core->data['content']=Load::$core->fetch('sticker.apps');
?>