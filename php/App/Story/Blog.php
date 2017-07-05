<?php
namespace Jarm\App\Story;
use Jarm\Core\Load;

class Blog extends Service
{
  public function _blog()
  {
    Load::Session()->logged();
    if(Load::$path[1])
    {
      if(Load::$path[2]=='edit')
      {
        return $this->blog_edit();
      }
      else
      {
        return $this->blog_view();
      }
    }
    else
    {
      return $this->blog_home();
    }
  }

  function blog_home()
  {
    Load::Ajax()->register(['newblog'],$this);
    $db=Load::DB();
    $blog=$db->find('story_blog',['dd'=>['$exists'=>false],'$or'=>[['u'=>Load::$my['_id']],['am'=>Load::$my['_id']]]]);
    return Load::$core
      ->assign('blog',$blog)
      ->fetch('story/blog.home');
  }

  function blog_view()
  {
    //Load::Ajax()->register(['newblog'],$this)
    $db=Load::DB();
    if(!$blog=$db->findone('story_blog',['dd'=>['$exists'=>false],'l'=>Load::$path[1],'$or'=>[['u'=>Load::$my['_id']],['am'=>Load::$my['_id']]]]))
    {
      return ['move'=>'/blog'];
    }

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
    extract(Load::Split()->get('/blog/'.$blog['l'].'/',2,['page','c']));
    $arg = ['dd'=>['$exists'=>false]];
    if(!Load::$my['am'])
    {
      $arg['u']=Load::$my['_id'];
    }
    //Load::$core->data['title']='Admin - หน้ารวมข่าว';
    if(isset($c))
    {
      $arg['c']=intval($cp[0]);
      $url .= 'c-'.$c.'/';
    }
    if($count=$db->count('story_post',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation(50,$count,[$url,'page-'],$page);
      $post=$db->find('story_post',$arg,[],['skip'=>$skip,'limit'=>50,'sort'=>['_id'=>-1]]);
    }

    return Load::$core
      ->assign('count',$count)
      ->assign('post',$post)
      ->assign('pager',$pg)
      ->assign('user',Load::User())
      ->assign('blog',$blog)
      ->fetch('story/blog.view');
  }

  function blog_edit()
  {
    //Load::Ajax()->register(['newblog'],$this)
    $db=Load::DB();
    if(!$blog=$db->findone('story_blog',['dd'=>['$exists'=>false],'l'=>Load::$path[1],'$or'=>[['u'=>Load::$my['_id']],['am'=>Load::$my['_id']]]]))
    {
      return ['move'=>'/blog'];
    }
    return Load::$core
      ->assign('blog',$blog)
      ->fetch('story/blog.edit');
  }

  public function newblog($arg)
  {
    $ajax=Load::Ajax();
    $db=Load::DB();
    $t=mb_substr(trim(strip_tags($arg['title'])),0,100);
    $d=mb_substr(trim(strip_tags($arg['detail'])),0,200);
    $c=($this->cate[$arg['cate']]?intval($arg['cate']):0);
    $u=trim(strtolower($arg['username']));
    if(!preg_match('/^([a-z]{1})([a-z0-9]{5,15})$/',$u))
    {
      $ajax->alert('ไม่สามารถใช้ '.$u.' ได้');
      $ajax->script('$("#username").focus();');
    }
    elseif($db->findone('story_blog',['l'=>$u]))
    {
      $ajax->alert('มีผู้ใช้งาน '.$u.' แล้ว');
      $ajax->script('$("#username").focus();');
    }
    elseif($t&&$d&&$c&&$u)
    {
      if($id=$db->insert('story_blog',['t'=>$t,'d'=>$d,'l'=>$u,'c'=>$c,'u'=>Load::$my['_id']]))
      {
        $ajax->redirect('/blog/select?'.$id);
      }
    }
  }
}
?>
