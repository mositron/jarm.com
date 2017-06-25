<style>
.story{margin:20px auto;max-width:700px;}
.story .bcard{background:#fcfcfc;padding:10px;border-radius:4px;border:1px solid #eee;margin-bottom:10px;}
.story .bcard div>div{font-size:12px;}
.story .bcard .pull-right{padding-left:20px;border-left:1px solid #eee;margin-top:16px;}
.story .bcard .pull-right img{width:40px;margin:0px 0px -1px 8px;float:right;border-radius:3px;}
.story .bcard .glyphicon2{color:#999;font-size:7px;border:1px solid #ddd;padding:2px;border-radius:2px;vertical-align:middle;margin-top:-4px;}

.story .bar-heading{margin:0px 0px 10px;}

.mce-panel{border:none;}
.form-control{border:none;border-radius:0px;height:50px; font-size:22px;}
.mce-edit-area label{font-family:'Kanit';font-size:18px;text-indent:10px !important;}

.blog-control{margin:0px 0px 20px;padding:5px;background:#f5f5f5;border-radius:4px;}
.blog-control>div{padding:0px;}
.blog-control .form-control{font-size:18px;height:40px;}

.fixed-toolbar .mce-tinymce{padding-top:36px;}
.fixed-toolbar .mce-toolbar-grp{position:fixed;top:45px;z-index:999;width:700px;}
</style>
<div class="story">
<script>window.tinyMCEPreInit = {suffix:'.min',base:'/_cdn/lib/tinymce'};</script>
<script type="text/javascript" src="/_cdn/lib/tinymce/tinymce.min.js"></script>
<script>
var pid='<?php echo $this->post['_id']?>',last='',tmrsave;

function checksave()
{
  if($('#save').data("status")=="saved")
  {
    $('#save').html('');
  }
}
function autosave(ty)
{
  var txt=$('#title').val();
  if(txt)
  {
    _.ajax.gourl('<?php echo URL?>','savepost',{'title':$('#title').val(),'detail':tinyMCE.activeEditor.getContent(),'cate':$('#cate').val(),'tags':$('#tags').val()});
    $('#save').data("status","saving").html('กำลังบันทึก...');
  }
}
function savepost()
{
  if(!$.trim($('#title').val()))
  {
    $('#title').focus();
    return;
  }
  _.ajax.gourl('<?php echo URL?>','savepost',{'published':1,'title':$('#title').val(),'detail':tinyMCE.activeEditor.getContent(),'cate':$('#cate').val(),'tags':$('#tags').val()});
  $('#save').data("status","saving").html('กำลังบันทึก...');
}

$(window).scroll(function(){
  if($(window).scrollTop() >= $('.mce-tinymce').offset().top-45)
  {
    $('body').addClass('fixed-toolbar');
  }
  else
  {
    $('body').removeClass('fixed-toolbar');
  }
});
$(window).resize(function(){
  $('.mce-toolbar-grp').width($('.mce-tinymce').width());
});
$(function(){
  tmrsave=setInterval(function(){
    autosave();
    checksave();
  },10000);
  tinymce.init({
    selector: "textarea",
    plugins: [
    "advlist autolink lists link print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "table contextmenu paste",
    "autoresize placeholder hr"
    ],
    toolbar: "hr | bold italic underline | bullist numlist | alignleft aligncenter alignright | link imageupload | table",
    setup: function(editor) {
      initImageUpload(editor);
    },
    content_css:'/_cdn/css/jarm.tinymce.content.css',
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
    extended_valid_elements : "a[href|title|target=_blank|rel=nofollow],img[src|data-width|data-height]",
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
  $(window).trigger('resize');
});

function initImageUpload(editor){
  var inp = $('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">');
  $(editor.getElement()).parent().append(inp);
  editor.addButton('imageupload', {
    text: '',
    icon: 'image',
    onclick: function(e){inp.trigger('click');}
  });
  inp.on("change", function(e){
    uploadFile($(this), editor);
  });
}

function uploadFile(inp, editor) {
  console.log('uploadFile:',inp,editor);
  var input = inp.get(0);
  var data = new FormData();
  data.append('image', input.files[0]);
  $('#save').data("status","saving").html('กำลังอัพโหลดรูปภาพ...');
  $.ajax({
    url: '/upload/<?php echo $this->blog['l']?>/<?php echo $this->post['_id']?>',
    type: 'POST',
    data: data,
    processData: false, // Don't process the files
    contentType: false, // Set content type to false as jQuery will tell the server its a query string request
    success: function(rd, textStatus, jqXHR) {
      console.log(rd);
      var rs=JSON.parse(rd);
      console.log(rs.status);
      if(rs.status=='OK')
      {
        console.log('---------- '+rs.data.url+' ---=');
        editor.insertContent('<p style="text-align:center"><img src="'+rs.data.url+'" data-width="'+rs.data.w+'" data-height="'+rs.data.h+'" /></p><p>&nbsp;</p>');
        editor.execCommand('mceAutoResize');
      }
      $('#save').data("status","saved").html('');
    },
    error: function(jqXHR, textStatus, errorThrown) {
      if(jqXHR.responseText) {
        errors = JSON.parse(jqXHR.responseText).errors
        console.log('Error uploading image: ' + errors.join(", ") + '. Make sure the file is an image and has extension jpg/jpeg/png.');
      }
      $('#save').data("status","saved").html('');
    }
  });
}
</script>
<div class="bcard clearfix">
  <div class="pull-left">
    <a href="/<?php echo $this->blog['l']?>"><?php echo $this->blog['t']?></a>
    <div><span class="glyphicon glyphicon-list"></span> <?php echo $this->cate[$this->post['c']?:$this->blog['c']]['t']?></div>
  </div>
  <div class="pull-right">
    <a href="/post/<?php echo $this->blog['l']?>" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-plus"></span> เขียนเรื่องใหม่</a>
    <a href="/blog" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-list-alt"></span> จัดการบล็อก</a>
    <a href="/blog/<?php echo $this->blog['l']?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-th-list"></span> จัดการโพสต์</a>
    <a href="/blog/<?php echo $this->blog['l']?>/edit" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-pencil"></span> แก้ไขบล็อก</a>
  </div>
</div>


<h2 class="bar-heading">
<?php if($this->post['pl']):?>
แก้ไขโพสต์ <small class="pull-right"><button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delpost"><span class="glyphicon glyphicon-trash"></span> ลบโพสต์นี้</button></small>
<?php else:?>
เพิ่มเรื่องใหม่
<?php endif?>
</h2>
<form method="post" action="<?php echo URL?>" onsubmit="savepost();return false;" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
<fieldset>
<input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($this->post['t'],ENT_QUOTES,'utf-8')?>" placeholder="หัวข้อ">
<textarea class="mceEditor" name="detail" placeholder="บอกเล่าเรื่องราวของคุณ..."><?php echo htmlspecialchars($this->post['d'],ENT_QUOTES,"UTF-8")?></textarea>
<div class="row blog-control">
<div class="col-sm-6"><select name="cate" id="cate" class="form-control">
<?php $c=($this->post['c']?:$this->blog['c']);foreach ($this->cate as $k=>$v):?>
<option value="<?php echo $k?>"<?php echo $c==$k?' selected':''?>><?php echo $v['t']?></option>
<?php endforeach ?>
</select></div>
<div class="col-sm-6"><input type="text" class="form-control" name="tags" id="tags" value="<?php echo implode(', ',$this->post['tags'])?>" placeholder="ป้ายกำกับ (คั่นด้วย , และไม่เกิน 5 คำ)"></div>
</div>
<div class="form-actions">
<span id="status" class="pull-right" style="margin-top:7px;"><?php echo $this->post['pl']?'<a href="/'.$this->post['bl'].'/'.$this->post['_id'].'/'.$this->post['l'].'">เผยแพร่แล้ว</a>':'ฉบับร่าง'?></span>
<button type="button" id="btn-save" class="btn btn-primary" onclick="$('#sensubmit').submit();"><?php echo $this->post['pl']?'บันทึก':'เผยแพร่'?></button>
<span id="save"></span>
</div>
</fieldset>
</form>
</div>

<div class="modal modal-warning fade" id="delpost" role="dialog" aria-labelledby="myModalLabel">
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
