<?php
namespace Jarm\App\Boyz;
use Jarm\Core\Load;

class Friend extends Service
{
  public function _friend()
  {
    Load::Ajax()->register(['sendreport','setrec']);
    if($_POST)
    {
      $db=Load::DB();
      $error=[];
      $_POST['message']=trim(mb_substr(strip_tags($_POST['message']),0,100,'utf-8'));
      $_POST['email']=trim(mb_substr(strip_tags($_POST['email']),0,100,'utf-8'));
      $_POST['twitter']=trim(mb_substr(strip_tags($_POST['twitter']),0,50,'utf-8'));
      $_POST['facebook']=trim(mb_substr(strip_tags($_POST['facebook']),0,50,'utf-8'));
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

        $ms=$_POST['message'];
        $ms=str_replace(['เงี่ยน','ควย','เย็ด','หำ'],'***',$ms);
        if($id=$db->insert('msn',[
          'u'=>intval(Load::$my['_id']),
          'pr'=>intval($_POST['province']),
          'ty2'=>strval($_POST['gender']),
          'ty'=>'gay',
          'ms'=>$ms,
          'ag'=>$age,
          'em'=>$_POST['email'],
          'fb'=>$_POST['facebook'],
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
              'ty'=>'gay',
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
          header('Location: /friend/?completed');
          exit;
        }
      }
    }

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

    $_=['dd'=>['$exists'=>false],'ty'=>'gay'];
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
      Load::$core->data['title']='หาเพื่อนเกย์ เกย์ไบ เกย์โบท เกย์คิง เกย์ควีน เกย์รุก เกย์รับ ในจังหวัด'.$this->province[$p]['name_th'].($page>1?' หน้า '.$page:'').' - '.Load::$core->data['title'];
    }
    elseif($z)
    {
      Load::$core->data['title']='หาเพื่อนเกย์ เกย์ไบ เกย์โบท เกย์คิง เกย์ควีน เกย์รุก เกย์รับ ใน'.$this->zone[$z]['n'].($page>1?' หน้า '.$page:'').' - '.Load::$core->data['title'];
    }
    else
    {
      Load::$core->data['title']='หาเพื่อนเกย์ เกย์ไบ เกย์โบท เกย์คิง เกย์ควีน เกย์รุก เกย์รับ'.($page>1?' หน้า '.$page:'').' - '.Load::$core->data['title'];
    }
    Load::$core->data['description']=Load::$core->data['title'].', '.Load::$core->data['description'];

    $ckey='boyz/friend_'.$z.'_'.$p.'_'.intval($page);
    #$cache=Load::$core;
    #if(!Load::$core->data['content']=Load::$core->get($ckey,600))
    #{
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
      ->fetch('boyz/friend');
    #}
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
         Load::Upload()->post('s3','delete','msn/'.$f['fd'].'/'.$f['pt']);
         $ajax->alert('ลบข้อความเรียบร้อยแล้ว');
       }
       elseif($arg['reason'])
       {
        $mail=Load::Mail();
        $mail->to=$f['em'];
        $mail->subject = 'ลิ้งค์สำหรับลบข้อความ - Jarm Friend หาเพื่อน หาแฟน หากิ๊ก หาคู่';
        Load::$core->assign('f',$f);
        Load::$core->assign('code',md5($f['_id'].Load::$conf['friend']['key_delete'].$f['em']));
        $mail->message = Load::$core->fetch('boyz/friend.report');
        $mail->send();
        $ajax->alert('ส่งลิ้งค์สำหรับการลบข้อความไปยัง '.$f['em'].' เรียบร้อยแล้ว');
       }
       else
       {
         $db->update('msn',['_id'=>$f['_id']],['$set'=>['sp'=>intval($f['sp'])+1,'sd'=>Load::Time()->now()]]);
         $ajax->alert('รายงานข้อความนี้เรียบร้อยแล้ว');
       }
      Load::$core->delete('boyz/home');
    }
  }
}
?>
