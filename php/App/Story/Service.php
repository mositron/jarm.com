<?php
namespace Jarm\App\Story;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public $cate=[
    1=>['t'=>'การ์ตูน'],
    2=>['t'=>'กีฬา'],
    3=>['t'=>'เกมส์'],
    4=>['t'=>'เขียนโปรแกรม'],
    5=>['t'=>'ความสวยงาม สุขภาพ'],
    6=>['t'=>'ท่องเที่ยว'],
    7=>['t'=>'เทคโนโลยี'],
    8=>['t'=>'บุคคล'],
    9=>['t'=>'วัฒนธรรม สังคม'],
    10=>['t'=>'ศิลปะ'],
    11=>['t'=>'สื่อ ภาพยนต์ ละคร เพลง ดารา นักร้อง'],
    12=>['t'=>'อาหาร'],
    99=>['t'=>'อื่นๆ']
  ];
  public function __construct()
  {
    $navpost='';
    if(Load::$my)
    {
      if($blog=Load::DB()->find('story_blog',['dd'=>['$exists'=>false],'$or'=>[['u'=>Load::$my['_id']],['am'=>Load::$my['_id']]]]))
      {
        foreach ($blog as $v)
        {
          $navpost.='<li><a href="/post/'.$v['l'].'">- '.$v['t'].'</a></li>';
        }
      }
    }
    $path=(Load::$path[0]?:'home');
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'Story | Jarm.com',
      'description'=>'Story | Jarm.com',
      'keywords'=>'Story, jarm',
      'nav-header'=>'',
      'hide_adsense'=>true,
      'sc-bottom'=>false,
      'nav-fixed'=>['<a href="/post" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-plus" style="font-size:80%"></span> เขียนเรื่องใหม่ <span class="caret"></span></a><ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu"><li><a href="/post">เขียนเรื่องใหม่</a></li>'.$navpost.'<li class="divider"></li><li><a href="/blog">จัดการบล็อก</a></li></ul>','<li><a href="/post">เขียนเรื่องใหม่</a></li>'.$navpost.'<li><a href="/blog">จัดการบล็อก</a></li>']
    ]);
    Load::$core->assign('cate',$this->cate);

    Load::$conf['social']['facebook']['appid']='1256528277809902';
    Load::$conf['social']['facebook']['pageid']='1488808187842873';
    Load::$conf['social']['facebook']['audience']=['1256528277809902_1256528291143234','1256528277809902_1256531684476228','1256528277809902_1256532347809495','1256528277809902_1256532467809483'];

/*
    if(Load::$my['st']!=1)
    {
      Load::$core->data['content']=Load::$core->fetch('story/permission');
      echo Load::$core->assign('data',Load::$core->data)
                      ->fetch('global',true);
      exit;
    }
    */
  }

  public function _byblog()
  {
    $db=Load::DB();
    if(Load::$path[0])
    {
      if(!$this->blog=$db->findone('story_blog',['dd'=>['$exists'=>false],'l'=>Load::$path[0]]))
      {
        return ['move'=>'/?no-blog'];
      }
      if(Load::$path[1])
      {
        if(!$this->post=$db->findone('story_post',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false],'pl'=>1,'b'=>$this->blog['_id']]))
        {
          return ['move'=>'/'.$this->blog['l'].'?no-post'];
        }
        if(!empty(Load::$path[2]) && (Load::$path[2]!=$this->post['l']))
        {
          return ['move'=>'/'.$this->blog['l'].'/'.$this->post['_id'].'/'.$this->post['l']];
        }
        Load::$core->data['canonical']='https://story.jarm.com/'.$this->post['bl'].'/'.$this->post['_id'];
        $poster=Load::User()->get($this->post['u']);
        Load::$core->data['title']=$this->post['t'].' - '.$this->blog['t'].' - '.$poster['name'];
        Load::$core->data['description']=$this->post['t'].' - '.$this->blog['t'].' | Jarm.com';
        Load::$core->data['keywords']=implode(', ',(array)$this->post['tags']).', '.$this->story->cate[$this->post['c']]['t'].', '.$this->blog['t'];
        if(count($this->post['img'])>0)
        {
          Load::$core->data['image']='https://'.$this->post['sv'].'.jarm.com/story/'.$this->post['fd'].'/'.$this->post['img'][0];
        }
        $prev=$db->find('story_post',['dd'=>['$exists'=>false],'pl'=>1,'b'=>$this->blog['_id'],'_id'=>['$lt'=>$this->post['_id']]],[],['sort'=>['_id'=>-1],'limit'=>1]);
        $next=$db->find('story_post',['dd'=>['$exists'=>false],'pl'=>1,'b'=>$this->blog['_id'],'_id'=>['$gt'=>$this->post['_id']]],[],['sort'=>['_id'=>1],'limit'=>1]);
        return Load::$core
          ->assign('post',$this->post)
          ->assign('blog',$this->blog)
          ->assign('prev',$prev[0])
          ->assign('next',$next[0])
          ->assign('user',$poster)
          ->fetch('story/view');
      }
      else
      {
        $this->post=$db->find('story_post',['dd'=>['$exists'=>false],'pl'=>1,'b'=>$this->blog['_id']],[],['sort'=>['ds'=>-1],'limit'=>20]);
        Load::$core->data['title']=$this->blog['t'].' - '.$this->story->cate[$this->blog['c']]['t'].' - Jarm.com';
        Load::$core->data['description']=$this->blog['t'].' - '.$this->blog['d'].' | Jarm.com';
        Load::$core->data['keywords']=$this->blog['t'].', '.$this->story->cate[$this->blog['c']]['t'];
        return Load::$core
          ->assign('post',$this->post)
          ->assign('blog',$this->blog)
          ->assign('user',Load::User())
          ->fetch('story/byblog');
      }
    }
    return ['move'=>'/'];
  }

  public function get_stats()
  {
    if(!$id=intval(Load::$path[1]))
    {
      exit;
    }
    Load::cache();
    Load::$core->data['stats']=Load::$sub.':'.$id.':is';
    Load::$core->data['echo']='/* stats */';
  }

  public function check_perm($key,$am=1)
  {
    if(Load::$my['am']>=$am)
    {
      return true;
    }
    return false;
  }
}
?>
