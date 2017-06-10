<?php
namespace Jarm\Core;

class Http
{
  public $logs = [];
  public function __construct()
  {
    #debug_print_backtrace();
  }

  public function curl(string $url,array $arg): string
  {
    $this->logs[]=$url;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_SAFE_UPLOAD,true);
    curl_setopt($ch,CURLOPT_POST,$arg['post']);
    if(!empty($arg['postfields']))
    {
      curl_setopt($ch,CURLOPT_HTTPHEADER,["Content-type: multipart/form-data"]);
      curl_setopt($ch,CURLOPT_POSTFIELDS,$arg['postfields']);
    }
    if(!empty($arg['userpwd']))
    {
      curl_setopt($ch,CURLOPT_HTTPAUTH,CURLAUTH_ANY);
      curl_setopt($ch,CURLOPT_USERPWD,$arg['userpwd']);
    }
    if(!empty($arg['header']))
    {
      curl_setopt($ch,CURLOPT_HEADER,true);
    }
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,$arg['returntransfer']);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,$arg['verifypeer']);
    if(!empty($arg['useragent']))
    {
      curl_setopt($ch,CURLOPT_USERAGENT,$arg['useragent']);
    }
    curl_setopt($ch,CURLOPT_TIMEOUT,$arg['timeout']);
    if(!empty($arg['forbid_reuse']))
    {
      curl_setopt($ch,CURLOPT_FORBID_REUSE,true);
    }
    if(count($arg['httpheader']))curl_setopt($ch,CURLOPT_HTTPHEADER,$arg['httpheader']);
    if(!empty($arg['referer']))
    {
      curl_setopt($ch,CURLOPT_REFERER,$arg['referer']);
    }
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
    $result=curl_exec($ch);
    curl_close($ch);
    return $result;
  }

  public function get(string $url,$post=false,array $option=[]): string
  {
    #echo '-------'.$url.'---------';
    $arg=[
      'post'=>false,
      'postfields'=>'',
      'header'=>false,
      'returntransfer'=>true,
      'verifypeer'=>false,
      'useragent'=>'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1',
      'timeout'=>60,
      'forbid_reuse'=>true,
      'referer'=>false,
      'httpheader'=>[
        'Connection: Keep-Alive',
        'Keep-Alive: 60'
      ]
    ];
    $arg=array_merge($arg,(array)$option);
    //print_r($arg);
    if($post)
    {
      #$_p='';
      $arg['post']=true;
      if(is_array($post))
      {
        $_p=$post;
        #$_p=http_build_query($post);
        //foreach($post as $key=>$value)$_p.= ($_p?'&':'').rawurlencode($key).'='.rawurlencode($value);
      }
      elseif(is_string($post))
      {
        $_p=$post;
      }
      if($_p)$arg['postfields']=$_p;
    }
    return $this->curl($url,$arg);
  }
}

?>
