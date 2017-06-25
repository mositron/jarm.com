<?php
namespace Jarm\App\Image;
use Jarm\Core\Load;

class V extends Service
{
  public function _v()
  {
    list($f,$ty)=explode('.',Load::$path[1],2);
    $db=Load::DB();
    if($image=$db->findone('image',['f'=>$f,'dd'=>['$exists'=>false]]))
    {
      if($ty!=$image['ty'])
      {
        Load::move('/v/'.$image['f'].'.'.$image['ty'],true);
      }
      if(!Load::$my && !Load::$my['am'])
      {
        $db->update('image',['_id'=>$image['_id']],['$set'=>['ds'=>Load::Time()->now()],'$inc'=>['do'=>1]]);
      }
      Load::$core->data['title'] = 'รูปภาพ '.$image['n'].' - '.Load::$path[0].' - '.Load::$core->data['title'];
      Load::$core->data['description'] = 'รูปภาพ '.$image['n'].' - '.Load::$path[0].' - '.Load::$core->data['description'];
      return Load::$core
        ->assign('image',$image)
        ->fetch('image/view');
    }
    else
    {
      Load::move('/',true);
    }
  }
}
?>
