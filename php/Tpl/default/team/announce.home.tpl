<style>
.w150{width:180px;}
.w50{width:50px;}
</style>
<script>
function delc(i){_.box.confirm({title:'ลบบทความนี้',detail:'ต้องการลงบทความนี้หรือไม่',click:function(){_.ajax.gourl('<?php echo URL?>','delcontent',i);}})}
</script>
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/announce" title=""><?php echo $this->content_type[$this->type]['n']?></a></li>
<?php if (team::$my['grade']==99):?>
  <span></span>
  <li class="pull-right" style="margin:-3px -2px 1px;"><a href="javascript:;" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> เพิ่มประกาศใหม่</a></li>
<?php endif?>
</ul>
<div class="box-white">
  <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">เพิ่มประกาศใหม่</h4>
        </div>
        <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','newcontent',this);$('.modal').modal('hide');return false;">
          <div class="modal-body">
            <div class="form-group">
              <label for="title" class="col-sm-2 control-label">หัวข้อ</label>
              <div class="col-sm-10">
                <input type="text" name="title" class="form-control" id="title" placeholder="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="submit" class="btn btn-primary">เพิ่ม</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="nav-tabs-custom">
    <div class="tab-content">
      <div class="text-left">
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="w50">ID</th>
              <th>หัวข้อ</th>
              <th class="w150">แก้ไขล่าสุด</th>
              <?php if (team::$my['grade']==99):?>
              <th class="w50">&nbsp;</th>
              <?php endif?>
            </tr>
          </thead>
          <tbody>
            <?php for($i=0;$i<count($this->content);$i++):$v=$this->content[$i]; ?>
            <tr>
              <td><a href="/announce/<?php echo $v['_id']?>"><?php echo $v['_id']?></a></td>
              <td><a href="/announce/<?php echo $v['_id']?>"><?php echo $v['title']?></a></td>
		          <td class="w150"><a href="/announce/<?php echo $v['_id']?>"><?php echo self::Time()->from($v['de']?$v['de']:$v['da'],'datetime')?></a></td>
              <?php if (team::$my['grade']==99):?>
              <td class="w50">
                <div class="btn-group" style="width:50px;text-align:right">
                  <a href="/announce/update/<?php echo $v['_id']?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
                  <a href="javascript:;" onclick="delc(<?php echo $v['_id']?>);" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
                </div>
              </td>
              <?php endif?>
            </tr>
          <?php endfor?>
          </tbody>
          <tfoot>
						<tr>
              <th class="w50">ID</th>
              <th>หัวข้อ</th>
              <th class="w150">แก้ไขล่าสุด</th>
              <?php if (team::$my['grade']==99):?>
              <th class="w50">&nbsp;</th>
              <?php endif?>
            </tr>
          </tfoot>
        </table>
      </div>
    </div><!-- /.tab-content -->
  </div><!-- nav-tabs-custom -->
</div>
