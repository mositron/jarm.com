<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if(isset($_POST['data']['index'])&&$_POST['data']['id']&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    $photo=Load::Photo();
    $id=$_POST['data']['id'];
    $index=$_POST['data']['index'];
    $folder=UPLOAD_FOLDER.'movie/'.$_POST['data']['folder'];
    if($n = $photo->thumb($id.'-w-'.$index,$_FILES['file']['tmp_name'],$folder,2560,2560,'inboth','jpg'))
    {
      $f = UPLOAD_PATH.'movie/'.$_POST['data']['folder'].'/'.$n;
      $s=$photo->thumb('s-'.$id.'-w-'.$index,$f,$folder,180,110,'both','jpg');

      $size=@getimagesize($f);
      $status=['status'=>'OK','data'=>['n'=>$n,'s'=>$s,'w'=>$size[0],'h'=>$size[1]]];
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
