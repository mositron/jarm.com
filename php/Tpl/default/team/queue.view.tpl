<style>
dd,dt{line-height:2em;}
dd{border-bottom:1px dashed #ccc;}
dd.n{border-bottom:none !important;}
dt.status-wrong,dd.status-wrong,dd.status-wrong a{color:#c00 !important;}
dd.status-wrong{border-color:#c00 !important;}
dt.status-pass,dd.status-pass,dd.status-pass a{color:#428110 !important;}
dd.status-pass{border-color:#428110 !important;}
dd label{margin-bottom:0px;}
</style>
<ul class="breadcrumb">
  <li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/queue" title="">คิวงาน</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/queue/stock" title="">รายชื่องาน</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/queue/<?php echo $this->queue['_id']?>" title=""><?php echo $this->queue['name']?></a></li>
</ul>
<div class="box-white">
  <h3 class="bar-heading" style="margin-bottom:10px;">รายชื่องาน - <?php echo $this->queue['name']?>
    <?php if(team::$my['grade']==99||$this->queue['u']==team::$my['_id']):?>
    <small class="pull-right">
      <a href="/queue/update/<?php echo $this->queue['_id']?>" class="btn btn-default btn-xs" data-tooltip="tooltip" title="แก้ไข"><i class="fa fa-pencil"></i></a>
      <?php if(in_array(team::$my['_id'], (array)$this->perm['permAppointment'])&&$this->queue['process']=='list_stock'):?>
      <a href="/queue/calendar/<?php echo $this->queue['_id']?>" class="btn btn-default btn-xs"><i class="fa fa-calendar"></i></a>
      <?php endif?>
      <button type="button" class="btn btn-default btn-xs" data-tooltip="tooltip" title="ลบ" data-id="<?php echo $this->queue['_id']?>" data-toggle="modal" data-target="#myModalDelete"><i class="fa fa-trash-o"></i></button>
    </small>
    <?php endif?>
  </h3>

  <div class="row">
    <?php if(in_array($this->queue['process'],['list_queue','list_process','list_complete'])):?>
    <div class="col-md-5">
      <dl class="dl-horizontal">
        <dt><i class="fa fa-map-marker"></i> สถานที่ที่ทำงาน:</dt> <dd><?php echo $this->queue['location']?$this->queue['location']:'-'?></dd>
        <?php if($this->queue['province']):?>
        <dt>จังหวัด:</dt><dd><?php echo $this->province[$this->queue['province']]['name_th']?></dd>
        <?php endif?>
      </dl>
    </div>
    <div class="col-md-7">
      <dl class="dl-horizontal">
          <dt><i class="fa fa-clock-o"></i> เริ่ม:</dt> <dd><?php echo self::Time()->from($this->queue['ds1'],'datetime')?></dd>
          <?php if($this->queue['ds2']):?>
          <dt>ถึง:</dt> <dd><?php echo self::Time()->from($this->queue['ds2'],'datetime')?></dd>
          <?php endif?>
      </dl>
    </div>
    <?php if(in_array($this->queue['process'],['list_queue'])):?>
    <div class="col-md-12">
      <dl class="dl-horizontal">
          <dt>ดำเนินการแล้วหรือยัง:</dt> <dd><label id="rewrite">ไม่ <input type="checkbox" class="js-switch" data-name="<?php echo $this->queue['name']?>" data-toggle="modal" data-target="#myModalStatus" data-backdrop="false"<?php echo ((!$this->queue['pt']['p'])&&(!$this->queue['pd']['p'])&&(!$this->queue['gp']['p'])&&(!$this->queue['ct']['p'])||!in_array(team::$my['_id'], $this->perm['permAppointment']))?' disabled':''?> /> ใช่</label></dd>
      </dl>
    </div>
<script>
$(function(){
  var elem = document.querySelector('.js-switch');
  var switchery = new Switchery(elem, { size: 'small' });
  elem.addEventListener('click', function() {
    if(elem.checked)
    {
      $('#myModalStatus').on('show.bs.modal', function (event) {
        var modal = $(this)
        modal.find('.modal-title').html('<i class="icon fa fa-ban"></i> คุณต้องการเปลี่ยนสถานะหัวข้อ <?php echo $this->queue['name']?> เป็นดำเนินการแล้ว')
        modal.find('.modal-body').html('หากเปลี่ยนแล้วไม่สามารถกลับมาแก้ไขได้อีก')
      });
    }
  });
  $('.btn-yes').click(function() {
    _.ajax.gourl('<?php echo URL?>','setstatus',<?php echo $this->queue['_id']?>,'process');
  });
  $('.btn-no').click(function() {
    $('#rewrite').html('ไม่ <input type="checkbox" class="js-switch" data-name="<?php echo $this->queue['name']?>" data-toggle="modal" data-target="#myModalStatus" /> ใช่');
    var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem, { size: 'small' });
  });
});
</script>
    <?php endif?>
    <?php endif?>
    <?php if(in_array($this->queue['process'],['list_process'])):?>
    <?php if($this->queue['team']):?>
    <div class="col-md-5">
      <dl class="dl-horizontal">
        <dt style="margin-bottom:20px">ทีมที่ดำเนินการแล้ว:</dt><dd></dd>
        <dt>Team Photo:</dt> <dd><label id="rewrite-photo">ไม่ <input type="checkbox" class="js-switch" data-label="photo" data-toggle="modal" data-target="#myModal" data-backdrop="false"<?php echo $this->queue['pt']['u']?' checked':''?><?php echo (!in_array(team::$my['_id'], $this->perm['permPhotoID']) || $this->queue['pt']['u']!='')?' disabled':''?> /> ใช่</label></dd>
        <?php if($this->queue['pt']['u']):?><?php $u=team::user()->get($this->queue['pt']['u'],true)?>
        <dt>Team Photo ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <?php if($this->queue['team']==4):?>
        <dt>Team VDO Editor:</dt> <dd><label id="rewrite-production">ไม่ <input type="checkbox" class="js-switch" data-label="production" data-toggle="modal" data-target="#myModal" data-backdrop="false"<?php echo $this->queue['pd']['u']?' checked':''?><?php echo (!in_array(team::$my['_id'], $this->perm['permVDOID']) || $this->queue['pd']['u']!='')?' disabled':''?> /> ใช่</label></dd>
        <?php if($this->queue['pd']['u']):?><?php $u=team::user()->get($this->queue['pd']['u'],true)?>
        <dt>Team VDO Editor ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <?php endif?>
        <dt>Team Graphic:</dt> <dd><label id="rewrite-graphic">ไม่ <input type="checkbox" class="js-switch" data-label="graphic" data-toggle="modal" data-target="#myModal" data-backdrop="false"<?php echo $this->queue['gp']['u']?' checked':''?><?php echo (!in_array(team::$my['_id'], $this->perm['permGraphicID']) || $this->queue['gp']['u']!='')?' disabled':''?> /> ใช่</label></dd>
        <?php if($this->queue['gp']['u']):?><?php $u=team::user()->get($this->queue['gp']['u'],true)?>
        <dt>Team Graphic ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <dt>Team Content:</dt> <dd><label id="rewrite-content">ไม่ <input type="checkbox" class="js-switch" data-switchery="true" data-label="content" data-toggle="modal" data-target="#myModal" data-backdrop="false"<?php echo $this->queue['ct']['u']?' checked':''?><?php echo (!in_array(team::$my['_id'], $this->perm['permContentID']) || $this->queue['ct']['u']!='')?' disabled':''?> /> ใช่</dd>
        <?php if($this->queue['ct']['u']):?><?php $u=team::user()->get($this->queue['ct']['u'],true)?>
        <dt>Team Content ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
      </dl>
    </div>
    <div class="col-md-7">
      <dl class="dl-horizontal">
          <dt style="margin-bottom:20px">&nbsp;</dt><dd class="n">&nbsp;</dd>
          <dt style="height:28px">&nbsp;</dt><dd class="n">&nbsp;</dd>
          <?php if($this->queue['pt']['u']):?>
          <dt>Team Photo ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['pt']['d'],'datetime')?></dd>
          <?php endif?>
          <?php if($this->queue['team']=='4'):?>
          <dt style="height:28px">&nbsp;</dt><dd class="n">&nbsp;</dd>
          <?php if($this->queue['pd']['u']):?>
          <dt>Team VDO Editor ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['pd']['d'],'datetime')?></dd>
          <?php endif?>
          <?php endif?>
          <dt style="height:28px">&nbsp;</dt><dd class="n">&nbsp;</dd>
          <?php if($this->queue['gp']['u']):?>
          <dt>Team Graphic ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['gp']['d'],'datetime')?></dd>
          <?php endif?>
          <dt style="height:28px">&nbsp;</dt><dd class="n">&nbsp;</dd>
          <?php if($this->queue['ct']['u']):?>
          <dt>Team Content ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['ct']['d'],'datetime')?></dd>
          <?php endif?>
      </dl>
    </div>
  <?php else:?>
    <div class="col-md-5">
      <dl class="dl-horizontal">
          <dt style="margin-bottom:20px">ทีมที่ดำเนินการแล้ว:</dt><dd></dd>
          <?php if($this->queue['pt']['p']):?>
            <dt>Team Photo:</dt> <dd><label id="rewrite-photo">ไม่ <input type="checkbox" class="js-switch" data-label="photo" data-toggle="modal" data-target="#myModal" data-backdrop="false"<?php echo $this->queue['pt']['u']?' checked':''?><?php echo (!in_array(team::$my['_id'], $this->perm['permPhotoID']) || $this->queue['pt']['u']!='')?' disabled':''?> /> ใช่</label></dd>
            <?php if($this->queue['pt']['u']):?><?php $u=team::user()->get($this->queue['pt']['u'],true)?>
            <dt>Team Photo ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
            <?php endif?>
          <?php endif?>
          <?php if($this->queue['pd']['p']):?>
            <dt>Team VDO Editor:</dt> <dd><label id="rewrite-production">ไม่ <input type="checkbox" class="js-switch" data-label="production" data-toggle="modal" data-target="#myModal" data-backdrop="false"<?php echo $this->queue['pd']['u']?' checked':''?><?php echo (!in_array(team::$my['_id'], $this->perm['permVDOID']) || $this->queue['pd']['u']!='')?' disabled':''?> /> ใช่</label></dd>
            <?php if($this->queue['pd']['u']):?><?php $u=team::user()->get($this->queue['pd']['u'],true)?>
            <dt>Team VDO Editor ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
            <?php endif?>
          <?php endif?>
          <?php if($this->queue['gp']['p']):?>
            <dt>Team Graphic:</dt> <dd><label id="rewrite-graphic">ไม่ <input type="checkbox" class="js-switch" data-label="graphic" data-toggle="modal" data-target="#myModal" data-backdrop="false"<?php echo $this->queue['gp']['u']?' checked':''?><?php echo (!in_array(team::$my['_id'], $this->perm['permGraphicID']) || $this->queue['gp']['u']!='')?' disabled':''?> /> ใช่</label></dd>
            <?php if($this->queue['gp']['u']):?><?php $u=team::user()->get($this->queue['gp']['u'],true)?>
            <dt>Team Graphic ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
            <?php endif?>
          <?php endif?>
          <?php if($this->queue['ct']['p']):?>
            <dt>Team Content:</dt> <dd><label id="rewrite-content">ไม่ <input type="checkbox" class="js-switch" data-switchery="true" data-label="content" data-toggle="modal" data-target="#myModal" data-backdrop="false"<?php echo $this->queue['ct']['u']?' checked':''?><?php echo (!in_array(team::$my['_id'], $this->perm['permContentID']) || $this->queue['ct']['u']!='')?' disabled':''?> /> ใช่</dd>
            <?php if($this->queue['ct']['u']):?><?php $u=team::user()->get($this->queue['ct']['u'],true)?>
            <dt>Team Content ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
            <?php endif?>
          <?php endif?>
      </dl>
    </div>
    <div class="col-md-7">
      <dl class="dl-horizontal">
          <dt style="margin-bottom:20px">&nbsp;</dt><dd class="n">&nbsp;</dd>
          <?php if($this->queue['pt']['p']):?>
            <dt style="height:28px">&nbsp;</dt><dd class="n">&nbsp;</dd>
            <?php if($this->queue['pt']['u']):?>
            <dt>Team Photo ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['pt']['d'],'datetime')?></dd>
            <?php endif?>
          <?php endif?>
          <?php if($this->queue['pd']['p']):?>
            <dt style="height:28px">&nbsp;</dt><dd class="n">&nbsp;</dd>
            <?php if($this->queue['pd']['u']):?>
            <dt>Team VDO Editor ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['pd']['d'],'datetime')?></dd>
            <?php endif?>
          <?php endif?>
          <?php if($this->queue['gp']['p']):?>
            <dt style="height:28px">&nbsp;</dt><dd class="n">&nbsp;</dd>
            <?php if($this->queue['gp']['u']):?>
            <dt>Team Graphic ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['gp']['d'],'datetime')?></dd>
            <?php endif?>
          <?php endif?>
          <?php if($this->queue['ct']['p']):?>
            <dt style="height:28px">&nbsp;</dt><dd class="n">&nbsp;</dd>
            <?php if($this->queue['ct']['u']):?>
            <dt>Team Content ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['ct']['d'],'datetime')?></dd>
            <?php endif?>
          <?php endif?>
      </dl>
    </div>
  <?php endif?>

  <div class="modal inmodal modal-danger fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content animated flipInY">
        <div class="modal-header">
          <button type="button" class="close btn-no" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="icon fa fa-ban"></i> แจ้งเตือน</h4>
        </div>
        <div class="modal-body">text</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left js-switch btn-no" data-dismiss="modal">ไม่ใช่</button>
          <form method="post">
            <button type="button" class="btn btn-outline btn-yes">ใช่</button>
          </form>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
  <script>
  $(function(){
    $('.js-switch').each(function(){
      var $this = $(this);
      var label = $this.data('label');
      new Switchery(this, { size: 'small' });
      $this.click(function(){
        if($(this).get(0).checked)
        {
          $('#myModal').on('show.bs.modal', function (event) {
            var modal = $(this)
            modal.find('.modal-title').html('<i class="icon fa fa-ban"></i> คุณต้องการเปลี่ยนสถานะหัวข้อ <?php echo $this->queue['name']?> เป็นดำเนินการเสร็จแล้ว')
            var tmp='';
            if(label=='production'||label=='content')
            {
              tmp+='<div class="form-group"><input type="text" name="production_link" id="production_link" class="form-control" placeholder="บังคับใส่ลิงค์งานทุกครั้ง" required></div>';
            }
            modal.find('.modal-body').html('หากเปลี่ยนแล้วไม่สามารถกลับมาแก้ไขได้อีก'+tmp);
            modal.find('.btn-yes, .btn-no').data('label',label);
          });
        }
      });
    });
    $('.btn-yes').click(function(){
      if($(this).data('label')=='production'||$(this).data('label')=='content')
      {
        if($.trim($('#production_link').val())=='')
        {
          $('#production_link').focus();
          return;
        }
        _.ajax.gourl('<?php echo URL?>','setprocess',$(this).data('label'),$.trim($('#production_link').val()));
      }
      else
      {
        _.ajax.gourl('<?php echo URL?>','setprocess',$(this).data('label'));
      }
    });
    $('.btn-no').click(function() {
      $('#rewrite-'+$(this).data('label')).html('ไม่ <input type="checkbox" class="js-switch" data-name="<?php echo $this->queue['name']?>" data-toggle="modal" data-target="#myModal" data-backdrop="false" /> ใช่');
      new Switchery($('#rewrite-'+$(this).data('label')+' input').get(0), { size: 'small' });
    });
  });
  </script>
<?php endif?>

  <?php if(in_array($this->queue['process'],['list_complete'])):?>
    <?php if($this->queue['team']):?>
    <div class="col-md-5">
      <dl class="dl-horizontal">
          <?php $u=team::user()->get($this->queue['pt']['u'],true)?>
          <dt>Team Photo ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
          <?php if($this->queue['team']==4):?>
          <?php $u=team::user()->get($this->queue['pd']['u'],true)?>
          <dt>Team VDO Editor ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
          <?php endif?>
          <?php $u=team::user()->get($this->queue['gp']['u'],true)?>
          <dt>Team Graphic ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
          <?php $u=team::user()->get($this->queue['ct']['u'],true)?>
          <dt>Team Content ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
      </dl>
    </div>
    <div class="col-md-7">
      <dl class="dl-horizontal">
          <dt>Team Photo ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['pt']['d'],'datetime')?></dd>
          <?php if($this->queue['team']==4):?>
          <dt>Team VDO Editor ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['pd']['d'],'datetime')?></dd>
          <?php endif?>
          <dt>Team Graphic ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['gp']['d'],'datetime')?></dd>
          <dt>Team Content ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['ct']['d'],'datetime')?></dd>
      </dl>
    </div>
    <?php else:?>
    <div class="col-md-5">
      <dl class="dl-horizontal">
          <?php if($this->queue['pt']['p']):?><?php $u=team::user()->get($this->queue['pt']['u'],true)?>
          <dt>Team Photo ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
          <?php endif?>
          <?php if($this->queue['pd']['p']):?><?php $u=team::user()->get($this->queue['pd']['u'],true)?>
          <dt>Team VDO Editor ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
          <?php endif?>
          <?php if($this->queue['gp']['p']):?><?php $u=team::user()->get($this->queue['gp']['u'],true)?>
          <dt>Team Graphic ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
          <?php endif?>
          <?php if($this->queue['ct']['p']):?><?php $u=team::user()->get($this->queue['ct']['u'],true)?>
          <dt>Team Content ยืนยันโดย:</dt> <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
          <?php endif?>
      </dl>
    </div>
    <div class="col-md-7">
      <dl class="dl-horizontal">
          <?php if($this->queue['pt']['p']):?>
          <dt>Team Photo ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['pt']['d'],'datetime')?></dd>
          <?php endif?>
          <?php if($this->queue['pd']['p']):?>
          <dt>Team VDO Editor ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['pd']['d'],'datetime')?></dd>
          <?php endif?>
          <?php if($this->queue['gp']['p']):?>
          <dt>Team Graphic ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['gp']['d'],'datetime')?></dd>
          <?php endif?>
          <?php if($this->queue['ct']['p']):?>
          <dt>Team Content ยืนยันเมื่อ:</dt> <dd><?php echo self::Time()->from($this->queue['ct']['d'],'datetime')?></dd>
          <?php endif?>
      </dl>
    </div>
    <?php endif?>
  <?php endif?>

  <?php if(in_array($this->queue['process'],['list_process','list_complete'])):?>
    <div class="col-md-12">
      <dl class="dl-horizontal">
        <?php if($this->queue['pd']['l']):?>
        <dt><i class="fa fa-youtube-play"></i></dt> <dd><a href="<?php echo $this->queue['pd']['l']?>" target="_blank"><?php echo $this->queue['pd']['l']?></a></dd>
        <?php endif?>
        <?php if($this->queue['ct']['l']):?>
        <dt><i class="fa fa-file-text-o"></i></dt> <dd><a href="<?php echo $this->queue['ct']['l']?>" target="_blank"><?php echo $this->queue['ct']['l']?></a></dd>
        <?php endif?>
      </dl>
    </div>
  <?php endif?>
  </div>
  <h4 class="bar-heading">รายละเอียดงาน</h4>
  <div class="row">
    <div class="col-md-5">
      <dl class="dl-horizontal">
        <dt>สร้างรายชื่องานโดย:</dt><?php $u=team::user()->get($this->queue['u'],true)?>
        <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
        <?php if($this->queue['de']&&(self::Time()->sec($this->queue['de'])!=self::Time()->sec($this->queue['da']))):?>
        <dt>แก้ไขรายชื่องานล่าสุดโดย:</dt><?php $u=team::user()->get($this->queue['ue'],true)?>
        <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <dt>นัดคิวงานโดย:</dt><?php $u=team::user()->get($this->queue['upq'],true)?>
        <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
        <?php if($this->queue['deq']&&(self::Time()->sec($this->queue['deq'])!=self::Time()->sec($this->queue['dpq']))):?>
        <dt>แก้ไขนัดคิวงานล่าสุดโดย:</dt><?php $u=team::user()->get($this->queue['ueq'],true)?>
        <dd><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['name']?>"><?php echo $u['nickname']?></a></dd>
        <?php endif?>
        <dt>เบอร์ติดต่อ:</dt>
        <dd><?php echo $this->queue['phone']?$this->queue['phone']:'-'?></dd>
        <dt>ประเภท:</dt>
        <dd><?php echo $this->type[$this->queue['type']]['display']?></dd>
      </dl>
    </div>
    <div class="col-md-7">
      <dl class="dl-horizontal">
        <dt>สร้างรายชื่องานเมื่อ:</dt>
        <dd><?php echo self::Time()->from($this->queue['da'],'datetime')?></dd>
        <?php if($this->queue['de']&&(self::Time()->sec($this->queue['de'])!=self::Time()->sec($this->queue['da']))):?>
        <dt>แก้ไขรายชื่องานล่าสุดเมื่อ:</dt>
        <dd><?php echo self::Time()->from($this->queue['de'],'datetime')?></dd>
        <?php endif?>
        <dt>นัดคิวงานเมื่อ:</dt>
        <dd><?php echo self::Time()->from($this->queue['dpq'],'datetime')?></dd>
        <?php if($this->queue['deq']&&(self::Time()->sec($this->queue['deq'])!=self::Time()->sec($this->queue['dpq']))):?>
        <dt>แก้ไขนัดคิวงานล่าสุดเมื่อ:</dt>
        <dd><?php echo self::Time()->from($this->queue['deq'],'datetime')?></dd>
        <?php endif?>
        <?php if(is_array($this->queue['ref'])):?>
        <dt>เจ้าหน้าที่ที่เกี่ยวข้อง:</dt>
        <dd>
          <?php foreach ($this->queue['ref'] as $v): if(!$v)continue;?>
            <?php $u=team::user()->get($v,true)?>
            <a href="/user/<?php echo $u['_id']?>"><img class="show-tooltip-s img-circle" title="<?php echo $u['pos']?><br /><?php echo $u['name']?> (<?php echo $u['nickname']?>)" class="img-circle" src="https://f1.jarm.com/team/user/<?php echo $u['_id']?>-s.jpg" style="width:32px;height:32px;"></a>
          <?php endforeach?>
        </dd>
        <?php endif?>
      </dl>
    </div>
  </div>
  <?php if(is_array($this->withdraw)):?>
  <div class="row">
    <div class="col-md-12">
      <h4 class="bar-heading">ใบเบิกของงานนี้ทั้งหมด</h4>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>เลขที่</th>
            <th>วันที่สร้าง</th>
            <th class="text-center">สร้างโดย</th>
            <th class="text-center">สถานะ</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($this->withdraw as $v):?>
          <tr>
            <td><a href="/withdraw/<?php echo $v['_id']?>"><?php echo $v['no']?$v['no']:'-'?></a></td>
            <td><a href="/withdraw/<?php echo $v['_id']?>"><?php echo self::Time()->from($v['da'],'datetime')?></a></td>
            <?php $u=team::user()->get($v['u'],true)?>
            <td class="text-center"><a href="/user/<?php echo $u['_id']?>" class="show-tooltip-s" title="<?php echo $u['pos']?><br /><?php echo $u['name']?>"><?php echo $u['nickname']?></a></td>
            <td class="text-center"><a href="/withdraw/<?php echo $v['_id']?>"><?php echo $this->status_name[$v['status']]?></a></td>
          </tr>
          <?php endforeach?>
        </tbody>
      </table>
    </div>
  </div>
  <?php endif?>
  <?php if($this->queue['thumbnail']!='default'):?>
  <div class="mailbox-read-info">
    <ul class="mailbox-attachments clearfix">
      <li>
        <span class="mailbox-attachment-icon has-img"><img src="https://f1.jarm.com/team/queue/<?php echo $this->queue['thumbnail']?>.jpg" /></span>
        <!--div class="mailbox-attachment-info">
          <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> <?php echo $this->queue['thumbnail']?>.jpg</a>
        </div-->
      </li>
    </ul>
  </div><!-- /.box-footer -->
  <?php endif?>


  <div class="mailbox-read-message">
    <?php if($this->queue['pt']['p']||$this->queue['pd']['p']||$this->queue['gp']['p']||$this->queue['ct']['p']) :?>
    <blockquote>
      <p>ทีมที่ต้องดำเนินงานต่อจากเสร็จคิวงาน</p>
      <?php if($this->queue['pt']['p']):?><small><i class="fa fa-camera"></i> Photo</small><?php endif?>
      <?php if($this->queue['pd']['p']):?><small><i class="fa fa-film"></i> VDO Editor</small><?php endif?>
      <?php if($this->queue['gp']['p']):?><small><i class="fa fa-photo"></i> Graphic</small><?php endif?>
      <?php if($this->queue['ct']['p']):?><small><i class="fa fa-newspaper-o"></i> Content</small><?php endif?>
    </blockquote>
    <?php endif?>

    <?php if ($this->queue['detail']) :?>
    <blockquote>
      <p>รายละเอียดรายชื่องาน</p>
      <small><?php echo $this->queue['detail']?></small>
    </blockquote>
    <?php endif?>
    <?php if ($this->queue['note']) :?>
    <blockquote>
      <p>หมายเหตุรายชื่องาน</p>
      <small><?php echo $this->queue['note']?></small>
    </blockquote>
    <?php endif?>

    <?php if ($this->queue['note_queue']) :?>
    <blockquote>
      <p>หมายเหตุคิวงาน</p>
      <small><?php echo $this->queue['note_queue']?></small>
    </blockquote>
    <?php endif?>
  </div>

  <?php if ($this->logs): ?>
  <h1 class="bar-heading">Logs</h1>
  <!-- The time line -->
  <ul class="timeline">
    <?php $date_old = ''?>
    <?php foreach ($this->logs as $k => $v): ?>
      <?php $date_now = self::Time()->from($v['da'],'date')?>
      <?php if ($date_old != $date_now): ?>
        <li class="time-label">
          <span class="bg-blue">
            <?php echo $date_now?>
          </span>
        </li>
        <?php $date_old = $date_now?>
      <?php endif?>
      <?php if ($v['type'] == 1): ?>
        <li>
          <i class="fa fa-plus bg-green"></i>
          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("G:i",self::Time()->sec($v['da']))?> น.</span>
            <?php if($v['ue'])$u=team::user()->get($v['u'],true);?>
            <h3 class="timeline-header no-border"><?php if($v['ue']):?><a href="/user/<?php echo $u['_id']?>"><?php echo $u['name']?></a><?php endif?> <?php echo $v['detail']?></h3>
          </div>
        </li>
      <?php elseif ($v['type'] == 2): ?>
        <li>
          <i class="fa fa-pencil bg-yellow"></i>
          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("G:i",self::Time()->sec($v['da']))?> น.</span>
            <?php if($v['ue'])$u=team::user()->get($v['ue'],true);?>
            <h3 class="timeline-header"><?php if($v['ue']):?><a href="/user/<?php echo $u['_id']?>"><?php echo $u['name']?></a><?php endif?> แก้ไข</h3>
            <div class="timeline-body"><?php echo $v['detail']?></div>
          </div>
        </li>
      <?php elseif ($v['type'] == 3): ?>
        <li>
          <i class="fa fa-trash-o bg-red"></i>
          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("G:i",self::Time()->sec($v['da']))?> น.</span>
            <?php if($v['ue'])$u=team::user()->get($v['ud'],true);?>
            <h3 class="timeline-header no-border"><?php if($v['ue']):?><a href="/user/<?php echo $u['_id']?>"><?php echo $u['name']?></a><?php endif?> <?php echo $v['detail']?></h3>
          </div>
        </li>
      <?php elseif ($v['type'] == 5): ?>
        <li>
          <i class="glyphicon glyphicon-floppy-saved bg-green"></i>
          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> <?php echo date("G:i",self::Time()->sec($v['da']))?> น.</span>
            <?php if($v['ue'])$u=team::user()->get($v['ue'],true);?>
            <h3 class="timeline-header no-border"><?php if($v['ue']):?><a href="/user/<?php echo $u['_id']?>"><?php echo $u['name']?></a><?php endif?> บันทึก</h3>
          </div>
        </li>
      <?php endif?>
    <?php endforeach?>
    <!-- END timeline item -->
    <li><i class="fa fa-clock-o bg-gray"></i></li>
  </ul>
  <?php endif?>
</div>




<div class="modal inmodal modal-danger fade" id="myModalStatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content animated flipInY">
      <div class="modal-header">
        <button type="button" class="close btn-no" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="icon fa fa-ban"></i> แจ้งเตือน</h4>
      </div>
      <div class="modal-body">text</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left js-switch btn-no" data-dismiss="modal">ไม่ใช่</button>
        <form method="post">
          <button type="button" class="btn btn-outline btn-yes">ใช่</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
