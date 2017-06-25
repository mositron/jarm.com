<?php
namespace Jarm\App\My;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'แผงควบคุม - jarm.com',
      'description'=>'แผงควบคุม - jarm.com',
      'keywords'=>'แผงควบคุม, jarm',
    ]);
    if(Load::$my)
    {
      $path=(Load::$path[0]??'');
      Load::$core->data['nav-header']='<div><a href="/" title="แผงควบคุม">แผงควบคุม</a></div><i></i><ul>
      <li><a href="'.Load::$my['link'].'" title=""'.($path=='user'?' class="active"':'').'>โปรไฟล์</a></li>
      <li><a href="/settings" title=""'.($path=='settings'?' class="active"':'').'>ตั้งค่าใช้งาน</a></li>
      </ul>';
    }
  }

  public function get_home()
  {
    Load::Session()->logged();
    $db=Load::DB();
    $news=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['dd'=>['$exists'=>false],'pl'=>1],[],['limit'=>20,'sort'=>['ds'=>-1]]);
    return Load::$core
      ->assign('user',Load::User())
      ->assign('news',$news)
      ->assign('friend',$db->find('user',['st'=>['$gte'=>0]],['_id'=>1,'if.am'=>1,'am'=>1,'du'=>1,'em'=>1,'da'=>1],['sort'=>['_id'=>-1],'limit'=>10]))
      ->fetch('my/home');
  }

  public function _byuser()
  {
    $user=Load::User();
    $prof=false;
    $path=(Load::$path[0]?:'me');
    if($path=='me')
    {
      return ['move'=>Load::$my?'/user/'.Load::$my['_id']:['oauth','/login/?redirect_uri='.urlencode(URH.'/user/me')]];
    }
    elseif(is_numeric($path))
    {
      return ['move'=>'/user/'.$path];
    }
    else
    {
      if($this->profile=$user->get($path))
      {
        Load::cache();
        Load::Ajax()->register(['addpoint','setban','resetavatar','setblock','hackbywut','setverify','sethideall','savecrop']);
        $this->user_upload($this->profile);
        return $this->user_profile($this->profile);
      }
      else
      {
        return ['move'=>'/'];
      }
    }
  }

  public function user_upload($prof)
  {
    if($_FILES['header']||$_FILES['avatar']||$_POST['upload_bg'])
    {
      Load::Session()->logged();
      $status=['status'=>'FAIL','message'=>'not found'];
      if($prof['_id']==Load::$my['_id'])
      {
        if($_POST['upload_bg'])
        {
          if(!is_array($prof['pf']))$prof['pf']=[];
          if(!is_array($prof['pf']['bg']))$prof['pf']['bg']=[];
          if($_POST['delete'] && $prof['pf']['bg']['url'])
          {
            Load::Upload()->post($prof['sv'],'delete','profile/'.$prof['if']['fd'].'/'.$prof['pf']['bg']['url']);
            Load::User()->update(Load::$my['_id'],['$set'=>['pf.bg.url'=>'']]);
          }
          Load::User()->update(Load::$my['_id'],['$set'=>[
            'pf.bg.pos'=>mb_substr(trim($_POST['position']),0,20,'utf-8'),
            'pf.bg.rep'=>mb_substr(trim($_POST['repeat']),0,20,'utf-8'),
            'pf.bg.alp'=>intval(trim($_POST['alpha'])),
            'pf.bg.fix'=>(strval($_POST['fixed'])?1:0),
            'pf.bg.col'=>preg_match('/^([0-9a-f]{3,6})$/i',trim($_POST['color']),$c)?$c[1]:'',
          ]]);
          if($_FILES['background']['tmp_name'])
          {
            if($prof['pf']['bg']['url'])
            {
              Load::Upload()->post($prof['sv'],'delete','profile/'.$prof['if']['fd'].'/'.$prof['pf']['bg']['url']);
              Load::User()->update(Load::$my['_id'],['$set'=>['pf.bg.url'=>'']]);
            }
            $q=Load::Upload()->post($prof['sv'],'upload','@'.$_FILES['background']['tmp_name'],['name'=>'bg-'.rand(1,99),'folder'=>'profile/'.$prof['if']['fd'],'width'=>5000,'height'=>5000,'fix'=>'width','type'=>'jpg']);
            if($q['status']=='OK')
            {
              Load::User()->update(Load::$my['_id'],['$set'=>['pf.bg.url'=>$q['data']['n']]]);
            }
          }
          Load::move(URL);
        }
        elseif($_FILES['header'])
        {
          if($_FILES['header']['tmp_name'])
          {
            $db=Load::DB();
            $f=$_FILES['header']['tmp_name'];

            $q2=Load::Upload()->post($prof['sv'],'upload','@'.$f,['name'=>'hd','folder'=>'profile/'.$prof['if']['fd'],'width'=>980,'height'=>400,'fix'=>'width','type'=>'jpg']);
            if(!is_array($prof['pf']))$prof['pf']=[];
            $prof['pf']['hd']=$q2['data']['n'];
            Load::User()->update(Load::$my['_id'],['$set'=>['pf'=>$prof['pf']]]);

            $status['status']='OK';
            $status['pic']=Load::$conf['scheme'].'://'.$prof['sv'].'.'.Load::$conf['domain'].'/profile/'.$prof['if']['fd'].'/'.$q2['data']['n'].'?'.rand(1,999);
            $status['update']='header';
          }
          else
          {
            $status['message']='ชนิดไฟล์ไม่ถูกต้อง';
          }
        }
        elseif($_FILES['avatar'])
        {
          if($_FILES['avatar']['tmp_name'])
          {
            $size=@getimagesize($_FILES['avatar']['tmp_name']);
            $t='jpg';
            switch (strtolower($size['mime']))
            {
              case 'image/gif':
                $t='gif';
                break;
              case 'image/jpg':
              case 'image/jpeg':
              case 'image/bmp':
              case 'image/wbmp':
              case 'image/png':
              case 'image/x-png':
            }

            if($size[0]<1||$size[1]<1)
            {
              $status['message']='ขนาดไฟล์ไม่ถูกต้อง';
            }
            elseif($t=='gif')
            {
              if(!is_array(Load::$my['pf']))Load::$my['pf']=[];
              Load::$my['pf']['av']='gif';

              $q=Load::Upload()->post($prof['sv'],'profile-gif','@'.$_FILES['avatar']['tmp_name'],['folder'=>Load::$my['if']['fd']]);
              if($q['status']=='OK')
              {
                Load::User()->update(Load::$my['_id'],['$set'=>['pf'=>Load::$my['pf']]]);
                $status['status']='OK';
                $status['pics']=Load::uri([$prof['sv'],'/profile/'.$prof['if']['fd'].'/s.gif?v='.rand(1,9999)]);
                $status['picn']=Load::uri([$prof['sv'],'/profile/'.$prof['if']['fd'].'/n.gif?v='.rand(1,9999)]);
                $status['update']='avatar-gif';
              }
              else
              {
                $status['message']='การอัพโหลด gifไม่ถูกต้อง';
              }
            }
            else
            {
              $q=Load::Upload()->post($prof['sv'],'upload','@'.$_FILES['avatar']['tmp_name'],['name'=>'o','folder'=>'profile/'.$prof['if']['fd'],'width'=>500,'height'=>500,'fix'=>'width','type'=>'jpg']);
              if($q['status']=='OK')
              {
                if(!is_array(Load::$my['pf']))Load::$my['pf']=[];
                Load::$my['pf']['av']='jpg';
                Load::User()->update(Load::$my['_id'],['$set'=>['pf'=>Load::$my['pf']]]);
                $status['status']='OK';
                $status['pic']=Load::uri([$prof['sv'],'/profile/'.$prof['if']['fd'].'/'.$q['data']['n'].'?'.rand(1,999)]);
                $status['update']='avatar';
              }
              else
              {
                $status['message']='ชนิดไฟล์ไม่ถูกต้อง';
              }
            }
          }
        }
      }
      echo json_encode($status);
      exit;
    }
  }

  public function user_profile($prof)
  {
    Load::$core->data['title'] = $prof['name'].' - Jarm โปรไฟล์ส่วนตัว';
    Load::$core->data['description'] = 'เกี่ยวกับ '.$prof['name'];
    Load::$core->data['keywords'] = $prof['name'].', '.$prof['if']['fn'].', '.$prof['if']['ln'].', ประวัติ, โปรไฟล์';
    Load::$core->data['image']=$prof['img-n']=Load::uri([$prof['sv'],'/profile/'.$prof['if']['fd'].'/n.'.($prof['pf']['av']?:'jpg')]);
    $pf=[[],[]];
    $pf[0]['gd']=Load::$conf['gender'][$prof['if']['gd']];
    $pf[1]['gd']='<span>'.$pf[0]['gd'].'</span>';
    if($rl2=Load::$conf['relate'][intval($prof['if']['rl'])])
    {
      $pf[0]['rl']=$rl2;
      $pf[1]['rl']='<span>'.$pf[0]['rl'].'</span>';
    }
    $d=explode('-',date('d-m-Y',Load::Time()->sec($prof['if']['bd'])));
    $pf[0]['bd']=$d[0].' '.Load::Time()->month[intval($d[1])-1].' '.intval($d[2]+543);
    $pf[1]['bd']='วันเกิด <span>'.$pf[0]['bd'].'</span>';

    $prov=require(__CONF.'province.php');
    $pf[0]['pr']=($prof['if']['pr']?'จังหวัด ':'').$prov[$prof['if']['pr']]['name_th'];
    $pf[1]['pr']='<span>'.$pf[0]['pr'].'</span>';
    return Load::$core
      ->assign('user',Load::User())
      ->assign('profile',$prof)
      ->assign('pf',$pf)
      ->fetch('my/user');
  }

  public function setban()
  {
    if(Load::$my['am']>=9)
    {
      $db=Load::DB();
      Load::User()->update($this->profile['_id'],['$set'=>['st'=>-1]]);
      $ip=$this->profile['ip'];
      if(!is_array($ip))
      {
        $ip=[$ip];
      }
      foreach($ip as $p)
      {
        if($idp=$db->findone('block_ip',['ip'=>$p]))
        {
          $db->update('block_ip',['_id'=>$idp['_id']],['$set'=>['du'=>Load::Time()->now()]]);
        }
        else
        {
          $db->insert('block_ip',['du'=>Load::Time()->now(),'ip'=>$p]);
        }
      }
      Load::Ajax()->alert('แบนสมาชิกนี้แล้ว')
                  ->script('setTimeout(function(){window.location.href="'.URL.'";},2000)');
    }
  }

  public function setverify()
  {
    if(Load::$my['am']>=9)
    {
      $db=Load::DB();
      Load::User()->update($this->profile['_id'],['$set'=>['st'=>1]]);
      Load::Ajax()->alert('ยืนยันการสมัครของสมาชิกนี้แล้ว')
                  ->script('setTimeout(function(){window.location.href="'.URL.'";},2000)');
    }
  }

  public function resetavatar()
  {
    if(Load::$my['am']>=9)
    {
      if(!is_array($this->profile['pf']))$this->profile['pf']=[];
      $this->profile['pf']['av']='jpg';
      Load::Upload()->post('s1','profile-reset',$this->profile['if']['fd']);
      Load::User()->update($this->profile['_id'],['$set'=>['pf'=>$this->profile['pf']]]);
      Load::Ajax()->alert('ลบรูปภาพเรียบร้อยแล้ว');
    }
  }

  public function savecrop($frm)
  {
    Load::Session()->logged();
    if(Load::$my['_id'])
    {
      $ajax=Load::Ajax();
      $q=Load::Upload()->post(Load::$my['sv'],'profile-crop',Load::$my['if']['fd'],$frm);
      if($q['status']=='OK')
      {
        $ajax->script('_.box.close();')
              ->script('$(".img-uid-'.Load::$my['_id'].'").attr("src","'.Load::uri([Load::$my['sv'],'/profile/'.Load::$my['if']['fd'].'/s.jpg?v='.rand(1,9999)]).'");')
              ->script('$(".img-uid-my").attr("src","'.Load::uri([Load::$my['sv'],'/profile/'.Load::$my['if']['fd'].'/n.jpg?v='.rand(1,9999)]).'");');
      }
      else
      {
        $ajax->alert('ข้อมูลไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง');
      }
    }
  }
}
?>
