<?php


$db=Load::DB();
if(!Load::$path[1] || !$user=$db->findone('matching_user',array('_id'=>intval(Load::$path[1]))))
{
	Load::move('/matching');	
}

define('USER_ID',$user['_id']);
define('USER_FB',$user['fb']);
define('USER_LV',$user['lv']);



$games=require(__DIR__.'/mobile.matching.game.config.php');


Load::$core->assign('parent','/matching');
Load::$core->assign('games',$games);
Load::$core->assign('maxlv',count($games)+1);
Load::$core->assign('user',$user);
Load::$core->data['content']=Load::$core->fetch('matching.score');


?>