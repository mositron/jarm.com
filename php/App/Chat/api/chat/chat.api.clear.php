<?php

if($chat->myadmin==9)
{
	$chat->cache->delete('ca2',$chat->key);
	$chat->cache->delete('ca2','chatbox_user_'.$chat->room);
}
else
{
	//$chat->data['ban']['_id']
}
?>
