<?php
namespace Jarm\App\Tv;
use Jarm\Core\Load;

class Home extends Service
{
  public function get_home()
  {
    //$date = intval(date('Ymd',strtotime('-3 days')));
    define('HIDE_SIDEBAR',1);
    $cate=[];
    $db=Load::DB();
    $c=$db->find('tv_cate',[],[],['sort'=>['id'=>1]]);
    for($i=0;$i<count($c);$i++)
    {
      if($c[$i]['count'])
      {
        $c[$i]['program']=$db->find('tv_list',['dd'=>['$exists'=>false],'cate_id'=>intval($c[$i]['id'])],[],['sort'=>['modified_date'=>-1],'limit'=>8]);
        $cate[$c[$i]['id']]=$c[$i];
      }
    }
    Load::$core->data['content']=Load::$core
      ->assign('cate',$cate)
      ->fetch('tv/home');
  }
}
?>
