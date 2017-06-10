<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  if($_POST['data']['string']&&$_POST['data']['ext'])
  {
    $f=UPLOAD_PATH.$_POST['file'];
    if(file_exists($f))
    {
      if($img = base64_decode($_POST['data']['string']))
      {
        $im = @imagecreatefromstring($img);
        if ($im !== false)
        {
          if($_POST['data']['ext']=='png')
          {
            @imagepng($im, $f, 0);
          }
          elseif($_POST['data']['ext']=='jpg')
          {
            @imagejpeg($im, $f, 90);
          }
          elseif($_POST['data']['ext']=='gif')
          {
            @imagegif($im, $f);
          }
          $status=['status'=>'OK'];
        }
        else
        {
          $error='no image';
        }
      }
      else
      {
        $error='string cant decode';
      }
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
