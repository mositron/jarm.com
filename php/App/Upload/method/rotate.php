<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  if($_POST['data']['rotate']&&$_POST['data']['ext'])
  {
    $f=UPLOAD_PATH.$_POST['file'];
    if(file_exists($f))
    {
      switch($_POST['data']['ext'])
      {
        case 'gif':
          $image = @imagecreatefromgif($f);
          $img = imagerotate($image, $_POST['data']['rotate'], 0);
          imagegif($img, $f);
          break;
        case 'jpg':
          $image = @imagecreatefromjpeg($f);
          $img = imagerotate($image, $_POST['data']['rotate'], 0);
          imagejpeg($img, $f, 90);
          break;
        case 'png':
          $image = @imagecreatefrompng($f);
          $img = imagerotate($image, $_POST['data']['rotate'], 0);
          imagepng($img, $f, 0);
          break;
      }
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
