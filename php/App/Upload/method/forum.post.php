<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if(isset($_POST['data']['index'])&&isset($_POST['data']['size'])&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    if($n = Load::Photo()->thumb($_POST['data']['name'],$_FILES['file']['tmp_name'],UPLOAD_FOLDER.$_POST['data']['folder'],$_POST['data']['width'],$_POST['data']['height'],$_POST['data']['fix'],$_POST['data']['type']))
    {
      $f = UPLOAD_PATH.$_POST['data']['folder'].'/'.$n;
      $size=@getimagesize($f);
      $status=['status'=>'OK','data'=>['n'=>$n,'w'=>$size[0],'h'=>$size[1],'s'=>filesize($f)]];
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
