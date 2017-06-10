<?php


$tmp=UPLOAD_PATH.'football/team/';
$icon=[];
if(is_dir($tmp))
{
	if($dh=opendir($tmp))
	{
		while(($dir=readdir($dh))!==false)
		{
			echo $dir.'<br>';
		}
		closedir($dh);
	}
}
rsort($icon);

exit;

/*
if($_FILES['file'])
{
	if($_POST['data']['folder']&&$_FILES['file']['tmp_name'])
	{
		$photo=Load::Photo();
		$folder=UPLOAD_FOLDER.'football/team/'.$_POST['data']['folder'];
		if($n = $photo->thumb('o',$_FILES['file']['tmp_name'],$folder,150,150,'inboth','png'))
		{		
			$f = $folder.'/'.$n;
			
			$photo->thumb('i',$f,$folder,16,16,'inboth','png');
			$photo->thumb('s',$f,$folder,32,32,'inboth','png');
			$photo->thumb('t',$f,$folder,64,64,'inboth','png');
			
			$photo->thumb('i',$f,$folder,16,16,'inboth','jpg');
			$photo->thumb('s',$f,$folder,32,32,'inboth','jpg');
			$photo->thumb('t',$f,$folder,64,64,'inboth','jpg');
			$photo->thumb('o',$f,$folder,120,120,'inboth','jpg');
			
			$size=@getimagesize($f);
			$status=['status'=>'OK','data'=>['n'=>$n,'w'=>$size[0],'h'=>$size[1]]];
		}
		else
		{
			$error='file not exists';
		}
	}
	else
	{
		$error='no data';
	}
}
else
{
	$error='file not found';
}
*/

?>