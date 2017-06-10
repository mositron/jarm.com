<?php

$db=Load::DB();

$arg=array('u'=>Load::$my['_id'],'_id'=>intval(Load::$path[0]));

if(Load::$my['_id']=='10206486363972963')
{
	unset($arg['u']);
}

if((!$chat=$db->findOne('chatroom',$arg)))
{
	Load::move('/manage/',false);
}

define('MAX_BOT',10);
define('CHAT_LINK',!empty($chat['l'])?$chat['l']:'');

Load::Ajax()->register(['resetadmin']);
$error=[];
if($_POST)
{
	require_once(__DIR__.'/chat.manage.view.post.php');
	if(count($error))
	{
		$chat = array_merge($chat,$_POST);
		Load::$core->assign('error',$error);
	}
}
//
Load::$core->assign('chat',$chat);
Load::$core->data['content']=Load::$core->fetch('manage.view');


function resetadmin()
{
	$db=Load::DB();
	$ajax=Load::Ajax();

	if($chroom=$db->findone('chatroom',array('_id'=>intval(Load::$path[0]))))
	{
		$chroom['am']=array($chroom['u']=>array('lv'=>3,'ds'=>time()));
		$db->update('chatroom',array('_id'=>intval(Load::$path[0])),['$set'=>['am'=>$chroom['am']]]);

		$key='chatroom_data_'.intval(Load::$path[0]);

		$cache=Load::Mcache();
		if($data=$cache->get('ca2',$key))
		{
			$data['room']=[
																			'n'=>$chroom['n'],
																			'u'=>$chroom['u'],
																			'w'=>$chroom['w'],
																			'r'=>$chroom['r'],
																			'bg'=>$chroom['bg']
			];
			$data['admin']=$chroom['am'];

			$data['bot']=[];
			$bit=1000001;
			for($i=0;$i<count($chroom['bt']);$i++)
			{
				$b=$chroom['bt'][$i];
				if($b['n'])
				{
					$data['bot'][$bit]=array (
																					'n' => $b['n'],
																					'i' => FILES_CDN.'chat/avatar/'.rand(1,61).'.png',
																					'l' => '',
																					'ty' => $b['ty'],
																					'ctrl' => 'all',
																					'rk'=>rand(1,28),
																				 );
					$bit++;
				}
			}

			$cache->set('ca2',$key,$data,false,3600*24*7);
		}
		$ajax->alert('รีเซ็ทผู้ดูแลห้องแชทนี้เรียบร้อยแล้ว');
	}
}
?>
