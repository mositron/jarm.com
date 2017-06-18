<?php
_::$meta['title'] = 'Lionica - เกมสัตว์เลี้ยง เกม Lionica สัตว์เลี้ยง เลี้ยงสัตว์บนเว็บ';
_::$meta['description'] = 'เกมสัตว์เลี้ยง เลี้ยงสัตว์บนเว็บบ๊อกซ่า เกม Lionica';
_::$meta['keywords'] = 'เกมสัตว์เลี้ยง, เกมส์เล่นบนเว็บ, สัตว์เลี้ยง, เกมส์, เกม';


if(_::$path[0])
{
	if(in_array(_::$path[1],array('map','class')))
	{
		require_once(__DIR__.'/game.lionica.info.'._::$path[1].'.php');
	}
	else
	{
		_::move('/lionica');
	}
}
else
{
	_::move('/lionica');
}

?>