<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class News_Upload
{
  public function __construct()
  {
  }
  public function get($parent,$id)
  {
    Load::Session()->logged();
    $db=Load::DB();
    if(!$parent->news=$db->findone('news',['_id'=>intval($id),'dd'=>['$exists'=>false]]))
    {
      die('ข่าวนี้ถูกลบไปแล้ว');
    //	Load::move('/');
    }
    if($parent->news['u']==Load::$my['_id'] || Load::$my['am'])
    {

    }
    else
    {
      die('ไม่มีสิทธิ์ใช้งานส่วนนี้');
    }


    if(!$parent->news['fd'])
    {
      $parent->news['fd'] = date('Y/m/').$parent->news['_id'];
      $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['fd'=>$parent->news['fd']]]);
    }
    $sv=Load::getServ($parent->news['sv']);
    if(!$parent->news['sv'])
    {
      $parent->news['sv']='f1';
      $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['sv'=>$parent->news['sv']]]);
    }
    elseif($sv!=$parent->news['sv'])
    {
      $parent->news['sv']=$sv;
      $db->update('news',['_id'=>$parent->news['_id']],['$set'=>['sv'=>$parent->news['sv']]]);
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
              $type='gif';
              break;
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
              $q=Load::Upload()->post($parent->news['sv'],'upload','@'.$f,['name'=>time().'_'.($i+1),'folder'=>'news/'.$parent->news['fd'],'width'=>860,'height'=>5000,'fix'=>'inboth','type'=>$type]);
              if($_POST['watermark'])
              {
                Load::Upload()->post($parent->news['sv'],'watermark','news/'.$parent->news['fd'].'/'.$q['data']['n'],['watermark'=>'news/watermark2.png']);
              }
            }
          }
        }
      }
    }

    $file=[];//($serv,$method,$file,$data='',$decode=true)
    $q=Load::Upload()->post($parent->news['sv'],'news-list',$parent->news['fd']);
    if($q['status']=='OK')
    {
      $file=$q['data'];
    }
    /*
    $method='news-list';
    $file2=$parent->news['fd'];
    $data='';
    $serv = Load::getServ($parent->news['sv']);
    $tmp=json_encode($data);
    $key=md5($method.'-'.$tmp);
    if(substr($file2,0,1)=='@')
    {
      $file2=new \CurlFile(substr($file2,1));
    }

    echo '----=';
    echo $json=Load::Http()()->get('http://'.Load::$conf['server']['files'][$serv].':81/'.$serv,['key'=>$key,'method'=>$method,'file'=>$file2,'data'=>$tmp]);
    echo '=----';
    print_r(['key'=>$key,'method'=>$method,'file'=>$file,'data'=>$tmp]);
    */
    $data=Load::$core
      ->assign('news',$parent->news)
      ->assign('file',$file)
      ->fetch('control/news.upload.file');
    echo Load::$core
      ->assign('getattach',$data)
      ->fetch('control/news.upload');
    exit;
  }
}
?>
