<?php

if(!$withdraw=$db->findone('team_withdraw',['_id'=>intval(Load::$path[1]),'dd'=>['$exists'=>false]]))
{
  team::move('/withdraw');
}

if(team::$my['_id']!=$withdraw['u'] && team::$my['grade']!=99)
{
  team::move('/withdraw/'.$withdraw['_id']);
}

if(!in_array($withdraw['status'],[0,2,6]))
{
  team::move('/withdraw/'.$withdraw['_id']);
}


Load::Ajax()->register(['updatewithdraw','newdata','deldata']);
Load::Ajax()->register(['setstatus','setrealprice'],'withdraw');

Load::$core->data['title']='แก้ไข - เบิกเงิน | '.Load::$core->data['title'];

if(in_array($withdraw['status'],[0,2]))
{
  Load::$core->data['content']=Load::$core->assign('withdraw',$withdraw)
                ->fetch('withdraw.update');
}
elseif(in_array($withdraw['status'],[6]))
{
  $user=$db->findone('team_user',['_id'=>$withdraw['u']],['th'=>1,'nickname'=>1]);
  $data=$db->find('team_withdraw_data',['withdraw'=>$withdraw['_id']]);
  $prod=$product[$withdraw['product']];
  Load::$core->data['content']=Load::$core->assign('withdraw',$withdraw)
                  ->assign('user',$user)
                  ->assign('prod',$prod)
                  ->assign('data',$data)
                  ->fetch('withdraw.update.pay');
}
function updatewithdraw($par)
{
  global $withdraw;
  if(in_array($withdraw['status'],[0,2]))
  {
    $arg=[];
    $arg['form']=intval($par['form']);
    $arg['type']=intval($par['type']);
    $arg['product']=intval($par['product']);
    $arg['team']=intval($par['team']);

    if($arg['form']&&$arg['type']&&$arg['team'])
    {
      //$arg['product']&&
      if($arg['type']!=1 || $arg['product'])
      {
        $arg['remark']=stripslashes(trim($par['remark']));
        //$arg['dp']=Load::Time()->from($par['time']);
        $arg['ue']=team::$my['_id'];
        $arg['de']=Load::Time()->now();



        $id=Load::DB()->update('team_withdraw',['_id'=>intval(Load::$path[1])],['$set'=>$arg]);
        team::move('/withdraw/update/'.intval(Load::$path[1]).'?completed');
        return;
      }
    }
  }
  Load::Ajax()->alert('กรุณาเลือกข้อมูลให้ครบ');
}

function newdata($par)
{
  $db=Load::DB();
  $arg=[];
  $arg['withdraw']=intval(Load::$path[1]);
  $arg['list']=intval($par['list']);
  $arg['amount']=intval($par['amount']);
  $arg['price']=floatval($par['price']);
  $arg['remark']=trim($par['remark']);
  if($arg['withdraw']&&$arg['list']&&$arg['amount']&&$arg['price'])
  {
    $price=0;
    $db->insert('team_withdraw_data',$arg);
    if($sum=$db->find('team_withdraw_data',['withdraw'=>$arg['withdraw']],['price'=>1]))
    {
      for($i=0;$i<count($sum);$i++)
      {
        $price+=$sum[$i]['price'];
      }
    }
    $db->update('team_withdraw',['_id'=>$arg['withdraw']],['$set'=>['price.sum'=>$price]]);
  }
  Load::Ajax()->jquery('#getdata','html',getdata());
}

function deldata($i)
{
  $price=0;
  $db=Load::DB();
  $db->remove('team_withdraw_data',['withdraw'=>intval(Load::$path[1]),'_id'=>intval($i)]);
  if($sum=$db->find('team_withdraw_data',['withdraw'=>$arg['withdraw']],['price'=>1]))
  {
    for($i=0;$i<count($sum);$i++)
    {
      $price+=$sum[$i]['price'];
    }
  }
  $db->update('team_withdraw',['_id'=>$arg['withdraw']],['$set'=>['price.sum'=>$price]]);
  Load::Ajax()->jquery('#getdata','html',getdata());
}


function getdata()
{
  global $list,$withdraw;

  if($data=Load::DB()->find('team_withdraw_data',['withdraw'=>intval(Load::$path[1])],[],['sort'=>['_id'=>1]]))
  {
    $sum_real=0;
    $sum_price=0;
    if(in_array($withdraw['status'],[0,2]))
    {
      $tmp='<table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th style="width:30px">#</th>
            <th>รายการ</th>
            <th class="text-right">จำนวน</th>
            <th class="text-right">ราคา</th>
            <th>หมายเหตุ</th>
            <th style="width:30px;">&nbsp;</th>
          </tr>
        </thead>
        <tbody>';
        $i=1;
        foreach ($data as $v)
        {
          $tmp.='<tr>
            <td><span class="numData">'.$i.'</span>.</td>
            <td>'.$list[$v['list']]['name'].'</td>
            <td class="text-right">'.($v['amount']?number_format($v['amount']):'').'</td>
            <td class="text-right">';
          if($v['price'])
          {
            $sum_price+=$v['price'];
            $tmp.=number_format($v['price'],2);
          }
          $tmp.='</td>
            <td class="text-left">'.($v['remark']?nl2br($v['remark']):'-').'</td>
            <td class="text-center">
              <button type="button" class="btn btn-danger btn-xs rmvButton" onClick="delRow('.$v['_id'].');"><i class="fa fa-trash-o"></i></button>
            </td>
          </tr>';
          $i++;
        }
        $tmp.='</tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="text-right">รวมเป็นเงินทั้งสิ้น</td>
            <td class="text-right">'.number_format($sum_price,2).'</td>
            <td colspan="2">&nbsp;</td>
          </tr>
        </tfoot>
      </table>';
      return $tmp;
    }
    elseif(in_array($withdraw['status'],[6]))
    {
      $tmp='<div style="margin-top:10px;">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th style="min-width:100px">รายการ</th>
                  <th class="text-right" style="width:60px">จำนวน</th>
                  <th class="text-right" style="width:80px">ราคา</th>
                  <th class="text-right" style="width:90px">ราคาจริง</th>
                  <th class="text-left">หมายเหตุ</th>
                  <th class="text-left" style="min-width:140px">หมายเหตุราคาจริง</th>
                  <th style="width:50px"></th>
                </tr>
              </thead>
              <tbody>';
      for($i=0;$i<count($data);$i++)
      {
        $v=$data[$i];
        $tmp.='<tr class="row-data-'.$v['_id'].'">
                <td><span class="numData">'.($i+1).'</span>.</td>
                <td>'.$list[$v['list']]['name'].'</td>
                <td class="text-right">';
        if($v['amount'])
        {
          $tmp.=number_format($v['amount']);
        }
        $tmp.='</td><td class="text-right">';
        if($v['price'])
        {
          $sum_price+=$v['price'];
          $tmp.=number_format($v['price'],2);
        }
        $tmp.='</td><td class="text-right">';
        if($v['price_real'])
        {
          $sum_real+=$v['price_real'];
          $tmp.=number_format($v['price_real'],2);
        }
        else
        {
          $tmp.='-';
        }
        $tmp.='</td><td class="text-left">'.(($v['remark'])?nl2br($v['remark']):'-').'</td>
                <td class="text-left">'.(($v['remark_real'])?nl2br($v['remark_real']):'-').'</td>
                <td>
                  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" data-id="'.$v['_id'].'" data-name="'.$list[$v['list']]['name'].'">
                    <span class="glyphicon glyphicon-pencil"></span>
                  </button>
                </td>
              </tr>';
      }
      $tmp.='</tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="text-right">รวมเป็นเงินทั้งสิ้น</td>
                <td class="text-right">'.number_format($sum_price,2).'</td>
                <td class="text-right">'.number_format($sum_real,2).'</td>
                <td colspan="3">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" class="text-right">คงเหลือ</td>
                <td colspan="2" class="text-right">'.number_format($sum_price-$sum_real,2).'</td>
                <td colspan="3">&nbsp;</td>
              </tr>
            </tfoot>
          </table>
      </div>';
      return $tmp;
    }
  }
  else
  {
    return '';
  }
}
?>
