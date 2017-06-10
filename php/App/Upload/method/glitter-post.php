<?php
use Jarm\Core\Load;

if($_FILES['file'])
{
  if($_POST['data']['id']&&$_POST['data']['folder']&&$_FILES['file']['tmp_name'])
  {
    $id=$_POST['data']['id'];
    $f=$_FILES['file']['tmp_name'];
    $folder = $_POST['data']['folder'];
    Load::Folder()->mkdir(UPLOAD_FOLDER.'glitter/'.$folder);
    $size=@getimagesize($f);
    $type='jpg';
    $cmd='/usr/bin/convert '.$f;
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
      case 'image/png':
      case 'image/x-png':
        break;
    }
    exec($cmd.' -resize 100x100\> '.UPLOAD_PATH.'glitter/'.$folder.'/s.'.$type,$outs);
    exec($cmd.' -resize 200x200\> '.UPLOAD_PATH.'glitter/'.$folder.'/t.'.$type,$outt);
    exec($cmd.'  -resize 600x600\> '.UPLOAD_PATH.'glitter/'.$folder.'/l.'.$type,$outl);

    if($type=='gif')
    {
      exec('/usr/bin/convert '.UPLOAD_PATH.'glitter/'.$folder.'/l.'.$type.' -coalesce -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'glitter/watermark.png -layers composite -layers optimize '.UPLOAD_PATH.'glitter/'.$folder.'/l.'.$type);
    }
    else
    {
      exec('/usr/bin/convert '.UPLOAD_PATH.'glitter/'.$folder.'/l.'.$type.' -gravity SouthEast  -geometry +0+0 null: '.UPLOAD_PATH.'glitter/watermark.png -layers composite -layers optimize '.UPLOAD_PATH.'glitter/'.$folder.'/l.'.$type);
    }
    $zp='';
    try{
      $zip = new ZipArchive();
      $zip->open(UPLOAD_PATH.'glitter/'.$folder.'/glitter.boxza.com-'.$id.'.zip', ZipArchive::OVERWRITE);
      $zip->addFile(UPLOAD_PATH.'glitter/'.$folder.'/s.'.$type, '100x100.'.$type);
      $zip->addFile(UPLOAD_PATH.'glitter/'.$folder.'/t.'.$type, '200x200.'.$type);
      $zip->addFile(UPLOAD_PATH.'glitter/'.$folder.'/l.'.$type, '600x600.'.$type);
      $zip->addFromString('readme.txt', 'ดาวน์โหลดจาก: http://glitter.boxza.com/view/'.$id.'
โดย: '.$_POST['data']['name'].'
เมื่อ: '.$_POST['data']['time'].'

ไฟล์มี 3 ขนาดคือ
1. ไม่เกิน 100x100
2. ไม่เกิน 200x200
3. ไม่เกิน 600x600

ดาวน์โหลดกลิตเตอร์อื่นๆเพิ่มเติมได้ที่ http://glitter.boxza.com
'
      );
      $zip->close();
    } catch (Exception $e) {

    }


      $size=@getimagesize($f);
      $status=['status'=>'OK'];

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
