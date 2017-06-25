<?php
namespace Jarm\App\Ads;
use Jarm\Core\Load;

class Update extends Service
{
  public $banner;
  public function _update()
  {
    if(!$access=$this->check_perm('banner'))
    {
      Load::move('/');
    }
    $db=Load::DB();
    if(!$this->banner=$db->findone('ads',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]]))
    {
      Load::move('/');
    }
    if(!$this->banner['sc'])
    {
      $this->banner['sc']=substr(md5(rand(1,999999)),8,16);
      $db->update('ads',['_id'=>$this->banner['_id']],['$set'=>['sc'=>$this->banner['sc']]]);
    }
    return $this->{'update_'.$this->banner['ty']}($this->banner,$access);
  }

  private function update_ads($banner,$access)
  {
    Load::Ajax()->register(['newbanner']);
    $error=[];
    if($_POST)
    {
      $db=Load::DB();
      $arg=[];
      $arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
      $arg['d']=stripslashes(trim($_POST['detail']));
      $arg['l']=trim($_POST['link']);

      $arg['tyc']=($_POST['type']?1:0);
      $arg['code']=trim($_POST['code']);

      $unset=[];
      if(!$banner['p'])
      {
        $arg['dt1']=Load::Time()->from(trim($_POST['date1']).' 00:00:00');
        $arg['dt2']=Load::Time()->from(trim($_POST['date2']).' 23:59:59');
        foreach($this->position as $k=>$v)
        {
          $arg[$k]=[];
          if(isset($_POST[$k])&&is_array($_POST[$k]))
          {
            $arg[$k]=$_POST[$k];
          }
          if(count($arg[$k])==0)
          {
            unset($arg[$k]);
            $unset[$k]=1;
          }
        }
      }
      $arg['pl']=(in_array(intval($_POST['publish']),[0,1,2])?intval($_POST['publish']):0);


      if(!$arg['t'])
      {
        $error['title']='กรุณากรอกชื่อแบนเนอร์';
      }

      if(!count($error))
      {
        if(!$banner['fd'])
        {
          $fd = Load::Folder()->fd($banner['_id']);
          $banner['fd'] = $arg['fd'] = substr($fd,2,2).'/'.substr($fd,4,2);
        }

        $upset=['$set'=>$arg];

        if(count($unset)>0)
        {
          $upset['$unset']=$unset;
        }
        $db->update('ads',['_id'=>$banner['_id']],$upset);

        if($f=$_FILES['o']['tmp_name'])
        {
          $saved=false;
          foreach(Load::$conf['server']['files'] as $k=>$v)
          {
            $q=Load::Upload()->post($k,'ads-upload','@'.$f,['name'=>$banner['_id'],'folder'=>$banner['fd']]);
            if($q['status']=='OK')
            {
              if($q['data']['n'] && !$saved)
              {
                $saved=true;
                $db->update('ads',['_id'=>$banner['_id']],['$set'=>['s'=>$q['data']['n'],'ex'=>$q['data']['ex'],'w'=>$q['data']['w'],'h'=>$q['data']['h']]]);
              }
            }
          }
        }
        Load::move('/update/'.$banner['_id'].'?completed');
      }
    }

    if(isset($banner['ads'])&&is_array($banner['ads']))
    {
      if($banner['ads']['l'])
      {
        Load::$core->assign('adsL',$db->findone('ads',['_id'=>$banner['ads']['l']],['_id'=>1,'t'=>1]));
      }
      if($banner['ads']['r'])
      {
        Load::$core->assign('adsR',$db->findone('ads',['_id'=>$banner['ads']['r']],['_id'=>1,'t'=>1]));
      }
    }
    return Load::$core
      ->assign('banner',$banner)
      ->assign('error',$error)
      ->assign('access',$access)
      ->fetch('ads/update.ads');
  }

  private function update_advertorial($banner,$access)
  {
    $error=[];
    if($_POST)
    {
      $db=Load::DB();
      $arg=[];
      $arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
      $arg['content']=intval(trim($_POST['content']));

      $unset=[];

      $arg['dt1']=Load::Time()->from(trim($_POST['date1']).' 00:00:00');
      $arg['dt2']=Load::Time()->from(trim($_POST['date2']).' 23:59:59');
      foreach($this->advertorial_position as $k=>$v)
      {
        $arg[$k]=[];
        if(isset($_POST[$k])&&is_array($_POST[$k]))
        {
          $arg[$k]=$_POST[$k];
        }
        if(count($arg[$k])==0)
        {
          unset($arg[$k]);
          $unset[$k]=1;
        }
      }

      $arg['pl']=(in_array(intval($_POST['publish']),[0,1,2])?intval($_POST['publish']):0);


      if(!$arg['t'])
      {
        $error['title']='กรุณากรอกชื่อแบนเนอร์';
      }

      if(!count($error))
      {
        $upset=['$set'=>$arg];
        if(count($unset)>0)
        {
          $upset['$unset']=$unset;
        }
        $db->update('ads',['_id'=>$banner['_id']],$upset);
        Load::move('/update/'.$banner['_id'].'?completed');
      }
    }
    return Load::$core
              ->assign('banner',$banner)
              ->assign('error',$error)
              ->assign('access',$access)
              ->fetch('ads/update.advertorial');
  }

  private function update_relate($banner,$access)
  {
    $error=[];
    if($_POST)
    {
      $db=Load::DB();
      $arg=[];
      $arg['t']=trim(mb_substr(strip_tags($_POST['title']),0,100,'utf-8'));
      $arg['content']=intval(trim($_POST['content']));
      $unset=[];
      $arg['dt1']=Load::Time()->from(trim($_POST['date1']).' 00:00:00');
      $arg['dt2']=Load::Time()->from(trim($_POST['date2']).' 23:59:59');
      foreach($this->relate_position as $k=>$v)
      {
        $arg[$k]=[];
        if(isset($_POST[$k])&&is_array($_POST[$k]))
        {
          $arg[$k]=$_POST[$k];
        }
        if(count($arg[$k])==0)
        {
          unset($arg[$k]);
          $unset[$k]=1;
        }
      }
      $arg['pl']=(in_array(intval($_POST['publish']),[0,1,2])?intval($_POST['publish']):0);
      if(!$arg['t'])
      {
        $error['title']='กรุณากรอกชื่อแบนเนอร์';
      }
      if(!count($error))
      {
        $upset=['$set'=>$arg];
        if(count($unset)>0)
        {
          $upset['$unset']=$unset;
        }
        $db->update('ads',['_id'=>$banner['_id']],$upset);
        Load::move('/update/'.$banner['_id'].'?completed');
      }
    }
    return Load::$core
      ->assign('banner',$banner)
      ->assign('error',$error)
      ->assign('access',$access)
      ->fetch('ads/update.relate');
  }

  public function newbanner($arg)
  {
    $db=Load::DB();
    $ajax=Load::Ajax();
    if(!$this->banner['ads'][$arg['position']])
    {
      if(!$arg['title'])
      {
        $ajax->alert('กรุณากรอกชื่อแบนเนอร์');
      }
      else
      {
        $_=[
          't'=>mb_substr(trim($arg['title']),0,100,'utf-8'),
          'ty'=>'ads',
          'u'=>Load::$my['_id'],
          'p'=>$this->banner['_id'],
          'so'=>99,
        ];

        if($id=$db->insert('ads',$_))
        {
          $fd = Load::Folder()->fd($id);
          $db->update('ads',['_id'=>$id],['$set'=>['fd'=>substr($fd,2,2).'/'.substr($fd,4,2)]]);
          $db->update('ads',['_id'=>$this->banner['_id']],['$set'=>['ads.'.$arg['position']=>$id]]);
          $ajax->jquery('#ads-'.$arg['position'],'html',' '.$_['t'].' <a href="/view/'.$id.'" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-tasks"></span></a>
          <a href="/update/'.$id.'" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-wrench"></span></a>');
        }
        else
        {
          $ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');
        }
      }
    }
    else
    {
      $ajax->alert('มีตำแหน่งโฆษณานี้อยู่แล้ว');
    }
  }
}

?>
