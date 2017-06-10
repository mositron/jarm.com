<style>
.table thead tr th{text-align:center;}
.table tbody tr td.c{text-align:center;}
.table tbody tr td.r{text-align:right;}
.w50{width:50px;}
.w80{width:80px;}
.w100{width:100px;}
.w130{width:130px;font-size:13px;}
.w150{width:150px;}
.w200{width:200px; font-size:13px;}
.wimg{width:40px;}
.wimg img{width:40px;}
</style>
<script>
function setadmin(a,i)
{
  if(i)
  {
    _.box.confirm({title:'เพิ่มสิทธิ์ผู้ดูแลระบบ',detail:'ต้องการเพิ่มสิทธิ์ผู้ดูแลระบบ ให้บุคคลนี้หรือไม่?',click:function(){_.ajax.gourl('<?php echo URL?>','setadmin',a,1)}});
  }
  else
  {
    _.box.confirm({title:'ลดสิทธิ์ผู้ดูแลระบบ',detail:'ต้องการปรับบุคคลนี้เป็นบุคคลธรมดา หรือไม่?',click:function(){_.ajax.gourl('<?php echo URL?>','setadmin',a,0)}});
  }
}
function setban(a,i)
{
  _.box.confirm({title:'แบนสมาชิก',detail:'ต้องการแบนสมาชิกนี้หรือไม่? ... (ไม่สามารถย้อนกลับได้)',click:function(){_.ajax.gourl('<?php echo URL?>','setban',a)}});
}
</script>
<ul class="breadcrumb">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/user"><span class="glyphicon glyphicon-eye-open"></span> ผู้ดูแลระบบ</a></li>
</ul>


<table class="table table-hover table-striped" width="100%">
  <thead><tr><th>#</th><th>รูป</th><th>ชื่อ</th><th>ระดับ</th><th>ใช้งานล่าสุด</th><th>สถานะ</th><th></th></tr></thead>
  <tbody>
    <?php foreach($this->admin as $v):?><?php $u=$this->user->get($v['_id'],true);?>
    <?php
    $l=($u['am']??'<span class="label label-warning">สมาชิกทั่วไป</span>');
    if($v['st']<0||$v['st']>1)
    {
      $c=' class="danger"';
      $s='<span class="label label-danger">ยกเลิก: '.$v['st'].'</span>';
      $l='';
    }
    elseif($v['st']==0)
    {
      $c=' class="warning"';
      $s='<span class="label label-warning">รอยืนยัน</span>';
    }
    else
    {
      $c='';
      $s='<span class="label label-success">ปรกติ</span>';
    }
    ?>
    <tr<?php echo $c?>>
      <td class="c w80"><?php echo $u['_id']?></td>
      <td class="c wimg"><a href="<?php echo $u['link']?>" target="_blank"><img src="<?php echo $u['img']?>"></a></td>
      <td><a href="<?php echo $u['link']?>" target="_blank"><?php echo $u['name']?></a><br><?php echo $u['em']?></td>
      <td class="c w50"><?php echo $l?></td>
      <td class="c w130"><span class="ago" datetime="<?php echo self::Time()->sec($v['du'])?>"><?php echo self::Time()->from($v['du'],'ago')?></span><br>ที่ผ่านมา</td>
      <td class="c w50"><?php echo $s?></td>
      <td class="c w150">
      <?php if(self::$my['am']>=7):$am=($v['am']??0);?>
        <?php if($am>6):?>

        <?php elseif($am>=1&&$am<=6):?>
        <a href="javascript:;" onclick="setadmin(<?php echo $v['_id']?>,0)" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-wrench"></span> ปลดสิทธิ์</a>
        <?php elseif($v['st']==0||$v['st']==1):?>
        <a href="javascript:;" onclick="setadmin(<?php echo $v['_id']?>,1)" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-wrench"></span> เพิ่มสิทธิ์</a>
        <a href="javascript:;" onclick="setban(<?php echo $v['_id']?>)" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> แบน</a>
        <?php endif?>
      <?php endif?>
      </td>
    </tr>
    <?php endforeach?>
  </tbody>
</table>
