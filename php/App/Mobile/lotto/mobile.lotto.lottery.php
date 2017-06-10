<?php

if(is_numeric(Load::$path[1]))
{
	require_once(__DIR__.'/mobile.lotto.lottery.view.php');
}
else
{
	require_once(__DIR__.'/mobile.lotto.lottery.home.php');
}
?>