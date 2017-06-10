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
        if(preg_match("/([a-zA-Z0-9_\-]+)(\.jpg)$/iU",$dir,$path)&&!in_array($dir,['s.jpg','t.jpg','m.jpg']))
        {
          array_push($icon,$path[1].'.jpg');
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
