<?php


$db=Load::DB();
if(!Load::$path[1] || !$user=$db->findone('hidden_user',array('_id'=>intval(Load::$path[1]))))
{
	Load::move('/hidden');	
}

define('USER_ID',$user['_id']);
define('USER_FB',$user['fb']);
define('USER_LV',$user['lv']);



$games=require(__DIR__.'/mobile.hidden.game.config.php');


Load::$core->assign('parent','/hidden');
Load::$core->assign('games',$games);
Load::$core->assign('maxlv',count($games)+1);
Load::$core->assign('user',$user);
Load::$core->data['content']=Load::$core->fetch('hidden.score');


?>