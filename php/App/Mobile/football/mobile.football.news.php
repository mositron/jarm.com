<?php




if(is_numeric(Load::$path[1]))
{
	require_once(__DIR__.'/mobile.football.news.view.php');
}
else
{
	require_once(__DIR__.'/mobile.football.news.home.php');
}

?>