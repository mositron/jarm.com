<?php

require_once __DIR__.'/door.php';
require_once(_PHP.'Vendor/autoload.php');

$FILES=_FILES.'cdn/';

$lib = ["components/jquery","components/bootstrap","tinymce/tinymce","nnnick/chartjs"];
foreach($lib as $v)
{
  if(is_dir($dir = _PHP.'Vendor/'.$v))
  {
    $k = explode('/',$v);
    shell_exec('cp -r '.$dir.' '.$FILES.'js');
  }
  else
  {
    echo $dir.' - not exists <br>';
  }
}

$js = new \MatthiasMullie\Minify\JS();
$js->add($FILES.'js/jquery/jquery.min.js');
$js->add($FILES.'js/bootstrap/js/bootstrap.min.js');
$js->add($FILES.'js/lazyload/jquery.lazyload.min.js');
$js->add($FILES.'js/jarm.js');
$js->minify($FILES.'js/jarm-all.js');

$tmp = file_get_contents($FILES.'js/bootstrap/css/bootstrap.min.css');
$css = new \MatthiasMullie\Minify\CSS();
$css->add(str_replace('../fonts/','../js/bootstrap/fonts/',$tmp));
$css->add($FILES.'css/jarm-bootstrap.css');
$css->minify($FILES.'css/jarm-all.css');

(new Jarm\Core\Minify())
  ->clean_gz()
  ->make_gz()
  ->make_tpl();

echo 'OK';
?>
