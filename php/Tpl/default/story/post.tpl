<style>

.mce-panel{border:none;}
.form-control{border:none;border-radius:0px;height:50px; font-size:22px;}
.mce-edit-area label{font-family:'Kanit';font-size:18px;text-indent:10px !important;}

.blog-control{margin:0px 0px 20px;padding:5px;background:#f5f5f5;border-radius:4px;}
.blog-control>div{padding:0px;}
.blog-control .form-control{font-size:18px;height:40px;}

.fixed-toolbar .mce-tinymce{padding-top:36px;}
.fixed-toolbar .mce-toolbar-grp{position:fixed;top:45px;z-index:999;width:700px;}

.form-div{padding:0px 0px 10px;margin:0px 10px;}
.form-div>label{padding:0px 0px 3px;margin:0px 0px -3px;border-bottom:1px dashed #eee;display:block;}
</style>
<div class="story">
<script>window.tinyMCEPreInit = {suffix:'.min',base:'/_cdn/lib/tinymce'};</script>
<script type="text/javascript" src="/_cdn/lib/tinymce/tinymce.min.js"></script>
<script>
_.mce={upload:'/upload/<?php echo $this->post['bl']?>/<?php echo $this->post['_id']?>'};

$(function(){
  tinymce.init({
    selector: "textarea",
    plugins: [
    "advlist autolink lists link print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "table contextmenu paste",
    "upload autoresize placeholder hr"
    ],
    toolbar: "hr | bold italic underline | bullist numlist | alignleft aligncenter alignright | link upload | table",
    content_css:'/_cdn/css/jarm.tinymce.content.css',
    branding: false,
    menubar:false,
    statusbar: false,
    paste_as_text: true,
    paste_remove_spans : true,
    paste_remove_styles : true,
    paste_create_paragraphs : true,
    paste_create_linebreaks : false,
    paste_force_cleanup_wordpaste : true,
    paste_auto_cleanup_on_paste : true,
    paste_convert_middot_lists : false,
    paste_strip_class_attributes : "all",
    paste_convert_headers_to_strong : true,
    paste_text_linebreaktype : "p",
    paste_word_valid_elements: "strong",
    paste_preprocess : function(pl, o) {
            o.content = o.content
                .replace(/<div(.*?)>(.*?)<\/div>/gi,'<p$1>$2</p>')
                .replace(/(.*?)<br\s?\/?>/gi,'<p>$1</p>')
    },
    invalid_styles: 'font-size font-family',
    keep_styles: false,
    extended_valid_elements : "a[href|title|target=_blank|rel=nofollow]",
    invalid_elements : "br,pre,div",
    forced_root_block : 'p',
    force_p_newlines : true,
    force_br_newlines : false,
    convert_newlines_to_brs : false,
    remove_linebreaks : true,
    convert_urls : true,
    relative_urls : false,
    remove_script_host : false,
    autoresize_bottom_margin: 20,
    autoresize_min_height: 100,
    autoresize_overflow_padding: 10,
  });
  //$(window).trigger('resize');

  $(window).scroll(function(){
    if($('.mce-tinymce').length<1)return;
    var scr=$(window).scrollTop(),top=$('.mce-tinymce').offset().top;
    if(scr >= top-45)
    {
      if($('.mce-tinymce').outerHeight()+top<scr+45+36)
      {
        if($('body').hasClass('fixed-toolbar'))
        {
          $('body').removeClass('fixed-toolbar');
        }
      }
      else
      {
        if(!$('body').hasClass('fixed-toolbar'))
        {
          $('body').addClass('fixed-toolbar');
          $('.mce-toolbar-grp').width($('.mce-tinymce').width());
        }
      }
    }
    else if($('body').hasClass('fixed-toolbar'))
    {
      $('body').removeClass('fixed-toolbar');
      $('.mce-toolbar-grp').width($('.mce-tinymce').width());
    }
  });
});
</script>
<div class="pboard clearfix">
  <div class="pull-left">
    <h1><a href="/<?php echo $this->blog['l']?>"><?php echo $this->blog['t']?></a></h1>
    <div><span class="glyphicon glyphicon-list"></span> <?php echo $this->cate[$this->post['c']?:$this->blog['c']]['t']?></div>
  </div>
  <div class="pull-right">
    <a href="/post/<?php echo $this->blog['l']?>" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span> เขียนเรื่องใหม่</a>
    <a href="/blog/<?php echo $this->blog['l']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-th-list"></span> จัดการโพสต์</a>
  </div>
</div>

<div class="post">
<div class="-detail">
  <h2 class="bar-heading">
  <?php if($this->post['pl']):?>
  แก้ไขโพสต์ <small class="pull-right"><button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delpost"><span class="glyphicon glyphicon-trash"></span> ลบโพสต์นี้</button></small>
  <?php else:?>
  เพิ่มเรื่องใหม่
  <?php endif?>
  </h2>

  <?php if($_SERVER['QUERY_STRING']=='completed'):?>
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
   ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (<a href="/<?php echo $this->post['bl'].'/'.$this->post['_id'].'/'.$this->post['l']?>">หน้าแสดงผล </a>)
  </div>
  <?php elseif($this->post['pl']):?>
  <div class="alert alert-info">
    <h4 class="alert-heading">เผยแพร่แล้ว!</h4>
   บทความนี้ทำการเผยแพร่แล้ว. กลับไปยัง <a href="/<?php echo $this->post['bl'].'/'.$this->post['_id'].'/'.$this->post['l']?>">หน้าแสดงผล</a>
  </div>
  <?php endif?>
<form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit">
<fieldset>
<input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($this->post['t'],ENT_QUOTES,'utf-8')?>" placeholder="หัวข้อ">
<textarea class="mceEditor" name="detail" placeholder="บอกเล่าเรื่องราวของคุณ..."><?php echo htmlspecialchars($this->post['d'],ENT_QUOTES,"UTF-8")?></textarea>
<div class="row blog-control">
<div class="col-sm-6"><select name="cate" id="cate" class="form-control">
<?php $c=($this->post['c']?:$this->blog['c']);foreach ($this->cate as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $c==$k?' selected':''?>><?php echo $v['t']?></option>
<?php endforeach ?>
</select></div>
<div class="col-sm-6"><input type="text" class="form-control" name="tags" id="tags" value="<?php echo implode(', ',(array)$this->post['tags'])?>" placeholder="ป้ายกำกับ (คั่นด้วย , และไม่เกิน 5 คำ)"></div>
</div>
<div class="form-div">
  <label class="control-label">การเผยแพร่:</label>
  <div>
    <div class="radio"><label><input type="radio" name="publish" value="1"<?php echo $this->post['pl']==1?' checked':''?>> แสดงผล (แสดงผลรูปภาพและหัวข้อข่าวในหน้ารวมข่าวเหมือนปรกติ)</label></div>
    <div class="radio"><label><input type="radio" name="publish" value="2"<?php echo $this->post['pl']==2?' checked':''?>> แสดงเฉพาะหน้าเนื้อหา (เฉพาะผู้ที่มีลิ้งค์ข่าวนี้เท่านั้นถึงดูเนื้อหาได้)</label></div>
    <div class="radio"><label><input type="radio" name="publish" value="0"<?php echo !$this->post['pl']?' checked':''?>> ไม่แสดง</label></div>
  </div>
</div>
<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/blog/<?php echo $this->blog['l']?>">ยกเลิก, กลับไปหน้าจัดการโพสต์</a>
</div>
</fieldset>
</form>
</div>
</div>
</div>
<div class="modal modal-warning fade" id="delpost" role="dialog" aria-labelledby="myModalLabel" data-backdrop="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ลบโพสต์</h4>
      </div>
      <div class="modal-body">ต้องการลบโพสต์นี้หรือไม่...<br>หากลบแล้ว ไม่สามารถกู้ข้อมูลคืนกลับได้</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ไม่</button>
        <button type="button" class="btn btn-primary" onclick="$(this).prop('disabled',true).html('กรุณารอซักครู่...');_.ajax.gourl('<?php echo URL?>','delpost')">ลบ</button>
      </div>
    </div>
  </div>
</div>
