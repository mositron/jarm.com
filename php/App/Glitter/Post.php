<?php
namespace Jarm\App\Glitter;
use Jarm\Core\Load;

class Post extends Service
{
  public function _post()
  {
    $error=[];
    Load::Session()->logged();
    $db=Load::DB();
    if($_POST)
    {
      if($f=$_FILES['o']['tmp_name'])
      {
        $_POST['detail']=trim(mb_substr(strip_tags($_POST['detail']),0,1000,'utf-8'));
        $md5 = md5_file($f);
        if(mb_strlen($_POST['detail'],'utf-8')<10)
        {
          $error['detail']='กรุณากรอกข้อความของกลิตเตอร์อย่างน้อย 10 ตัวอักษร';
        }
        elseif(count($_POST['cate'])<1)
        {
          $error['cate']='กรุณาเลือกประเภทของกลิตเตอร์';
        }
        /*elseif($db->findone('glitter',['md5'=>$md5]))
        {
          $error['o']='มีรูปนี้อยู่ในระบบแล้ว';
        }*/
        else
        {
          $picture=false;
          $size=@getimagesize($f);
          switch (strtolower($size['mime']))
          {
            case 'image/gif':
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/bmp':
            case 'image/wbmp':
            case 'image/png':
            case 'image/x-png':
              if($size[0]>=150 && $size[1]>=150)
              {
                $picture=true;
              }
              break;
          }
          if(!$picture)
          {
            $error['o']='รูปภาพมีขนาดเล็กเกินไป รูปภาพควรจะมีขนาดอย่างต่ำ 150x150';
          }
          else
          {

          }
        }
      }
      else
      {
        $error['o']='กรุณาเลือกรูปกลิตเตอร์ที่ต้องการอัพโหลด';
      }
      if(!count($error))
      {
        if($id=$db->insert('glitter',[
          'u'=>Load::$my['_id'],
          't'=>$_POST['detail'],
          'c'=>array_map('intval',$_POST['cate']),
          'ip'=>$_SERVER['REMOTE_ADDR'],
          'md5'=>$md5
        ]))
        {
          $fd = Load::Folder()->fd($id);
          $folder = substr($fd,2,2).'/'.substr($fd,4,2);

          $size=@getimagesize($f);
          $type='jpg';
          switch (strtolower($size['mime']))
          {
            case 'image/gif':
              $type='gif';
              break;
            case 'image/jpg':
            case 'image/jpeg':
            case 'image/bmp':
            case 'image/wbmp':
            case 'image/png':
            case 'image/x-png':
              break;
          }

          $sv=array_keys(Load::$conf['server']['files'])[$id % count(Load::$conf['server']['files'])];
          $q=Load::Upload()->post($sv,'glitter-post','@'.$f,['id'=>$id,'folder'=>$folder,'name'=>Load::$my['name'],'time'=>Load::Time()->from(Load::Time()->now(),'datetime')]);
      //		echo $q;
      //		exit;
          if($q['status']=='OK')
          {
            $fd = Load::Folder()->fd($id);
            $db->update('glitter',['_id'=>$id],['$set'=>['sv'=>$sv,'fd'=>$folder,'ty'=>$type,'zp'=>'glitter.jarm.com-'.$id.'.zip']]);
            Load::move('/view/'.$id);
          }
          else
          {
        //		print_r($q);
            $db->remove('glitter',['_id'=>$id]);
      //			exit;
          }
        }
        else
        {
          $error['title']='ไม่สามารถเพิ่มข้อมูลได้ ';
        }
      }
      Load::$core->assign('error',$error)
        ->assign('post',$_POST);
    }
    return Load::$core->fetch('glitter/post');
  }
}
?>
