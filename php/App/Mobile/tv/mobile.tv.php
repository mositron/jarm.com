<?php

define('APP_VERSION','1.0');

$tv=array(
					'home'=>array(
												['t'=>'ช่อง 3','d'=>'สัญญาณหลัก','i'=>'3','f'=>'rtmp://111.223.37.211/loadbalancer/thaitv3_256k','s'=>'http://www.thaitv3.com/player/player.swf'], // ch3
												['t'=>'ช่อง 3','d'=>'สำรอง 1','i'=>'3','f'=>'rtmp://xray.tuxxtv.com:1935/edgetvja/ch3.stream','s'=>'http://www.buildstory.com/newplayer.swf'], // tvjaa
												['t'=>'ช่อง 3','d'=>'สำรอง 2','i'=>'3','f'=>'rtmp://203.151.133.7:1935/live/ch3_1','s'=>'http://tv.sanook.com/swf/player.swf'], // sanook
												
												['t'=>'ช่อง 5','d'=>'สัญญาณหลัก','i'=>'5','f'=>'rtmp://app.tv5.co.th:1935/livestreamrecord/videolive5','s'=>''], // ch5
												['t'=>'ช่อง 5','d'=>'สำรอง 1','i'=>'5','f'=>'rtmp://xray.tuxxtv.com:1935/edgetvja/ch5.stream','s'=>'http://www.buildstory.com/newplayer.swf'], // tvjaa
												['t'=>'ช่อง 5','d'=>'สำรอง 2','i'=>'5','f'=>'rtmp://203.151.133.7:1935/live/ch5_1','s'=>'http://tv.sanook.com/swf/player.swf'], // sanook
												
												['t'=>'ช่อง 7','d'=>'สัญญาณหลัก','i'=>'7','f'=>'rtmp://edge5.bugaboo.tv/liveedgech7/livech72','s'=>'http://bugaboo.tv/themes/third_party/mediaplayer/player.swf'], // ch7
												
												
												['t'=>'ช่อง 9','d'=>'สัญญาณหลัก','i'=>'9','f'=>'rtmp://mediaix.mcot.net:1935/ch9/modern9_800','s'=>'http://www.mcot.net/ui-object/flowplayer/flowplayer-3.2.9.swf'], // ch5
												['t'=>'ช่อง 9','d'=>'สำรอง 1','i'=>'9','f'=>'rtmp://xray.tuxxtv.com:1935/edgetvja/ch9.stream','s'=>'http://www.buildstory.com/newplayer.swf'], // tvjaa
												['t'=>'ช่อง 9','d'=>'สำรอง 2','i'=>'9','f'=>'rtmp://203.151.133.7:1935/live/ch9_1','s'=>'http://tv.sanook.com/swf/player.swf'], // sanook
					
												['t'=>'MCOT 1','d'=>'สัญญาณหลัก','i'=>'mcot1','f'=>'http://110.164.192.112:1935/LiveStream/mcot1_live3.stream/playlist.m3u8','s'=>''], // 
												
												['t'=>'NBT','d'=>'สัญญาณหลัก','i'=>'nbt','f'=>'rtmp://fms1.prd.go.th/nbttv/livestream','s'=>'http://118.175.16.130/webtv1/flowplayer/flowplayer-3.2.5.swf'], // nbt
												['t'=>'NBT','d'=>'สำรอง 1','i'=>'9','f'=>'rtmp://xray.tuxxtv.com:1935/edgetvja/nbt.stream','s'=>'http://www.buildstory.com/newplayer.swf'], // tvjaa
												
												//['t'=>'ThaiPBS','d'=>'สัญญาณหลัก','i'=>'nbt','f'=>'rtmp://fms1.prd.go.th/nbttv/livestream','s'=>'http://118.175.16.130/webtv1/flowplayer/flowplayer-3.2.5.swf'], // nbt
												['t'=>'ThaiPBS','d'=>'สัญญาณหลัก','i'=>'9','f'=>'rtmp://xray.tuxxtv.com:1935/edgetvja/tpbs.stream','s'=>'http://www.buildstory.com/newplayer.swf'], // tvjaa
					//http://110.164.192.112:1935/LiveStream/mcot1_live3.stream/playlist.m3u8
					
					//netstreambasepath=http%3A%2F%2Fwww.ch7.com%2Fplayer%2Fiframe_livech7%2F25149%2Fmid%2F25%3Fw%3D640%26h%3D360&id=mediaplayer&vdo_id=49140&vdo_title=Live%20ch7&wmode=opaque&screencolor=%23000&image=&config=http%3A%2F%2Fwww.ch7.com%2Fbanner%2Fvast2&plugins=http%3A%2F%2Flp.longtailvideo.com%2F5%2Fova%2Fova-jw.swf&autostart=true&skin=http%3A%2F%2Fbugaboo.tv%2Fthemes%2Fthird_party%2Fmediaplayer%2Fskins%2Fbugaboo%2Fbugaboo.zip&provider=rtmp&streamer=rtmp%3A%2F%2Fedge5.bugaboo.tv%2Fliveedgech7&file=livech72&mediaid=49140&title=Live%20ch7&ova.pluginmode=HYBRID&controlbar.position=over
					)

);


Load::$core->assign('tv',$tv);

$serv=[
						''=>'home',
						'news'=>'news',
						'music'=>'music',
						'cartoon'=>'cartoon',
						'movie'=>'movie',
						'entertain'=>'entertain',
						'sport'=>'sport',
						'knowledge'=>'knowledge',
						'apps'=>'apps',
];


if(isset($serv[Load::$path[0]]))
{
	require_once(__DIR__.'/mobile.tv.'.$serv[Load::$path[0]].'.php');
}
else
{
	require_once(__DIR__.'/mobile.tv.home.php');
}


echo Load::$core->fetch('tv');
exit;
?>