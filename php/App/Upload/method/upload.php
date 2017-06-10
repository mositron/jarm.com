<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if($_POST['data']['name']&&$_POST['data']['type']&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    if($_POST['data']['type']=='gif')
    {
      Load::Folder()->mkdir(UPLOAD_FOLDER.$_POST['data']['folder']);
      $cmd='/usr/bin/convert '.$_FILES['file']['tmp_name'].' -coalesce';
      $n=$_POST['data']['name'].'.gif';
      $f = UPLOAD_PATH.$_POST['data']['folder'].'/'.$n;
      exec($cmd.' -resize '.$_POST['data']['width'].'x'.$_POST['data']['height'].'\> '.$f,$outs);
      $size=@getimagesize($f);
      $status=['status'=>'OK','data'=>['n'=>$n,'w'=>$size[0],'h'=>$size[1],'s'=>filesize($f)]];
    }
    else
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
