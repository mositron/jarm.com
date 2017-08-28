<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Article extends Service
{
  public $article=[];

  public function _article()
  {
    Load::Session()->logged();
    if(!Load::$my['am'])
    {
      Load::move('/article');
    }
    $path=(Load::$path[1]?:'home');
    if(is_numeric($path))
    {
      return (new \Jarm\App\Control\Article_Update())->get($this,$path);
    }
    elseif(in_array($path,['upload','report','view-day']))
    {
      $c='\Jarm\App\Control\Article_'.ucfirst(str_replace('-','',$path));
      return (new $c())->get($this,Load::$path[2]);
    }
    else
    {
      return (new \Jarm\App\Control\Article_Home())->get($this,$path);
    }
  }

  public function delarticle($i)
  {
    $db=Load::DB();
    $redirect='';
    if($this->article=$db->findone('article',['_id'=>intval($i),'dd'=>['$exists'=>false]]))
    {
      $this->article=$this->fetch($this->article);
      $q=$this->api($this->article['sv'],'post','',['_id'=>$this->article['_id'],'sv'=>$this->article['sv'],'fd'=>$this->article['fd'],'dd'=>Load::Time()->now()]);
      if($q['status']!='OK')
      {
        $redirect='?server-error';
      }
      else
      {
        $db->update('article',['_id'=>$this->article['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
      }
    }
    Load::Ajax()->redirect(URL.$redirect);
  }

  public function newarticle($arg)
  {
    $ajax=Load::Ajax();
    $db=Load::DB();
    if(!$arg['title'])
    {
      $ajax->alert('กรุณากรอกชื่อบทความ');
    }
    elseif(!$arg['type'])
    {
      $ajax->alert('กรุณาเลือกประเภทบทความ');
    }
    else
    {
      $sv=explode('#',$arg['type']);
      $_=[
        't'=>mb_substr(trim($arg['title']),0,100,'utf-8'),
        'u'=>Load::$my['_id'],
        'un'=>Load::$my['name'],
        'pl'=>0,
        'c'=>[intval($sv[1])],
        'sv'=>trim($sv[0])
      ];

      if($_['sv']&&!isset(Load::$conf['server']['article'][$_['sv']]))
      {
        $_['sv']='';
      }
      if(!$_['sv'])
      {
        $ajax->alert('ไม่มี server รองรับการ upload รูปภาพ');
      }
      elseif($id=$db->insert('article',$_))
      {
        if($last=$db->find('article',['sv'=>$_['sv']],['no'=>1],['sort'=>['no'=>-1],'limit'=>1]))
        {
          $idx=intval($last[0]['no'])+1;
        }
        else
        {
          $idx=1;
        }
        $db->update('article',['_id'=>$id],['$set'=>['no'=>$idx,'fd'=>date('Y/m/').$idx]]);
        $ajax->redirect('/article/'.$id);
      }
      else
      {
        $ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');
      }
    }
  }

  public function delattach($a)
  {
    if($a)
    {
      $this->api($this->article['sv'],'delete',$a,['sv'=>$this->article['sv'],'fd'=>$this->article['fd']]);
    }
    Load::Ajax()->redirect(URL);
  }

  public function api(string $serv,string $method,string $file,$data='')
  {
    if(isset(Load::$conf['server']['article'][$serv]))
    {
      $addr = Load::$conf['server']['article'][$serv];
      $tmp=json_encode($data);
      $key=md5($method.$addr['key'].$tmp);
      if(substr($file,0,1)=='@')
      {
        $file=new \CurlFile(substr($file,1));
      }
      $json=Load::Http()->get($addr['upload'],['key'=>$key,'method'=>$method,'file'=>$file,'data'=>$tmp]);
/*
      if($method=='post')
      {
        echo $json;
        exit;
      }
*/
      return json_decode($json,true);
    }
    else
    {
      return ['status'=>'FAIL','message'=>'no server'];
    }
  }

  public function find(array $cond=[],array $arg=[],array $sort=[]): ?array
  {
    if($n=Load::DB()->find('article',
      array_merge(['dd'=>['$exists'=>false]],$cond),
      array_merge(['_id'=>1,'no'=>1,'t'=>1,'fd'=>1,'da'=>1,'ds'=>1,'di'=>1,'de'=>1,'u'=>1,'ue'=>1,'do'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1,'sv'=>1,'pl'=>1,'is'=>1],$arg),
      array_merge(['sort'=>['ds'=>-1],'skip'=>0,'limit'=>100],$sort)))
    {
      for($i=0;$i<count($n);$i++)
      {
        $n[$i]=$this->fetch($n[$i]);
      }
      return $n;
    }
    return null;
  }

  public function fetch(array $n): ?array
  {
    $img='https://'.$n['sv'].'/files/'.$n['fd'].'/';
    return array_merge($n,[
                'title'=>$n['t'],
                'link'=>$n['pr']?:$this->link($n),
            //    'cate'=>Load::$conf['article'][$n['c']]['t'],
                'sec'=>Load::Time()->sec($n['ds']),
                'ago'=>Load::Time()->from($n['ds'],'ago'),
                'pl'=>($n['pl']?:0),
                'do'=>($n['do']?:0),
                'is'=>($n['is']?:0),
                'img_s'=>$img.'small.jpg',
                'img_m'=>$img.'original.jpg'
    ]);
  }

  public function link(array $n): string
  {
    return 'https://'.$n['sv'].'/view/'.$n['no'];
  }
}
?>
