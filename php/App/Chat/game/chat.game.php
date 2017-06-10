<?php


if(in_array(Load::$path[0],['namtoa','slave','lottery','bank','thief','item','online','radio','lionica']))
{
	require_once(__DIR__.'/chat.game.'.Load::$path[0].'.php');
}
else
{
	exit;
}

?>
