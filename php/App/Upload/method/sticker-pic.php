<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if($_POST['data']['n']&&$_POST['data']['fd']&&$_FILES['file']['tmp_name'])
  {
    $id=$_POST['data']['n'];
    $f=$_FILES['file']['tmp_name'];
    $folder = $_POST['data']['fd'];
    Load::Folder()->mkdir(UPLOAD_FOLDER.'sticker/icon/'.$folder);
    $size=@getimagesize($f);
    $type='png';
    $cmd='/usr/bin/convert '.$f;
    $copy=false;
    switch (strtolower($size['mime']))
    {
      case 'image/gif':
        $type='gif';
        $cmd.=' -coalesce';
        break;
      case 'image/jpg':
      case 'image/jpeg':
      case 'image/bmp':
      case 'image/wbmp':
        break;
      case 'image/png':
      case 'image/x-png':
        $copy=true;
        break;
    }

    $png=$id.'.png';
    if($copy&&$size[0]<=200&&$size[1]<=200)
    {
      @copy($f,UPLOAD_PATH.'sticker/icon/'.$folder.'/'.$png);
    }
    elseif($copy)
    {
      exec($cmd.' -resize 200x200\> '.UPLOAD_PATH.'sticker/icon/'.$folder.'/'.$png);
    }
    else
    {
      Load::Photo()->thumb($id,$f,UPLOAD_FOLDER.'sticker/icon/'.$folder,200,200,'inboth','png');
    }
    //exec($cmd.($type=='gif'?'-strip ':'').$f.' -background transparent -resize 100x100\> '.UPLOAD_PATH.'sticker/'.$folder.'/'.$id.'1.png',$outs);
    $gif='';
    if($type=='gif')
    {
      $gif=$id.'.gif';
      exec($cmd.' -resize 200x200\> '.UPLOAD_PATH.'sticker/icon/'.$folder.'/'.$gif,$outs);
    }

    $size=@getimagesize(UPLOAD_PATH.'sticker/icon/'.$folder.'/'.$png);
    $status=['status'=>'OK','data'=>['ty'=>$type,'n'=>$id,'png'=>$png,'gif'=>$gif,'w'=>$size[0],'h'=>$size[1],'f'=>$_POST['data']['f'],'fd'=>$folder]];

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
