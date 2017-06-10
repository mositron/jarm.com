<?php
team::session()->logged();

$company_type=[
  1=>[
    'display'=>'สำนักงานใหญ่',
    'name'=>'สำนักงานใหญ่',
  ],
  2=>[
    'display'=>'สาขา',
    'name'=>'สาขา',
  ]
];

$company_service=[
  1=>[
    'display'=>'Agency',
    'name'=>'Agency',
  ],
  2=>[
    'display'=>'Direct',
    'name'=>'Direct',
  ]
];

$by=[
  1=>[
    'display'=>'ไอเน็ต',
    'name'=>'บริษัท ไอเน็ต เรฟโวลูชั่นส์ จำกัด (สำนักงานใหญ่)',
    'address'=>'50/816 หมู่ที่ 9 ต.บางพูด อ.ปากเกร็ด จ.นนทบุรี 11120',
    'phone'=>'02-503-3177',
    'tax'=>'0-4255-47000-17-1'
  ],
  2=>[
    'display'=>'เรซซิ่งบ๊อกซ์',
    'name'=>'บริษัท เรซซิ่ง บ๊อกซ์ จำกัด (สำนักงานใหญ่)',
    'address'=>'50/816 หมู่ที่ 9 ต.บางพูด อ.ปากเกร็ด จ.นนทบุรี 11120',
    'phone'=>'02-503-3177',
    'tax'=>'0-1055-48044-06-0'
  ]
];

$pay=[
  1=>[
      'name'=>'จ่ายเป็นโอนเงิน',
      'display'=>'จ่ายเป็นโอนเงิน'
  ],
  2=>[
      'name'=>'รับเช็ค',
      'display'=>'รับเช็ค'
  ]
];

$bill=[
  1=>[
    'name'=>'วางบิลด้วย Email',
    'display'=>'วางบิลด้วย Email'
  ],
  2=>[
    'name'=>'วางบิลด้วย เอกสาร',
    'display'=>'วางบิลด้วย เอกสาร',
  ]
];
$db=Load::DB();
$tmp=$db->find('team_brand',['status'=>1],[],['sort'=>['display'=>1]]);
$brand=[];
for($i=0;$i<count($tmp);$i++)
{
  $brand[$tmp[$i]['_id']]=$tmp[$i];
}
$tmp=$db->find('team_user',['_id'=>['$in'=>[30,31,32,33,43,58,74]]],['_id'=>1,'th'=>1,'nickname'=>1],['sort'=>['th.first'=>1,'th.last'=>1]]);
$sale=[];
for($i=0;$i<count($tmp);$i++)
{
  $sale[$tmp[$i]['_id']]=$tmp[$i];
}

Load::$core->assign('by',$by)
    ->assign('pay',$pay)
    ->assign('bill',$bill)
    ->assign('sale',$sale)
    ->assign('brand',$brand)
    ->assign('company_type',$company_type)
    ->assign('company_service',$company_service);

if(in_array(Load::$path[0],['update']))
{
  require_once(__DIR__.'/team.customer.'.Load::$path[0].'.php');
}
elseif(is_numeric(Load::$path[0]))
{
  require_once(__DIR__.'/team.customer.view.php');
}
else
{
  require_once(__DIR__.'/team.customer.home.php');
}


function fileicon($ext)
{
  if(in_array($ext,['jpg','png','gif']))
  {
    return 'file-image-o';
  }
  elseif(in_array($ext,['pdf']))
  {
    return 'file-pdf-o';
  }
  elseif(in_array($ext,['doc','dot','docx','dotx','docm','dotm']))
  {
    return 'file-word-o';
  }
  elseif(in_array($ext,['xls','xlt','xla','xlsx','xltx','xlsm','xltm','xlam','xlsb']))
  {
    return 'file-excel-o';
  }
  elseif(in_array($ext,['ppt','pot','pps','ppa','pptx','potx','ppsx','ppam','pptm','potm','ppsm']))
  {
    return 'file-powerpoint-o';
  }
  elseif(in_array($ext,['zip','rar','exe','msi','cab']))
  {
    return 'file-zip-o';
  }
  else
  {
    return 'file';
  }
}

?>
