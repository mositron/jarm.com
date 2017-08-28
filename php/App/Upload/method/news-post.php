<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if($_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    $photo=Load::Photo();
    $folder=UPLOAD_FOLDER.'news/'.$_POST['data']['folder'];
    if($n = $photo->thumb('m',$_FILES['file']['tmp_name'],$folder,1024,1024,'width','jpg'))
    {
      //750x500
      $f = UPLOAD_PATH.'news/'.$_POST['data']['folder'].'/'.$n;
      $photo->thumb('s',$f,$folder,150,100,'bothtop','jpg');
      $fs = UPLOAD_PATH.'news/'.$_POST['data']['folder'].'/s.jpg';
      $photo->thumb('t',$f,$folder,330,220,'bothtop','jpg');
      $ft = UPLOAD_PATH.'news/'.$_POST['data']['folder'].'/t.jpg';
      exec('/usr/bin/convert -strip -interlace Plane -sampling-factor 4:2:0 -define jpeg:dct-method=float -quality 85% '.$f.' '.$f);
      exec('/usr/bin/convert -strip -interlace Plane -sampling-factor 4:2:0 -define jpeg:dct-method=float -quality 85% '.$ft.' '.$ft);
      exec('/usr/bin/convert -strip -interlace Plane -sampling-factor 4:2:0 -define jpeg:dct-method=float -quality 85% '.$fs.' '.$fs);
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
