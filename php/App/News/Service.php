<?php
namespace Jarm\App\News;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  //public static $arg_list=['_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'ds'=>1,'di'=>1,'do'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1,'sv'=>1];
  public static $arg_view=['_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'ds'=>1,'di'=>1,'do'=>1,'c'=>1,'cs'=>1,'cs2'=>1,'d'=>1,'sv'=>1,'u'=>1,'exl'=>1,'url'=>1,'tags'=>1,'sh'=>1];

  public function __construct(array $arg=[])
  {
    if(!isset($arg['ignore']))
    {
      Load::$core->data=array_merge(Load::$core->data,[
        'title'=>'ข่าว ข่าววันนี้ ข่าวเด่น ข่าวการเมือง ข่าวสังคมออนไลน์ ข่าวติดกระแส ข่าวบันเทิง ข่าวเกมส์ ข่าวเทคโนโลยี ข่าวภาพยนตร์ ข่าวกีฬา ข่าวไลฟ์สไตล์ ข่าวหวย',
        'description'=>'ข่าว ข่าววันนี้ ข่าวเด่น ข่าวการเมือง ข่าวสังคมออนไลน์ ข่าวติดกระแส  ข่าวบันเทิง เกาะติด ข่าวเด็ดประเด็นข่าวร้อน ใหม่ สด ทันเหตุการณ์ จากทุกสำนักข่าว ถูกรวบรวมไว้ที่นี่',
        'keywords'=>'ข่าว, ข่าววันนี้, ข่าวเด่น, ข่าวสังคมออนไลน์, ข่าวติดกระแส, การเมือง, เศรษฐกิจ, บันเทิง, อาชญากรรม, เทศโนโลยี, สังคม, ดารา, กีฬา, ท่องเที่ยว',
      ]);

      if($arg['cate'])
      {
        $cate=Load::$conf['news'][$arg['cate']];
        $path=(Load::$path[1]??'');
        if(is_array($cate['s']))
        {
          $tmp='';
          foreach($cate['s'] as $k=>$v)
          {
            $tmp.='<li><a href="/cate/'.$k.'"'.($path==$k?' class="active"':'').'>'.$v['t'].'</a></li>';
          }
          Load::$core->data['nav-header']='<ul><li><a href="/" title="'.$cate['t'].'"'.(!Load::$path[0]?' class="active"':'').'>'.$cate['t'].'</a></li>'.$tmp.'</ul>';
        }
      }
    }
  }

  public function _home(array $arg=[])
  {
    Load::cache();
    return (Load::$sub=='news'?$this->home_index($arg):$this->home_cate($arg));
  }

  private function home_index(array $arg=[])
  {
    Load::Ajax()->register(['loadmore'],$this);
    return Load::$core
      ->assign('hot',$this->find(['pl'=>1,'ds'=>['$lte'=>Load::Time()->now(-3600*3),'$gte'=>Load::Time()->now(-3600*27)]],[],['sort'=>['do'=>-1],'skip'=>20,'limit'=>20]))
      ->assign('news',$this->find(['pl'=>1,'c'=>['$nin'=>[11,12]]],[],['limit'=>104]))
      ->fetch('news/home');
  }

  private function home_cate(array $arg=[])
  {
    $cond=['pl'=>1,'c'=>$arg['cate'],'ds'=>['$lte'=>Load::Time()->now(-3600*3)]];
    $gte=($arg['hot']??0);
    if($gte>0)
    {
      $cond['ds']['$gte']=Load::Time()->now(-3600*24*$gte);
    }
    Load::$core->data['title']=Load::$conf['news'][$arg['cate']]['t'].' | '.Load::$core->data['title'];
    Load::$core->data['description']=Load::$conf['news'][$arg['cate']]['t'].' | '.Load::$core->data['description'];
    Load::$core->data['keywords']=Load::$conf['news'][$arg['cate']]['t'].', '.Load::$core->data['keywords'];
    return Load::$core
      ->assign('hot',$this->find($cond,[],['sort'=>['do'=>-1],'limit'=>20]))
      ->assign('news',$this->find(['pl'=>1,'c'=>$arg['cate']],[],['limit'=>104]))
      ->fetch('news/home_cate');
  }

  public function _admin()
  {
    return ['move'=>['control','/news']];
  }

  public function get_stats()
  {
    if(!$id=intval(Load::$path[1]))
    {
      exit;
    }
    Load::cache();
    Load::$core->data['stats']='news:'.$id.':is';
    Load::$core->data['echo']='/* stats */';
  }
  public function find(array $cond=[],array $arg=[],array $sort=[]): ?array
  {
    if($n=Load::DB()->find('news',
      array_merge(['dd'=>['$exists'=>false]],$cond),
      array_merge(['_id'=>1,'t'=>1,'fd'=>1,'da'=>1,'ds'=>1,'di'=>1,'de'=>1,'u'=>1,'ue'=>1,'do'=>1,'c'=>1,'cs'=>1,'exl'=>1,'url'=>1,'sv'=>1,'pl'=>1,'is'=>1],$arg),
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

  public function findAll(string $type,int $limit=13,array $arg=[]): array
  {
    $db=Load::DB();
    if(!empty($arg['rc']))
    {
      $arg['ds']=['$gte'=>Load::Time()->now(-3600*48)];
    }
    $arg['pl']=1;
    if($adver=$db->find('ads',['dd'=>['$exists'=>false],'pl'=>1,'ty'=>'advertorial','boxza.'.$type=>['$exists'=>true],'dt1'=>['$lte'=>Load::Time()->now()],'dt2'=>['$gte'=>Load::Time()->now()]],[],['sort'=>['so'=>1,'_id'=>1]]))
    {
      $advs=[];
      $nin=[];
      for($j=0;$j<count($adver);$j++)
      {
        $tmp=$adver[$j];
        if($adv=$this->find(['_id'=>$tmp['content']],[],['limit'=>1]))
        {
          $d=strtr(base64_encode(json_encode(['i'=>$tmp['_id'],'l'=>$adv[0]['link'],'t'=>time()])), '+/', '-_');
          $adv[0]['cls']='n-ads';
          $adv[0]['pr']=Load::$conf['scheme'].'://code.'.Load::$conf['domain'].'/click/?__b='.urlencode($d);
          $advs[]=$adv[0];
          $nin[]=$tmp['content'];
        }
      }
      if(count($nin))
      {
        $arg['_id']=['$nin'=>$nin];
      }
      $ct=$this->find($arg,[],['limit'=>$limit]);
      if(count($advs))
      {
        $ct=array_slice(array_merge((array)$advs,(array)$ct),0,$limit);
      }
    }
    else
    {
      $ct=$this->find($arg,[],['limit'=>$limit]);
    }
    for($i=0;$i<count($ct);$i++)
    {
      if($ct[$i]['cls'])
      {
        $ct[$i]['cls'].=' n-findA-first';
      }
      else
      {
        $ct[$i]['cls']='n-findA-first';
      }
    }
    if(count($ct)<$limit)
    {
      unset($arg['rc'],$arg['ds']);
      $arg['_id']=['$nin'=>[]];
      for($i=0;$i<count($ct);$i++)
      {
        $ct[$i]['cls'].=' n-gt-'.$limit;
        $arg['_id']['$nin'][]=$ct[$i]['_id'];
      }
      $ct2=$this->find($arg,[],['limit'=>$limit-count($ct)]);
      for($i=0;$i<count($ct2);$i++)
      {
        $ct2[$i]['cls']='n-findA-sec n-gt-'.count($ct2);
      }
      return array_merge((array)$ct,(array)$ct2);
    }
    return $ct;
  }

  public function _news()
  {
    return ['move'=>'/view/'.Load::$path[1]];
  }

  public function _view()
  {
    if(!$id=intval(Load::$path[1]))
    {
      return ['move'=>'/'];
    }

    Load::cache();
    $db=Load::DB();
    if(!$news=$db->findone('news',['_id'=>$id,'dd'=>['$exists'=>false],'pl'=>['$gte'=>1]],self::$arg_view))
    {
      return ['move'=>'/'];
    }
    if($news['exl'])
    {
      return ['move'=>$news['url'],'stats'=>'news:'.$news['_id'].':do'];
    }
    $news=$this->fetch($news);
    $user=Load::User()->get($news['u']);
    $ctitle=(array)$news['tags'];
    Load::$core->data['stats']='news:'.$news['_id'].':do';
    Load::$core->data['title']=$news['t'];
    Load::$core->data['description']=$news['t'].' - '.Load::$conf['news'][$news['c']]['t'].' '.implode(' ',$ctitle).' ข่าวล่าสุด ข่าววันนี้ ข่าวด่วน ข่าวเด่น';
    Load::$core->data['keywords']=implode(', ',$ctitle).','.Load::$conf['news'][$news['c']]['t'];
    Load::$core->data['feed']=['title'=>Load::$conf['news'][$news['c']]['t'],'url'=>Load::$conf['scheme'].'://feed.'.Load::$conf['domain'].'/news-'.$news['c'].'/rss'];
    Load::$core->data['image']=$news['img_m'];
    if(Load::$core->data['img_cache'])
    {
      Load::$core->data['image_cache']=Load::$conf['scheme'].'://cache.'.Load::$conf['domain'].'/'.Load::getServ($news['sv']).'/news/'.$news['fd'].'/m.jpg';
    }
    Load::$core->data['image_type']='image/jpeg';
    Load::$core->data['type']='article';

    $arg=['_id'=>['$ne'=>$news['_id']],'c'=>$news['c'],'pl'=>1];
    if($news['cs'])
    {
      $arg['cs']=$news['cs'];
    }

    if($adver=$db->find('ads',['dd'=>['$exists'=>false],'pl'=>1,'ty'=>'relate','boxza.'.Load::$sub=>['$exists'=>true],'dt1'=>['$lte'=>Load::Time()->now()],'dt2'=>['$gte'=>Load::Time()->now()]],[],['sort'=>['so'=>1,'_id'=>1]]))
    {
      shuffle($adver);
      $advs=[];
      $nin=[];
      for($j=0;$j<count($adver);$j++)
      {
        $tmp=$adver[$j];
        if($adv=$this->find(['_id'=>$tmp['content']],[],['limit'=>1]))
        {
          $d=strtr(base64_encode(json_encode(['i'=>$tmp['_id'],'l'=>$adv[0]['link'],'t'=>time()])), '+/', '-_');
          $adv[0]['pr']=Load::$conf['scheme'].'://code.'.Load::$conf['domain'].'/click/?__b='.urlencode($d);
          $advs[]=$adv[0];
          $nin[]=$tmp['content'];
        }
      }
      if(count($nin))
      {
        $arg['_id']['$nin']=$nin;
      }
      $relate=$this->find($arg,[],['limit'=>10]);
      if(count($advs))
      {
        $relate=array_slice(array_merge($advs,$relate),0,10);
      }
    }
    else
    {
      $relate=$this->find($arg,[],['limit'=>10]);
    }

    return Load::$core
      ->assign('user',$user)
      ->assign('news',$news)
      ->assign('ncate',Load::$conf['news'][$news['c']])
      ->assign('relate',$relate)
      ->fetch('news/view');
  }

  public function _cate($arg)
  {
    $c=[];
    $nav=[];
    if(!$cid=intval(Load::$path[1]))
    {
      return ['move'=>'/'];
    }
    if(Load::$path[2])
    {
      list($k,$page)=explode('-',Load::$path[2],2);
      if($k!='page' || !is_numeric($page))
      {
        return ['move'=>'/'];
      }
    }
    if($arg['cate'])
    {
      $cate=Load::$conf['news'][$arg['cate']];
      $nav[]=['link'=>'/','title'=>$cate['t']];
      if($cs=$cate['s'][$cid])
      {
        $c=['c'=>$arg['cate'],'cs'=>$cid];
        $t=$cs['t'].' - '.$cate['t'];
        $nav[]=['link'=>'/cate/'.$cid,'title'=>$cs['t']];

      }
      else
      {
        return ['move'=>'/'];
      }
    }
    else
    {
      $c=['c'=>$cid];
      $cate=Load::$conf['news'][$cid];
      $t=$cate['t'];
      $nav[]=['link'=>'/cate/'.$cid,'title'=>$cate['t']];
    }
    Load::cache(3600,3);
    Load::$core->data['title']=$t.' | '.Load::$core->data['title'];
    Load::$core->data['description']=$t.' | '.Load::$core->data['description'];
    Load::$core->data['keywords']=$t.', '.Load::$core->data['keywords'];

    $db=Load::DB();
    $_ = array_merge(['dd'=>['$exists'=>false],'pl'=>1],$c);
    if($count=$db->count('news',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation(80,$count,['/cate/'.$cid,'/page-'],$page);
      $news=$this->find($_,[],['skip'=>$skip,'limit'=>80]);
    }
    return Load::$core
      ->assign('news',$news)
      ->assign('nav',$nav)
      ->assign('pager',$pg)
      ->fetch('news/list');
  }

  public function fetch(array $n): ?array
  {
    #if(!$n) return null;
    # default: jarm.com
    //$img=Load::$conf['scheme'].'://'.Load::getServ($n['sv']).'.'.Load::$conf['domain'].'/news/'.$n['fd'];
    $img=Load::uri([Load::getServ($n['sv']),'/news/'.$n['fd'].'/']);
    return array_merge($n,[
                'title'=>$n['t'],
                'link'=>$n['pr']??$this->link($n),
                'cate'=>Load::$conf['news'][$n['c']]['t'],
                'sec'=>Load::Time()->sec($n['ds']),
                'ago'=>Load::Time()->from($n['ds'],'ago'),
                'pl'=>($n['pl']??0),
                'do'=>($n['do']??0),
                'is'=>($n['is']??0),
                'img_s'=>$img.'s.jpg',
                'img_t'=>$img.'t.jpg',
                'img_m'=>$img.'m.jpg'
    ]);
  }

  public function loadmore($i)
  {
    $news=$this->find(['pl'=>1,'_id'=>['$lt'=>intval($i)],'c'=>['$nin'=>[11,12]]],[],['limit'=>72]);
    $c=Load::$core
      ->assign('news',$news)
      ->fetch('news/home.more');
    Load::Ajax()->jquery('#news-more','replaceWith',$c)
      ->script('$("img.lazy").lazyload({failure_limit:21,effect:"fadeIn"});');
  }

  public function link(array $n): string
  {
    /*
    if(!empty($n['exl']))
    {
      return $n['url'];
    }
    */
    $site=(Load::$conf['news'][$n['c']]['sl']?:Load::$conf['scheme'].'://news.'.Load::$conf['domain']);
    return $site.'/'.(strpos($site,'autocar')!==false?'news':'view').'/'.$n['_id'];
  }
}
?>
