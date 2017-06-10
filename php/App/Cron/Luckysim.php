<?php
namespace Jarm\App\Cron;
use Jarm\Core\Load;

class luckysim extends Service
{
  public function get_luckysim()
  {
    $db = Load::DB();
    if($e = $db->find('horo_phone',[],['_id'=>1,'du'=>1],['sort'=>['du'=>1],'limit'=>1]))
    {
      $data = json_decode(file_get_contents('http://www.luckysim.com/api.php?'.$e[0]['_id']),true);
      if($data['status']=='OK')
      {
        $db->update('horo_phone',['_id'=>$e[0]['_id']],['$set'=>['mb'=>$data['data'],'du'=>Load::Time()->now()]]);
      }

      print_r($e);
      print_r($data);
    }
  }
}
?>
