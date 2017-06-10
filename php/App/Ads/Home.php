<?php
namespace Jarm\App\Ads;
use Jarm\Core\Load;

class Home extends Service
{
  public function _home()
  {
    if($this->check_perm('banner'))
    {
      Load::Ajax()->register(['newbanner','delbanner','clearcache']);
      $arg = ['dd'=>['$exists'=>false],'ty'=>'ads'];
      $allorder=['t'=>'ชื่อแบนเนอร์','dt1'=>'เริ่มแสดง','dt2'=>'จบแสดง','imp'=>'แสดง','click'=>'คลิก'];
      $allby=['asc'=>'1','desc'=>'-1'];
      $site='';
      $status=(Load::$path[1]??'active');
      extract(Load::Split()->get('/',0,['page','order','by'],$allorder,$allby));
      if($status=='inactive')
      {
        $arg['pl']=0;
      }
      elseif($status=='all')
      {

      }
      else
      {
        $status='active';
        $arg['pl']=1;
      }
      if(isset($this->position[$site]))
      {
        $arg[$site]=['$exists'=>true];
      }
      $inner=[];
      $banner=[];
      $db=Load::DB();
      $tmp=$db->find('ads',$arg,[],['sort'=>['pl'=>-1,$order=>($by=='desc'?-1:1)]]);
      for($i=0;$i<count($tmp);$i++)
      {
        if(!empty($tmp[$i]['p']))
        {
          if(!isset($inner[$tmp[$i]['p']]))
          {
            $inner[$tmp[$i]['p']]=[];
          }
          $inner[$tmp[$i]['p']][]=$tmp[$i];
        }
        else
        {
          $banner[]=$tmp[$i];
        }
      }

      return ['content'=>Load::$core
        ->assign('banner',$banner)
        ->assign('inner',$inner)
        ->assign('site',$site)
        ->assign('status',$status)
        ->assign('order',$order)
        ->assign('by',$by)
        ->assign('allorder',$allorder)
        ->fetch('ads/home')];
    }
    else
    {
      return ['content'=>Load::$core->fetch('ads/permission')];
    }
  }
}

?>
