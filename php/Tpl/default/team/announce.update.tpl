
<ul class="breadcrumb">
	<li><a href="/" title=""><span class="glyphicon glyphicon-home"></span> Team</a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/announce" title=""><?php echo $this->content_type[$this->type]['n']?></a></li>
  <span class="divider">&raquo;</span>
	<li><a href="/announce/update/<?php echo $this->content['_id']?>" title="">แก้ไขประกาศ</a></li>
  <span></span>
	<li class="pull-right" style="margin:-3px -2px 1px;"><a href="/announce/<?php echo $this->content['_id']?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a></li>
</ul>

<div class="box-white">
  <?php if($_SERVER['QUERY_STRING']=='completed'):?>
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#">×</a>
    <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
   ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว
  </div>
  <?php endif?>
  <form action="<?php echo URL?>" class="form-horizontal" method="post" onsubmit="_.ajax.gourl('<?php echo URL?>','updatecontent',this);return false;">
    <div class="form-group">
      <label for="title" class="col-sm-2 control-label">หัวข้อ</label>
      <div class="col-sm-10">
        <input type="text" name="title" class="form-control" id="title" placeholder="หัวข้อ" value="<?php echo $this->content['title']?>"/>
      </div>
    </div>
    <div class="form-group">
      <label for="detail" class="col-sm-2 control-label">เนื้อหา</label>
      <div class="col-sm-10">
        <textarea class="mceEditor" id="detail" name="detail" style="height:700px; width:630px;" minlength="20"><?php echo htmlspecialchars($this->content['detail'],ENT_QUOTES,"UTF-8")?></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label"></label>
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
  </form>
</div>
<script>
_.mce={upload:'/announce/upload'};
$(function() {
  tinymce.remove('textarea');
	tinymce.init({
    selector: "textarea",
		plugins: [
		"advlist autolink lists link image print preview anchor",
		"searchreplace visualblocks code fullscreen table",
		"media table contextmenu paste textcolor colorpicker",
		"upload"
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

</script>
