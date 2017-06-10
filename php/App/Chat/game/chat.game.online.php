<?php

Load::$core->assign('month',Load::DB()->find('chatroom_online',array('r'=>intval(Load::$path[1]),'m'=>date('n')),[],['sort'=>['t'=>-1,'u'=>1],'limit'=>100]));
Load::$core->assign('user',$user);
echo Load::$core->fetch('game.online');
exit;
?>
