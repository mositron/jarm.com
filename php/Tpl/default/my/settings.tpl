<script src="<?php echo FILES_CDN?>js/jcrop/jquery.Jcrop.min.js"></script>
<style>
#preview{width:150px; height:150px; overflow:hidden; position:relative;}
#preview #gbd{z-index:2; position:absolute; left:0px; top:0px;}
#preview #gpf{z-index:1;}
.jcrop-holder { text-align: left; }
.jcrop-vline, .jcrop-hline
{
  font-size: 0px;
  position: absolute;
  background: white url('<?php echo FILES_CDN?>/js/jcrop/css/Jcrop.gif') top left repeat;
}
.jcrop-vline { height: 100%; width: 1px !important; }
.jcrop-hline { width: 100%; height: 1px !important; }
.jcrop-vline.right { right: 0px; }
.jcrop-hline.bottom { bottom: 0px; }
.jcrop-handle {
  font-size: 1px;
  width: 7px !important;
  height: 7px !important;
  border: 1px #eee solid;
  background-color: #333;
}

.jcrop-tracker { width: 100%; height: 100%; }
.custom .jcrop-vline,
.custom .jcrop-hline
{
  background: yellow;
}
.custom .jcrop-handle
{
  border-color: black;
  background-color: #C7BB00;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
}
</style>
<script src="<?php echo FILES_CDN?>js/upload/simpleUpload.min.js"></script>
<script>
var img={
  boundx:0,boundy:0,
  thumb:function(j,w,h)
  {
    $('#gboxc #gcrop').Jcrop(
      {onChange: img.coords,onSelect: img.coords,aspectRatio: 1},
      function()
      {
        img.jcrop = this;
        if($('#gboxc #pvcrop').css('display')!='block')$('#gboxc #pvcrop').css({'display':'block'})
        $("#gboxc #gpf").attr({src:j});
        $('#gboxc #showsave').css({'display':'block'});
        img.jcrop.setImage(j);
        img.jcrop.animateTo([0,0,(w<h?w:h),(w<h?w:h)]);
        img.boundx = w;
        img.boundy = h;
      }
    );
  },
  coords:function(c){$('#gboxc #x').val(c.x);$('#gboxc #y').val(c.y);$('#gboxc #w').val(c.w);$('#gboxc #h').val(c.h);img.preview(c);},
  preview:function(c)
  {
    if (parseInt(c.w) > 0)
    {
     var rx = 150 / c.w;
     var ry = 150 / c.h;
     $('#gboxc #gpf').css({
      width: Math.round(rx * img.boundx) + 'px',
      height: Math.round(ry * img.boundy) + 'px',
      marginLeft: '-' + Math.round(rx * c.x) + 'px',
      marginTop: '-' + Math.round(ry * c.y) + 'px'
     });
    }
  }
};
$(document).ready(function(){
  $('input[type=file]').change(function(){
    var t=$(this);
    t.simpleUpload("<?php echo URL?>", {
      start: function(file){
        console.log("start!<br>Data: " + JSON.stringify(file));
        $('._jupload').css('display','block').html('<img src="<?php echo FILES_CDN?>img/global/load.gif" class="icon"> กรุณารอซักครู่... <span></span>');
      },
      progress: function(progress){
        console.log("progress!<br>Data: " + JSON.stringify(progress));
        $('._jupload > span').html(Math.round(progress) + "%")
      },
      success: function(data){
        console.log("Success!<br>Data: " + JSON.stringify(data));
        if(data.status=='OK')
        {
          if(data.update=='avatar')
          {
            if($(window).width()>680)
            {
              _.box.load('/dialog/avatar #avatar_thumb');
            }
          }
          $('.img-uid-my').attr('src',data.pic);
          $('._jupload').html('<span>เปลี่ยนรูปภาพเรียบร้อยแล้ว...</span>');
        }
      },
      error: function(error){
        $('._jupload').html('เกิดข้อผิดพลาด: '+error.name + ' - ' + error.message);
      }
    });
  });
});

</script>

<div class="col-content">
<ul class="breadcrumb">
  <li><a href="/">แผงควบคุม</a></li>
  <li class="active"><a href="/settings">ตั้งค่า</a></li>
</ul>
<?php echo $this->settings?>
</div>

<style>
._ct{box-shadow:none;}
._st{margin:0px;padding:20px;}
._st .tbservice th {padding: 7px 15px 5px;}
._st > li{ border-bottom:1px solid #ccc; padding:10px 15px; }
._st > li > a{display:block;padding:20px;}
._st > li > a >span{display:block;}
._st > li > a:hover{text-decoration:none; background-color:#f5f5f5;}
._st > li > div.row{ height:30px; line-height:30px;}

._st > li .col-xs-4{text-indent:10px;}
._st > li .col-xs-2{ text-align:center}
._st .hp{margin:5px 0px 5px 0px; border:1px solid #ddd; padding:5px;}
.cap{padding:5px; background-color:#DDD; text-shadow:1px 1px #fff; margin-bottom:5px;}

.tbservice th{background:#f5f5f5;padding:10px 15px;}
</style>
<br><br>
