<?php
namespace Jarm\App\Glitter;
use Jarm\Core\Load;

class Download extends Service
{
  public function get_download()
  {
    $db=Load::DB();
    if((!$glitter=$db->findone('glitter',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]])) || !$glitter['zp'])
    {
      Load::move('/');
    }
    $db->update('glitter',['_id'=>$glitter['_id']],['$set'=>['do'=>intval($glitter['do'])+1]]);
    Load::move([$glitter['sv'],'/glitter/'.$glitter['fd'].'/'.$glitter['zp']],true);
  }
}
?>
