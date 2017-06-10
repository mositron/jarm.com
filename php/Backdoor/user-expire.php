<?php

require_once __DIR__.'/door.php';


$year1=time()-(365*24*3600);
$year2=time()-(30*24*3600);
$year3=time()-(3*24*3600);

$ban=$db->find('user',
  [
    'am'=>['$exists'=>false],
    '$or'=>[
    /*
      [
        'st'=>1,
        'du'=>['$lt'=>$time->from($year1)],
      ],
      */
      [
        'st'=>0,
        'du'=>['$lt'=>$time->from($year2)],
      ],
      [
        'st'=>['$exists'=>false],
        'du'=>['$lt'=>$time->from($year2)],
      ],
      [
        'du'=>['$exists'=>false],
        'da'=>['$lt'=>$time->from($year3)],
      ]
    ]
  ],
  [],
  ['limit'=>1000,'sort'=>['_id'=>1]]
);
//print_r( $ban);
echo count($ban).'<br>';

for($i=0;$i<count($ban);$i++)
{
  $status=intval($ban[$i]['st']);
  echo $ban[$i]['_id'].' - em = '.$ban[$i]['em'].' - add = '.$time->from($ban[$i]['da'],'datetime').' - last = '.$time->from($ban[$i]['du'],'datetime').' - st = '.$ban[$i]['st'].' ('.$status.')<br>';
  if($status>1||$ban[$i]['am'])
  {
    continue;
  }
  if(($ban[$i]['st']==1&&Load::Time()->sec($ban[$i]['du'])<=$year1)||($ban[$i]['st']==0&&Load::Time()->sec($ban[$i]['du'])<=$year2)||(empty($ban[$i]['du'])&&Load::Time()->sec($ban[$i]['da'])<=$year2))
  {
    $db->remove('user',['_id'=>$ban[$i]['_id']]);
    //$db->update('video',['u'=>$ban[$i]['_id']],['$set'=>['dd'=>$ban[$i]['du']]],['multiple'=>true]);
    $db->update('forum',['u'=>$ban[$i]['_id']],['$set'=>['dd'=>$ban[$i]['du']]],['multiple'=>true]);
    $q=$upload->post($ban[$i]['sv'],'profile-remove',$ban[$i]['if']['fd']);
    echo $ban[$i]['_id'].' - if.fd = '.$ban[$i]['if']['fd'].' - '. $q['status'].' - '.$q['message'].'<br>';
  }
}
/*
for($i=0;$i<count($user);$i++)
{
  $sc = floor(intval($user[$i]['if']['crank'])/60);
  $db->update('user',['_id'=>$user[$i]['_id']],['$set'=>['if.ch.sc'=>$sc,'if.ch.na'=>$user[$i]['if']['cn']]]);
}
echo count($user);
*/

?>
