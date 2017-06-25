<?php
namespace Jarm\App\Ads;
use Jarm\Core\Load;

class Advertorial extends Service
{
  public function _advertorial()
  {
    if($this->check_perm('banner'))
    {
      Load::Ajax()->register(['newbanner','delbanner','clearcache']);
      $status=(Load::$path[1]??'active');
      $arg = ['dd'=>['$exists'=>false],'ty'=>'advertorial'];
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
      $site='';
      extract(Load::Split()->get('/advertorial/'.$status,1,['site','page']));

      $db=Load::DB();
      if($site&&isset($this->advertorial_position[$site]))
      {
        $arg[$site]=['$exists'=>true];
      }
      $inner=[];
      $banner=[];
      $tmp=$db->find('ads',$arg,[],['sort'=>['pl'=>-1,'t'=>1,'dt2'=>-1]]);
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

      return Load::$core
        ->assign('banner',$banner)
        ->assign('inner',$inner)
        ->assign('site',$site)
        ->assign('status',$status)
        ->fetch('ads/advertorial');
    }
    else
    {
      return Load::$core->fetch('ads/permission');
    }
  }
}

?>
