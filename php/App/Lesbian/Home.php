<?php
namespace Jarm\App\Lesbian;
use Jarm\Core\Load;

class Home extends Service
{
  public function get_home()
  {
    $pc=[];
    $db=Load::DB();
    foreach($this->zone as $k=>$v)
    {
      if($k!=4)$pc[$k]=$db->find('msn_province',['z'=>intval($k)],['t'=>1,'c'=>1],['sort'=>['c'=>-1],'limit'=>5],false);
    }
    if($count=$db->count('msn',['dd'=>['$exists'=>false],'ty'=>'lesbian']))
    {
      list($pg,$skip)=Load::Pager()->navigation(100,$count,['/friend/','page-'],$page);
      $msn=$db->find('msn',['dd'=>['$exists'=>false],'ty'=>'lesbian'],[],['sort'=>['au'=>1,'da'=>-1],'skip'=>0,'limit'=>100],false);
    }
    Load::$core->data['content']=Load::$core
      ->assign('pager',$pg)
      ->assign('pc',$pc)
      ->assign('error',$error)
      ->assign('msn',$msn)
      ->fetch('lesbian/home');
  }

  public function post_home()
  {
    Load::Ajax()->register(['sendreport'],'friend');

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

    if(!count($error))
    {
      $db->update('msn',['ip'=>$_SERVER['REMOTE_ADDR']],['$set'=>['dd'=>Load::Time()->now()]],['multiple'=>true]);
      $db->update('msn',['em'=>$_POST['email']],['$set'=>['dd'=>Load::Time()->now()]],['multiple'=>true]);
      if(strtolower($_POST['line']))
      {
        $db->update('msn',['ln'=>strtolower($_POST['line'])],['$set'=>['dd'=>Load::Time()->now()]],['multiple'=>true]);
      }
      $ms=$_POST['message'];
      $ms=str_replace(['โฟน','ไอ้สัตว์','ไอ้','น้ำแตก','เงี่ยน','ควย','เย็ด','หำ','เงียน','เหงี่ยน','เสียว','เยด','คันหี','เลียหี','สัส','สาส','เหี้ย','เซ็ก','รับงาน'],'***',$ms);
      $ms=str_replace(['1','2','3','4','5','6','7','8','9','0'],['๑','๒','๓','๔','๕','๖','๗','๘','๙','๐'],$ms);
      if($id=$db->insert('msn',[
          'u'=>intval(Load::$my['_id']),
          'pr'=>intval($_POST['province']),
          'ty2'=>strval($_POST['gender']),
          'ty'=>'lesbian',
          'ms'=>$ms,
          'ag'=>$age,
          'em'=>$_POST['email'],
          'fb'=>$_POST['facebook'],
          'in'=>$_POST['inettown'],
          'tw'=>$_POST['twitter'],
          'ln'=>strtolower($_POST['line']),
          'cm'=>$_POST['cam']?1:0,
          'au'=>0,
          'ds'=>Load::Time()->now(),
          'ip'=>$_SERVER['REMOTE_ADDR'],
        ]))
      {
        $db->update('msn_province',['_id'=>intval($_POST['province'])],['$inc'=>['c_les'=>1]]);

        if($_POST['facebook_id']&&$_POST['facebook_name'])
        {
          $db->insert('appfriend',[
                                    'pr'=>intval($_POST['province']),
                                    'ty'=>'lesbian',
                                    'ms'=>$ms,
                                    'ag'=>$age,
                                    'fb_id'=>$_POST['facebook_id'],
                                    'fb_name'=>$_POST['facebook_name'],
                                    'line'=>$_POST['line'],
                                    'ds'=>Load::Time()->now(),
                                    'ip'=>$_SERVER['REMOTE_ADDR'],
          ]);
        }
        Load::$core->delete('lesbian.jarm.com/home',0);
        header('Location: /?completed');
        exit;
      }
    }
  }
}

/*
'' => 'home',
'home' => 'home',
'friend'=>'friend',
'admin'=>'admin',
'report'=>'report',
'chat'=>'chat',
*/
?>
