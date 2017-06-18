<?php
namespace Jarm\App\Lotto;
use Jarm\Core\Load;
use Jarm\App\Container;

//define('HIDE_ADS',1);
define('LIONICA','lionica');
define('LIONICA_PATH','/'.LIONICA);
define('PET_PRICE',50);

define('CONFIG_PATH',__DIR__.'/config/');
define('SOCKET_PATH',__DIR__.'/socket/');

class Service extends Container
{
  public function __construct()
  {
    Load::$core->data=array_merge(Load::$core->data,[
      'title'=>'Lionica - เกมสัตว์เลี้ยง เกม Lionica สัตว์เลี้ยง เลี้ยงสัตว์บนเว็บ',
      'description'=>'เกมสัตว์เลี้ยง เลี้ยงสัตว์บนเว็บบ๊อกซ่า เกม Lionica',
      'keywords'=>'เกมสัตว์เลี้ยง, เกมส์เล่นบนเว็บ, สัตว์เลี้ยง, เกมส์, เกม',
    ]);
  }

  public function map()
  {
    $block=array('bg'=>array(),'tile'=>array(),'object'=>array());
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
    		$map[$v]=array();
    	}
    }

    $monster=array('npc'=>array(),'monster'=>array(),'animal'=>array());
    $tmp=require(__DIR__.'/config/life.php');
    foreach($tmp as $k=>$v)
    {
    	if(in_array($v['type'],array('farm','warp')))
    	{
    		$monster['animal'][$k]=$v;
    	}
    	else
    	{
    		$monster[$v['type']][$k]=$v;
    	}
    }

    Load::$core->data['content']=Load::$core
      ->assign('map',$map)
      ->assign('block',$block)
      ->assign('sprite',$sprite)
      ->assign('monster',$monster)
      ->fetch('map');
  }



  function setmap($arg)
  {
  	$db=_::db();
  	$ajax=_::ajax();

  	$arg=array(
  								'name'=>trim($arg['name']),
  								'start'=>array_map('intval',array_map('trim',explode(',',$arg['start']))),
  								'bg'=>$arg['bg'],
  								'tile'=>$arg['tile'],
  								'object'=>$arg['object'],
  								'life'=>$arg['life'],
  								'block'=>$arg['block']
  						);



  	$db->update('lionica_maps',array('_id'=>intval(_::$path[1])),array('$set'=>$arg));


  	_::cache()->delete('ca2','lionica_maps_'.intval(_::$path[1]),0);

  	$ajax->alert('บันทึกข้อมูลเรียบร้อยแล้ว');
  	//$ajax->script('setTimeout(function(){window.location.href="'.URL.'"},2000)');
  }
}


if(_::$path[0])
{
	if(in_array(_::$path[0],array('map-edit','play','rank','topper','info')))
	{
		require_once(__DIR__.'/game.'.LIONICA.'.'._::$path[0].'.php');
	}
	else
	{
		_::move(LIONICA_PATH);
	}
}
else
{
	require_once(__DIR__.'/game.'.LIONICA.'.home.php');
}

?>
