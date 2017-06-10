<?php
namespace Jarm\App\Sticker;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public $cate=[];
  public $ref=[];
  public $types=[];
  public function __construct()
  {
    if(Load::$my['_id']!=1)
    {
      Load::move('https://jarm.com/');
    }

    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'สติ๊กเกอร์ Line ฟรี โหลดสติกเกอร์ฟรี สามารถใช้งานได้ใน Line, Wechat, WhatsApp และอื่นๆ',
      'description'=>'โหลดแอพสำหรับใช้งานสติกเกอร์ฟรี ใช้ได้บนไลน์ วอทแอพ วีแชท Line WeChat WhatsApp',
      'keywords'=>'สติ๊กเกอร์, ฟรี, Line, ไลน์, WhatsApp, วอทแอพ, WeChat, วีแชท',
    ]);

    $this->cate=[
      '1'=>['t'=>'สัตว์'],
      '2'=>['t'=>'สัตว์ประหลาด'],
      '3'=>['t'=>'คน'],
      '4'=>['t'=>'พืช'],
      //'5'=>['t'=>'ของกิน'],
      //'6'=>['t'=>'สิ่งของ'],
      //'7'=>['t'=>'เทศกาล'],
      //'8'=>['t'=>'ตัวอักษร'],
      '99'=>['t'=>'อื่นๆ']
    ];

    $this->ref=[
      'fb'=>['t'=>'Facebook'],
    ];

    Load::$core->assign('types',$this->types);
    Load::$core->assign('cate',$this->cate);
    Load::$core->assign('ref',$this->ref);
  }

  public function get_cate()
  {
    define('HIDE_REQUEST',1);
    $c=explode('-',Load::$path[0]);
    if($c[0]=='cate'&&isset($this->cate[$c[1]]))
    {
    }
    else
    {
      Load::move('/',true);
    }

    extract(Load::Split()->get('/cate-'.$c[1],0,['page']));

    Load::$core->data['title'] = $cate[$c[1]]['t'].' - สติกเกอร์ Line ฟรี สติกเกอร์สำหรับไลน์ วอทแอพ วีแชท ';
    Load::$core->data['description'] = $cate[$c[1]]['t'].' - สติกเกอร์ Line ฟรี สติกเกอร์สำหรับไลน์ วอทแอพ วีแชท';
    Load::$core->data['keywords'] = $cate[$c[1]]['t'].', สติกเกอร์, Line, ไลน์, ฟรี';

    $db=Load::DB();
    if($count=$db->count('sticker',['pl'=>1,'c'=>intval($c[1]),'dd'=>['$exists'=>false]]))
    {
      list($pg,$skip)=Load::Pager()->navigation(100,$count,[$url,'page-'],$page);
      $app=$db->find('sticker',['pl'=>1,'c'=>intval($c[1]),'dd'=>['$exists'=>false]],['t'=>1,'d'=>1,'l'=>1,'fd'=>1,'u'=>1,'p'=>1,'do'=>1,'f'=>1],['sort'=>['_id'=>-1],'skip'=>$skip,'limit'=>100]);
    }

    Load::$core->data['content']=Load::$core
      ->assign('c',$c[1])
      ->assign('pager',$pg)
      ->assign('user',Load::User())
      ->assign('app',$app)
      ->fetch('sticker/category');
  }

  public function get_favicon_dot_ico()
  {
    header('Content-type: image/x-icon');
    readfile(_FILES.'cdn/favicon.ico');
    exit;
  }

  public function getimgkey($a)
  {
    return mb_substr(md5($a.':-:sticker'),0,2);
  }
}
?>
