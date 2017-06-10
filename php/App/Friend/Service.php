<?php
namespace Jarm\App\Friend;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public $province;
  public $type;
  public $zone;
  public function __construct()
  {
    $path=(Load::$path[0]??'');
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'หาเพื่อน หาแฟน หากิ๊ก หาคู่ คุย แชท msn กล้อง เว็บแคม พบปะพูดคุยกับเพื่อนใหม่ๆได้ทีนี่',
      'description'=>'หาเพื่อน หาแฟน หากิ๊ก หาคู่ คุย msn ออกเดท พบปะพูดคุยกับเพื่อนใหม่ๆ  ผู้หญิง, ผู้ชาย, เลสเบี้ยน, ทอม, ดี้, เกย์, สาวประเภทสอง ทุกเพศทุกวัยได้ที่นี่',
      'keywords'=>'หาเพื่อน, หาแฟน, หากิ๊ก, หาคู่, ออกเดท, พบปะ, พูดคุย, ผู้หญิง, ผู้ชาย, เลสเบี้ยน, ทอม, ดี้, เกย์, สาวประเภทสอง',
      'nav-header'=>'<div><a href="/" title="หาเพื่อน">หาเพื่อน</a></div><i></i><ul>
      <li><a href="/t-girl" title="หาเพื่อนหญิง"'.($path=='girl'?' class="active"':'').'>หาเพื่อนหญิง</a></li>
      <li><a href="/t-boy" title="หาเพื่อนชาย"'.($path=='boy'?' class="active"':'').'>หาเพื่อนชาย</a></li>
      <li><a href="'.Load::uri(['boyz','/friend']).'" title="หาเพื่อนเกย์">หาเพื่อนเกย์</a></li>
      <li><a href="'.Load::uri(['lesbian','/friend']).'" title="หาเพื่อนเลสเบี้ยน">หาเพื่อนเลสเบี้ยน</a></li>
      <li><a href="'.Load::uri(['chat','/']).'" title="ชแท คุยสด แชทหาเพื่อน">แชทหาเพื่อน</a></li>
      </ul>'
    ]);

    $this->zone = [
      '1'=>['n'=>'กรุงเทพและปริมณฑล','l'=>[2,19,24,29,60,62]],
      '2'=>['n'=>'ภาคเหนือ','l'=>[5,13,14,23,26,34,37,38,40,41,45,53,54,75,76]],
      '3'=>['n'=>'ภาคตะวันออกเฉียงเหนือ','l'=>[4,6,11,20,21,27,28,43,44,46,48,55,56,57,63,69,70,71,73,74,77]],
      '4'=>['n'=>'ภาคตะวันตก','l'=>[3,17,30,39,51]],
      '5'=>['n'=>'ภาคตะวันออก','l'=>[7,8,9,16,31,50]],
      '6'=>['n'=>'ภาคกลาง','l'=>[2,10,18,19,24,29,33,52,60,61,62,64,65,66,67,72]],
      '7'=>['n'=>'ภาคใต้','l'=>[1,12,15,22,25,32,35,36,42,47,49,58,59,68]]
    ];
    $this->type=['girl'=>'หญิง','boy'=>'ชาย','lesbian'=>'เลสเบี้ยน','gay'=>'เกย์','ladyboy'=>'สาวประเภทสอง'];
    $this->province=require(__CONF.'province.php');

    Load::$core
      ->assign('province',$this->province)
      ->assign('zone',$this->zone)
      ->assign('type',$this->type);
  }

  public function get_boy()
  {
    Load::move('/t-boy',true);
  }

  public function get_gay()
  {
    Load::move(['boyz','/friend'],true);
  }

  public function get_girl()
  {
    Load::move('/t-girl',true);
  }

  public function get_lesbian()
  {
    Load::move(['lesbian','/friend'],true);
  }

  public function get_list()
  {
    $allby=['desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง'];
    $all=['order','by','search','page','day','month','year','position','category'];
    extract(Load::Split()->get('/',0,['z','p','t','page','order','by'],['ds'=>'อัพเดทล่าสุด'],$allby));
    $url='';
    if(isset($z) && !isset($this->zone[$z]))
    {
      unset($z);
    }
    if(isset($p) && !isset($this->province[$p]))
    {
      unset($p);
    }
    if(isset($t) && !isset($this->type[$t]))
    {
      unset($t);
    }

    $_=['dd'=>['$exists'=>false]];
    $rc=['dd'=>['$exists'=>false],'fd'=>['$exists'=>true]];
    if($z)
    {
      $_['pr']=['$in'=>$this->zone[$z]['l']];
      $url.='/z-'.$z;
    }
    elseif($p)
    {
      $_['pr']=intval($p);
      $url.='/p-'.$p;
    }
    if($t)
    {
      $_['ty']=$t;
      $rc['ty']=$t;
      $url.='/t-'.$t;
    }
    else
    {
      $_['ty']=['$nin'=>['gay','lesbian']];
      $rc['ty']=['$nin'=>['gay','lesbian']];
    }

    if(isset($p))
    {
      $p=intval($p);
      foreach($this->zone as $k=>$v)
      {
        if(in_array($p,$v['l']))
        {
          $z=$k;
          break;
        }
      }
    }

    if($p)
    {
      Load::$core->data['title']='หาเพื่อน'.($t?$this->type[$t]:'ทั้งหมด').'ในจังหวัด'.$this->province[$p]['name_th'].($page?' หน้า '.$page:'').' - '.Load::$core->data['title'];
    }
    elseif($z)
    {
      Load::$core->data['title']='หาเพื่อน'.($t?$this->type[$t]:'ทั้งหมด').'ใน'.$this->zone[$z]['n'].($page?' หน้า '.$page:'').' - '.Load::$core->data['title'];
    }
    else
    {
      Load::$core->data['title']='หาเพื่อน'.($t?$this->type[$t]:'ทั้งหมด').($page?' หน้า '.$page:'').' - '.Load::$core->data['title'];
    }
    Load::$core->data['description']=Load::$core->data['title'].', '.Load::$core->data['description'];

    if($t=='gay')
    {
      Load::move(['lesbian','/friend'.($p?'/p-'.$p:($z?'/z-'.$z:'')).($page && $page>1?'/page-'.$page:'')],true);
    }
    elseif($t=='lesbian')
    {
      Load::move(['lesbian','/friend'.($p?'/p-'.$p:($z?'/z-'.$z:'')).($page && $page>1?'/page-'.$page:'')],true);
    }

    Load::cache(3600,4);

    $db=Load::DB();
    if($count=$db->count('msn',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation(100,$count,[$url,'/page-'],$page);
      $msn=$db->find('msn',$_,[],['sort'=>['au'=>1,'da'=>-1],'skip'=>$skip,'limit'=>100],false);
    }
    Load::$core->data['content']=Load::$core
        ->assign('z',$z)
        ->assign('p',$p)
        ->assign('t',$t)
        ->assign('pc',$pc)
        ->assign('pager',$pg)
        ->assign('error',$error)
        ->assign('msn',$msn)
        ->fetch('friend/list');
  }
}
?>
