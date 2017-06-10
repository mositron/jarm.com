<style>
.form-horizontal .control-group {
margin-bottom:8px;
padding-bottom: 10px;
border-bottom: 1px dashed #F0F0F0;
}
</style>

<script>window.tinyMCEPreInit = {suffix:'.min',base:'/_cdn/lib/tinymce'};</script>
<script type="text/javascript" src="/_cdn/lib/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="/_cdn/lib/tinymce/jquery.tinymce.min.js"></script>
<script>
var tmr,curlang;
$(function() {
  tinymce.init({
    selector: "textarea",
    plugins: [
    "advlist autolink lists link image print preview anchor",
    "searchreplace visualblocks code fullscreen table",
    "media table contextmenu paste textcolor colorpicker"
    ],
    toolbar: "code | bold italic underline | forecolor backcolor | bullist numlist | alignleft aligncenter alignright | link media | table",

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
  });
});

function selectcate(e)
{
  var c=$('.cate').val();
  $('.cate_sub').css('display','none');
  if($('.cate_sub'+c).length)
  {
    $('.cate_sub'+c).css('display','block');
  }
}

function delfile(i)
{
  if(confirm('คุณต้องการลบไฟล์แนบนี้หรือไม่'))ajax_delfile(i);
}

function delrelated(i)
{
  if(confirm('คุณต้องการลบข้อมูลที่เกี่ยวข้องนี้หรือไม่'))ajax_delrelated(i);
}
</script>

<div>
<ul class="breadcrumb" style="margin-bottom:5px;">
  <li><a href="/" title="ควบคุม"><span class="glyphicon glyphicon-home"></span> ควบคุม</a></li>
  <span class="divider">&raquo;</span>
   <li><a href="/job"><span class="glyphicon glyphicon-briefcase"></span> รับสมัครงาน</a></li>
</ul>

 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal" onSubmit="tinyMCE.triggerSave(true);_.ajax.gourl('/job','setjob',this);return false;">
 <fieldset>
 <div>
<textarea style="height:700px; width:100%;" class="mceEditor" name="detail" minlength="20"><?php echo $this->msg['msg']?></textarea>
<p class="help-block">* บังคับกรอก</p>
</div>
<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/">ยกเลิก</a>
</div>
</fieldset>
</form>
<br><br>
</div>
