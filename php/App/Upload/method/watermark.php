<?php
use Jarm\Core\Load;

if($_POST['file']&&$_POST['data']['watermark'])
{
  $f=UPLOAD_PATH.$_POST['file'];
  $w=UPLOAD_PATH.$_POST['data']['watermark'];
  if(file_exists($f)&&file_exists($w))
  {
    exec('/usr/bin/convert '.$f.' -gravity SouthEast  -geometry +0+0 null: '.$w.' -layers composite -quality 90 '.$f);
  }
  $status=['status'=>'OK'];
}
?>
