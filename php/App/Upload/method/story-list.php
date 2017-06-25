<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  $tmp=UPLOAD_PATH.'story/'.$_POST['file'].'/';
  $icon=[];
  if(is_dir($tmp))
  {
    if($dh=opendir($tmp))
    {
      while(($dir=readdir($dh))!==false)
      {
        if(preg_match("/([a-zA-Z0-9_\-]+)\.(jpg|gif)$/iU",$dir,$path))
        {
          array_push($icon,$path[1].'.'.$path[2]);
        }
      }
      closedir($dh);
    }
  }
  rsort($icon);
  $status=['status'=>'OK','data'=>$icon];
}
else
{
  $error='file not found';
}

?>
