<?php

require_once __DIR__.'/door.php';


$domain=strval($_GET['domain']);
if(!in_array($domain,['jarm.com','boxza.com','autocar.in.th']))
{
  $domain='jarm.com';
}
$key = trim(str_replace(['..','//'],['','/'],$_GET['key']),'/');

$folder->folder = '/var/www/'.$domain.'/files/';

if($_GET['folder'])
{
  $folder->clean('bin/cache'.($key?'/'.$key:''));
}
elseif($key)
{
  #echo '+'.$folder->folder.'bin/cache/'.$key.'.php'.'+<br>';
  $folder->delete('bin/cache/'.$key.'.php');
}
echo 'OK';
?>
