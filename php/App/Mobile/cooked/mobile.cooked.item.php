<?php


if(in_array(Load::$path[1],['add','edit']))
{
	require_once(__DIR__.'/mobile.cooked.item.'.Load::$path[1].'.php');
}
else
{
	require_once(__DIR__.'/mobile.cooked.item.home.php');
}

?>