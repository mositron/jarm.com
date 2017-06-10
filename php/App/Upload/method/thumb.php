<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  if($_POST['data']['name']&&$_POST['data']['folder']&&$_POST['data']['width']&&$_POST['data']['height']&&$_POST['data']['fix']&&$_POST['data']['type'])
  {
    $f=UPLOAD_PATH.$_POST['file'];
    if(file_exists($f))
    {
      Load::Photo()->thumb($_POST['data']['name'],$f,UPLOAD_FOLDER.$_POST['data']['folder'],$_POST['data']['width'],$_POST['data']['height'],$_POST['data']['fix'],$_POST['data']['type']);
      $status=['status'=>'OK'];
    }
    else
    {
      $error='file not exists';
    }
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
