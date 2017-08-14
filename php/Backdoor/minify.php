<?php

require_once __DIR__.'/door.php';
require_once(_PHP.'Vendor/autoload.php');

$FILES=_FILES.'cdn/';

$js = new \MatthiasMullie\Minify\JS();
$js->add($FILES.'lib/jquery/jquery.min.js');
$js->add($FILES.'lib/bootstrap/js/bootstrap.min.js');
$js->add($FILES.'js/lazyload/jquery.lazyload.min.js');
$js->add($FILES.'js/jarm.js');
$js->minify($FILES.'js/jarm-all.js');

$tmp = file_get_contents($FILES.'lib/bootstrap/css/bootstrap.min.css');
$css = new \MatthiasMullie\Minify\CSS();
$css->add(str_replace('../fonts/','../lib/bootstrap/fonts/',$tmp));
$css->add($FILES.'css/jarm-bootstrap.css');
$css->minify($FILES.'css/jarm-all.css');

(new Jarm\Core\Minify())
  ->clean_gz()
  ->make_gz()
  ->make_tpl();

echo 'OK';
?>
