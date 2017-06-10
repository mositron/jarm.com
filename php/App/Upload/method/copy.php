<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if($_POST['data']['name']&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    Load::Folder()->mkdir(UPLOAD_FOLDER.$_POST['data']['folder']);
    @copy($_FILES['file']['tmp_name'],UPLOAD_PATH.$_POST['data']['folder'].'/'.$_POST['data']['name']);
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
