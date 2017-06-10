<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Friend extends Service
{
  public function get_friend()
  {
    $serv=[
      'get_friend'=>'json_recent',
      'get_girl'=>'json_recent',
      'get_boy'=>'json_recent',
      'get_gay'=>'json_recent',
      'get_lesbian'=>'json_recent',
      'get_ladyboy'=>'json_recent',
      'get_view'=>'json_view',
      'get_apps'=>'get_apps',
    ];
    if(isset($_GET['json'])&&isset($serv[$_GET['json']]))
    {
      $this->{$serv[$_GET['json']]}();
    }
    exit;
  }

  public function post_friend()
  {
    if(Load::$path[1]&&in_array(Load::$path[1],['insert','reply','delete']))
    {
      $this->{'post_'.Load::$path[1]}();
    }
    exit;
  }

  public function post_insert()
  {
    $key = $_POST['key'];
    if($_POST['fb_id'])
    {
      $Facebook = true;
      $fb_name = mb_substr(trim($_POST['fb_name']),0,50,'utf-8');
      if(!$fb_name)
      {
        exit;
      }
      $fb_id = trim($_POST['fb_id']);
      if(!is_numeric($fb_id))
      {
        exit;
      }
    }
    else
    {
      $Facebook = false;
      $name = mb_substr(trim($_POST['name']),0,50,'utf-8');
      if(!$name)
      {
        exit;
      }
      $email = mb_substr(trim($_POST['email']),0,100,'utf-8');
      if(!$email)
      {
        exit;
      }
      $gid = trim($_POST['gid']);
      if(!is_numeric($gid))
      {
        exit;
      }
      $photo = trim($_POST['photo']);
      if(substr($photo,0,4)!='http')
      {
        exit;
      }
    }
    $province = intval($_POST['province']);
    if($province<1||$province>77)
    {
      exit;
    }
    $type = $_POST['type'];
    if(!in_array($type,['girl','boy','lesbian','ladyboy','gay']))
    {
      exit;
    }
    $age = intval($_POST['age']);
    if($age<13)
    {
      exit;
    }
    $msg = mb_substr(trim($_POST['msg']),0,200,'utf-8');
    if(!$msg)
    {
      exit;
    }

    $replace=[
      '1'=>['1','๑','หนึ่ง'],
      '2'=>['2','๒','สอง'],
      '3'=>['3','๓','สาม'],
      '4'=>['4','๔','สี่'],
      '5'=>['5','๕','ห้า'],
      '6'=>['6','๖','หก'],
      '7'=>['7','๗','เจ็ด'],
      '8'=>['8','๘','แปด'],
      '9'=>['9','๙','เก้า'],
      '0'=>['0','๐','ศูนย์']
    ];

    $tmp='';
    for($i=0;$i<mb_strlen($msg,'utf-8');$i++)
    {
      $x=mb_substr($msg,$i,1,'utf-8');
      if(isset($replace[$x]))
      {
        $tmp .= ''.$this->random_no($replace[$x]).'';
      }
      else
      {
        $tmp.=$x;
      }
    }
    $msg=str_replace(['เลีย','หี','หอย','ดูด','โฟน','ไอ้สัตว์','ไอ้','น้ำแตก','เงี่ยน','ควย','เย็ด','หำ','เงียน','เหงี่ยน','เสียว','เยด','คันหี','เลียหี','สัส','สาส','เหี้ย','เซ็ก','รับงาน'],'***',$tmp);

    if($data = $this->decrypt($key))
    {
      list($gg_id,$android_id) = explode('#',$data,2);
      if($gg_id==$gid || $gg_id==$fb_id)
      {
        if($Facebook)
        {
          $arg = [
            'fb_id'=>$fb_id,
            'fb_name'=>$fb_name,
            'ty'=>$type,
            'ms'=>$msg,
            'pr'=>$province,
            'ag'=>$age,
            'ds'=>Load::Time()->now(),
            'dv'=>$android_id,
            'ip'=>$_SERVER['REMOTE_ADDR']
            ];
        }
        else
        {
          $arg = [
            'gg'=>[
              'n'=>$name,
              'ph'=>$photo,
              'em'=>$email,
              'id'=>$gid
            ],
            'ty'=>$type,
            'ms'=>$msg,
            'pr'=>$province,
            'ag'=>$age,
            'ds'=>Load::Time()->now(),
            'dv'=>$android_id,
            'ip'=>$_SERVER['REMOTE_ADDR']
          ];
        }
        $db=Load::DB();
        $db->insert('appfriend',$arg);
        if($old=$db->find('appfriend',['dv'=>$android_id,'dd'=>['$exists'=>false],'da'=>['$gte'=>Load::Time()->now(-3600)]],['_id'=>1],['sort'=>['_id'=>-1]]))
        {
          if(count($old)>3)
          {
            for($i=3;$i<count($old);$i++)
            {
              $db->update('appfriend',['_id'=>$old[$i]['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
            }
          }
        }
      }

      $rs=[
        'status'=>'ok'
      ];
      if($_GET['callback'])
      {
        header('Content-type: text/javascript');
        echo $_GET['callback'].'('.json_encode($rs).')';
      }
      else
      {
        header('Content-type: application/json');
        echo json_encode($rs);
      }
    }
    exit;
  }

  public function post_reply()
  {
    $key = $_POST['key'];
    if($_POST['fb_id'])
    {
      $Facebook = true;
      $fb_name = mb_substr(trim($_POST['fb_name']),0,50,'utf-8');
      if(!$fb_name)
      {
        exit;
      }
      $fb_id = trim($_POST['fb_id']);
      if(!is_numeric($fb_id))
      {
        exit;
      }
    }
    else
    {
      $Facebook = false;
      $name = mb_substr(trim($_POST['name']),0,50,'utf-8');
      if(!$name)
      {
        exit;
      }
      $email = mb_substr(trim($_POST['email']),0,100,'utf-8');
      if(!$email)
      {
        exit;
      }
      $gid = trim($_POST['gid']);
      if(!is_numeric($gid))
      {
        exit;
      }
      $photo = trim($_POST['photo']);
      if(substr($photo,0,4)!='http')
      {
        exit;
      }
    }

    $msg = mb_substr(trim($_POST['msg']),0,200,'utf-8');
    if(!$msg)
    {
      exit;
    }

    $replace=[
      '1'=>['1','๑','หนึ่ง'],
      '2'=>['2','๒','สอง'],
      '3'=>['3','๓','สาม'],
      '4'=>['4','๔','สี่'],
      '5'=>['5','๕','ห้า'],
      '6'=>['6','๖','หก'],
      '7'=>['7','๗','เจ็ด'],
      '8'=>['8','๘','แปด'],
      '9'=>['9','๙','เก้า'],
      '0'=>['0','๐','ศูนย์']
    ];

    $tmp='';
    for($i=0;$i<mb_strlen($msg,'utf-8');$i++)
    {
      $x=mb_substr($msg,$i,1,'utf-8');
      if(isset($replace[$x]))
      {
        $tmp .= ''.$this->random_no($replace[$x]).'';
      }
      else
      {
        $tmp.=$x;
      }
    }
    $msg=str_replace(['เลีย','หี','หอย','ดูด','โฟน','ไอ้สัตว์','ไอ้','น้ำแตก','เงี่ยน','ควย','เย็ด','หำ','เงียน','เหงี่ยน','เสียว','เยด','คันหี','เลียหี','สัส','สาส','เหี้ย','เซ็ก','รับงาน'],'***',$tmp);

    if($data = $this->decrypt($key))
    {
      list($fid,$gg_id,$android_id) = explode('#',$data,3);
      if($gg_id==$gid || $gg_id==$fb_id)
      {
        if($Facebook)
        {
          $arg = [
            'fb_id'=>$fb_id,
            'fb_name'=>$fb_name,
            'ms'=>$msg,
            'dv'=>$android_id,
            'ip'=>$_SERVER['REMOTE_ADDR'],
            'ds'=>Load::Time()->now()
          ];
        }
        else
        {
          $arg = [
            'gg'=>[
              'n'=>$name,
              'ph'=>$photo,
              'em'=>$email,
              'id'=>$gid
            ],
            'ms'=>$msg,
            'dv'=>$android_id,
            'ip'=>$_SERVER['REMOTE_ADDR'],
            'ds'=>Load::Time()->now()
          ];
        }
        $db=Load::DB();
        if($friend=$db->findone('appfriend',['_id'=>intval($fid),'dd'=>['$exists'=>false]]))
        {
          $db->update('appfriend',['_id'=>intval($fid)],['$inc'=>['rp'=>1],'$push'=>['cm'=>$arg]]);
          $dv=[];
          if($friend['dv'] && $friend['dv']!=$android_id)
          {
            $dv[]=$friend['dv'];
          }
          if($friend['cm'])
          {
            foreach((array)$friend['cm'] as $v)
            {
              if($v['dv']!=$android_id)
              {
                $dv[]=$v['dv'];
              }
            }
          }
          $dv=array_values(array_unique($dv));
          if(count($dv)>0)
          {
            if($tmp=$db->find('droid_gcm',['n'=>'com.doodroid.friend','dv'=>['$in'=>$dv]]))
            {
              $device=[];
              $ms = $name.' ตอบกลับ: '.$msg;
              for($i=0;$i<count($tmp);$i++)
              {
                $device[$i]=$tmp[$i]['tk'];
              }
              $gcm = new GCMPushMessage(Load::$conf['app']['gcm']['friend']);
              $gcm->setDevices($device);
              $rs = json_decode($gcm->send($ms),true);
              if($rs['results']&&is_array($rs['results']))
              {
                for($i=0;$i<count($rs['results']);$i++)
                {
                  $g = $rs['results'][$i];
                  if($g['error']&&$g['error']=='NotRegistered')
                  {
                    $db->remove('droid_gcm',['_id'=>$tmp[$i]['_id']]);
                  }
                  else
                  {
                    $db->update('droid_gcm',['_id'=>$tmp[$i]['_id']],['$set'=>['ds'=>Load::Time()->now()]]);
                  }
                }
              }
            }
          }
        }
      }

      $rs=[
        'status'=>'ok'
      ];
      if($_GET['callback'])
      {
        header('Content-type: text/javascript');
        echo $_GET['callback'].'('.json_encode($rs).')';
      }
      else
      {
        header('Content-type: application/json');
        echo json_encode($rs);
      }
    }
    exit;
  }

  public function post_delete()
  {
    $key = $_POST['key'];
    $fb_name = mb_substr(trim($_POST['fb_name']),0,50,'utf-8');
    if(!$fb_name)
    {
      exit;
    }
    $fb_id = trim($_POST['fb_id']);
    if(!is_numeric($fb_id))
    {
      exit;
    }
    if($data = $this->decrypt($key))
    {
      list($fid,$gg_id,$android_id) = explode('#',$data,3);
      if($gg_id==$fb_id)
      {
        $db=Load::DB();
        if($friend=$db->findone('appfriend',['_id'=>intval($fid),'dd'=>['$exists'=>false]]))
        {
          if($fb_id==$friend['gg']['id'])
          {
            $db->update('appfriend',['_id'=>intval($fid)],['$set'=>['dd_ty'=>1,'dd_fbid'=>$fb_id,'dd'=>Load::Time()->now()]]);
          }
          elseif($fb_id=='10207218755082283')
          {
            $db->update('appfriend',['_id'=>intval($fid)],['$set'=>['dd_ty'=>2,'dd_fbid'=>$fb_id,'dd'=>Load::Time()->now()]]);
          }
          else
          {
            $db->update('appfriend',['_id'=>intval($fid)],['$inc'=>['sp'=>1]]);
          }
        }
      }

      $rs=[
        'status'=>'ok'
      ];
      if($_GET['callback'])
      {
        header('Content-type: text/javascript');
        echo $_GET['callback'].'('.json_encode($rs).')';
      }
      else
      {
        header('Content-type: application/json');
        echo json_encode($rs);
      }
    }
  }

  public function json_view()
  {
    $db=Load::DB();
    if(!$friend=$db->findone('appfriend',['_id'=>intval($_GET['id']),'dd'=>['$exists'=>false]]))
    {
      exit;
    }
    $data=[
      'status'=>'ok',
      'mode'=>'get_view',
      'content'=>$friend
    ];
    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($data).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($data);
    }
  }

  public function json_recent()
  {
    $count=60; //(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $arg=['dd'=>['$exists'=>false]];

    $ty=substr($_GET['json'],4);
    if(in_array($ty,['girl','boy','gay','lesbian','ladyboy']))
    {
      $arg['ty']=$ty;
    }
    if($count<10)
    {
      $count=40;
    }
    elseif($count>100)
    {
      $count=100;
    }
    if($page<1)
    {
      $page=1;
    }

    $option=['sort'=>['_id'=>-1],'limit'=>$count,'skip'=>(($page-1)*$count)];

    $pages=1;
    $friend=[];
    $db=Load::DB();
    if($c=$db->count('appfriend',$arg))
    {
      $friend=$db->find('appfriend',$arg,['_id'=>1,'gg'=>1,'ty'=>1,'ms'=>1,'pr'=>1,'ag'=>1,'ds'=>1,'da'=>1,'rp'=>1,'fb_name'=>1,'fb_id'=>1],$option);
      $pages=ceil($c/$count);
    }

    $data=[
      'status'=>'ok',
      'pages'=>$pages,
      'mode'=>'get_friend',
      'content'=>$friend
    ];

    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($data).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($data);
    }
  }

  public function random_no($arr)
  {
    shuffle($arr);
    return $arr[0];
  }
}
?>
