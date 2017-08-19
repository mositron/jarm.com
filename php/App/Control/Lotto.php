<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Lotto extends Service
{
  public function _lotto()
  {
    Load::Session()->logged();
    $path=(Load::$path[1]?:'home');
    if(Load::$my['am'])
    {
      return $this->{'lotto_'.(is_numeric(Load::$path[1])?'update':'home')}();
    }
    else
    {
      Load::move('/');
    }
  }

  public function lotto_home()
  {
    Load::$core->data['title']='ตรวจหวย - '.Load::$core->data['title'];
    Load::Ajax()->register(['dellotto','newlotto']);
    $db=Load::DB();
    extract(Load::Split()->get('/lotto/',1,['page']));
    $arg = ['dd'=>['$exists'=>false]];
    if($count=$db->count('lotto',$arg))
    {
      list($pg,$skip)=Load::Pager()->navigation(20,$count,['/lotto/','page-'],$page);
      $lotto=$db->find('lotto',$arg,['_id'=>1,'tm'=>1,'l'=>1,'a1'=>1,'l3'=>1,'l2'=>1,'pl'=>1],['skip'=>$skip,'limit'=>20,'sort'=>['tm'=>-1]]);
    }
    return Load::$core
      ->assign('count',$count)
      ->assign('lotto',$lotto)
      ->assign('pager',$pg)
      ->fetch('control/lotto.home');
  }

  public function lotto_update()
  {
    $db=Load::DB();
    if(!$lotto=$db->findone('lotto',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]]))
    {
      Load::move('/lotto');
    }
    $error=[];
    $d=explode('-',date('j-n-Y',Load::Time()->sec($lotto['tm'])));
    if($_POST)
    {
      $a1=trim($_POST['a1']);
      $a2=array_values(array_map('trim',array_filter(explode(' ',str_replace('	',' ',$_POST['a2'])))));
      sort($a2);
      $a3=array_values(array_map('trim',array_filter(explode(' ',str_replace('	',' ',$_POST['a3'])))));
      sort($a3);
      $a4=array_values(array_map('trim',array_filter(explode(' ',str_replace('	',' ',$_POST['a4'])))));
      sort($a4);
      $a5=array_values(array_map('trim',array_filter(explode(' ',str_replace('	',' ',$_POST['a5'])))));
      sort($a5);
      $f3=array_values(array_map('trim',array_filter(explode(' ',str_replace('	',' ',$_POST['f3'])))));
      sort($f3);
      $l3=array_values(array_map('trim',array_filter(explode(' ',str_replace('	',' ',$_POST['l3'])))));
      sort($l3);
      $l2=trim($_POST['l2']);

      if(!$_POST['day']||!$_POST['month']||!$_POST['year'])
      {
        $error['title']='กรุณากรอกข้อมูลให้ครบถ้วน';
      }

      if(!count($error))
      {
        $t='ตรวจหวย งวดที่ '.$_POST['day'].' '.(Load::Time()->month[$_POST['month']-1]).' '.($_POST['year']+543);
        $link=Load::Format()->link(strtolower($t));
        if(!$link)$link=$_POST['type'];
        $arg=[
          'tm'=>Load::Time()->from($_POST['year'].'-'.$_POST['month'].'-'.$_POST['day']),
          'l'=>Load::Format()->link($t,false),
          'a1'=>$a1,
          'a2'=>$a2,
          'a3'=>$a3,
          'a4'=>$a4,
          'a5'=>$a5,
          'f3'=>$f3,
          'l3'=>$l3,
          'l2'=>$l2,
          'pl'=>$_POST['publish']?1:0,
        ];
        $db->update('lotto',['_id'=>$lotto['_id']],['$set'=>$arg]);
        Load::$core->delete('lotto/home');
        Load::$core->delete('lotto/global');
        header('Location: /lotto/'.$lotto['_id'].'?completed');
        exit;
      }
      print_r($error);
      exit;
    }

    return Load::$core
      ->assign('date',['d'=>$d[0],'m'=>$d[1],'y'=>$d[2]])
      ->assign('lotto',$lotto)
      ->assign('error',$error)
      ->fetch('control/lotto.update');
  }

  public function dellotto($i)
  {
    $db=Load::DB();
    if($lotto=$db->findone('lotto',['_id'=>intval($i),'dd'=>['$exists'=>false]]))
    {
      $db->update('lotto',['_id'=>intval($i)],['$set'=>['dd'=>Load::Time()->now()]]);
      Load::$core->delete('lotto/home');
    }
    Load::Ajax()->redirect(URL);
  }

  public function newlotto($arg)
  {
    $ajax=Load::Ajax();
    $db=Load::DB();
    if(!$arg['day']||!$arg['month']||!$arg['year'])
    {
      $ajax->alert('กรุณากรอกข้อมูลให้ครบถ้วน');
    }
    else
    {
      $t='ตรวจหวย งวดที่ '.$arg['day'].' '.(Load::Time()->month[$arg['month']-1]).' '.($arg['year']+543);
      $_=[
        'tm'=>Load::Time()->from($arg['year'].'-'.$arg['month'].'-'.$arg['day']),
        'l'=>Load::Format()->link($t,false),
        'u'=>Load::$my['_id'],
      ];

      if($id=$db->insert('lotto',$_))
      {
        $ajax->redirect('/lotto/'.$id);
      }
      else
      {
        $ajax->show('เกิดข้อผิดพลาด ไม่สามารถเพิ่มข้อมูลได้ในขณะนี้');
      }
    }
  }
}
?>
