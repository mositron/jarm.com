<?php

if(!$customer=$db->findone('team_customer',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]]))
{
  team::move('/customer');
}

if(team::$my['_id']!=$customer['u'] && team::$my['grade']!=99)
{
  team::move('/customer');
}

Load::Ajax()->register(['updatecustomer','refreshfiles','delfile']);

if($_FILES)
{
  if($f=$_FILES['attachment']['tmp_name'])
  {
    $fn=$_FILES['attachment']['name'];
    if(!is_array($f))
    {
      $f=[$f];
      $fn=[$fn];
    }
    $n=time();
    $ni=0;
    foreach($f as $v)
    {
      $link=$n.$ni;
      $path=pathinfo($fn[$ni]);
      $ext=$path['extension'];
      $name=$path['filename'];

      $size=filesize($v);
      $q=Load::Upload()->post('s1','copy','@'.$v,['name'=>$link.'.'.$ext,'folder'=>'team/customer/'.$customer['_id']]);
      if($q['status']=='OK')
      {
        $db->update('team_customer',['_id'=>$customer['_id']],['$push'=>['file'=>[
                                                                                  'name'=>$name,
                                                                                  'link'=>$link,
                                                                                  'ext'=>$ext,
                                                                                  'size'=>$size,
          ]]]);
      }
      $ni++;
    }
    echo json_encode(['status'=>'OK']);
  }
  exit;
}

Load::$core->data['title']='แก้ไข - ข้อมูลลูกค้า | '.Load::$core->data['title'];
Load::$core->data['content']=Load::$core->assign('customer',$customer)
                ->fetch('customer.update');

function updatecustomer($par)
{
  $arg=[];
  $arg['by']=intval($par['by']);
  $arg['name']=trim($par['name']);
  $arg['type']=intval($par['type']);
  $arg['tax']=trim($par['tax']);
  $arg['parent']=intval($par['parent']);
  $arg['sub_tax']=trim($par['sub_tax']);
  $arg['address']=trim($par['address']);
  $arg['service']=intval($par['service']);
  $arg['approve']=['status'=>0,'u'=>0];
  $arg['lock']=['status'=>0,'u'=>0];
  if(is_array($par['brand']))
  {
    $arg['brand']=array_map('intval',(array)$par['brand']);
  }
  elseif($par['brand'])
  {
    $arg['brand']=array(intval($par['brand']));
  }
  if(is_array($par['sale']))
  {
    $arg['sale']=array_map('intval',(array)$par['sale']);
  }
  elseif($par['sale'])
  {
    $arg['sale']=array(intval($par['sale']));
  }
  $arg['bill']=[
      'billing'=>trim($par['bill_billing']),
      'cheque'=>trim($par['bill_cheque']),
      'cash'=>trim($par['bill_cash']),
      'term'=>trim($par['bill_term']),
      'billing_location'=>trim($par['bill_billing_location']),
      'pay'=>intval($par['bill_pay']),
      'cheque_location'=>trim($par['bill_cheque_location']),
      'how_bill'=>intval($par['bill_how_bill']),
      'email'=>trim($par['bill_email']),
      'doc'=>trim($par['bill_doc']),
  ];

  $arg['ue']=team::$my['_id'];
  $arg['de']=Load::Time()->now();
  Load::DB()->update('team_customer',['_id'=>intval(Load::$path[1])],['$set'=>$arg]);

  $contact=[];
  if(is_array($par['contact_name']))
  {
    for($i=0;$i<count($par['contact_name']);$i++)
    {
      $n=trim($par['contact_name'][$i]);
      $p=trim($par['contact_position'][$i]);
      $e=trim($par['contact_email'][$i]);
      $ph=trim($par['contact_phone'][$i]);
      $f=trim($par['contact_fax'][$i]);
      if($n&&$ph)
      {
        $contact[]=[
          'name'=>$n,
          'position'=>$p,
          'email'=>$e,
          'phone'=>$ph,
          'fax'=>$f,
        ];
      }
    }
  }
  else
  {
      $n=trim($par['contact_name']);
      $p=trim($par['contact_position']);
      $e=trim($par['contact_email']);
      $ph=trim($par['contact_phone']);
      $f=trim($par['contact_fax']);
      if($n&&$ph)
      {
        $contact[]=[
          'name'=>$n,
          'position'=>$p,
          'email'=>$e,
          'phone'=>$ph,
          'fax'=>$f,
        ];
      }
  }
  for($i=0;$i<count($contact);$i++)
  {
    Load::DB()->update('team_customer',['_id'=>intval(Load::$path[1])],['$push'=>['contact'=>$contact[$i]]]);
  }

  if(is_array($par['file_name']))
  {
    for($i=0;$i<count($par['file_name']);$i++)
    {
      $n=trim($par['file_name'][$i]);
      $l=trim($par['file_link'][$i]);
      if($n&&$l)
      {
        Load::DB()->update('team_customer',
                        ['_id'=>intval(Load::$path[1]),'file.link'=>$l],
                        ['$set'=>[
                                  'file.$.name'=>$n
                              ]
                        ]
                    );
      }
    }
  }
  else
  {
      $n=trim($par['file_name']);
      $l=trim($par['file_link']);
      if($n&&$l)
      {
        Load::DB()->update('team_customer',
                        ['_id'=>intval(Load::$path[1]),'file.link'=>$l],
                        ['$set'=>[
                                  'file.$.name'=>$n
                              ]
                        ]
                    );
      }
  }

  team::move('/customer/update/'.Load::$path[1].'?completed');
}


function delfile($link,$ext)
{
  Load::DB()->update('team_customer',['_id'=>intval(Load::$path[1])],['$pull'=>['file'=>['link'=>$link]]]);
  Load::Upload()->post('s1','delete','team/customer/'.Load::$path[1].'/'.$link.'.'.$ext);
  refreshfiles();
}

function getfiles()
{
  $customer=Load::DB()->findone('team_customer',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]]);
  $tmp='';
  for($i=0;$i<count($customer['file']);$i++)
  {
    $v=$customer['file'][$i];
    $tmp.='<li class="col-xs-2 col-sm-4 col-md-3">
    <div>
      <span class="mailbox-attachment-icon"><a href="https://f1.jarm.com/team/customer/'.$customer['_id'].'/'.$v['link'].'.'.$v['ext'].'" target="_blank" class="mailbox-attachment-name"><i class="fa fa-'.fileicon($v['ext']).'"></i></a></span>
      <div class="mailbox-attachment-info"><input type="hidden" name="file_link" value="'.$v['link'].'" />
        <div class="wrap-attachment-name"><input type="text" name="file_name" value="'.htmlspecialchars($v['name']).'" class="form-control" /></div>
        <span class="mailbox-attachment-size">'.number_format($v['size']/1024,2).' KB <a href="javascript:;" onclick="delfile(\''.$v['link'].'\',\''.$v['ext'].'\');" class="btn btn-danger btn-xs pull-right btn-javascript-del-file" style="margin-left:3px;"><span class="glyphicon glyphicon-trash"></span></a></span>
      </div>
    </div>
  </li>';
  }
  return $tmp;
}

function refreshfiles()
{
  Load::Ajax()->jquery('.mailbox-attachments','html',getfiles());
}

?>
