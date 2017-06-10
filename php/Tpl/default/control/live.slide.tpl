<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Jarm.com</title><style>body{background:transparent;color:#333;font-family:tahoma;font-size:16px;padding:0px;margin:5px 0px;overflow:hidden;text-align:center;}img{position:absolute;left:0px;top:0px}</style><script src="https://cdn.jarm.com/js/jquery/jquery-1.11.2.min.js"></script></head><body>
<img src="<?php echo $_GET['img']?>" id="img">
</body>
<script>
function start()
{
  var width=$(window).width();
  $('#img').css({'left':width+10})
  .animate({'left':-1*$('#img').width()},<?php echo $this->like[0]?>000,function(){
    setTimeout(function(){start();},<?php echo $this->like[1]?>000);
  });
}
start();
</script>
</html>
