<?php
namespace Jarm\App\Upload;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {

  }

  public function _f1()
  {
    $this->server();
  }
  public function _f2()
  {
    $this->server();
  }
  private function server()
  {
    $error=false;
    $status =['status'=>'FAIL','message'=>'รหัสไม่ถูกต้อง'];
    if($_POST['key']==md5($_POST['method'].Load::$conf['upload']['key'].$_POST['data']))
    {
      define('UPLOAD_FOLDER','upload/');
      define('UPLOAD_PATH',_FILES.UPLOAD_FOLDER);
      $status['message']='ข้อมูลไม่ถูกต้อง';
      switch($_POST['method'])
      {
        case 'copy':
        case 'list':
        case 'fromstring':
        case 'getsize':
        case 'rotate':
        case 'upload':
        case 'thumb':
        case 'watermark':
        case 'delete':
        case 'clean':

        case 'profile-crop':
        case 'profile-gif':
        case 'profile-reset':
        case 'profile-remove':

        case 'image-post':
        case 'image-clear':

        case 'news-post':
        case 'news-list':
        case 'news-facebook':
        case 'news-delete':

        case 'glitter-post':

        case 'guess-post':
        case 'guess-answer':

        case 'ads-upload':
        case 'banner-upload':

        case 'fbimage':

        case 'story-list':
        case 'story-delete':

          $_POST['data']=json_decode($_POST['data'],true);
          require_once(__DIR__.'/Method/'.$_POST['method'].'.php');
          break;
      }
    }
    if($error)
    {
      $status['message']=$error;
    }
    header('Content-type: application/json');
    echo json_encode($status);
    exit;
  }
}

?>
