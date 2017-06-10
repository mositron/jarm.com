<div id="avatar_thumb" class="gbox" style="width:680px; min-height:400px" onclose="_.hash.close()" onopen="img.thumb('<?php echo $this->picture?>',<?php echo $this->w?>,<?php echo $this->h?>)">
<div class="gbox_header">แก้ไขรูปโปรไฟล์</div>
<div class="gbox_content" style="text-align:center">
<div class="picture-upload" style="line-height:1.6em; padding:5px 10px 10px 10px; text-align:center">
<div>
   <div style="float:left; width:150px;">
   <div id="preview"><img src="<?php echo $this->picture?>" id="gpf"></div>
   <div align="center" style="display:none" id="showsave">
       <form onSubmit="_.ajax.gourl('/settings','savecrop',this);return false">
            <input type="hidden" id="x" name="x" class="tbox">
            <input type="hidden" id="y" name="y" class="tbox">
            <input type="hidden" id="w" name="w" class="tbox">
            <input type="hidden" id="h" name="h" class="tbox">
            <input type="submit" class="button blue" value=" บันทึก ">
       </form>
   </div>
   </div>
   <div style="float:right; width:500px">
     <div style="width:<?php echo $this->w?>px;height:<?php echo $this->h?>px;"><img src="<?php echo $this->picture?>" id="gcrop"></div>
   </div>
  <div class="clear"></div>
</div>
</div>
<div class="gbox_footer"><input type="button" class="button" value=" ปิดหน้าต่างนี้ " onClick="_.box.close()"></div>
</div>
</div>
