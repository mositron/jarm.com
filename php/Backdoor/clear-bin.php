<?php

require_once __DIR__.'/door.php';


$folder->clean('bin/news');
$folder->clean('bin/ads');
$folder->clean('bin/banner');
$folder->delete('bin/service.txt');
$folder->delete('bin/www_home.html');


echo 'OK';
?>
