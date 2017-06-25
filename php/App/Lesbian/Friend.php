<?php
namespace Jarm\App\Lesbian;
use Jarm\Core\Load;

class Friend extends Service
{
  public function get_friend()
  {
    $allby=['desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง'];
    $all=['order','by','search','page','day','month','year','position','category'];
    extract(Load::Split()->get('/friend/',0,['z','p','page','order','by'],['ds'=>'อัพเดทล่าสุด'],$allby));

    if(isset($z) && !isset($this->zone[$z]))
    {
      unset($z);
    }
    if(isset($p) && !isset($this->province[$p]))
    {
      unset($p);
    }

    $_=['dd'=>['$exists'=>false],'ty'=>'lesbian'];
    if($z)
    {
      $_['pr']=['$in'=>$this->zone[$z]['l']];
    }
    elseif($p)
    {
      $_['pr']=intval($p);
    }

    if(isset($p))
    {
      $p=intval($p);
      foreach($this->zone as $k=>$v)
      {
        if(in_array($p,$v['l']))
        {
          $z=$k;
          break;
        }
      }
    }
    if($page<1)$page=1;
    if($p)
    {
      Load::$core->data['title']='หาเพื่อนเลสเบี้ยน ทอม ดี้ เลสรุก เลสรัก เลสคิง เลสควีน เลสไบ เลสทูเวย์ ในจังหวัด'.$this->province[$p]['name_th'].($page>1?' หน้า '.$page:'').' - '.Load::$core->data['title'];
    }
    elseif($z)
    {
      Load::$core->data['title']='หาเพื่อนเลสเบี้ยน ทอม ดี้ เลสรุก เลสรัก เลสคิง เลสควีน เลสไบ เลสทูเวย์ ใน'.$this->zone[$z]['n'].($page>1?' หน้า '.$page:'').' - '.Load::$core->data['title'];
    }
    else
    {
      Load::$core->data['title']='หาเพื่อนเลสเบี้ยน ทอม ดี้ เลสรุก เลสรัก เลสคิง เลสควีน เลสไบ เลสทูเวย์'.($page>1?' หน้า '.$page:'').' - '.Load::$core->data['title'];
    }
    Load::$core->data['description']=Load::$core->data['title'].', '.Load::$core->data['description'];

    $ckey='lesbian/friend_'.$z.'_'.$p.'_'.intval($page);

    $db=Load::DB();
    if($count=$db->count('msn',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation(100,$count,[$url,'page-'],$page);
      $msn=$db->find('msn',$_,[],['sort'=>['au'=>1,'da'=>-1],'skip'=>$skip,'limit'=>100],false);
    }
    $pc=[];
    foreach($this->zone as $k=>$v)
    {
      if($k!=4)$pc[$k]=$db->find('msn_province',['z'=>intval($k)],['t'=>1,'c'=>1],['sort'=>['c'=>-1],'limit'=>5],false);
    }
    return Load::$core
      ->assign('z',$z)
      ->assign('p',$p)
      ->assign('pc',$pc)
      ->assign('pager',$pg)
      ->assign('page',$page)
      ->assign('error',$error)
      ->assign('msn',$msn)
      ->fetch('lesbian/friend');
  }

  public function post_friend()
  {
    Load::Ajax()->register(['sendreport','setrec']);

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
      if($ex=$db->find('msn',['em'=>$_POST['email']],['da'=>1,'dd'=>1,'_id'=>1,'pr'=>1],['sort'=>['da'=>-1]]))
      {
        for($i=0;$i<count($ex);$i++)
        {
          if(((Load::Time()->sec($ex[$i]['da']))+3600 > time()) && (!$ex[$i]['au']) && (!$ex[$i]['dd']))
          {
            $error['email']='คุณสามารถโพสได้ชมละครั้งเท่านั้น';
          }
          else
          {
            $db->update('msn',['_id'=>$ex[$i]['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
            //if($ex[$i]['pr'])$db->update('msn_province',['_id'=>$ex[$i]['pr']],['$inc'=>['c'=>-1]]);
          }
        }
      }
    }

    if(!count($error))
    {
      $ms=$_POST['message'];
      $ms=str_replace(['เงี่ยน','ควย','เย็ด','หำ'],'***',$ms);
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
        'ln'=>$_POST['line'],
        'cm'=>$_POST['cam']?1:0,
        'au'=>0,
        'ds'=>Load::Time()->now(),
        'ip'=>$_SERVER['REMOTE_ADDR'],
      ]))
      {
        $db->update('msn_province',['_id'=>intval($_POST['province'])],['$inc'=>['c_gay'=>1]]);
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
        Load::$core->delete('lesbian/home');
        header('Location: /friend/?completed');
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
