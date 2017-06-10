<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if(isset($_POST['data']['index'])&&$_POST['data']['id']&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    $photo=Load::Photo();
    $id=$_POST['data']['id'];
    $index=$_POST['data']['index'];
    $folder=UPLOAD_FOLDER.'game/flash/'.$_POST['data']['folder'];

    if($n = $photo->thumb($id.'-'.$index,$_FILES['file']['tmp_name'],$folder,600,900,'inboth','jpg'))
    {
      $f = UPLOAD_PATH.'game/flash/'.$_POST['data']['folder'].'/'.$n;
      $s='';
      if($index==1)
      {
        $s=$photo->thumb('s',$f,$folder,100,100,'both','jpg');
        $photo->thumb('t',$f,$folder,105,80,'both','jpg');
        $photo->thumb('m',$f,$folder,300,300,'inboth','jpg');
        $photo->thumb('l',$f,$folder,180,120,'both','jpg');
      }

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
