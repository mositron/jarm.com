<?php
	$pages=[
							//		['t'=>'9GAG in Thai','id'=>'160866484017913','min'=>100],
									['t'=>'คิดว่าดีก็ทำต่อไป','id'=>'185668594895616','min'=>100],
									['t'=>'บ่นบ่น','id'=>'119275421551380','min'=>100],
						//			['t'=>'Jaytherabbit','id'=>'503977206328815','min'=>100],
						//			['t'=>'Eat All Day','id'=>'425434517512362','min'=>100],
							//		['t'=>'สมาคมกวนTEEN 18+','id'=>'276439945704187','min'=>100],
							//		['t'=>'ความรู้ท่วมหัวเอาตัวไม่รอด','id'=>'377972818972771','min'=>100],
									['t'=>'โสดแสนD','id'=>'215561678464052','min'=>100],
									['t'=>'ข้อความโดนๆ','id'=>'164486926939395','min'=>100],
						//			['t'=>'หน้ากลม','id'=>'145147339021153','min'=>100],
									['t'=>'Minions thailand','id'=>'206907329467617','min'=>100],
					//				['t'=>'The Smurfs Thailand','id'=>'537003989706910','min'=>100],
						//			['t'=>'Dora GAG','id'=>'313284625423348','min'=>100],
									['t'=>'หมึกซึม','id'=>'332998630119285','min'=>100],
									['t'=>'พอใจ','id'=>'390054464415577','min'=>100],
							//		['t'=>'ลึกๆ','id'=>'294688280665847','min'=>100],
						//			['t'=>'Timixabie','id'=>'299590466830861','min'=>100],
									['t'=>'กระดาษสีครีม','id'=>'552419978152008','min'=>100],
									['t'=>'Jod 8riew','id'=>'420017908056802','min'=>100],
									['t'=>'คมเกิ๊น','id'=>'418024494891447','min'=>100],
									['t'=>'Message','id'=>'229198730561050','min'=>100],
									['t'=>'คนอะไรเป็นแฟนหมี','id'=>'514030908708895','min'=>100],
									['t'=>'นี่เพื่อนไงจำไม่ได้หรอ','id'=>'334236760084743','min'=>100],


									//คนอะไรเป็นแฟนหมี/514030908708895
									//นี่เพื่อนไงจำไม่ได้หรอ/334236760084743


									['t'=>'ภาพคอมเม้นฮ่าๆ','id'=>'216748941823775','min'=>50],
									['t'=>'แจกรูปโพสต์ใต้คอมเม้นเฟสบุ๊ค','id'=>'586593644724225','min'=>100],
									['t'=>'รวมรูปคอมเม้นฮาฮา','id'=>'1376048759290010','min'=>100],



									['t'=>'ทูนหัวของบ่าว','id'=>'130185063856737','min'=>100],
									['t'=>'จอนนี่แมวศุภลักษณ์','id'=>'311696612273483','min'=>100],
									['t'=>'เฉโปแมวโง่','id'=>'1225060557634025','min'=>100],
									['t'=>'แฟนคลับแมวกล่อง','id'=>'198496713513140','min'=>100],
									['t'=>'แฟนคลับแมวตะกร้า','id'=>'178944882137764','min'=>100],
									['t'=>'แฟนคลับเจ้าเหมียวสนูปปี้','id'=>'392237460795185','min'=>100],
									['t'=>'รังของแมวก๊อง','id'=>'1534696463431854','min'=>100],



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

// /185668594895616?fields=posts.limit(30){id,message,full_picture,likes.limit(1).summary(1),shares,comments.limit(1).summary(1)}
// /229198730561050?fields=posts.limit(30){id,message,full_picture,likes.limit(1).summary(1),shares,comments.limit(1).summary(1),type}&posts.type=photo

	$post = $facebook->api('/'.$page['id'].'/posts?fields=id,message,full_picture,created_time,likes.limit(1).summary(1),shares,comments.limit(1).summary(1),type');
	//$post = $facebook->api(['method' => 'fql.query', 'query' => 'SELECT post_id,message , created_time, type,like_info.like_count, comment_info.comment_count, share_info.share_count, attachment  FROM stream WHERE source_id='.$page['id'].' and filter_key=\'owner\' ORDER BY created_time desc limit 0,20']);
	echo '<pre>';

	if(is_array($post)&&is_array($post['data']))
	{
		$post=$post['data'];
		$p=[];
		for($i=0;$i<count($post);$i++)
		{
			if($post[$i]['type']!='photo')
			{
				continue;
			}
			$lk=intval($post[$i]['likes']['summary']['total_count']);
			$sh=intval($post[$i]['shares']['count']);
			$cm=intval($post[$i]['comments']['summary']['total_count']);

			//print_r($post[$i]);
			$img=$post[$i]['full_picture'];
			echo '--'.($lk.'+'.$sh.'+'.$cm).'>'.$page['min'].' -- '.$img.' = ';
			$all = $lk+$sh+$cm;
			if($all>$page['min'] && $img)
			{
				$fimg = $img;
				echo ' <strong style="color:#090">OK2</strong> ';
				//print_r($post['data'][$i]);
				$t=strtotime($post[$i]['created_time']);
				$ar=array(
										'pid'=>$post[$i]['id'],
										'ms'=>$post[$i]['message'],
										'lk'=>$lk,
										'sh'=>$sh,
										'cm'=>$cm,
										'p'=>$page['t'],
										'fb'=>$page['id'],
										'fbid'=>$post[$i]['id'],
										'ds'=>Load::Time()->from($t),
										'du'=>Load::Time()->now(),
									);
				if($p=$db->findone('fbimage2',['pid'=>$ar['pid']],['_id'=>1]))
				{
					echo "\r\n ---Found--- \r\n";
					unset($ar['pid']);
					$db->update('fbimage2',['_id'=>$p['_id']],['$set'=>$ar]);
				}
				else
				{
					echo "\r\n ---Not Found--- \r\n";
					if($_posted=$db->insert('fbimage2',$ar))
					{
						echo "\r\n ---Inserted--- \r\n";
						$fd = Load::Folder()->fd($_posted);
						$folder = substr($fd,0,2).'/'.substr($fd,2,2);
						$name = substr($fd,4,2);

						$q = Load::Upload()->post('s3','fbimage',$fimg,['folder'=>$folder,'name'=>$name]);
						if($q['status']=='OK')
						{
							$db->update('fbimage2',['_id'=>$_posted],['$set'=>['fd'=>$folder,'n'=>$name]]);
							echo '
							https://s3.jarm.com/fbimage/'.$folder.'/'.$name.'_n.jpg

							';
						}
						else
						{
							$db->remove('fbimage2',['_id'=>$_posted]);
							echo '
							----- NOT OK = '.print_r($q,true).' -----
							';
						}
					}
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
