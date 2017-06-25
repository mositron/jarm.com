<?php
namespace Jarm\App\Horo;
use Jarm\Core\Load;

class Phone extends Service
{
  public function _phone()
  {
    if(is_numeric(Load::$path[1]))
    {
      Load::move('/phone/'.Load::$path[1].'.html',true);
    }
    elseif(preg_match('/^(\d+)\.html$/',Load::$path[1],$url))
    {
      $db=Load::DB();
      if(!$phone=$db->findone('horo_phone',['_id'=>intval($url[1])]))
      {
        Load::move('/phone');
      }

      Load::$core->data['title'] = 'ดูดวงเบอร์มือถือ ผลรวมเลข '.$url[1].' - '.Load::$core->data['title'];
      Load::$core->data['description'] = Load::$core->data['title'].' - '.Load::$core->data['description'];

      $a=range(11, 100);
      shuffle($a);
      shuffle($a);
      $a=array_slice($a,0,30);
      return Load::$core
        ->assign('mhit',$db->find('horo_phone',['_id'=>['$in'=>$a,'$ne'=>53]],['_id'=>1,'d'=>1]))
        ->assign('phone',$phone)
        ->fetch('phone.view');
    }
    elseif(Load::$path[1])
    {
      Load::move('/phone',true);
    }
    else
    {
      Load::$core->data['title'] = 'ดูดวงเบอร์มือถือ - '.Load::$core->data['title'];
      Load::$core->data['description'] = ' ดูดวงเบอร์มือถือ - '.Load::$core->data['description'];
      return Load::$core
        ->assign('phone',Load::DB()->find('horo_phone',[],['_id'=>1,'d'=>1]))
        ->fetch('phone.home');
    }
  }
}


function getno($no,$t=8)
{
  $no=str_replace(['[','{',']','}'],['<span class="n1">','<span class="n2">','</span>','</span>'],$no);
  if(strpos($no,')')>-1)
  {
    $no='0<span class="n3">'.$t.str_replace(')', '</span>', $no);
  }
  else
  {
    $no='0'.$t.$no;
  }
  return $no;
}
?>
