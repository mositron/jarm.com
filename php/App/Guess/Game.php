<?php
namespace Jarm\App\Guess;
use Jarm\Core\Load;

class Game extends Service
{
  public function _game()
  {
    define('HIDE_SIDEBAR',1);
    if(!is_numeric(Load::$path[1]))
    {
      Load::move('/',true);
    }
    Load::Ajax()->register(['playapp']);
    $db=Load::DB();
    if(!$app=$db->findOne('guess',['_id'=>intval(Load::$path[1]),'pl'=>1,'dd'=>['$exists'=>false]]))
    {
      Load::move('/',true);
    }
    $quest=[];
    $ans=[];
    shuffle($app['quest']);
    Load::$core->data['title'] = $app['t'].' - เกมทายใจ เกมส์วัดดวง เกมเฟสบุ๊ค faceook';
    Load::$core->data['description'] = $app['d'].' - สร้าง Application บน Facebook ง่ายๆ ฟรี!';
    Load::$core->data['image']='https://s4.jarm.com/guess/'.$app['fd'].'/m.jpg';
    Load::$core->data['content']=Load::$core
      ->assign('app',$app)
      ->assign('user',Load::User()->get($app['u']))
      ->fetch('guess/game');
  }

  public function playapp($arg)
  {
    $db=Load::DB();
    $ajax=Load::Ajax();
    $play=false;
    $k=date('Y-m-d');
    if($q=$db->findOne('guess',['_id'=>intval(Load::$path[1]),'pl'=>1]))
    {
      $ans=[];
      for($i=0;$i<count($q['quest']);$i++)
      {
        $v=strval($arg['ans'.$i]);
        if($v!='')
        {
          $v=intval($v);
          if(!isset($ans[$v]))
          {
            $ans[$v]=0;
          }
          $ans[$v]++;
        }
      }
      arsort($ans);
      $k=array_keys($ans);
      $rs=$k[0];
      $fb=[
            'message'=>$q['t'],
            'name'=>$q['ans'][$rs]['t'],
            'caption'=>$q['t'],
            'link'=>Load::uri(['guess','/game/'.$q['_id']]),
            'picture'=>Load::uri(['s4','/guess/'.$q['fd'].'/s.jpg']),
            'description'=>$q['ans'][$rs]['d'],
            'actions'=>[['name'=>'เกมทายใจ+ for Android','link'=>'https://play.google.com/store/apps/details?id=com.doodroid.guess']]
      ];
      if($q['ans'][$rs]['i'])
      {
        $fb['picture']='https://s4.jarm.com/guess/'.$q['fd'].'/'.$q['ans'][$rs]['i'];
      }
      $ajax->script('showresult('.json_encode($fb).')');

      $u=$arg['uid'];

      $num=5;
      if($pa=$db->findOne('guess_play',['a'=>$q['_id'],'k'=>$k]))
      {
        if(!in_array($u,(array)$pa['p']))
        {
          $num=10;
          $db->update('guess_play',['_id'=>$pa['_id']],['$push'=>['p'=>$u],'$set'=>['c'=>intval($pa['c'])+1]]);
          $db->update('guess',['_id'=>$q['_id']],['$set'=>['do'=>intval($q['do'])+1]]);
        }
      }
      else
      {
        $num=10;
        $db->insert('guess_play',['a'=>$q['_id'],'k'=>$k,'p'=>[$u],'c'=>1]);
        $db->update('guess',['_id'=>$q['_id']],['$set'=>['do'=>intval($q['do'])+1]]);
      }

      if($_setans)
      {
        $db->update('guess_play',['a'=>$q['_id'],'k'=>$k],['$set'=>['o.'.$u=>$_setans]]);
      }
    }
  }
}
?>
