<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if($_POST['data']['type']&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    $folder = $_POST['data']['folder'];
    $cmd='/usr/bin/convert '.$_FILES['file']['tmp_name'];


    $type=false;
    $quality='';
    switch($_POST['data']['type'])
    {
      case 'gif':
        $type='gif';
        $cmd.=' -coalesce';
        break;
      case 'jpg':
        $type='jpg';
        $quality=' -quality 90';
        break;
      case 'png':
        $type='png';
        break;
    }
    if($type)
    {
      Load::Folder()->mkdir(UPLOAD_FOLDER.'image/'.$folder);

      exec($cmd.' -resize 200x200\>'.$quality.' '.UPLOAD_PATH.'image/'.$folder.'/s.'.$type,$outt);
      exec($cmd.' -resize 600x10240\>'.$quality.' '.UPLOAD_PATH.'image/'.$folder.'/m.'.$type,$outl);
      exec($cmd.$quality.' '.UPLOAD_PATH.'image/'.$folder.'/o.'.$type,$outl);

      /*
      $cmd = '/usr/bin/convert '.UPLOAD_PATH.'image/'.$folder.'/';
      if($type=='jpg')
      {
        exec($cmd.'s.'.$type.' -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'image/watermark2.gif -layers composite -quality 90 '.UPLOAD_PATH.'image/'.$folder.'/s.'.$type);
        exec($cmd.'m.'.$type.' -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'image/watermark2.png -layers composite -quality 90 '.UPLOAD_PATH.'image/'.$folder.'/m.'.$type);
        exec($cmd.'o.'.$type.' -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'image/watermark2.png -layers composite -quality 90 '.UPLOAD_PATH.'image/'.$folder.'/o.'.$type);
      }
      elseif($type=='gif')
      {
        exec($cmd.'s.'.$type.' -coalesce -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'image/watermark2.gif -layers composite -layers optimize '.UPLOAD_PATH.'image/'.$folder.'/s.'.$type);
        exec($cmd.'m.'.$type.' -coalesce -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'image/watermark2.png -layers composite -layers optimize '.UPLOAD_PATH.'image/'.$folder.'/m.'.$type);
        exec($cmd.'o.'.$type.' -coalesce -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'image/watermark2.png -layers composite -layers optimize '.UPLOAD_PATH.'image/'.$folder.'/o.'.$type);
      }
      else
      {
        exec($cmd.'s.'.$type.' -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'image/watermark2.gif -layers composite -layers optimize '.UPLOAD_PATH.'image/'.$folder.'/s.'.$type);
        exec($cmd.'m.'.$type.' -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'image/watermark2.png -layers composite -layers optimize '.UPLOAD_PATH.'image/'.$folder.'/m.'.$type);
        exec($cmd.'o.'.$type.' -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'image/watermark2.png -layers composite -layers optimize '.UPLOAD_PATH.'image/'.$folder.'/o.'.$type);
      }
      */
      $f = UPLOAD_PATH.'image/'.$folder.'/o.'.$type;
      $size=@getimagesize($f);
      $status=['status'=>'OK','data'=>['w'=>$size[0],'h'=>$size[1],'s'=>filesize($f)]];
    }
    else
    {
      $error = 'ประเภทไฟล์ไม่ถูกต้อง';
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
