<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Article_Home
{
  public function __construct()
  {
  }
  public function get($parent,$id)
  {
    define('EXPIRE_ARTICLE',3650);
    Load::Ajax()->register(['delarticle','newarticle','instant']);
    $allby=['desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง'];
    extract(Load::Split()->get('/',0,['c'],['ds'=>'อัพเดทล่าสุด'],$allby));
    $url='/article/';
    $db=Load::DB();
    extract(Load::Split()->get('/article/',1,['page']));
    $arg = ['dd'=>['$exists'=>false]];
    Load::$core->data['title']='บทความ - หน้ารวมบทความ - '.Load::$core->data['title'];
    if(isset($c))
    {
      $cs=explode('_',$c);
      if($cs[0])
      {
        $arg['sv']=$cs[0];
      }
      if($cs[1])
      {
        $arg['c']=intval($cs[1]);
      }
      $url .= 'c-'.$c.'/';
    }
    if($count=$db->count('article',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation(50,$count,[$url,'page-'],$page);
      $article=$parent->find($arg,['img'=>1],['skip'=>$skip,'limit'=>50,'sort'=>['da'=>-1]]);
    }
    return Load::$core
      ->assign('count',$count)
      ->assign('article',$article)
      ->assign('pager',$pg)
      ->assign('arg',$arg)
      ->assign('user',Load::User())
      ->fetch('control/article.home');
  }
}
?>
