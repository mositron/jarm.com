<?php
namespace Jarm\App\Ads;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public $position;
  public $advertorial_position;
  public $relate_position;

  public function __construct()
  {
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'Advertising Management System',
      'description'=>'Advertising Management System',
      'keywords'=>'Advertising Management System',
    ]);

    $this->position=[
      'boxza'=>[
        't'=>Load::$conf['domain'],
        'l'=>[
          'www'=>['t'=>Load::$conf['domain'].' - หน้าแรกเว็บไซต์','l'=>['a','b','c','d','e','f','g']],
          'beauty'=>['t'=>'beauty.'.Load::$conf['domain'].' - Beauty','l'=>['a','b','c','d','e','f']],
          'boyz'=>['t'=>'boyz.'.Load::$conf['domain'].' - Boyz','l'=>['a','b','c','d','e','f']],
          'drama'=>['t'=>'drama.'.Load::$conf['domain'].' - ละคร','l'=>['a','b','c','d','e','f']],
          'ent'=>['t'=>'ent.'.Load::$conf['domain'].' - Entertain','l'=>['a','b','c','d','e','f']],
          'friend'=>['t'=>'friend.'.Load::$conf['domain'].' - Friend','l'=>['a','b','c','d','e','f']],
          'forum'=>['t'=>'forum.'.Load::$conf['domain'].' - Forum','l'=>['a','b','c','d','e','f']],
          'game'=>['t'=>'game.'.Load::$conf['domain'].' - Game','l'=>['a','b','c','d','e','f']],
          'guess'=>['t'=>'guess.'.Load::$conf['domain'].' - Glitter','l'=>['a','b','c','d','e','f']],
          'horo'=>['t'=>'horo.'.Load::$conf['domain'].' - Horo','l'=>['a','b','c','d','e','f']],
          'korea'=>['t'=>'korea.'.Load::$conf['domain'].' - Korea','l'=>['a','b','c','d','e','f']],
          'image'=>['t'=>'image.'.Load::$conf['domain'].' - Image','l'=>['a','b','c','d','e','f']],
          'lesbian'=>['t'=>'lesbian.'.Load::$conf['domain'].' - Lesbian','l'=>['a','b','c','d','e','f']],
          'lotto'=>['t'=>'lotto.'.Load::$conf['domain'].' - Lotto','l'=>['a','b','c','d','e','f']],
          'movie'=>['t'=>'movie.'.Load::$conf['domain'].' - Movie','l'=>['a','b','c','d','e','f']],
          'music'=>['t'=>'music.'.Load::$conf['domain'].' - Music','l'=>['a','b','c','d','e','f']],
          'news'=>['t'=>'news.'.Load::$conf['domain'].' - News','l'=>['a','b','c','d','e','f']],
          'politic'=>['t'=>'politic.'.Load::$conf['domain'].' - Politic','l'=>['a','b','c','d','e','f']],
          'radio'=>['t'=>'radio.'.Load::$conf['domain'].' - Radio','l'=>['a','b','c','d','e','f']],
          'tech'=>['t'=>'tech.'.Load::$conf['domain'].' - Technology','l'=>['a','b','c','d','e','f']],
        ],
      ],
    ];

    $this->advertorial_position=[
      'boxza'=>[
        't'=>Load::$conf['domain'],
        'l'=>[
          'news'=>['t'=>'ข่าวเด่น'],
          'ent'=>['t'=>'ข่าวบันเทิง'],
          'live'=>['t'=>'จามจะเมาท์'],
          'korea'=>['t'=>'เกาหลี'],
          'knowledge'=>['t'=>'เกร็ดความรู้'],
          'eat'=>['t'=>'อาหาร'],
          'technology'=>['t'=>'เทคโนโลยี'],
          'beauty'=>['t'=>'ผู้หญิง'],
          'car'=>['t'=>'รถใหม่'],
        ],
      ],
    ];

    $this->relate_position=[
      'boxza'=>[
        't'=>Load::$conf['domain'],
        'l'=>[
          'beauty'=>['t'=>'beauty.'.Load::$conf['domain'].' - Beauty'],
          'ent'=>['t'=>'ent.'.Load::$conf['domain'].' - Entertain'],
          'game'=>['t'=>'game.'.Load::$conf['domain'].' - Game'],
          'horo'=>['t'=>'horo.'.Load::$conf['domain'].' - Horo'],
          'korea'=>['t'=>'korea.'.Load::$conf['domain'].' - Korea'],
          'lotto'=>['t'=>'lotto.'.Load::$conf['domain'].' - Lotto'],
          'movie'=>['t'=>'movie.'.Load::$conf['domain'].' - Movie'],
          'music'=>['t'=>'music.'.Load::$conf['domain'].' - Music'],
          'news'=>['t'=>'news.'.Load::$conf['domain'].' - News'],
          'tech'=>['t'=>'tech.'.Load::$conf['domain'].' - Technology'],
        ],
      ],
    ];

    Load::$core
      ->assign('position',$this->position)
      ->assign('advertorial_position',$this->advertorial_position)
      ->assign('relate_position',$this->relate_position);

    $path=(Load::$path[0]?:'home');
    Load::$core->data['nav-header']='<ul>
    <li><a href="/" title="Advertising Management System"'.($path=='home'?' class="active"':'').'>Advertising Management System</a></li>
    <li><a href="/home/active" title=""'.($path=='home'?' class="active"':'').'>แบนเนอร์</a></li>
    <li><a href="/advertorial/active" title=""'.($path=='advertorial'?' class="active"':'').'>บทความ</a></li>
    <li><a href="/relate/active" title=""'.($path=='relate'?' class="active"':'').'>ข่าวใกล้เคียง</a></li>
    </ul>';
  }

  public function check_perm($key)
  {
    if(!Load::$my)
    {

    }
    elseif(Load::$my['am']>=9)
    {
      return true;
    }
    elseif(in_array(Load::$my['_id'],[247228,177679]))
    {
      /*
      247228 - มี่
      177679 - พลอย
      */
      return true;
    }
    return false;
  }

  public function delbanner($i)
  {
    $db=Load::DB();
    if($banner=$db->findone('ads',['_id'=>intval($i),'dd'=>['$exists'=>false]]))
    {
      $db->update('ads',['_id'=>$banner['_id']],['$set'=>['dd'=>Load::Time()->now()]]);
      Load::Ajax()->alert('ลบโฆษณานี้เรียบร้อยแล้ว')
                ->script('setTimeout(function(){window.location.href="/";},2000);');
    }
    else
    {
      Load::Ajax()->alert('โฆษณานี้ไม่ได้ใช้งาน');
    }
  }

  public function newbanner($arg)
  {
    $ajax=Load::Ajax();
    $db=Load::DB();
    if(in_array(Load::$path[0],['ads','advertorial','relate']))
    {
      $ty=Load::$path[0];
    }
    else
    {
      $ty='ads';
    }
    if(!$arg['title'])
    {
      $ajax->alert('กรุณากรอกชื่อแบนเนอร์');
    }
    else
    {
      $m=intval(date('m'))+1;
      $dt1=strtotime(date('Y-m-d 00:00:00'));
      $dt2=strtotime(date('Y-'.substr('0'.$m,-2).'-d 23:59:59'));
      $_=[
        't'=>mb_substr(trim($arg['title']),0,100,'utf-8'),
        'ty'=>$ty,
        'u'=>Load::$my['_id'],
        'so'=>99,
        'dt1'=>Load::Time()->from($dt1),
        'dt2'=>Load::Time()->from($dt2),
      ];

      if($id=$db->insert('ads',$_))
      {
        $fd = Load::Folder()->fd($id);
        $db->update('ads',['_id'=>$id],['$set'=>['fd'=>substr($fd,2,2).'/'.substr($fd,4,2)]]);
        $ajax->redirect('/update/'.$id);
      }
      else
      {
        $ajax->alert('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');
      }
    }
  }

  public function clearcache()
  {
    Load::$core->clean();
    Load::DB()->insert('logs',['ty'=>'cache','u'=>Load::$my['_id'],'dm'=>Load::$conf['domain'].' (ADS)']);
    Load::Ajax()->alert('ล้างแคชทั้งหมดเรียบร้อยแล้ว')
              ->script('setTimeout(function(){window.location.href="'.URL.'"},2000);');
  }

  public function docwrite($tmp)
  {
    $html='';
    $l=explode("\n",trim($tmp));
    for($i=0;$i<count($l);$i++)
    {
      $html.='document.write(\''.str_ireplace(['<script','</script'],['\x3Cscript','\x3C/script'],trim($l[$i])).'\');'."\r\n";
    }
    return $html."\r\n";
  }

  public function ads_fetch($v,$s='')
  {
    $u=['i'=>$v['_id'],'l'=>$v['l'],'t'=>time()];
    $d=strtr(base64_encode(json_encode($u)), '+/', '-_');
    return Load::uri([Load::$sub,'/click/?__b='.urlencode($d).'&rnd=[rnd]']);
  }
}
?>
