<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class News_Home
{
  public function __construct()
  {
  }
  public function get($parent,$id)
  {
    Load::Session()->logged();
    define('EXPIRE_NEWS',3650);
    Load::Ajax()->register(['delnews','newnews','instant']);
    $allby=['desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง'];
    extract(Load::Split()->get('/',0,['c'],['ds'=>'อัพเดทล่าสุด'],$allby));
    if(!empty($c))
    {
      $cp=explode('_',$c);
      if(empty(Load::$conf['news'][$cp[0]]))
      {
        unset($c);
      }
    }
    $url='/news/';

    $db=Load::DB();
    extract(Load::Split()->get('/news/',1,['page']));
    $arg = ['dd'=>['$exists'=>false]];
    if(!Load::$my['am'])
    {
      $arg['u']=Load::$my['_id'];
    }
    Load::$core->data['title']='ข่าว - หน้ารวมข่าว - '.Load::$core->data['title'];
    if(isset($c))
    {
      $arg['c']=intval($cp[0]);
      if($cp[1])
      {
        $arg['cs']=intval($cp[1]);
      }
      if($cp[2])
      {
        $arg['cs2']=intval($cp[2]);
      }
      $url .= 'c-'.$c.'/';
    }
    if($count=$db->count('news',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation(50,$count,[$url,'page-'],$page);
      $news=(new \Jarm\App\News\Service(['ignore'=>1]))->find($arg,['wt'=>1,'img'=>1],['skip'=>$skip,'limit'=>50,'sort'=>['da'=>-1]]);
    }
    $date = intval(date('Ymd',strtotime('-5 days')));
    $key=$db->find('trend_key',['date'=>['$gte'=>$date],'dd'=>['$exists'=>false]],[],['sort'=>['date'=>-1,'time'=>-1]]);
    $trends=[];
    $last='';
    for($i=0;$i<count($key);$i++)
    {
      $d=$key[$i];
      if(!isset($trends[$d['date']]))
      {
        $trends[$d['date']] = [];
      }
      $trends[$d['date']][]=$d;
    }
    return Load::$core
      ->assign('trends',$trends)
      ->assign('count',$count)
      ->assign('news',$news)
      ->assign('pager',$pg)
      ->assign('cp',$cp??'')
      ->assign('user',Load::User())
      ->fetch('control/news.home');
  }
}
?>
