<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Article_Upload
{
  public function __construct()
  {
  }
  public function get($parent,$id)
  {
    $db=Load::DB();
    if(!$parent->article=$db->findone('article',['_id'=>intval($id),'dd'=>['$exists'=>false]]))
    {
      die('บทความนี้ถูกลบไปแล้ว');
    }

    Load::Ajax()->register('delattach');

    if($_FILES&&is_array($_FILES['photo']['tmp_name']))
    {
      for($i=0;$i<count($_FILES['photo']['tmp_name']);$i++)
      {
        if($f=$_FILES['photo']['tmp_name'][$i])
        {
          $type='';
          $size=@getimagesize($f);
          switch (strtolower($size['mime']))
          {
            case 'image/gif':
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/png':
            case 'image/x-png':
            case 'image/wbmp':
            case 'image/bmp':
              $type='jpg';
              break;
          }
          if($type)
          {
            if($size[0]>1&&$size[1]>1)
            {
              $q=$parent->api($parent->article['sv'],'upload','@'.$f,['name'=>time().($i+1),'sv'=>$parent->article['sv'],'fd'=>$parent->article['fd'],'width'=>860,'height'=>5000,'fix'=>'inboth','type'=>$type]);
            }
          }
        }
      }
    }

    $file=[];//($serv,$method,$file,$data='',$decode=true)
    $q=$parent->api($parent->article['sv'],'list','',['_id'=>$parent->article['_id'],'sv'=>$parent->article['sv'],'fd'=>$parent->article['fd']]);
    if($q['status']=='OK')
    {
      $file=$q['data'];
    }
    $data=Load::$core
      ->assign('article',$parent->article)
      ->assign('file',$file)
      ->fetch('control/article.upload.file');
    echo Load::$core
      ->assign('getattach',$data)
      ->fetch('control/article.upload');
    exit;
  }
}
?>
