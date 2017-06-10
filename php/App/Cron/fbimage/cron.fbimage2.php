<?php
	$pages=[
									['t'=>'9GAG in Thai','id'=>'160866484017913','min'=>100],
									['t'=>'คิดว่าดีก็ทำต่อไป','id'=>'185668594895616','min'=>100],
									['t'=>'บ่นบ่น','id'=>'119275421551380','min'=>100],
									['t'=>'Jaytherabbit','id'=>'503977206328815','min'=>50],
									//['t'=>'Eat All Day','id'=>'425434517512362','min'=>50],
									['t'=>'สมาคมกวนTEEN 18+','id'=>'276439945704187','min'=>100],
									['t'=>'ความรู้ท่วมหัวเอาตัวไม่รอด','id'=>'377972818972771','min'=>100],
									['t'=>'โสดแสนD','id'=>'215561678464052','min'=>100],
									['t'=>'ว่าแล้ว\'','id'=>'558905540806815','min'=>100],
									['t'=>'หน้ากลม','id'=>'145147339021153','min'=>100],
									['t'=>'Minions thailand','id'=>'206907329467617','min'=>100],
									['t'=>'The Smurfs Thailand','id'=>'537003989706910','min'=>10],
									['t'=>'Dora GAG','id'=>'313284625423348','min'=>50],
									['t'=>'หมึกซึม','id'=>'332998630119285','min'=>100],
									['t'=>'พอใจ','id'=>'390054464415577','min'=>100],
									['t'=>'ลึกๆ','id'=>'294688280665847','min'=>100],
									['t'=>'Timixabie','id'=>'299590466830861','min'=>100],
									['t'=>'กระดาษสีครีม','id'=>'552419978152008','min'=>100],
									['t'=>'Jod 8riew','id'=>'420017908056802','min'=>100],
									['t'=>'คมเกิ๊น','id'=>'418024494891447','min'=>100],
									['t'=>'Message','id'=>'229198730561050','min'=>100],


									['t'=>'ภาพคอมเม้นฮ่าๆ','id'=>'216748941823775','min'=>50],
									['t'=>'แจกรูปโพสต์ใต้คอมเม้นเฟสบุ๊ค','id'=>'586593644724225','min'=>100],
									['t'=>'รวมรูปคอมเม้นฮาฮา','id'=>'1376048759290010','min'=>100],


	];
	$db=Load::DB();

	$cur=$db->findone('msg',['_id'=>'fbimage']);

	echo 'ค้นหา fb id : '.$cf['id'].'<br>';
	$cf=$db->findone('user',['_id'=>1],['sc.fb.token'=>1]);
	$curpage = $cur['page'];
	$curpage++;
	if($curpage>=count($pages))
	{
		$curpage=0;
	}
	$db->update('msg',['_id'=>'fbimage'],['$set'=>['page'=>$curpage]]);
	$page=$pages[$curpage];

	require_once(HANDLERS.'facebook/facebook.php');
	facebook::$CURL_OPTS[CURLOPT_TIMEOUT]=300;
	$facebook=new facebook(['appId'=>Load::$conf['social']['facebook']['appid'],'secret'=>Load::$conf['social']['facebook']['secret']]);
	$facebook->setAccessToken($cf['sc']['fb']['token']);
	$facebook->setExtendedAccessToken();


	echo 'token: '.$cf['sc']['fb']['token'].'<br>';
	print_r($page);

	date_default_timezone_set('Asia/Bangkok');

	//$post = $facebook->api('/'.$page['id'].'/posts');

	$post = $facebook->api(['method' => 'fql.query', 'query' => 'SELECT post_id,message , created_time, type,like_info.like_count, comment_info.comment_count, share_info.share_count, attachment  FROM stream WHERE source_id='.$page['id'].' and type=247 ORDER BY created_time desc limit 0,20']);
	echo '<pre>';
	//print_r($post);
	if(is_array($post)&&is_array($post))
	{
		$p=[];
		for($i=0;$i<count($post);$i++)
		{
			$lk=intval($post[$i]['like_info']['like_count']);
			$sh=intval($post[$i]['share_info']['share_count']);
			$cm=intval($post[$i]['comment_info']['comment_count']);
			/*
			$lk=intval($post['data'][$i]['likes']['count']);
			if($lk==0)
			{
				if(is_array($post['data'][$i]['likes']['data']))
				{
					$lk=count($post['data'][$i]['likes']['data']);
				}
			}
			$sh=intval($post['data'][$i]['shares']['count']);
			if($sh==0)
			{
				if(is_array($post['data'][$i]['shares']['data']))
				{
					$sh=count($post['data'][$i]['shares']['data']);
				}
			}
			$cm=intval($post['data'][$i]['comments']['count']);
			if($cm==0)
			{
				if(is_array($post['data'][$i]['comments']['data']))
				{
					$cm=count($post['data'][$i]['comments']['data']);
				}
			}
			*/
			print_r($post[$i]);
			$img=$post[$i]['attachment']['media'][0]['src'];
			echo '--'.($lk.'+'.$sh.'+'.$cm).'>'.$page['min'].' -- '.$img.' = ';
			$all = $lk+$sh+$cm;
			if(($all>$page['min'])&&$img&&(mb_substr($img,0,20)=='https://fbcdn-photos'))
			{
				echo ' <strong>OK</strong> ';
				//print_r($post['data'][$i]);
				$t=strtotime($post[$i]['created_time']);
				$ar=[
  						'pid'=>$post[$i]['post_id'],
  						'ms'=>$post[$i]['message'],
  						'img'=>$img,
  						'lk'=>$lk,
  						'sh'=>$sh,
  						'cm'=>$cm,
  						'p'=>$page['t'],
  						'fb'=>$page['id'],
  						'ds'=>Load::Time()->from($t),
  						'du'=>Load::Time()->now(),
  					];
				if($p=$db->findone('fbimage',['pid'=>$ar['pid']],['_id'=>1]))
				{
					unset($ar['pid']);
					$db->update('fbimage',['_id'=>$p['_id']],['$set'=>$ar]);
				}
				else
				{
					$db->insert('fbimage',$ar);
				}
			}
			elseif(($all>$page['min'])&&$img&&((preg_match('/\/((p|s)[0-9]{3}x[0-9]{3})\//',$img,$cimg))&&(mb_substr($img,-6)=='_n.jpg'||mb_substr($img,-6)=='_n.png')))
			{
				print_r($cimg);
				echo ' <strong style="color:#090">OK2</strong> ';
				//print_r($post['data'][$i]);
				$t=strtotime($post[$i]['created_time']);
				$ar=[
							'pid'=>$post[$i]['post_id'],
							'ms'=>$post[$i]['message'],
							'img'=>$img,
							'rp'=>$cimg[0],
							'lk'=>$lk,
							'sh'=>$sh,
							'cm'=>$cm,
							'p'=>$page['t'],
							'fb'=>$page['id'],
							'ds'=>Load::Time()->from($t),
							'du'=>Load::Time()->now(),
				];
				if($p=$db->findone('fbimage2',['pid'=>$ar['pid']],['_id'=>1]))
				{
					unset($ar['pid']);
					$db->update('fbimage2',['_id'=>$p['_id']],['$set'=>$ar]);
				}
				else
				{
					$db->insert('fbimage2',$ar);
				}
			}
			else
			{
				echo ' NO';
			}
			echo '<br>';
		}
	}
?>
