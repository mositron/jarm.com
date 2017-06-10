<!DOCTYPE HTML>
<html>
<head>
<title>Upload Manager</title>
<meta charset="UTF-8">
<style>
div,span,form,p,h1,h2,h3,h4,ul,li,hr,body{margin:0;padding:0; line-height:1.2em;}
body , td,input{font-family:"MS Sans Serif", Tahoma;font-size:12px;font-style:normal;font-weight:normal;color:#000000;}
img{border:0px;}
a:link ,a:visited{color:#000000;text-decoration:none;}
a:active,a:hover,.link_jigg_flash a:hover{color:#F60;}
h1 {	font-size:16px;}
h2 {font-size:14px;}
h3 {font-size:12px;}
h4 {font-size:12px;font-weight:normal;}
h5 {font-size:16px;font-weight:normal;}
.tbox{margin: 1px 0 1px 0;border-width: 1px;border-color: #FFFFDD;font-size:13px;background-color:#F0F0E0; text-indent:2px;}
.button,.submit{color:#666;font-size:14px; line-height:20px;font-weight: bold;background-color:#ddd;border-top: 1px solid #eee;border-left: 1px solid #eee;border-bottom: 1px solid #888;border-right: 1px solid #888;overflow: visible;padding: 0 10px 0 10px;margin:0;}
.submit{color:#FFFFFF;cursor:pointer;background-color:#0066dd;border-top: 1px solid #80b3f3;border-left: 1px solid #80b3f3;border-bottom: 1px solid #2350A6;border-right: 1px solid #2350A6;}
a.list{display:block; padding:2px;}
a.list:hover{background:#66CC00;}

ul{ border-bottom:1px solid #ccc;}
ul li{list-style:none;}
ul li.on{list-style:none;}
ul li.on a{background:#ffffff}
ul li a{float:left; padding:0px 10px; height:24px; line-height:24px; border:1px solid #ccc; border-bottom:none; margin-left:5px;}

#viewfile{background:#ccc;}
#viewfile th{background:#F9F9F9; text-align:center}
#viewfile td{background:#FFFFFF;}

.opacity{-moz-opacity:.3;filter:alpha(opacity=30);opacity:.3;}

img.img-t{max-width:100px; max-height:100px;}
</style>
<link rel="icon" type="image/x-icon" href="http://<?php echo HOST?>/favicon.ico">
<script type="text/javascript" src="<?php echo FILES_CDN?>js/jquery/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo FILES_CDN?>js/jarm.js"></script>
</head>
<body>
<script type="text/javascript">
var simg='';


function selectf(img)
{
	if($('#sbutton').css('display')!='block')$('#sbutton').css({'display':'block'});
	simg=img;
}
function addfile()
{
	top.tinymce.activeEditor.windowManager.getParams().oninsert(simg,$('#addclose:checked').length);
}

/*
var UploadDialog = {
	init : function(ed){tinyMCEPopup.resizeToInnerSize();},
	insert : function() {
		var ed = tinyMCEPopup.editor, dom = ed.dom;
			tinyMCEPopup.execCommand('mceInsertContent', false,  (simg.div?' <div>':'')+' '+dom.createHTML('img', {
				src : simg.url,
				title : simg.title
						})+' '+(simg.div?'</div> ':''));
		if($('#addclose:checked')[0])tinyMCEPopup.close();
	}
};
*/
</script>
<table cellpadding="5" cellspacing="1" border="0" width="100%">
<tr>
<td id="mceupload">
<form method="post" enctype="multipart/form-data" action="<?php echo URL?>">
<input type="file" class="tbox" name="photo[]" style="float:none;" multiple><br>
<label><input type="checkbox" name="watermark" value="1"> ใส่ลายน้ำ</label> <input type="submit" class="button" value="อัพโหลด" style="float:none;">
</form></td>
<td align="right">
<label><input type="checkbox" id="addclose" value="1" checked> ปิดหน้าต่างนี้ เมื่อเพิ่มรูปหรือไฟล์เข้าเนื้อหา</label>
<p id="sbutton" style="display:none;">
<input type="button" value=" เพิ่มเข้าเนื้อหา " class="button" onClick="addfile();" style="float:none;">
</p>
</td>
</tr>
</table>
<div id="getattach" style="margin-top:5px;"><?php echo $this->getattach?></div>

<script>;
function deli(a){if(confirm('คุณต้องการลบไฟล์นี้หรือไม่'))_.ajax.gourl('<?php echo URL?>','delattach',a);}
</script>
</body>
</html>
