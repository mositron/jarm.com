<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  $f=false;
  $log=[];
  $path=explode('/', $_POST['file']);
  if(count($path)>1) // secure check
  {
    $path=UPLOAD_PATH.$_POST['file'];
    if(is_dir($path))
    {
      Load::Folder()->clean(UPLOAD_FOLDER.$_POST['file']);
      $status=['status'=>'OK','data'=>[]];
    }
    else
    {
      $error='folder not found';
    }
  }
  else
  {
    $error='invalid folder';
  }
}
else
{
  $error='no folder';
}


?>
