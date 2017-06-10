<?php

if(!$customer=$db->findone('team_customer',['_id'=>intval(Load::$path[0]),'dd'=>['$exists'=>false]]))
{
  team::move('/customer');
}


Load::$core->data['title']=$customer['name'].' | '.Load::$core->data['title'];

Load::$core->data['content']=Load::$core->assign('customer',$customer)
                ->fetch('customer.view');

function getfiles()
{
  $customer=Load::DB()->findone('team_customer',['_id'=>intval(Load::$path[0]),'dd'=>['$exists'=>false]]);
  $tmp='';
  for($i=0;$i<count($customer['file']);$i++)
  {
    $v=$customer['file'][$i];
    $tmp.='<li class="col-xs-2 col-sm-4 col-md-3">
    <div>
      <span class="mailbox-attachment-icon"><a href="https://f1.jarm.com/team/customer/'.$customer['_id'].'/'.$v['link'].'.'.$v['ext'].'" target="_blank" class="mailbox-attachment-name"><i class="fa fa-'.fileicon($v['ext']).'"></i></a></span>
      <div class="mailbox-attachment-info">
        <div class="wrap-attachment-name"><a href="https://f1.jarm.com/team/customer/'.$customer['_id'].'/'.$v['link'].'.'.$v['ext'].'" target="_blank" class="mailbox-attachment-name">'.htmlspecialchars($v['name']).'</a></div>
        <span class="mailbox-attachment-size">'.number_format($v['size']/1024,2).' KB</span>
      </div>
    </div>
  </li>';
  }
  return $tmp;
}

?>
