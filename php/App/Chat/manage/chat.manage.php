<?php
if(!Load::$my['logged'])
{
	Load::move('/facebook/login?redirect_uri='.urlencode(URI));
}
if(is_numeric(Load::$path[0]))
{
	require_once(__DIR__.'/chat.manage.view.php');
}
else
{
	require_once(__DIR__.'/chat.manage.home.php');
}
?>
