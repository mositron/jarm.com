<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if($_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    exec('/usr/bin/convert '.$_FILES['file']['tmp_name'].' -coalesce -resize 50x50^ -gravity center -extent 50x50 '.UPLOAD_PATH.'profile/'.$_POST['data']['folder'].'/s.gif');
    exec('/usr/bin/convert '.$_FILES['file']['tmp_name'].' -coalesce -resize 200x200^ -gravity center -extent 200x200 '.UPLOAD_PATH.'profile/'.$_POST['data']['folder'].'/n.gif');
    $status=['status'=>'OK'];
  }
  else
  {
    $error='no data';
  }
}
else
{
  $error='file not found';
}

?>
