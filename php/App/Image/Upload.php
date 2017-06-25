<?php
namespace Jarm\App\Image;
use Jarm\Core\Load;

class Upload extends Service
{
  public function _upload()
  {
    define('HIDE_SIDEBAR',1);
    define('HIDE_FOOTER',1);

    if($_GET['redirect_uri']&&isset($_POST['uphash']))
    {
      if(count($_FILES['upload']['tmp_name']) && is_array($_FILES['upload']['tmp_name']))
      {
        $up='';
        $format=trim(strval($_POST['format']));
        for($i=0;$i<count($_FILES['upload']['tmp_name']);$i++)
        {
          if($f=$_FILES['upload']['tmp_name'][$i])
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
              $arg=['u'=>intval(Load::$my?Load::$my['_id']:0),'n'=>$_FILES['upload']['name'][$i],'ty'=>$type,'w'=>$size[0],'h'=>$size[1],'si'=>filesize($f),'ip'=>$_SERVER['REMOTE_ADDR']];
              $arg['rd']=$_GET['redirect_uri'];
              if($p = $db->insert('image',$arg))
              {
                $fd = Load::Folder()->fd($p);
                $folder = substr($fd,0,2).'/'.substr($fd,2,2).'/'.substr($fd,4,2);
                $fd2=ltrim($fd,'0');
                $sv=array_keys(Load::$conf['server']['files'])[$p % count(Load::$conf['server']['files'])];
                $q = Load::Upload()->post($sv,'image-post','@'.$f,['folder'=>$folder,'type'=>$type]);
                if($q['status']=='OK')
                {
                  $db->update('image',['_id'=>$p],['$set'=>['f'=>$fd2,'fd'=>$folder,'sv'=>$sv]]);
                  if($format=='html')
                  {
                    $up.="\r\n".'<a href="https://image.jarm.com/v/'.$fd2.'.'.$type.'" title=""><img src="https://'.$sv.'.jarm.com/image/'.$folder.'/m.'.$type.'" border="0" alt=""></a>'."\r\n";
                  }
                  else
                  {
                    $up.="\r\n".'[url=https://image.jarm.com/v/'.$fd2.'.'.$type.'][img]https://'.$sv.'.jarm.com/image/'.$folder.'/m.'.$type.'[/img][/url]'."\r\n";
                  }
                }
                else
                {
                  $db->remove('image',['_id'=>$p]);
                }
              }
            }
          }
        }
        if($up)
        {
          Load::move($_GET['redirect_uri'].'?'.rawurlencode($up));
        }
      }
    }

    $error='';
    if(!$_GET['redirect_uri'])
    {
      $error.='คุณยังไม่กำหนดค่า redirect_uri สำหรับการส่งค่ากลับ<br>';
    }
    elseif(!preg_match('/^https?\:\/\/([a-z0-9\.]+)?(jarm|jarmcar|boxzaracing|doodroid|google|teededball|jarmfootball|autocar)\.(.*)$/',$_GET['redirect_uri']))
    {
      $error.='ปิดให้บริการสำหรับเว็บภายนอกชั่วคราว<br>';
    }
    return Load::$core
      ->assign('error',$error)
      ->fetch('image/upload');
  }
}
?>
