<?php
namespace Jarm\App\Control;
use Jarm\Core\Load;

class Home extends Service
{
  public function _home()
  {
    Load::Session()->logged();
    if(!Load::$my['am'])
    {
      Load::$core->data['content']=Load::$core->fetch('control/permission');
      return;
    }
    Load::Ajax()->register(['clearcache','delfriend','delfriends']);
    $db=Load::DB();
    $days=['อา','จ','อ','พ','พฤ','ศ','ส'];
    $view=$db->find('logs',['ty'=>'news'],[],['sort'=>['_id'=>-1],'limit'=>14]);
    $pageview=['x'=>[],'do'=>[],'is'=>[],'tb'=>[],'mb'=>[],'dt'=>[],'all'=>[]];
    $j=0;
    for($i=count($view)-1;$i>=0;$i--)
    {
      $p=$view[$i];
      $d=''.$p['date'];
      $d2 = date('w',strtotime(substr($d,0,4).'-'.substr($d,4,2).'-'.substr($d,6,2).' 00:00:00'));
      $pageview['x'][]=$days[$d2].'.';//substr($d,6,2).'/'.substr($d,4,2));
      $pageview['do'][]=$p['do'];
      $pageview['is'][]=$p['is'];
      $pageview['tb'][]=$p['tb'];
      $pageview['mb'][]=$p['mb'];
      $pageview['dt'][]=$p['dt'];
      $pageview['all'][]=intval($p['is'])+intval($p['do']);
      $j++;
    }

    $diff=[];
    $writer=[];
    $min_diff=0;
    $max_diff=23;
    $start_diff=false;
    for($i=0;$i<24;$i++)
    {
      $is_null=true;
      for($j=0;$j<=5;$j++)
      {
        if($view[$j])
        {
          $diff['day'.($j+1)][$i]=$view[$j]['hour'][$i];
          $writer['day'.($j+1)][$i]=$view[$j]['hw'][$i];
          if($view[$j]['hw'][$i])
          {
            $is_null=false;
          }
        }
      }

      if($is_null)
      {
        if(!$start_diff)
        {
          $min_diff=$i;
        }
      }
      else
      {
        $start_diff=true;
        $max_diff=$i;
      }
    }
    //if(Load::$my['_id']==1)
    //{
    //print_r($writer);
    if($max_diff<23)
    {
      $max_diff++;
    }
    for($i=1;$i<=6;$i++)
    {
      array_splice($writer['day'.$i],0,$min_diff);
      array_splice($writer['day'.$i],$max_diff-$min_diff);
    }
    for($i=$min_diff;$i<=$max_diff;$i++)
    {
      $writer['day'][]=$i;
    }
    //echo $min_diff.'-'.$max_diff;
    //print_r($writer);
    //exit;
    //}
    $now=Load::Time()->now();
    $ads=['banner'=>0,'advertorial'=>0];
    $ads['banner']=$db->count('ads',['dd'=>['$exists'=>false],'pl'=>1,'ty'=>'ads','boxza'=>['$exists'=>true],'dt1'=>['$lte'=>$now],'dt2'=>['$gte'=>$now]]);
    $ads['advertorial']=$db->count('ads',['dd'=>['$exists'=>false],'pl'=>1,'ty'=>'advertorial','boxza'=>['$exists'=>true],'dt1'=>['$lte'=>$now],'dt2'=>['$gte'=>$now]]);

    $member=[];
    $member['active']=$db->count('user',['st'=>1]);
    $member['wait']=$db->count('user',['st'=>0]);
    $member['ban']=$db->count('user',['st'=>['$lt'=>0]]);
    $member['hold']=$db->count('user',['st'=>['$gt'=>1]]);

    return Load::$core
      ->assign('user',Load::User())
      ->assign('ads',$ads)
      ->assign('diff',$diff)
      ->assign('writer',$writer)
      ->assign('member',$member)
      ->assign('pageview',$pageview)
      ->assign('admin',$db->find('user',['am'=>['$gte'=>1]],['_id'=>1,'if.am'=>1,'am'=>1,'du'=>1,'em'=>1],['sort'=>['du'=>-1]]))
      ->assign('logs',$db->find('logs',['ty'=>'cache'],[],['sort'=>['_id'=>-1],'limit'=>100]))
      ->fetch('control/home');
  }

  public function delfriend($id)
  {
    Load::DB()->update('msn',['_id'=>intval($id)],['$set'=>['dd'=>Load::Time()->now()]]);
    //$ajax->alert('ลบเรียบร้อยแล้ว');
    Load::Ajax()
      ->script('$("#friend'.$id.'").remove();')
      ->script('$("#friendcount").html($(".table-friend tr").length)');
  }

  public function delfriends()
  {
    Load::DB()->update('msn',['dd'=>['$exists'=>false],'da'=>['$gte'=>Load::Time()->now(-3600*24*30)],'sd'=>['$exists'=>true]],['$set'=>['dd'=>Load::Time()->now()]],['multiple'=>true]);
    Load::Ajax()
      ->alert('ลบเรียบร้อยแล้ว')
      ->script('$(".table-friend").remove();')
      ->script('$("#friendcount").html(0)');
  }
}
?>
