<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if($_POST['data']['name']&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    $f=$_FILES['file']['tmp_name'];
    $name=$_POST['data']['name'];
    $folder=UPLOAD_FOLDER.'ads/'.$_POST['data']['folder'];

    $size=@getimagesize($f);
    $type='swf';
    switch (strtolower($size['mime']))
    {
      case 'image/gif':
        $type='gif';
        break;
      case 'image/jpg':
      case 'image/jpeg':
        $type='jpg';
        break;
      case 'image/png':
      case 'image/x-png':
        $type='jpg';
        break;
    }

    $n=false;
    Load::Folder()->mkdir($folder);

    if($type=='swf')
    {
      $type='';
    }
    else
    {
      $width=$size[0];
      $height=$size[1];
      $n=$name.'.'.$type;
    }

    if($n)
    {
      if(in_array($type,['gif','jpg','png'])&&$_POST['data']['size'])
      {
        $cmd='/usr/bin/convert '.$f;
        if($type=='gif')
        {
            $cmd.=' -coalesce';
        }
        $sz=$_POST['data']['size'][0].'x'.$_POST['data']['size'][1];
        exec($cmd.' -resize '.$sz.'^ -gravity center -extent '.$sz.' '._FILES.$folder.'/'.$n,$outs);

        $size=@getimagesize(_FILES.$folder.'/'.$n);
        $width=$size[0];
        $height=$size[1];
      }
      else
      {
        @copy($f,_FILES.$folder.'/'.$n);
      }
      $status=['status'=>'OK','data'=>['n'=>$n,'ex'=>$type,'w'=>$width,'h'=>$height]];
    }
    else
    {
      $error='invalid type';
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
