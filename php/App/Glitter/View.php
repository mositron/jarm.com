<?php
namespace Jarm\App\Glitter;
use Jarm\Core\Load;

class View extends Service
{
  public function _view()
  {
    $db=Load::DB();
    if(!$glitter=$db->findone('glitter',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]]))
    {
      Load::move('/');
    }
    define('GLITTER_ID',intval($glitter['_id']));

    Load::Ajax()->register('recommend');

    Load::$core->data['title']=$glitter['t'];
    Load::$core->data['description']=$glitter['t'].' - '.Load::$core->data['title'];
    Load::$core->data['image']='http://'.$glitter['sv'].'.jarm.com/glitter/'.$glitter['fd'].'/l.'.$glitter['ty'];

    $c=0;
    $in=false;
    if(count($glitter['c']))
    {
      $c=$glitter['c'][0];
      $relate=$db->find('glitter',['dd'=>['$exists'=>false],'_id'=>['$ne'=>$glitter['_id']],'c'=>['$in'=>$glitter['c']]],['_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1],['sort'=>['_id'=>-1],'limit'=>80]);
    }
    else
    {
        $relate=$db->find('glitter',['dd'=>['$exists'=>false],'_id'=>['$ne'=>$glitter['_id']]],['_id'=>1,'t'=>1,'l'=>1,'fd'=>1,'c'=>1,'cs'=>1,'p'=>1,'ds'=>1,'ty'=>1,'pr'=>1],['sort'=>['_id'=>-1],'limit'=>80]);
    }
    if($relate)
    {
      shuffle($relate);
      $relate=array_slice(array_values($relate),0,52);
    }

    return Load::$core
      ->assign('relate',$relate)
      ->assign('glitter',$glitter)
      ->assign('c',$c)
      ->assign('user',Load::User()->get($glitter['u']))
      ->fetch('glitter/view');
  }

  public function recommend()
  {
    if(Load::$my['am'])
    {
      Load::DB()->update('glitter',['_id'=>GLITTER_ID],['$set'=>['rc'=>Load::Time()->now()]]);
      Load::$core->delete('glitter.jarm.com/home');
      Load::Ajax()->alert('ตั้งเป็นกลิตเตอร์แนะนำเรียบร้อยแล้ว');
    }
  }
}
?>
