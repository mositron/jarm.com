<?php
Load::$conf['db']['collection']['_seq']='s2';
$config = [
            'user'=>[
                    'table'=>'user',
                    'sort'=>'ID',
                    'to'=>'team_user',
                    'field'=>[
                              'ID'=>['rename'=>'_id','type'=>'int'],
                              'grade'=>['type'=>'int'],
                              'user_permission_ID'=>['rename'=>'perm','type'=>'int'],
                              'user_position_ID'=>['rename'=>'pos','type'=>'int'],
                              'user_team_ID'=>['rename'=>'team','type'=>'int'],
                              'code_type_ID'=>['rename'=>'type','type'=>'int'],
                              'code'=>['type'=>'int','min'=>1],
                              'start_work_date'=>['rename'=>'work.start','type'=>'date'],
                              'pass_work_date'=>['rename'=>'work.pass','type'=>'date'],
                              'end_work_date'=>['rename'=>'work.end','type'=>'date'],
                              'status'=>['type'=>'int'],
                              'user_status_ID'=>['rename'=>'user_status','type'=>'int'],
                              'excel_order'=>['rename'=>'excel','type'=>'int'],
                              'display'=>[],
                              'email'=>[],
                              'nickname'=>[],
                              'firstname_th'=>['rename'=>'th.first'],
                              'lastname_th'=>['rename'=>'th.last'],
                              'sex'=>[],
                              'deposit_account_name'=>['rename'=>'bank.name'],
                              'bank_ID'=>['rename'=>'bank.id','type'=>'int'],
                              'deposit_account_number'=>['rename'=>'bank.number'],
                              'firstname_en'=>['rename'=>'en.first'],
                              'lastname_en'=>['rename'=>'en.last'],
                              'address_now'=>['rename'=>'address.current'],
                              'address_main'=>['rename'=>'address.card'],
                              'phone'=>[],
                              'birthday'=>['type'=>'date'],
                              'line_id'=>[],
                              'id_card'=>[],
                              'firstname_reference'=>['rename'=>'ref.first'],
                              'lastname_reference'=>['rename'=>'ref.last'],
                              'relationship_reference'=>['rename'=>'ref.relationship'],
                              'phone_reference'=>['rename'=>'ref.phone'],
                    ]
            ],
            'user_position'=>[
                    'table'=>'user_position',
                    'sort'=>'ID',
                    'to'=>'team_user_position',
                    'field'=>[
                              'ID'=>['rename'=>'_id','type'=>'int'],
                              'display'=>[],
                              'name'=>[],
                              'status'=>['type'=>'int'],
                              'order'=>['type'=>'int'],
                    ],
          ],
          'user_team'=>[
                  'table'=>'user_team',
                  'sort'=>'ID',
                  'to'=>'team_user_team',
                  'field'=>[
                            'ID'=>['rename'=>'_id','type'=>'int'],
                            'display'=>[],
                            'name'=>[],
                            'status'=>['type'=>'int'],
                            'order'=>['type'=>'int'],
                            'order_advance'=>['type'=>'int'],
                  ],
        ],
        'contents_data'=>[
                  'table'=>'contents_data',
                  'sort'=>'ID',
                  'to'=>'team_content',
                  'field'=>[
                            'ID'=>['rename'=>'_id','type'=>'int'],
                            'contents_category_id'=>['rename'=>'type','type'=>'int'],
                            'name'=>['rename'=>'title'],
                            'detail'=>[],
                            'post_user_ID'=>['rename'=>'u','type'=>'int'],
                            'post'=>['rename'=>'da','type'=>'date'],
                            'edited_user_ID'=>['rename'=>'ue','type'=>'int'],
                            'edited'=>['rename'=>'de','type'=>'date'],
                            'status'=>['type'=>'int'],
                  ]
        ],
        'customers_reference_brand'=>[
                  'table'=>'customers_reference_brand',
                  'sort'=>'ID',
                  'to'=>'team_brand',
                  'field'=>[
                            'ID'=>['rename'=>'_id','type'=>'int'],
                            'display'=>[],
                            'name'=>[],
                            'status'=>['type'=>'int'],
                  ]
        ],
        'meeting_data'=>[
                  'table'=>'meeting_data',
                  'sort'=>'ID',
                  'to'=>'team_meeting',
                  'field'=>[
                            'ID'=>['rename'=>'_id','type'=>'int'],
                            'name'=>['rename'=>'title'],
                            'detail'=>[],
                            'post_user_ID'=>['rename'=>'u','type'=>'int'],
                            'post'=>['rename'=>'da','type'=>'date'],
                            'edited_user_ID'=>['rename'=>'ue','type'=>'int'],
                            'edited'=>['rename'=>'de','type'=>'date'],
                            'reference_user_ID'=>['rename'=>'ref','type'=>'int_serialize'],
                            'appointment_start'=>['rename'=>'dp','type'=>'date'],
                            'status'=>['min'=>1,'type'=>'int'],
                  ]
        ],

        'advance'=>[
                  'table'=>'advance',
                  'sort'=>'ID',
                  'to'=>'team_withdraw',
                  'field'=>[
                            'ID'=>['rename'=>'_id','type'=>'int'],
                            'advance_no'=>['rename'=>'no'],
                            'advance_type_ID'=>['rename'=>'type','type'=>'int'],
                            'advance_type_form_ID'=>['rename'=>'form','type'=>'int'],
                            'user_team_ID'=>['rename'=>'team','type'=>'int'],
                            'production_data_ID'=>['rename'=>'product','type'=>'int'],
                            'remark'=>[],
                            'note_recheck'=>['rename'=>'note.rc'],
                            'note_check'=>['rename'=>'note.c'],
                            'note_user'=>['rename'=>'note.u'],
                            'note_highuser'=>['rename'=>'note.uh'],
                            'price_sum'=>['rename'=>'price.sum','type'=>'float'],
                            'price_real_sum'=>['rename'=>'price.real','type'=>'float'],
                            'create_user_ID'=>['rename'=>'u','type'=>'int'],
                            'create'=>['rename'=>'da','type'=>'date'],
                            'edit_user_ID'=>['rename'=>'ue','type'=>'int'],
                            'edit'=>['rename'=>'de','type'=>'date'],
                            'delete_user_ID'=>['rename'=>'ud','type'=>'int'],
                            'delete'=>['rename'=>'dd','type'=>'date'],
                            'advance_status_ID'=>['rename'=>'status','type'=>'int'],

                            'advance_status_2_user_ID'=>['rename'=>'status2.u','type'=>'int'],
                            'advance_status_2'=>['rename'=>'status2.d','type'=>'date'],
                            'advance_status_2_recheck_user_ID'=>['rename'=>'status2.ur','type'=>'int'],
                            'advance_status_2_recheck'=>['rename'=>'status2.dr','type'=>'date'],
                            'advance_status_2_recheck_update_user_ID'=>['rename'=>'status2.uru','type'=>'int'],
                            'advance_status_2_recheck_update'=>['rename'=>'status2.dru','type'=>'date'],

                            'advance_status_3_user_ID'=>['rename'=>'status3.u','type'=>'int'],
                            'advance_status_3'=>['rename'=>'status3.d','type'=>'date'],
                            'advance_status_3_disapprove_user_ID'=>['rename'=>'status3.uc','type'=>'int'],
                            'advance_status_3_disapprove'=>['rename'=>'status3.dc','type'=>'date'],
                            'advance_status_3_disapprove_update_user_ID'=>['rename'=>'status3.ucu','type'=>'int'],
                            'advance_status_3_disapprove_update'=>['rename'=>'status3.dcu','type'=>'date'],

                            'advance_status_4_user_ID'=>['rename'=>'status4.u','type'=>'int'],
                            'advance_status_4'=>['rename'=>'status4.d','type'=>'date'],
                            'advance_status_4_disapprove_user_ID'=>['rename'=>'status4.uc','type'=>'int'],
                            'advance_status_4_disapprove'=>['rename'=>'status4.dc','type'=>'date'],

                            'advance_status_5_user_ID'=>['rename'=>'status5.u','type'=>'int'],
                            'advance_status_5'=>['rename'=>'status5.d','type'=>'date'],

                            'advance_status_6_user_ID'=>['rename'=>'status6.u','type'=>'int'],
                            'advance_status_6'=>['rename'=>'status6.d','type'=>'date'],
                            'advance_status_6_disapprove_user_ID'=>['rename'=>'status6.uc','type'=>'int'],
                            'advance_status_6_disapprove'=>['rename'=>'status6.dc','type'=>'date'],

                            'advance_status_7_user_ID'=>['rename'=>'status7.u','type'=>'int'],
                            'advance_status_7'=>['rename'=>'status7.d','type'=>'date'],

                            'advance_status_8_user_ID'=>['rename'=>'status8.u','type'=>'int'],
                            'advance_status_8'=>['rename'=>'status8.d','type'=>'date'],
                  ],
        ],

        'advance_list'=>[
                  'table'=>'advance_list',
                  'sort'=>'ID',
                  'to'=>'team_withdraw_list',
                  'field'=>[
                            'ID'=>['rename'=>'_id','type'=>'int'],
                            'advance_type_ID'=>['rename'=>'type','type'=>'int'],
                            'name'=>[],
                            'status'=>['type'=>'int']
                  ]
        ],

        'advance_list_data'=>[
                  'table'=>'advance_list_data',
                  'sort'=>'ID',
                  'to'=>'team_withdraw_data',
                  'field'=>[
                            'ID'=>['rename'=>'_id','type'=>'int'],
                            'advance_ID'=>['rename'=>'withdraw','type'=>'int'],
                            'advance_type_ID'=>['rename'=>'type','type'=>'int'],
                            'advance_list_ID'=>['rename'=>'list','type'=>'int'],
                            'production_data_ID'=>['rename'=>'product','type'=>'int'],
                            'user_team_ID'=>['rename'=>'team','type'=>'int'],
                            'remark'=>[],
                            'remark_real'=>[],
                            'amount'=>['type'=>'int'],
                            'price'=>['type'=>'float'],
                            'price_real'=>['type'=>'float'],
                            'advance_status_ID'=>['rename'=>'status','type'=>'int'],
                  ]
        ],

        'production_data'=>[
                  'table'=>'production_data',
                  'sort'=>'ID',
                  'to'=>'team_queue',
                  'field'=>[
                            'ID'=>['rename'=>'_id','type'=>'int'],
                            'process'=>[],
                            'status'=>['type'=>'int'],
                            'flag'=>['type'=>'int'],
                            'thumbnail'=>[],
                            'name'=>[],
                            'phone'=>[],
                            'detail'=>[],
                            'note'=>[],
                            'note_queue'=>[],
                            'type_ID'=>['rename'=>'type','type'=>'int'],
                            'location'=>[],
                            'province_ID'=>['rename'=>'province','type'=>'int'],
                            'appointment_start'=>['rename'=>'ds1','type'=>'date'],
                            'appointment_end'=>['rename'=>'ds2','type'=>'date'],
                            'reference_user_ID'=>['rename'=>'ref','type'=>'int_serialize'],
                            'post_stock_user_ID'=>['rename'=>'u','type'=>'int'],
                            'post_stock'=>['rename'=>'da','type'=>'date'],
                            'edited_stock_user_ID'=>['rename'=>'ue','type'=>'int'],
                            'edited_stock'=>['rename'=>'de','type'=>'date'],
                            'post_queue_user_ID'=>['rename'=>'upq','type'=>'int'],
                            'post_queue'=>['rename'=>'dpq','type'=>'date'],
                            'edited_queue_user_ID'=>['rename'=>'ueq','type'=>'int'],
                            'edited_queue'=>['rename'=>'deq','type'=>'date'],
                            'post_process_user_ID'=>['rename'=>'upp','type'=>'int'],
                            'post_process'=>['rename'=>'dpp','type'=>'date'],
                            'post_complete_user_ID'=>['rename'=>'upc','type'=>'int'],
                            'post_complete'=>['rename'=>'dpc','type'=>'date'],
                            'edited_complete_user_ID'=>['rename'=>'uec','type'=>'int'],
                            'edited_complete'=>['rename'=>'dec','type'=>'date'],
                            'switch_team'=>['rename'=>'team','type'=>'int'],
                            'photo_process'=>['rename'=>'pt.p','type'=>'int'],
                            'photo_complete_user_ID'=>['rename'=>'pt.u','type'=>'int'],
                            'photo_complete'=>['rename'=>'pt.d','type'=>'date'],
                            'production_process'=>['rename'=>'pd.p','type'=>'int'],
                            'production_complete_user_ID'=>['rename'=>'pd.u','type'=>'int'],
                            'production_complete'=>['rename'=>'pd.d','type'=>'date'],
                            'production_link'=>['rename'=>'pd.l'],
                            'graphic_process'=>['rename'=>'gp.p','type'=>'int'],
                            'graphic_complete_user_ID'=>['rename'=>'gp.u','type'=>'int'],
                            'graphic_complete'=>['rename'=>'gp.d','type'=>'date'],
                            'content_process'=>['rename'=>'ct.p','type'=>'int'],
                            'content_complete_user_ID'=>['rename'=>'ct.u','type'=>'int'],
                            'content_complete'=>['rename'=>'ct.d','type'=>'date'],
                            'content_link'=>['rename'=>'ct.l'],
                  ]
        ],

        'logs_data'=>[
                  'table'=>'logs_data',
                  'sort'=>'ID',
                  'to'=>'team_logs',
                  'field'=>[
                            'ID'=>['rename'=>'_id','type'=>'int'],
                            'logs_type_ID'=>['rename'=>'type','type'=>'int'],
                            'module'=>[],
                            'data_ID'=>['rename'=>'data','type'=>'int'],
                            'detail'=>[],
                            'added_user_ID'=>['rename'=>'u','type'=>'int'],
                            'edited_user_ID'=>['rename'=>'ue','type'=>'int'],
                            'deleted_user_ID'=>['rename'=>'ud','type'=>'int'],
                            'datetime'=>['rename'=>'da','type'=>'date'],
                            'status'=>['type'=>'int'],
                  ]
        ],
        'customers'=>[
                  'table'=>'customers',
                  'sort'=>'ID',
                  'to'=>'team_customer',
                  'field'=>[
                            'ID'=>['rename'=>'_id','type'=>'int'],
                            'customers_company_under_ID'=>['rename'=>'by','type'=>'int'],
                            'customers_company_type_ID'=>['rename'=>'type','type'=>'int'],
                            'name'=>[],
                            'customers_ID'=>['rename'=>'parent','type'=>'int'],
                            'tax'=>['type'=>'int'],
                            'sub_tax'=>['type'=>'int'],
                            'address'=>[],
                            'customers_type_ID'=>['rename'=>'service','type'=>'int'],
                            'bill_of_mouth'=>['rename'=>'bill.billing'],
                            'due_recive_cheque'=>['rename'=>'bill.cheque'],
                            'due_recive_cash'=>['rename'=>'bill.cash'],
                            'cr_term'=>['rename'=>'bill.term','type'=>'int'],
                            'location_billing'=>['rename'=>'bill.billing_location'],
                            'customers_how_to_pay_ID'=>['rename'=>'bill.pay','type'=>'int'],
                            'location_cheque'=>['rename'=>'bill.cheque_location'],
                            'customers_how_to_bill_ID'=>['rename'=>'bill.how_bill','type'=>'int'],
                            'email_bill'=>['rename'=>'bill.email'],
                            'list_doc_bill'=>['rename'=>'bill.doc'],
                            'create_user_ID'=>['rename'=>'u','type'=>'int'],
                            'create'=>['rename'=>'da','type'=>'date'],
                            'edit_user_ID'=>['rename'=>'ue','type'=>'int'],
                            'edit'=>['rename'=>'de','type'=>'date'],
                            'delete_user_ID'=>['rename'=>'ud','type'=>'date'],
                            'delete'=>['rename'=>'dd','type'=>'date'],
                            'client_code'=>['rename'=>'client','type'=>'int'],
                            'status_approve'=>['rename'=>'approve.status','type'=>'int'],
                            'approve_user_ID'=>['rename'=>'approve.u','type'=>'int'],
                            'approve'=>['rename'=>'approve.d','type'=>'date'],
                            'status_lock'=>['rename'=>'lock.status','type'=>'int'],
                            'lock_user_ID'=>['rename'=>'lock.u','type'=>'int'],
                            'lock'=>['rename'=>'lock.d','type'=>'date'],
                            'status'=>['type'=>'int'],
                  ]
        ],

        'calendar_event'=>[
                  'table'=>'calendar_event',
                  'sort'=>'ID',
                  'to'=>'team_calendar',
                  'field'=>[
                            'ID'=>['rename'=>'_id','type'=>'int'],
                            'user_ID'=>['rename'=>'u','type'=>'int'],
                            'type'=>[],
                            'production_data_ID'=>['rename'=>'production','type'=>'int'],
                            'meeting_data_ID'=>['rename'=>'meeting','type'=>'int'],
                            'report_data_ID'=>['rename'=>'report','type'=>'int'],
                  ]
        ],
];

$db=Load::DB();
foreach($config as $k=>$v)
{
  $data = Load::Http()->get('http://team.inet-rev.co.th/team_export.php?table='.$v['table'].'&sort='.$v['sort']);
  $arr = eval('return '.$data.';');
  $rows = [];
  $max = 0;
  foreach ((array)$arr as $row)
  {
    $tmp = [];
    $passed = false;
    foreach ($row as $key=>$val)
    {
      if(isset($v['field'][$key]))
      {
        $f = $v['field'][$key];
        $val =trim($val);
        $vl = $val;
        if($f['type']=='int')
        {
          $vl = intval($val);
          if($f['min'] && $f['min']>$vl)
          {
            $passed=true;
            continue;
          }
        }
        elseif($f['type']=='float')
        {
          $vl = floatval($val);
          if($f['min'] && $f['min']>$vl)
          {
            $passed=true;
            continue;
          }
        }
        elseif($f['type']=='int_serialize')
        {
          $vl=array_map('intval',(array)unserialize($vl));
        }
        elseif($f['type']=='date')
        {
          if($vl=='0000-00-00' || $vl=='1970-01-01')
          {
            $vl = NULL;
          }
          elseif($vl)
          {
            $vl = Load::Time()->from($vl);
          }
          else
          {
            $vl = NULL;
          }
        }
        if(!is_null($vl))
        {
          if($f['rename'])
          {
            $sp = explode('.',$f['rename']);
            if(count($sp)>1)
            {
              if(!is_array($tmp[$sp[0]]))
              {
                $tmp[$sp[0]]=[];
              }
              $tmp[$sp[0]][$sp[1]]=$vl;
            }
            else
            {
              $tmp[$f['rename']]=$vl;
            }
          }
          else
          {
            $tmp[$key]=$vl;
          }
        }
      }
      else
      {
        //$tmp[$key]=$val;
      }
    }

    $cur=intval($row[$v['sort']]);
    if($cur>$max)
    {
      $max=$cur;
    }
    if($passed)
    {
      continue;
    }
    $db->insert($v['to'],$tmp);
    $rows[] = $tmp;
  }
  echo '---'.$max.'---';
  if($max>0)
  {
    if($seq = $db->findone('_seq',['_id'=>$v['to']]))
    {
      $db->update('_seq',['_id'=>$v['to']],['$set'=>['seq'=>$max]]);
    }
    else
    {
      $db->insert('_seq',['_id'=>$v['to'],'seq'=>$max]);
    }
  }
  //print_r($rows);
}



// change code to new gen.
$user=$db->find('team_user');
for($i=0;$i<count($user);$i++)
{
  $u=$user[$i];
  if($u['code']>100 && $u['code']<1000)
  {
    if($u['type']==1)
    {
    //  $db->update('team_user',['_id'=>$u['_id']],['$inc'=>['code'=>8000]]);
    }
    elseif($u['type']==2 && $u['code']>200 && $u['code']<300)
    {
      $db->update('team_user',['_id'=>$u['_id']],['$inc'=>['code'=>300]]);
    }
    elseif($u['type']==3)
    {
      //$db->update('team_user',['_id'=>$u['_id']],['$inc'=>['code'=>6000]]);
    }
    elseif($u['type']==4 && $u['code']>300 && $u['code']<400)
    {
      $db->update('team_user',['_id'=>$u['_id']],['$inc'=>['code'=>400]]);
    }
  }

  //http://team.inet-rev.co.th/assets/dist/img/avatar/17.jpg
  if($f=file_get_contents('http://team.inet-rev.co.th/assets/dist/img/avatar/'.$u['_id'].'.jpg',
    false,
    stream_context_create(['http' =>['ignore_errors'=>true]])))
  {
    file_put_contents('/tmp/file.jpg', $f);
    Load::Upload()->post('f1','upload','@/tmp/file.jpg',['name'=>$u['_id'].'-s','type'=>'jpg','folder'=>'team/user','width'=>160,'height'=>160,'fix'=>'bothtop']);
    Load::Upload()->post('f1','upload','@/tmp/file.jpg',['name'=>$u['_id'],'type'=>'jpg','folder'=>'team/user','width'=>500,'height'=>500,'fix'=>'bothtop']);
    //json_encode(['file'=>'https://f1.jarm.com/team/user/'.$user['_id'].'-s.jpg?'.time()]);
  }
}


$queue=$db->find('team_queue');
for($i=0;$i<count($queue);$i++)
{
  $q=$queue[$i];
  if($f=file_get_contents('http://team.inet-rev.co.th/assets/dist/img/contents/production/thumbnail/'.$q['_id'].'.jpg',
    false,
    stream_context_create(['http' =>['ignore_errors'=>true]])))
  {
    file_put_contents('/tmp/file.jpg', $f);
    Load::Upload()->post('f1','upload','@/tmp/file.jpg',['name'=>$q['_id'],'type'=>'jpg','folder'=>'team/queue','width'=>133,'height'=>133,'fix'=>'inboth']);
    //json_encode(['file'=>'https://f1.jarm.com/team/user/'.$user['_id'].'-s.jpg?'.time()]);
  }
}



$db->update('team_customer',[],['$set'=>['brand'=>[]]],['multiple'=>true]);

$data = Load::Http()->get('http://team.inet-rev.co.th/team_export.php?table=customers_reference_brand_data&sort=ID');
$arr = eval('return '.$data.';');
$rows = [];
$max = 0;
foreach ($arr as $row)
{
  //print_r($row);
  // array ( 'ID' => '49', 'customers_ID' => '44', 'customers_reference_brand_ID' => '12', )
  $db->update('team_customer',['_id'=>intval($row['customers_ID'])],['$push'=>['brand'=>intval($row['customers_reference_brand_ID'])]]);
}

$db->update('team_customer',[],['$set'=>['sale'=>[]]],['multiple'=>true]);

$data = Load::Http()->get('http://team.inet-rev.co.th/team_export.php?table=customers_reference_users_data&sort=ID');
$arr = eval('return '.$data.';');
$rows = [];
$max = 0;
foreach ($arr as $row)
{
  //print_r($row);
  // array ( 'ID' => '49', 'customers_ID' => '44', 'customers_reference_brand_ID' => '12', )
  $db->update('team_customer',['_id'=>intval($row['customers_ID'])],['$push'=>['sale'=>intval($row['user_ID'])]]);
}

$db->update('team_customer',[],['$set'=>['contact'=>[]]],['multiple'=>true]);

$data = Load::Http()->get('http://team.inet-rev.co.th/team_export.php?table=customers_reference_contact_data&sort=ID');
$arr = eval('return '.$data.';');
$rows = [];
$max = 0;
foreach ($arr as $row)
{
  //print_r($row);
  $db->update('team_customer',['_id'=>intval($row['customers_ID'])],['$push'=>
        [
          'contact'=>[
            'name'=>trim($row['name']),
            'position'=>trim($row['position']),
            'email'=>trim($row['email']),
            'phone'=>trim($row['phone']),
            'fax'=>trim($row['fax']),
          ]
        ]]);
}


$db->update('team_customer',[],['$set'=>['file'=>[]]],['multiple'=>true]);

$data = Load::Http()->get('http://team.inet-rev.co.th/team_export.php?table=file_upload&sort=ID');
$arr = eval('return '.$data.';');
$rows = [];
$max = 0;
foreach ($arr as $row)
{
  if($row['module']=='customers')
  {
    //print_r($row);
    $db->update('team_customer',['_id'=>intval($row['data_ID'])],['$push'=>
          [
            'file'=>[
              'name'=>trim($row['name']),
              'link'=>trim($row['link']),
              'ext'=>trim($row['ext']),
              'size'=>intval($row['size']),
            ]
          ]]);
  }
}


$with=$db->find('team_withdraw',['price.sum'=>0]);
for($j=0;$j<count($with);$j++)
{
  $v=$with[$j];
  $price=0;
  if($sum=$db->find('team_withdraw_data',['withdraw'=>$v['_id']],['price'=>1]))
  {
    for($i=0;$i<count($sum);$i++)
    {
      $price+=$sum[$i]['price'];
    }
  }
  $db->update('team_withdraw',['_id'=>$v['_id']],['$set'=>['price.sum'=>$price]]);
}


$with=$db->find('team_withdraw',['cv_status'=>['$ne'=>1]]);
for($j=0;$j<count($with);$j++)
{
  $v=$with[$j];
  $set=[
    'cv_status'=>1,
    'status1.u'=>intval($v['status2']['u']),
    'status1.d'=>$v['status2']['d'],
    'status2.u'=>intval($v['status2']['ur']),
    'status2.d'=>$v['status2']['dr'],
    'status4.u'=>intval($v['status3']['uc']),
    'status4.d'=>$v['status3']['dc'],
    'status5.u'=>intval($v['status4']['u']),
    'status5.d'=>$v['status4']['d'],
    'status6.u'=>intval($v['status5']['u']),
    'status6.d'=>$v['status5']['d'],
    'status7.u'=>intval($v['status6']['u']),
    'status7.d'=>$v['status6']['d'],
    'status8.u'=>intval($v['status7']['u']),
    'status8.d'=>$v['status7']['d'],
    'status9.u'=>intval($v['status8']['u']),
    'status9.d'=>$v['status8']['d'],
    'status'=>-1
  ];

  if(intval($v['status8']['u'])!=0)
  {
    $set['status']=9;
  }
  elseif($v['status']==1)// && intval($v['status2']['u'])==0
  {
    if(intval($v['status2']['ur'])!=0)
    {
      //$arg=['status'=>1,'status2.ur'=>['$ne'=>0]];
      // advance_status_ID = 1 AND advance_status_2_recheck_user_ID IS NOT NULL".$condition;
      $set['status']=2;
    }
    else
    {
      //$arg=['status'=>1,'u'=>team::$my['_id'],'status2.u'=>0];
      $set['status']=0;
    }
  }
  elseif($v['status']==2)// && intval($v['status8']['u'])==0
  {
    if(intval($v['status3']['uc'])==0)
    {
    //$arg=['status'=>2,'status3.uc'=>0,'status8.u'=>0];
  //  advance_status_ID = 2 AND advance_status_3_disapprove_user_ID IS NULL AND advance_status_8_user_ID IS NULL".$condition;
      $set['status']=1;
    }
    else
    {
      //$arg=['status'=>2,'status3.uc'=>['$ne'=>0]];
      $set['status']=4;
    }
  }
  elseif($v['status']==3)
  {
    //$arg=['status'=>3];
    $set['status']=3;
  }
  elseif($v['status']==4)// && intval($v['status8']['u'])==0
  {
    //$arg=['status'=>4,'status8.u'=>0];
    $set['status']=5;
  }
  elseif($v['status']==5)// && intval($v['status8']['u'])==0
  {
    //$arg=['status'=>5,'status8.u'=>0];
    $set['status']=6;
  }
  elseif($v['status']==6)// && intval($v['status8']['u'])==0
  {
    //$arg=['status'=>6,'status8.u'=>0];
    $set['status']=7;
  }
  elseif($v['status']==7)// && intval($v['status8']['u'])==0
  {
    //$arg=['status'=>7,'status8.u'=>0];
    $set['status']=8;
  }
  if($set['status']>-1)
  {
    $db->update('team_withdraw',['_id'=>$v['_id']],['$set'=>$set]);
  }
}

exit;
?>
