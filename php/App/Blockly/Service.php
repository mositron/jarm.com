<?php
namespace Jarm\App\Blockly;
use Jarm\Core\Load;
use Jarm\App\Container;

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'Blockly ฝึกเขียนโค๊ด เขียนโปรแกรม แบบลากวาง',
      'description'=>'Blockly ฝึกเขียนโค๊ด เขียนโปรแกรม แบบลากวาง สำหรับเด็กหรือผู้ริเริ่มหัดเขียนโค๊ดหรือโปรแกรม',
      'keywords'=>'blockly, เขียนโค๊ด, หัดเขียนโปรแกรม',
    ]);
  }

  public function get_home()
  {
    return Load::$core->fetch('blockly/home');
  }

  public function _create()
  {
    $map=['_id'=>'-1','name'=>'global','width'=>10,'height'=>10];
    $block=array('bg'=>[],'tile'=>[],'object'=>[],'noc'=>[]);
    $sprite=require(__DIR__.'/config/sprite.php');

    foreach($sprite['map']['bg'] as $v)
    {
      for($i=$v['x'];$i<$v['x']+$v['w'];$i++)
      {
        $block['bg'][$i.'_'.$v['y']]=array('x'=>$i,'y'=>$v['y']);
      }
    }

    foreach($sprite['map']['tile'] as $v)
    {
      for($i=$v['x'];$i<$v['x']+$v['w'];$i++)
      {
        $block['tile'][$i.'_'.$v['y']]=array('x'=>$i*2,'y'=>$v['y']);
      }
    }

    foreach($sprite['map']['object'] as $v)
    {
      $block['object'][$i.'_'.$v['y']]=$v;
    }

    foreach(array('block','tile','object') as $v)
    {
      if(!is_array($map[$v]))
      {
        $map[$v]=[];
      }
    }
    $monster=require(__DIR__.'/config/monster.php');
    $npc=require(__DIR__.'/config/npc.php');
    return Load::$core
      ->assign('map',$map)
      ->assign('block',$block)
      ->assign('sprite',$sprite)
      ->assign('npc',$npc)
      ->assign('monster',$monster)
      ->fetch('blockly/create');
  }
}
?>
