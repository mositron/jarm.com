<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  $tmp=UPLOAD_PATH.'story/'.$_POST['file'].'/';
  $file=[];
  if(is_dir($tmp))
  {
    if($dh=opendir($tmp))
    {
      while(($dir=readdir($dh))!==false)
      {
        if(!in_array($dir,['.','..']))
        {
          array_push($file,['name'=>$dir,'type'=>is_dir($tmp.$dir)?'dir':'file']);
        }
      }
      closedir($dh);
    }
  }
  $status=['status'=>'OK','data'=>$file];
}
else
{
  $error='file not found';
}

?>
