<?php

require_once __DIR__.'/door.php';
require_once(_PHP.'Vendor/autoload.php');

$FILES=_FILES.'cdn/';

clean_gz();

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

make_gz();

echo 'OK';

function clean_gz($type='')
{
  if (!is_dir(_FILES.'cdn/'.$type)||!($dh=@opendir(_FILES.'cdn/'.$type))) return false;
  while($file=readdir($dh))
  {
    if(!in_array($file,['.','..']))
    {
      $file2=$type.'/'.$file;
      if(is_dir(_FILES.'cdn/'.$file2))
      {
        clean_gz($file2);
      }
      elseif(substr($file,-3)=='.gz')
      {
        @unlink(_FILES.'cdn/'.$file2);
      }
    }
  }
  return true;
}

function make_gz($type='')
{
  if (!is_dir(_FILES.'cdn/'.$type)||!($dh=@opendir(_FILES.'cdn/'.$type))) return false;
  while($file=readdir($dh))
  {
    if(!in_array($file,['.','..']))
    {
      $file2=$type.'/'.$file;
      if(is_dir(_FILES.'cdn/'.$file2))
      {
        make_gz($file2);
      }
      elseif(substr($file,-3)=='.js'||substr($file,-4)=='.css')
      {
        compress_gz(_FILES.'cdn/'.$file2);
      }
    }
  }
  return true;
}

function compress_gz($file,$lv=9)
{
  $to = $file.'.gz';
  $error = false;
  if($out = gzopen($to, 'wb'.$lv))
  {
    if($in = fopen($file,'rb'))
    {
      while(!feof($in))
      {
        gzwrite($out,fread($in, 1024 * 512));
      }
      fclose($in);
    }
    else
    {
      $error = true;
    }
    gzclose($out);
  }
  else
  {
    $error = true;
  }
  if($error)
  {
    return false;
  }
  else
  {
    return $to;
  }
}
?>
