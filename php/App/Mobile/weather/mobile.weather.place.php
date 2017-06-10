<?php




if(is_numeric(Load::$path[1]))
{
	require_once(__DIR__.'/mobile.weather.place.view.php');
}
else
{
	require_once(__DIR__.'/mobile.weather.place.home.php');
}

?>