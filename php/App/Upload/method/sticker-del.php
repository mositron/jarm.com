<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  $f=UPLOAD_PATH.'sticker/icon/'.$_POST['file'].'/';
  if($_POST['data']['png'])
  {
    $png=$f.$_POST['data']['png'];
    if(file_exists($png))
    {
      unlink($png);
    }
  }
  if($_POST['data']['gif'])
  {
    $png=$f.$_POST['data']['gif'];
    if(file_exists($png))
    {
      unlink($png);
    }
  }
  $status=['status'=>'OK'];
}
?>
