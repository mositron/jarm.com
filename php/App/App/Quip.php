<?php
namespace Jarm\App\App;
use Jarm\Core\Load;

class Quip extends Service
{
  public function get_quip()
  {
    $serv=[
      ''=>'json_recent',
      'get_recent_posts'=>'json_recent',
      'get_apps'=>'get_apps',
    ];
    $this->{$serv[$_GET['json']]?:'json_recent'}();
    exit;
  }

  public function json_recent()
  {
    $ref=[
      '185668594895616',//=>'คิดว่าดีก็ทำต่อไป',
      '119275421551380',//=>'บ่นบ่น',
      '552419978152008',//=>'กระดาษสีครีม',
      '276439945704187',//=>'สมาคมกวนTEEN 18+',
      '215561678464052',//=>'โสดแสนD',
      '558905540806815',//=>'ว่าแล้ว\'',
      '145147339021153',//=>'หน้ากลม',
      '332998630119285',//=>'หมึกซึม',
      '390054464415577',//=>'พอใจ',
      '294688280665847',//=>'ลึกๆ',
      '418024494891447',//=>'คมเกิ๊น',
      '206907329467617',//=>'Minions thailand',
      '537003989706910',//=>'The Smurfs Thailand',
      '503977206328815',//=>'Jaytherabbit',
      '425434517512362',//=>'Eat All Day',
      '299590466830861',//=>'Timixabie',
      '229198730561050',//=>'Message',
    ];

    $orderby=(string)$_GET['orderby'];
    $count=(int)$_GET['count'];
    $page=(int)$_GET['page'];
    $arg=['dd'=>['$exists'=>false],'fb'=>['$in'=>$ref]];

    if($count<10)
    {
      $count=40;
    }
    elseif($count>100)
    {
      $count=100;
    }
    if($page<1)
    {
      $page=1;
    }
    if($orderby=='views')
    {
      $option=['sort'=>['sh'=>-1],'limit'=>$count];
      $arg['da']=['$gte'=>Load::Time()->now(-3600*24*3)];
    }
    else
    {
      $option=['sort'=>['_id'=>-1],'limit'=>$count,'skip'=>(($page-1)*$count)];
    }
    $pages=1;
    $image=[];
    $db=Load::DB();
    if($c=$db->count('fbimage',$arg))
    {
      $tmp=$db->find('fbimage',$arg,['_id'=>1,'img'=>1,'fb'=>1,'p'=>1],$option);
      for($i=0;$i<count($tmp);$i++)
      {
        $image[]=['id'=>$tmp[$i]['_id'],'title'=>$tmp[$i]['p'],'thumbnail'=>$tmp[$i]['img']];
      }
      if($orderby!='views')
      {
        $pages=ceil($c/$count);
      }
    }

    $data=[
      'status'=>'ok',
      'pages'=>$pages,
      'posts'=>$image
    ];

    if($_GET['callback'])
    {
      header('Content-type: text/javascript');
      echo $_GET['callback'].'('.json_encode($data).')';
    }
    else
    {
      header('Content-type: application/json');
      echo json_encode($data);
    }
  }
}
?>
