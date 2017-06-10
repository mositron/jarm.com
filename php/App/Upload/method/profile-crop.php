<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  $file=UPLOAD_PATH.'profile/'.$_POST['file'].'/o.jpg';
  if(file_exists($file)&&is_array($_POST['data']))
  {
    $img_r = imagecreatefromjpeg($file);
    $dst_r = imagecreatetruecolor(50,50);
    imagecopyresampled($dst_r,$img_r,0,0,$_POST['data']['x'],$_POST['data']['y'],50,50,$_POST['data']['w'],$_POST['data']['h']);
    imagejpeg($dst_r,UPLOAD_PATH.'profile/'.$_POST['file'].'/s.jpg',90);
    imagedestroy($dst_r);
    $dst_r = imagecreatetruecolor(200,200);
    imagecopyresampled($dst_r,$img_r,0,0,$_POST['data']['x'],$_POST['data']['y'],200,200,$_POST['data']['w'],$_POST['data']['h']);
    imagejpeg($dst_r,UPLOAD_PATH.'profile/'.$_POST['file'].'/n.jpg',90);
    imagedestroy($dst_r);

    $status=['status'=>'OK'];
  }
  elseif(!$_POST['data'])
  {
    $error='no data';
  }
  else
  {
    $error='file not found';
  }
}
?>
