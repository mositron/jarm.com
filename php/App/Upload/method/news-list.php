<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  $tmp=UPLOAD_PATH.'news/'.$_POST['file'].'/';
  $icon=[];
  if(is_dir($tmp))
  {
    if($dh=opendir($tmp))
    {
      while(($dir=readdir($dh))!==false)
      {
        if(preg_match("/([a-zA-Z0-9_\-]+)\.(jpg|gif)$/iU",$dir,$path)&&!in_array($dir,['s.jpg','t.jpg']))
        {
          $file=['n'=>$path[1].'.'.$path[2]];
          $size=getimagesize($tmp.$file['n']);
          $file['w']=$size[0];
          $file['h']=$size[1];
          array_push($icon,$file);
        }
      }
      closedir($dh);
    }
  }
  $status=['status'=>'OK','data'=>$icon];
}
else
{
  $error='file not found';
}

?>
