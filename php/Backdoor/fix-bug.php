<?php

require_once __DIR__.'/door.php';



# -commit #15
# {"_id":{"$lte":10000},"ds":{"$gte":"2017-01-01 00:00:00.000"}}
/*
$o=$db->find('news',['_id'=>['$lte'=>60000],'ds'=>['$gte'=>$time->from('2017-01-01 00:00:00')]]);
for($i=0;$i<count($o);$i++)
{
  #$db->update('news',['_id'=>$o[$i]['_id']],['$set'=>['ds'=>$time->from($o[$i]['da'])]]);
  echo $o[$i]['_id'].' - '.$time->from($o[$i]['da'],'date').' - '.$time->from($o[$i]['ds'],'date').'<br>';
}
*/
?>
