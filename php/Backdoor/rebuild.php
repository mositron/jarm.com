<?php

require_once __DIR__.'/door.php';
require_once(_PHP.'Vendor/autoload.php');

$FILES=_FILES.'cdn/';
$act = isset($_GET['act'])?$_GET['act']:'';
$minify = new Jarm\Core\Minify();

if($act=='copy'||$act=='all')
{
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
  echo 'copy - OK<br>';
}
if($act=='minify'||$act=='all')
{
  $js = new \MatthiasMullie\Minify\JS();
  $js->add($FILES.'js/jquery/jquery.min.js');
  $js->add($FILES.'js/bootstrap/js/bootstrap.min.js');
  $js->add($FILES.'js/lazyload/jquery.lazyload.min.js');
  $js->add($FILES.'js/jarm.js');
  $js->minify($FILES.'js/jarm-all.js');

  $css = new \MatthiasMullie\Minify\CSS();
  $css->add($FILES.'js/bootstrap/css/bootstrap.min.css');
  $css->add($FILES.'css/jarm-bootstrap.css');
  $css->minify($FILES.'css/jarm-all.css');
  $minify
    ->clean_gz()
    ->make_gz();
    echo 'minify - OK<br>';
}
if($act=='tpl'||$act=='all')
{
  $minify->make_tpl();
  echo 'tpl - OK<br>';
}
?>
