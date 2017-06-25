<?php
namespace Jarm\App\Friend;
use Jarm\Core\Load;

class Home extends Service
{
  public function _home()
  {
    Load::Ajax()->register(['sendreport','setrec']);
    if($_POST)
    {
      $invalid=[
        'stock_1998@hotmail.com'
      ];
      $db=Load::DB();
      $error=[];
      $_POST['message']=trim(mb_substr(strip_tags($_POST['message']),0,100,'utf-8'));
      $_POST['email']=trim(mb_substr(strip_tags($_POST['email']),0,100,'utf-8'));
      $_POST['twitter']=trim(mb_substr(strip_tags($_POST['twitter']),0,50,'utf-8'));
      $_POST['facebook']=trim(mb_substr(strip_tags($_POST['facebook']),0,50,'utf-8'));
      $_POST['inettown']=trim(mb_substr(strip_tags($_POST['inettown']),0,50,'utf-8'));
      $_POST['line']=trim(mb_substr(strip_tags($_POST['line']),0,30,'utf-8'));
      if(!isset($this->type[$_POST['gender']]))
      {
        $error['gender']='กรุณาเลือกเพศให้ถูกต้อง';
      }
      if(!isset($this->province[$_POST['province']]))
      {
        $error['province']='กรุณาเลือกจังหวัด';
      }
      if(!$_POST['message'])
      {
        $error['message']='กรุณากรอกข้อความทักทาย';
      }
      elseif(strpos($_POST['message'],'[url')>-1)
      {
        $error['message']='กรุณากรอกข้อความให้ถูกต้อง';
      }

      if(preg_match('/0(.+)?8(.+)?2(.+)?3(.+)?2(.+)?2(.+)?4(.+)?5(.+)?2(.+)?2/',$_POST['message']))
      {
        $error['message']='กรุณากรอกข้อความให้ถูกต้อง';
      }
      if($_POST['inettown']&&!Load::$my)
      {
        $error['inettown']='ข้อมูลไม่ถูกต้อง';
      }

      $age = intval($_POST['age']);
      if($age<18 || $age>60)$age=0;
      if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
      {
        $error['email']='กรุณากรอกอีเมล์ให้ถูกต้อง';
      }

      for($i=0;$i<count($invalid);$i++)
      {
        if(mb_strpos($_POST['message'],$invalid[$i],0,'utf-8')>-1)
        {
          $error['message']='ไม่สามารถพิม "'.$invalid[$i].'" ในข้อความทักทายได้';
        }
        elseif(mb_strpos($_POST['email'],$invalid[$i],0,'utf-8')>-1)
        {
          $error['email']='ไม่สามารถพิม "'.$invalid[$i].'" ในอีเมล์ได้';
        }
      }

      if(!count($error))
      {
        $replace = [
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

        $corange = '#f90';
        $cred = '#f00';
        $cgreen = '#090';

        $db->update('msn',['ip'=>$_SERVER['REMOTE_ADDR']],['$set'=>['dd'=>Load::Time()->now()]],['multiple'=>true]);
        $db->update('msn',['em'=>$_POST['email']],['$set'=>['dd'=>Load::Time()->now()]],['multiple'=>true]);
        $ms=$_POST['message'];
        $tmp='';
        for($i=0;$i<mb_strlen($ms,'utf-8');$i++)
        {
          $x=mb_substr($ms,$i,1,'utf-8');
          if(isset($replace[$x]))
          {
            $tmp .= ' '.$this->random_no($replace[$x]).' ';
          }
          else
          {
            $tmp.=$x;
          }
        }
        $ms=str_replace(['เลีย','หี','หอย','ดูด','โฟน','ไอ้สัตว์','ไอ้','น้ำแตก','เงี่ยน','ควย','เย็ด','หำ','เงียน','เหงี่ยน','เสียว','เยด','คันหี','เลียหี','สัส','สาส','เหี้ย','เซ็ก','รับงาน'],'***',$tmp);
        if($id=$db->insert('msn',[
          'u'=>intval(Load::$my['_id']),
          'pr'=>intval($_POST['province']),
          'ty'=>$_POST['gender'],
          'ms'=>$ms,
          'ag'=>$age,
          'em'=>mb_strtolower($_POST['email'],'utf-8'),
          'fb'=>$_POST['facebook'],
          'in'=>$_POST['inettown'],
          'tw'=>$_POST['twitter'],
          'ln'=>$_POST['line'],
          'cm'=>$_POST['cam']?1:0,
          'au'=>0,
          'ds'=>Load::Time()->now(),
          'ip'=>$_SERVER['REMOTE_ADDR'],
        ]))
        {
          if($_POST['facebook_id']&&$_POST['facebook_name'])
          {
            $db->insert('appfriend',[
              'pr'=>intval($_POST['province']),
              'ty'=>$_POST['gender'],
              'ms'=>$ms,
              'ag'=>$age,
              'fb_id'=>$_POST['facebook_id'],
              'fb_name'=>$_POST['facebook_name'],
              'line'=>$_POST['line'],
              'ds'=>Load::Time()->now(),
              'ip'=>$_SERVER['REMOTE_ADDR'],
            ]);
          }
          Load::$core->delete('friend/home');
          header('Location: /?completed');
          exit;
        }
      }
      else
      {
        Load::$core->assign('error',$error);
      }
    }
    Load::cache();
    $db=Load::DB();
    $pc=[];
    foreach($this->zone as $k=>$v)
    {
      if($k!=4)$pc[$k]=$db->find('msn_province',['z'=>intval($k)],['t'=>1,'c'=>1],['sort'=>['c'=>-1],'limit'=>5],false);
    }
    if($count=$db->count('msn',['dd'=>['$exists'=>false],'ty'=>['$nin'=>['gay','lesbian']]]))
    {
      list($pg,$skip)=Load::Pager()->navigation(100,$count,['/','page-'],$page);
      $msn=$db->find('msn',['dd'=>['$exists'=>false],'ty'=>['$nin'=>['gay','lesbian']]],[],['sort'=>['au'=>1,'da'=>-1],'skip'=>0,'limit'=>100],false);
    }
    return Load::$core
      ->assign('pager',$pg)
      ->assign('pc',$pc)
      ->assign('error',$error)
      ->assign('msn',$msn)
      ->fetch('friend/home');
  }

  public function sendreport($arg)
  {
    $db=Load::DB();
    $ajax=Load::Ajax();

    if($f=$db->findone('msn',['_id'=>intval($arg['friend']),'dd'=>['$exists'=>false]]))
    {
       if(Load::$my && ((Load::$my['_id']==$f['u'])||(Load::$my['am'] &&Load::$my['am']>0)))
       {
         $db->update('msn',['_id'=>$f['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
         //Load::Upload()->post('s3','delete','msn/'.$f['fd'].'/'.$f['pt']);
         $ajax->alert('ลบข้อความเรียบร้อยแล้ว');
       }
       elseif($arg['reason'])
       {
        $mail=Load::Mail();
        $mail->to=$f['em'];
        $mail->subject = 'ลิ้งค์สำหรับลบข้อความ - Jarm Friend หาเพื่อน หาแฟน หากิ๊ก หาคู่';
        Load::$core->assign('f',$f);
        Load::$core->assign('code',md5($f['_id'].'+d+'.$f['em']));
        $mail->message = Load::$core->fetch('friend/home.report');
        $mail->send();
        $ajax->alert('ส่งลิ้งค์สำหรับการลบข้อความไปยัง '.$f['em'].' เรียบร้อยแล้ว');
       }
       else
       {
         $db->update('msn',['_id'=>$f['_id']],['$set'=>['sp'=>intval($f['sp'])+1,'sd'=>Load::Time()->now()]]);
         $ajax->alert('รายงานข้อความนี้เรียบร้อยแล้ว');
       }
      Load::$core->delete('friend.jarm.com/home');
    }
  }

  public function setrec($id)
  {
  }

  public function random_no($arr)
  {
    shuffle($arr);
    return $arr[0];
  }
}
?>
