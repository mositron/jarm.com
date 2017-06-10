<?php
define('HIDE_SIDEBAR',1);

if(!is_numeric(Load::$path[1]))
{
  Load::move('/guess',true);
}

Load::Ajax()->register(['playapp']);

$db=Load::DB();
if(!$app=$db->findOne('guess',array('_id'=>intval(Load::$path[1]),'pl'=>1,'dd'=>['$exists'=>false])))
{
  Load::move('/guess',true);
}

$quest=[];
$ans=[];

shuffle($app['quest']);




Load::$core->assign('parent',$_GET['parent']?$_GET['parent']:'/guess/recent');

Load::$core->assign('app',$app);

$poster=Load::User()->get($app['u']);

Load::$core->assign('user',$poster);
Load::$core->assign('apps',$db->find('guess',['_id'=>['$ne'=>$app['_id']],'u'=>$app['u'],'pl'=>1,'dd'=>['$exists'=>false]],['_id'=>1,'t'=>1],['sort'=>['_id'=>-1,'limit'=>10]]));

Load::$core->data['content']=Load::$core->fetch('guess.game');


function playapp($arg)
{
  $db=Load::DB();
  $ajax=Load::Ajax();
  $play=false;
  $k=date('Y-m-d');
  if($q=$db->findOne('guess',array('_id'=>intval(Load::$path[1]),'pl'=>1)))
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
    $fb=array(
              'message'=>$q['t'].' (via Android)',
              'name'=>$q['ans'][$rs]['t'],
              'caption'=>$q['t'],
              'link'=>'https://play.google.com/store/apps/details?id=com.doodroid.guess',
              'picture'=>Load::uri(['s3','/guess/'.$q['fd'].'/s.jpg']),
              'description'=>$q['ans'][$rs]['d'],
              'actions'=>[['name'=>'เกมทายใจ+ for Android','link'=>'https://play.google.com/store/apps/details?id=com.doodroid.guess']]
    );
    if($q['ans'][$rs]['i'])
    {
      $fb['picture']=Load::uri(['s3','/guess/'.$q['fd'].'/'.$q['ans'][$rs]['i']]);
    }
    $ajax->script('showresult('.json_encode($fb).')');

    $u=$arg['uid'];

    $num=5;
    if($pa=$db->findOne('guess_play',['a'=>$q['_id'],'k'=>$k]))
    {
      if(!in_array($u,(array)$pa['p']))
      {
        $num=10;
        $db->update('guess_play',['_id'=>$pa['_id']],array('$push'=>['p'=>$u],'$set'=>array('c'=>intval($pa['c'])+1)));
        $db->update('guess',['_id'=>$q['_id']],array('$set'=>array('do'=>intval($q['do'])+1)));
      }
    }
    else
    {
      $num=10;
      $db->insert('guess_play',['a'=>$q['_id'],'k'=>$k,'p'=>[$u],'c'=>1]);
      $db->update('guess',['_id'=>$q['_id']],array('$set'=>array('do'=>intval($q['do'])+1)));
    }
    if($_setans)
    {
      $db->update('guess_play',['a'=>$q['_id'],'k'=>$k],['$set'=>['o.'.$u=>$_setans]]);
    }
  }
}

?>
