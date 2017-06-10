<?php



Load::$core->assign('apps',require(ROOT.'modules/app/apps/app.apps.config.php'));
Load::$core->assign('parent','/gold');

Load::$core->data['content']=Load::$core->fetch('gold.apps');
?>
