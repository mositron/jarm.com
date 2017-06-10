<?php
use Jarm\Core\Load;

if($_POST['file'])
{
  copy(UPLOAD_PATH.'profile/default/s.jpg',UPLOAD_PATH.'profile/'.$_POST['file'].'/s.jpg');
  copy(UPLOAD_PATH.'profile/default/n.jpg',UPLOAD_PATH.'profile/'.$_POST['file'].'/n.jpg');
  $status=['status'=>'OK'];
}
?>
