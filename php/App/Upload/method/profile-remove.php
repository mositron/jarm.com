<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  $f=false;
  $log=[];
  if(mb_strlen($_POST['file'],'utf-8')==8)
  {
    $path=UPLOAD_PATH.'profile/'.$_POST['file'];
    if(is_dir($path))
    {
      Load::Folder()->clean(UPLOAD_FOLDER.'profile/'.$_POST['file']);
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
