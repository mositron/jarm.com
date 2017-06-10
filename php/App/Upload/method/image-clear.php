<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  Load::Folder()->clean(UPLOAD_FOLDER.'image/'.$_POST['file']);
  $status=['status'=>'OK'];
}
?>
