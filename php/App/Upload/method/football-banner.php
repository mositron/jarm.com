<?php

if($_FILES['file'])
{
	if($_POST['data']['name']&&$_FILES['file']['tmp_name'])
	{
		$f=$_FILES['file']['tmp_name'];
		$name=$_POST['data']['name'];
		$folder=UPLOAD_FOLDER.'football/banner/';
		
		$size=@getimagesize($f);
		$type='';
		switch (strtolower($size['mime']))
		{
			case 'image/gif':
				$type='gif';
				break;
			case 'image/jpg':
			case 'image/jpeg':
			case 'image/png':
			case 'image/x-png':
				$type='jpg';
				break;
		}
		
		if($type)
		{
			$n=$name.'.'.$type;
			@copy($f,FILES.$folder.'/'.$n);
			$status=['status'=>'OK','data'=>['n'=>$n,'w'=>$size[0],'h'=>$size[1],'ex'=>$type]];
		}
		else
		{
			$error='no image';	
		}
		//$error='no - '.$f2;
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

?>