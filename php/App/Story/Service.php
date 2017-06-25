<?php
namespace Jarm\App\Story;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public $cate=[
    1=>['t'=>'การ์ตูน'],
    2=>['t'=>'กีฬา'],
    3=>['t'=>'เกมส์'],
    4=>['t'=>'เขียนโปรแกรม'],
    5=>['t'=>'ความสวยงาม สุขภาพ'],
    6=>['t'=>'ท่องเที่ยว'],
    7=>['t'=>'เทคโนโลยี'],
    8=>['t'=>'บุคคล'],
    9=>['t'=>'วัฒนธรรม สังคม'],
    10=>['t'=>'ศิลปะ'],
    11=>['t'=>'สื่อ ภาพยนต์ ละคร เพลง ดารา นักร้อง'],
    12=>['t'=>'อาหาร'],
    99=>['t'=>'อื่นๆ']
  ];
  public function __construct()
  {
    $path=(Load::$path[0]??'');
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'Story | Jarm.com',
      'description'=>'Story | Jarm.com',
      'keywords'=>'Story, jarm',
      'nav-header'=>'',
      'hide_adsense'=>true,
      'sc-bottom'=>false,
    ]);
    Load::$core->assign('cate',$this->cate);
/*
    if(Load::$my['st']!=1)
    {
      Load::$core->data['content']=Load::$core->fetch('story/permission');
      echo Load::$core->assign('data',Load::$core->data)
                      ->fetch('global',true);
      exit;
    }
    */
  }

  public function _byblog()
  {
    if(in_array(Load::$path[0],['blog','post','upload']))
    {
      $v = '\Jarm\App\Story\Method\\'.ucfirst(Load::$path[0]);
      return new $v($this);
    }
    elseif(Load::$path[0])
    {
      return new \Jarm\App\Story\Method\Profile($this);
    }
    else
    {
      return new \Jarm\App\Story\Method\Home($this);
    }
  }

  public function check_perm($key,$am=1)
  {
    if(Load::$my['am']>=$am)
    {
      return true;
    }
    return false;
  }
}
?>
