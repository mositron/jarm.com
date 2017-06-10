<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if(isset($_POST['data']['index'])&&isset($_POST['data']['size'])&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    $photo=Load::Photo();
    $index=$_POST['data']['index'];
    $size=$_POST['data']['size'];
    $folder=UPLOAD_FOLDER.'forum/'.$_POST['data']['folder'];
    if($n = $photo->thumb('t-'.$index,$_FILES['file']['tmp_name'],$folder,$size['t2'][0],$size['t2'][1],'inboth','jpg'))
    {
      $f = UPLOAD_PATH.'forum/'.$_POST['data']['folder'].'/'.$n;

      $s='';
      if($index==1)
      {
        $s=$photo->thumb('s',$f,$folder,$size['s'][0],$size['s'][1],'both','jpg');
        $photo->thumb('t',$f,$folder,$size['t'][0],$size['t'][1],'both','jpg');
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
