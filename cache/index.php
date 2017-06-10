<?php

$browser = strtolower(trim($_SERVER['HTTP_USER_AGENT']));
if(!$browser)
{
	exit;
}
elseif(strpos($browser,'apachebench')!==false)
{
	exit;
}

//facebookexternalhit
//googlebot


$url=urldecode(parse_url(strtolower($_SERVER['REQUEST_URI']),PHP_URL_PATH));
$path=array_values(array_filter(explode('/',substr($url,strlen('/')))));


if(!$_SERVER['HTTPS'])
{
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: '.'https://'.$_SERVER['HTTP_HOST'].urldecode(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)).($_SERVER['QUERY_STRING']?'?'.$_SERVER['QUERY_STRING']:''));
	exit;
}

$serv=array_shift($path);
if(in_array($serv,['f1','f2','f3','f4']))
{
  if(in_array($path[0],['news']))
  {

		//facebookexternalhit
		//googlebot
		if(strpos($browser,'facebookexternalhit')===false)
		{
				header('HTTP/1.1 301 Moved Permanently');
				header('Location: https://'.$serv.'.jarm.com/'.implode('/',$path));
				file_put_contents(__DIR__.'/ua-fail.txt', "\r\n".date('Y-m-d H:i:s').' - '.$_SERVER['REMOTE_ADDR'].' - '.$_SERVER['HTTP_REFERER'].' - '.$_SERVER['REQUEST_URI'].' - '.$browser, FILE_APPEND | LOCK_EX);
				exit;
		}
		else
		{
			$ref='facebookexternalhit';
		}
		#file_put_contents(__DIR__.'/ua.txt', "\r\n".date('Y-m-d H:i:s').' - '.$_SERVER['REMOTE_ADDR'].' - '.$ref.' - '.$_SERVER['REQUEST_URI'], FILE_APPEND | LOCK_EX);

    $file=$serv.'/'.implode('/',$path);
    if(file_exists(__DIR__.'/file/'.$file))
    {
      header("Content-Type: image/jpeg");
      echo file_get_contents(__DIR__.'/file/'.$file);
    }
    else
    {
      $url = 'https://'.$serv.'.jarm.com/'.implode('/',$path);
      $data = file_get_contents($url);
      (new folder())->save($file, $data);
      header("Content-Type: image/jpeg");
      echo $data;
      #echo $_SERVER['REQUEST_URI'];
      #print_r($path);
    }
  }
}
elseif($serv=='move.js')
{
	header('Content-Type: "text/javascript; charset=UTF-8";');
	echo 'window.location.href="https://jarm.com";';
	exit;
}
elseif($serv=='move.css')
{
	header('Content-Type: "text/css; charset=UTF-8";');
	echo '*,html,body,div{display:none !important;}';
	exit;
}
elseif($serv=='clear')
{
  $serv=array_shift($path);
  if(in_array($path[0],['news']))
  {
    $file=$serv.'/'.implode('/',$path);
    (new folder())->clean($file);
  }
}



class folder
{
	public $folder;
	public function __construct()
	{
		$this->folder=__DIR__.'/file/';
	}
	public function save($file,$data)
	{
		if(!is_dir(dirname($this->folder.$file)))
		{
			$this->_mkdir(dirname($this->folder.$file));
		}
    file_put_contents($this->folder.$file,$data);
		return true;
	}

	public function mkdir($dir, $mode = 0777)
	{
		if(!is_dir($this->folder.$dir))
		{
			$this->_mkdir($this->folder.$dir,$mode);
		}
		return true;
	}

	public function delete($file)
	{
		if(file_exists($this->folder.$file))
		{
			@unlink($this->folder.$file);
		}
		return true;
	}

	private function _mkdir($dir, $mode = 0777)
	{
		if(!is_dir($dir))
		{
			$this->_mkdir(dirname($dir));
			@mkdir($dir, $mode);
			@chmod($dir, $mode);
		}
	}

	public function clean($type)
	{
		if (!is_dir($this->folder.$type)||!($dh=@opendir($this->folder.$type))) return;
		$result=true;
		while($file=readdir($dh))
		{
			if(!in_array($file,array('.','..')))
			{
				$file2=$type.'/'.$file;
				if(is_dir($this->folder.$file2))
				{
					$this->clean($file2);
				}
				else
				{
					@unlink($this->folder.$file2);
				}
			}
		}
		@rmdir($this->folder.$type);
    return false;
	}
}

exit;
?>
