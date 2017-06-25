<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  $f=false;
  $log=[];
  if(mb_strlen($_POST['file'],'utf-8')>8) // 2017/07/1
  {
    $path=UPLOAD_PATH.'story/'.$_POST['file'];
    if(is_dir($path))
    {
      Load::Folder()->clean(UPLOAD_FOLDER.'story/'.$_POST['file']);
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
