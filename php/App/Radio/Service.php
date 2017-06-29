<?php
namespace Jarm\App\Radio;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public $radio=[];
  public $rlink=[];
  public function __construct()
  {
    $path=(Load::$path[0]?:'home');
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์ วิทยุออนไลน์ ฟังเพลง24ชม',
      'description'=>'ฟังเพลงออนไลน์ ฟังเพลง ฟังวิทยุออนไลน์ทุกคลื่นทั่วไทย ฟังเพลงรัก ฟังเพลงอกหัก ฟังเพลงใหม่ ทั้งไทยและสากลได้ที่นี่',
      'keywords'=>'ฟังเพลง, วิทยุออนไลน์, ฟังวิทยุออนไลน์, ฟังเพลงออนไลน์, วิทยุออนไลน์, วิทยุ, ออนไลน์',
      'nav-header'=>'<ul>
      <li><a href="/" title="ฟังเพลง ฟังเพลงออนไลน์ ฟังวิทยุออนไลน์"'.($path=='home'?' class="active"':'').'>ฟังเพลง</a></li>
      <li><a href="/89.0" title="89.0 Chill FM"'.($path=='89.0'?' class="active"':'').'>89.0 Chill FM</a></li>
      <li><a href="/91.5" title="91.5 HotWave"'.($path=='91.5'?' class="active"':'').'>91.5 HotWave</a></li>
      <li><a href="/93.0" title="93.0 Cool FM"'.($path=='93.0'?' class="active"':'').'>93.0 Cool FM</a></li>
      <li><a href="/94.0" title="94.0 EFM"'.($path=='94.0'?' class="active"':'').'>94.0 EFM</a></li>
      <li><a href="/96.0" title="96.0 Sport Radio"'.($path=='96.0'?' class="active"':'').'>96.0 Sport Radio</a></li>
      <li><a href="/105.5" title="105.5 Eazy FM"'.($path=='105.5'?' class="active"':'').'>105.5 Eazy FM</a></li>
      </ul>'
    ]);

    $tmp=require(__CONF.'radio.php');
    foreach($tmp as $k=>$v)
    {
      if($v['ty']=='flash')
      {
        $this->rlink[$v['l']]=$k;
        $this->radio[$k]=$v;
      }
    }
    Load::$core->assign('radio',$this->radio);
  }

  public function get_home()
  {
    return Load::$core
      ->assign('news',(new \Jarm\App\News\Service(['ignore'=>1]))->find(['pl'=>1,'c'=>24],[],['limit'=>16]))
      ->fetch('radio/home');
  }

  public function get_view()
  {
    if(preg_match('/(\d+)\.html$/',Load::$path[0],$url))
    {
      $r = intval($url[1]);
      if(isset($this->radio[$r]))
      {
        Load::move('/'.$this->radio[$r]['l'],true);
      }
      else
      {
        Load::move('/',true);
      }
    }
    if(!isset($this->rlink[Load::$path[0]]))
    {
      Load::move('/',true);
    }
    $r=$this->rlink[Load::$path[0]];

    Load::$core->data['title'] = $this->radio[$r]['t'].' ฟังเพลง'.$this->radio[$r]['t'].' ฟังเพลงออนไลน์'.$this->radio[$r]['t'].' ฟังวิทยุออนไลน์'.$this->radio[$r]['t'].' วิทยุออนไลน์ ฟังเพลง24ชม';
    Load::$core->data['description'] = $this->radio[$r]['t'].' ฟังเพลงออนไลน์'.$this->radio[$r]['t'].' ฟังเพลง'.$this->radio[$r]['t'].' ฟังวิทยุออนไลน์'.$this->radio[$r]['t'].' ฟังวิทยุออนไลน์ทุกคลื่นทั่วไทย ฟังเพลงรัก ฟังเพลงอกหัก ฟังเพลงใหม่ ทั้งไทยและสากลได้ที่นี่';
    Load::$core->data['keywords'] = $this->radio[$r]['t'].', ฟังเพลง, วิทยุออนไลน์, ฟังวิทยุออนไลน์, ฟังเพลงออนไลน์, วิทยุออนไลน์, วิทยุ';
    Load::$core->data['type']='article';
    return Load::$core
      ->assign('id',$r)
      ->fetch('radio/view');
  }
}
?>
