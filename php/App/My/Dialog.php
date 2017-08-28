<?php
namespace Jarm\App\My;
use Jarm\Core\Load;

class Dialog extends Service
{
  public $profile=[];
  public function get_dialog()
  {
    Load::Session()->logged();
    $path=(Load::$path[1]?:'');
    if(in_array($path,['photos','list','email']))
    {
      $ct=Load::$core->fetch('my/dialog.'.$path);
    }
    elseif($path=='upload')
    {
      $ct=Load::$core->assign('profile',Load::DB()->findOne('user',['_id'=>Load::$my['_id']],['pf'=>1]))
              ->fetch('my/dialog.upload');
    }
    elseif($path=='point')
    {
      if(Load::$my['am']>=9)
      {
        $ct=Load::$core->assign('user',Load::User()->get(Load::$path[1],true))
                ->fetch('my/dialog.point');
      }
    }
    elseif($path=='announced')
    {
      if(Load::$my['am']>=9)
      {
        $ct=Load::$core->assign('announced',Load::DB()->findone('msg',['_id'=>'announced'],['msg'=>1]))
                ->fetch('my/dialog.announced');
      }
    }
    elseif($path=='avatar')
    {
      $w=$h=500;
      $q=Load::Upload()->post(Load::$my['sv'],'getsize','profile/'.Load::$my['if']['fd'].'/o.jpg');
      if($q['status']=='OK')
      {
        if($q['data']['w']>0)$w=$q['data']['w'];
        if($q['data']['h']>0)$h=$q['data']['h'];
      }
      $ct=Load::$core->assign(['w'=>$w,'h'=>$h])
              ->assign('picture','https://'.Load::$my['sv'].'.jarm.com/profile/'.Load::$my['if']['fd'].'/o.jpg?v='.rand(1,9999))
              ->fetch('my/dialog.avatar');
    }
    echo Load::$core->assign('ct',$ct)
                    ->fetch('my/dialog');
    exit;
  }
}
?>
