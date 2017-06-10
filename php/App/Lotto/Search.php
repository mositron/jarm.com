<?php
namespace Jarm\App\Lotto;
use Jarm\Core\Load;

class Search extends Service
{
  public function _search()
  {
    $db=Load::DB();
    if($_POST['lotto']&&$_POST['lotto_date'])
    {
      Load::$core->assign('lq',array_values(array_filter(array_unique(array_map('trim',explode(' ',str_replace(['  ',','],' ',trim($_POST['lotto']))))))));
      Load::$core->assign('li',$db->findone('lotto',['_id'=>intval($_POST['lotto_date'])]));
    }
    $lotto=$db->find('lotto',['dd'=>['$exists'=>false],'pl'=>1],[],['sort'=>['tm'=>-1],'limit'=>11]);
    $tm=Load::Time()->from($lotto[0]['tm'],'date');
    Load::$core->data['title'] = 'ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm;
    Load::$core->data['description'] = 'ตรวจหวย ตรวจสลากกินแบ่งรัฐบาล งวดที่ '.$tm.' เลขเด็ด หวยเด็ด อัพเดทรวดเร็ว';
    Load::$core->data['keywords'] = 'ตรวจหวย, หวย, ตรวจสลากกินแบ่งรัฐบาล, '.$tm.', '.str_replace(' ',', ',$tm).', ตรวจสลากกินแบ่ง, เลขเด็ด, หวยเด็ด';
    Load::$core->assign('lotto',$lotto);
    Load::$core->data['content']=Load::$core->fetch('lotto/search');
  }
}
?>
