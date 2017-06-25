<?php
namespace Jarm\App\Story\Method;
use Jarm\Core\Load;

class Profile
{
  private $story;
  public function __construct($story)
  {
    $this->story = $story;
  }

  public function get()
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
}
?>
