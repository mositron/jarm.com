<?php
namespace Jarm\App\Music;
use Jarm\Core\Load;

class Service extends \Jarm\App\News\Service
{
  public function __construct()
  {
    $path=(Load::$path[0]);
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'เพลง เพลงใหม่ เนื้อเพลง เพลงใหม่ๆ เพลงใหม่ล่าสุด ค้นหาเนื้อเพลง ฟังเพลง ฟังเพลงออนไลน์ ทกค่ายเพลง ทุกสังกัด',
      'description'=>'เพลง เพลงใหม่ เนื้อเพลง เพลงใหม่ๆ เพลงใหม่ล่าสุด ค้นหาเนื้อเพลง ค้นหาเพลง ค้นหาเพลงใหม่ ฟังเพลงที่คุณต้องการ ทุกค่ายเพลง ทุกสังกัด ที่นี่ที่เดียว',
      'keywords'=>'เพลง, เพลงใหม่, เนื้อเพลง, เพลงใหม่ๆ, เพลงใหม่ล่าสุด, ฟังเพลง, ฟังเพลงออนไลน์, ค้นหาเพลง, ค้นหาเนื้อเพลง, แกรมมี่, อาร์เอส, อินดี้',
      'nav-header'=>'<div><a href="/" title="เพลง เพลงใหม่ เนื้อเพลง">เพลง</a></div><i></i><ul>
      <li><a href="/list" title="เพลงใหม่ เนื้อเพลงใหม่ เพลงใหม่ล่าสุด"'.($path=='list'?' class="active"':'').'>เพลงใหม่</a></li>
      <li><a href="/news" title="ข่าวเพลง ข่าวเพลงใหม่ ข่าวนักร้อง"'.($path=='news'?' class="active"':'').'>ข่าวเพลง</a></li>
      </ul>'
    ]);
  }

  public function _home(array $arg=[])
  {
    Load::cache();
    $db=Load::DB();
    $music=$db->find('music',[],['_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'sn'=>1,'ar'=>1,'al'=>1,'yt'=>1,'da'=>1],['sort'=>['_id'=>-1],'limit'=>20]);
    Load::$core->assign('music',$music);
    $news=(new \Jarm\App\News\Service(['ignore'=>1]))->find(['pl'=>1,'c'=>$arg['cate']],[],['limit'=>16]);
    Load::$core->assign('news',$news);
    Load::$core->data['content']=Load::$core->fetch('music/home');
  }

  public function _list()
  {
    Load::cache(3600,3);
    $db=Load::DB();
    $allby=['desc'=>'หลังไปหน้า','asc'=>'หน้าไปหลัง'];
    extract(Load::Split()->get('/list/',0,['sn','ar','q','page']));
    $sort=['_id'=>-1];
    $_=['dd'=>['$exists'=>false]];
    Load::$core->data['title']='เพลงใหม่ เนื้อเพลงใหม่ ค้นหาเนื้อเพลง เพลงใหม่ๆ เนื้อเพลงไทย เนื้อเพลงสากล เนื้อเพลงลูกทุ่ง '.($page>1?' หน้า '.$page:'');
    if(isset($q))
    {
      if($q=trim($q))
      {
        $qr=new \MongoDB\BSON\Regex(trim($q),'i');
        $_['$or']=[['sn'=>$qr],['al'=>$qr],['ar'=>$qr]];
      }
      else
      {
        unset($q);
      }
    }
    elseif(isset($sn))
    {
      $sort=['sn'=>1];
      $_['fc.sn']=$sn;
      Load::$core->data['title']='เพลงใหม่ เนื้อเพลงใหม่ เรียงตามชื่อเพลง '.$sn.' '.($page>1?' หน้า '.$page:'').' เพลงใหม่ๆ ค้นหาเนื้อเพลง เนื้อเพลงไทย เนื้อเพลงสากล เนื้อเพลงลูกทุ่ง';
    }
    elseif(isset($ar))
    {
      $sort=['ar'=>1];
      $_['fc.ar']=$ar;
      Load::$core->data['title']='เพลงใหม่ เนื้อเพลงใหม่ เรียงตามชื่อศิลปิน '.$sn.' '.($page>1?' หน้า '.$page:'').' เพลงใหม่ๆ ค้นหาเนื้อเพลง เนื้อเพลงไทย เนื้อเพลงสากล เนื้อเพลงลูกทุ่ง';
    }
    Load::$core->data['description']=Load::$core->data['title'].', '.Load::$core->data['description'];
    if($count=$db->count('music',$_))
    {
      list($pg,$skip)=Load::Pager()->navigation(110,$count,[$url,'page-'],$page);
      $music=$db->find('music',$_,['_id'=>1,'t'=>1,'s'=>1,'fd'=>1,'sn'=>1,'ar'=>1,'al'=>1,'yt'=>1,'da'=>1],['sort'=>$sort,'skip'=>$skip,'limit'=>110]);
    }
    Load::$core->data['content']=Load::$core
      ->assign('c',$c)
      ->assign('music',$music)
      ->assign('pager',$pg)
      ->assign('sn',$sn)
      ->assign('ar',$ar)
      ->assign('q',$q)
      ->fetch('music/list');
  }

  public function getfirstchar($t)
  {
    $r='!';
    $a=['1','2','3','4','5','6','7','8','9','0','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','ก','ข','ค','ฆ','ง','จ','ฉ','ช','ซ','ฌ','ญ','ฎ','ฐ','ฑ','ฒ','ฐ','ณ','ด','ต','ถ','ท','ธ','น','บ','ป','ผ','ฝ','พ','ฟ','ภ','ม','ย','ร','ฤ','ล','ว','ศ','ษ','ส','ห','ฬ','อ','ฮ'];
    $t=mb_strtolower($t,'utf-8');
    $l=mb_strlen($t,'utf-8');
    for($i=0;$i<$l;$i++)
    {
      $s=mb_substr($t,$i,1,'utf-8');
      if(in_array($s,$a))
      {
        if(is_numeric($s))
        {
          return $r;
        }
        else
        {
          return $s;
        }
      }
    }
    return $r;
  }
}
?>
