<?php
namespace Jarm\App\Image;
use Jarm\Core\Load;

class Home extends Service
{
  public function get_home()
  {
    Load::$core->assign('image',Load::DB()->find('image',['dd'=>['$exists'=>false]],['_id'=>1,'ty'=>1,'fd'=>1,'f'=>1,'sv'=>1],['sort'=>['_id'=>-1],'limit'=>100]));
    Load::$core->data['content']=Load::$core->fetch('image/home');
  }

  public function post_home()
  {
    Load::Ajax()->register('sendreport');
    if(isset($_FILES['file_post']))
    {
      die('ปิดใช้งานชั่วคราว');
      $status =['status'=>'FAIL','message'=>'เกิดปัญหาในการอัพโหลด'];
      if($_FILES['file_post']['tmp_name'] && $_POST['sesimage'])
      {
        list($s,$p) = explode('.', $_POST['sesimage'], 2);
        $sig = base64_decode(strtr($s, '-_', '+/'));
        $data = json_decode(base64_decode(strtr($p, '-_', '+/')), true);

        if($sig == hash_hmac('sha256', $p, $data['sesimage'].'-up-image-'.$data['uid'], true))
        {
          if($f=$_FILES['file_post']['tmp_name'])
          {
            $size=@getimagesize($f);
            $type=false;
            switch(strtolower($size['mime']))
            {
              case 'image/gif':
                $type='gif';
                break;
              case 'image/jpg':
              case 'image/jpeg':
                $type='jpg';
                break;
              case 'image/png':
              case 'image/x-png':
                $type='png';
                break;
            }
            if($type && $size[0]>=1 && $size[1]>=1)
            {
              $db=Load::DB();
              if($p = $db->insert('image',['u'=>intval($data['uid']),'n'=>$_FILES['file_post']['name'],'ty'=>$type,'s'=>$data['sesimage'],'w'=>$size[0],'h'=>$size[1],'si'=>filesize($f),'ip'=>$_SERVER['REMOTE_ADDR']]))
              {
                $fd = Load::Folder()->fd($p);
                $folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
                $fd2=ltrim($fd,'0');
                $sv=array_keys(Load::$conf['server']['files'])[$p % count(Load::$conf['server']['files'])];
                $q = Load::Upload()->post($sv,'image-post','@'.$f,['folder'=>$folder,'type'=>$type]);
                if($q['status']=='OK')
                {
                  $db->update('image',['_id'=>$p],['$set'=>['f'=>$fd2,'fd'=>$folder,'sv'=>$sv]]);
                  $status =['status'=>'OK','message'=>'','folder'=>$folder,'fd'=>$fd2,'type'=>$type,'sv'=>$sv];
                }
                else
                {
                  $db->remove('image',['_id'=>$p]);
                  $status['message'] = print_r($q,true);
                }
              }
            }
            else
            {
              $status['message'] = 'ไฟล์ไม่ถูกต้อง';
            }
          }
        }
      }
      echo json_encode($status);
    }
    exit;
  }

  public function sendreport($arg)
  {
    $db=Load::DB();
    $ajax=Load::Ajax();

    if($f=$db->findone('image',['_id'=>intval($arg['image'])]))
    {
       if(Load::$my && ((Load::$my['_id']==$f['u'])||(Load::$my['am'] &&Load::$my['am']>0)))
       {
         if($f['fd']&& strlen($f['fd'])==8)
         {
           $q=Load::Upload()->post('s2','image-clear',$f['fd']);
           if($q['status']=='OK')
           {
             $db->update('image',['_id'=>$f['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
             $ajax->alert('ลบรูปภาพเรียบร้อยแล้ว');
           }
           else
           {
             $ajax->alert('การอ้างอิงไฟล์มีปัญหา กรุณาลองใหม่ภายหลัง - '.print_r($q,true));
           }
         }
         else
         {
           $ajax->alert('ตำแหน่งรูปภาพไม่ถูกต้อง');
         }
       }
       else
       {
         $db->update('image',['_id'=>$f['_id']],['$set'=>['sp'=>intval($f['sp'])+1,'dr'=>Load::Time()->now()]]);
         $ajax->alert('รายงานรปภาพนี้เรียบร้อยแล้ว');
       }
    }
  }
}
?>
