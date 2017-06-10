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
        case 'delete':
        case 'fromstring':
        case 'getsize':
        case 'rotate':
        case 'upload':
        case 'thumb':

        case 'profile-crop':
        case 'profile-gif':
        case 'profile-reset':
        case 'profile-remove':

        case 'image-post':
        case 'image-clear':

        case 'forum-post':

        case 'news-post':
        case 'news-list':
        case 'news-facebook':
        case 'news-delete':

        case 'drama-post':
        case 'drama-list':

        case 'game-post':

        case 'movie-post':
        case 'movie-wallpaper':

        case 'football-team':
        case 'football-banner':

        case 'euro-team':

        case 'gift-upload':

        case 'glitter-post':

        case 'guess-post':
        case 'guess-answer':

        case 'sticker-post':
        case 'sticker-pic':
        case 'sticker-del':
        case 'sticker-clean':

        case 'watermark':
        case 'ads-upload':
        case 'banner-upload':

        case 'fbimage':

          $_POST['data']=json_decode($_POST['data'],true);
          require_once(__DIR__.'/method/'.$_POST['method'].'.php');
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
