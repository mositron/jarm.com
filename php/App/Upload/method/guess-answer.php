<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if($_POST['data']['folder']&&$_POST['data']['name']&&$_FILES['file']['tmp_name'])
  {
    $photo=Load::Photo();
    $folder=UPLOAD_FOLDER.'guess/'.$_POST['data']['folder'];
    if($n = $photo->thumb($_POST['data']['name'],$_FILES['file']['tmp_name'],$folder,100,100,'bothtop','jpg'))
    {
      $f = UPLOAD_PATH.'guess/'.$_POST['data']['folder'].'/'.$n;
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
