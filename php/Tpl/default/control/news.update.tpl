<div class="col-sm-9">
<style>
.form-horizontal .control-group {margin-bottom:8px;padding-bottom: 10px;border-bottom: 1px dashed #F0F0F0;}
</style>
<script>window.tinyMCEPreInit = {suffix:'.min',base:'/_cdn/lib/tinymce'};</script>
<script type="text/javascript" src="/_cdn/lib/tinymce/tinymce.min.js"></script>
<!--script type="text/javascript" src="/_cdn/lib/tinymce/jquery.tinymce.min.js"></script-->
<script>
function instant(i){_.box.confirm({title:'อัพเดทข้อมูลไปยัง Instant Article',detail:'ระบบนี้ใช้สำหรับข่าวเก่าที่ยังไม่เคยแสดงบน Instant Aticle หรือข่าวเก่าที่มีการแก้ไขหรืออัพเดทเนื้อหาใหม่ เพื่อส่งเข้าคิวการอัพเดทให้ Facebook (ใช้เวลาประมาณ 3-5 นาที)<br>ต้องการดำเนินการต่อหรือไม่.',click:function(){_.ajax.gourl('/news','instant',i)}});}

var tmr,curlang;

function setctlink()
{
  if($('input[name="exlink"]:checked').val()=='1')
  {
    $('.control-box-link').css('display','block');
    $('.control-box-ct').css('display','none');
  }
  else
  {
    $('.control-box-link').css('display','none');
    $('.control-box-ct').css('display','block');
  }
}

_.mce={upload:'/news/upload/<?php echo $this->news['_id']?>'};

$(function() {
  tinymce.init({
    selector: "textarea",
    plugins: [
    "advlist autolink lists link image print preview anchor",
    "searchreplace visualblocks code fullscreen table",
    "media table contextmenu paste textcolor colorpicker",
    "upload"
    ],
    toolbar: "code | bold italic underline | forecolor backcolor | bullist numlist | alignleft aligncenter alignright | link media upload | table",
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
  setctlink();
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
<ul class="breadcrumb">
  <li><a href="/" title="ข่าว ข่าววันนี้">ข่าว</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/news">ระบบจัดการข้อมูล</a></li>
  <span class="divider">&raquo;</span>
  <li><a href="/news/c-<?php echo $this->news['c']?>"><?php echo self::$conf['news'][$this->news['c']]['t']?></a></li>
  <span class="divider">&raquo;</span>
  <li>แก้ไขข่าว</li>
</ul>
<h2 class="bar-heading" style="padding:5px; margin:5px;">แก้ไขข่าว

<small class="right" style="margin-top:10px;">
โดย: <a href="<?php echo $this->user['link']?>" target="_blank" rel="nofollow"><?php echo $this->user['name']?></a>
  <?php if(isset($this->news['ds'])):?>
  - เผยแพร่: <?php echo self::Time()->from($this->news['ds'],'datetime')?>
  <?php endif?>
</small>
</h2>

<?php if($this->error):?>
<div class="alert alert-error">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">ผิดพลาด!</h4>
 <?php echo implode('<br>',$this->error);?>
</div>
<?php endif?>

<?php if($_SERVER['QUERY_STRING']=='completed'):?>
<div class="alert alert-success">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">เรียบร้อยแล้ว!</h4>
 ระบบทำการบันทึกข้อมูลเรียบร้อยแล้ว  (กลับไปยัง <a href="/news">ระบบจัดการข้อมูล </a><?php if($this->news['pl']):?>, <a href="<?php echo $this->news['link']?>">หน้าแสดงผล </a><?php endif?>)
</div>
<?php elseif($_SERVER['QUERY_STRING']=='no-image'):?>
<div class="alert alert-danger">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">ไม่สามารถเผยแพร่ได้!</h4>
 ไม่สามารถเผยแพร่ข่าวนี้ได้ เนื่องจากยังไม่มีรูปภาพของข่าว
</div>
<?php elseif($_SERVER['QUERY_STRING']=='figure'):?>
<div class="alert alert-danger">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">ไม่สามารถเผยแพร่ได้!</h4>
 ข่าวนี้จะต้องมีรูปภาพ หรือ วิดีโอ หรือ embed รวมกันแล้วอย่างน้อย 5 figure ขึ้นไป, ถึงจะสามารถเผยแพร่ได้.
</div>
<?php elseif(isset($_GET['caption'])):?>
<div class="alert alert-danger">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">ไม่สามารถเผยแพร่ได้!</h4>
 ไม่มีคำอธิบายแทรกที่ตำแหน่ง figure <?php echo $_GET['caption']?>, จะต้องมีคำอธิบายหรือข้อความ แทรกระหว่าง figure เสมอ (รูปภาพ, วิดีโอ, embed)
</div>
<?php elseif(isset($_GET['summary'])):?>
<div class="alert alert-danger">
  <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">ไม่สามารถเผยแพร่ได้!</h4>
  ข้อความเกริ่นนำที่ตำแหน่งก่อน figure ที่ 1 มีความยาวไม่เกิน 200 ตัวอักษร (ตอนนี้มี <?php echo $_GET['summary']?> ตัวอักษร)
</div>
<?php endif?>

<?php if($this->news['pl']):?>
<div class="alert alert-info">
  <h4 class="alert-heading">เผยแพร่แล้ว!</h4>
 ข่าวนี้ทำการเผยแพร่แล้ว. กลับไปยัง <a href="/news">ระบบจัดการข้อมูล</a>, <a href="<?php echo $this->news['link']?>">หน้าแสดงผล</a>, <a href="/news/stats/<?php echo $this->news['_id']?>">สถิติ</a>
<div style="padding:5px 0px 0px"><a href="javascript:;" onClick="instant(<?php echo $this->news['_id']?>)" class="btn btn-default"><span class="glyphicon glyphicon-open"></span>อัพเดทข่าวนี้ไปยัง Instant Article</a></div>
</div>
<?php endif?>
 <form method="post" action="<?php echo URL?>" enctype="multipart/form-data" id="sensubmit" class="form-horizontal">
 <fieldset>
 <div class="control-group<?php if($this->error['title']):?> error<?php endif?>">
<label class="control-label" for="input01">ชื่อเรื่อง:</label>
<div class="controls">
<input type="text" id="input01" class="form-control" name="title" value="<?php echo htmlspecialchars($this->news['t'],ENT_QUOTES,'utf-8')?>" required>
<p class="help-block">* บังคับกรอก</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input10">รูปภาพ:</label>
<div class="controls">
<img src="<?php echo self::uri([$this->news['sv'],'/news/'.$this->news['fd'].'/s.jpg?'.rand(1,9999)])?>"><br>
<input type="file" id="input10" size="20" name="o">
<p class="help-block">* บังคับเลือก (รูปภาพที่ใช้อัพโหลดตามอัตราส่วน 3:2 หรืออย่างน้อย 330x220px โดย crop ด้านบนเป็นหลัก)</p>
</div>
</div>

<div class="control-group<?php if($this->error['category']):?> error<?php endif?>">
<label class="control-label" for="input02">ประเภทข่าว:</label>
<div class="controls category">
<select name="cate" class="cate form-control" required>
<?php foreach(self::$conf['news'] as $k=>$v):?>
<?php if(!empty($v['s'])):?>
<optgroup label="<?php echo $v['t']?>"></optgroup>
<?php foreach($v['s'] as $k2=>$v2):?>
<?php if(isset($v2['s'])):?>
<optgroup label=" &nbsp; &nbsp; <?php echo $v2['t']?>"></optgroup>
<?php foreach($v2['s'] as $k3=>$v3):?>
<option value="<?php echo $k.'_'.$k2.'_'.$k3?>"<?php echo $k==$this->news['c']&&$k2==$this->news['cs']&&$k3==$this->news['cs2']?' selected':''?>> &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $v3['t']?></option>
<?php endforeach?>
<?php else:?>
<option value="<?php echo $k.'_'.$k2?>"<?php echo $k==$this->news['c']&&$k2==$this->news['cs']?' selected':''?>> &nbsp; &nbsp; <?php echo $v2['t']?></option>
<?php endif?>
<?php endforeach?>
<?php else:?>
<option value="<?php echo $k?>"<?php echo $k==$this->news['c']?' selected':''?>><?php echo $v['t']?></option>
<?php endif?>
<?php endforeach?>
</select>

<p class="help-inline">* บังคับเลือก</p>
</div>
</div>

<div class="control-group">
<label class="control-label" for="input02">ข้อมูลข่าว:</label>
<div class="controls category">
<label class="radio-inline"><input type="radio" name="exlink" onClick="setctlink()" value="0"<?php echo !$this->news['exl']?' checked':''?>> เนื้อหาในข่าว</label>
<label class="radio-inline"><input type="radio" name="exlink" onClick="setctlink()" value="1"<?php echo $this->news['exl']?' checked':''?>>  ลิ้งค์ไปยังหน้าอื่น</label>
</div>
</div>

<div class="control-group control-box-link">
<label class="control-label" for="input31">ลิ้งค์ไปยังหน้าอื่น:</label>
<div class="controls">
<input type="text" id="input31" class="form-control" style="width:90%" name="url" placeholder="http://" value="<?php echo htmlspecialchars($this->news['url'],ENT_QUOTES,'utf-8')?>">
<p class="help-block">* บังคับกรอก - ต้องขึ้นต้นด้วย http://</p>
</div>
</div>

<div class="control-box-ct" style="margin-top:10px;">
<div><strong>เนื้อหา</strong> - <span style="color:#c00;">ห้ามใช้ภาพหรือข้อความ ที่มีความรุนแรง , อนาจาร, โป้เปลือย, วาบหวิว</span></div>
<textarea class="mceEditor" name="detail" style="height:700px; width:630px;" minlength="20"><?php echo htmlspecialchars($this->news['d'],ENT_QUOTES,"UTF-8")?></textarea>
</div>

<?php /*
<div class="control-group">
<label class="control-label" for="inputtags">ป้ายกำกับ / Tags:</label>
<div class="controls">
<ul class="api-search-have tag">
<?php for($i=0;$i<count($this->news['tags']);$i++):$v=$this->news['tags'][$i]?>
<li class="tag-box"><input type="hidden" name="tags[]" value="<?php echo $v?>">
<?php echo $v?>
<a href="javascript:;" onclick="$(this).parent().remove()">x</a>
</li>
<?php endfor?>
<li class="api-search-tag"><input type="text" class="api-search-input tag" data-type="tag" autocomplete="off" style="width: 30px;"></li>
<p class="clear"></p>
</ul>
<div class="api-search tag"></div>
<p class="help-block">ปล่อยว่างได้ - (ใช้ , คั่นระหว่างป้ายกำกับแต่ละตัว เพื่อระบุถึงเนื้อหาที่เกี่ยวข้อง, ไม่สามารถใช้อักขระพิเศษได้)</p>
</div>
</div>
*/?>

<?php if(self::$my['am']):?>
<div class="control-group">
  <label class="control-label" for="input20">ตั้งเป็นข่าวเด่น:</label>
  <div class="controls category">
    <label class="radio-inline"><input type="radio" name="recommend" value="1"<?php echo $this->news['rc']?' checked':''?>> เป็นข่าวเด่น</label>
    <label class="radio-inline"><input type="radio" name="recommend" value="0"<?php echo !$this->news['rc']?' checked':''?>> เป็นข่าวทั่วไป</label>
  </div>
</div>
<div class="control-group">
  <label class="control-label" for="input02">แสดงโฆษณาคั่นกลางเนื้อหา:</label>
  <div class="category">
    <label class="radio-inline"><input type="radio" name="no_ads" value="0"<?php echo !$this->news['na']?' checked':''?><?php echo defined('ADS_CONTROL')?'':' disabled'?>> แสดง</label>
    <label class="radio-inline"><input type="radio" name="no_ads" value="1"<?php echo $this->news['na']?' checked':''?><?php echo defined('ADS_CONTROL')?'':' disabled'?>> ไม่แสดง</label>
  </div>
</div>
<div class="control-group">
  <label class="control-label" for="input02">การเผยแพร่:</label>
  <div class="category">
    <div class="radio"><label><input type="radio" name="publish" value="1"<?php echo $this->news['pl']==1?' checked':''?>> แสดงผล (แสดงผลรูปภาพและหัวข้อข่าวในหน้ารวมข่าวเหมือนปรกติ)</label></div>
    <div class="radio"><label><input type="radio" name="publish" value="2"<?php echo $this->news['pl']==2?' checked':''?>> แสดงเฉพาะหน้าเนื้อหา (เฉพาะผู้ที่มีลิ้งค์ข่าวนี้เท่านั้นถึงดูเนื้อหาได้)</label></div>
    <div class="radio"><label><input type="radio" name="publish" value="0"<?php echo !$this->news['pl']?' checked':''?>> ไม่แสดง</label></div>
  </div>
</div>
<?php else:?>
 <div class="control-group">
<label class="control-label" for="input02">การเผยแพร่:</label>
<div class="controls category">
<label class="radio-inline"><input type="radio" name="waiting" value="1"<?php echo $this->news['wt']?' checked':''?>> ส่งเรื่องให้เจ้าหน้าที่ตรวจสอบ</label>
<label class="radio-inline"><input type="radio" name="waiting" value="0"<?php echo !$this->news['wt']?' checked':''?>> ยังไม่ส่ง</label>
</select>
</div>
</div>
<?php endif?>

<div class="form-actions">
<button type="submit" class="btn btn-primary">บันทึก</button>
<a class="btn" href="/news">ยกเลิก</a>
</div>
</fieldset>
</form>
</div>
<br>
</div>
<div class="col-sm-3">
<style>
.nav-howto{padding:5px 10px; margin:5px 0px 0px 5px}
.nav-howto h5{text-align:center; background:#f0f0f0; text-shadow:1px 1px 0px #fff; margin:0px 0px 5px; height:22px; line-height:22px;}
.nav-howto ul{margin-left:5px; list-style:inside circle;}
</style>
<h4 style="margin:5px 0px 0px 5px; background:#f0f0f0; height:24px; line-height:24px; text-align:center;">วิธีการเขียนบทความ</h4>
<div class="nav-howto">

<h5>การตั้งหัวข้อ</h5>
<ul>
<li>ชัดเจน เข้าใจง่าย: ใคร ทำอะไร ที่ไหน ยังไง</li>
<li>Keyword ควรจะเป็นคำแรกของหัวข้อ</li>
<li>ห้ามใช้คำอุทาน เช่น แม่เจ้า.. , โอ้โห..</li>
<li>ตรงประเด็น ไม่ผ่านบุคคลที่3 (ชาวเน็ตแห่ชม...)</li>
<li>ห้าม Copy จากที่อื่น ต้อง rewrite ใหม่</li>
</ul>

<h5>การเขียนเนื้อหา</h5>
<ul>
<li>ใช้คำหรือประโยคที่สากล ห้ามตั้งศัพท์เอง.</li>
<li>ใช้ชื่อเต็ม: ชื่อเล่น ชื่อจริง นามสกุล (ฉายา-ถ้ามี)</li>
<li>เนื้อหาครบถ้วน ใครทำอะไร กับใคร ที่ไหน ยังไง</li>
<li>ห้ามใช้ สรรพนาม แต่ให้ใช้ชื่อเต็มเท่านั้น</li>
<li>ห้าม Copy จากที่อื่น ต้อง rewrite ใหม่ทั้งหมด</li>
</ul>

</div>
</div>
