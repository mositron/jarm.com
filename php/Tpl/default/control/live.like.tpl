<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Jarm.com</title><style>body{background:transparent;color:#333;font-family:tahoma;font-size:16px;padding:0px;margin:5px 0px;overflow:hidden;text-align:center;}.emoji{width:64px;height:64px;margin:-10px}.wc{display:inline-block;text-align:center;vertical-align:middle;margin:0px 5px;}.wc .counter{display:block;font-size:14px;color:#000;text-shadow:1px 1px 0px #fff;background:#f0f0f0;border-radius:10px;padding:0px 0px 2px;}</style><script src="https://cdn.jarm.com/js/jquery/jquery-1.11.2.min.js"></script><script>"use strict";var postID='<?php echo $this->page?>_<?php echo $this->post?>',access_token='<?php echo $this->access?>',btn_like=<?php echo in_array('like',$this->like)?'true':'false'?>,btn_love=<?php echo in_array('love',$this->like)?'true':'false'?>,btn_haha=<?php echo in_array('haha',$this->like)?'true':'false'?>,btn_wow=<?php echo in_array('wow',$this->like)?'true':'false'?>,btn_sad=<?php echo in_array('sad',$this->like)?'true':'false'?>,btn_angry=<?php echo in_array('angry',$this->like)?'true':'false'?>,refreshTime=5,defaultCount=0,reactions=['LIKE','LOVE','HAHA','WOW','SAD','ANGRY'].map(function(e){var code='reactions_'+e.toLowerCase();return 'reactions.type('+e+').limit(0).summary(total_count).as('+code+')'}).join(',');var	v1,v2,v3,v4,v5,v6;function refreshCounts(){var url='https://graph.facebook.com/v2.8/?ids='+postID+'&fields='+reactions+'&access_token='+access_token;$.getJSON(url, function(res){v1.html(defaultCount+res[postID].reactions_like.summary.total_count);v2.html(defaultCount+res[postID].reactions_love.summary.total_count);v3.html(defaultCount+res[postID].reactions_haha.summary.total_count);v4.html(defaultCount+res[postID].reactions_wow.summary.total_count);v5.html(defaultCount+res[postID].reactions_sad.summary.total_count);v6.html(defaultCount+res[postID].reactions_angry.summary.total_count);});};$(document).ready(function(){if(btn_like)$('body').append('<div class="wc likes"><img class="emoji" src="https://cdn.jarm.com/img/live/like.gif"><span class="counter">0</span></div>');if(btn_love)$('body').append('<div class="wc love"><img class="emoji" src="https://cdn.jarm.com/img/live/love.gif"><span class="counter">0</span></div>');if(btn_haha)$('body').append('<div class="wc haha"><img class="emoji" src="https://cdn.jarm.com/img/live/haha.gif"><span class="counter">0</span></div>');if(btn_wow)$('body').append('<div class="wc wow"><img class="emoji" src="https://cdn.jarm.com/img/live/wow.gif"><span class="counter">0</span></div>');if(btn_sad)$('body').append('<div class="wc sad"><img class="emoji" src="https://cdn.jarm.com/img/live/sad.gif"><span class="counter">0</span></div>');if(btn_angry)$('body').append('<div class="wc angry"><img class="emoji" src="https://cdn.jarm.com/img/live/angry.gif"><span class="counter">0</span></div>');v1=$('.likes .counter');v2=$('.love .counter');v3=$('.haha .counter');v4=$('.wow .counter');v5=$('.sad .counter');v6=$('.angry .counter');setInterval(refreshCounts,refreshTime*1000);refreshCounts();});</script></head><body></body></html>
