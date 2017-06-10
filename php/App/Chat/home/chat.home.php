<?php


Load::$core->data['title'] = 'แชท Chat คุยสด แชทรูม แชทสด แชทผ่านกล้อง แชทหาเพื่อน สนทนา ผ่านกล้องเว็บแคม สร้างห้องแชทฟรี กับเพื่อนๆใน jarm';
Load::$core->data['description'] = 'แชท Chat พูดคุย คุยสด แชทรูม แชทสด แชทผ่านกล้อง แชทหาเพื่อน สนทนา ผ่านกล้องเว็บแคม ส่องเว็บแคม ส่องกล้อง สร้างห้องแชทฟรี กับเพื่อนๆใน jarm.com';
Load::$core->data['keywords'] = 'แชท, Chat, คุยสด, แชทสด, แชทรูม, คุยสด, แชทหาเพื่อน, สร้างแชทฟรี, สร้างห้องแชทฟรี, พูดคุย, สนทนา, เว็บแคม, กล้อง';

//Load::$core->data['google']=['id'=>'112235668332689047152'];
//Load::move('https://friend.jarm.com/',true);
//exit;
if($_GET['r'])
{
	Load::move('/room/'.$_GET['r'],true);
}
$cache=Load::$core;
if(!Load::$core->data['content']=$cache->get('chat/home',300))
{
	$db=Load::DB();
	$chat = $db->find('chatroom',['dd'=>['$exists'=>false],'pl'=>1,'_id'=>['$lte'=>24]],['_id'=>1,'n'=>1,'u'=>1,'w'=>1,'da'=>1,'cu'=>1,'cv'=>1,'l'=>1,'fd'=>1,'img'=>1],['sort'=>['c'=>-1]]);
	Load::$core->data['content']=Load::$core->assign('chat',$chat)
									->fetch('home');
	$cache->set('chat/home',Load::$core->data['content']);
}

?>
