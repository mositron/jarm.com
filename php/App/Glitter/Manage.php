<?php
namespace Jarm\App\Glitter;
use Jarm\Core\Load;

class Manage extends Service
{
  public function _manage()
  {
    Load::Session()->logged();
    Load::Ajax()->register(['digglitter','delglitter','addtab']);
    $db=Load::DB();
    extract(Load::Split()->get('/manage/',0,['page']));
    $arg = ['u'=>Load::$my['_id'],'dd'=>['$exists'=>false]];
    if(Load::$my['am'])
    {
      unset($arg['u']);
    }
    if($count=$db->count('glitter',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation(44,$count,['/manage/','page-'],$page);
      $glitter=$db->find('glitter',$arg,['_id'=>1,'t'=>1,'sv'=>1,'fd'=>1,'c'=>1,'ty'=>1,'zp'=>1,'da'=>1],['skip'=>$skip,'limit'=>44,'sort'=>['_id'=>-1]]);
    }
    Load::$core->data['content']=Load::$core
      ->assign('count',$count)
      ->assign('glitter',$glitter)
      ->assign('pager',$pg)
      ->fetch('glitter/manage');
  }

  public function delglitter($i)
  {
    $db=Load::DB();
    $arg=['_id'=>intval($i),'u'=>Load::$my['_id'],'dd'=>['$exists'=>false]];
    if(Load::$my['am'])
    {
      unset($arg['u']);
    }
    if($glitter=$db->findone('glitter',$arg))
    {
      $db->update('glitter',['_id'=>$glitter['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
      Load::Upload()->post($glitter['sv'],'delete','glitter/'.$glitter['fd'].'/s.'.$glitter['ty']);
      Load::Upload()->post($glitter['sv'],'delete','glitter/'.$glitter['fd'].'/t.'.$glitter['ty']);
      Load::Upload()->post($glitter['sv'],'delete','glitter/'.$glitter['fd'].'/l.'.$glitter['ty']);
      Load::Upload()->post($glitter['sv'],'delete','glitter/'.$glitter['fd'].'/glitter.jarm.com-'.$glitter['_id'].'.zip');
    }
    Load::Ajax()->redirect(URL);
  }
}
?>
