<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if($_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    $photo=Load::Photo();
    $folder=UPLOAD_FOLDER.'news/'.$_POST['data']['folder'];
    if($n = $photo->thumb('fb',$_FILES['file']['tmp_name'],$folder,500,500,'inboth','jpg'))
    {
      $f = UPLOAD_PATH.'news/'.$_POST['data']['folder'].'/'.$n;
      $size=@getimagesize($f);
      $status=['status'=>'OK','data'=>['n'=>$n,'w'=>$size[0],'h'=>$size[1]]];
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
